<?php
session_start();
require_once '../config/database.php';
require_once '../models/Produk.php';

$db = new Database();
$pdo = $db->connect();
$produkModel = new Produk($pdo);

// Validasi ID dari GET
if (!isset($_GET['id']) || !is_numeric($_GET['id']) || $_GET['id'] <= 0) {
    echo "<script>alert('ID produk tidak valid!'); window.location.href = '../admin/index.php';</script>";
    exit;
}

$id = (int) $_GET['id'];
$produk = $produkModel->getById($id);

// Validasi produk dari database
if (!$produk) {
    echo "<script>alert('Produk tidak ditemukan!'); window.location.href = '../admin/index.php';</script>";
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Input Qty - <?= htmlspecialchars($produk['nama_produk']) ?></title>
    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
        }
        .form-box {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }
        label, input {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        button {
            padding: 10px;
            background-color: green;
            color: white;
            border: none;
            width: 100%;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="form-box">
    <h2><?= htmlspecialchars($produk['nama_produk']) ?></h2>
    <p>Harga: Rp <?= number_format($produk['harga'], 0, ',', '.') ?></p>

    <form action="../controllers/input_qty_controller.php" method="POST">
        <input type="hidden" name="produk_id" value="<?= $produk['id'] ?>">
        <label for="qty">Jumlah:</label>
        <input type="number" name="qty" id="qty" min="1" value="1" required>
        <button type="submit">Simpan ke Keranjang</button>
    </form>
</div>

</body>
</html>
