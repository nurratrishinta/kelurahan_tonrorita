<!-- Header -->
<header class="header">

    <?php
    include_once __DIR__ . '/../config/connection.php';
    $query = "SELECT * FROM profil_kelurahan LIMIT 1";
    $result = $db->query($query);
    $profil  = $result->fetch_assoc();
    ?>

    <style>
        /* ===================== */
        /*     STYLE HEADER      */
        /* ===================== */
        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background-color: #fff;
            border-bottom: 2px solid #e0e0e0;
        }

        .header-flex-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            align-items: center;
        }

        /* Logo Kelurahan */
        .logo-container {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo {
            width: 85px;
            height: 85px;
            border-radius: 50%;
            object-fit: cover;
        }

        .header-info h1 {
            font-size: 1.4em;
            color: #0056b3;
            margin: 0;
        }

        .header-info .address {
            font-size: 0.85em;
            color: #444;
            margin-top: 3px;
        }

        /* ===================== */
        /*     ANIMASI SEPUR     */
        /* ===================== */
        .image-row {
            overflow: hidden;
            width: 700px;
            /* ganti sesuai kebutuhan */
            height: 110px;
            position: relative;
            border-radius: 6px;
        }

        .track {
            display: flex;
            gap: 20px;
            width: max-content;
            /* WAJIB! supaya kontainer mengikuti panjang gambar */
            animation: sepur 22s linear infinite;
        }

        .small-img {
            width: 150px;
            height: 100px;
            object-fit: cover;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        @keyframes sepur {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        /* Mode HP */
        @media (max-width: 768px) {
            .image-row {
                width: 100%;
            }

            .small-img {
                width: 100px;
                height: 70px;
            }

            .track {
                animation-duration: 15s;
            }
        }

        /* NAVBAR */
        .main-nav ul {
            display: flex;
            list-style: none;
            gap: 15px;
            padding: 10px 20px;
            background: #006aaa;
        }

        .main-nav a {
            text-decoration: none;
            color: white;
            padding: 6px 10px;
        }

        .main-nav a.active {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 4px;
        }
    </style>
    <?php include 'header.php'; ?>





    <div class="header-top">

        <div class="header-flex-container">

            <!-- Kiri: Logo + Informasi -->
            <div class="logo-container">
                <img src="../storages/logo/1761913187_download.png"
                    class="logo"
                    alt="Logo <?= htmlspecialchars($profil['nama_kelurahan']) ?>">

                <div class="header-info">
                    <h1><?= htmlspecialchars($profil['nama_kelurahan']) ?></h1>
                    <p class="address"><?= htmlspecialchars($profil['alamat']) ?></p>
                </div>
            </div>


            <!-- Kanan: Gambar GERAK SEPUR -->
            <div class="header-right-content">

                <div class="image-row">
                    <div class="track">

                        <!-- SET 1 -->
                        <img src="../storages/berita/1761913309_hari-menanam-pohon.jpg" class="small-img">
                        <img src="../storages/berita/1761913444_WhatsApp-Image-2019-09-09-at-3.56.32-AM.jpeg" class="small-img">
                        <img src="../storages/berita/1761919406_pelatihan-umkm-64a4dee5e1a1671a4457b483.jpeg" class="small-img">
                        <img src="../storages/berita/1761919450_61e16a766cbc3a30674f531e27224fd6.jpeg" class="small-img">
                        <img src="../storages/berita/1763604281_perpustakaan-keliling.webp" class="small-img">
                        <img src="../storages/berita/1763605058_bank.jpg" class="small-img">
                        <img src="../storages/berita/1763604412_bersihair.jpg" class="small-img">
                        <img src="../storages/berita/1763604657_pemasanganlampu.jpg" class="small-img">

                        <!-- SET 2 (Loop mulus) -->
                        <img src="../storages/berita/1761913309_hari-menanam-pohon.jpg" class="small-img">
                        <img src="../storages/berita/1761913444_WhatsApp-Image-2019-09-09-at-3.56.32-AM.jpeg" class="small-img">
                        <img src="../storages/berita/1761919406_pelatihan-umkm-64a4dee5e1a1671a4457b483.jpeg" class="small-img">
                        <img src="../storages/berita/1761919450_61e16a766cbc3a30674f531e27224fd6.jpeg" class="small-img">
                        <img src="../storages/berita/1763604281_perpustakaan-keliling.webp" class="small-img">
                        <img src="../storages/berita/1763605058_bank.jpg" class="small-img">
                        <img src="../storages/berita/1763604412_bersihair.jpg" class="small-img">
                        <img src="../storages/berita/1763604657_pemasanganlampu.jpg" class="small-img">

                    </div>
                </div>

            </div>

        </div>

    </div>



    <style>
        .running-text-container {
            width: 100%;
            background: #4b3e1f;
            /* coklat tua pemerintah */
            color: yellow;
            font-weight: bold;
            padding: 6px 0;
            overflow: hidden;
            position: relative;
            border-bottom: 3px solid #1a4fa3;
            /* warna biru bawah */
        }

        .running-text {
            display: inline-block;
            white-space: nowrap;
            padding-left: 100%;
            animation: runText 18s linear infinite;
            font-size: 14px;
            letter-spacing: 1px;
        }

        @keyframes runText {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }
    </style>

    <?php include 'header.php'; ?>

    <!-- Tambahkan running text di sini -->
    <div class="running-text-container">
        <div class="running-text">
            SELAMAT DATANG DI WEBSITE  KELURAHAN TONRORITA |
            PELAYANAN PUBLIK SENIN–JUMAT 08.00–15.00 (ISTIRAHAT 12.00–13.00) |
            INFORMASI TERBARU CEK DI MENU BERITA |
        </div>
    </div>

    <!-- NAVBAR -->
    <nav class="main-nav">
        <ul>
            <li><a href="index.php#home" class="active">Beranda</a></li>
            <li><a href="./sections/berita.php">Berita</a></li>
            <li><a href="./sections/.php">Produk Hukum</a></li>
            <li><a href="./sections/.php">Perencanaan & Penganggaran</a></li>
            <li><a href="./sections/.php">Laporan</a></li>
            <li><a href="./sections/.php">Panduan Layanan Publik</a></li>
            <li><a href="./sections/.php">Potensi & Produk Usaha</a></li>
        </ul>
    </nav>

</header>