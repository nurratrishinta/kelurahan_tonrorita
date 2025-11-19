<?php
// Koneksi dan layout
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

// Ambil semua data admin
$qAdmin = "SELECT * FROM admin ORDER BY created_at DESC";
$result = mysqli_query($connect, $qAdmin) or die("Query error: " . mysqli_error($connect));
?>

<div class="body-wrapper">
    <div class="container-fluid">

        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>👤 Data Admin</h5>
                <a href="./create.php" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Admin
                </a>
            </div>

            <div class="card-body">
                <?php if (mysqli_num_rows($result) === 0): ?>
                    <div class="text-center p-5 text-muted">
                        <i class="bi bi-people fs-1"></i>
                        <p class="mt-3 mb-0">Belum ada admin yang ditambahkan.</p>
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
                                    <th>Foto</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Dibuat</th>
                                    <th style="width: 160px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                while ($item = $result->fetch_object()): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <?php if (!empty($item->foto)): ?>
                                                <img src="../../../storages/admin/<?= htmlspecialchars($item->foto) ?>" width="60" class="rounded-circle shadow-sm">
                                            <?php else: ?>
                                                <span class="text-muted">Tidak ada</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars($item->username) ?></td>
                                        <td class="text-center">******</td>
                                        <td><?= htmlspecialchars($item->nama_lengkap) ?></td>
                                        <td><?= htmlspecialchars($item->email) ?></td>
                                        <td><?= htmlspecialchars($item->created_at) ?></td>
                                        <td>
                                           
                                            <a href="./edit.php?id=<?= $item->id ?>" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <a href="../../actions/admin/destroy.php?id=<?= $item->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus admin ini?')">
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