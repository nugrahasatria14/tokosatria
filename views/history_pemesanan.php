<?php
session_start();
require_once '../config/database.php';
require_once '../models/Pesanan.php';

$db = new Database();
$pdo = $db->connect();

$pesanan = new Pesanan($pdo);
$user_id = $_SESSION['user']['id'];
$dataPesanan = $pesanan->getByUser($user_id);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Riwayat Pemesanan</title>
  <style>
    body {
      font-family: Poppins, sans-serif;
      background: #f5f5f5;
      padding: 20px;
    }
    .container {
      max-width: 700px;
      margin: 0 auto;
    }
    .item {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.1);
      margin-bottom: 20px;
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .item img {
      width: 300px;
      height: auto;
      border-radius: 8px;
      margin-bottom: 10px;
      object-fit: cover;
    }
    .info {
      text-align: center;
    }
    .info h2 {
      margin-bottom: 10px;
      font-size: 1.2rem;
    }
    .info p {
      margin: 4px 0;
      font-size: 0.95rem;
    }
    .status {
      margin-top: 10px;
      padding: 6px 12px;
      border-radius: 6px;
      background: #3182ce;
      color: white;
      display: inline-block;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Riwayat Pemesanan Anda</h1>

    <?php if ($dataPesanan): ?>
      <?php foreach ($dataPesanan as $pesan): ?>
        <div class="item">
          <?php
            $gambarPath = '../public/uploads/' . $pesan['gambar'];
            $gambarTampil = (!empty($pesan['gambar']) && file_exists($gambarPath)) 
              ? $gambarPath 
              : '../public/uploads/default.jpg';
          ?>
          <img src="<?= $gambarTampil ?>" alt="Gambar Produk">
          <div class="info">
            <h2><?= htmlspecialchars($pesan['nama_produk']); ?></h2>
            <p>Jumlah: <?= $pesan['jumlah']; ?></p>
            <p>Total Harga: Rp<?= number_format($pesan['total_harga'], 0, ',', '.'); ?></p>
            <p>Waktu: <?= $pesan['created_at']; ?></p>
            <p class="status">Status: <?= $pesan['status']; ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>Tidak ada riwayat pemesanan.</p>
    <?php endif; ?>
  </div>
</body>
</html>
