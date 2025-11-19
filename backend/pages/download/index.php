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
                    <!-- <a href="./create.php" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Tambah Profil
                    </a> -->
                    <a href="./download_profil.php" target="_blank" class="btn btn-success btn-sm">
                        <i class="bi bi-download"></i> Download
                    </a>
                </div>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="card shadow-sm">
            <div class="card-body">
                <?php if (mysqli_num_rows($result) === 0): ?>
                    <div class="text-center p-5 text-muted">
                        <i class="bi bi-building fs-1"></i>
                        <p class="mt-3 mb-0">Belum ada profil kelurahan yang ditambahkan.</p>
                        <a href="./create.php" class="btn btn-outline-primary mt-3">
                            <i class="bi bi-plus-circle"></i> Tambah Sekarang
                        </a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-hover align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kelurahan</th>
                                    <th>Visi</th>
                                    <th>Misi</th>
                                    <th>Sejarah</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Email</th>
                                    <th>Logo</th>
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
                                        <td><?= htmlspecialchars($item->nama_kelurahan) ?></td>
                                        <td style="max-width: 180px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                            <?= htmlspecialchars(substr($item->visi, 0, 50)) ?>...
                                        </td>
                                        <td style="max-width: 180px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                            <?= htmlspecialchars(substr($item->misi, 0, 50)) ?>...
                                        </td>
                                        <td style="max-width: 180px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                            <?= htmlspecialchars(substr($item->sejarah, 0, 50)) ?>...
                                        </td>
                                        <td><?= htmlspecialchars($item->alamat) ?></td>
                                        <td><?= htmlspecialchars($item->telepon) ?></td>
                                        <td><?= htmlspecialchars($item->email) ?></td>
                                        <td>
                                            <?php if (!empty($item->logo)): ?>
                                                <img src="../../../storages/logo/<?= htmlspecialchars($item->logo) ?>" width="60" height="60"
                                                    style="object-fit: cover; border-radius: 50%;">
                                            <?php else: ?>
                                                <span class="text-muted">Tidak ada logo</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars($item->created_at) ?></td>
                                        
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>