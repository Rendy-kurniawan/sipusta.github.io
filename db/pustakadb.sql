-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2016 at 06:47 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pustakadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `kd_buku` char(5) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isbn` varchar(40) NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `halaman` int(4) NOT NULL,
  `jumlah` int(4) NOT NULL,
  `th_terbit` varchar(4) NOT NULL,
  `gambar` varchar(200) NOT NULL,
  `sinopsis` text NOT NULL,
  `kd_penerbit` char(3) NOT NULL,
  `kd_kategori` char(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`kd_buku`, `judul`, `isbn`, `pengarang`, `halaman`, `jumlah`, `th_terbit`, `gambar`, `sinopsis`, `kd_penerbit`, `kd_kategori`) VALUES
('B0001', 'Matematika - Kelas 10', '2323232324', 'Supartono', 250, 20, '2013', '-', 'Buku matematika untuk kelas 1 (IX) SMA', 'P01', 'K02'),
('B0002', 'Bahasa Indonesia - Kelas 10', '343434333', 'Agus Mahendra', 300, 25, '2014', '-', 'Buku Bahasa Indonesia untuk kelas 1 (IX) SMA', 'P02', 'K03'),
('B0003', 'Matematika - Kelas 11', '2323232325', 'Supartono', 270, 25, '2015', '-', 'Buku Matematika untuk kelas 2 (X) SMA', 'P01', 'K02'),
('B0004', 'Matematika - Kelas 12', '24223232', 'Sudarmaji, Spd', 268, 20, '2011', '', 'Buku matematika kelas 3', 'P01', 'K02'),
('B0005', 'Kompetensi Berbahasa dan Sastra Indonesia - Kelas 10', '-', 'Syamsuddin AR., Agus Mulyanto, Deden Fathudin', 250, 20, '2009', 'B0005.20090904215243.jpg', '-', 'P06', 'K03'),
('B0006', 'Ekonomi - Kelas 10', '-', 'Yuli Eko', 270, 20, '2009', 'B0006.20090904215214.jpg', '-', 'P06', 'K05'),
('B0007', 'Sosiologi', '-', 'Ruswanto', 310, 20, '2009', 'B0007.20090904214632.jpg', 'Buku Sosiologi', 'P06', 'K05'),
('B0008', 'Fisika - Kelas 10', '-', 'Tri Widodo', 280, 20, '2009', 'B0008.20090904214400.jpg', '-', 'P06', 'K06'),
('B0009', 'Sosiologi 1 Menyelami Fenomena Sosial di Masyarakat - Kelas 10', '-', 'Bagja Waluya', 340, 20, '2009', 'B0009.20090904214235.jpg', '-', 'P06', 'K07'),
('B0010', 'Cakrawala Sejarah 1 - Kelas 10', '-', 'Wardaya', 325, 20, '2009', 'B0010.20090904214212.jpg', '-', 'P06', 'K08'),
('B0011', 'Panduan Pembelajaran Fisika', '-', 'Suparmo, Tri Widodo', 321, 20, '2009', 'B0011.20090904121424.jpg', '-', 'P06', 'K06'),
('B0012', 'Sosiologi 1 - Kelas 10', '-', 'Elisanti, Tintin Rostini', 285, 20, '2009', 'B0012.20090904121002.jpg', '-', 'P06', 'K07'),
('B0013', 'Mengasah Kemampuan Ekonomi', '-', 'Bambang Widjajanta, Aristanti W, Heraeni', 275, 20, '2009', 'B0013.20090904080535.jpg', '-', 'P06', 'K05'),
('B0014', 'Sosiologi 2 Menyelami Fenomena Sosial di Masyarakat - Kelas 11', '-', 'Bagja Waluya', 324, 20, '2009', 'B0014.20090904214324.jpg', '-', 'P06', 'K07'),
('B0015', 'Cakrawala Sejarah (IPS) - Kelas 11', '-', 'Wardaya', 289, 20, '2009', 'B0015.20090904214314.jpg', '-', 'P06', 'K08'),
('B0016', 'Cakrawala Sejarah (Bahasa) - Kelas 11', '-', 'Wardaya', 330, 20, '2009', 'B0016.20090904214246.jpg', '-', 'P06', 'K08'),
('B0017', 'Khazanah Matematika - Kelas 11', '-', 'Rosihan Ari Y., Indriyastuti', 312, 20, '2009', 'B0017.20090904122314.jpg', '-', 'P06', 'K02'),
('B0018', 'Sosiologi - Kelas 11', '-', 'Elisanti, Tintin Rostini', 312, 20, '2009', 'B0018.20090904121048.jpg', '-', 'P06', 'K07'),
('B0019', 'Sosiologi - Kelas 11', '-', 'Bondet Wrahatnala', 325, 10, '2009', 'B0019.20090904120328.jpg', '-', 'P06', 'K07'),
('B0020', 'Wahana Matematika (IPS) - Kelas 11', '-', 'Sutrima, Budi Usodo', 335, 20, '2009', 'B0020.20090904120205.jpg', '-', 'P06', 'K02'),
('B0021', 'Belajar Efektif Bahasa Indonesia - Kelas 11', '-', 'E. Kusnadi H., Andang Purwoto, Siti Aisah', 350, 20, '2009', 'B0021.20090903235345.jpg', '-', 'P06', 'K03'),
('B0022', 'Biologi - Kelas 11', '-', 'Purnomo, Sudjino, Trijoko, Suwarno, Hadi Susanto', 300, 20, '2009', 'B0022.20090903234022.jpg', '-', 'P06', 'K09'),
('B0023', 'Geografi ', '-', 'Nurmala Dewi', 275, 20, '2009', 'B0023.20090903232024.jpg', '-', 'P06', 'K10');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kd_kategori` char(3) NOT NULL,
  `nm_kategori` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kd_kategori`, `nm_kategori`) VALUES
('K01', 'Agama'),
('K02', 'Matematika'),
('K03', 'Bahasa Indonesia'),
('K04', 'Bahasa Inggris'),
('K05', 'Ekonomi'),
('K06', 'Fisika'),
('K07', 'Sosiologi'),
('K08', 'Sejarah'),
('K09', 'Biologi'),
('K10', 'Geografi');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `no_pinjam` char(6) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `kd_siswa` char(5) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `lama_pinjam` int(2) NOT NULL,
  `status` enum('Pinjam','Kembali') NOT NULL DEFAULT 'Pinjam',
  `kd_user` char(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`no_pinjam`, `tgl_pinjam`, `kd_siswa`, `keterangan`, `lama_pinjam`, `status`, `kd_user`) VALUES
('PJ0001', '2016-02-11', 'S0002', 'Peminjaman ', 6, 'Kembali', ''),
('PJ0002', '2016-02-11', 'S0001', 'Peminjaman', 6, 'Kembali', ''),
('PJ0003', '2016-02-11', 'S0003', 'Peminjaman', 6, 'Kembali', ''),
('PJ0004', '2016-02-11', 'S0004', 'Peminjaman', 6, 'Kembali', ''),
('PJ0005', '2016-02-11', 'S0005', 'Peminjaman', 6, 'Kembali', ''),
('PJ0006', '2016-02-18', 'S0004', 'Peminjaman', 6, 'Pinjam', 'U01'),
('PJ0007', '2016-02-18', 'S0002', 'Peminjaman', 6, 'Pinjam', 'U01');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_detil`
--

