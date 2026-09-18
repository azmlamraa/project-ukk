<?php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$id = $_GET['id'];
$sql ="SELECT * FROM tbl_barang  WHERE id_barang = '$id'";
$hasil = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($hasil);
?>
<!DOCTYPE html>
<html>
<head>
   <title>Edit Barang - warung_abc</title>
</head>
<body>
   <h1>Edit Barang</h1>
   <form action="proses_edit_barang.php" method="POST">
        <input type="hidden" name="id_barang" value="<?php echo $data ['id_barang']; ?>">
        <table>
        <tr><td>Kode Barang</td><td>:</td>
            <td><input type="text" name="kode_barang"
               value="<?php echo $data ['kode_barang']; ?>" require></td></tr>
         <tr><td>Nama Barang</td><td>:</td>
            <td><input type="text" name="nama_barang"
               value="<?php echo $data ['nama_barang']; ?>" require></td></tr>
         <tr><td>Harga Satuan</td><td>:</td>
            <td><input type="text" name="harga_satuan"
               value="<?php echo $data ['harga_satuan']; ?>" require></td></tr>
         <tr><td>Stok</td><td>:</td>
            <td><input type="text" name="stok"
               value="<?php echo $data ['stok']; ?>" require></td></tr>
         <tr><td>tanggal kadaluarsa</td><td>:</td>
            <td><input type="date" name="tgl_kadaluarsa"require></td></tr>
         <tr><td colspan="3"><input type="submit" value="Update"></td></tr>
         </table>
   </from> 
   <p><a href="data_barang.php">Kembali</a></p>
</body>
</html>