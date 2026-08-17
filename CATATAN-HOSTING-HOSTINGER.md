# Catatan Deploy BKD App ke Hostinger — Paket Single (Shared Hosting)

> Dokumen ini mencatat apa yang berhasil dilakukan, agar tidak mengulangi kesalahan
> yang sama. Berlaku khusus **Hostinger paket Single (shared hosting / hPanel)**
> untuk aplikasi Laravel 12.

---

## 1. Kunci Utama: Struktur Folder (Sumber kesalahan paling sering)

Hostinger paket shared **TIDAK BISA mengubah document root** (dikonfirmasi dari
dokumentasi resmi Hostinger dan pengalaman: menu "Document root" tidak ada di hPanel
paket ini). Karena itu Laravel harus diletakkan dengan struktur khusus:

```
/home/uXXXXXXX/domains/sipakbkdselayar.my.id/        ← ROOT APP (di luar webroot, TIDAK ter-expose)
├── app/
├── bootstrap/
├── config/
├── routes/
├── storage/
├── vendor/
├── artisan
├── .env
└── public_html/                                     ← ISI folder public/ Laravel, DAN INI WEBROOT
    ├── index.php
    ├── .htaccess
    ├── build/
    ├── img/
    ├── favicon.ico
    └── robots.txt
```

- **File app diletakkan di level atas `public_html`**, bukan di dalamnya.
- **Isi `public/` ditaruh langsung di `public_html/`** — karena docroot selalu `public_html`.
- `index.php` di `public_html` memakai `../bootstrap/app.php` (relatif 1 level ke atas) → otomatis benar dengan struktur ini.
- Dengan struktur ini, `.env`, `storage/`, `vendor/` TIDAK bisa diakses publik. Aman.

**Mistake umum yang membuat gagal:** meng-upload seluruh folder app ke `public_html`
atau membiarkan docroot menunjuk ke folder tanpa `index.php` → error **403 Forbidden**.

---

## 2. Persiapan di Komputer Lokal (WAJIB sebelum upload)

```bash
# Hapus dependensi dev (lebih ringan, lebih aman)
composer install --no-dev --optimize-autoloader --no-interaction

# Build aset frontend
npm install
npm run build          # hasil di public/build

# Buat file .env produksi (contoh ada di .env.hostinger dulu; jangan di-commit)
```

**Isi penting `.env`:**
- `APP_URL=https://domainanda.com`
- `APP_KEY=...` (jangan kosong, jangan ganti setelah DB terisi)
- `APP_DEBUG=false`
- `DB_CONNECTION=mysql`, `DB_HOST=127.0.0.1`, `DB_PORT=3306`
- `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` → buat dulu di hPanel → **Databases**
- `SESSION_DRIVER=file`
- `FILESYSTEM_DISK=local`
- `QUEUE_CONNECTION=sync`
- `CACHE_STORE=file`
- `MAIL_MAILER=log`

**Buat zip yang BENAR (jangan asal zip folder):**
```bash
zip -r -q aplikasi.zip . \
  -x "node_modules/*" \
  -x ".git/*" \
  -x ".env" \
  -x "public/storage" \
  -x "storage/logs/*" \
  -x "storage/framework/cache/*" \
  -x "storage/framework/sessions/*" \
  -x "storage/framework/views/*" \
  -x "database/database.sqlite*"
```
Jangan upload `node_modules` (besar & tak perlu). `vendor/` WAJIB ikut karena server
paket Single tidak bisa jalankan Composer dengan mudah.

**Mistake umum:** upload `node_modules` → paket sangat besar; atau lupa `npm run build`
→ halaman tampil tanpa CSS/JS (atau `.env` ikut ter-upload / ter-commit).

---

## 3. Upload & Ekstrak di hPanel

1. **Files → File Manager** → folder `public_html` → upload zip.
2. Klik kanan zip → **Extract**. Hasil ekstrak akan berada di subfolder (mis. `sipakbkd-hostinger`).
3. Lalu **RESTRUKTURISASI** (langkah krusial yang sering dilewatkan):
   - Pindahkan seluruh isi folder hasil ekstrak **KECUALI folder `public`** ke level
     di atas `public_html` (folder root domain, mis. `/home/uXXXXXXX/domains/domain/`).
   - Pindahkan isi folder `public/` ke dalam `public_html/`.
   - Atau lakukan via FTP `RNFR`/`RNTO` (rename = pindah).

