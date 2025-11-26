<?php
require_once __DIR__ . '/../../config/connection.php';
include '../partials/navbar1.php';
include '../partials/header.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil koneksi database
    $dbConn = isset($db) ? $db : (isset($connect) ? $connect : null);
    if (!$dbConn) die("Koneksi database tidak ditemukan");

    // Ambil data input
    $nama   = mysqli_real_escape_string($dbConn, $_POST['name']);
    $email  = mysqli_real_escape_string($dbConn, $_POST['email']);
    $no_hp  = mysqli_real_escape_string($dbConn, $_POST['phone']);
    $pesan  = mysqli_real_escape_string($dbConn, $_POST['message']);

    // Simpan ke tabel KONTAK
    $insert = "
        INSERT INTO kontak (nama, email, no_hp, pesan, status, created_at)
        VALUES ('$nama', '$email', '$no_hp', '$pesan', 'belum_dibaca', NOW())
    ";

    mysqli_query($dbConn, $insert);

    echo "<script>
        alert('Pesan berhasil dikirim.');
        window.location.href='kontak.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="id">
    
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

<head>
    <meta charset="UTF-8">
    <title>Website Kelurahan Tonrorita</title>
    <link rel="icon" type="image/x-icon" href="../template_users/assets/icon.png" />

    <style>
        /* Style mengikuti halaman layanan */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 1200px;
            margin: 0 auto;
            padding: 25px;
        }

        h2 {
            margin: 20px 0;
            color: #0056b3;
            border-bottom: 4px solid #f1c40f;
            padding-bottom: 6px;
        }

        .form-box {
            background: white;
            padding: 25px;
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #bbb;
            margin-top: 6px;
            font-size: 15px;
        }

        textarea {
            resize: vertical;
        }

        .btn-submit {
            background: #0056b3;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: .3s;
        }

        .btn-submit:hover {
            background: #003f7f;
        }

        @media(max-width: 768px) {
            .container {
                width: 95%;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <h2>FORM KONTAK</h2>

        <div class="form-box">

            <form action="" method="post">

                <div class="form-group">
                    <label for="name">Nama Anda</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Anda</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="phone">No. HP / WhatsApp</label>
                    <input type="text" id="phone" name="phone" required>
                </div>

                <div class="form-group">
                    <label for="message">Pesan / Keluhan</label>
                    <textarea id="message" name="message" rows="6" required></textarea>
                </div>

                <button type="submit" class="btn-submit">Kirim Pesan</button>

            </form>

        </div>

    </div>

</body>

</html>