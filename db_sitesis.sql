-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jul 2021 pada 04.06
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sitesis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bimbingan`
--

CREATE TABLE `bimbingan` (
  `id_bimbingan` int(11) NOT NULL,
  `id_pengajuan_judul` int(11) NOT NULL,
  `pengajuan` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `file` varchar(225) NOT NULL,
  `status` varchar(30) NOT NULL,
  `dosbing_1` varchar(20) NOT NULL,
  `tgl_kirim` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku_bimbingan`
--

CREATE TABLE `buku_bimbingan` (
  `id_buku_bimbingan` int(11) NOT NULL,
  `id_bimbingan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `saran` text NOT NULL,
  `tgl_bimbingan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosbing`
--

CREATE TABLE `dosbing` (
  `id_dosbing` int(11) NOT NULL,
  `id_pengajuan_judul` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `keterangan_pembimbing` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_pendaftaran_seminar` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `periode` varchar(4) NOT NULL,
  `pembimbing_1` varchar(50) NOT NULL,
  `penguji_1` varchar(50) NOT NULL,
  `penguji_2` varchar(50) NOT NULL,
  `jam` varchar(30) NOT NULL,
  `hari` varchar(30) NOT NULL,
  `ruangan` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nim` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(20) NOT NULL,
  `foto` varchar(225) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `active` enum('aktif','tidak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nim`, `nama`, `alamat`, `telp`, `foto`, `username`, `password`, `active`) VALUES
