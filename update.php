<?php
require_once __DIR__ . '/class/Database.php';
require_once __DIR__ . '/class/Utility.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $pdo = $db->pdo;

    $id       = $_POST['id'];
    $title    = $_POST['title'];
    $author   = $_POST['author'];
    $year     = $_POST['year_published'];
    $category = $_POST['category'];
    $status   = $_POST['status'];

    $coverPath = null;
    if (!empty($_FILES['cover']['name'])) {
        // validasi file upload (jpg/png, max 2MB)
        $allowedTypes = ['image/jpeg', 'image/png'];
        if (!in_array($_FILES['cover']['type'], $allowedTypes)) {
            Utility::setFlash("Format file tidak valid!", "error");
            Utility::redirect("edit.php?id=$id");
        }
        if ($_FILES['cover']['size'] > 2*1024*1024) {
            Utility::setFlash("Ukuran file terlalu besar!", "error");
            Utility::redirect("edit.php?id=$id");
        }

        $fileName = time() . "_" . basename($_FILES['cover']['name']);
        $target   = "uploads/" . $fileName;
        if (move_uploaded_file($_FILES['cover']['tmp_name'], $target)) {
            $coverPath = $target;
        }
    }

    if ($coverPath) {
        $stmt = $pdo->prepare("UPDATE books SET title=?, author=?, year_published=?, category=?, cover_path=?, status=? WHERE id=?");
        $stmt->execute([$title, $author, $year, $category, $coverPath, $status, $id]);
    } else {
        $stmt = $pdo->prepare("UPDATE books SET title=?, author=?, year_published=?, category=?, status=? WHERE id=?");
        $stmt->execute([$title, $author, $year, $category, $status, $id]);
    }

    Utility::setFlash("Data buku berhasil diperbarui!", "success");
    Utility::redirect("books.php");
} else {
    // kalau akses langsung tanpa POST
    Utility::redirect("books.php");
}
