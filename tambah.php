<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Tambah Barang</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="kode" class="form-control mb-2" placeholder="Kode" required>
        <input type="text" name="nama_barang" class="form-control mb-2" placeholder="Nama Barang" required>
        <textarea name="deskripsi" class="form-control mb-2" placeholder="Deskripsi" required></textarea>
        <input type="number" name="harga_satuan" class="form-control mb-2" placeholder="Harga Satuan" required>
        <input type="number" name="jumlah" class="form-control mb-2" placeholder="Jumlah" required>
        <input type="file" name="foto" class="form-control mb-2" required>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
    </form>
    <a href="index.php" class="btn btn-secondary mt-2">Kembali</a>

    <?php
    if (isset($_POST['simpan'])) {
        $kode = $_POST['kode'];
        $nama = $_POST['nama_barang'];
        $desc = $_POST['deskripsi'];
        $harga = $_POST['harga_satuan'];
        $jumlah = $_POST['jumlah'];
        $foto = $_FILES['foto']['name'];
        $tmp  = $_FILES['foto']['tmp_name'];

        move_uploaded_file($tmp, "assets/" . $foto);

        $sql = "INSERT INTO tabel_barang (kode, nama_barang, deskripsi, harga_satuan, jumlah, foto) 
        VALUES ('$kode', '$nama', '$desc', '$harga', '$jumlah', '$foto')";
        mysqli_query($conn, $sql);
        echo "<script>window.location='index.php';</script>";
    }
    ?>
</div>
</body>
</html>