(1, '201753099', 'Gomars', 'desa dersalam', '0893290874', 'kepsek78.jpg', 'gomars', 'gomars', 'aktif'),
(2, '201753029', 'Fanny Amalia', 'desa deralam rt 05', '08512222323', 'tn__DSC4854.JPG', 'fanny@gmail.com', 'Fanny', 'aktif'),
(3, '2348962394', 'Danang Purhadi', 'desa dersalam', '089312489623', 'tn__DSC4923.JPG', 'danang@gmail.com', 'danang', 'aktif'),
(4, '230129091', 'Jamani Sanjaya', 'desa dersalam', '089329846789', 'tn_DSC09987.JPG', 'jamani@gmail.com', 'jamani', 'aktif'),
(5, '20198120', 'Lilia', 'desa dersalam', '08923897634', 'tn__DSC4735.JPG', 'lilia', 'lilia', 'aktif'),
(6, '209198689123', 'Lokimara Asaka', 'desa dersalam', '089123476982', 'tn__DSC4814.JPG', 'lokimaran@gmail.com', 'lokimaran', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pengajuan_judul` int(11) NOT NULL,
  `nilai` varchar(30) NOT NULL,
  `tgl_nilai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran_seminar`
--

CREATE TABLE `pendaftaran_seminar` (
  `id_pendaftaran_seminar` int(11) NOT NULL,
  `id_pengajuan_judul` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `transkrip_nilai` varchar(225) NOT NULL,
  `her_registrasi` varchar(225) NOT NULL,
  `proposal` varchar(225) NOT NULL,
  `jenis_pendaftaran` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `acc_dosbing_1` enum('Pengajuan','ACC') NOT NULL,
  `acc_penguji_1` enum('Pengajuan','ACC') NOT NULL,
  `acc_penguji_2` enum('Pengajuan','ACC') NOT NULL,
  `status` varchar(30) NOT NULL,
  `tgl_pendaftaran` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan_judul`
--

CREATE TABLE `pengajuan_judul` (
  `id_pengajuan_judul` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `judul` text NOT NULL,
  `proposal` varchar(225) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `keterangan` text NOT NULL,
  `catatan` text NOT NULL,
  `status` varchar(30) NOT NULL,
  `tingkatan` enum('SUP','ACC SUP','SHP','ACC SHP','Tesis','ACC Tesis','Selesai') NOT NULL,
  `acc_dosbing_1` enum('Belum ACC','ACC') NOT NULL,
  `tgl_pengajuan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode`
--

CREATE TABLE `periode` (
  `id_periode` int(11) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `batas_waktu` varchar(30) NOT NULL,
  `active` enum('aktif','non aktif') NOT NULL,
  `status_periode` enum('pengajuan judul','bimbingan','seminar usulan penelitian','seminar hasil penelitian','ujian tesis') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `periode`
--

INSERT INTO `periode` (`id_periode`, `tahun`, `batas_waktu`, `active`, `status_periode`) VALUES
(2, '2021', '06/28/2021 - 07/30/2021', 'aktif', 'pengajuan judul'),
(3, '2021', '07/10/2021 - 07/22/2021', 'aktif', 'bimbingan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nidn` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(20) NOT NULL,
  `foto` varchar(225) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `posisi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nidn`, `nama`, `alamat`, `telp`, `foto`, `username`, `password`, `posisi`) VALUES
(1, '123001923', 'Darita Sintya', 'desa dersalam', '07302947230', 'kepsek78.jpg', 'kaprogdi', 'kaprogdi', 'Kaprogdi'),
(3, '1234123123', 'Anggita Fitriani', 'dasdasd', '0898723547823', 'tn__DSC4735.JPG', 'dosbing', 'dosbing', 'Dosen Pembimbing'),
(4, '08999129861', 'Fatur Imans', 'desa dersalam', '0892349869', 'tn__DSC4923.JPG', 'fatur', 'fatur', 'Dosen Pembimbing'),
(5, '08029734', 'Fanssa', 'desa deraslam', '0799286743', 'tn__DSC4814.JPG', 'fans', 'fans', 'Dosen Pembimbing'),
(6, '90123823', 'Lukman Ashuka', 'desa ashuka', '0829236498', 'tn__DSC4932.JPG', 'admin', 'admin', 'Tenaga Pendidik'),
(7, '1234123123', 'Syah Roni', 'desa dersalam', '08923986498', 'tn__DSC48141.JPG', 'roni', 'roni', 'Dosen Penguji'),
(8, '3245345345', 'Romlan Jumari', 'desa janggalan', '089234750', 'tn__DSC4823.JPG', 'romlan', 'romlan', 'Dosen Penguji'),
(9, '3425698234', 'Diana Listiaras', 'desa conge wetan', '089234986', 'tn__DSC4833.JPG', 'diana', 'diana', 'Dosen Penguji');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bimbingan`
--
ALTER TABLE `bimbingan`
  ADD PRIMARY KEY (`id_bimbingan`),
  ADD KEY `id_pengajuan_judul` (`id_pengajuan_judul`);

--
-- Indeks untuk tabel `buku_bimbingan`
--
ALTER TABLE `buku_bimbingan`
  ADD PRIMARY KEY (`id_buku_bimbingan`),
  ADD KEY `id_bimbingan` (`id_bimbingan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `dosbing`
--
ALTER TABLE `dosbing`
  ADD PRIMARY KEY (`id_dosbing`),
  ADD KEY `id_pengajuan_judul` (`id_pengajuan_judul`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_pendaftaran_seminar` (`id_pendaftaran_seminar`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pengajuan_judul` (`id_pengajuan_judul`);

--
-- Indeks untuk tabel `pendaftaran_seminar`
--
ALTER TABLE `pendaftaran_seminar`
  ADD PRIMARY KEY (`id_pendaftaran_seminar`),
  ADD KEY `id_pengajuan_judul` (`id_pengajuan_judul`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indeks untuk tabel `pengajuan_judul`
--
ALTER TABLE `pengajuan_judul`
  ADD PRIMARY KEY (`id_pengajuan_judul`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indeks untuk tabel `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bimbingan`
--
ALTER TABLE `bimbingan`
  MODIFY `id_bimbingan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `buku_bimbingan`
--
ALTER TABLE `buku_bimbingan`
  MODIFY `id_buku_bimbingan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT untuk tabel `dosbing`
--
ALTER TABLE `dosbing`
  MODIFY `id_dosbing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran_seminar`
--
ALTER TABLE `pendaftaran_seminar`
  MODIFY `id_pendaftaran_seminar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `pengajuan_judul`
--
ALTER TABLE `pengajuan_judul`
  MODIFY `id_pengajuan_judul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `periode`
--
ALTER TABLE `periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bimbingan`
--
ALTER TABLE `bimbingan`
  ADD CONSTRAINT `bimbingan_ibfk_1` FOREIGN KEY (`id_pengajuan_judul`) REFERENCES `pengajuan_judul` (`id_pengajuan_judul`);

--
-- Ketidakleluasaan untuk tabel `buku_bimbingan`
--
ALTER TABLE `buku_bimbingan`
  ADD CONSTRAINT `buku_bimbingan_ibfk_1` FOREIGN KEY (`id_bimbingan`) REFERENCES `bimbingan` (`id_bimbingan`),
  ADD CONSTRAINT `buku_bimbingan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `dosbing`
--
ALTER TABLE `dosbing`
  ADD CONSTRAINT `dosbing_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `dosbing_ibfk_2` FOREIGN KEY (`id_pengajuan_judul`) REFERENCES `pengajuan_judul` (`id_pengajuan_judul`),
  ADD CONSTRAINT `dosbing_ibfk_3` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`);

--
-- Ketidakleluasaan untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_pendaftaran_seminar`) REFERENCES `pendaftaran_seminar` (`id_pendaftaran_seminar`);

--
-- Ketidakleluasaan untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`id_pengajuan_judul`) REFERENCES `pengajuan_judul` (`id_pengajuan_judul`);

--
-- Ketidakleluasaan untuk tabel `pendaftaran_seminar`
--
ALTER TABLE `pendaftaran_seminar`
  ADD CONSTRAINT `pendaftaran_seminar_ibfk_1` FOREIGN KEY (`id_pengajuan_judul`) REFERENCES `pengajuan_judul` (`id_pengajuan_judul`),
  ADD CONSTRAINT `pendaftaran_seminar_ibfk_2` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`);

--
-- Ketidakleluasaan untuk tabel `pengajuan_judul`
--
ALTER TABLE `pengajuan_judul`
  ADD CONSTRAINT `pengajuan_judul_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
