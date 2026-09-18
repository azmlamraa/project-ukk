-- ==========================================================
-- DATABASE SISTEM INFORMASI MANAJEMEN PENJUALAN
-- PHP NATIVE + MYSQL
-- ==========================================================

CREATE DATABASE IF NOT EXISTS db_penjualan
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE db_penjualan;


-- ==========================================================
-- 1. TABEL USER
-- ==========================================================

DROP TABLE IF EXISTS tbl_detail_transaksi;
DROP TABLE IF EXISTS tbl_transaksi;
DROP TABLE IF EXISTS tbl_barang;
DROP TABLE IF EXISTS tbl_pelanggan;
DROP TABLE IF EXISTS tbl_user;


CREATE TABLE tbl_user (
    id_user INT(11) NOT NULL AUTO_INCREMENT,
    nama_lengkap VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','kasir','pemilik') NOT NULL,

    PRIMARY KEY (id_user),
    UNIQUE KEY username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ==========================================================
-- 2. TABEL PELANGGAN
-- ==========================================================

CREATE TABLE tbl_pelanggan (
    id_pelanggan INT(11) NOT NULL AUTO_INCREMENT,
    nama_pelanggan VARCHAR(100) NOT NULL,
    alamat TEXT,
    no_telepon VARCHAR(20),

    PRIMARY KEY (id_pelanggan)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ==========================================================
-- 3. TABEL BARANG
-- ==========================================================

CREATE TABLE tbl_barang (
    id_barang INT(11) NOT NULL AUTO_INCREMENT,
    nama_barang VARCHAR(100) NOT NULL,
    kategori VARCHAR(100),
    harga DECIMAL(12,2) NOT NULL DEFAULT 0,
    stok INT(11) NOT NULL DEFAULT 0,

    PRIMARY KEY (id_barang)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ==========================================================
-- 4. TABEL TRANSAKSI
-- ==========================================================

CREATE TABLE tbl_transaksi (
    id_transaksi INT(11) NOT NULL AUTO_INCREMENT,
    tanggal_transaksi DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_user INT(11) NOT NULL,
    id_pelanggan INT(11) DEFAULT NULL,
    total_harga DECIMAL(12,2) NOT NULL DEFAULT 0,

    PRIMARY KEY (id_transaksi),

    KEY idx_id_user (id_user),
    KEY idx_id_pelanggan (id_pelanggan),

    CONSTRAINT fk_transaksi_user
        FOREIGN KEY (id_user)
        REFERENCES tbl_user (id_user)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,

    CONSTRAINT fk_transaksi_pelanggan
        FOREIGN KEY (id_pelanggan)
        REFERENCES tbl_pelanggan (id_pelanggan)
        ON UPDATE CASCADE
        ON DELETE SET NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ==========================================================
-- 5. TABEL DETAIL TRANSAKSI
-- ==========================================================

CREATE TABLE tbl_detail_transaksi (
    id_detail INT(11) NOT NULL AUTO_INCREMENT,
    id_transaksi INT(11) NOT NULL,
    id_barang INT(11) NOT NULL,
    jumlah INT(11) NOT NULL,
    harga DECIMAL(12,2) NOT NULL DEFAULT 0,
    subtotal DECIMAL(12,2) NOT NULL DEFAULT 0,

    PRIMARY KEY (id_detail),

    KEY idx_id_transaksi (id_transaksi),
    KEY idx_id_barang (id_barang),

    CONSTRAINT fk_detail_transaksi
        FOREIGN KEY (id_transaksi)
        REFERENCES tbl_transaksi (id_transaksi)
        ON UPDATE CASCADE
        ON DELETE CASCADE,

    CONSTRAINT fk_detail_barang
        FOREIGN KEY (id_barang)
        REFERENCES tbl_barang (id_barang)
        ON UPDATE CASCADE
        ON DELETE RESTRICT

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ==========================================================
-- DATA AWAL USER
-- ==========================================================

INSERT INTO tbl_user
(nama_lengkap, username, password, role)
VALUES
('Administrator', 'admin', MD5('admin123'), 'admin'),
('Kasir Utama', 'kasir', MD5('kasir123'), 'kasir'),
('Pemilik Toko', 'pemilik', MD5('pemilik123'), 'pemilik');


-- ==========================================================
-- DATA AWAL PELANGGAN
-- ==========================================================

INSERT INTO tbl_pelanggan
(nama_pelanggan, alamat, no_telepon)
VALUES
('Andi', 'Tasikmalaya', '081234567890'),
('Budi', 'Tasikmalaya', '082345678901'),
('Citra', 'Tasikmalaya', '083456789012'),
('Dewi', 'Tasikmalaya', '084567890123'),
('Eka', 'Tasikmalaya', '085678901234');


-- ==========================================================
-- DATA AWAL BARANG
-- ==========================================================

INSERT INTO tbl_barang
(nama_barang, kategori, harga, stok)
VALUES
('Roti Bakar Coklat', 'Roti Bakar', 10000, 50),
('Roti Bakar Keju', 'Roti Bakar', 12000, 40),
('Roti Bakar Coklat Keju', 'Roti Bakar', 15000, 35),
('Roti Bakar Strawberry', 'Roti Bakar', 13000, 30),
('Roti Bakar Blueberry', 'Roti Bakar', 13000, 30),
('Roti Bakar Kacang', 'Roti Bakar', 12000, 25),
('Roti Bakar Oreo', 'Roti Bakar', 14000, 25),
('Roti Bakar Milo', 'Roti Bakar', 15000, 25);


-- ==========================================================
-- DATA CONTOH TRANSAKSI
-- ==========================================================

INSERT INTO tbl_transaksi
(tanggal_transaksi, id_user, id_pelanggan, total_harga)
VALUES
('2026-09-18 08:30:00', 2, 1, 25000),
('2026-09-18 09:15:00', 2, 2, 27000);


-- ==========================================================
-- DATA CONTOH DETAIL TRANSAKSI
-- ==========================================================

INSERT INTO tbl_detail_transaksi
(id_transaksi, id_barang, jumlah, harga, subtotal)
VALUES
(1, 1, 1, 10000, 10000),
(1, 2, 1, 12000, 12000),
(1, 3, 1, 3000, 3000),

(2, 4, 1, 13000, 13000),
(2, 5, 1, 13000, 13000),
(2, 2, 1, 1000, 1000);


-- ==========================================================
-- SELESAI
-- ==========================================================