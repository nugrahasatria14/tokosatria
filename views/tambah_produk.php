<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>Tambah Produk</title>
  <style>
    * {
      margin: 0; padding: 0;
      box-sizing: border-box;
      font-family: Poppins, sans-serif;
    }
    body {
      min-height: 100vh;
      background: #ffffff;
      padding: 1rem;
    }
    .wrapper {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    header {
      width: 100%;
      margin-bottom: 30px;
    }
    form.container {
      width: 100%;
      max-width: 400px;
      background: #f9f9f9;
      border-radius: 12px;
      padding: 2rem;
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    }
    h1 {
      color: #333;
      text-align: center;
      margin-bottom: 1.5rem;
    }
    .form-group {
      margin-bottom: 1rem;
    }
    .form-group label {
      display: block;
      margin-bottom: 0.3rem;
      color: #333;
      font-size: 0.95rem;
    }
    .form-group input {
      width: 100%;
      padding: 0.6rem;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
    }
    .form-group input:focus {
      outline: 2px solid #667eea;
    }
    button {
      width: 100%;
      margin-top: 1rem;
      padding: 0.75rem;
      border: none;
      border-radius: 6px;
      background: #3182ce;
      color: #fff;
      font-size: 1rem;
      cursor: pointer;
      transition: background 0.3s;
    }
    button:hover {
      background: #2b6cb0;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <form action="../controllers/tambah_produk.php" method="POST" enctype="multipart/form-data" class="container">
      <h1>Tambah Produk</h1>

      <div class="form-group">
        <label for="nama_produk">Nama Produk</label>
        <input type="text" id="nama_produk" name="nama_produk" required placeholder="Masukkan nama produk">
      </div>

      <div class="form-group">
        <label for="harga">Harga</label>
        <input type="number" id="harga" name="harga" required placeholder="Masukkan harga">
      </div>

      <div class="form-group">
        <label for="harga_awal">Harga Awal (Opsional)</label>
        <input type="number" id="harga_awal" name="harga_awal" placeholder="Harga sebelum diskon">
      </div>

      <div class="form-group">
        <label for="kota">Kota</label>
        <input type="text" id="kota" name="kota" required placeholder="Contoh: Kota Bekasi">
      </div>

      <div class="form-group">
        <label for="estimasi">Estimasi Tiba</label>
        <input type="text" id="estimasi" name="estimasi" required placeholder="Contoh: 7-8 Juni">
      </div>

      <div class="form-group">
        <label for="gambar">Gambar</label>
        <input type="file" id="gambar" name="gambar" accept="image/*" required>
      </div>

      <button type="submit">Simpan Produk</button>
    </form>
  </div>
</body>
</html>
