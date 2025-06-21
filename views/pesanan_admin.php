<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['level'] !== 'admin') {
    header("Location: ../views/login.php");
    exit;
}

require_once '../config/database.php';
require_once '../models/Pesanan.php';

$db = new Database();
$conn = $db->connect();
$pesanan = new Pesanan($conn);
$semuaPesanan = $pesanan->getAll();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manajemen Pesanan - Admin</title>
    <style>
        body {
            font-family: Poppins, sans-serif;
            background: #f9f9f9;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px;
            text-align: center;
            border: 1px solid #eee;
        }

        th {
            background-color: #3182ce;
            color: white;
        }

        form {
            margin: 0;
        }

        select,
        button {
            padding: 6px 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background-color: green;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: darkgreen;
        }
    </style>
</head>

<body>
    <h2>Manajemen Pesanan</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Ubah Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($semuaPesanan as $p): ?>
                <tr>
                    <td><?= $p['id']; ?></td>
                    <td><?= htmlspecialchars($p['username']); ?></td>
                    <td><?= htmlspecialchars($p['nama_produk']); ?></td>
                    <td><?= $p['jumlah']; ?></td>
                    <td>Rp<?= number_format($p['total_harga'], 0, ',', '.'); ?></td>
                    <td><?= $p['status']; ?></td>
                    <td>
                        <form action="../controllers/update_status.php" method="POST">
                            <input type="hidden" name="id" value="<?= $p['id']; ?>">
                            <select name="status">
                                <option value="Diproses" <?= $p['status'] === 'Diproses' ? 'selected' : ''; ?>>Diproses</option>
                                <option value="Dikirim" <?= $p['status'] === 'Dikirim' ? 'selected' : ''; ?>>Dikirim</option>
                                <option value="Selesai" <?= $p['status'] === 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
                                <option value="Dibatalkan" <?= $p['status'] === 'Dibatalkan' ? 'selected' : ''; ?>>Dibatalkan</option>
                            </select>
                            <button type="submit">Update</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>