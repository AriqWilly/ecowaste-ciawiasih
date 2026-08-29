# KKM Desa — Sistem Informasi Pengelolaan Sampah & Katalog Daur Ulang Desa Ciawiasih

> Proyek Kerja Kuliah Mahasiswa (KKM) Individu — Program Studi Teknik Informatika  
> Universitas Muhammadiyah Cirebon (UMC) — Kelompok 36  
> Desa Ciawiasih, Kecamatan Ciawiasih, Kabupaten Ciamis, Jawa Barat

---

## Deskripsi Proyek

Sistem informasi berbasis web ini dibangun sebagai program kerja individu dalam rangka pelaksanaan KKM (Kuliah Kerja Mahasiswa) di **Desa Ciawiasih**. Platform ini menjadi wadah digital untuk mendukung kegiatan **edukasi pemilahan sampah**, **promosi produk daur ulang ekonomi sirkular**, dan **komunikasi publik** antara BUMDes/pengurus desa dengan warga secara transparan dan modern.

### Tujuan Utama
- Mendigitalisasi katalog produk daur ulang dan ekonomi sirkular hasil karya warga Desa Ciawiasih.
- Menyediakan media edukasi interaktif mengenai pemilahan sampah (organik, anorganik, dan B3).
- Membangun panel manajemen admin yang dapat dikelola secara mandiri oleh pengurus BUMDes dan Karang Taruna setelah kegiatan KKM berakhir.

---

## Fitur Unggulan

### Halaman Publik (Warga & Pengunjung)
| Halaman | Deskripsi |
|---|---|
| **Beranda** | Hero banner, pratinjau katalog produk, artikel edukasi terbaru, profil ringkas desa |
| **Katalog Produk** | Daftar produk daur ulang warga dengan pencarian, filter kategori, detail harga & stok |
| **Detail Produk** | Foto produk, deskripsi lengkap, info pengrajin, tombol pesan via WhatsApp |
| **Edukasi Sampah** | Artikel panduan pemilahan sampah: organik, anorganik, dan B3 |
| **Detail Edukasi** | Artikel lengkap dengan informasi kategori dan tanggal publikasi |
| **Tentang Kami** | Profil organisasi BUMDes, tim pengurus, dan mitra KKM Kelompok 36 UMC |
| **Kontak** | Formulir pengiriman pesan warga dengan proteksi Anti-Bot Captcha Matematika |

### Panel Admin (Pengurus Desa)
| Modul | Fitur |
|---|---|
| **Dashboard** | Ringkasan statistik (produk, artikel, pesan, kategori), aktivitas terkini |
| **Katalog Produk** | Tambah / Edit / Hapus produk beserta foto, harga, stok, dan deskripsi |
| **Kategori Sampah** | Kelola klasifikasi sampah (Organik, Anorganik, B3, dll.) |
| **Edukasi Sampah** | Tambah / Edit / Hapus artikel edukasi dengan status draft/terbit |
| **Tim & Mitra** | Manajemen profil pengurus BUMDes dan tim mitra KKM |
| **Pesan Masuk** | Kotak pesan warga dengan notifikasi lonceng (🔔) real-time, tandai baca/hapus |
| **Pengaturan** | Info profil desa, kontak WhatsApp resmi, media sosial |
| **Profil Akun** | Ganti nama, email, dan kata sandi admin secara mandiri |

---

## Teknologi yang Digunakan

| Teknologi | Versi | Peran |
|---|---|---|
| **PHP** | 8.3.23 | Bahasa pemrograman utama server |
| **Laravel** | 13.24.0 | Framework MVC utama (routing, ORM, auth) |
| **MySQL** | 8.x | Database relasional |
| **Tailwind CSS** | 3.x | Framework CSS utility-first responsif |
| **Alpine.js** | 3.x | Interaktivitas UI (sidebar, dropdown, modal) |
| **Vite** | 6.x | Asset bundler & hot-reload development |
| **Laragon** | — | Lingkungan pengembangan lokal (Windows) |

---

## Panduan Instalasi (Lokal / Development)

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js >= 18 & NPM
- MySQL / MariaDB
- Laragon atau XAMPP (opsional, direkomendasikan)

### Langkah Instalasi

