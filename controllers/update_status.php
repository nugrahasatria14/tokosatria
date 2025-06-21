<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['level'] !== 'admin') {
    header("Location: ../views/login.php");
    exit;
}

require_once '../config/database.php';
require_once '../models/Pesanan.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $status = $_POST['status'] ?? null;

    if ($id && $status) {
        $db = new Database();
        $pdo = $db->connect();

        $pesanan = new Pesanan($pdo);
        $pesanan->updateStatus($id, $status);
    }
}

header("Location: ../views/pesanan_admin.php");
exit;
