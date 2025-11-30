<?php
require_once __DIR__ . '/class/Database.php';
require_once __DIR__ . '/class/Utility.php';

$db = new Database();
$pdo = $db->pdo;

$title    = $_POST['title'];
$author   = $_POST['author'];
$year     = $_POST['year_published'];
$category = $_POST['category'];
$status   = $_POST['status'];

$coverPath = null;
if (!empty($_FILES['cover']['name'])) {
    $fileType = $_FILES['cover']['type'];
    $fileSize = $_FILES['cover']['size'];

    // validasi tipe file
    $allowedTypes = ['image/jpeg', 'image/png'];
    if (!in_array($fileType, $allowedTypes)) {
        Utility::setFlash("Format file tidak valid! Hanya JPG/PNG yang diperbolehkan.", "error");
        Utility::redirect("create.php");
    }

    // validasi ukuran file (maks 2 MB)
    $maxSize = 2 * 1024 * 1024; // 2 MB
    if ($fileSize > $maxSize) {
        Utility::setFlash("Ukuran file terlalu besar! Maksimal 2 MB.", "error");
        Utility::redirect("create.php");
    }

    // simpan file
    $fileName = time() . "_" . basename($_FILES['cover']['name']);
    $target   = "uploads/" . $fileName;
    if (move_uploaded_file($_FILES['cover']['tmp_name'], $target)) {
        $coverPath = $target;
    }
}

$stmt = $pdo->prepare("INSERT INTO books (title, author, year_published, category, cover_path, status) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->execute([$title, $author, $year, $category, $coverPath, $status]);

Utility::setFlash("Data buku berhasil ditambahkan!", "success");
Utility::redirect("books.php");
