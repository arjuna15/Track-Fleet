# 🚛 TrackFleet — Smart B2B Fleet & Profit Intelligence Platform

> **Proyek Desain E-Business (Sistem & Teknologi Informasi)**  
> **Dosen Pengampu:** Muhammad Reza Firmansyah Tanjung  
> **Badan Usaha:** PT Logistik Digital Nusantara (PT LDN)

---

### 👥 Tim Pengembang (Kelompok):
1. **Arjuna Arrasyid** — NIM: **315251020003**
2. **Innike Reyna** (Innike Reynawati Syofiana) — NIM: **315251020020**  

---

## 🌟 Tentang TrackFleet
**TrackFleet** adalah platform B2B Software-as-a-Service (SaaS) *E-Logistics & Fleet Profit Intelligence* yang dirancang khusus untuk memodernisasi ekosistem operasional transporter armada truk, vendor rekanan logistik, dan pemilik muatan (*shipper*) di koridor Trans-Jawa dan seluruh Indonesia.

Berbeda dari pelacak GPS konvensional yang hanya menampilkan titik koordinat mentah, TrackFleet mengintegrasikan seluruh alur operasional dari kalkulasi margin kargo, penerbitan Surat Perintah Jalan (SPJ), pelacakan live satelit tanpa alat berkabel (*hardware-free*), hingga validasi bukti serah terima digital (*Electronic Proof of Delivery / E-POD*) yang langsung memicu penerbitan faktur tagihan (*auto-invoicing*).

---

## 💎 Fitur Unggulan Sistem

### 1. 🍱 Bento Box Soft Minimalist Executive Command Center
- Antarmuka modern berstandar estetika *Bento Box Minimal Modernism* (kanvas `#F4F5F6` lembut, kartu *ultra-rounded* `rounded-[28px]`, drop shadow difus lembut, dan tipografi kontras tinggi).
- **Executive Overview Card**: Rangkuman nilai muatan, proteksi laba kotor, dan visual tim armada lapangan.
- **Peta Radar Telemetri GPS Live**: Integrasi visual Leaflet.js dengan penanda posisi armada real-time di rute Tol Trans-Jawa.
- **Master Dispatch & Orders Ledger**: Filter tersegmen (*Semua*, *Dalam Perjalanan*, *Sudah Tiba*, *Margin Rendah*), pencarian instan dengan shortcut `/`, dan format plat kendaraan standar Indonesia (`B 9142 TQU`).
- **1-Click Persona Switcher**: Kemudahan berganti peran kerja seketika antara **Admin Operasional** (`Arjuna`) dan **Manajer Keuangan** (`Innike`) tanpa proses logout.

### 2. 📱 Dual View Driver Field Studio (iPhone 15 Pro & Web Desk)
- Menghadirkan simulator aplikasi sopir lapangan dengan mode ganda yang fleksibel:
  - **`⚡ Split (Web + HP)`**: Tampilan konsol web operasional berdampingan langsung dengan frame smartphone iPhone 15 Pro interaktif.
  - **`📱 iPhone 15 HP`**: Mockup perangkat iPhone 15 Pro Titanium presisi lengkap dengan *Dynamic Island* (live GPS status), iOS 17 status bar (`09:41`, 5G, baterai), dan navigasi sentuh native (393 × 852 px).
  - **`💻 Web Layar Penuh`**: Konsol web dashboard lapangan penuh untuk tablet atau PC kantor pool.
- **Preset Trans-Jawa 1-Klik**: Akses instan checkpoint tol (*KM 57 Cikampek, KM 102 Cipali, KM 208 Palimanan, KM 318 Batang, KM 429 Semarang, KM 715 Surabaya*).
- **Deteksi Geolocation Sensor**: Mendukung pembacaan GPS langsung dari sensor browser/smartphone driver.
- **Custom Bento Dropdown SPJ**: Menggantikan dropdown bawaan browser dengan floating card mewah yang menampilkan status dan rute kargo lengkap.

### 3. 🛡️ Margin Guard Protection (< 10%)
- Deteksi dini kebocoran margin laba kotor sebelum truk diberangkatkan.
- Jika margin proyeksi berada di bawah **10%**, sistem secara otomatis menandai order dengan aksen peringatan kuning dan mengaktifkan audit modal vendor untuk melindungi kesehatan arus kas perusahaan.

