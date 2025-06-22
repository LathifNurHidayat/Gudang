# 🛠️ SISTEM MANAJEMEN GUDANG

*Mengelola Gudang dengan Mudah, Cepat, dan Akurat*

![last-commit](https://img.shields.io/github/last-commit/LathifNurHidayat/Gudang?style=flat&logo=git&logoColor=white&color=0080ff)
![repo-top-language](https://img.shields.io/github/languages/top/LathifNurHidayat/Gudang?style=flat&color=0080ff)
![repo-language-count](https://img.shields.io/github/languages/count/LathifNurHidayat/Gudang?style=flat&color=0080ff)

**Dibuat dengan:**

![PHP](https://img.shields.io/badge/PHP-777BB4.svg?style=flat&logo=php&logoColor=white)
![CodeIgniter](https://img.shields.io/badge/CodeIgniter-EE4623.svg?style=flat&logo=codeigniter&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-00758F.svg?style=flat&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C.svg?style=flat&logo=bootstrap&logoColor=white)

---

## 🔍 Deskripsi Umum

**Sistem Manajemen Gudang** adalah aplikasi web berbasis CodeIgniter 3 untuk mengelola stok barang dan mencatat transaksi masuk/keluar.

---

### 🎨 Fitur Utama

1. Manajemen Data Barang
2. Pencatatan Transaksi Masuk dan Keluar
3. Multi-Level User (Admin & Staff)
4. Laporan Stok dan Riwayat Transaksi
5. Manajemen Kategori Barang

---

### ✨ Fitur Unggulan

- Interface responsif dengan Bootstrap
- Validasi form dan keamanan XSS & CSRF
- Role-based access control (RBAC)
- Struktur folder rapi dan mudah dikembangkan

---

## 🚀 Mulai Menggunakan

### ✅ Persyaratan

- PHP 7.0 atau lebih tinggi
- MySQL 5.6 atau lebih tinggi
- Apache/Nginx Web Server
- Composer (opsional)

### 🛠️ Instalasi

1. **Clone repositori:**
   ```bash
   git clone https://github.com/LathifNurHidayat/Gudang.git
   cd Gudang
   ```

2. **Import database** dari file `.sql` yang disediakan ke MySQL Anda.

3. **Konfigurasi database**:
   - Buka file `application/config/database.php`
   - Sesuaikan nama host, username, password, dan database

4. **Konfigurasi base URL:**
   - Edit `application/config/config.php`
   ```php
   $config['base_url'] = 'http://localhost/Gudang/';
   ```

5. **Akses aplikasi melalui browser:**
   - http://localhost/Gudang/

---

## 👤 Role Pengguna

| Role   | Hak Akses |
|--------|------------|
| Admin  | Full access, manajemen user, laporan, dan data master |
| Staff  | Akses transaksi dan stok barang saja |

---

## 🖊️ Catatan Teknis

- Folder `application/cache` dan `application/logs` harus bisa ditulis (writable)
- Aktifkan CSRF dan XSS filter pada konfigurasi untuk keamanan tambahan

---

## 👨‍💻 Pengembang

**Lathif Nur Hidayat**  
🌐 GitHub: [@LathifNurHidayat](https://github.com/LathifNurHidayat)  
💼 LinkedIn: [linkedin.com/in/lathif-nur-hidayat-498393307](https://www.linkedin.com/in/lathif-nur-hidayat-498393307/)  
📸 Instagram: [@lathf.nyh](https://www.instagram.com/lathf.nyh)

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah **MIT License** — silakan digunakan dan dikembangkan!
