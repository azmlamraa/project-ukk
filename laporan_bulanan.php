<?php
Include 'includes/cek_session.php';
include 'config/koneksi.php';

$bulan isset($_GET['bulan']) ? $ GET['bulan']: date('V-s'); 
$bulan mysqli_real_escape_string($koneksi, $bulan);

$sql = "SELECT t.no_transaksi, t.tanggal, t.total_bayar, u.nama_lengkap AS nama_kasir";
$sql = "FROM tbl_transaksi t JOIN tbl_user u ON t.id_kasir = u.id_user"; 
$sql = "WHERE DATE_FORMAT(t.tanggal, '%Y-%m') = '$bulan' ORDER BY t.tanggal ASC";
$hasil mysqli_query($koneksi, $sql);

$total_bulanan = 0;
$jumlah_transaksi = 0; 
?>
<!DOCTYPE html>
<html>
<head><title>Laporan Bulanan Warung ABC</title></head>
<body>
     <h1>Laporan Transaksi Bulanan</h1>
     <form method="GET">
        Bulan: <input type="month" name="bulan" value="<?php echo $bulan; ?>">
        <input type="submit" value="Tampilkan">
    </form>
    <table border="1" cellpadding="6">
        <tr><th>No. Transaksi</th><th>Tanggal</th><th>Kasir</th><th>Total Bayar</th></tr>
        <?php while ($row mysqli_fetch_assoc($hasil)) {
            $total_bulanan += $row['total_bayar'];
            $jumlah_transaksi++;
        ?>
        <tr>
            <td><?php echo $row['no transaksi']; ?></td>
            <td><?php echo $row['tanggal']; ?></td>
            <td><?php echo $row['nama kasir']; ?></td>
            <td><?php echo number_format ($row['total bayar'],0 ',', '.'); ?></td>
        </tr>
    <?php } ?>
    </table>
    <p>Jumlah Transaksi: <?php echo $jumlah_transaksi; ?></p>
    <p>Total Pendapatan Bulan Ini: Rp
    <?php echo number_format($total_bulanan, 0, ',', '.'); ?></p>
    <p><a href="dashboard.php">Kembali ke Dashboard</a></p>
</body> 
</html>