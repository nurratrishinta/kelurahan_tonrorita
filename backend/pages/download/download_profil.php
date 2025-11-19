<?php
include '../../../config/connection.php';

// Ambil data profil kelurahan
$qProfil = "SELECT * FROM profil_kelurahan ORDER BY created_at DESC";
$result = mysqli_query($connect, $qProfil) or die("Query error: " . mysqli_error($connect));

// Format tanggal sekarang (Bahasa Indonesia)
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

// Atur agar file langsung terunduh
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Data_Profil_Kelurahan_" . date('Ymd_His') . ".xls");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Download Data Profil Kelurahan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #000;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }

        th {
            background-color: #d6eaf8;
        }

        h3,
        p {
            text-align: center;
            margin: 0;
        }

        .ttd {
            margin-top: 50px;
            width: 100%;
        }

        .ttd td {
            border: none;
            text-align: right;
            padding-right: 50px;
        }
    </style>
</head>

<body>
    <h3>Data Profil Kelurahan Tonrorita</h3>
    <p>Website Profil Kelurahan Tonrorita</p>
    <br>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kelurahan</th>
                <th>Visi</th>
                <th>Misi</th>
                <th>Sejarah</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Email</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($item = $result->fetch_object()):
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($item->nama_kelurahan) ?></td>
                    <td><?= htmlspecialchars($item->visi) ?></td>
                    <td><?= htmlspecialchars($item->misi) ?></td>
                    <td><?= htmlspecialchars($item->sejarah) ?></td>
                    <td><?= htmlspecialchars($item->alamat) ?></td>
                    <td><?= htmlspecialchars($item->telepon) ?></td>
                    <td><?= htmlspecialchars($item->email) ?></td>
                    <td><?= htmlspecialchars($item->created_at) ?></td>
                </tr>
            <?php endwhile;

            if ($no === 1) {
                echo '<tr><td colspan="9">Tidak ada data profil kelurahan</td></tr>';
            }
            ?>
        </tbody>
    </table>

    <br><br>

    <table class="ttd">
        <tr>
            <td>
                <?= $tanggalSekarang ?><br>
                Mengetahui,<br>
                <strong>Kepala Kelurahan Tonrorita</strong><br><br><br>
                (_____________________)
            </td>
        </tr>
    </table>
</body>

</html>