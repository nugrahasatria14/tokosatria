<?php
session_start();
require_once '../config/database.php';
require_once '../models/Keranjang.php';

if (!isset($_SESSION['user']) || !isset($_GET['id']) || !isset($_POST['qty'][$_GET['id']])) {
    header('Location: ../views/keranjang.php');
    exit;
}

$id = $_GET['id'];
$qty = (int)$_POST['qty'][$id];

if ($qty < 1) $qty = 1;

$db = new Database();
$pdo = $db->connect();
$keranjang = new Keranjang($pdo);
$keranjang->updateQty($id, $qty);

header('Location: ../views/keranjang.php');
exit;
