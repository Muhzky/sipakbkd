<p align="center">
  <a href="https://laravel.com/">
    <img src="https://laravel.com/img/logomark.min.svg" alt="laravel logo" width="75" height="75">
  </a>
  <a href="https://getstisla.com">
    <img src="https://avatars2.githubusercontent.com/u/45754626?s=75&v=4" alt="Stisla logo" width="75" height="75">
  </a>
</p>

<h1 align="center">Sipak BKD</h1>

<span align="center">

**Sipak BKD** adalah Sistem Informasi Kenaikan Pangkat Berbasis Web yang dikembangkan untuk BKD Kabupaten Kepulauan Selayar. Sistem ini mendigitalisasi proses pengajuan kenaikan pangkat pegawai negeri sipil (PNS) mulai dari pengajuan, verifikasi administrasi, persetujuan pimpinan, hingga penerbitan Surat Keputusan (SK).

</span>

<br>

<p align="center">
  <a href="https://github.com/kholilullahhhh/rpph-aplikasi#quick-start">Mulai Cepat</a>
  •
  <a href="https://github.com/kholilullahhhh/rpph-aplikasi/issues">Issue</a>
</p>

<br>

## Daftar Isi

- [Daftar Isi](#daftar-isi)
- [Fitur Utama](#fitur-utama)
- [Teknologi yang Digunakan](#teknologi-yang-digunakan)
- [Mulai Cepat](#mulai-cepat)
- [Akun Default](#akun-default)
- [Lisensi](#lisensi)
- [Credits](#credits)

## Fitur Utama

-   **3 Peran Pengguna** — Pegawai, Admin BKD, dan Pimpinan dengan hak akses berbeda
-   **Alur Pengajuan Kenaikan Pangkat** — Proses pengajuan dari pegawai hingga persetujuan pimpinan
-   **Manajemen Dokumen** — Upload, unduh, dan perbaikan dokumen persyaratan (SK Pangkat, SKP, Ijazah, Dokumen Pendukung)
-   **Generasi PDF Surat Keputusan (SK)** — Penerbitan SK otomatis menggunakan DomPDF dengan format F4 resmi
-   **Sistem Notifikasi Real-time** — Pemberitahuan otomatis untuk setiap perubahan status pengajuan
-   **Laporan & Export PDF** — Laporan filterable berdasarkan bulan, tahun, dan status
-   **Dashboard Interaktif** — Statistik dan grafik bulanan menggunakan Chart.js
-   **Manajemen Data Master** — CRUD untuk Pegawai, Jabatan, dan Pangkat
-   **Autentikasi & Otorisasi** — Login/register dengan role-based access control (Spatie Permission)
-   **UI Responsive** — Tampilan responsif dengan off-canvas sidebar untuk mobile

## Teknologi yang Digunakan

| Komponen | Teknologi |
| --- | --- |
| Backend | Laravel 12, PHP 8.2 |
| Database | SQLite |
| Frontend | Bootstrap 5.3, Chart.js, DataTables, Font Awesome |
| Build Tool | Vite 7, Tailwind CSS 4 |
| Autentikasi | Custom (Session-based) |
| Otorisasi | Spatie Laravel Permission |
| PDF Generator | Barroyvdh Laravel DomPDF |

## Mulai Cepat

Beberapa opsi mulai cepat tersedia:

-   Clone repositori:
    ```bash
    git clone https://github.com/Muhzky/sipakbkd.git
    cd sipakbkd
    ```
-   Jalankan perintah berikut secara berurutan:
    ```bash
    composer install
    npm install
    npm run build
    cp .env.example .env
    php artisan key:generate
    php artisan migrate --seed
    php artisan serve
    ```
-   Atau gunakan script setup otomatis:
    ```bash
    composer setup
    ```
-   Selesai — Aplikasi dapat diakses di `http://localhost:8000`

Baca [dokumentasi Laravel](https://laravel.com/docs) dan [dokumentasi Stisla](https://getstisla.com/docs) untuk informasi lebih lanjut.

## Akun Default

Setelah menjalankan `php artisan migrate --seed`, berikut akun yang tersedia untuk testing:

| Role | Email | Password |
| --- | --- | --- |
| Admin BKD | admin@bkd.go.id | password |
| Pimpinan | pimpinan@bkd.go.id | password |
| Pegawai | pegawai@bkd.go.id | password |

## Lisensi

**BKD App** dilisensikan di bawah [Lisensi MIT](LICENSE)

## Credits

Terima kasih kepada proyek-proyek open-source yang menjadi dasar pengembangan aplikasi ini:

-   [Laravel](https://laravel.com) — Framework PHP
-   [Stisla](https://getstisla.com) — Template Admin Bootstrap
-   [Spatie Laravel Permission](https://spatie.com/docs/laravel-permission) — Role & Permission Management
-   [Barroyvdh Laravel DomPDF](https://github.com/barryvdh/laravel-dompdf) — PDF Generator
-   [Bootstrap](https://getbootstrap.com) — CSS Framework
-   [Chart.js](https://www.chartjs.org) — Chart Library
-   [DataTables](https://datatables.net) — Table Plugin

---

Dibuat untuk BKD Kabupaten Kepulauan Selayar.
