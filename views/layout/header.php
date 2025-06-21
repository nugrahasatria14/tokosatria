<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../config/database.php';
require_once '../models/Keranjang.php';

$db = new Database();
$pdo = $db->connect();
$keranjang = new Keranjang($pdo);
$total_item = isset($_SESSION['user']) ? count($keranjang->getByUser($_SESSION['user']['id'])) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tokopedia Clone</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background: linear-gradient(135deg, #667eea, #764ba2);
            height: 40px;
            display: flex;
            align-items: center;
            padding: 0 20px;
            color: white;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            width: 100%;
            align-items: center;
        }

        .navbar ul li {
            margin-right: 20px;
        }

        .navbar ul li:first-child {
            margin-right: auto;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .searchbar {
            padding: 15px 20px;
            background-color: #f9f9f9;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .searchbar h2 {
            color: green;
            font-size: 24px;
            font-weight: 600;
        }

        .searchbar input {
            flex: 1;
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .cart-icon {
            position: relative;
            cursor: pointer;
        }

        .cart-icon img {
            width: 30px;
            height: 30px;
            vertical-align: middle;
        }

        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: red;
            color: white;
            font-size: 12px;
            padding: 2px 6px;
            border-radius: 50%;
        }

        .dropdown-cart {
            display: none;
            position: absolute;
            right: 0;
            top: 40px;
            background: white;
            color: black;
            border: 1px solid #ccc;
            border-radius: 6px;
            width: 250px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 10px;
            z-index: 1000;
        }

        .dropdown-cart p {
            margin-bottom: 8px;
            font-size: 14px;
        }

        .dropdown-cart a {
            display: inline-block;
            margin-top: 10px;
            color: #4CAF50;
            font-weight: 500;
            text-decoration: none;
        }

        .dropdown-cart a:hover {
            text-decoration: underline;
        }

        .logout-btn {
            background-color: green;
            border: none;
            border-radius: 6px;
            padding: 6px 12px;
        }

        .logout-btn a {
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        .logout-btn a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <ul>
            <li><a href="https://tokopedia.com">Download Tokopedia App</a></li>
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['level'] === 'admin'): ?>
                <li><a href="../views/pesanan_admin.php">Manajemen Pesanan</a></li>
            <?php endif; ?>
            <li><a href="../views/history_pemesanan.php">History Pemesanan</a></li>
        </ul>
    </div>

    <div class="searchbar">
        <h2>tokopedia</h2>
        <input type="text" placeholder="Cari di Tokopedia">

        <div class="cart-icon" id="cartToggle">
            <img src="../img/cart.png" alt="Cart">
            <span class="cart-count"><?php echo $total_item; ?></span>
            <div class="dropdown-cart" id="dropdownCart">
                <?php if ($total_item > 0): ?>
                    <?php foreach ($keranjang->getByUser($_SESSION['user']['id']) as $item): ?>
                        <p><?php echo htmlspecialchars($item['nama_produk']); ?> x <?php echo $item['qty']; ?></p>
                    <?php endforeach; ?>
                    <a href="../views/keranjang.php">Lihat Keranjang</a>
                <?php else: ?>
                    <p>Keranjang kosong.</p>
                <?php endif; ?>
            </div>
        </div>

        <button class="logout-btn"><a href="../controllers/logout.php">Logout</a></button>
    </div>

    <script>
        const cartToggle = document.getElementById('cartToggle');
        const dropdownCart = document.getElementById('dropdownCart');

        document.addEventListener('click', function (e) {
            if (cartToggle.contains(e.target)) {
                dropdownCart.style.display = dropdownCart.style.display === 'block' ? 'none' : 'block';
            } else {
                dropdownCart.style.display = 'none';
            }
        });
    </script>

</body>
</html>
