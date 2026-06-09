# PustakaKita — Sistem Manajemen Perpustakaan

Aplikasi web manajemen perpustakaan berbasis **Laravel** (kerangka asli tidak diubah, hanya ditambah fitur). Memenuhi ketentuan UAP: framework Laravel, autentikasi (register/login/logout), dan CRUD lengkap dengan relasi.

## Fitur

- **Autentikasi**: register, login, logout (dibuat manual tanpa paket tambahan agar kerangka tetap utuh).
- **Role-Based Access Control**: `admin` dan `anggota`.
  - Admin: kelola Buku, Kategori, dan menandai pengembalian.
  - Anggota: melihat & meminjam buku, melihat riwayat pinjaman.
- **CRUD + relasi**: Kategori → Buku → Peminjaman (relasi belongsTo/hasMany).
- **Manajemen file**: upload sampul buku (validasi gambar, maks 2MB).
- **Optimisasi query**: eager loading (`with`, `withCount`) untuk menghindari N+1.
- **Tema navy** sesuai desain Figma, dibangun dengan Tailwind CSS v4.

## Stack

- Laravel 13 (PHP 8.3)
- Database: SQLite (default kerangka)
- Tailwind CSS v4 + Vite

## Cara Menjalankan (Laragon / lokal)

```bash
# 1. Install dependency PHP
composer install

# 2. Salin environment (APP_KEY sudah tersedia di .env bawaan; jika perlu)
# cp .env.example .env
# php artisan key:generate

# 3. Jalankan migrasi + seeder (membuat data contoh + akun admin)
php artisan migrate --seed

# 4. Symlink storage agar sampul buku tampil
php artisan storage:link

# 5. Install dependency front-end & build asset
npm install
npm run dev      # mode development
# atau: npm run build  untuk produksi

# 6. Jalankan server (jika tidak lewat Laragon)
php artisan serve
```

Buka `http://localhost:8000` (atau domain Laragon kamu).

## Akun Demo (dari seeder)

| Role    | Email                | Password |
|---------|----------------------|----------|
| Admin   | admin@perpus.test    | password |
| Anggota | anggota@perpus.test  | password |

## Struktur yang Ditambahkan

- `app/Models/`: `Category`, `Book`, `Loan` (+ `User` ditambah `role` & relasi)
- `app/Http/Controllers/`: `Auth/RegisteredUserController`, `Auth/AuthenticatedSessionController`, `DashboardController`, `CategoryController`, `BookController`, `LoanController`
- `app/Http/Middleware/AdminMiddleware.php` (alias `admin`)
- `database/migrations/`: role, categories, books, loans
- `database/seeders/DatabaseSeeder.php`
- `resources/views/`: layouts, auth, dashboard, books, categories, loans
- `resources/css/app.css`: palet warna brand navy

> Kerangka asli (config, public, bootstrap, dsb.) dipertahankan. Perubahan pada `bootstrap/app.php` hanya menambah pendaftaran alias middleware `admin`, dan `User.php` hanya menambah kolom `role` & relasi.
