# 📦 Sistem Manajemen Gudang - CodeIgniter 3

![Banner Sistem Gudang](https://via.placeholder.com/1000x200?text=Sistem+Manajemen+Gudang)

> Aplikasi web untuk manajemen stok gudang yang simple, efisien, dan scalable. Dibangun dengan ❤️ menggunakan CodeIgniter 3.

---

## 🚀 Deskripsi Proyek

Sistem ini dirancang untuk mempermudah pengelolaan barang di gudang secara digital, mulai dari pencatatan stok masuk/keluar hingga pembuatan laporan bulanan. Cocok untuk usaha kecil hingga menengah.

---

## 🔥 Fitur Unggulan

- ✅ **Manajemen Barang** 
- ✅ **Pencatatan Stok Otomatis**
- ✅ **Multi-Level User** 
- ✅ **Laporan Dinamis** 
- ✅ **Manajemen Kategori** 

---

## 🧰 Teknologi yang Digunakan

| Stack       | Teknologi         |
|-------------|-------------------|
| Backend     | PHP 7+, CodeIgniter 3 |
| Frontend    | Bootstrap 4        |
| Database    | MySQL              |
| Tools Dev   | Composer (optional) |

---

## 🛠️ Instalasi

### 📋 Persyaratan Sistem

- PHP 7.0 atau lebih tinggi
- MySQL 5.6 atau lebih tinggi
- Web server seperti Apache atau Nginx
- Composer (opsional, untuk autoload optimization)

### ⚙️ Langkah Instalasi

1. Clone repositori ini:
   ```bash
   git clone https://github.com/LathifNurHidayat/Gudang.git
   cd Gudang
   ```

2. Import database dari file `.sql` yang disediakan ke MySQL Anda.

3. Konfigurasi database di `application/config/database.php`.

4. (Opsional) Atur base URL di `application/config/config.php`:
   ```php
   $config['base_url'] = 'http://localhost/Gudang/';
   ```

5. Jalankan di browser melalui `localhost/Gudang`.

---

## 👤 Role Pengguna

- **Admin**: Akses penuh, termasuk manajemen user & laporan
- **Staff**: Hanya akses transaksi dan stok barang

---

## 📌 Catatan

- Pastikan folder `application/cache` dan `application/logs` memiliki permission write.
- Untuk keamanan lebih, aktifkan CSRF dan XSS protection di konfigurasi CI3.

---

## 🧑‍💻 Kontribusi

Pull request sangat terbuka! Jika kamu menemukan bug atau ingin menambahkan fitur, silakan buat PR atau buka [Issue](https://github.com/LathifNurHidayat/Gudang/issues).

---

## 📄 Lisensi

Project ini menggunakan lisensi **MIT** — bebas digunakan dan dimodifikasi.
