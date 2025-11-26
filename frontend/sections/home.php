<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title> Website Kelurahan Tonrorita</title>
    <link rel="icon" type="image/x-icon" href="../template_users/assets/icon.png" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="../template_users/css/styles.css" rel="stylesheet" />
</head>

</html>

<?php
// Koneksi ke database
include '../config/connection.php';
include '../partials/navbar1.php';

// === AMBIL BERITA UTAMA (LIMIT 1) ===
$queryUtama = "SELECT * FROM berita ORDER BY created_at DESC LIMIT 1";
$resultUtama = mysqli_query($db, $queryUtama);

if ($resultUtama && mysqli_num_rows($resultUtama) > 0) {
    $berita = mysqli_fetch_assoc($resultUtama);
} else {
    $berita = [
        'judul' => 'Belum Ada Berita',
        'isi' => '<p>Belum ada berita yang tersedia saat ini.</p>',
        'gambar' => 'https://via.placeholder.com/800x400?text=No+Image',
        'penulis' => '-',
        'kategori' => '-',
        'created_at' => date('d M Y H:i:s')
    ];
}

// === AMBIL ARTIKEL TERKINI ===
$queryTerkini = "SELECT * FROM berita ORDER BY created_at DESC LIMIT 1, 3";
$resultTerkini = mysqli_query($db, $queryTerkini);

$artikel_terkini = [];
if ($resultTerkini && mysqli_num_rows($resultTerkini) > 0) {
    while ($row = mysqli_fetch_assoc($resultTerkini)) {
        $artikel_terkini[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <style>
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

        .header {
            background-color: #fff;
            border-bottom: 3px solid #d4af37;
            padding: 15px 0;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            background-color: #fff;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo {
            width: 80px;
            height: 80px;
            margin-right: 15px;
        }

        .header-info h1 {
            font-size: 24px;
            color: #0056b3;
            margin-bottom: 5px;
        }

        .header-info p {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }

        .header-info .address {
            font-size: 12px;
            color: #888;
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

        .content-area {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .main-content {
            flex: 3;
        }

        .article-header {
            border-bottom: 2px solid #d4af37;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .article-title {
            font-size: 20px;
            color: #0056b3;
            margin-bottom: 5px;
        }

        .article-meta {
            font-size: 12px;
            color: #666;
            margin-bottom: 15px;
        }

        .article-image {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .article-content {
            margin-bottom: 20px;
            line-height: 1.8;
            text-align: justify;
        }

        .article-content p {
            margin-bottom: 15px;
        }

        .section-title {
            font-size: 18px;
            color: #0056b3;
            border-bottom: 2px solid #d4af37;
            padding-bottom: 5px;
            margin: 30px 0 15px 0;
        }

        .recent-article {
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }

        .recent-article-title {
            font-size: 18px;
            color: #0056b3;
            margin-bottom: 5px;
        }

        .recent-article-meta {
            font-size: 12px;
            color: #666;
        }

        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: 30px;
            font-size: 12px;
        }

        .footer a {
            color: #d4af37;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        @media (max-width:768px) {
            .container {
                width: 100%;
                padding: 10px;
            }

            .content-area {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <div class="container" id="home">
        <h2 style="margin: 20px 0; color:#fffffff; border-bottom: 4px solid #f1c40f; padding-bottom: 6px;">
            BERANDA
        </h2>

        <div class="content-area">
            <div class="main-content">

                <div class="article-header">
                    <h2 class="article-title"><?= htmlspecialchars($berita['judul']); ?></h2>
                    <div class="article-meta">
                        <?= htmlspecialchars($berita['penulis']); ?>,
                        <?= htmlspecialchars($berita['created_at']); ?> |
                        <em style="display:block;margin-bottom:10px;"><?= htmlspecialchars($berita['kategori']); ?></em>
                    </div>
                </div>

                <img src="../../storages/berita/<?= htmlspecialchars($berita['gambar']); ?>"
                    alt="<?= htmlspecialchars($berita['judul']); ?>"
                    class="article-image">

                <div class="article-content">
                    <?= $berita['isi']; ?>
                </div>

                <?php if (!empty($artikel_terkini)): ?>
                    <div class="section-title">Artikel Terkini</div>
                    <?php foreach ($artikel_terkini as $artikel): ?>
                        <div class="recent-article">
                            <h3 class="recent-article-title">
                                <a href="../sections/detail_berita.php?id=<?= $artikel['id']; ?>" style="color:#0056b3; text-decoration:none;">
                                    <?= htmlspecialchars($artikel['judul']); ?>
                                </a>
                            </h3>
                            <div class="recent-article-meta">
                                <?= htmlspecialchars($artikel['created_at']); ?> • <?= htmlspecialchars($artikel['penulis']); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Tidak ada artikel terkini.</p>
                <?php endif; ?>


            </div>
        </div>
    </div>

</body>

</html>