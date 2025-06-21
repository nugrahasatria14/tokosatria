<?php
session_start();
require_once '../config/database.php';
require_once '../models/Keranjang.php';

if (!isset($_SESSION['user']) || !isset($_GET['id'])) {
    header('Location: ../views/keranjang.php');
    exit;
}

$id = $_GET['id'];
$db = new Database();
$pdo = $db->connect();
$keranjang = new Keranjang($pdo);
$keranjang->delete($id);

header('Location: ../views/keranjang.php');
exit;
