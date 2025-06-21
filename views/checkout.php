<?php
session_start();
require_once '../config/database.php';
require_once '../models/Produk.php';

$db = new Database();
$pdo = $db->connect();
$produkModel = new Produk($pdo);

$id = $_GET['id'] ?? null;
if (!$id) {
  echo "ID produk tidak ditemukan.";
  exit;
}


$produk = $produkModel->getById($id);
if (!$produk) {
  echo "Produk tidak ditemukan di database.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Checkout Produk</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f3f4f6;
      margin: 0;
      padding: 2rem;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.1);
      width: 400px;
      padding: 1.5rem;
      text-align: center;
    }
    .card img {
      width: 100%;
      max-height: 250px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 1rem;
    }
    .card h2 {
      margin-bottom: 0.5rem;
    }
    .card p {
      margin: 0.25rem 0;
    }
    .form-group {
      margin: 1rem 0;
      text-align: left;
    }
    .form-group label {
      display: block;
      margin-bottom: 0.3rem;
    }
    .form-group input {
      width: 100%;
      padding: 0.5rem;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    .total {
      margin-top: 1rem;
      font-weight: bold;
    }
    button {
      margin-top: 1.5rem;
      width: 100%;
      padding: 0.75rem;
      border: none;
      border-radius: 6px;
      background-color: #2b6cb0;
      color: white;
      font-size: 1rem;
      cursor: pointer;
    }
    button:hover {
      background-color: #2c5282;
    }
    .back-link {
      margin-top: 1rem;
      display: inline-block;
      color: #2b6cb0;
      text-decoration: none;
    }
  </style>
</head>
<body>

<div class="card">
  <img src="../public/uploads/<?= htmlspecialchars($produk['gambar']) ?>" alt="<?= htmlspecialchars($produk['nama_produk']) ?>">

  <h2><?= htmlspecialchars($produk['nama_produk']) ?></h2>
  <p>Harga: <strong>Rp <?= number_format($produk['harga'], 0, ',', '.') ?></strong></p>
  <p>Kota: <?= htmlspecialchars($produk['kota']) ?></p>
  <p>Estimasi: <?= htmlspecialchars($produk['estimasi']) ?></p>

  <form action="../controllers/proses_checkout.php" method="POST">
    <input type="hidden" name="produk_id" value="<?= $produk['id'] ?>">
    <input type="hidden" name="harga" value="<?= $produk['harga'] ?>">

    <div class="form-group">
      <label for="qty">Jumlah</label>
      <input type="number" id="qty" name="qty" value="1" min="1" required oninput="hitungTotal()">
    </div>

    <div class="total">
      Total: Rp <span id="total"><?= number_format($produk['harga'], 0, ',', '.') ?></span>
    </div>

    <button type="submit">Beli Sekarang</button>
  </form>

  <a class="back-link" href="../admin/index.php">← Kembali</a>
</div>

<script>
  function hitungTotal() {
    const harga = <?= $produk['harga'] ?>;
    const qty = document.getElementById('qty').value;
    const total = harga * qty;
    document.getElementById('total').innerText = total.toLocaleString('id-ID');
  }
</script>

</body>
</html>