CREATE TABLE `peminjaman_detil` (
  `no_pinjam` char(6) NOT NULL,
  `kd_buku` char(5) NOT NULL,
  `jumlah` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman_detil`
--

INSERT INTO `peminjaman_detil` (`no_pinjam`, `kd_buku`, `jumlah`) VALUES
('PJ0001', 'B0002', 1),
('PJ0001', 'B0001', 1),
('PJ0002', 'B0005', 1),
('PJ0002', 'B0006', 1),
('PJ0003', 'B0008', 1),
('PJ0003', 'B0006', 1),
('PJ0004', 'B0022', 1),
('PJ0004', 'B0008', 1),
('PJ0005', 'B0006', 1),
('PJ0005', 'B0009', 1),
('PJ0006', 'B0022', 1),
('PJ0006', 'B0023', 1),
('PJ0007', 'B0013', 1),
('PJ0007', 'B0006', 1);

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `kd_penerbit` char(3) NOT NULL,
  `nm_penerbit` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`kd_penerbit`, `nm_penerbit`) VALUES
('P01', 'Erlangga'),
('P02', 'Kanisius'),
('P03', 'Intan Pariwara'),
('P04', 'Elex Media Komputindo'),
('P05', 'Andi Offset'),
('P06', 'PPDPN');

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan`
--

CREATE TABLE `pengadaan` (
  `no_pengadaan` char(5) NOT NULL,
  `tgl_pengadaan` date NOT NULL,
  `kd_buku` char(5) NOT NULL,
  `asal_buku` varchar(100) NOT NULL,
  `jumlah` int(2) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengadaan`
--

INSERT INTO `pengadaan` (`no_pengadaan`, `tgl_pengadaan`, `kd_buku`, `asal_buku`, `jumlah`, `keterangan`) VALUES
('PB001', '2016-02-03', 'B0001', 'Sumbangan Guru', 10, 'Buku Matematika untuk Kelas 1 SMA'),
('PB002', '2016-02-03', 'B0003', 'Sumbangan Pemerintah', 40, 'Buku Matematika untuk Kelas 2 SMA'),
('PB003', '2016-02-03', 'B0001', 'Pembelian lewat dana BOS', 25, 'Buku Matematika untuk Kelas 1 SMA'),
('PB004', '2016-02-03', 'B0002', 'Pembelian lewat dana BOS', 40, 'Buku Bahasa Indonesia untuk Kelas 1 SMA');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `no_kembali` char(6) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `no_pinjam` char(6) NOT NULL,
  `denda` int(12) NOT NULL,
  `kd_user` char(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`no_kembali`, `tgl_kembali`, `no_pinjam`, `denda`, `kd_user`) VALUES
('KB0001', '2016-02-13', 'PJ0001', 0, ''),
('KB0002', '2016-02-13', 'PJ0002', 0, ''),
('KB0003', '2016-02-13', 'PJ0004', 2000, ''),
('KB0004', '2016-02-16', 'PJ0005', 1500, 'U01'),
('KB0005', '2016-02-16', 'PJ0003', 2500, 'U01');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `kd_siswa` char(5) NOT NULL,
  `nm_siswa` varchar(100) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `kelamin` char(1) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `foto` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`kd_siswa`, `nm_siswa`, `nisn`, `kelamin`, `agama`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_telepon`, `foto`) VALUES
('S0001', 'Sardi Sudrajad', '150001', 'L', 'Islam', 'Way Jepara, Lampung Timur', '1992-05-05', 'Jl. Suhada, Margayu, Desa. Lab Ratu Baru, Way Jepara, Lampung Timur', '08192223345', 'S0001.rompi.jpg'),
('S0002', 'Septi Suhesti', '150002', 'P', 'Islam', 'Way Jepara', '1991-09-05', 'Jl. Margahayu, Labuhan Ratu Baru, Kec. Way Jepara, Lampung Timur', '08192223434', 'S0002.septi.jpg'),
('S0003', 'Indah Indriyanna', '150004', 'L', 'Islam', 'Way Areng', '1992-02-09', 'Jl. Simpang H, Way Jepara, Lampung Timur', '0819223355', 'S0003.septi.jpg'),
('S0004', 'Nano Surajo', '150003', 'L', 'Islam', 'Metro', '1992-03-13', 'Sinarbanten, Labuhan Ratu 1, Way Jepara, Lampung Timur', '0821444566', ''),
('S0005', 'Juwanto', '150005', 'L', 'Islam', 'Way Jepara', '1992-11-06', 'Jl. Manggarawan, Way Jepara, Lampung Timur', '0812333456', '');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_pinjam`
--

CREATE TABLE `tmp_pinjam` (
  `id` int(11) NOT NULL,
  `kd_buku` char(5) NOT NULL,
  `jumlah` int(4) NOT NULL,
  `kd_user` char(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `kd_user` char(3) NOT NULL,
  `nm_user` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`kd_user`, `nm_user`, `username`, `password`) VALUES
('U01', 'Bunafit Nugroho', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
('U02', 'Fitria Prasetia', 'fitri', 'ac43724f16e9241d990427ab7c8f4228'),
('U03', 'Septi Suhesti', 'septi', 'd58d8a16aa666d48fbcc30bd3217fb17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`kd_buku`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kd_kategori`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`no_pinjam`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`kd_penerbit`);

--
-- Indexes for table `pengadaan`
--
ALTER TABLE `pengadaan`
  ADD PRIMARY KEY (`no_pengadaan`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`no_kembali`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`kd_siswa`);

--
-- Indexes for table `tmp_pinjam`
--
ALTER TABLE `tmp_pinjam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`kd_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tmp_pinjam`
--
ALTER TABLE `tmp_pinjam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
