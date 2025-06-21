<?php
require_once '../config/database.php';
require_once '../models/Produk.php';

$db = new Database();
$pdo = $db->connect();
$produk = new Produk($pdo);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $produk->delete($id);
    header('Location: ../admin/index.php');
    exit;
}
?>
