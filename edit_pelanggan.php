<?php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$id = $_GET['id'];
$sql = "SELECT * FROM tbl_pelanggan WHERE id_pelanggan = '$id'";
$hasil = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($hasil);
?>
<!DOCTYPE html>
<html>
<head><title>Edit Pelanggan - Warung ABC</title></head>
<body>
     <h1>Edit Pelanggan</h1>
     <form action="proses_edit_pelanggan.php" method="POST"> 
     <input type="hidden" name="id pelanggan"
            value="<?php echo $data['id pelanggan']; ?>">
    <table>
       <tr><td>Nama Pelanggan</td><td>:</td>
           <td><input type="text" name="nama_pelanggan"
                      value="<?php echo $data['nama_pelanggan']; ?>" required></td></tr>
       <tr><td>No. HP</td><td>:</td>
           <td><input type="text" name="no_hp"
                      value="<?php echo $data['no_hp']; ?>"></td></tr>
       <tr><td>Alamat</td><td>:</td>
           <td><input type="text" name = "alamat"
                      value="<?php echo $data['alamat']; ?>"></td></tr>
        <tr><td colspan="3"><input type="submit" value="Update"></td></tr>
      </table>
    </form>
    <p><a href="data pelanggan.php">Kembali</a></p>
</body>
</html>