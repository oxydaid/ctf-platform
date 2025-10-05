<div align="center">
  <h1 align="center">🚀 CTF Platform Laravel</h1>
  <p align="center">
    Sebuah platform <i>Capture The Flag</i> (CTF) yang dibangun dengan Laravel, Filament, dan Livewire. Didesain untuk komunitas, universitas, atau siapa saja yang ingin menyelenggarakan kompetisi keamanan siber.
  </p>
</div>

<br>

![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php)
![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel)
![Filament](https://img.shields.io/badge/Filament-3.x-F59E0B?style=for-the-badge)
![Livewire](https://img.shields.io/badge/Livewire-3.x-4E56A6?style=for-the-badge)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4-38B2AC?style=for-the-badge&logo=tailwind-css)

---

## ✨ Fitur Utama

* **👨‍💻 Multi-User**: Mendukung banyak pengguna yang bisa mendaftar dan berpartisipasi.
* **🛡️ Admin Dashboard**: Panel admin yang powerful dibangun dengan **Filament**, memudahkan manajemen soal, user, kategori, dan submission.
* **🧩 Manajemen Soal**: CRUD (Create, Read, Update, Delete) lengkap untuk soal CTF dengan kategori, poin, dan tingkat kesulitan.
* **💯 Sistem Poin**: Poin otomatis diberikan kepada user yang berhasil menyelesaikan soal.
* **📊 Leaderboard**: Halaman peringkat untuk melihat siapa yang unggul berdasarkan poin atau jumlah soal yang diselesaikan.
* **🎨 Tampilan Modern**: Antarmuka yang bersih dan responsif menggunakan Livewire dan Tailwind CSS.

---

## 🛠️ Instalasi

Berikut adalah panduan untuk menginstal proyek ini di lingkungan produksi.

### Opsi 1: Instalasi di VPS (Direkomendasikan)

Metode ini memberikan Anda kontrol penuh dan performa terbaik. Pastikan VPS Anda sudah terinstal **PHP 8.2+**, **Composer 2**, **Git**, dan **Database Server (MySQL/MariaDB)**.

1.  **Clone Repositori**
    Buka terminal di VPS Anda, masuk ke direktori web Anda (misal: `/var/www`), lalu clone repositori ini.
    ```bash
    git clone [https://github.com/oxydaid/ctf-platform.git](https://github.com/oxydaid/ctf-platform.git)
    cd ctf-platform
    ```

2.  **Install Dependencies**
    Install semua package PHP yang dibutuhkan menggunakan Composer.
    ```bash
    composer install --no-dev --optimize-autoloader
    ```

3.  **Konfigurasi Environment**
    Salin file `.env.example` menjadi `.env` dan generate kunci aplikasi.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Edit File `.env`**
    Buka file `.env` dengan editor teks (seperti `nano` atau `vim`) dan sesuaikan bagian-bagian penting, terutama koneksi database.
    ```env
    APP_NAME="CTF Platform"
    APP_ENV=production
    APP_DEBUG=false
    APP_URL=[https://domain-anda.com](https://domain-anda.com)

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_anda
    DB_USERNAME=user_database_anda
    DB_PASSWORD='password_database_anda'
    ```

5.  **Jalankan Migrasi & Seeder**
    Perintah ini akan membuat semua tabel yang dibutuhkan di database dan mengisi data awal (jika ada seeder).
    ```bash
    php artisan migrate --seed
    ```

6.  **Konfigurasi Web Server**
    Pastikan *document root* pada konfigurasi Nginx atau Apache Anda mengarah ke direktori `/public`. Jangan lupa atur kepemilikan dan perizinan file agar server bisa menulis ke folder `storage` dan `bootstrap/cache`.

---

### Opsi 2: Instalasi di cPanel / Shared Hosting

Metode ini bisa sedikit lebih rumit karena keterbatasan akses.

1.  **Siapkan File Proyek**
    * Di komputer lokal Anda, jalankan `composer install --no-dev` untuk menginstal dependensi.
    * Kompres seluruh folder proyek Anda menjadi satu file `.zip`. **Pastikan folder `vendor` ikut terkompres**.

2.  **Upload & Ekstrak**
    * Login ke cPanel, buka **File Manager**.
    * Upload file `.zip` ke direktori root Anda (misal: di luar `public_html`).
    * Ekstrak file `.zip` tersebut.

3.  **Pindahkan Folder `public`**
    * Masuk ke folder hasil ekstraksi.
    * Pindahkan **semua isi** dari folder `public` ke dalam folder `public_html`.

4.  **Edit `index.php`**
    * Di dalam `public_html`, buka file `index.php`.
    * Ubah dua baris path berikut agar mengarah ke folder proyek Anda yang berada di luar `public_html`.
    ```php
    // Ganti '../bootstrap' menjadi '/home/usercpanel/nama_folder_proyek/bootstrap'
    require __DIR__.'/../bootstrap/autoload.php';
    
    // Ganti '../bootstrap' menjadi '/home/usercpanel/nama_folder_proyek/bootstrap'
    $app = require_once __DIR__.'/../bootstrap/app.php';
    ```

5.  **Buat Database**
    * Di cPanel, buka **"MySQL® Database Wizard"**.
    * Ikuti langkah-langkah untuk membuat database baru, user database, dan memberikan semua hak akses (*All Privileges*) kepada user tersebut. Catat nama database, username, dan password.

6.  **Edit File `.env`**
    * Kembali ke File Manager, masuk ke folder proyek Anda.
    * Salin `.env.example` menjadi `.env`.
    * Edit file `.env` dan masukkan informasi database yang baru saja Anda buat.

7.  **Jalankan Migrasi**
    * Cari fitur **"Terminal"** di cPanel.
    * Masuk ke direktori proyek Anda (`cd nama_folder_proyek`).
    * Jalankan perintah migrasi:
    ```bash
    php artisan migrate --seed
    ```
    Jika Terminal tidak tersedia, Anda mungkin perlu mengimpor database secara manual melalui **phpMyAdmin**.

---

## 🔑 Akun Admin & Login

Setelah menjalankan perintah `migrate --seed`, sebuah akun Super Admin akan dibuat secara otomatis. Gunakan kredensial berikut untuk login pertama kali.

* **URL:** `/admin`
* **Email:** `admin@gmail.com`
* **Password:** `password`

**PENTING**: Demi keamanan, segera ganti password default setelah Anda berhasil login untuk pertama kalinya!
