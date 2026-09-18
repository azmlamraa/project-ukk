<?php
Include 'includes/cek_session.php';
include 'config/koneksi.php';

$tanggal = isset($GET['tanggal']) ? $ GET['tanggal']: date('Y-m-d');
$tanggal = mysqli_real_escape string(koneksi, Stanggal);

$sql = "SELECT t.no transaksi, t.tanggal, t.total_bayar, u.nama_lengkap AS nama_kasir"; 
$sql = "FROM tbl_transaksi t J01N tbl_user u ON t.id_kasir = d_user";
$sql. = "WHERE DATE(t. tanggal) '$tanggal' ORDER BY t.tanggal ASC";
$hasil = mysqli_query($koneksi, $sql);

$total harian 0;
?>
<!DOCTYPE html>
<html>
<head><title>Laporan Harian - Warung ABC</title></head>
<body>
     <h1>Laporan Transaksi Harian</h1>
     <form method="GET">
           Tanggal: <input type="date" name="tanggal" value="<?php echo $tanggal; ?>">
           <input type="submit" value="Tampilkan">
     </form>
     <table border="1" cellpadding="6">
         <tr><th>No. Transaksi</th><th>Waktu</th><th>Kasir</th><th>Total Bayar</th></tr>
         <?php while ($row = mysqli_fetch_assoc($hasil)) {
            $total_harian += $row['total_bayar'];
     ?>
     <tr>
         <td><?php echo $row['no_transaksi']; ?></td>
         <td><?php echo $row['tanggal']; ?></td>
         <td><?php echo $row['nama_kasir']; ?></td>
         <td><?php echo number_format($row['total_bayar'], 0, ',','.'); ?></td>
     </tr>
     <?php } ?>
     <tr><td colspan="3">Total Pendapatan Hari Ini</td>
         <td><?php echo number_format($total harian, 0,',','.'); ?></td></tr>
     </table>
     <p><a href="dashboard.php">Kembali ke Dashboard</a></p>
</body>
</html>