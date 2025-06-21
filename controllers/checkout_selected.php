<?php
session_start();
require_once '../config/database.php';
require_once '../models/Pesanan.php';
require_once '../models/Keranjang.php';

$db = new Database();
$pdo = $db->connect();

$keranjang = new Keranjang($pdo);
$pesanan = new Pesanan($pdo);

$user_id = $_SESSION['user']['id'];
$ids = $_POST['checkout_ids'] ?? [];

foreach ($ids as $id) {
    $item = $keranjang->getById($id);
    if ($item) {
        $total = $item['qty'] * $item['harga'];
        $pesanan->create($user_id, $item['produk_id'], $item['qty'], $total);
        $keranjang->delete($id);
    }
}
header('Location: ../views/history_pemesanan.php');
