# RANCANGAN ALUR BARU (SISTEM USULAN)

## Sistem Informasi Kenaikan Pangkat Berbasis Web

---

# A. Deskripsi Umum

Rancangan alur baru Sistem Informasi Kenaikan Pangkat Berbasis Web dirancang untuk mendigitalisasi proses pengajuan kenaikan pangkat pegawai mulai dari pengajuan, verifikasi administrasi, persetujuan pimpinan, hingga penerbitan Surat Keputusan (SK). Seluruh proses dilakukan secara terintegrasi sehingga memudahkan pegawai, operator BKD, dan pimpinan dalam melaksanakan tugasnya secara efektif, efisien, transparan, dan terdokumentasi.

---

# B. Alur Proses Sistem

## 1. Proses Pengajuan oleh Pegawai

Tahapan pertama dilakukan oleh pegawai sebagai pemohon kenaikan pangkat.

### Langkah-langkah

1. Pegawai membuka aplikasi Sistem Informasi Kenaikan Pangkat.
2. Pegawai melakukan login menggunakan **Username** dan **Password** yang telah diberikan.
3. Setelah berhasil login, pegawai mengisi formulir pengajuan kenaikan pangkat.
4. Pegawai mengunggah seluruh dokumen persyaratan sesuai ketentuan.
5. Sistem menyimpan data pengajuan.
6. Apabila terdapat kekurangan dokumen, pegawai akan menerima notifikasi untuk melakukan perbaikan.
7. Pegawai melengkapi atau memperbaiki dokumen sesuai hasil pemeriksaan sistem maupun operator.
8. Setelah seluruh proses selesai dan disetujui, pegawai menerima notifikasi persetujuan beserta Surat Keputusan (SK) yang dapat diunduh melalui sistem.

---

## 2. Proses oleh Sistem Informasi

Setelah pengajuan dikirim oleh pegawai, sistem secara otomatis menjalankan beberapa proses.

### Tahapan Sistem

* Melakukan validasi data login pengguna.
* Menyimpan data pengajuan ke dalam database.
* Melakukan pemeriksaan kelengkapan dokumen yang telah diunggah.
* Mengirim notifikasi kepada operator apabila dokumen telah lengkap.
* Menghasilkan Surat Keputusan (SK) apabila pengajuan telah memperoleh persetujuan pimpinan.
* Menyimpan dokumen SK ke dalam database.
* Mengirim notifikasi hasil kepada pegawai.

### Keputusan Sistem

#### Apabila Dokumen Tidak Lengkap

* Sistem memberikan notifikasi kepada pegawai.
* Pegawai diminta melengkapi dokumen yang masih kurang.
* Setelah diperbaiki, proses kembali pada tahap unggah dokumen.

#### Apabila Dokumen Lengkap

* Sistem meneruskan pengajuan kepada Operator/Admin BKD untuk dilakukan proses verifikasi administrasi.

---

## 3. Proses Verifikasi oleh Operator/Admin BKD

Operator BKD bertanggung jawab melakukan pemeriksaan administrasi terhadap seluruh dokumen pengajuan yang telah dikirim oleh pegawai.

### Langkah-langkah

1. Operator menerima notifikasi adanya pengajuan baru.
2. Operator membuka data pengajuan.
3. Operator memeriksa seluruh dokumen persyaratan.
4. Operator melakukan verifikasi administrasi.

### Keputusan Verifikasi

#### Berkas Tidak Valid

Apabila ditemukan kesalahan atau ketidaksesuaian dokumen, maka:

* Operator menolak sementara pengajuan.
* Operator memberikan alasan penolakan atau catatan perbaikan.
* Pengajuan dikembalikan kepada pegawai untuk diperbaiki.

#### Berkas Valid

Apabila seluruh dokumen telah sesuai, maka:

* Operator menyetujui hasil verifikasi.
* Status pengajuan diperbarui menjadi **Terverifikasi**.
* Sistem mengirimkan notifikasi kepada pimpinan untuk proses persetujuan.

---

## 4. Proses Persetujuan oleh Pimpinan

Pimpinan bertugas memberikan keputusan akhir terhadap usulan kenaikan pangkat.

### Langkah-langkah

1. Pimpinan menerima notifikasi bahwa terdapat pengajuan yang telah diverifikasi.
2. Pimpinan membuka data pengajuan.
3. Pimpinan meninjau seluruh dokumen pendukung.
4. Pimpinan memberikan keputusan.

### Keputusan

#### Pengajuan Tidak Disetujui

Apabila pengajuan belum memenuhi persyaratan, maka:

* Pengajuan ditolak.
* Status pengajuan diperbarui menjadi **Ditolak**.
* Pegawai menerima notifikasi mengenai hasil penolakan beserta alasan yang diberikan.

#### Pengajuan Disetujui

Apabila pengajuan memenuhi seluruh persyaratan, maka:

* Pimpinan menyetujui pengajuan kenaikan pangkat.
* Sistem melanjutkan proses penerbitan Surat Keputusan (SK).

---

## 5. Proses Penerbitan Surat Keputusan (SK)

