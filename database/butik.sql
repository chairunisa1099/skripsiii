-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jun 2021 pada 11.48
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `butik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `gambar`
--

CREATE TABLE `gambar` (
  `id_gambar` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `judul_gambar` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `header_transaksi`
--

CREATE TABLE `header_transaksi` (
  `id_header_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telepon` varchar(50) DEFAULT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `jumlah_transaksi` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `status_bayar` varchar(20) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `tanggal_bayar` datetime NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `header_transaksi`
--

INSERT INTO `header_transaksi` (`id_header_transaksi`, `id_user`, `id_pelanggan`, `nama_pelanggan`, `email`, `telepon`, `alamat`, `kode_transaksi`, `tanggal_transaksi`, `jumlah_transaksi`, `order_id`, `status_bayar`, `jumlah_bayar`, `tanggal_bayar`, `tanggal_update`) VALUES
(74, 0, 9, 'Chairunisa', 'chairunisa@gmail.com', '087774133238', 'jalan coklat', '140620210NRAGUCV', '2021-06-14 00:00:00', 329000, 0, 'pending', 0, '2021-06-14 11:04:42', '2021-06-14 09:04:42'),
(75, 0, 9, 'Chairunisa', 'chairunisa@gmail.com', '087774133238', 'jalan coklat', '140620213WJNMK5Y', '2021-06-14 00:00:00', 239000, 0, 'pending', 0, '2021-06-14 11:45:56', '2021-06-14 09:45:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `slug_kategori` varchar(255) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `urutan` int(11) DEFAULT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `slug_kategori`, `nama_kategori`, `urutan`, `tanggal_update`) VALUES
(1, 'tunik', 'TUNIK', 1, '2021-02-09 05:06:47'),
(11, 'blouse', 'BLOUSE', 2, '2021-02-09 05:06:54'),
(12, 'gamis', 'GAMIS', 3, '2021-02-09 05:07:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_request`
--

