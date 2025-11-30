<?php
require_once __DIR__ . '/class/Utility.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Tambah Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

  <h2 class="mb-4">➕ Tambah Buku</h2>
  <?php Utility::showFlash(); ?>

  <form action="save.php" method="post" enctype="multipart/form-data" class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Judul</label>
      <input type="text" name="title" class="form-control" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">Penulis</label>
      <input type="text" name="author" class="form-control" required>
    </div>

    <div class="col-md-4">
      <label class="form-label">Tahun Terbit</label>
      <input type="number" name="year_published" class="form-control" min="0" required>
    </div>

    <div class="col-md-4">
      <label class="form-label">Kategori</label>
      <select name="category" class="form-select" required>
        <option value="Fiksi">Fiksi</option>
        <option value="Nonfiksi">Nonfiksi</option>
        <option value="Referensi">Referensi</option>
      </select>
    </div>

    <div class="col-md-4">
      <label class="form-label">Status</label>
      <select name="status" class="form-select" required>
        <option value="available">Available</option>
        <option value="unavailable">Unavailable</option>
      </select>
    </div>

    <div class="col-md-6">
      <label class="form-label">Cover Buku</label>
      <!-- 🔒 hanya gambar jpg/png -->
      <input type="file" name="cover" class="form-control" accept="image/jpeg,image/png" required>
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="books.php" class="btn btn-secondary">Batal</a>
    </div>
  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
