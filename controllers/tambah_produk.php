<?php
require_once '../config/database.php';
require_once '../models/Produk.php';

$db = new Database();
$pdo = $db->connect();

$produkModel = new Produk($pdo);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_produk = $_POST['nama_produk'] ?? '';
    $harga = $_POST['harga'] ?? 0;
    $harga_awal = $_POST['harga_awal'] ?? 0;
    $kota = $_POST['kota'] ?? '';
    $estimasi = $_POST['estimasi'] ?? '';

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $gambarTmp = $_FILES['gambar']['tmp_name'];
        $gambarName = uniqid() . '_' . basename($_FILES['gambar']['name']);
        $uploadPath = '../public/uploads/' . $gambarName;

        if (!is_dir('../public/uploads')) {
            mkdir('../public/uploads', 0777, true);
        }

        if (move_uploaded_file($gambarTmp, $uploadPath)) {
            $berhasil = $produkModel->create($nama_produk, $harga, $harga_awal, $kota, $estimasi, $gambarName);

            if ($berhasil) {
                echo "<script>alert('Produk berhasil ditambahkan!'); window.location.href = '../admin/index.php';</script>";
            } else {
                echo "<script>alert('Gagal menyimpan produk ke database'); window.location.href = '../views/tambah_produk.php';</script>";
            }
        } else {
            echo "<script>alert('Gagal mengupload gambar'); window.location.href = '../views/tambah_produk.php';</script>";
        }
    } else {
        echo "<script>alert('Gambar wajib diupload'); window.location.href = '../views/tambah_produk.php';</script>";
    }
} else {
    header("Location: ../views/index.php");
    exit;
}
