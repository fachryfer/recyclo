# Bank Sampah Web (Laravel)

Aplikasi web untuk pengelolaan Bank Sampah berbasis Laravel.  
Fitur utama: manajemen nasabah, transaksi sampah, sistem poin, penukaran hadiah, dan laporan.

## Fitur Utama

-   Manajemen Nasabah, Petugas, dan Admin
-   Transaksi setor & tarik saldo
-   Sistem poin & penukaran hadiah
-   Laporan transaksi & saldo
-   Integrasi WhatsApp (jika ada)
-   Responsive & mobile friendly

## Instalasi

1. **Clone repository**

    ```
    git clone https://github.com/fachryfer/recyclo.git
    cd bank-sampah
    ```

2. **Install dependency**

    ```
    composer install
    npm install
    npm run dev
    ```

3. **Copy file environment**

    ```
    cp .env.example .env
    ```

4. **Generate key**

    ```
    php artisan key:generate
    ```

5. **Setup database**

    - Buat database `bank_sampah` di MySQL
    - Edit `.env` bagian DB sesuai konfigurasi lokal

6. **Migrasi & seeder**

    ```
    php artisan migrate --seed
    ```

7. **Jalankan server**
    ```
    php artisan serve
    ```

## Konfigurasi Tambahan

-   Untuk integrasi WhatsApp, isi variabel `WHATSAPP_API_KEY` dan `WHATSAPP_NUMBER` di file `.env`.

## Lisensi

MIT

---

Silakan copy-paste isi di atas ke file `.env.example` dan `README.md` di project kamu, lalu commit dan push ke GitHub!  
Jika ingin menambah variabel lain, tinggal tambahkan di `.env.example`.
