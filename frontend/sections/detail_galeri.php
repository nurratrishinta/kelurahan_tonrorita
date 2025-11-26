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
include '../config/connection.php';
include '../partials/navbar1.php';

// Pastikan ID diterima
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("<h2>Galeri tidak ditemukan.</h2>");
}

$id = intval($_GET['id']);

// Ambil data galeri berdasarkan ID
$query = "SELECT * FROM galeri WHERE id = $id LIMIT 1";
$result = mysqli_query($db, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("<h2>Galeri tidak ditemukan.</h2>");
}

$galeri = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
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

    <div class="container">
        <h2 style="margin: 20px 0; color:#fffffff; border-bottom: 4px solid #f1c40f; padding-bottom: 6px;">
            DETAIL GALERI
        </h2>

        <div class="content-area">
            <div class="main-content">

                <div class="article-header">
                    <h2 class="article-title"><?= htmlspecialchars($galeri['judul']); ?></h2>
                    <div class="article-meta">
                        <?= htmlspecialchars($galeri['created_at']); ?> •
                        <strong><?= htmlspecialchars($galeri['kategori']); ?></strong>
                    </div>
                </div>

                <img src="../../storages/galeri/<?= htmlspecialchars($galeri['gambar']); ?>"
                    alt="<?= htmlspecialchars($galeri['judul']); ?>" class="article-image">

                <div class="article-content">
                    <?= $galeri['deskripsi']; ?>
                </div>

            </div>
        </div>

    </div>

</body>

</html>