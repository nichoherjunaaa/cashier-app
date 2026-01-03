# 🧾 Aplikasi Manajemen Transaksi Kasir  
Laravel + Vite + TailwindCSS

Aplikasi Manajemen Transaksi Kasir adalah sistem berbasis web yang dibangun menggunakan framework **Laravel** untuk membantu proses pencatatan transaksi penjualan, pengelolaan stok barang, serta penyajian laporan penjualan secara periodik dalam bentuk tabel dan grafik (chart).

Aplikasi ini ditujukan untuk toko, UMKM, maupun pembelajaran pengembangan aplikasi berbasis Laravel.

---

## 🚀 Fitur Utama

### 📦 Manajemen Barang
- Tambah barang
- Lihat daftar barang
- Update dan monitoring stok barang

### 💰 Manajemen Transaksi
- Input transaksi penjualan
- Perhitungan total otomatis
- Pencatatan uang masuk
- Riwayat transaksi

### 📊 Laporan & Analitik
- Laporan transaksi:
  - Harian
  - Mingguan
  - Bulanan
- Visualisasi data menggunakan chart
- Analisis barang terlaris
- Rekap total pendapatan

---

## 🛠️ Teknologi yang Digunakan

- PHP >= 8.x
- Laravel
- MySQL / MariaDB
- Blade Template Engine
- TailwindCSS
- Vite
- NPM
- Chart.js

---

## 📂 Struktur Fitur

Aplikasi Kasir
├── Barang
│ ├── Tambah Barang
│ ├── Lihat Barang
│ └── Stok Barang
├── Transaksi
│ ├── Input Transaksi
│ ├── Riwayat Transaksi
│ └── Uang Masuk
├── Laporan
│ ├── Harian
│ ├── Mingguan
│ ├── Bulanan
│ └── Chart
└── Analitik
└── Barang Terlaris


---

## ⚙️ Persyaratan Sistem

- PHP >= 8.x
- Composer
- Node.js & NPM
- MySQL / MariaDB
- Git

---

````md
## 🔧 Instalasi & Konfigurasi

### 1. Clone Repository
```bash
git clone https://github.com/username/nama-repository.git
cd nama-repository
````

### 2. Install Dependency Backend

```bash
composer install
```

### 3. Konfigurasi Environment

```bash
cp .env.example .env
```

Edit file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cashier_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Database Migration

```bash
php artisan migrate
```

### 6. Install Dependency Frontend

```bash
npm install
```

### 7. Running Vite

```bash
npm run dev
```

### 8. Running Laravel Server

```bash
php artisan serve
```

Akses aplikasi melalui browser:

```
http://127.0.0.1:8000
```

```