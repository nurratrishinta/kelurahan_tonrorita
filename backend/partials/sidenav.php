<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$currentURI = $_SERVER['REQUEST_URI'];

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ambil role dari session
$role = strtolower($_SESSION['role'] ?? 'user');
?>

<style>
    aside.sidenav .nav-link {
        color: white !important;
    }

    aside.sidenav .nav-link.active {
        background: rgba(192, 33, 139, 0.3);
        border-radius: 0.375rem;
    }

    aside.sidenav .material-icons {
        vertical-align: middle;
    }

    .sidebar-header {
        text-align: center;
        padding: 1rem;
    }

    .sidebar-header h5 {
        color: white;
        margin-top: 0.5rem;
        font-weight: bold;
    }
</style>

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3"
    style="background: linear-gradient(180deg, rgb(136, 239, 247) 0%, rgb(15, 63, 71) 100%);"
    id="sidenav-main">

    <div class="sidebar-header text-center py-3">
        <img src="../../templates-admin/material-dashboard-2/assets/img/logokelurah-removebg-preview.png"
            alt="Logo" style="width:80px; height:80px; border-radius:50%;">
        <h5 class="text-white fw-bold mt-2">KELURAHAN TONRORITA</h5>
    </div>

    <hr class="horizontal light mt-0 mb-2">

    <div class="collapse navbar-collapse h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">

            <?php if ($role === 'admin') : ?>
                <!-- ✅ MENU UNTUK ADMIN -->
                <li class="nav-item">
                    <a class="nav-link <?= (strpos($currentURI, '/dashboard/') !== false) ? 'active bg-gradient-primary' : '' ?>" href="../dashboard/index.php">
                        <i class="material-icons opacity-10">dashboard</i>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (strpos($currentURI, '/profil_kelurahan/') !== false) ? 'active bg-gradient-primary' : '' ?>" href="../profil_kelurahan/index.php">
                        <i class="material-icons opacity-10">domain</i>
                        <span class="nav-link-text ms-1">Profil Kelurahan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (strpos($currentURI, '/admin/') !== false) ? 'active bg-gradient-primary' : '' ?>" href="../admin/index.php">
                        <i class="material-icons opacity-10">admin_panel_settings</i>
                        <span class="nav-link-text ms-1">Admin</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= (strpos($currentURI, '/struktur_organisasi/') !== false) ? 'active bg-gradient-primary' : '' ?>" href="../struktur_organisasi/index.php">
                        <i class="material-icons opacity-10">account_tree</i>
                        <span class="nav-link-text ms-1">Struktur Organisasi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (strpos($currentURI, '/berita/') !== false) ? 'active bg-gradient-primary' : '' ?>" href="../berita/index.php">
                        <i class="material-icons opacity-10">article</i>
                        <span class="nav-link-text ms-1">Berita</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (strpos($currentURI, '/galeri/') !== false) ? 'active bg-gradient-primary' : '' ?>" href="../galeri/index.php">
                        <i class="material-icons opacity-10">photo_library</i>
                        <span class="nav-link-text ms-1">Galeri</span>
                    </a>
                </li>
                <!-- Menu Layanan -->
                <li class="nav-item">
                    <a class="nav-link <?= (strpos($currentURI, '/layanan/') !== false) ? 'active bg-gradient-primary' : '' ?>" href="../layanan/index.php">
                        <i class="material-icons opacity-10">handshake</i>
                        <span class="nav-link-text ms-1">Layanan</span>
                    </a>
                </li>

                <!-- Menu Sosial Media -->
                <li class="nav-item">
                    <a class="nav-link <?= (strpos($currentURI, '/sosial_media/') !== false) ? 'active bg-gradient-primary' : '' ?>" href="../sosial_media/index.php">
                        <i class="material-icons opacity-10">share</i>
                        <span class="nav-link-text ms-1">Sosial Media</span>
                    </a>
                </li>

                <!-- Menu Potensi Desa -->
                <li class="nav-item">
                    <a class="nav-link <?= (strpos($currentURI, '/potensi_desa/') !== false) ? 'active bg-gradient-primary' : '' ?>" href="../potensi_desa/index.php">
                        <i class="material-icons opacity-10">public</i>
                        <span class="nav-link-text ms-1">Potensi Desa</span>
                    </a>
                </li>

                <!-- Menu Perangkat Kelurahan -->
                <li class="nav-item">
                    <a class="nav-link <?= (strpos($currentURI, '/perangkat_kelurahan/') !== false) ? 'active bg-gradient-primary' : '' ?>" href="../perangkat_kelurahan/index.php">
                        <i class="material-icons opacity-10">groups</i>
                        <span class="nav-link-text ms-1">Perangkat Kelurahan</span>
                    </a>
                </li>
                <!-- Menu Kontak -->
                <li class="nav-item">
                    <a class="nav-link <?= (strpos($currentURI, '/kontak/') !== false) ? 'active bg-gradient-primary' : '' ?>"
                        href="../kontak/index.php">
                        <i class="material-icons opacity-10">call</i>
                        <span class="nav-link-text ms-1">Kontak</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link <?= (strpos($currentURI, '/download/') !== false) ? 'active bg-gradient-primary' : '' ?>" href="../download/index.php">
                        <i class="material-icons opacity-10">download</i>
                        <span class="nav-link-text ms-1">Download</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (strpos($currentURI, '/laporan/') !== false) ? 'active bg-gradient-primary' : '' ?>" href="../laporan/index.php">
                        <i class="material-icons opacity-10">bar_chart</i>
                        <span class="nav-link-text ms-1">Laporan</span>
                    </a>
                </li>

            <?php elseif ($role === 'operator') : ?>
                <!-- ✅ MENU UNTUK OPERATOR -->
                <li class="nav-item">
                    <a class="nav-link <?= (strpos($currentURI, '/dashboard/') !== false) ? 'active bg-gradient-primary' : '' ?>" href="../dashboard/index.php">
                        <i class="material-icons opacity-10">dashboard</i>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (strpos($currentURI, '/profil_kelurahan/') !== false) ? 'active bg-gradient-primary' : '' ?>" href="../profil_kelurahan/index.php">
                        <i class="material-icons opacity-10">domain</i>
                        <span class="nav-link-text ms-1">Profil Kelurahan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (strpos($currentURI, '/struktur_organisasi/') !== false) ? 'active bg-gradient-primary' : '' ?>" href="../struktur_organisasi/index.php">
                        <i class="material-icons opacity-10">account_tree</i>
                        <span class="nav-link-text ms-1">Struktur Organisasi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (strpos($currentURI, '/berita/') !== false) ? 'active bg-gradient-primary' : '' ?>" href="../berita/index.php">
                        <i class="material-icons opacity-10">article</i>
                        <span class="nav-link-text ms-1">Berita</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (strpos($currentURI, '/galeri/') !== false) ? 'active bg-gradient-primary' : '' ?>" href="../galeri/index.php">
                        <i class="material-icons opacity-10">photo_library</i>
                        <span class="nav-link-text ms-1">Galeri</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (strpos($currentURI, '/download/') !== false) ? 'active bg-gradient-primary' : '' ?>" href="../download/index.php">
                        <i class="material-icons opacity-10">download</i>
                        <span class="nav-link-text ms-1">Download</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (strpos($currentURI, '/laporan/') !== false) ? 'active bg-gradient-primary' : '' ?>" href="../laporan/index.php">
                        <i class="material-icons opacity-10">bar_chart</i>
                        <span class="nav-link-text ms-1">Laporan</span>
                    </a>
                </li>

            <?php else : ?>
                <!-- ✅ MENU UNTUK PENGUNJUNG -->
                <li class="nav-item">
                    <a class="nav-link <?= (strpos($currentURI, '/profil_kelurahan2/') !== false) ? 'active bg-gradient-primary' : '' ?>" href="../profil_kelurahan2/index.php">
                        <i class="material-icons opacity-10">domain</i>
                        <span class="nav-link-text ms-1">Profil Kelurahan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (strpos($currentURI, '/berita2/') !== false) ? 'active bg-gradient-primary' : '' ?>" href="../berita2/index.php">
                        <i class="material-icons opacity-10">article</i>
                        <span class="nav-link-text ms-1">Berita</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (strpos($currentURI, '/galeri2/') !== false) ? 'active bg-gradient-primary' : '' ?>" href="../galeri2/index.php">
                        <i class="material-icons opacity-10">photo_library</i>
                        <span class="nav-link-text ms-1">Galeri</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (strpos($currentURI, '/download/') !== false) ? 'active bg-gradient-primary' : '' ?>" href="../download/index.php">
                        <i class="material-icons opacity-10">download</i>
                        <span class="nav-link-text ms-1">Download</span>
                    </a>
                </li>
            <?php endif; ?>

            <!-- 🚪 LOGOUT -->
            <li class="nav-item mt-3">
                <a href="../../actions/auth/logout.php" class="nav-link text-danger d-flex align-items-center">
                    <i class="material-icons me-2">logout</i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
</aside>