<?php
require_once __DIR__ . '/class/Database.php';
$db = new Database();
$pdo = $db->pdo;

$id = $_GET['id'] ?? null;
$stmt = $pdo->prepare("SELECT * FROM books WHERE id=?");
$stmt->execute([$id]);
$book = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

  <h2 class="mb-4">✏️ Edit Buku</h2>

  <form action="update.php" method="post" enctype="multipart/form-data" class="row g-3">
    <input type="hidden" name="id" value="<?= $book['id'] ?>">

    <div class="col-md-6">
      <label class="form-label">Judul</label>
      <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($book['title']) ?>" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">Penulis</label>
      <input type="text" name="author" class="form-control" value="<?= htmlspecialchars($book['author']) ?>" required>
    </div>

    <div class="col-md-4">
      <label class="form-label">Tahun Terbit</label>
      <input type="number" name="year_published" class="form-control" value="<?= $book['year_published'] ?>" required>
    </div>

    <div class="col-md-4">
      <label class="form-label">Kategori</label>
      <select name="category" class="form-select" required>
        <option value="Fiksi" <?= $book['category']=='Fiksi'?'selected':'' ?>>Fiksi</option>
        <option value="Nonfiksi" <?= $book['category']=='Nonfiksi'?'selected':'' ?>>Nonfiksi</option>
        <option value="Referensi" <?= $book['category']=='Referensi'?'selected':'' ?>>Referensi</option>
      </select>
    </div>

    <div class="col-md-4">
      <label class="form-label">Status</label>
      <select name="status" class="form-select" required>
        <option value="available" <?= $book['status']=='available'?'selected':'' ?>>Available</option>
        <option value="unavailable" <?= $book['status']=='unavailable'?'selected':'' ?>>Unavailable</option>
      </select>
    </div>

    <div class="col-md-6">
      <label class="form-label">Cover Lama</label><br>
      <?php if ($book['cover_path']): ?>
        <img src="<?= $book['cover_path'] ?>" class="img-thumbnail" width="120">
      <?php else: ?>
        <span class="text-muted">Tidak ada cover</span>
      <?php endif; ?>
    </div>

    <div class="col-md-6">
      <label class="form-label">Ganti Cover</label>
      <!-- 🔒 hanya gambar jpg/png -->
      <input type="file" name="cover" class="form-control" accept="image/jpeg,image/png">
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-success">Simpan Perubahan</button>
      <a href="books.php" class="btn btn-secondary">Batal</a>
    </div>
  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