**Mistake umum:** membiarkan app di `public_html/subfolder` lalu mengharap domain root
jalan → 403 (karena docroot `public_html` tidak punya `index.php` di root).

---

## 4. Folder yang Harus Ada & Writable

Pastikan direktori berikut ada (buat manual via File Manager/FTP jika tidak ada):

```
storage/app/public/
storage/framework/cache/data/
storage/framework/sessions/
storage/framework/views/
bootstrap/cache/
```

Set permission `755`/`775` untuk `storage/` dan `bootstrap/cache/`.

**Mistake umum:** folder `storage/framework/{cache,sessions,views}` tidak dibuat →
error sesi/tulisan file saat login (mis. CSRF 419, session tidak tersimpan).

---

## 5. PHP & Database

- hPanel → set **PHP versi 8.2** (sesuai `composer.json`). PHP yang salah versi → error saat boot.
- hPanel → **Databases** → buat database MySQL + user (jangan pakai user root).
- Isi kredensial ke `.env` server lalu **rename file** menjadi `.env` jika belum.

---

## 6. Menjalankan Artisan (tanpa SSH — paket Single)

Paket Single umumnya **tanpa SSH/Terminal**. Jalankan via **Cron Jobs** (hPanel →
Advanced → Cron Jobs), set frekuensi "Every minute", lalu HAPUS setelah selesai:

```
cd /home/uXXXXXXX/domains/domainanda.com && php artisan migrate --seed --force
cd /home/uXXXXXXX/domains/domainanda.com && php artisan storage:link
```

> `storage:link` HANYA berfungsi jika fungsi `symlink()` aktif. Pada paket Single
> ternyata **`symlink()` DINONAKTIFKAN** → storage:link gagal. Lihat bagian 7.

**Mistake umum:** tidak pakai `cd` sebelum `php artisan`, atau tidak `--force`
(di environment production artisan menolak), atau lupa hapus cron sehingga
`migrate --seed` jalan berulang → data duplikat.

---

## 7. Storage Tanpa Symlink (PENTING — solusi khusus paket Single)

Pada paket Single:
- **`symlink()` dinonaktifkan** → `php artisan storage:link` tidak akan membuat
  `public_html/storage`. Cek: `function_exists('symlink')` = false.
- **Rewrite `.htaccess` ke luar docroot juga gagal** → mencoba
  `RewriteRule ^storage/(.*)$ ../storage/app/public/$1 [L]` menghasilkan **HTTP 500**
  (Apache menolak melayani file di luar webroot).

**Solusi yang bekerja: layani `/storage/*` lewat route Laravel.**

1. Di `routes/web.php`, tambahkan (Wajib `ltrim` + regex `.*`):

   ```php
   use Illuminate\Support\Facades\Storage;

   Route::get('/storage/{path}', function (string $path) {
       $path = ltrim($path, '/');
       $disk = Storage::disk('public');
       if (!$disk->exists($path)) {
           abort(404);
       }
       return $disk->response($path);
   })->where('path', '.*');
   ```

2. Di `config/filesystems.php`, **hapus `'serve' => true` pada disk `local`**.
   Kalau tidak, Laravel otomatis mendaftarkan route `storage.local` yang membaca dari
   disk `private` dan **menang/mendahului route kita** → file `/storage/*` jadi 404.

3. Upload `routes/web.php` + `config/filesystems.php` ke server.

4. Setelah upload file PHP, **reset opcache** (lihat bagian 9), karena server bisa
   tetap memakai versi lama file.

**Mistake umum:** `storage:link` gagal lalu bingung; atau lupa route sehingga foto/
dokumen tidak tampil (404); atau lupa menghapus `serve => true` sehingga route otomatis
mengalahkan route sendiri.

---

## 8. Perubahan Kode yang Perlu (ringkas)

| File | Perubahan |
| --- | --- |
| `app/Helpers/helpers.php` | ganti Supabase → `Storage::disk('public')` |
| `app/Http/Controllers/ProfilController.php` | upload/hapus foto via `Storage::disk('public')` |
| `app/Http/Controllers/PengajuanController.php` | upload dokumen + download via `Storage::disk('public')` |
| `config/services.php` | hapus blok `supabase` (tak terpakai) |
| `routes/web.php` | tambah route `/storage/{path}` (bagian 7) |
| `config/filesystems.php` | hapus `'serve' => true` di disk `local` (bagian 7) |
| hapus | artefak Vercel: `api/`, `vercel.json`, `.vercelignore` |

