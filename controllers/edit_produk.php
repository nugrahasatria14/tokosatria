<?php
require_once '../config/database.php';
require_once '../models/Produk.php';

$db = new Database();
$pdo = $db->connect();
$produk = new Produk($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $harga_awal = $_POST['harga_awal'];
    $kota = $_POST['kota'];
    $estimasi = $_POST['estimasi'];

    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, '../public/uploads/' . $gambar);
    } else {
        $old = $produk->getById($id);
        $gambar = $old['gambar'];
    }

    $produk->update($id, $nama, $harga, $harga_awal, $kota, $estimasi, $gambar);

    header('Location: ../admin/index.php');
    exit;
}
?>
