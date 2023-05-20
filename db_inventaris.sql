-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Bulan Mei 2023 pada 14.11
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventaris`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangkeluar`
--

CREATE TABLE `barangkeluar` (
  `id` int(11) NOT NULL,
  `kodeBarang` varchar(15) NOT NULL,
  `jumlahKeluar` int(3) NOT NULL,
  `idDistribusi` int(11) NOT NULL,
  `tanggalKeluar` date NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barangkeluar`
--

INSERT INTO `barangkeluar` (`id`, `kodeBarang`, `jumlahKeluar`, `idDistribusi`, `tanggalKeluar`, `createdAt`, `updatedAt`) VALUES
(1, 'ELK-0001', 3, 1, '2023-04-12', '2023-04-13 02:19:46', NULL),
(2, 'ELK-0002', 1, 1, '2023-04-13', '2023-04-13 02:19:58', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangmasuk`
--

CREATE TABLE `barangmasuk` (
  `id` int(11) NOT NULL,
  `kategoriBarang` int(11) NOT NULL,
  `kodeBarang` varchar(15) NOT NULL,
  `namaBarang` varchar(100) NOT NULL,
  `tanggalMasuk` date NOT NULL,
  `stok` int(3) NOT NULL,
  `gambar` text NOT NULL,
  `codeQR` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barangmasuk`
--

INSERT INTO `barangmasuk` (`id`, `kategoriBarang`, `kodeBarang`, `namaBarang`, `tanggalMasuk`, `stok`, `gambar`, `codeQR`, `createdAt`, `updatedAt`) VALUES
(1, 1, 'ELK-0001', 'Monitor Samsul', '2023-04-12', 2, 'edb76b483626c379b7579c22d3a39bd9.jpeg', 'qrcode-20230412083156.png', '2023-04-12 04:53:13', '2023-04-13 02:19:47'),
(2, 1, 'ELK-0002', 'Monitor ASU S', '2023-04-12', 2, '0a379f61369ebb47f906d53f553f0b46.jpg', 'qrcode-20230412065421.png', '2023-04-12 04:54:21', '2023-04-13 02:19:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangrusak`
--

CREATE TABLE `barangrusak` (
  `id` int(11) NOT NULL,
  `idHelpdesk` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barangrusak`
--

INSERT INTO `barangrusak` (`id`, `idHelpdesk`, `createdAt`, `updatedAt`) VALUES
(3, 2, '2023-04-13 04:22:07', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `distribusi`
--

CREATE TABLE `distribusi` (
  `id` int(11) NOT NULL,
  `distribusi` varchar(100) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `distribusi`
--

INSERT INTO `distribusi` (`id`, `distribusi`, `createdAt`, `updatedAt`) VALUES
(1, 'Ruang Admin PMB', '2023-04-13 01:48:53', '2023-04-13 01:49:35'),
(2, 'Ruang Logistik', '2023-04-13 01:49:03', '2023-04-13 01:49:50'),
(3, 'Ruang Direktur', '2023-04-13 01:49:23', '2023-04-13 01:49:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `helpdesk`
--

CREATE TABLE `helpdesk` (
  `id` int(11) NOT NULL,
  `idBarangKeluar` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `jumlahBarang` int(3) NOT NULL,
  `keterangan` text NOT NULL,
  `tindakan` text NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `helpdesk`
--

INSERT INTO `helpdesk` (`id`, `idBarangKeluar`, `idUser`, `jumlahBarang`, `keterangan`, `tindakan`, `tanggal`, `status`, `createdAt`, `updatedAt`) VALUES
(2, 1, 3, 1, 'LCD tidak tampil', 'Sudah diganti lcd tp tetap tidak muncul', '2023-04-13', 'Rusak', '2023-04-13 04:21:44', '2023-04-13 04:22:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `namaKategori` varchar(50) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `namaKategori`, `kode`, `createdAt`, `updatedAt`) VALUES
(1, 'Elektronik', 'ELK', '2023-04-12 02:22:20', '2023-04-12 02:32:21'),
(2, 'Furniture', 'FRT', '2023-04-12 02:25:35', '2023-04-12 02:32:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role_id` int(1) NOT NULL,
  `idDistribusi` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `image`, `password`, `role_id`, `idDistribusi`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'admin', 'default.png', '$2y$10$ZdZIpysS8TWn8cTr5Awao.nEY4RXnkUYijO1YWhqSUQGgfrRLzFyi', 1, NULL, '2023-04-05 16:13:20', NULL),
(2, 'Ilhamsyah', 'ilham123', 'e07de5913f8b9ebfa14e06116b56446f.png', '$2y$10$E8x5cVlyHdsHs6faY7LQq.XpLXK1LkoqAY96p/zHYCFlPJAdK9OV.', 2, NULL, '2023-04-05 16:31:14', '2023-04-13 06:57:04'),
(3, 'Departemen PMB', 'user123', 'default.png', '$2y$10$hyPHqU7veQPo.JwD19CsHOKGJDCMI5k65YShKtByjrG6uDX3FPyJi', 3, 1, '2023-04-05 16:34:42', '2023-04-13 02:13:53');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barangkeluar`
--
ALTER TABLE `barangkeluar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barangmasuk`
--
ALTER TABLE `barangmasuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barangrusak`
--
ALTER TABLE `barangrusak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `distribusi`
--
ALTER TABLE `distribusi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `helpdesk`
--
ALTER TABLE `helpdesk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barangkeluar`
--
ALTER TABLE `barangkeluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `barangmasuk`
--
ALTER TABLE `barangmasuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `barangrusak`
--
ALTER TABLE `barangrusak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `distribusi`
--
ALTER TABLE `distribusi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `helpdesk`
--
ALTER TABLE `helpdesk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
