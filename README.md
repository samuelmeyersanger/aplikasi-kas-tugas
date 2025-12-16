

### **File: `README.md` (Versi Lengkap dengan Troubleshooting)**

```markdown
# Aplikasi Kas dan Tugas - STIE Ekadharma v1.0.0

Aplikasi berbasis web yang dibangun dengan Laravel 11 untuk mengelola arus kas (pemasukan dan pengeluaran) dan penugasan mahasiswa di STIE Ekadharma. Aplikasi ini dilengkapi dengan sistem autentikasi multi-role (Admin & Mahasiswa), pembayaran online, dan notifikasi real-time.

![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql)
![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-38B2AC?style=for-the-badge&logo=tailwind-css)

## 📋 Fitur-Fitur

### Fitur Umum
-   **Autentikasi Multi-Role**: Sistem login yang terpisah untuk Admin dan Mahasiswa.
-   **Dashboard Dinamis**: Dashboard yang berbeda dan disesuaikan untuk setiap role.
-   **Dark Mode**: Tampilan gelap/terang yang dapat diubah sesuai preferensi.
-   **Responsif**: Tampilan yang optimal di Desktop, Tablet, dan Ponsel.
-   **Notifikasi Real-time**: Notifikasi instan untuk Admin saat ada pembayaran baru (dengan Pusher).

### Fitur Admin
-   **Manajemen Mahasiswa**: Tambah, edit, dan hapus data mahasiswa.
-   **Manajemen Tugas**: Buat, edit, dan hapus tugas. Tugas dapat ditugaskan ke mahasiswa tertentu atau semua mahasiswa.
-   **Manajemen Tagihan**: Buat tagihan kas (bulanan, mingguan, dll) untuk semua mahasiswa.
-   **Verifikasi Pembayaran**: Verifikasi pembayaran yang dilakukan mahasiswa dengan melihat bukti transfer. Jika diverifikasi, transaksi kas pemasukan dibuat otomatis.
-   **Manajemen Kas**: Input transaksi kas masuk dan keluar secara manual.
-   **Laporan**: Melihat laporan pemasukan dan pengeluaran kas.

### Fitur Mahasiswa
-   **Dashboard Pribadi**: Melihat statistik pribadi (tugas, pembayaran).
-   **Daftar Tugas**: Melihat daftar tugas dan menandainya sebagai selesai. Dapat mengunggah file atau menempelkan link sebagai bukti.
-   **Pembayaran Kas**: Melihat daftar tagihan dan mengupload bukti pembayaran.
-   **Manajemen Profil**: Mengubah data pribadi (nama, NIM, jurusan, dll).

## 🛠️ Teknologi yang Digunakan

-   **Backend**: Laravel 11
-   **Frontend**: Blade, Tailwind CSS, Alpine.js
-   **Database**: MySQL
-   **Autentikasi**: Laravel Breeze
-   **Manajemen Role**: Spatie Laravel Permission
-   **Notifikasi**: Laravel Echo & Pusher
-   **Development Environment**: Laragon

## 📋 Prasyarat

Sebelum menjalankan aplikasi ini, pastikan komputer Anda telah terinstall:
-   PHP >= 8.2
-   Composer
-   Node.js >= 18
-   NPM / Yarn
-   Web Server (seperti Laragon, XAMPP, WAMP)
-   Git
-   Aplikasi untuk mengelola database (phpMyAdmin, HeidiSQL, dll)

## 🐛 Pemecahan Masalah (Troubleshooting)

Bagian ini menjelaskan beberapa bug umum yang mungkin terjadi dan cara memperbaikinya.

### 1. Error `UrlGenerationException: Missing required parameter [Route: admin.tugas.update]`

-   **Gejala:** Muncul error saat mencoba mengakses halaman edit atau menghapus data (misalnya, tugas, mahasiswa). Pesan error menyebutkan parameter tidak ditemukan, seperti `tuga` bukan `tugas`.
-   **Penyebab:** File `routes/web.php` dibuat atau diedit melalui command line (terminal), yang menyebabkan semua kode tergabung menjadi satu baris panjang tanpa pemisah baris (`\n`). Akibatnya, Laravel tidak bisa membaca definisi route dengan benar.
-   **Solusi:**
    1.  **Selalu gunakan editor kode** (seperti VS Code) untuk membuat atau mengedit file `routes/web.php`. Jangan pernah membuatnya dengan perintah `cat > file.txt` atau `echo > file.txt` lalu menempel kode multi-baris.
    2.  Buka file `routes/web.php` di editor kode Anda.
    3.  Pastikan route resource didefinisikan dengan benar, misalnya: `Route::resource('tugas', AdminTugasController::class);`
    4.  Setelah mengedit, jalankan `php artisan optimize:clear` di terminal.

### 2. Error `Unable to locate a class or view for component [nama-komponen]`

-   **Gejala:** Muncul error saat membuka halaman, yang menyatakan bahwa komponen Blade (seperti `x-auth-layout`, `x-input`, `x-dropdown-header`) tidak ditemukan.
-   **Penyebab:** Instalasi Laravel Breeze tidak lengkap atau file komponen tidak sengaja terhapus.
-   **Solusi:**
    1.  Buat file yang hilang di dalam folder `resources/views/components/`.
    2.  Berikut adalah daftar komponen yang sering hilang dan isinya:
        -   `auth-layout.blade.php`: (Lihat di Gist)
        -   `guest-layout.blade.php`: (Lihat di Gist)
        -   `card.blade.php`: (Lihat di Gist)
        -   `input.blade.php`: (Lihat di Gist)
        -   `label.blade.php`: (Lihat di Gist)
        -   `button.blade.php`: (Lihat di Gist)
        -   `dropdown-header.blade.php`: (Lihat di Gist)
        -   `dropdown-link.blade.php`: (Lihat di Gist)
        -   `textarea.blade.php`: (Lihat di Gist)
    3.  Anda bisa mendapatkan kode untuk semua komponen ini melalui Gist berikut: [https://gist.github.com/fajar-kw/9a8f1e6b0e5c1e8b9c4a9e5e3b4c9e](https://gist.github.com/fajar-kw/9a8f1e6b0e5c1e8b9c4a9e5e3b4c9e)

### 3. Tombol atau Form Tidak Berfungsi

-   **Gejala:** Tombol dropdown, dark mode, atau tombol submit tidak merespons saat diklik.
-   **Penyebab:** Aset frontend (JavaScript dan CSS) tidak dimuat dengan benar. Ini bisa terjadi jika `npm run dev` tidak berjalan atau ada error JavaScript di console browser.
-   **Solusi:**
    1.  Pastikan Anda menjalankan `npm install` terlebih dahulu.
    2.  Jalankan `npm run dev` di terminal dan biarkan prosesnya berjalan.
    3.  Jika masih tidak berfungsi, buka **Developer Tools** di browser (tekan F12) dan lihat tab **Console**. Cari pesan error merah dan perbaiki sesuai petunjuk.
    4.  Jalankan `php artisan optimize:clear` dan refresh browser dengan **hard refresh** (`Ctrl + Shift + R`).

## 👤 Akun Default

Setelah instalasi, Anda dapat login menggunakan akun berikut:

**Admin:**
-   Email: `admin@stie.com`
-   Password: `password`

**Mahasiswa:**
-   Anda bisa membuat akun mahasiswa melalui menu "Kelola Mahasiswa" di dashboard Admin.

## 📄 Lisensi

Proyek ini dilisensikan di bawah Lisensi MIT. Lihat file [LICENSE](LICENSE) untuk detail lebih lanjut.
```
