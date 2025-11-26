<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Website Kelurahan Tonrorita</title>
    <link rel="icon" type="image/x-icon" href="../template_users/assets/icon.png" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../template_users/css/styles.css" rel="stylesheet" />
</head>

</html>










<?php
include '../../config/connection.php';
include '../partials/navbar1.php';
include '../partials/header.php';

// Konfigurasi pagination
$layanan_per_halaman = 5;
$halaman_sekarang = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($halaman_sekarang < 1) $halaman_sekarang = 1;

$offset = ($halaman_sekarang - 1) * $layanan_per_halaman;

// Query total layanan
$total_query = "SELECT COUNT(*) AS total FROM layanan";
$total_result = mysqli_query($db, $total_query);
$total_data = mysqli_fetch_assoc($total_result)['total'];
$total_halaman = ceil($total_data / $layanan_per_halaman);

// Query layanan dengan limit & offset
$query = "SELECT * FROM layanan ORDER BY created_at DESC LIMIT $layanan_per_halaman OFFSET $offset";
$result = mysqli_query($db, $query);
?>

<!DOCTYPE html>

<style>
    /* (TIDAK ADA YANG DIUBAH, SEMUA STYLE MILIKMU UTUH) */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        color: #333;
        background-color: #f9f9f9;
    }

    .container {
        width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .header-menu {
        background-color: #e67e22;
        padding: 5px 0;
    }

    .header-menu ul {
        display: flex;
        list-style: none;
        justify-content: center;
        flex-wrap: wrap;
    }

    .header-menu li {
        margin: 0 10px;
    }

    .header-menu a {
        color: white;
        text-decoration: none;
        padding: 8px 12px;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .header-menu a:hover {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 3px;
    }

    .main-nav {
        background-color: #3498db;
        padding: 10px 0;
        margin: 15px 0;
    }

    .main-nav ul {
        display: flex;
        list-style: none;
        justify-content: center;
        flex-wrap: wrap;
    }

    .main-nav li {
        margin: 0 10px;
    }

    .main-nav a {
        color: white;
        text-decoration: none;
        padding: 8px 12px;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .main-nav a:hover {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 3px;
    }

    .berita-item {
        border-bottom: 1px solid #ccc;
        padding: 20px 0;
    }

    .berita-judul {
        font-size: 18px;
        font-weight: bold;
        color: #0056b3;
        text-decoration: none;
        display: block;
        margin-bottom: 5px;
    }

    .berita-judul:hover {
        text-decoration: underline;
    }

    .berita-meta {
        font-size: 12px;
        color: #777;
        margin-bottom: 10px;
    }

    .berita-konten {
        display: flex;
        align-items: flex-start;
        gap: 15px;
    }

    .berita-teks {
        flex: 1;
        font-size: 14px;
        text-align: justify;
        line-height: 1.8;
    }

    .selengkapnya {
        color: #0056b3;
        text-decoration: none;
        font-size: 13px;
    }

    .selengkapnya:hover {
        text-decoration: underline;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 30px;
        gap: 8px;
        flex-wrap: wrap;
    }

    .pagination a,
    .pagination span {
        display: inline-block;
        padding: 8px 14px;
        text-decoration: none;
        border: 1px solid #ddd;
        color: #333;
        background: #fff;
        border-radius: 4px;
        transition: all 0.3s;
    }

    .pagination a:hover {
        background-color: #0056b3;
        color: white;
        border-color: #0056b3;
    }

    .pagination .active {
        background-color: #0056b3;
        color: white;
        border-color: #0056b3;
        pointer-events: none;
    }

    .pagination .disabled {
        color: #aaa;
        background: #f9f9f9;
        border-color: #eee;
        pointer-events: none;
    }

    @media (max-width: 768px) {
        .container {
            width: 95%;
            padding: 10px;
        }

        .berita-konten {
            flex-direction: column;
        }

        .pagination a,
        .pagination span {
            padding: 6px 10px;
            font-size: 14px;
        }
    }
</style>

<body>

    <div class="container">

        <h2 style="margin: 20px 0; color:#fffffff; border-bottom: 4px solid #f1c40f; padding-bottom: 6px;">
            LAYANAN
        </h2>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($l = mysqli_fetch_assoc($result)): ?>
                <div class="berita-item">

                    <div class="berita-judul">
                        <?= htmlspecialchars($l['nama_layanan']); ?>
                    </div>

                    <div class="berita-meta">
                        Tanggal dibuat: <?= htmlspecialchars($l['created_at']); ?>
                    </div>

                    <div class="berita-konten">
                        <div class="berita-teks">
                            <strong>Deskripsi:</strong><br>
                            <?= nl2br(htmlspecialchars($l['deskripsi'])); ?><br><br>

                            <strong>Syarat:</strong><br>
                            <?= nl2br(htmlspecialchars($l['syarat'])); ?><br><br>

                            <strong>Biaya:</strong><br>
                            <?= nl2br(htmlspecialchars($l['biaya'])); ?><br><br>

                            <strong>Waktu Proses:</strong><br>
                            <?= nl2br(htmlspecialchars($l['waktu_proses'])); ?><br><br>
                        </div>
                    </div>

                </div>
            <?php endwhile; ?>

            <!-- Pagination -->
            <div class="pagination">
                <?php if ($halaman_sekarang > 1): ?>
                    <a href="?page=<?= $halaman_sekarang - 1; ?>">&laquo; Sebelumnya</a>
                <?php else: ?>
                    <span class="disabled">&laquo; Sebelumnya</span>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_halaman; $i++): ?>
                    <?php if ($i == $halaman_sekarang): ?>
                        <span class="active"><?= $i; ?></span>
                    <?php else: ?>
                        <a href="?page=<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($halaman_sekarang < $total_halaman): ?>
                    <a href="?page=<?= $halaman_sekarang + 1; ?>">Berikutnya &raquo;</a>
                <?php else: ?>
                    <span class="disabled">Berikutnya &raquo;</span>
                <?php endif; ?>
            </div>

        <?php else: ?>
            <p>Tidak ada layanan tersedia.</p>
        <?php endif; ?>

    </div>

</body>

</html>