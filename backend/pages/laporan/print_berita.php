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
    <link rel="icon" type="image/png" href="../../templates-admin/material-dashboard-2/assets/img/keluraa.png">
    <style>
        body {
            font-size: 14px;
            color: #000;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .text-center {
            text-align: center;
        }

        .judul {
            font-weight: bold;
            font-size: 20px;
            text-transform: uppercase;
        }

        hr {
            border-top: 2px solid #000;
            margin: 10px 0 20px;
        }

        .ttd-section {
            margin-top: 50px;
        }

        .ttd-section p {
            margin: 3px 0;
        }

        @media print {
            .no-print {
                display: none;
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
                    <th>No</th>
                    <th>Judul</th>
                    <th>Gambar</th>
                    <th>Penulis</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>Dibuat</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($item = $result->fetch_object()):
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($item->judul) ?></td>
                        <td>
                            <?php if (!empty($item->gambar)): ?>
                                <img src="../../../storages/berita/<?= htmlspecialchars($item->gambar) ?>" width="60" class="rounded shadow-sm">
                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($item->penulis) ?></td>
                        <td><?= htmlspecialchars($item->kategori) ?></td>
                        <td><?= htmlspecialchars($item->tanggal) ?></td>
                        <td><?= htmlspecialchars($item->created_at) ?></td>
                    </tr>
                <?php endwhile;

                if ($no === 1) {
                    echo '<tr><td colspan="7" class="text-center text-muted">Tidak ada data berita</td></tr>';
                }
                ?>
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
                <p>(___________________)</p>
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