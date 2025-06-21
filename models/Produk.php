<?php
class Produk
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM produk ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM produk WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nama, $harga, $harga_awal, $kota, $estimasi, $gambar)
    {
        $query = "INSERT INTO produk (nama_produk, harga, harga_awal, kota, estimasi, gambar)
                  VALUES (:nama, :harga, :harga_awal, :kota, :estimasi, :gambar)";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([
            ':nama' => $nama,
            ':harga' => $harga,
            ':harga_awal' => $harga_awal,
            ':kota' => $kota,
            ':estimasi' => $estimasi,
            ':gambar' => $gambar
        ]);
    }

    public function update($id, $nama, $harga, $harga_awal, $kota, $estimasi, $gambar)
    {
        $query = "UPDATE produk 
              SET nama_produk = :nama, harga = :harga, harga_awal = :harga_awal, 
                  kota = :kota, estimasi = :estimasi, gambar = :gambar 
              WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([
            ':id' => $id,
            ':nama' => $nama,
            ':harga' => $harga,
            ':harga_awal' => $harga_awal,
            ':kota' => $kota,
            ':estimasi' => $estimasi,
            ':gambar' => $gambar
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM produk WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
