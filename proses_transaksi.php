<?php

require_once "includes/cek_session.php";
require_once "config/koneksi.php";

if (
    $_SESSION['role'] != 'kasir' &&
    $_SESSION['role'] != 'admin'
) {
    die("Akses ditolak.");
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: transaksi.php");
    exit;
}

$id_user = (int) $_SESSION['id_user'];

$id_pelanggan = !empty($_POST['id_pelanggan'])
    ? (int) $_POST['id_pelanggan']
    : "NULL";

$id_barang = $_POST['id_barang'] ?? [];
$jumlah = $_POST['jumlah'] ?? [];

if (count($id_barang) == 0) {
    die("Produk belum dipilih.");
}

mysqli_begin_transaction($koneksi);

try {

    $total = 0;
    $items = [];

    for ($i = 0; $i < count($id_barang); $i++) {

        $barang_id = (int) $id_barang[$i];
        $qty = (int) $jumlah[$i];

        if ($qty <= 0) {
            throw new Exception("Jumlah barang tidak valid.");
        }

        $query = mysqli_query(
            $koneksi,
            "SELECT * FROM tbl_barang
             WHERE id_barang=$barang_id
             FOR UPDATE"
        );

        if (mysqli_num_rows($query) == 0) {
            throw new Exception("Barang tidak ditemukan.");
        }

        $barang = mysqli_fetch_assoc($query);

        if ($barang['stok'] < $qty) {
            throw new Exception(
                "Stok {$barang['nama_barang']} tidak mencukupi."
            );
        }

        $harga = (float) $barang['harga'];
        $subtotal = $harga * $qty;

        $total += $subtotal;

        $items[] = [
            'id_barang' => $barang_id,
            'jumlah' => $qty,
            'harga' => $harga,
            'subtotal' => $subtotal
        ];
    }

    mysqli_query(
        $koneksi,
        "INSERT INTO tbl_transaksi
        (id_user, id_pelanggan, total_harga)
        VALUES
        ($id_user, $id_pelanggan, $total)"
    );

    $id_transaksi = mysqli_insert_id($koneksi);

    foreach ($items as $item) {

        mysqli_query(
            $koneksi,
            "INSERT INTO tbl_detail_transaksi
            (id_transaksi, id_barang, jumlah, harga, subtotal)
            VALUES
            (
                $id_transaksi,
                {$item['id_barang']},
                {$item['jumlah']},
                {$item['harga']},
                {$item['subtotal']}
            )"
        );

        mysqli_query(
            $koneksi,
            "UPDATE tbl_barang
             SET stok = stok - {$item['jumlah']}
             WHERE id_barang={$item['id_barang']}"
        );
    }

    mysqli_commit($koneksi);

    header(
        "Location: struk_transaksi.php?id=$id_transaksi"
    );

    exit;

} catch (Exception $e) {

    mysqli_rollback($koneksi);

    die(
        "Transaksi gagal: " .
        htmlspecialchars($e->getMessage())
    );
}

?>