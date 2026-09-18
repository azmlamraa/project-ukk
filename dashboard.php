<?php
include 'includes/cek_session.php';
?>
<!DOCTYPE html>
<html>
<head>
   <title>Dashboard - warung ABC</title>
</head>
<body>
   <h1>Selamat datang, <?php echo $_SESSION['nama_lengkap']; ?></h1> 
   <P>Anda login sebagai: <?php echo $_SESSION['role']; ?></p> 

</ul>
<?php if ($_SESSION['role'] == 'admin' ||  $_SESSION['role'] == 'gudang'){ ?>
   <li><a href="data_barang.php">Data Barang</a></li>
<?php } ?>

<?php if ($_SESSION['role'] == 'admin' ||  $_SESSION['role'] == 'kasir'){?>
   <li><a href="transaksi.php">Transaksi Kasir</a></li>
   <li><a href="riwayat_transaksi.php">Riwayat Transaksi</a></li>
   <li><a href="data_pelanggan.php">Data Pelanggan</a></li>
<?php } ?>
</ul>

<a href="logout.php">logout</a>
</body>
</html>