CREATE TABLE `kategori_request` (
  `id_kategori_request` int(11) NOT NULL,
  `slug_kategori_request` varchar(255) NOT NULL,
  `nama_kategori_request` varchar(255) NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori_request`
--

INSERT INTO `kategori_request` (`id_kategori_request`, `slug_kategori_request`, `nama_kategori_request`, `tanggal_update`) VALUES
(2, 'tunik', 'Tunik', '2021-03-17 04:58:03'),
(4, 'gamis', 'Gamis', '2021-03-17 04:55:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfigurasi`
--

CREATE TABLE `konfigurasi` (
  `id_konfigurasi` int(11) NOT NULL,
  `namaweb` varchar(255) NOT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `keywords` text DEFAULT NULL,
  `metatext` text DEFAULT NULL,
  `telepon` varchar(50) DEFAULT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `rekening_pembayaran` varchar(255) DEFAULT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `konfigurasi`
--

INSERT INTO `konfigurasi` (`id_konfigurasi`, `namaweb`, `tagline`, `email`, `website`, `keywords`, `metatext`, `telepon`, `alamat`, `facebook`, `instagram`, `deskripsi`, `logo`, `icon`, `rekening_pembayaran`, `tanggal_update`) VALUES
(1, 'Butik Rizza Collection', 'Spesialis busana hijab wanita', 'rizzacollection@gmail.com', 'rizzacollection.com', '', NULL, '087774133238', 'Jalan Ikan Piranha Atas No 64, Malang', 'http://facebook/rizzacollection', 'http://instagram/rizzacollection', '', 'Skripsi.png', 'logo.PNG', NULL, '2021-06-12 11:06:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `motif`
--

CREATE TABLE `motif` (
  `id_motif` int(11) NOT NULL,
  `kode_motif` varchar(20) NOT NULL,
  `nama_motif` varchar(255) NOT NULL,
  `slug_motif` varchar(255) NOT NULL,
  `gambar_motif` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `motif`
--

INSERT INTO `motif` (`id_motif`, `kode_motif`, `nama_motif`, `slug_motif`, `gambar_motif`) VALUES
(3, 'G001', 'Egyptyan', 'egyptyan-g001', 'g011.png'),
(4, 'G002', 'Flowyshine', 'flowyshine-g002', 'g021.png'),
(5, 'G003', 'Bluesky', 'bluesky-g003', 'g031.png'),
(6, 'G006', 'Polka', 'polka-g006', 'g061.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status_pelanggan` varchar(20) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `telepon` varchar(50) DEFAULT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `tanggal_daftar` datetime NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `id_user`, `status_pelanggan`, `nama_pelanggan`, `email`, `password`, `telepon`, `alamat`, `tanggal_daftar`, `tanggal_update`) VALUES
(9, 0, 'Aktif', 'Chairunisa', 'chairunisa@gmail.com', '123123', '087774133238', 'jalan coklat', '2021-05-25 10:02:51', '2021-05-25 08:02:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `kode_produk` varchar(20) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `slug_produk` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `keywords` text DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) DEFAULT NULL,
  `gambar` varchar(255) NOT NULL,
  `berat` float DEFAULT NULL,
  `status_produk` varchar(20) NOT NULL,
  `tanggal_post` datetime NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_user`, `id_kategori`, `kode_produk`, `nama_produk`, `slug_produk`, `keterangan`, `keywords`, `harga`, `stok`, `gambar`, `berat`, `status_produk`, `tanggal_post`, `tanggal_update`) VALUES
(25, 16, 12, 'G001', 'Serenity Dress', 'serenity-dress-g001', '<p><strong>Material Lace cotton, special material who will make simple and more elegant!</strong><br />\r\nFull furing with jersey material, super comfy for best inner.<br />\r\nAvailable in 7 colour!&nbsp;<br />\r\nBusui friendly<br />\r\nWudhu friendly<br />\r\nPackaging with Goodie bag</p>\r\n\r\n<hr />\r\n<p><br />\r\n&nbsp;</p>\r\n\r\n<figure class=\"easyimage easyimage-full\"><img alt=\"\" src=\"blob:http://localhost/87415a8d-337e-4e53-8748-39cf0b25700c\" width=\"416\" />\r\n<figcaption></figcaption>\r\n</figure>\r\n\r\n<p>&nbsp;</p>\r\n', '', 249000, 2, 'Screenshot_2021-06-12_1540491.png', 100, 'Publish', '2021-06-01 05:56:08', '2021-06-12 09:19:26'),
(26, 16, 1, 'T001', 'Jihan Long Tunic', 'jihan-long-tunic-t001', '<p>Material Rose crape, halus jatuh dan tidak terawang.&nbsp;<br />\r\nBusui friendly<br />\r\nWudhu friendly</p>\r\n', 'Jihan', 229000, 2, 'Screenshot_2021-06-12_1546551.png', 100, 'Publish', '2021-06-12 10:50:31', '2021-06-12 09:19:07'),
(27, 16, 11, 'B001', 'Ivona Blouse', 'ivona-blouse-b001', '<p>Ivona Blouse classic and timeless&nbsp;</p>\r\n', '', 159000, 1, 'image_4.png', 100, 'Publish', '2021-06-12 11:01:16', '2021-06-12 09:19:19'),
(28, 16, 11, 'B002', 'Yumna Blouse', 'yumna-blouse-b002', '<p>Material Lace cotton, special material who will make simple and more elegant!<br />\r\nFull furing with jersey material, super comfy for best inner.<br />\r\nAvailable in 7 colour!</p>\r\n', '', 239000, 1, 'image4.png', 100, 'Publish', '2021-06-12 11:18:43', '2021-06-12 09:21:08'),
(29, 16, 1, 'T002', 'Egyptyan Tunic', 'egyptyan-tunic-t002', '<p>Material Lace cotton, special material who will make simple and more elegant!<br />\r\nFull furing with jersey material, super comfy for best inner.<br />\r\nAvailable in 7 colour!</p>\r\n', '', 215000, 2, 'image5.png', 100, 'Publish', '2021-06-12 11:20:21', '2021-06-12 09:21:28'),
(30, 16, 12, 'G002', 'Egyptyan Red Gamis', 'egyptyan-red-gamis-g002', '<p>Material Lace cotton, special material who will make simple and more elegant!<br />\r\nFull furing with jersey material, super comfy for best inner.<br />\r\nAvailable in 7 colour!</p>\r\n', '', 329000, 1, 'image6.png', 100, 'Publish', '2021-06-12 11:22:14', '2021-06-12 09:22:14'),
(31, 16, 12, 'G003', 'Long Dress Ivory', 'long-dress-ivory-g003', '<p>Material Lace cotton, special material who will make simple and more elegant!<br />\r\nFull furing with jersey material, super comfy for best inner.<br />\r\nAvailable in 7 colour!</p>\r\n', '', 329000, 2, 'image7.png', 100, 'Publish', '2021-06-12 11:33:39', '2021-06-12 09:33:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `request`
--

CREATE TABLE `request` (
  `id_request` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `ukuran_busana` varchar(255) NOT NULL,
  `bahan_busana` varchar(255) NOT NULL,
  `motif_busana` varchar(255) NOT NULL,
  `gambar_desain` varchar(255) NOT NULL,
  `harga_request` int(11) NOT NULL,
  `tanggal_transaksi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `request`
--

INSERT INTO `request` (`id_request`, `id_user`, `id_pelanggan`, `kode_transaksi`, `ukuran_busana`, `bahan_busana`, `motif_busana`, `gambar_desain`, `harga_request`, `tanggal_transaksi`) VALUES
(57, 0, 0, '140620210LU9UETZ', 'S', 'Katun Rayon', 'Bunga', 'Skripsi.png', 120000, '2021-06-14 09:46:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `id_pelanggan`, `kode_transaksi`, `id_produk`, `harga`, `jumlah`, `total_harga`, `tanggal_transaksi`, `tanggal_update`) VALUES
(48, 0, 9, '140620210NRAGUCV', 30, 329000, 1, 329000, '2021-06-14 00:00:00', '2021-06-14 09:04:42'),
(49, 0, 9, '140620213WJNMK5Y', 28, 239000, 1, 239000, '2021-06-14 00:00:00', '2021-06-14 09:45:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(64) NOT NULL,
  `akses_level` varchar(20) NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `username`, `password`, `akses_level`, `tanggal_update`) VALUES
(16, 'Admin', 'admin@gmail.com', 'adminn', '123123', 'Admin', '2021-05-23 08:43:56'),
(17, 'Chairunisa Dwinanda Asti', 'chairunisa@gmail.com', 'chairunisa', '123123', 'Admin', '2021-06-13 10:10:52');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `gambar`
--
ALTER TABLE `gambar`
  ADD PRIMARY KEY (`id_gambar`);

--
-- Indeks untuk tabel `header_transaksi`
--
ALTER TABLE `header_transaksi`
  ADD PRIMARY KEY (`id_header_transaksi`),
  ADD UNIQUE KEY `kode_transaksi` (`kode_transaksi`),
  ADD KEY `fk_header_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `kategori_request`
--
ALTER TABLE `kategori_request`
  ADD PRIMARY KEY (`id_kategori_request`);

--
-- Indeks untuk tabel `konfigurasi`
--
ALTER TABLE `konfigurasi`
  ADD PRIMARY KEY (`id_konfigurasi`);

--
-- Indeks untuk tabel `motif`
--
ALTER TABLE `motif`
  ADD PRIMARY KEY (`id_motif`),
  ADD UNIQUE KEY `kode_motif` (`kode_motif`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD UNIQUE KEY `kode_produk` (`kode_produk`),
  ADD KEY `fk_produk_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id_request`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk_transaksi_pelanggan` (`id_pelanggan`),
  ADD KEY `fk_transaksi_produk` (`id_produk`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `gambar`
--
ALTER TABLE `gambar`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `header_transaksi`
--
ALTER TABLE `header_transaksi`
  MODIFY `id_header_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `kategori_request`
--
ALTER TABLE `kategori_request`
  MODIFY `id_kategori_request` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `konfigurasi`
--
ALTER TABLE `konfigurasi`
  MODIFY `id_konfigurasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `motif`
--
ALTER TABLE `motif`
  MODIFY `id_motif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `request`
--
ALTER TABLE `request`
  MODIFY `id_request` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `header_transaksi`
--
ALTER TABLE `header_transaksi`
  ADD CONSTRAINT `fk_header_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`);

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `fk_produk_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `fk_transaksi_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
