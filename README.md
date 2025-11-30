# Aplikasi CRUD Buku

## 1. Deskripsi
Aplikasi ini dibuat untuk memenuhi tugas mata kuliah Sistem Informasi.  
Fungsinya adalah mengelola data **Buku** dengan operasi CRUD:
- Create → tambah data buku
- Read → tampilkan daftar buku
- Update → edit data buku
- Delete → hapus data buku

Setiap buku memiliki atribut:
- Judul
- Penulis
- Tahun terbit
- Kategori
- Status (available/unavailable)
- Cover (upload file gambar)

## 2. Spesifikasi Teknis
- Bahasa: PHP 8.x
- Database: MySQL/MariaDB
- Driver: PDO
- Validasi:
  - Semua field wajib isi
  - Tahun harus angka
  - File upload hanya JPG/PNG, maksimal 2 MB
- Struktur folder:
/class Database.php 
Utility.php 
/uploads 
(file cover tersimpan di sini) 
books.php 
create.php 
save.php 
edit.php 
update.php 
delete.php 
schema.sql 
README.md


## 3. Cara Menjalankan
1. Import database:
 - Buka phpMyAdmin
 - Import file `schema.sql`
2. Atur koneksi database di `class/Database.php`
3. Jalankan server PHP:
 ```bash
 php -S localhost:8000

## 4. Akses aplikasi di browser:

code
http://localhost/user-buku/books.php

## 5. Skenario Uji CRUD
Tambah Buku → isi form di create.php, simpan, data muncul di daftar.

Tampilkan Buku → lihat semua data di books.php.

Edit Buku → klik Edit, ubah data, simpan, data berubah.

Hapus Buku → klik Delete, konfirmasi, data terhapus.

## 6. Catatan
Cover lama tetap dipakai jika tidak diganti saat edit.

Path file cover disimpan di database, file fisik di folder uploads/
