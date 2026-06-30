# Sistem Verifikasi Peserta Lelang (Laravel API)

Project ini adalah endpoint API untuk memverifikasi peserta lelang. Dibuat menggunakan **Laravel 11** dan **PostgreSQL** dengan menerapkan arsitektur clean code dan beberapa design pattern terbaik.

## 🚀 Fitur & Pola Arsitektur
- **Repository Pattern**: Memisahkan logika akses database dari controller dan service.
- **Service Layer Pattern**: Memisahkan business logic verifikasi peserta lelang secara terisolasi.
- **Database Transactions**: Menjamin konsistensi data jika terjadi kegagalan di tengah proses verifikasi.
- **Form Request Validation**: Validasi input payload JSON di gerbang awal request.
- **Auto-Generate PIN**: Generate 6-digit PIN acak jika peserta diterima (`BIDDING`).

---

## 🛠️ Persyaratan Sistem (Prerequisites)
Sebelum menjalankan project ini, pastikan device Anda sudah terinstall:
- PHP >= 8.2
- Composer
- Docker (untuk PostgreSQL)
- Postman (atau API Testing Tool sejenis)

---

## ⚙️ Cara Instalasi & Setup Project

### 1. Clone & Install Dependencies
Masuk ke direktori project Anda dan jalankan perintah:
```bash
composer install
```

### 2. Setup Database PostgreSQL via Docker
Jalankan PostgreSQL container menggunakan port host `5433`:
```bash
docker run --name lelang-postgres -e POSTGRES_DB=db_lelang_verifikasi -e POSTGRES_USER=postgres -e POSTGRES_PASSWORD=secret -p 5433:5432 -d postgres
```

### 3. Konfigurasi Environment File
Salin file `.env.example` menjadi `.env` dan sesuaikan koneksi database Anda:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5433
DB_DATABASE=db_lelang_verifikasi
DB_USERNAME=postgres
DB_PASSWORD=secret
```

### 4. Jalankan Migrasi & Database Seeder
Jalankan perintah ini untuk membuat tabel beserta data dummy peserta lelang:
```bash
php artisan migrate:fresh --seed
```

### 5. Jalankan Server Lokal
```bash
php artisan serve
```
Aplikasi akan berjalan di `http://127.0.0.1:8000`.

---

## 📖 Dokumentasi API Endpoint

### Verifikasi Peserta Lelang
- **Endpoint**: `/api/participant/verify`
- **Method**: `POST`
- **Headers**:
  - `Accept: application/json`
  - `Content-Type: application/json`

#### 1. Payload Terima Peserta (Skenario TERIMA)
Mengubah status peserta menjadi `BIDDING` dan otomatis menghasilkan PIN bidding 6-digit.
- **Request Body (JSON)**:
```json
{
  "peserta": "7dd9cdc1-6183-4178-a687-3c5861b58532",
  "status": "TERIMA",
  "catatan": "Dokumen lengkap dan valid",
  "alasan": "Memenuhi persyaratan dokumen"
}
```
- **Response Success (200)**:
```json
{
  "status_code": 200,
  "message": "Berhasil memproses verifikasi peserta lelang"
}
```

#### 2. Payload Tolak Peserta (Skenario TOLAK)
Mengubah status peserta menjadi `DITOLAK` tanpa menghasilkan PIN (PIN tetap `null`).
- **Request Body (JSON)**:
```json
{
  "peserta": "8eed0e2b-2174-4b52-b131-4d1a3c631a78",
  "status": "TOLAK",
  "catatan": "KTP buram tidak terbaca",
  "alasan": "Dokumen tidak valid"
}
```
- **Response Success (200)**:
```json
{
  "status_code": 200,
  "message": "Berhasil memproses verifikasi peserta lelang"
}
```
