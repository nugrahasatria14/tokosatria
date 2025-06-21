<?php
session_start();
require_once '../config/database.php';
require_once '../models/Keranjang.php';

$db = new Database();
$pdo = $db->connect();
$keranjang = new Keranjang($pdo);
$data = $keranjang->getByUser($_SESSION['user']['id']);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Keranjang Saya</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        h2 {
            color: #4CAF50;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            max-width: 800px;
            margin: auto;
        }

        .cart-item {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            padding: 15px;
            margin-bottom: 15px;
            gap: 15px;
            flex-wrap: wrap;
        }

        .cart-item img {
            width: 100px;
            border-radius: 8px;
        }

        .item-info {
            flex: 1;
        }

        .item-info p {
            margin: 5px 0;
        }

        .qty-input {
            width: 60px;
            padding: 5px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .actions {
            display: flex;
            flex-direction: column;
            gap: 8px;
            align-items: flex-end;
        }

        .actions button,
        .actions a {
            text-decoration: none;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 6px;
            padding: 6px 12px;
            cursor: pointer;
            font-size: 14px;
        }

        .actions a.delete {
            background-color: #f44336;
        }

        .checkout-btn {
            display: block;
            width: fit-content;
            margin: 30px auto;
            padding: 12px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        @media (max-width: 600px) {
            .cart-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .actions {
                width: 100%;
                flex-direction: row;
                justify-content: space-between;
            }
        }
    </style>
</head>

<body>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    const confirmDelete = confirm('Yakin ingin menghapus item ini dari keranjang?');
                    if (!confirmDelete) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>


    <h2>Keranjang Saya</h2>

    <form method="POST" action="../controllers/checkout_selected.php">
        <?php foreach ($data as $item): ?>
            <div class="cart-item">
                <input type="radio" name="checkout_ids[]" value="<?= $item['id']; ?>">
                <img src="../public/uploads/<?= $item['gambar']; ?>" alt="<?= $item['nama_produk']; ?>">
                <div class="item-info">
                    <p><strong><?= htmlspecialchars($item['nama_produk']); ?></strong></p>
                    <p>Harga: Rp<?= number_format($item['harga']); ?></p>
                    <p>
                        Qty:
                        <input type="number" name="qty[<?= $item['id']; ?>]" value="<?= $item['qty']; ?>" class="qty-input" min="1">
                    </p>
                </div>
                <div class="actions">
                    <button type="submit" formaction="../controllers/update_qty.php?id=<?= $item['id']; ?>">Simpan Qty</button>
                    <a href="../controllers/delete_cart.php?id=<?= $item['id']; ?>" class="delete">Hapus</a>
                </div>
            </div>
        <?php endforeach; ?>

        <?php if (count($data) > 0): ?>
            <button type="submit" class="checkout-btn">Checkout yang Dipilih</button>
        <?php else: ?>
            <p style="text-align: center;">Keranjang kamu masih kosong.</p>
        <?php endif; ?>
    </form>

</body>

</html>