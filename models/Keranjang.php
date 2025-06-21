<?php
class Keranjang
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function add($user_id, $produk_id, $jumlah)
    {
        $stmt = $this->pdo->prepare("INSERT INTO keranjang (user_id, produk_id, qty) VALUES (?, ?, ?)");
        return $stmt->execute([$user_id, $produk_id, $jumlah]);
    }

    public function getByUser($user_id)
    {
        $stmt = $this->pdo->prepare("
        SELECT k.*, p.nama_produk, p.harga, p.gambar 
        FROM keranjang k 
        JOIN produk p ON k.produk_id = p.id 
        WHERE k.user_id = :user_id
    ");
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateQty($id, $qty)
    {
        $stmt = $this->pdo->prepare("UPDATE keranjang SET qty = ? WHERE id = ?");
        return $stmt->execute([$qty, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM keranjang WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM keranjang WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
