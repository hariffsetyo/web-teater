# 🎭 Website Ekstrakurikuler "Teater Siklus"

Website resmi ekstrakurikuler Teater Sekolah berbasis **Laravel 11**, **Tailwind CSS**, **Livewire 3**, dan **Alpine.js** dengan tema dramatis *"Panggung & Tirai Teater"* (Palet Beludru Maroon, Emas, dan Hitam Panggung).

---

## 🚀 Panduan Menjalankan Projek (Untuk Rekan Tim / Teman)

Ikuti langkah-langkah di bawah ini untuk menjalankan projek ini di komputer lokal Anda:

### 1. Prasyarat Lingkungan
- **PHP** >= 8.2 (dengan ekstensi `pdo_mysql`, `mbstring`, `fileinfo`, `gd` aktif)
- **Composer** (Package Manager PHP)
- **Node.js** & **NPM** (versi LTS 18+)
- **MySQL / MariaDB** (melalui Laragon, XAMPP, atau MySQL Server lokal)

---

### 2. Langkah Instalasi Cepat

#### A. Clone Repository
```bash
git clone <URL_REPOSITORY_GITHUB_ANDA>
cd WebTeater
```

#### B. Install Dependensi PHP & JavaScript
```bash
composer install
npm install
npm run build
```

#### C. Konfigurasi File Lingkungan (`.env`)
Salin file `.env.example` menjadi `.env`:

**Windows (PowerShell / CMD):**
```powershell
copy .env.example .env
```
**Linux / macOS:**
```bash
cp .env.example .env
```

Lalu generate Application Key Laravel:
```bash
php artisan key:generate
```

Pastikan konfigurasi database di file `.env` sudah sesuai dengan MySQL lokal Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=teater_sekolah
DB_USERNAME=root
DB_PASSWORD=
```

---

### 3. Setup Database & Data Awal (Dua Pilihan)

Pastikan Anda sudah membuat database kosong bernama `teater_sekolah` di MySQL (bisa melalui **HeidiSQL**, **phpMyAdmin**, atau terminal `mysql -u root -e "CREATE DATABASE teater_sekolah;"`).

Pilih salah satu cara berikut untuk mengisi tabel dan data:

#### Cara 1: Menggunakan Migrations & Seeders Laravel (Rekomendasi ⭐)
Perintah ini akan membuat seluruh 19 tabel dan mengisinya dengan ~300 data dummy realistis (anggota, artikel, tiket, agenda pementasan, podcast, testimoni, dll):
```bash
php artisan migrate --seed
```

#### Cara 2: Menggunakan File Dump SQL Langsung
File snapshot database utuh sudah disertakan di dalam repository: `database/teater_sekolah.sql`.
Anda bisa mengimpornya langsung melalui phpMyAdmin atau via terminal:
```bash
mysql -u root teater_sekolah < database/teater_sekolah.sql
```

---

### 4. Buat Symlink Storage Publik
Agar seluruh berkas gambar dan upload dapat diakses oleh browser:
```bash
php artisan storage:link
```

---

### 5. Jalankan Web Server
Jalankan server pengembangan Laravel:
```bash
php artisan serve
```

Buka peramban (browser) dan akses:
- **Halaman Publik:** [http://127.0.0.1:8000](http://127.0.0.1:8000)
- **Panel Admin:** [http://127.0.0.1:8000/admin/login](http://127.0.0.1:8000/admin/login)

---

## 🔑 Kredensial Masuk Admin
- **URL Login:** `/admin/login`
- **Email:** `admin@teater.sch.id`
- **Password:** `Admin1234!`

---

## 📁 Struktur Fitur Unggulan
1. **Beranda Interaktif**: Animasi tirai panggung terbuka, typewriter naskah panggung, hitung mundur pementasan, masonry galeri.
2. **Publik**:
   - `/tentang`: Sejarah ekskul, struktur organisasi, direktori anggota reaktif dengan filter divisi.
   - `/event`: Jadwal pementasan & kalender interaktif.
   - `/galeri`: Lightbox foto & integrasi video pementasan.
   - `/artikel`: Blog/esai teater, estimasi waktu baca, kolom komentar ber-moderasi.
   - `/prestasi`: Etalase piala festival teater berjenjang.
   - `/gabung`: Formulir wizard pendaftaran audisi 3 langkah dengan upload audio/video.
   - `/tiket`: Reservasi tiket kursi dengan pencegahan *race-condition*, QR code SVG, & unduh e-tiket PDF.
   - `/podcast`: Audio player mengambang dengan pengatur kecepatan, scrubber bar, & visualizer.
   - `/kuis`: Kuis interaktif Alpine.js kecocokan divisi seni teater.
3. **Panel Admin (`/admin`)**:
   - Dashboard analitik 6 kartu statistik & 4 grafik interaktif Chart.js.
   - CRUD Anggota, Agenda Event, Galeri, Artikel (Trix Editor), Prestasi, Testimonial, dan Lakon/Tiket Pementasan.
   - Auto-resize gambar otomatis & pembersihan berkas lama.