```bash
# 1. Clone repositori
git clone https://github.com/username/KKM-desa.git
cd KKM-desa

# 2. Install dependency PHP
composer install

# 3. Install dependency JavaScript
npm install

# 4. Salin file konfigurasi environment
cp .env.example .env

# 5. Generate application key
php artisan key:generate
```

### Konfigurasi Database
Edit file `.env` dan sesuaikan dengan konfigurasi database lokal Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=katalog_desa_ciawiasih
DB_USERNAME=root
DB_PASSWORD=
```

### Migrasi & Seeder Database
```bash
# Jalankan migrasi dan data awal
php artisan migrate --seed
```

> **Akun Admin Default** yang dibuat oleh seeder:
> - **Email:** `admin@ciawiasih.desa.id`
> - **Password:** `password123`
>
> Segera ganti password melalui menu **Profil Akun & Kata Sandi** setelah login pertama kali.

### Menjalankan Aplikasi

```bash
# Terminal 1 — Jalankan server Laravel
php artisan serve

# Terminal 2 — Kompilasi aset CSS/JS (development mode)
npm run dev
```

Akses aplikasi di browser: **http://localhost:8000**  
Panel admin: **http://localhost:8000/admin/dashboard**

---

## Struktur Direktori Penting

```
KKM-desa/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # Controller panel admin
│   │   ├── Auth/           # Controller autentikasi
│   │   └── Public/         # Controller halaman publik
│   ├── Models/             # Model Eloquent ORM
│   └── Services/           # Logika bisnis (ProductService, dll.)
├── database/
│   ├── migrations/         # Skema tabel database
│   └── seeders/            # Data awal (admin, settings, kategori)
├── resources/views/
│   ├── admin/              # Template blade panel admin
│   │   ├── dashboard.blade.php
│   │   ├── katalog/
│   │   ├── edukasi/
│   │   ├── kategori/
│   │   ├── tim/
│   │   ├── pesan/
│   │   └── pengaturan/
│   ├── public/             # Template blade halaman publik
│   │   ├── home.blade.php
│   │   ├── katalog/
│   │   ├── edukasi/
│   │   ├── about.blade.php
│   │   └── contact.blade.php
│   └── components/
│       └── admin-layout.blade.php  # Layout utama admin (sidebar, header)
├── routes/
│   ├── web.php             # Rute halaman publik & auth
│   └── admin.php           # Rute panel admin (dilindungi middleware auth)
└── public/storage/         # File upload (foto produk, tim, dll.)
```

---

## Skema Database Utama

| Tabel | Deskripsi |
|---|---|
| `users` | Akun admin pengelola |
| `products` | Data produk katalog daur ulang |
| `categories` | Kategori jenis sampah/produk |
| `educations` | Artikel edukasi pemilahan sampah |
| `teams` | Profil tim pengurus dan mitra |
| `contacts` | Pesan masuk dari warga |
| `settings` | Pengaturan informasi desa (kontak WA, medsos, dll.) |

---

## Akses URL Penting

| URL | Keterangan |
|---|---|
| `/` | Halaman beranda publik |
| `/katalog` | Daftar produk daur ulang |
| `/edukasi` | Artikel edukasi sampah |
| `/tentang-kami` | Profil desa & tim pengurus |
| `/kontak` | Formulir pesan warga |
| `/login` | Halaman login admin |
| `/admin/dashboard` | Dashboard panel admin |
| `/admin/katalog` | Manajemen katalog produk |
| `/admin/edukasi` | Manajemen artikel edukasi |
| `/admin/pesan` | Kotak pesan masuk warga |
| `/admin/pengaturan` | Pengaturan sistem & profil akun |

---

## Developer

| Info | Detail |
|---|---|
| **Nama** | Ariq Willy Syauqi |
| **Program Studi** | Teknik Informatika |
| **Universitas** | Universitas Muhammadiyah Cirebon (UMC) |
| **Kegiatan** | KKM (Kuliah Kerja Mahasiswa) |
| **Lokasi KKM** | Desa Ciawiasih, Kab. Ciamis, Jawa Barat |
| **Kelompok** | Kelompok 36 (Fokus: Pengelolaan Sampah Organik) |

---

## Lisensi

Proyek ini dikembangkan untuk kepentingan pengabdian masyarakat dalam rangka KKM UMC.  
Hak cipta pengembangan sistem © 2026 Ariq Willy Syauqi — Teknik Informatika UMC.
