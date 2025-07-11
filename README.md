# Ramean.id - Platform Patungan Akun Premium

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

## 🚀 Tech Stack

Proyek ini dibangun menggunakan teknologi modern yang andal dan skalabel.

### Backend
* **PHP 8.2+**
* **Laravel 12**: Framework utama untuk membangun aplikasi.
* **Filament 3**: Digunakan untuk membuat panel admin yang cantik dan fungsional dengan cepat.
* **SQLite**: Database *default* untuk kemudahan setup di lingkungan pengembangan.

### Frontend
* **Vite**: *Build tool* modern untuk kompilasi aset frontend yang sangat cepat.
* **Tailwind CSS**: Framework CSS *utility-first* untuk membangun antarmuka pengguna yang kustom dan responsif.
* **Alpine.js**: Framework JavaScript minimalis untuk menambahkan interaktivitas pada antarmuka, seperti *dark mode*, *dropdown*, dan kalkulasi harga dinamis.

## ✨ Fitur Utama

Aplikasi Ramean.id memiliki serangkaian fitur lengkap yang mencakup kebutuhan pengguna dan administrator.

### Fitur untuk Pengguna
1.  **Halaman Utama (Landing Page)**:
    * Menampilkan *hero section*, keunggulan layanan, produk unggulan, alur pemesanan, dan kontak.
    * Desain yang bersih dan responsif.

2.  **Katalog Produk**:
    * Halaman daftar produk dengan tata letak kartu yang minimalis.
    * Fitur pencarian dan filter berdasarkan kategori.

3.  **Halaman Detail Produk Dinamis**:
    * Menampilkan detail produk dengan skema harga patungan yang interaktif.
    * Pengguna bisa memilih jumlah anggota grup, dan harga akan menyesuaikan secara otomatis.

4.  **Wishlist (Daftar Favorit)**:
    * Pengguna dapat menambah atau menghapus produk dari *wishlist* secara instan tanpa *refresh* halaman.
    * Halaman khusus untuk melihat semua produk yang ada di *wishlist*.

5.  **Keranjang Belanja (Cart)**:
    * Fungsi untuk menambah, mengubah kuantitas, dan menghapus produk dari keranjang.
    * Penerapan kupon diskon untuk mengurangi total belanja.

6.  **Proses Checkout**:
    * Meminta nomor WhatsApp untuk konfirmasi pesanan.
    * Sistem pembayaran menggunakan QRIS yang ditampilkan di halaman.

7.  **Riwayat Pesanan**:
    * Pengguna dapat melihat daftar semua pesanan yang pernah mereka buat beserta statusnya.

8.  **Halaman Statis**:
    * Halaman **FAQ** dengan desain akordeon yang interaktif.
    * Halaman **About Us** untuk menjelaskan visi dan misi Ramean.id.

### Fitur untuk Admin (Panel Filament)
1.  **Manajemen Pengguna**: CRUD (*Create, Read, Update, Delete*) untuk semua pengguna yang terdaftar.
2.  **Manajemen Produk**: CRUD untuk produk yang dijual, termasuk mengunggah gambar logo.
3.  **Manajemen Kupon**: CRUD untuk membuat dan mengelola kupon diskon (nominal tetap atau persentase).
4.  **Panel Admin Terproteksi**: Hanya pengguna dengan status admin yang bisa mengakses panel.

## ⚙️ Cara Penggunaan & Instalasi Lokal

Berikut adalah langkah-langkah untuk menjalankan proyek ini di lingkungan pengembangan Anda.

1.  **Clone Repository**
    ```bash
    git clone [URL_REPOSITORY_ANDA]
    cd nama-direktori-proyek
    ```

2.  **Instal Dependensi**
    Pastikan Anda memiliki Composer dan NPM terinstal.
    ```bash
    # Instal dependensi PHP
    composer install

    # Instal dependensi JavaScript
    npm install
    ```

3.  **Konfigurasi Lingkungan**
    Salin file `.env.example` menjadi `.env`.
    ```bash
    cp .env.example .env
    ```
    Buat *application key* baru untuk proyek Anda.
    ```bash
    php artisan key:generate
    ```

4.  **Setup Database**
    Perintah ini akan membuat semua tabel yang dibutuhkan dan mengisinya dengan data awal (produk, kategori, dan akun admin).
    ```bash
    php artisan migrate:fresh --seed
    ```

5.  **Jalankan Server Pengembangan**
    Perintah ini akan menjalankan server PHP dan mengkompilasi aset frontend secara bersamaan.
    ```bash
    npm run dev
    ```

6.  **Akses Aplikasi**
    * **Situs Pengguna**: Buka `http://127.0.0.1:8000` di browser Anda.
    * **Panel Admin**: Buka `http://127.0.0.1:8000/1` (atau `/admin` jika Anda mengaturnya demikian).

7.  **Login Admin**
    Gunakan kredensial default yang sudah dibuat oleh *seeder*:
    * **Email**: `admin@example.com`
    * **Password**: `password`
