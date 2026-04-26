<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 🌱 AgriSmart – Laravel Project

Project ini merupakan aplikasi berbasis **Laravel** untuk sistem manajemen pertanian **AgriSmart**.  
Dokumen ini berisi panduan lengkap untuk menjalankan project setelah Anda melakukan *clone repository*.

---

##  --Persyaratan Sistem--
Sebelum memulai, pastikan perangkat Anda sudah terinstall:
- **PHP** ≥ 8.1
- **Composer**
- **MySQL / MariaDB**
- **Git**

---

##  --Panduan Instalasi (Step by Step)--

### #1️ Clone Repository
Buka terminal dan jalankan perintah berikut:
```bash
git clone https://github.com/ZDaffa83/Prediksi-HasilPanen.git
cd Prediksi-HasilPanen

```

### #2️ Instalasi Dependency

Instal semua package yang dibutuhkan menggunakan Composer:

```bash
composer install

```

### #3️ Konfigurasi Environment

Salin file `.env.example` menjadi `.env`, lalu edit db_connection "sqlite" menjadi "mysql", dan db_database "laravel" menjadi nama database yg anda mau

```bash
cp .env.example .env

```
*Jangan lupa sesuaikan `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` di dalam file `.env`. jika punya anda diubah dari versi standa nya*

### #4 Key Generate, Migrate, Seeding biar bisa dipakai

Jalankan perintah berikut untuk mengamankan aplikasi dan membuat struktur tabel:

```bash
php artisan key:generate
php artisan migrate

```
```bash
php artisan db:seed
php artisan db:seed --class=AdminUserSeeder
php artisan db:seed --class=PanenSeeder
php artisan db:seed --class=RiwayatTanamSeeder

```

---

Terakhir, tinggal jalankan website dengan :

```bash
php artisan serve

```
web bisa diakses melalui browser di: `http://127.0.0.1:8000`

---

## 📄 License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

```
