-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 01, 2025 at 02:17 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kelurahan_tonrorita`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama_lengkap`, `email`, `foto`, `created_at`) VALUES
(1, 'shinta@gmail.com', '$2y$10$N5gGz08VwpjenOQMleRgHOHryy03e69mY06RZTikczlqBPXi34bjS', 'NUR RTRI BEKTI SHINTA TAMA', 'shinta@gmail.com', '1761537840_ftmy.jpg', '2025-10-27 04:04:00'),
(2, 'anisa@gmail.com', '$2y$10$E1lZ4xnpSrz3e43InwH98e8Ntru4wYgeux/W7C5o6jD/wl2xMiLNe', 'Anisa Nihsan', 'anisa@gmail.com', '1761617221_siti.jpg', '2025-10-28 02:07:01'),
(3, 'ana@gmail.com', '$2y$10$ROL6kKwx5BPgCiX6OkBLH.NXB4L4RM6N/NIt385fU7gfVF9HoHU.C', 'Ana Triana', 'ana@gmail.com', '1761872279_anna.jpg', '2025-10-31 00:57:59');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `isi` text,
  `gambar` varchar(255) DEFAULT NULL,
  `penulis` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `isi`, `gambar`, `penulis`, `tanggal`, `kategori`, `created_at`) VALUES
