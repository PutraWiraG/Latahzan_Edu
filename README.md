# Latahzan Edu - Laravel Project

Selamat datang di repository Latahzan Edu, sebuah platform berbasis web yang menyediakan layanan les privat online. Proyek ini dibangun menggunakan Laravel.

## Persyaratan

Sebelum menggunakan proyek ini, pastikan kamu sudah menginstal persyaratan berikut:
- **PHP** >= 8.2
- **Composer**
- **MySQL** atau database lainnya

## Langkah-Langkah Setup

Berikut adalah langkah-langkah untuk meng-clone dan menjalankan proyek Laravel ini:

### 1. Clone Repository

Untuk mendapatkan salinan proyek di lokal, jalankan perintah berikut:

```bash
git clone https://github.com/PutraWiraG/Latahzan_Edu.git
```

### 2. Composer Install

Setelah berhasil menyalin proyek ini, maka buka proyek ini menggunakan cmd dan jalankan perintah berikut:

```bash
composer install
```

### 3. Konfigurasi Environment

Duplikasi file .env.example menjadi .env dan sesuaikan pengaturan environment tersebut seperti yang ada dibawah ini:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE={{sesuaikan}}
DB_USERNAME={{sesuaikan}}
DB_PASSWORD={{sesuaikan}}

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME={{sesuaikan}}
MAIL_PASSWORD={{sesuaikan}}
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS={{sesuaikan}}
MAIL_FROM_NAME="Latahzan Edu"

FILESYSTEM_DISK=public

MIDTRANS_SERVER_KEY={{sesuaikan}}
MIDTRANS_CLIENT_KEY={{sesuaikan}}
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
```

### 4. Generate APP KEY

Setelah environment variabel telah disesuaikan maka langkah selanjutnya yakni generate app key dengan menjalankan perintah berikut:

```bash
php artisan key:generate
```

### 5. Migrasi dan Seeder Database

Untuk membuat tabel database dan mengisi data awal, jalankan perintah berikut:

```bash
php artisan migrate --seed
```

### 6. Membuat Storage Link

Laravel menggunakan folder storage untuk menyimpan file seperti gambar atau dokumen. Untuk membuat symbolic link ke folder storage yang bisa diakses secara publik, jalankan perintah berikut:

```bash
php artisan storage:link
```

### 7. Jalankan Aplikasi

Terakhir yakni menjalankan aplikasi dengan menjalankan perintah berikut:

```bash
php artisan serve
```

## Fitur-Fitur pada Latahzan Edu
1. Pendaftaran Les Privat
2. Pembayaran dengan menggunakan Midtrans
3. Penjadwalan
