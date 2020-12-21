-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Des 2020 pada 18.43
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokoonline`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `Username` varchar(120) NOT NULL,
  `Password` varchar(120) NOT NULL,
  `RegisDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `Username`, `Password`, `RegisDate`, `UpdateDate`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', '2020-12-16 09:18:22', '2020-12-16 10:44:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart_tmp`
--

CREATE TABLE `cart_tmp` (
  `id_cart_tmp` int(100) NOT NULL,
  `id_produk` varchar(10) NOT NULL,
  `nama_produk` varchar(120) NOT NULL,
  `qty` int(5) NOT NULL,
  `gambar` varchar(200) NOT NULL,
  `harga` int(11) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `Namakategori` varchar(120) NOT NULL,
  `RegisDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `Namakategori`, `RegisDate`) VALUES
(1, 'Hoodie', '2020-12-16 11:19:50'),
(3, 'Sweater', '2020-12-16 11:21:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(120) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `stok_produk` int(11) NOT NULL,
  `harga_produk` varchar(50) NOT NULL,
  `gambar_produk` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `nama_produk`, `id_kategori`, `deskripsi_produk`, `stok_produk`, `harga_produk`, `gambar_produk`) VALUES
(1, 'Anti Social Social Club', 1, 'ASSC new original', 5, '1250000', '972e6995cfbd4e777236f61394d267a2.jpg'),
(2, 'NASA Sweater', 3, 'NASA brand hnm new ori. untuk cewe', 3, '250000', 'hmgoepprod.jpg'),
(3, 'H&M Polos Hitam', 3, 'HnM polos warna hitam. brand new with tag.\r\nukuran M', 2, '250000', 'hmgoepprod (1).jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_sold`
--

CREATE TABLE `product_sold` (
  `id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `nama_produk` varchar(120) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` varchar(20) NOT NULL,
  `total` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `product_sold`
--

INSERT INTO `product_sold` (`id`, `id_customer`, `nama_produk`, `qty`, `harga`, `total`, `date`) VALUES
(3, 1, 'NASA Sweater', 2, '250000', '500000', '2020-12-21 15:13:45'),
(4, 1, 'H&M Polos Hitam', 1, '250000', '250000', '2020-12-21 15:13:45'),
(5, 1, 'Anti Social Social Club', 1, '1250000', '1250000', '2020-12-21 16:33:12'),
(6, 4, 'H&M Polos Hitam', 2, '250000', '500000', '2020-12-21 17:35:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `nama` varchar(120) NOT NULL,
  `gambar_slider` varchar(120) NOT NULL,
  `UpdateDate` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `slider`
--

INSERT INTO `slider` (`id`, `nama`, `gambar_slider`, `UpdateDate`) VALUES
(1, 'slider 1', 'slider1.jpg', '2020-12-18 07:20:16'),
(2, 'slider 2', 'men4.jpg', '2020-12-18 07:16:39'),
(3, 'slider 3', 'kid6.jpg', '2020-12-18 07:17:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `resi` varchar(120) DEFAULT NULL,
  `alamat_lengkap` varchar(120) NOT NULL,
  `totalbayar` varchar(120) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `tanggal_transaksi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_customer`, `resi`, `alamat_lengkap`, `totalbayar`, `status`, `tanggal_transaksi`) VALUES
(18, 1, 'J22311222 JNE', 'Jalan Mancasan indah no 7 yogyakarta,08122727312,313123', '772000', 1, '2020-12-21 15:13:45'),
(19, 1, '', 'Jalan Mancasan indah no 7 yogyakarta,08122727312,313123', '1272000', 0, '2020-12-21 16:33:12'),
(20, 4, NULL, 'jalan gorongan V no 172,Depok,Sleman, Yogyakarta,08233211222,553281', '522000', 0, '2020-12-21 17:35:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `NamaLengkap` varchar(120) NOT NULL,
  `Email` varchar(120) NOT NULL,
  `Username` varchar(12) NOT NULL,
  `Password` varchar(120) NOT NULL,
  `Alamat` text NOT NULL,
  `Kodepos` varchar(20) NOT NULL,
  `No_telepon` varchar(120) NOT NULL,
  `RegisDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `NamaLengkap`, `Email`, `Username`, `Password`, `Alamat`, `Kodepos`, `No_telepon`, `RegisDate`, `UpdateDate`) VALUES
(1, 'Si Ganteng', 'coba@gmail.com', 'pembeli', '202cb962ac59075b964b07152d234b70', 'Jalan Mancasan indah no 7 yogyakarta', '313123', '08122727312', '2020-12-20 10:30:48', '2020-12-21 16:32:08'),
(4, 'abdul ajah', 'customer@gmail.com', 'abdul', '202cb962ac59075b964b07152d234b70', 'jalan gorongan V no 172,Depok,Sleman, Yogyakarta', '553281', '08233211222', '2020-12-21 17:34:12', '2020-12-21 17:34:28');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cart_tmp`
--
ALTER TABLE `cart_tmp`
  ADD PRIMARY KEY (`id_cart_tmp`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_sold`
--
ALTER TABLE `product_sold`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `cart_tmp`
--
ALTER TABLE `cart_tmp`
  MODIFY `id_cart_tmp` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `product_sold`
--
ALTER TABLE `product_sold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
