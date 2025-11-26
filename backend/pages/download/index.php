<?php
// Koneksi database dan layout
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

// ===== QUERY DATA PROFIL KELURAHAN =====
$qProfil = "SELECT * FROM profil_kelurahan ORDER BY created_at DESC";
$result = mysqli_query($connect, $qProfil) or die("Query error: " . mysqli_error($connect));
?>

<!-- Content Wrapper -->
<div class="body-wrapper">
    <div class="container-fluid">

        <!-- Judul Halaman -->
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold mb-0">
                    <i class="bi bi-building"></i> Data Profil Kelurahan
                </h4>
                <div>
                    <a href="./download_profil.php" target="_blank" class="btn btn-success btn-sm">
                        <i class="bi bi-download"></i> 
                    </a>
                </div>
            </div>
        </div>

        <!-- Jika data kosong -->
        <?php if (mysqli_num_rows($result) === 0): ?>
            <div class="card shadow-sm p-5 text-center">
                <i class="bi bi-building fs-1 text-muted"></i>
                <p class="mt-3 mb-0 text-muted">Belum ada profil kelurahan yang ditambahkan.</p>
                <a href="./create.php" class="btn btn-outline-primary mt-3">
                    <i class="bi bi-plus-circle"></i> Tambah Sekarang
                </a>
            </div>

        <?php else: ?>

            <!-- Tampilan Dalam Bentuk Card Grid -->
            <div class="row">
                <?php
                $no = 1;
                while ($item = $result->fetch_object()):
                ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">

                                <!-- Bagian Logo + Nama Kelurahan -->
                                <div class="d-flex align-items-center mb-3">
                                    <?php if (!empty($item->logo)): ?>
                                        <img src="../../../storages/logo/<?= htmlspecialchars($item->logo) ?>"
                                            width="60" height="60" class="rounded-circle me-3"
                                            style="object-fit: cover;">
                                    <?php else: ?>
                                        <div class="bg-light rounded-circle d-flex justify-content-center align-items-center me-3"
                                            style="width:60px; height:60px;">
                                            <i class="bi bi-image text-secondary fs-4"></i>
                                        </div>
                                    <?php endif; ?>

                                    <div>
                                        <h6 class="mb-0 fw-bold"><?= htmlspecialchars($item->nama_kelurahan) ?></h6>
                                        <small class="text-muted">Dibuat: <?= htmlspecialchars($item->created_at) ?></small>
                                    </div>
                                </div>

                                <!-- Data Turun Ke Bawah -->
                                <p class="mb-2"><strong>Visi:</strong><br>
                                    <span class="text-muted"><?= htmlspecialchars(substr($item->visi, 0, 120)) ?>...</span>
                                </p>

                                <p class="mb-2"><strong>Misi:</strong><br>
                                    <span class="text-muted"><?= htmlspecialchars(substr($item->misi, 0, 120)) ?>...</span>
                                </p>

                                <p class="mb-2"><strong>Sejarah:</strong><br>
                                    <span class="text-muted"><?= htmlspecialchars(substr($item->sejarah, 0, 120)) ?>...</span>
                                </p>

                                <p class="mb-2"><strong>Alamat:</strong><br>
                                    <span class="text-muted"><?= htmlspecialchars($item->alamat) ?></span>
                                </p>

                                <p class="mb-2"><strong>Telepon:</strong>
                                    <span class="text-muted"><?= htmlspecialchars($item->telepon) ?></span>
                                </p>

                                <p class="mb-2"><strong>Email:</strong>
                                    <span class="text-muted"><?= htmlspecialchars($item->email) ?></span>
                                </p>

                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

        <?php endif; ?>

    </div>
</div>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>