
# Sistem Informasi Pendaftaran Calon Pegawai

Sistem informasi berbasis web untuk mengelola proses pendaftaran dan rekrutmen calon pegawai.

## Developer

**AWLXDEV**

Copyright (c) 2026 AWLXDEV. All Rights Reserved.

Developed and maintained by AWLXDEV.

## Teknologi

- Laravel 12
- PHP
- MariaDB / MySQL
- Blade
- Bootstrap
- JavaScript
- Composer
- NPM

## Fitur Utama

- Autentikasi pengguna
- Registrasi dan verifikasi email
- Role-based access control
- Dashboard Admin
- Dashboard HRD
- Dashboard Pelamar
- Manajemen pengguna
- Manajemen lowongan pekerjaan
- Pendaftaran lamaran pekerjaan
- Manajemen data pelamar
- Seleksi administrasi
- Verifikasi dokumen pelamar
- Pengelolaan profil pelamar

## Instalasi

### 1. Clone repository

```bash
git clone https://github.com/awalharbel/PENDAFTARAN_CALON_PEGAWAI.git
cd PENDAFTARAN_CALON_PEGAWAI
```

### 2. Install dependencies

```bash
composer install
npm install
```

### 3. Konfigurasi environment

```bash
cp .env.example .env
php artisan key:generate
```

Sesuaikan konfigurasi database dan email pada file `.env`.

### 4. Migrasi database

```bash
php artisan migrate
```

### 5. Jalankan aplikasi

Terminal pertama:

```bash
php artisan serve
```

Terminal kedua:

```bash
npm run dev
```

Buka:

http://127.0.0.1:8000

## Lisensi

Project ini menggunakan MIT License.

Lihat file [LICENSE](LICENSE) untuk informasi selengkapnya.

Copyright (c) 2026 AWLXDEV.
