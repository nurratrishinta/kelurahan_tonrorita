<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

// Ambil data perangkat kelurahan terbaru
$qPerangkat = "SELECT * FROM perangkat_kelurahan ORDER BY created_at DESC";
$result = mysqli_query($connect, $qPerangkat) or die("Query error: " . mysqli_error($connect));
?>

<div class="body-wrapper">
    <div class="container-fluid">

        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>👥 Data Perangkat Kelurahan</h5>
                <a href="./create.php" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Perangkat
                </a>
            </div>

            <div class="card-body">
                <?php if (mysqli_num_rows($result) === 0): ?>
                    <div class="text-center p-5 text-muted">
                        <i class="bi bi-person-badge fs-1"></i>
                        <p class="mt-3 mb-0">Belum ada data perangkat kelurahan.</p>
                        <a href="./create.php" class="btn btn-outline-primary mt-3">
                            <i class="bi bi-plus-circle"></i> Tambah Sekarang
                        </a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 50px;">No</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Foto</th>
                                    <th>Dibuat</th>
                                    <th style="width: 160px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                while ($item = $result->fetch_object()): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($item->nama) ?></td>
                                        <td><?= htmlspecialchars($item->jabatan) ?></td>
                                        <td>
                                            <?php if (!empty($item->foto)): ?>
                                                <img src="../../../storages/perangkat_kelurahan/<?= htmlspecialchars($item->foto) ?>" width="70" class="rounded shadow-sm">
                                            <?php else: ?>
                                                <span class="text-muted">Tidak ada</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars($item->created_at) ?></td>
                                        <td>
                                            <a href="./detail.php?id=<?= $item->id ?>" class="btn btn-info btn-sm text-white">
                                                <i class="bi bi-eye"></i> Detail
                                            </a>
                                            <a href="./edit.php?id=<?= $item->id ?>" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <a href="../../actions/perangkat_kelurahan/destroy.php?id=<?= $item->id ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Hapus perangkat kelurahan ini?')">
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