(3, 'Gotong royong', 'Warga Kelurahan Tonrorita melaksanakan kegiatan gotong royong membersihkan selokan dan lingkungan sekitar balai desa. Kegiatan ini bertujuan menjaga kebersihan dan mempererat kebersamaan antarwarga.', '1761532762_gotong royong.jpeg', 'shinta', '2025-02-20', 'kegiatan', '2025-10-27 02:39:22'),
(4, 'Penanaman Pohon', 'Dalam rangka penghijauan, pemerintah kelurahan bersama masyarakat menanam ratusan pohon di area lapangan dan pinggir jalan utama. Kegiatan ini diharapkan membantu mengurangi polusi udara', '1761830742_nanampohon.jpeg', 'Budi', '2222-02-22', 'kegiatan', '2025-10-30 13:25:42'),
(5, 'Lomba 17 Agustus', 'Dalam memperingati HUT RI ke-80, warga tonrorita mengadakan berbagai lomba seperti balap karung, tarik tambang, dan panjat pinang. Suasana meriah dan penuh semangat kebersamaan', '1761830919_agustusan.jpg', 'Ani', '2020-08-17', 'umum', '2025-10-30 13:28:14'),
(6, 'Sosialisasi Kesehatan', 'Puskesmas setempat menggelar sosialisasi pentingnya pola hidup sehat dan pemeriksaan kesehatan gratis bagi warga. Acara ini diikuti oleh puluhan peserta dari berbagai dusun', '1761831029_solisasi.jpg', 'Rina', '2020-02-22', 'kegiatan', '2025-10-30 13:30:29'),
(7, 'Pelatihan UMKM', 'Pemerintah kelurahan mengadakan pelatihan UMKM untuk meningkatkan keterampilan warga dalam bidang pengemasan produk dan pemasaran online. Peserta sangat antusias mengikuti kegiatan ini.', '1761831114_umkm.jpg', 'Dika', '2023-04-05', 'kegiatan', '2025-10-30 13:31:54'),
(8, 'Kelurahan Tonrorita Gelar Aksi Bersih Saluran Air Menjelang Musim Hujan', 'Dalam rangka mencegah banjir, Kelurahan Tonrorita menggelar aksi bersih-bersih saluran air utama yang melibatkan warga, pemuda karang taruna, dan aparat kelurahan. Kegiatan gotong royong ini dilakukan di sepanjang Jalan Poros Tonrorita. Lurah Tonrorita menyampaikan bahwa kegiatan ini rutin dilakukan setiap tahun untuk menjaga kebersihan lingkungan dan memastikan aliran air tetap lancar.', '1763604412_bersihair.jpg', 'Lina', '2024-01-10', 'kegiatan', '2025-11-20 02:00:04'),
(9, 'Puskesmas dan Kelurahan Tonrorita Adakan Pemeriksaan Kesehatan Gratis', 'Puskesmas Tonrorita bekerja sama dengan pihak kelurahan mengadakan pemeriksaan kesehatan gratis bagi warga. Layanan yang diberikan meliputi pengukuran tekanan darah, cek gula darah, kolesterol, hingga konsultasi kesehatan. Antusiasme warga sangat tinggi, terutama para lansia yang merasa terbantu dengan kegiatan ini.', '1763604483_pemeriksaangratis.webp', 'Hadi', '2024-02-15', 'umum', '2025-11-20 02:00:04'),
(10, 'Penyaluran Bantuan Sembako untuk Warga Kurang Mampu di Tonrorita', 'Pemerintah Kelurahan Tonrorita kembali menyalurkan bantuan sembako kepada warga kurang mampu sebagai bagian dari program jaring pengaman sosial. Bantuan berisi beras, minyak goreng, gula, mie instan, dan kebutuhan pokok lainnya. Pembagian dilakukan secara teratur dan tepat sasaran melalui pendataan RT/RW.', '1763604566_Bank-Aceh-serah-sembakoAli.jpg', 'Siti', '2024-03-12', 'umum', '2025-11-20 02:00:04'),
(11, 'Pemasangan Lampu Jalan Baru Tingkatkan Keamanan Warga Tonrorita', 'Kelurahan Tonrorita baru saja menyelesaikan pemasangan 25 titik lampu jalan baru. Program ini bertujuan meningkatkan keamanan dan kenyamanan warga saat beraktivitas pada malam hari. Warga setempat menyampaikan rasa syukur karena banyak area gelap kini telah terang dan aman.', '1763604657_pemasanganlampu.jpg', 'Andi', '2024-04-18', 'umum', '2025-11-20 02:00:04'),
(12, 'Lurah Tonrorita Pimpin Rapat Koordinasi RT/RW Bahas Program Kerja', 'Lurah Tonrorita memimpin rapat koordinasi bersama seluruh Ketua RT dan RW untuk membahas sejumlah program prioritas tahun ini. Agenda utama mencakup perbaikan drainase, program sosial masyarakat, dan peningkatan fasilitas publik. Selain itu, kelurahan menekankan pentingnya kolaborasi antara pemerintah dan masyarakat untuk mewujudkan lingkungan yang tertib dan aman.', '1763604752_pemimpin.jpeg', 'Yuni', '2024-05-20', 'kegiatan', '2025-11-20 02:00:04'),
(13, 'Pelatihan Digital Marketing Tingkatkan Keterampilan Pelaku UMKM Tonrorita', 'Kelurahan Tonrorita bekerja sama dengan Dinas UMKM menggelar pelatihan digital marketing untuk pelaku usaha kecil. Peserta mendapatkan ilmu mengenai teknik foto produk, pengelolaan media sosial, dan strategi pemasaran online. Pelatihan ini diharapkan membantu UMKM lokal memperluas pasar.', '1763604826_pelatihan-digital-marketing.jpeg', 'Dewi', '2024-06-05', 'kegiatan', '2025-11-20 02:00:04'),
(14, 'Peringati Hari Anak Nasional, Tonrorita Gelar Lomba Mewarnai dan Edukasi Anak', 'Dalam rangka memperingati Hari Anak Nasional, Kelurahan Tonrorita menyelenggarakan berbagai kegiatan seperti lomba mewarnai, permainan edukatif, dan pembagian hadiah. Acara ini dihadiri oleh ratusan anak-anak dari berbagai dusun di Tonrorita.', '1763604954_lombamerwanai.jpg', 'Fajar', '2024-07-23', 'umum', '2025-11-20 02:00:04'),
(15, 'Program Bank Sampah di Tonrorita Mulai Dibangun untuk Kurangi Sampah Rumah Tangga', 'Kelurahan Tonrorita meresmikan program Bank Sampah yang bertujuan mengurangi timbunan sampah rumah tangga. Warga dapat menukar sampah plastik, kardus, dan botol dengan poin yang bisa ditukar kebutuhan rumah tangga. Program ini mendapat dukungan penuh dari masyarakat.', '1763605058_bank.jpg', 'Maya', '2024-08-01', 'kegiatan', '2025-11-20 02:00:04'),
(16, 'Kelurahan Tonrorita Buka Posko Pengaduan Masyarakat untuk Tingkatkan Pelayanan', 'Dalam rangka meningkatkan pelayanan publik, Kelurahan Tonrorita membuka Posko Pengaduan Masyarakat. Warga dapat melaporkan persoalan seperti jalan rusak, lampu jalan padam, keamanan lingkungan, dan masalah sosial. Semua laporan akan ditindaklanjuti oleh aparat kelurahan.', '1763605114_pengaduan.jpg', 'Rizal', '2024-09-14', 'umum', '2025-11-20 02:00:04'),
(17, 'Senam Pagi Bersama Jadi Agenda Rutin Warga Tonrorita', 'Setiap hari Minggu pagi, warga Kelurahan Tonrorita rutin melaksanakan senam bersama di lapangan terbuka. Kegiatan ini bertujuan menjaga kesehatan dan mempererat kebersamaan antarwarga. Banyak warga usia muda hingga lansia ikut berpartisipasi.', '1763605188_senam.jpg', 'Nina', '2024-10-10', 'kegiatan', '2025-11-20 02:00:04'),
(18, 'Layanan Perpustakaan Keliling Hadir di Tonrorita untuk Dorong Minat Baca Anak', 'Perpustakaan keliling kembali hadir di Kelurahan Tonrorita. Anak-anak sangat antusias meminjam buku cerita dan buku pelajaran. Program ini diharapkan menumbuhkan minat baca sejak dini dan mendukung pendidikan anak di lingkungan kelurahan.', '1763604281_perpustakaan-keliling.webp', 'Arman', '2024-11-08', 'umum', '2025-11-20 02:00:04'),
(19, 'Revitalisasi Taman Kelurahan Disambut Baik Oleh Warga Tonrorita', 'Kelurahan Tonrorita berhasil menyelesaikan revitalisasi taman kelurahan. Perbaikan meliputi pemasangan permainan anak baru, perbaikan bangku taman, area hijau, dan fasilitas olahraga. Warga sangat menyambut baik karena kini taman lebih nyaman untuk bersantai.', '1763604181_taman.jpg', 'Salsa', '2024-12-02', 'umum', '2025-11-20 02:00:04');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` int NOT NULL,
  `judul` varchar(150) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `deskripsi` text,
  `kategori` enum('kegiatan','fasilitas','umum') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `judul`, `gambar`, `deskripsi`, `kategori`, `created_at`) VALUES
(3, 'Lomba 17 Agustus', '1761832011_agustusan.jpg', 'Dalam memperingati HUT RI ke-80, warga mengadakan berbagai lomba seperti balap karung, tarik tambang, dan panjat pinang. Suasana meriah dan penuh semangat kebersamaan', 'umum', '2025-10-24 07:15:39'),
(4, 'Penanaman Pohon', '1761831290_nanampohon.jpeg', 'Dalam rangka penghijauan, pemerintah kelurahan bersama masyarakat menanam ratusan pohon di area lapangan dan pinggir jalan utama. Kegiatan ini diharapkan membantu mengurangi polusi udara', 'kegiatan', '2025-10-24 16:17:54'),
(5, 'Pelatihan UMKM', '1761832081_umkm.jpg', 'Pemerintah kelurahan mengadakan pelatihan UMKM untuk meningkatkan keterampilan warga dalam bidang pengemasan produk dan pemasaran online. Peserta sangat antusias mengikuti kegiatan ini', 'kegiatan', '2025-10-30 13:48:01'),
(6, 'Sosialisasi Kesehatan', '1761832160_solisasi.jpg', 'Puskesmas setempat menggelar sosialisasi pentingnya pola hidup sehat dan pemeriksaan kesehatan gratis bagi warga. Acara ini diikuti oleh puluhan peserta dari berbagai dusun', 'fasilitas', '2025-10-30 13:49:20'),
(7, 'Gotong Royong Bersih Lingkungan', '1763602835_Gotong-royong.jpg', 'Warga Kelurahan Tonrorita bersama lurah mengadakan kegiatan bersih lingkungan di sekitar drainase dan area pemukiman untuk mencegah banjir saat musim hujan.', 'kegiatan', '2025-11-01 01:12:44'),
(8, 'Pembangunan Gedung Serbaguna', '1763602755_pembangunan.jpg', 'Pemerintah kelurahan membangun gedung serbaguna yang kedepannya akan dipakai untuk acara warga, rapat resmi, dan pusat kegiatan sosial.', 'fasilitas', '2025-11-03 03:22:11'),
(9, 'Festival Budaya Daerah', '1763602494_festifal.jpeg', 'Kegiatan festival budaya menampilkan tari tradisional, musik lokal, serta kuliner khas yang diikuti oleh seluruh warga dan generasi muda.', 'umum', '2025-11-05 07:07:32'),
(10, 'Pelayanan Administrasi Keliling', '1763602431_layanan.jpg', 'Kelurahan melaksanakan pelayanan administrasi keliling untuk membantu warga mengurus dokumen seperti KK, KTP, dan surat keterangan tanpa harus datang ke kantor.', 'kegiatan', '2025-11-07 02:30:25'),
(11, 'Renovasi Taman Bermain Anak', '1763602335_bermain.jpg', 'Taman bermain anak diperbarui dengan wahana baru, arena hijau, dan fasilitas tempat duduk sehingga lebih nyaman digunakan oleh keluarga.', 'fasilitas', '2025-11-10 06:55:18'),
(12, 'Posyandu Balita dan Lansia', '1763602212_balita.jpg', 'Kegiatan posyandu rutin untuk balita dan lansia dengan layanan pemeriksaan kesehatan, imunisasi, serta edukasi gizi bagi para orang tua.', 'umum', '2025-11-13 01:45:09');

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id` int NOT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `no_hp` varchar(50) DEFAULT NULL,
  `pesan` text,
  `status` enum('belum_dibaca','dibalas') DEFAULT 'belum_dibaca',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`id`, `nama`, `email`, `no_hp`, `pesan`, `status`, `created_at`) VALUES
