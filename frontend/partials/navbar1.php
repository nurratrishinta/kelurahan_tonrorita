<!-- Header -->
<header class="header">
    <div class="header-top">
        <?php
        include_once __DIR__ . '/../config/connection.php';

        $query = "SELECT * FROM profil_kelurahan LIMIT 1";
        $result = $db->query($query);
        $profil = $result->fetch_assoc();

        // DETEKSI HALAMAN AKTIF
        $current_page = basename($_SERVER['PHP_SELF']);
        ?>

        <div class="header-flex-container">

            <!-- Kiri: Logo + Info -->
            <div class="logo-container">
                <img src="../../storages/logo/1763007596_logokelurah-removebg-preview.png"
                    alt="Logo <?= htmlspecialchars($profil['nama_kelurahan']) ?>"
                    class="logo">

                <div class="header-info">
                    <h1><?= htmlspecialchars($profil['nama_kelurahan']) ?></h1>
                    <p>Kabupaten Gowa</p>
                    <p>Sulawesi Selatan</p>
                    <p class="address"><?= htmlspecialchars($profil['alamat']) ?></p>
                </div>
            </div>


            <!-- Kanan: Gambar berjalan seperti sepur -->
            <div class="header-right-content">
                <div class="image-row">
                    <div class="track">

                        <?php
                        // Ambil 8 foto dari galeri (lebih banyak → lebih halus)
                        $qGaleri = "SELECT id, gambar FROM galeri ORDER BY id DESC LIMIT 8";
                        $rGaleri = $db->query($qGaleri);

                        $gambar_list = [];
                        while ($row = $rGaleri->fetch_assoc()) {
                            $gambar_list[] = $row;
                        }

                        // SET 1 (gambar asli)
                        foreach ($gambar_list as $row) {
                        ?>
                            <a href="../sections/detail_berita.php?id=<?= $row['id'] ?>">
                                <img src="../../storages/galeri/<?= $row['gambar'] ?>" class="small-img">
                            </a>
                        <?php } ?>

                        <!-- SET 2 (duplikasi untuk looping mulus) -->
                        <?php foreach ($gambar_list as $row) { ?>
                            <a href="../sections/detail_berita.php?id=<?= $row['id'] ?>">
                                <img src="../../storages/galeri/<?= $row['gambar'] ?>" class="small-img">
                            </a>
                        <?php } ?>

                    </div>
                </div>
            </div>

        </div>


        <!-- STYLE -->
        <style>
            /* HEADER */
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
                align-items: center;
                width: 100%;
            }

            .logo-container {
                display: flex;
                align-items: center;
                gap: 15px;
            }

            .logo {
                width: 80px;
                aspect-ratio: 1/1;
                object-fit: cover;
                border-radius: 50%;
            }

            .header-info h1 {
                font-size: 1.4em;
                margin: 0;
                color: #0056b3;
            }

            .header-info p {
                margin: 2px 0;
                font-size: 0.9em;
                color: #666;
            }

            .header-info .address {
                font-size: 0.85em;
                font-style: italic;
                color: #444;
            }

            /* ======================== */
            /*    ANIMASI SEPUR        */
            /* ======================== */
            .image-row {
                overflow: hidden;
                width: 600px;
                /* bisa diubah sesuai lebar yg kakak mau */
                height: 110px;
                position: relative;
                border-radius: 6px;
            }

            .track {
                display: flex;
                gap: 20px;
                width: max-content;
                animation: sepur 18s linear infinite;
            }

            .small-img {
                width: 150px;
                height: 100px;
                object-fit: cover;
                border-radius: 6px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                transition: 0.2s;
            }

            .small-img:hover {
                transform: scale(1.05);
            }

            @keyframes sepur {
                0% {
                    transform: translateX(0);
                }

                100% {
                    transform: translateX(-50%);
                }
            }

            /* MOBILE */
            @media (max-width: 768px) {
                .header-flex-container {
                    flex-direction: column;
                    text-align: center;
                }

                .image-row {
                    width: 100%;
                }

                .small-img {
                    width: 90px;
                    height: 60px;
                }

                .track {
                    animation-duration: 12s;
                }
            }
        </style>
    </div>
    <!-- RUNNING TEXT -->
    <div class="running-text-container">
        <div class="running-text">
            SELAMAT DATANG DI WEBSITE KELURAHAN TONRORITA |
            PELAYANAN PUBLIK SENIN–JUMAT 08.00–15.00 (ISTIRAHAT 12.00–13.00) |
            INFORMASI & PENGUMUMAN TERBARU DAPAT ANDA LIHAT DI MENU BERITA |
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

    <!-- NAVBAR -->
    <nav class="main-nav">
        <ul>
            <li><a href="../sections/home.php" class="<?= ($current_page == 'home.php') ? 'active' : '' ?>">Beranda</a></li>
            <li><a href="../sections/berita.php" class="<?= ($current_page == 'berita.php') ? 'active' : '' ?>">Berita</a></li>
            <li><a href="../sections/galeri.php" class="<?= ($current_page == 'galeri.php') ? 'active' : '' ?>">Galeri</a></li>
            <li><a href="../sections/potensi_desa.php" class="<?= ($current_page == 'potensi_desa.php') ? 'active' : '' ?>">Potensi Desa</a></li>
            <li><a href="../sections/perangkat_kelurahan.php" class="<?= ($current_page == 'perangkat_kelurahan.php') ? 'active' : '' ?>">Perangkat Kelurahan</a></li>
            <li><a href="../sections/struktur_organisasi.php" class="<?= ($current_page == 'struktur_organisasi.php') ? 'active' : '' ?>">Struktur Organisasi</a></li>
            <li><a href="../sections/visi_misi.php" class="<?= ($current_page == 'visi_misi.php') ? 'active' : '' ?>">Visi & Misi</a></li>
            <li><a href="../sections/layanan.php" class="<?= ($current_page == 'layanan.php') ? 'active' : '' ?>">Layanan</a></li>
            <li><a href="../sections/kontak.php" class="<?= ($current_page == 'kontak.php') ? 'active' : '' ?>">kontak</a></li>
        </ul>
    </nav>

    <style>
        .main-nav a.active {
            background-color: rgba(255, 255, 255, 0.25);
            border-radius: 3px;
        }
    </style>


</header>