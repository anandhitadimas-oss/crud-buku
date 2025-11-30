<?php
require_once __DIR__ . '/class/Database.php';
require_once __DIR__ . '/class/Utility.php';

$db = new Database();
$pdo = $db->pdo;

// ambil data buku
$stmt = $pdo->query("SELECT * FROM books ORDER BY id DESC");
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Daftar Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

  <!-- 🔔 tampilkan notifikasi -->
  <?php Utility::showFlash(); ?>

  <h2 class="mb-4">📚 Daftar Buku</h2>
  <a href="create.php" class="btn btn-primary mb-3">+ Tambah Buku</a>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Tahun</th>
        <th>Kategori</th>
        <th>Cover</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($books as $book): ?>
      <tr>
        <td><?= htmlspecialchars($book['title']) ?></td>
        <td><?= htmlspecialchars($book['author']) ?></td>
        <td><?= $book['year_published'] ?></td>
        <td><?= $book['category'] ?></td>
        <td>
          <?php if ($book['cover_path']): ?>
            <img src="<?= $book['cover_path'] ?>" class="img-thumbnail" width="80">
          <?php endif; ?>
        </td>
        <td>
          <span class="badge bg-<?= $book['status']=='available'?'success':'danger' ?>">
            <?= $book['status'] ?>
          </span>
        </td>
        <td>
          <a href="edit.php?id=<?= $book['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
          <a href="delete.php?id=<?= $book['id'] ?>" class="btn btn-sm btn-danger"
             onclick="return confirm('Yakin hapus buku ini?')">Delete</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