(1, 'nina', 'nina@gmail.com', '0987645678456', 'Layanan sangat baik', 'belum_dibaca', '2025-10-27 16:45:49'),
(2, 'rini', 'rini@gmaiil.com', '9876543456', 'Layanan sangat baik', 'dibalas', '2025-10-28 08:11:28'),
(3, 'nisa', 'nisa@gmail.com', '98765456788', 'Layanan sangat baik', 'dibalas', '2025-10-30 02:36:27'),
(4, 'tata', 'an@gmail.com', '3456764433', 'cekk', 'belum_dibaca', '2025-11-20 07:26:50'),
(5, 'navisa', 'an@gmail.com', '765445', 'xxx', 'dibalas', '2025-11-20 08:07:20'),
(6, 'nina', 'an@gmail.com', '765432', 'sss', 'belum_dibaca', '2025-11-20 08:24:45'),
(7, 'pp', 'nina@gmail.com', '834567897', 'kkkk\r\n', 'belum_dibaca', '2025-11-21 14:18:05');

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id` int NOT NULL,
  `nama_layanan` varchar(150) DEFAULT NULL,
  `deskripsi` text,
  `syarat` text,
  `biaya` varchar(100) DEFAULT NULL,
  `waktu_proses` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id`, `nama_layanan`, `deskripsi`, `syarat`, `biaya`, `waktu_proses`, `created_at`) VALUES
