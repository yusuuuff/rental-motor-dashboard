# 🚀 Rental Motor Dashboard

Aplikasi Rental Motor berbasis PHP Native dan MySQL yang memungkinkan admin mengelola data motor, transaksi penyewaan, serta memantau status ketersediaan motor secara real-time.

## 📸 Preview

Tambahkan screenshot aplikasi di sini setelah project selesai.

## ✨ Fitur

### Authentication

* Login Admin
* Logout Admin
* Session Management

### Dashboard

* Total Data Motor
* Total Transaksi
* Statistik Penyewaan

### Manajemen Motor

* Tambah Motor
* Lihat Data Motor
* Edit Data Motor
* Hapus Data Motor
* Status Motor (Tersedia / Disewa)

### Manajemen Transaksi

* Tambah Transaksi
* Perhitungan Total Harga Otomatis
* Status Transaksi (Aktif / Selesai)
* Penyelesaian Transaksi
* Update Status Motor Otomatis

## 🛠️ Teknologi

* PHP Native
* MySQL
* PDO (PHP Data Objects)
* Bootstrap 5
* HTML5
* CSS3
* JavaScript

## 📂 Struktur Project

```bash
rental-motor-dashboard/
│
├── auth/
├── config/
├── dashboard/
├── motor/
├── transaksi/
├── templates/
│
├── index.php
└── README.md
```

## ⚙️ Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/yusuuuff/rental-motor-dashboard.git
```

### 2. Pindahkan ke Folder htdocs

```text
C:\xampp\htdocs\rental-motor-dashboard
```

### 3. Import Database

* Buka phpMyAdmin
* Buat database baru

```sql
rental_motor
```

* Import file SQL

```text
database/rental_motor.sql
```

### 4. Konfigurasi Database

Edit file:

```php
config/koneksi.php
```

Sesuaikan konfigurasi:

```php
$host = "localhost";
$dbname = "rental_motor";
$username = "root";
$password = "";
```

### 5. Jalankan XAMPP

Aktifkan:

* Apache
* MySQL

### 6. Akses Aplikasi

```text
http://localhost/rental-motor-dashboard
```

## 👤 Akun Demo

### Admin

```text
Email    : admin@gmail.com
Password : admin123
```

(Sesuaikan dengan akun yang ada pada database.)

## 📚 Pembelajaran dari Project

Project ini dibuat untuk mempelajari:

* CRUD dengan PHP Native
* Authentication & Session
* Relasi Database MySQL
* PDO Prepared Statement
* Dashboard Management System
* Pengelolaan Transaksi
* Integrasi Frontend dan Backend

## 🎯 Pengembangan Selanjutnya

* Upload Gambar Motor
* Search dan Filter Data
* Pagination
* Export PDF
* Laporan Penyewaan
* Dashboard Statistik yang Lebih Lengkap
* Responsive Mobile Layout

## 👨‍💻 Developer

Dibuat oleh Yusuf sebagai bagian dari pengembangan portofolio Web Developer.