---

## 9. Opcache — File PHP Tidak Ter-update

Server Hostinger mengaktifkan **OPCache**. Setelah meng-upload/mengubah file PHP, server
bisa tetap memakai versi lama (gejala: route baru 404, perubahan tidak terlihat).

Reset dengan script sementara di `public_html`:
```php
<?php opcache_reset(); echo 'ok';
```
Lalu buka `https://domain/namascript.php` sekali, dan **hapus script itu segera**.

---

## 10. Database

- Karena data lama tidak diperlukan → cukup **fresh migrate + seed** (bagian 6).
- Akun default setelah seed: `admin@bkd.go.id` / `password`,
  `pimpinan@bkd.go.id`, `password`, `pegawai@bkd.go.id`, `password`.
- Login di app ini memakai **field `role`** (radio Pegawai / Admin BKD / Pimpinan) —
  pastikan pilih role yang sesuai dengan akun saat login.

---

## 11. Verifikasi Setelah Deploy (cek cepat)

```bash
curl -I https://domainanda.com/                 # harus 200
curl -I https://domainanda.com/login            # harus 200
curl -I https://domainanda.com/build/manifest.json   # harus 200 (aset vite ada)
# upload file tes ke storage lalu akses via /storage/... (harus 200)
# login admin → dashboard harus terbuka
```

---

## 12. Checklist Cepat (agar tidak gagal lagi)

- [ ] PHP 8.2 di hPanel
- [ ] Database MySQL + user dibuat, `.env` diisi & rename benar
- [ ] `APP_KEY` ada (generate lokal lalu bawa, atau `key:generate`)
- [ ] Zip dibuat tanpa `node_modules`, `.env`, `.git`, cache
- [ ] `composer install --no-dev` + `npm run build` dijalankan SEBELUM zip
- [ ] Struktur benar: app di atas `public_html`, isi `public/` di `public_html`
- [ ] `storage/framework/{cache,sessions,views}` ada
- [ ] Artisan via cron dengan `cd ... && php artisan migrate --seed --force`, cron dihapus setelah jalan
- [ ] Route `/storage/*` + hapus `serve => true` (karena symlink mati)
- [ ] Reset opcache setelah update file PHP
- [ ] Hapus semua file diagnostik / script sementara dari server
- [ ] SSL aktif (hPanel → Security → SSL) + paksa HTTPS

---

## 13. DomPDF: PDF SK & Laporan Tidak Bisa Diunduh (Penting)

**Gejala:** tombol download SK / laporan PDF tidak menghasilkan file (error di
belakang layar, mis. "Cannot resolve public path" / 500).

**Penyebab:** restrukturisasi membuat folder `public` TIDAK ADA di root app (isinya
sudah dipindah ke `public_html`). DomPDF mencoba `realpath(base_path('public'))` di
`vendor/barryvdh/laravel-dompdf/src/ServiceProvider.php`, hasilnya `false` →
`RuntimeException: Cannot resolve public path`.

**Solusi (2 langkah):**

1. Di `config/dompdf.php`, ubah `public_path` menjadi env-driven (fallback lokal tetap jalan):
   ```php
   'public_path' => env('DOMPDF_PUBLIC_PATH', base_path('public')),
   ```
2. Di `.env` server, tambahkan path webroot asli:
   ```
   DOMPDF_PUBLIC_PATH=/home/uXXXXXXX/domains/domainanda.com/public_html
   ```

Setelah itu **reset opcache** (bagian 9) dan tes:
- `/admin/laporan/pdf` → harus `Content-Type: application/pdf`
- `/admin/pengajuan/{id}/download-sk` → harus `Content-Type: application/pdf`

**Catatan:** ekstensi PHP yang dibutuhkan DomPDF (`dom`, `mbstring`, `gd`, `xml`,
`imagick`) sudah tersedia di Hostinger; bukan itu masalahnya.

**Mistake umum:** fokus pada ekstensi/`APP_DEBUG` padahal akar masalahnya adalah
`public` yang tidak ada di root app setelah restrukturisasi.