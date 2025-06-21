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
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>Edit Produk</title>
  <style>
    * {
      margin: 0; padding: 0;
      box-sizing: border-box;
      font-family: Poppins, sans-serif;
    }
    body {
      min-height: 100vh;
      background: #ffffff;
      padding: 1rem;
    }
    .wrapper {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    header {
      width: 100%;
      margin-bottom: 30px;
    }
    form.container {
      width: 100%;
      max-width: 400px;
      background: #f9f9f9;
      border-radius: 12px;
      padding: 2rem;
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    }
    h1 {
      color: #333;
      text-align: center;
      margin-bottom: 1.5rem;
    }
    .form-group {
      margin-bottom: 1rem;
    }
    .form-group label {
      display: block;
      margin-bottom: 0.3rem;
      color: #333;
      font-size: 0.95rem;
    }
    .form-group input {
      width: 100%;
      padding: 0.6rem;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
    }
    .form-group input:focus {
      outline: 2px solid #667eea;
    }
    button {
      width: 100%;
      margin-top: 1rem;
      padding: 0.75rem;
      border: none;
      border-radius: 6px;
      background: #3182ce;
      color: #fff;
      font-size: 1rem;
      cursor: pointer;
      transition: background 0.3s;
    }
    button:hover {
      background: #2b6cb0;
    }
    .form-group small {
      color: #666;
      font-size: 0.85rem;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <form action="../controllers/edit_produk.php" method="POST" enctype="multipart/form-data" class="container">
      <h1>Edit Produk</h1>

      <input type="hidden" name="id" value="<?= htmlspecialchars($produk['id']) ?>">

      <div class="form-group">
        <label for="nama_produk">Nama Produk</label>
        <input type="text" id="nama_produk" name="nama_produk" required value="<?= htmlspecialchars($produk['nama_produk']) ?>">
      </div>

      <div class="form-group">
        <label for="harga">Harga</label>
        <input type="number" id="harga" name="harga" required value="<?= htmlspecialchars($produk['harga']) ?>">
      </div>

      <div class="form-group">
        <label for="harga_awal">Harga Awal (Opsional)</label>
        <input type="number" id="harga_awal" name="harga_awal" value="<?= htmlspecialchars($produk['harga_awal']) ?>">
      </div>

      <div class="form-group">
        <label for="kota">Kota</label>
        <input type="text" id="kota" name="kota" required value="<?= htmlspecialchars($produk['kota']) ?>">
      </div>

      <div class="form-group">
        <label for="estimasi">Estimasi Tiba</label>
        <input type="text" id="estimasi" name="estimasi" required value="<?= htmlspecialchars($produk['estimasi']) ?>">
      </div>

      <div class="form-group">
        <label for="gambar">Gambar (kosongkan jika tidak diubah)</label>
        <input type="file" id="gambar" name="gambar" accept="image/*">
        <small>Gambar saat ini: <?= htmlspecialchars($produk['gambar']) ?></small>
      </div>

      <button type="submit">Update Produk</button>
    </form>
  </div>
</body>
</html>
