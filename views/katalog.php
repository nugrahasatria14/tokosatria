<?php

if (!isset($_SESSION['user']) || $_SESSION['user']['level'] !== 'user') {
    header("Location: login.php");
    exit;
}

require_once '../config/database.php';
require_once '../models/Produk.php';

$db = new Database();
$conn = $db->connect();
$produkModel = new Produk($conn);
$produkList = $produkModel->getAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog E-commerce</title>
    <style>
       .katalog {
            margin: 10px 10px 10px 4px;
            font-family: sans-serif;
        }

        .katalog h3 {
            padding: 10px;
            margin-left: 12px;
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
</head>
<body>
     <div class="container">

        <div class="katalog">
            <h3>Katalog Produk</h3>
            <?php foreach ($produkList as $produk): ?>
                <div class="item">
                    <a href="detail_produk.php?id=<?= $produk['id'] ?>">
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
                    <button><a href="checkout.php?id=<?= $produk['id'] ?>">Beli Now</a></button>

                    <button>
                        <a href="input_qty.php?id=<?= $produk['id'] ?>">Keranjang</a>
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>

