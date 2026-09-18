<?php
session_start();
include 'includes/cek_session.php';
include 'config/koneksi.php';

$id = $_GET['id'];
$sql_cek = "SELECT nama_pelanggan FROM tbl_pelanggan WHERE id_pelanggan = '$id'";
$cek = mysqli_query($koneksi, $sql_cek);
$data = mysqli_fetch_assoc($cek);

$sql = "DELETE FROM tbl_pelanggan WHERE id_pelanggan = '$id'";

if (mysqli_query($koneksi, $sql)) {
   $id_user = $_SESSION['id_user'];
   $waktu = date('Y-m-d H:i:s');
   $aktivitas = "hapus pelanggan:" $data['nama_pelanggan']; 
   $log = "INSERT INTO tbl_log (id_user, aktivitas, waktu)";
   $log .= " VALUES ('$id_user', '$aktivitas', 'Swaktu')";
   mysqli_query($koneksi, $log);
}
header('Location: data_pelanggan.php');
exit;

?>