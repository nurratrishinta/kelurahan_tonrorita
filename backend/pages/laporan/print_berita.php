<?php
include '../../../config/connection.php';

// Ambil data berita
$qBerita = "SELECT * FROM berita ORDER BY created_at DESC";
$result = mysqli_query($connect, $qBerita) or die("Query error: " . mysqli_error($connect));

// Format tanggal sekarang dalam bahasa Indonesia
date_default_timezone_set('Asia/Jakarta');
$hari = date('l');
$namaHari = [
    'Sunday' => 'Minggu',
    'Monday' => 'Senin',
    'Tuesday' => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => 'Jumat',
    'Saturday' => 'Sabtu'
][$hari];

$bulan = [
    'January' => 'Januari',
    'February' => 'Februari',
    'March' => 'Maret',
    'April' => 'April',
    'May' => 'Mei',
    'June' => 'Juni',
    'July' => 'Juli',
    'August' => 'Agustus',
    'September' => 'September',
    'October' => 'Oktober',
    'November' => 'November',
    'December' => 'Desember'
][date('F')];

$tanggalSekarang = $namaHari . ', ' . date('d ') . $bulan . date(' Y');
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Data Berita</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="../../templates-admin/material-dashboard-2/assets/img/logokelurah-removebg-preview.png">
    <style>
        body {
            font-size: 14px;
            color: #000;
        }

        .judul {
            font-weight: bold;
            font-size: 20px;
            text-transform: uppercase;
        }

        .table th,
        .table td {
            vertical-align: middle;
            padding: 6px;
        }

        /* RAPIKAN JUDUL */
        .judul-berita {
            white-space: normal !important;
            word-wrap: break-word !important;
            word-break: break-word !important;
            max-width: 280px;
            text-align: left;
        }

        hr {
            border-top: 2px solid #000;
            margin: 10px 0 20px;
        }

        .ttd-section {
            margin-top: 50px;
        }

        @media print {
            .no-print {
                display: none;
            }

            /* Agar tabel tidak melebar saat print */
            table {
                page-break-inside: auto;
                width: 100%;
                table-layout: fixed;
            }

            th,
            td {
                word-wrap: break-word !important;
                word-break: break-word !important;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="container mt-4">
        <div class="text-center">
            <h5 class="judul">Laporan Data Berita</h5>
            <p>Website Profil Kelurahan Tonrorita</p>
            <hr>
        </div>

        <table class="table table-bordered table-striped text-center">
            <thead class="table-light">
                <tr>
                    <th style="width:40px">No</th>
                    <th style="width:280px">Judul</th>
                    <th style="width:80px">Gambar</th>
                    <th style="width:120px">Penulis</th>
                    <th style="width:100px">Kategori</th>
                    <th style="width:100px">Tanggal</th>
                    <th style="width:120px">Dibuat</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($item = $result->fetch_object()):
                ?>
                    <tr>
                        <td><?= $no++ ?></td>

                        <!-- Judul rapi -->
                        <td class="judul-berita"><?= htmlspecialchars($item->judul) ?></td>

                        <td>
                            <?php if (!empty($item->gambar)): ?>
                                <img src="../../../storages/berita/<?= htmlspecialchars($item->gambar) ?>" width="55" class="rounded shadow-sm">
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>

                        <td><?= htmlspecialchars($item->penulis) ?></td>
                        <td><?= htmlspecialchars($item->kategori) ?></td>
                        <td><?= htmlspecialchars($item->tanggal) ?></td>
                        <td><?= htmlspecialchars($item->created_at) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Bagian tanda tangan -->
        <div class="row ttd-section">
            <div class="col-6"></div>
            <div class="col-6 text-end">
                <p><?= $tanggalSekarang ?></p>
                <p>Mengetahui,</p>
                <p><strong>Kepala Kelurahan Tonrorita</strong></p>
                <br><br><br>
                <p>(_____________________)</p>
            </div>
        </div>

        <!-- Tombol print -->
        <div class="no-print text-center mt-4">
            <button onclick="window.print()" class="btn btn-success">Print Sekarang</button>
            <a href="./index.php" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

</body>

</html>