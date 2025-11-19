<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

// Ambil semua data struktur organisasi
$q = "
    SELECT s.*, p.nama AS atasan 
    FROM struktur_organisasi s
    LEFT JOIN struktur_organisasi p ON s.parent_id = p.id
    ORDER BY s.id DESC
";
$result = mysqli_query($connect, $q) or die(mysqli_error($connect));
?>

<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>👥 Struktur Organisasi</h5>
                <a href="./create.php" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Anggota
                </a>
            </div>

            <div class="card-body">
                <?php if (mysqli_num_rows($result) === 0): ?>
                    <div class="text-center p-5 text-muted">
                        <i class="bi bi-people fs-1"></i>
                        <p class="mt-3 mb-0">Belum ada data struktur organisasi.</p>
                        <a href="./create.php" class="btn btn-outline-primary mt-3">
                            <i class="bi bi-plus-circle"></i> Tambah Sekarang
                        </a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Atasan</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                while ($row = $result->fetch_object()): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($row->nama) ?></td>
                                        <td><?= htmlspecialchars($row->jabatan) ?></td>
                                        <td><?= htmlspecialchars($row->atasan ?? 'lurah') ?></td>
                                        <td>
                                            <?php if ($row->foto && file_exists("../../../storages/struktur_organisasi/$row->foto")): ?>
                                                <img src="../../../storages/struktur_organisasi/<?= $row->foto ?>" alt="foto" style="height:60px;border-radius:8px;">
                                            <?php else: ?>
                                                <span class="text-muted">Tidak ada</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="./detail.php?id=<?= $row->id ?>" class="btn btn-info btn-sm text-white">
                                                <i class="bi bi-eye"></i> Detail
                                            </a>
                                            <a href="./edit.php?id=<?= $row->id ?>" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <a href="../../actions/struktur_organisasi/destroy.php?id=<?= $row->id ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Hapus anggota ini?')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </a>
                                        </td>
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