<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

// Ambil semua data kontak terbaru
$qKontak = "SELECT * FROM kontak ORDER BY created_at DESC";
$result = mysqli_query($connect, $qKontak) or die("Query error: " . mysqli_error($connect));
?>

<div class="body-wrapper">
    <div class="container-fluid">

        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5> Data Kontak Masuk</h5>
                <a href="./create.php" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Kontak
                </a>
            </div>

            <div class="card-body">
                <?php if (mysqli_num_rows($result) === 0): ?>
                    <div class="text-center p-5 text-muted">
                        <i class="bi bi-envelope fs-1"></i>
                        <p class="mt-3 mb-0">Belum ada pesan yang masuk.</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:50px;">No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No HP</th>
                                    <th>Status</th>
                                    <th>Dikirim Pada</th>
                                    <th style="width:160px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                while ($row = $result->fetch_object()): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($row->nama) ?></td>
                                        <td><?= htmlspecialchars($row->email) ?></td>
                                        <td><?= htmlspecialchars($row->no_hp) ?></td>
                                        <td>
                                            <?php if ($row->status === 'belum_dibaca'): ?>
                                                <span class="badge bg-danger">Belum Dibaca</span>
                                            <?php else: ?>
                                                <span class="badge bg-success">Dibalas</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars($row->created_at) ?></td>
                                        <td>
                                            <a href="./detail.php?id=<?= $row->id ?>" class="btn btn-info btn-sm text-white">
                                                <i class="bi bi-eye"></i> Detail
                                            </a>
                                            <a href="./edit.php?id=<?= $row->id ?>" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <a href="../../actions/kontak/destroy.php?id=<?= $row->id ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Hapus kontak ini?')">
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