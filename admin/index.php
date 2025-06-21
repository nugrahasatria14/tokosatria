<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['level'] !== 'admin') {
    header("Location: ../views/login.php");
    exit;
}

require_once '../config/database.php';
require_once '../models/Produk.php';

$db = new Database();
$conn = $db->connect();
$produkModel = new Produk($conn);
$produkList = $produkModel->getAll();

?>

<html>

<head>
    <title>Index E-commmerce</title>
    <style>
        .katalog {
            margin: 10px 10px 10px 4px;
            font-family: sans-serif;
        }

        .katalog h3 {
            padding: 10px;
            margin-left: 12px;
        }

        .tambah-produk {
            margin-left: 20px;
            margin-bottom: 20px;
        }

        .tambah-produk a {
            background-color: blue;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }

        .katalog .item {
            background-color: white;
            display: inline-block;
            border-radius: 10px;
            margin: 10px 4px 10px 17px;
            border: 1px solid rgb(227, 226, 226);
            width: 220px;
            vertical-align: top;
        }

        .katalog img {
            width: 220px;
            height: 250px;
            border-radius: 10px 10px;
        }

        .katalog span,
        p,
        h5 {
            padding-left: 5px;
            text-align: left;
        }

        .katalog button {
            margin: 5px;
            background-color: green;
            color: white;
            border-radius: 5px;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .katalog .edit-btn {
            background-color: orange;
        }

        .katalog .hapus-btn {
            background-color: red;
        }

        .katalog #span1 {
            text-decoration: line-through;
            color: gray;
        }

        .katalog span {
            color: red;
        }

        .katalog a {
            text-decoration: none;
            color: white;
        }
    </style>
    </style>
</head>

<body>
    <div class="container">
        <?php
        require_once '../views/layout/header.php'
        ?>

        <div class="katalog">
            <h3>Katalog Produk</h3>
            <div class="tambah-produk">
                <a href="../views/tambah_produk.php">+ Tambah Produk</a>
            </div>

            <?php foreach ($produkList as $produk): ?>
                <div class="item">
                    <a href="../views/detail_produk.php?id=<?= $produk['id'] ?>">
                        <img src="../public/uploads/<?= $produk['gambar'] ?>" alt="<?= $produk['nama_produk'] ?>" width="100">
                    </a>
                    <p><?= htmlspecialchars($produk['nama_produk']) ?></p>
                    <h5>Rp.<?= number_format($produk['harga'], 0, ',', '.') ?></h5>

                    <?php if ($produk['harga_awal'] > 0): ?>
                        <span id="span1">Rp.<?= number_format($produk['harga_awal'], 0, ',', '.') ?></span>
                        <span>
                            <?php
                            $diskon = 100 - round(($produk['harga'] / $produk['harga_awal']) * 100);
                            echo $diskon . '%';
                            ?>
                        </span>
                    <?php endif; ?>

                    <p><?= htmlspecialchars($produk['kota']) ?></p>
                    <p><?= htmlspecialchars($produk['estimasi']) ?></p>
                    <button><a href="../views/checkout.php?id=<?= $produk['id'] ?>">Beli Now</a></button>

                    <button>
                        <a href="../views/input_qty.php?id=<?= $produk['id'] ?>">Keranjang</a>
                    </button>

                    <button class="edit-btn"><a href="../views/edit_produk.php?id=<?= $produk['id'] ?>">Edit</a></button>
                    <button class="hapus-btn"><a href="../controllers/hapus_produk.php?id=<?= $produk['id'] ?>" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a></button>
                </div>
            <?php endforeach; ?>
        </div>

        <?php
        require_once '../views/layout/footer.php'
        ?>
    </div>
</body>

</html>