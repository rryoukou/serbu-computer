# Serbu Computer 💻✨

**Serbu Computer** adalah platform e-commerce modern berbasis web yang dirancang khusus untuk manajemen penjualan perangkat komputer, laptop, dan aksesoris. Proyek ini dibangun menggunakan **Laravel 12** dengan fokus pada keamanan, performa tinggi, dan pengalaman pengguna yang premium.

---

## 🚀 Fitur Utama

### 🛒 Area Pengguna (Customer)
*   **Katalog Interaktif**: Penjelajahan produk dengan filter pencarian yang responsif.
*   **Manajemen Wishlist**: Simpan produk favorit Anda ke daftar "Favorite" untuk dibeli nanti.
*   **Sistem Checkout**: Proses pemesanan produk yang terintegrasi.
*   **Riwayat Pesanan**: Pantau status pesanan (Pending, Processing, Completed) dan fitur pembatalan.
*   **Manajemen Profil**: Atur informasi pribadi, alamat, hingga foto profil dengan mudah.

### 🛡️ Area Administrator
*   **Keamanan Akses**: Login admin menggunakan URL khusus yang diamankan untuk mencegah akses yang tidak diinginkan.
*   **Statistik Dashboard**: Grafik dan ringkasan data penjualan, total produk, serta jumlah pengguna.
*   **Manajemen Produk (CRUD)**: Kontrol penuh terhadap data produk, gambar, harga, dan stok.
*   **Manajemen Pesanan**: Update status pesanan secara real-time dan buat pesanan manual.
*   **Moderasi Pengguna**: Fitur untuk memberikan status *Ban/Unban* pada akun pengguna yang melanggar ketentuan.

---

## 🛠️ Stack Teknologi

| Komponen | Teknologi |
| :--- | :--- |
| **Framework Utama** | [Laravel 12.x](https://laravel.com/) |
| **Bahasa Pemrograman** | PHP 8.2+ |
| **Frontend Styling** | [Tailwind CSS 4.x](https://tailwindcss.com/) & Vite |
| **Database** | MySQL |
| **Autentikasi** | Laravel Starter Kit |
| **Containerization** | Docker & Caddy Server |

---

## 📦 Instalasi & Setup

### Langkah Cepat (Rekomendasi)
Jika Anda memiliki `make` terinstal di sistem Anda, jalankan perintah berikut:
```bash
make local
```

### Langkah Manual
1.  **Clone Repositori**:
    ```bash
    git clone https://github.com/username/serbu-computer.git
    cd serbu-computer
    ```
2.  **Instal Dependensi**:
    ```bash
    composer install
    npm install
    ```
3.  **Konfigurasi Environment**:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
4.  **Siapkan Database (MySQL)**:
    ```bash
    touch database/database.mysql
    php artisan migrate --seed
    ```
5.  **Jalankan Aplikasi**:
    ```bash
    npm run dev
    php artisan serve
    ```

---

## 📂 Struktur Proyek

Aplikasi ini mengikuti arsitektur standar Laravel dengan pembagian folder sebagai berikut:

```text
serbu-computer/
├── app/
│   ├── Http/Controllers/    # Logika bisnis (Web & API)
│   ├── Models/              # Definisi skema data (Database)
│   └── Providers/           # Konfigurasi servis framework
├── bootstrap/               # Inisialisasi framework & cache
├── config/                  # Pengaturan modul aplikasi
├── database/
│   ├── factories/           # Generator data otomatis
│   ├── migrations/          # Struktur tabel database
│   └── seeders/             # Data awal untuk testing
├── public/                  # Titik masuk aplikasi & aset publik
├── resources/
│   ├── css/ & js/           # Source aset frontend (Tailwind/Vite)
│   └── views/               # Template tampilan (Blade)
├── routes/
│   ├── web.php.example      # Contoh rute (Harus disalin ke web.php)
│   └── console.php          # Perintah CLI artisan kustom
├── storage/                 # Log aplikasi & file upload (Ignored)
└── tests/                   # Fitur pengujian otomatis
```

### Penjelasan Folder Utama:
*   **`app/`**: Jantung dari aplikasi Anda, tempat Controller dan Model berada.
*   **`routes/`**: Tempat mendaftarkan semua alamat URL. Gunakan `web.php.example` sebagai panduan setup.
*   **`database/`**: Sangat penting untuk setup awal. Jalankan migration dan seeder dari sini untuk mengisi data.
*   **`resources/views/`**: Tempat Anda mengelola tampilan antarmuka (UI).

---

## 🔐 Catatan Penting
*   **Akses Admin**: Untuk alasan keamanan, login admin tidak berada di path standar (`/admin`). Pengembang harus menggunakan URL kustom yang telah dikonfigurasi.
*   **Simulasi Order**: Terdapat fitur `simulate-expired` di menu riwayat untuk pengujian logika *timeout* pesanan.

---

&copy; 2026 **Bismillah Team**. Built with Laravel.
