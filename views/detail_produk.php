<?php
require_once '../config/database.php';
require_once '../models/Produk.php';

$db = new Database();
$pdo = $db->connect();
$produkModel = new Produk($pdo);

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}

$produk = $produkModel->getById($id);
if (!$produk) {
    echo "Produk tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>Detail Produk</title>
  <style>
    body {
      font-family: Poppins, sans-serif;
      background-color: #fff;
      padding: 2rem;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .detail-card {
      width: 400px;
      background: #f9f9f9;
      border-radius: 12px;
      padding: 2rem;
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
      text-align: center;
    }

    .detail-card img {
      width: 400px;
      height: auto;
      border-radius: 10px;
      margin-bottom: 1rem;
    }

    .detail-card h2 {
      margin: 1rem 0 0.5rem;
      color: #333;
    }

    .detail-card p {
      margin: 0.3rem 0;
      color: #555;
    }

    .btn-back {
      display: inline-block;
      margin-top: 1.5rem;
      padding: 0.6rem 1.2rem;
      background-color: #3182ce;
      color: white;
      border: none;
      border-radius: 6px;
      text-decoration: none;
      transition: background 0.3s;
    }

    .btn-back:hover {
      background-color: #2b6cb0;
    }
  </style>
</head>
<body>
  <div class="detail-card">
    <img src="../public/uploads/<?= htmlspecialchars($produk['gambar']) ?>" alt="Gambar Produk">
    <h2><?= htmlspecialchars($produk['nama_produk']) ?></h2>
    <p><strong>Harga:</strong> Rp<?= number_format($produk['harga'], 0, ',', '.') ?></p>
    <?php if ($produk['harga_awal']): ?>
    <p><strong>Harga Awal:</strong> <s>Rp<?= number_format($produk['harga_awal'], 0, ',', '.') ?></s></p>
    <?php endif; ?>
    <p><strong>Kota:</strong> <?= htmlspecialchars($produk['kota']) ?></p>
    <p><strong>Estimasi:</strong> <?= htmlspecialchars($produk['estimasi']) ?></p>

    <a href="../admin/index.php" class="btn-back">← Kembali</a>
  </div>
</body>
</html>
