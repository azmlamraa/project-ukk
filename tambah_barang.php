<!-- tambah_barang.php -->
 <?php include 'includes/cek_session.php'; ?>
 <!DOCTYPE html>
 <html>
    <head><title>Tambah Barang - Warung ABC</title></head>
    <body>
        <hl>Tambah Barang</h1>
        <form action="proses_tambah_barang.php" method="POST">
            <table>
                <tr><td>kode Barang</td><td>:</td>
                <td><input type="text" name="kode_barang" required></td></tr>
                <tr><td>Nama Barang</td><td>:</td>
                <td><input type="text" name="nama_barang" required></td></tr>
                <tr><td>Harga Satuan</td><td>:</td>
                <td><input type="number" name="harga_satuan" step="0.01" required></td></tr>
                <tr><td>Stok</td><td>:</td>
                <td><input type= "number" name="stok" required></td></tr>
                <tr><td> tanggal kadaluarsa</td><td> :</td>
                <td><input type="date" name="tanggal_kadaluarsa"></td></tr>
                <tr><td colspan="3"><input type="submit" value="Simpan"></td></tr>
</table>
</form>
<p><a href="data_barang.php">kembali</a></p>
</body>
</html>