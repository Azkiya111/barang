<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Data Barang</h2>
    <a href="tambah.php" class="btn btn-primary mb-3">Tambah Barang</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM tabel_barang") or die("Query error: " . mysqli_error($conn));

        if (!$result) {
            die("Query error: " . mysqli_error($conn));
        }
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?= $row['kode'] ?></td>
                <td><?= $row['nama_barang'] ?></td>
                <td><?= $row['deskripsi'] ?></td>
                <td><?= $row['harga_satuan'] ?></td>
                <td><?= $row['jumlah'] ?></td>
                <td><img src="assets/<?= $row['foto'] ?>" width="50"></td>
                <td>
                    <a href="edit.php?kode=<?= $row['kode'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus.php?kode=<?= $row['kode'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>