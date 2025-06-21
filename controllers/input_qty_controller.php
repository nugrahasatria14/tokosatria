<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../views/login.php");
    exit;
}

require_once '../config/database.php';
require_once '../models/Keranjang.php';

$db = new Database();
$pdo = $db->connect();
$keranjang = new Keranjang($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user']['id'];
    $produk_id = $_POST['produk_id'] ?? null;
    $qty = $_POST['qty'] ?? 0;

    if ($produk_id && $qty > 0) {
        $keranjang->add($user_id, $produk_id, $qty);
        echo "<script>
            alert('Produk berhasil ditambahkan ke keranjang!');
            window.location.href = '../views/keranjang.php';
        </script>";
    } else {
        echo "<script>
            alert('Data tidak valid!');
            window.history.back();
        </script>";
    }
} else {
    header("Location: ../index.php");
    exit;
}