Setelah memperoleh persetujuan pimpinan, sistem secara otomatis melakukan proses akhir sebagai berikut.

1. Menghasilkan Surat Keputusan (SK) Kenaikan Pangkat.
2. Menyimpan dokumen SK ke dalam database.
3. Mengirimkan notifikasi kepada pegawai.
4. Pegawai dapat melihat status pengajuan.
5. Pegawai dapat mengunduh SK melalui sistem.

---

# C. Ringkasan Alur Proses

| No | Aktor        | Aktivitas                                      |
| -- | ------------ | ---------------------------------------------- |
| 1  | Pegawai      | Login ke sistem                                |
| 2  | Pegawai      | Mengisi formulir pengajuan kenaikan pangkat    |
| 3  | Pegawai      | Mengunggah dokumen persyaratan                 |
| 4  | Sistem       | Memvalidasi login dan menyimpan data pengajuan |
| 5  | Sistem       | Memeriksa kelengkapan dokumen                  |
| 6  | Pegawai      | Melengkapi dokumen apabila terdapat kekurangan |
| 7  | Sistem       | Mengirim notifikasi kepada Operator BKD        |
| 8  | Operator BKD | Memverifikasi dokumen administrasi             |
| 9  | Operator BKD | Menyetujui atau mengembalikan berkas           |
| 10 | Sistem       | Memperbarui status pengajuan                   |
| 11 | Sistem       | Mengirim notifikasi kepada pimpinan            |
| 12 | Pimpinan     | Meninjau dokumen pengajuan                     |
| 13 | Pimpinan     | Memberikan keputusan persetujuan               |
| 14 | Sistem       | Menghasilkan Surat Keputusan (SK)              |
| 15 | Sistem       | Menyimpan dokumen SK                           |
| 16 | Sistem       | Mengirim notifikasi hasil kepada pegawai       |
| 17 | Pegawai      | Mengunduh SK dan proses selesai                |

---

# D. Keterangan Aktor

### Pegawai

Pegawai merupakan pengguna yang mengajukan usulan kenaikan pangkat dengan mengisi formulir, mengunggah dokumen persyaratan, memperbaiki dokumen apabila diperlukan, serta menerima hasil persetujuan beserta Surat Keputusan (SK).

### Sistem Informasi

Sistem bertugas mengelola seluruh proses secara otomatis, mulai dari validasi login, penyimpanan data, pemeriksaan kelengkapan dokumen, pengiriman notifikasi, pembaruan status pengajuan, hingga penerbitan Surat Keputusan (SK).

### Operator/Admin BKD

Operator BKD bertanggung jawab melakukan verifikasi administrasi terhadap seluruh dokumen pengajuan, memberikan catatan apabila terdapat kekurangan, serta meneruskan pengajuan yang telah valid kepada pimpinan.

### Pimpinan

Pimpinan bertugas melakukan peninjauan akhir terhadap pengajuan kenaikan pangkat dan memberikan keputusan apakah pengajuan disetujui atau ditolak.

---

# E. Keunggulan Alur Sistem Usulan

1. Seluruh proses pengajuan dilakukan secara online dan terintegrasi.
2. Pemeriksaan kelengkapan dokumen dilakukan secara otomatis oleh sistem.
3. Verifikasi administrasi dilakukan oleh Operator BKD sehingga mengurangi kesalahan administrasi.
4. Persetujuan dilakukan secara berjenjang sesuai kewenangan.
5. Status pengajuan dapat dipantau secara **real-time** oleh pegawai.
6. Setiap perubahan status disertai dengan notifikasi otomatis.
7. Dokumen pengajuan dan Surat Keputusan (SK) tersimpan secara digital sehingga mudah diarsipkan dan ditelusuri.
8. Waktu proses pengajuan menjadi lebih cepat, efisien, transparan, dan akuntabel.
9. Mengurangi penggunaan dokumen fisik (paperless).
10. Mempermudah proses monitoring dan pelaporan oleh BKD.

---

# F. Alur Proses Singkat

```text
Pegawai
   │
   ▼
Login
   │
   ▼
Isi Form Pengajuan
   │
   ▼
Upload Dokumen
   │
   ▼
Sistem Memeriksa Kelengkapan
   │
   ├── Tidak Lengkap
   │       │
   │       ▼
   │  Notifikasi ke Pegawai
   │       │
   │       ▼
   │  Perbaiki Dokumen
   │
   └── Lengkap
           │
           ▼
Verifikasi Operator BKD
           │
     ┌─────┴─────┐
     │           │
 Tidak Valid   Valid
     │           │
     ▼           ▼
Kembali ke   Persetujuan
 Pegawai      Pimpinan
                  │
            ┌─────┴─────┐
            │           │
        Ditolak     Disetujui
            │           │
            ▼           ▼
      Notifikasi    Generate SK
         Pegawai         │
                          ▼
                  Simpan SK & Kirim
                     Notifikasi
                          │
                          ▼
                       Selesai
```

Dokumen ini siap ditempel (**copy–paste**) ke Microsoft Word atau Google Docs dengan format yang rapi untuk digunakan pada **BAB Analisis Sistem Usulan**, **SRS**, maupun **PRD**.