### 4. 📄 Instant E-POD & Auto-Invoicing (Sah UU ITE)
- Sopir memotret bukti surat jalan bertanda tangan dan berstempel basah saat kargo tiba di gudang tujuan.
- Validasi E-POD seketika memperbarui status kargo menjadi **Tiba di Tujuan** dan secara otomatis menerbitkan dokumen **Invoice Tagihan (DPP + PPN 1.1%)**, memangkas siklus kas dari 21 hari menjadi hitungan menit.

### 5. 🌐 Portal Pelacakan Mandiri Publik (Shipper Self-Service)
- Klien shipper dapat memantau pergerakan kargo secara transparan 24/7 tanpa perlu login menggunakan kode resi unik (contoh: `TRK-JKTSBY89`).

### 6. 🔒 Kepatuhan Privasi Regulasi (UU PDP No. 27 Tahun 2022)
- Pelacakan koordinat sopir terikat ketat dengan siklus Surat Perintah Jalan (SPJ) aktif. Sistem tidak merekam lokasi di luar jam tugas operasional armada.

---

## 🏗️ Arsitektur & Tumpukan Teknologi

| Komponen | Teknologi yang Digunakan |
| :--- | :--- |
| **Backend Framework** | Laravel 11.x (PHP 8.3+) |
| **Frontend Styling** | Tailwind CSS v3 + Plus Jakarta Sans + JetBrains Mono |
| **Icon System** | Lucide Icons (Self-hosted SVG) |
| **Peta & Telemetri** | Leaflet.js + OpenStreetMap Engine (Tanpa Ketergantungan CDN Eksternal) |
| **Basis Data** | SQLite (Production-Ready terindeks) / Dukungan MySQL |
| **Asset Bundler** | Vite 8.x |
| **Testing Suite** | PHPUnit / Pest (13 automated feature tests, 60 assertions) |

---

## 🚀 Panduan Instalasi & Menjalankan Lokal

### 1. Kloning Repositori:
```bash
git clone https://github.com/arjuna15/Track-Fleet.git
cd Track-Fleet
```

### 2. Pasang Dependensi:
```bash
composer install
npm install
```

### 3. Konfigurasi Lingkungan:
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Migrasi & Seeder Database Demo:
```bash
touch database/database.sqlite
php artisan migrate:fresh --seed
```

### 5. Kompilasi Aset Frontend:
```bash
npm run build
```

### 6. Jalankan Server:
```bash
php artisan serve
```

---

## 🌐 Rute Navigasi Aplikasi

Setelah server aktif di `http://127.0.0.1:8000`:

* **Landing Page Resmi & Profil Bisnis:** `http://127.0.0.1:8000/`
* **Paket Harga SaaS (Model Bisnis):** `http://127.0.0.1:8000/pricing`
* **Executive Bento Dashboard (Operasional):** `http://127.0.0.1:8000/admin`
* **Dashboard Finansial & Margin Guard:** `http://127.0.0.1:8000/admin/finance`
* **Pusat Kendali Pesanan & Dispatch:** `http://127.0.0.1:8000/admin/orders`
* **Manajemen Unit Armada & Pengemudi:** `http://127.0.0.1:8000/admin/vehicles`
* **Aplikasi Driver Dual Studio (iPhone 15 Pro):** `http://127.0.0.1:8000/driver`
* **Portal Pelacakan Shipper Terbuka:** `http://127.0.0.1:8000/tracking` *(Kode Sampel: `TRK-JKTSBY89`)*

---

## 🔐 Kredensial Akun Demo

| Peran Akun | Email Login | Kata Sandi | Hak Akses Utama |
| :--- | :--- | :--- | :--- |
| **Admin Operasional** (`Arjuna`) | `admin@trackfleet.id` | `password123` | Dispatch order, radar live armada, penugasan unit truk |
| **Manajer Keuangan** (`Innike`) | `innike@trackfleet.id` | `password123` | Analisis margin guard, validasi E-POD, cetak invoice kargo |

---

## 🧪 Pengujian Otomatis (Automated Tests)
Proyek ini dilengkapi dengan automated feature tests untuk memastikan keandalan UI/UX, fungsionalitas peta satelit, serta proteksi margin:

```bash
php artisan test
```
*Hasil pengujian: **13 passing tests** (60 assertions, 0 errors).*

---

© 2026 **PT Logistik Digital Nusantara** — Dikembangkan untuk memenuhi Ujian Praktik Mata Kuliah Desain E-Business.