(2, 'Surat Keterangan Usaha', 'Surat keterangan yang dibutuhkan untuk pengajuan izin usaha atau keperluan perbankan', '- Fotokopi KTP\r\n- Surat pengantar RT/RW\r\n- Bukti usaha (foto/lokasi)', '10.000', '1 hari', '2025-10-27 08:15:50'),
(3, 'Surat Keterangan Domisili', 'Pelayanan pembuatan surat keterangan domisili bagi warga yang tinggal di wilayah kelurahan', '- Fotokopi KTP\r\n- Fotokopi KK\r\n- Surat pengantar RT/RW', '50.000', '1 hari', '2025-10-27 08:21:06'),
(4, 'Surat Pengantar Nikah', 'Surat pengantar dari kelurahan untuk keperluan menikah di KUA', '- Fotokopi KTP calon pengantin\r\n- Fotokopi KK\r\n- Surat pengantar RT/RW', '0 (Gratis)', '1 hari', '2025-10-31 02:02:22'),
(5, 'Surat Keterangan Tidak Mampu (SKTM)', 'Surat untuk keperluan bantuan sosial, pendidikan, atau pengobatan', '- Fotokopi KTP\r\n- Fotokopi KK\r\n- Surat pengantar RT/RW', '0 (Gratis)', '2 hari', '2025-10-31 02:03:35'),
(6, 'Legalisasi Dokumen', 'Layanan legalisasi dokumen resmi seperti ijazah, akta kelahiran, atau surat keterangan', '- Dokumen asli\r\n- Fotokopi dokumen\r\n- KTP pemohon', '5.000', '1 hari', '2025-10-31 02:04:36'),
(7, 'Surat Pengantar Pindah', 'Dokumen untuk keperluan pindah domisili antar kelurahan atau kabupaten', '- Fotokopi KTP\n- Fotokopi KK\n- Surat pengantar RT/RW', '0 (Gratis)', '1 hari', '2025-11-02 02:30:00'),
(8, 'Surat Keterangan Kematian', 'Surat yang diperlukan untuk administrasi penyelesaian dokumen ahli waris dan kependudukan', '- KTP almarhum\n- KK keluarga\n- Surat keterangan dari RT/RW\n- Surat dari rumah sakit (jika ada)', '0 (Gratis)', '1 hari', '2025-11-03 03:15:00'),
(9, 'Surat Keterangan Kehilangan', 'Dokumen pendukung laporan kehilangan barang atau dokumen resmi', '- Fotokopi KTP\n- Surat pengantar RT/RW\n- Kronologi kehilangan', '0 (Gratis)', '1 hari', '2025-11-04 01:50:00'),
(10, 'Surat Keterangan Belum Menikah', 'Surat untuk keperluan administrasi pernikahan maupun pengajuan pekerjaan', '- Fotokopi KTP\n- Fotokopi KK\n- Surat pengantar RT/RW', '0 (Gratis)', '1 hari', '2025-11-05 04:20:00'),
(11, 'Pembuatan Kartu Keluarga Baru', 'Pelayanan pembuatan kartu keluarga baru bagi warga yang baru menikah atau pindah keluarga', '- Surat pengantar RT/RW\n- Buku nikah\n- KTP suami dan istri\n- KK lama (jika ada)', '0 (Gratis)', '3 hari', '2025-11-06 07:05:00'),
(12, 'Pengurusan Akta Kelahiran', 'Layanan untuk membantu warga membuat akta kelahiran di Dinas Dukcapil', '- Fotokopi KTP orang tua\n- Fotokopi KK\n- Surat keterangan lahir dari bidan/rumah sakit', '0 (Gratis)', '3 hari', '2025-11-07 02:40:00'),
(13, 'Rekomendasi Pembangunan Rumah', 'Surat rekomendasi yang diperlukan untuk mengurus IMB/PBG kepada pemerintah daerah', '- Fotokopi KTP\n- Fotokopi KK\n- Gambar rencana bangunan\n- Surat pengantar RT/RW', '20.000', '2 hari', '2025-11-08 03:10:00'),
(14, 'Surat Keterangan Tidak Terdaftar NIK', 'Surat untuk memastikan bahwa seseorang belum memiliki NIK pada sistem kependudukan', '- Fotokopi KTP (jika ada)\n- Fotokopi KK\n- Surat pengantar RT/RW', '0 (Gratis)', '1 hari', '2025-11-09 01:25:00'),
(15, 'Pelayanan Konsultasi Bantuan Sosial', 'Layanan konsultasi dan pendampingan bagi warga untuk mendaftar program bantuan sosial pemerintah', '- Fotokopi KTP\n- Fotokopi KK\n- Surat pengantar RT/RW', '0 (Gratis)', 'Langsung', '2025-11-10 06:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `perangkat_kelurahan`
--

CREATE TABLE `perangkat_kelurahan` (
  `id` int NOT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `perangkat_kelurahan`
--

INSERT INTO `perangkat_kelurahan` (`id`, `nama`, `jabatan`, `foto`, `keterangan`, `created_at`) VALUES
(2, 'Tomo', 'lurah', '1763606829_tomo.jpeg', 'Memimpin penyelenggaraan pemerintahan kelurahan dan bertanggung jawab atas seluruh kegiatan administrasi serta pelayanan publik', '2025-10-27 15:53:40'),
(3, 'Jono', 'Sekretaris Kelurahan', '1761878925_ms2.jpg', 'Membantu lurah dalam urusan administrasi umum, penyusunan laporan, dan pengelolaan surat-menyurat', '2025-10-31 02:48:45'),
(4, 'Dewi Anggraini', 'Kasi Pemerintahan', '1761878983_mb.jpg', 'Mengelola urusan pemerintahan, pendataan kependudukan, dan tata tertib administrasi wilayah', '2025-10-31 02:49:43'),
(5, 'Budi Raharjo', 'Kasi Pelayanan Umum', '1761879041_ms.jpg', 'Menangani pelayanan masyarakat seperti surat menyurat, pengaduan warga, dan pengelolaan fasilitas umum', '2025-10-31 02:50:41'),
(6, 'Siti Marlina', 'Kasi Kesejahteraan Sosial', '1763606893_sitiii.jpg', 'Bertanggung jawab dalam bidang kesejahteraan masyarakat, pemberdayaan keluarga, dan kegiatan sosial kemasyarakatan', '2025-10-31 02:51:36'),
(11, 'Hendra Wijaya', 'Kasi Pemberdayaan Masyarakat', '1763606659_hendra.jpg', 'Mengkoordinasikan program pemberdayaan masyarakat, pelatihan warga, dan peningkatan partisipasi masyarakat dalam pembangunan kelurahan.', '2025-11-02 07:22:10'),
(12, 'Lilis Mariani', 'Bendahara Kelurahan', '1763606547_lilis.jpeg', 'Mengelola administrasi keuangan kelurahan, penatausahaan anggaran, serta memastikan laporan keuangan akurat dan transparan.', '2025-11-02 07:24:30'),
(13, 'Rahmat Akbar', 'Staf Umum & Kepegawaian', '1763606403_rahmat.jpeg', 'Menangani urusan surat-menyurat, kepegawaian, arsip, serta administrasi umum di kantor Kelurahan Tonrorita.', '2025-11-02 07:26:05'),
(14, 'Fitri Handayani', 'Operator Data Kelurahan', '1763606332_fitri.jpg', 'Menginput, memperbarui, dan mengelola data kependudukan, bantuan sosial, dan layanan administrasi berbasis sistem informasi kelurahan.', '2025-11-02 07:28:40');

-- --------------------------------------------------------

--
-- Table structure for table `potensi_desa`
--

CREATE TABLE `potensi_desa` (
  `id` int NOT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `judul` varchar(150) DEFAULT NULL,
  `deskripsi` text,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `potensi_desa`
--

INSERT INTO `potensi_desa` (`id`, `kategori`, `judul`, `deskripsi`, `gambar`, `created_at`) VALUES
(2, 'Pertanian', 'Pertanian Padi Organik', 'Desa Srigading memiliki lahan pertanian padi organik seluas 25 hektar yang dikelola oleh kelompok tani. Produk beras organik ini sudah dipasarkan ke berbagai daerah', '1761876992_padi.jpg', '2025-10-27 06:52:27'),
(3, 'Kuliner', 'Produksi Gula Kelapa', 'Warga memproduksi gula kelapa secara tradisional dengan kualitas tinggi. Produk ini menjadi oleh-oleh khas desa', '1761876940_gulakelapa.jpg', '2025-10-31 02:15:40'),
(4, 'Pariwisata', 'Wisata Pantai Cemara', 'Pantai Cemara menjadi destinasi wisata unggulan dengan keindahan pohon cemara laut dan area bermain keluarga', '1761877057_pantai.jpg', '2025-10-31 02:17:37'),
(5, 'Kerajinan', 'Anyaman Bambu', 'Warga desa menghasilkan kerajinan tangan berupa anyaman bambu seperti tempat buah, tikar, dan perabot rumah tangga', '1761877103_anyamanbambu.jpg', '2025-10-31 02:18:23'),
(6, 'Peternakan', 'Peternakan Sapi Perah', 'Desa memiliki kelompok peternak sapi perah yang memproduksi susu segar setiap hari, dijual ke pasar lokal dan koperasi', '1761877160_sapi.jpg', '2025-10-31 02:19:20'),
(7, 'Pertanian', 'Budidaya Jagung Manis', 'Kelurahan Tonrorita memiliki lahan pertanian jagung manis yang dikelola kelompok tani dengan hasil panen yang melimpah setiap musimnya.', '1763607216_jagung.jpg', '2025-11-02 08:10:01'),
(8, 'Perikanan', 'Budidaya Ikan Lele Kolam Terpal', 'Warga Tonrorita mengembangkan usaha budidaya ikan lele menggunakan kolam terpal yang terbukti efektif dan menghasilkan keuntungan stabil.', '1763607323_budidaya_ikan_lele.jpeg', '2025-11-02 08:11:25'),
(9, 'UMKM', 'Produksi Keripik Pisang', 'Pelaku UMKM lokal memproduksi keripik pisang aneka rasa yang menjadi oleh-oleh khas Tonrorita dan dipasarkan hingga luar daerah.', '1763607446_keripik.webp', '2025-11-02 08:13:42'),
(10, 'Pariwisata', 'Wisata Sungai Tonrorita', 'Sungai Tonrorita menjadi destinasi wisata alam dengan pemandangan asri serta jalur trekking yang disukai pengunjung lokal.', '1763607490_wisatasungai.jpg', '2025-11-02 08:15:20'),
(11, 'Ekonomi Kreatif', 'Kerajinan Tas Rajut', 'Pengrajin lokal menghasilkan tas rajut kreatif yang memiliki nilai jual tinggi dan menjadi produk unggulan ekonomi kreatif Tonrorita.', '1763607580_tasrajut.jpg', '2025-11-02 08:17:00'),
(12, 'Kuliner', 'Olahan Ikan Asin Khas Tonrorita', 'Warga nelayan memproduksi ikan asin berkualitas yang menjadi kuliner khas dan banyak diminati masyarakat sekitar.', '1763607671_ikanasin.jpg', '2025-11-02 08:18:32'),
(13, 'Peternakan', 'Budidaya Ayam Kampung', 'Peternakan ayam kampung menjadi salah satu sumber ekonomi warga karena permintaan pasar yang tinggi dan perawatan yang mudah.', '1763607729_ayam-kampung.jpg', '2025-11-02 08:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `profil_kelurahan`
--

CREATE TABLE `profil_kelurahan` (
  `id` int NOT NULL,
  `nama_kelurahan` varchar(150) DEFAULT NULL,
  `visi` text,
  `misi` text,
  `sejarah` text,
  `alamat` text,
  `telepon` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `profil_kelurahan`
--

INSERT INTO `profil_kelurahan` (`id`, `nama_kelurahan`, `visi`, `misi`, `sejarah`, `alamat`, `telepon`, `email`, `logo`, `created_at`, `updated_at`) VALUES
(2, 'Tonrorita', 'Pernyataan visi dan misi atau maksud dan tujuan merupakan sebuah pernyataan yang digunakan sebagai cara mengomunikasikan tujuan dari sebuah organisasi. Walaupun sering tidak berubah dalam jangka waktu lama, sebuah organisasi tidak lazim memperbarui visi dan misi mereka dan terjadi ketika sebuah organisasi berkembang.', 'Misi yang tepat berfungsi sebagai penyaring untuk memisahkan apa yang penting dan apa yang tidak, menyatakan dengan jelas pasar manakah yang dituju dan bagaimana cara menyediakan jasa, serta mengomunikasikan arah organisasi tersebut menuju.', 'Dalam khasanah sejarah nasional, nama Gowa sudah tidak asing lagi. Mulai abad ke-14 (1320), Kerajaan Gowa merupakan kerajaan maritim yang besar pengaruhnya di perairan Nusantara. Bahkan dari kerajaan ini juga muncul nama pahlawan nasional yang bergelar Ayam Jantan dari Timur, Sultan Hasanuddin, Raja Gowa XVI yang berani melawan VOC Belanda pada tahun-tahun awal kolonialisasinya di Indonesia.', 'Jl. Lapangan, Tonrorita, Kec. Biringbulu, Kabupaten Gowa, Sulawesi Selatan 90244, Indonesia', '234567454333', 'Kelurahantonrorita@gmail.com', '1763007596_logokelurah-removebg-preview.png', '2025-10-23 08:23:04', '2025-11-13 04:19:56');

-- --------------------------------------------------------

--
-- Table structure for table `sosial_media`
--

CREATE TABLE `sosial_media` (
  `id` int NOT NULL,
  `nama_platform` varchar(100) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sosial_media`
--

INSERT INTO `sosial_media` (`id`, `nama_platform`, `link`, `icon`, `created_at`) VALUES
(1, 'Instragam', 'https://www.instagram.com/staaxaja/?next=%2F', 'instragam', '2025-10-24 16:11:49'),
(3, 'facebook', 'https://www.facebook.com/', 'bi bi-facebook', '2025-10-31 02:08:21');

-- --------------------------------------------------------

--
-- Table structure for table `struktur_organisasi`
--

CREATE TABLE `struktur_organisasi` (
  `id` int NOT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `foto` varchar(255) NOT NULL,
  `parent_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `struktur_organisasi`
--

INSERT INTO `struktur_organisasi` (`id`, `nama`, `jabatan`, `foto`, `parent_id`) VALUES
(1, 'Tomo', 'lurah', '1763607987_tomo.jpeg', NULL),
(2, 'Fitri Handayani', 'layanan administrasi', '1763609298_fitri.jpg', 3),
(3, 'Rahmat Akbar', 'Menangani urusan surat-menyurat', '1763608123_rahmat.jpeg', 1),
(4, 'Lilis Mariani', 'Bendahara Kelurahan', '1763609320_lilis.jpeg', 2),
(5, 'Hendra Wijaya', 'Kasi Pemberdayaan Masyarakat', '1763609043_hendra.jpg', 3),
(6, 'Budi Raharjo', 'Kasi Pelayanan Umum', '1763609155_ms.jpg', 5),
(7, 'Dewi Anggraini', 'Kasi Pemerintahan', '1763609220_sitiii.jpg', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perangkat_kelurahan`
--
ALTER TABLE `perangkat_kelurahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `potensi_desa`
--
ALTER TABLE `potensi_desa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profil_kelurahan`
--
ALTER TABLE `profil_kelurahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sosial_media`
--
ALTER TABLE `sosial_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `struktur_organisasi`
--
ALTER TABLE `struktur_organisasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`parent_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `perangkat_kelurahan`
--
ALTER TABLE `perangkat_kelurahan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `potensi_desa`
--
ALTER TABLE `potensi_desa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `profil_kelurahan`
--
ALTER TABLE `profil_kelurahan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sosial_media`
--
ALTER TABLE `sosial_media`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `struktur_organisasi`
--
ALTER TABLE `struktur_organisasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `struktur_organisasi`
--
ALTER TABLE `struktur_organisasi`
  ADD CONSTRAINT `struktur_organisasi_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `struktur_organisasi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
