<?php
session_start();
require_once '../config/database.php';
require_once '../models/Pesanan.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../views/login.php');
    exit;
}

$db = new Database();
$pdo = $db->connect();
$pesananModel = new Pesanan($pdo);

$user_id = $_SESSION['user']['id'];
$produk_id = $_POST['produk_id'] ?? null;
$jumlah = $_POST['qty'] ?? 0;
$harga = $_POST['harga'] ?? 0;
$total_harga = $jumlah * $harga;

if ($produk_id && $jumlah > 0 && $harga > 0) {
    $pesananModel->create($user_id, $produk_id, $jumlah, $total_harga);
    header('Location: ../views/history_pemesanan.php');
    exit;
} else {
    echo "Data checkout tidak valid.";
}
