<?php
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';
require_once __DIR__ . '/../../../config/connection.php';

// ====== HITUNG DATA ======
$qProfil = mysqli_query($connect, "SELECT COUNT(*) AS total FROM profil_kelurahan");
$jumlahProfil = mysqli_fetch_assoc($qProfil)['total'];

$qBerita = mysqli_query($connect, "SELECT COUNT(*) AS total FROM berita");
$jumlahBerita = mysqli_fetch_assoc($qBerita)['total'];

$qGaleri = mysqli_query($connect, "SELECT COUNT(*) AS total FROM galeri");
$jumlahGaleri = mysqli_fetch_assoc($qGaleri)['total'];

$qLayanan = mysqli_query($connect, "SELECT COUNT(*) AS total FROM layanan");
$jumlahLayanan = mysqli_fetch_assoc($qLayanan)['total'];

$qPotensi = mysqli_query($connect, "SELECT COUNT(*) AS total FROM potensi_desa");
$jumlahPotensi = mysqli_fetch_assoc($qPotensi)['total'];

$qPerangkat = mysqli_query($connect, "SELECT COUNT(*) AS total FROM perangkat_kelurahan");
$jumlahPerangkat = mysqli_fetch_assoc($qPerangkat)['total'];
?>

<div class="page-wrapper" style="margin-left:70px; min-height:100vh; background-color:#f8f9fa;">
    <div class="container-fluid py-4">
        <h3 class="mb-4 fw-bold">Dashboard Website Profil Kelurahan</h3>

        <!-- Cards -->
        <div class="row g-4 mb-4">

            <!-- Profil Kelurahan -->
            <div class="col-sm-6 col-lg-4">
                <a href="../profil_kelurahan/index.php" class="text-decoration-none">
                    <div class="card text-white bg-primary shadow-sm border-0 h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 text-white">Profil Kelurahan</h6>
                                <h2 class="fw-bold text-white"><?= $jumlahProfil ?></h2>
                            </div>
                            <i class="material-icons fa-2x opacity-75">apartment</i>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Berita -->
            <div class="col-sm-6 col-lg-4">
                <a href="../berita/index.php" class="text-decoration-none">
                    <div class="card text-white bg-success shadow-sm border-0 h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 text-white">Berita</h6>
                                <h2 class="fw-bold text-white"><?= $jumlahBerita ?></h2>
                            </div>
                            <i class="material-icons fa-2x opacity-75">feed</i>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Galeri -->
            <div class="col-sm-6 col-lg-4">
                <a href="../galeri/index.php" class="text-decoration-none">
                    <div class="card text-white bg-warning shadow-sm border-0 h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 text-white">Galeri</h6>
                                <h2 class="fw-bold text-white"><?= $jumlahGaleri ?></h2>
                            </div>
                            <i class="material-icons fa-2x opacity-75">collections</i>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Layanan -->
            <div class="col-sm-6 col-lg-4">
                <a href="../layanan/index.php" class="text-decoration-none">
                    <div class="card text-white bg-info shadow-sm border-0 h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 text-white">Layanan</h6>
                                <h2 class="fw-bold text-white"><?= $jumlahLayanan ?></h2>
                            </div>
                            <i class="material-icons fa-2x opacity-75">handshake</i>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Potensi Desa -->
            <div class="col-sm-6 col-lg-4">
                <a href="../potensi_desa/index.php" class="text-decoration-none">
                    <div class="card text-white bg-secondary shadow-sm border-0 h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 text-white">Potensi Desa</h6>
                                <h2 class="fw-bold text-white"><?= $jumlahPotensi ?></h2>
                            </div>
                            <i class="material-icons fa-2x opacity-75">public</i>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Perangkat Kelurahan -->
            <div class="col-sm-6 col-lg-4">
                <a href="../perangkat_kelurahan/index.php" class="text-decoration-none">
                    <div class="card text-white bg-danger shadow-sm border-0 h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 text-white">Perangkat Kelurahan</h6>
                                <h2 class="fw-bold text-white"><?= $jumlahPerangkat ?></h2>
                            </div>
                            <i class="material-icons fa-2x opacity-75">groups</i>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Grafik Statistik -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <h5 class="card-title mb-4">Statistik Data Website</h5>
                <canvas id="dashboardChart" height="120"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('dashboardChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                'Profil Kelurahan',
                'Berita',
                'Galeri',
                'Layanan',
                'Potensi Desa',
                'Perangkat Kelurahan'
            ],
            datasets: [{
                label: 'Jumlah Data',
                data: [
                    <?= $jumlahProfil ?>,
                    <?= $jumlahBerita ?>,
                    <?= $jumlahGaleri ?>,
                    <?= $jumlahLayanan ?>,
                    <?= $jumlahPotensi ?>,
                    <?= $jumlahPerangkat ?>
                ],
                backgroundColor: [
                    '#007bff', // Profil
                    '#28a745', // Berita
                    '#ffc107', // Galeri
                    '#17a2b8', // Layanan
                    '#6c757d', // Potensi
                    '#dc3545' // Perangkat
                ],
                borderColor: [
                    '#0056b3',
                    '#1c7430',
                    '#e0a800',
                    '#117a8b',
                    '#545b62',
                    '#bd2130'
                ],
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                }
            }
        }
    });
</script>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>