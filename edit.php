<?php
include 'config/koneksi.php';

// Ambil data berdasarkan kode dari URL
$kode_lama = $_GET['kode'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tabel_barang WHERE kode='$kode_lama'"));

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $kode_baru = $_POST['kode'];
  $nama = $_POST['nama_barang'];
  $deskripsi = $_POST['deskripsi'];
  $harga = $_POST['harga_satuan'];
  $jumlah = $_POST['jumlah'];

  // Cek jika ada file foto diunggah
  if ($_FILES['foto']['name']) {
    $foto_name = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    move_uploaded_file($tmp, "assets/img/" . $foto_name);
  } else {
    $foto_name = $data['foto'];
  }

  // Update data
  $query = "UPDATE tabel_barang SET 
              kode='$kode_baru',
              nama_barang='$nama', 
              deskripsi='$deskripsi', 
              harga_satuan='$harga', 
              jumlah='$jumlah', 
              foto='$foto_name' 
            WHERE kode='$kode_lama'";
  mysqli_query($conn, $query);

  // Redirect ke index.php setelah update
  header("Location: index.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Barang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <div class="container">
    <h2>Edit Barang</h2>
    <form method="POST" enctype="multipart/form-data">
      <!-- Hidden untuk menyimpan kode lama -->
      <input type="hidden" name="kode_lama" value="<?= $data['kode'] ?>">

      <div class="mb-2">
        <label>Kode</label>
        <input type="text" name="kode" value="<?= $data['kode'] ?>" class="form-control" required>
      </div>
      <div class="mb-2">
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" value="<?= $data['nama_barang']; ?>" class="form-control" required>
      </div>
      <div class="mb-2">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control"><?= $data['deskripsi'] ?></textarea>
      </div>
      <div class="mb-2">
        <label>Harga Satuan</label>
        <input type="number" name="harga_satuan" value="<?= $data['harga_satuan'] ?>" class="form-control">
      </div>
      <div class="mb-2">
        <label>Jumlah</label>
        <input type="number" name="jumlah" value="<?= $data['jumlah'] ?>" class="form-control">
      </div>
      <div class="mb-2">
        <label>Foto Baru (kosongkan jika tidak diubah)</label>
        <input type="file" name="foto" class="form-control">
        <p>Foto lama: <img src="assets/img/<?= $data['foto'] ?>" width="60"></p>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
      <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</body>
</html>