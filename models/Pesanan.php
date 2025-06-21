<?php
class Pesanan {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($user_id, $produk_id, $jumlah, $total_harga) {
        $stmt = $this->pdo->prepare("INSERT INTO pesanan 
            (user_id, produk_id, jumlah, total_harga) 
            VALUES (?, ?, ?, ?)");
        return $stmt->execute([$user_id, $produk_id, $jumlah, $total_harga]);
    }

    public function getByUser($user_id) {
        $stmt = $this->pdo->prepare("
            SELECT p.*, pr.nama_produk, pr.gambar, pr.harga 
            FROM pesanan p
            JOIN produk pr ON p.produk_id = pr.id
            WHERE p.user_id = ?
            ORDER BY p.created_at DESC
        ");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll() {
        $stmt = $this->pdo->query("
            SELECT p.*, u.username, pr.nama_produk 
            FROM pesanan p
            JOIN users u ON p.user_id = u.id
            JOIN produk pr ON p.produk_id = pr.id
            ORDER BY p.created_at DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM pesanan WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status) {
        $stmt = $this->pdo->prepare("UPDATE pesanan SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }
    
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM pesanan WHERE id = ?");
        return $stmt->execute([$id]);
    }

}
