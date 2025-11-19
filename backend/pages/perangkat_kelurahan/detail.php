<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

$id = (int) $_GET['id'];
$q = "SELECT * FROM perangkat_kelurahan WHERE id=?";
$stmt = mysqli_prepare($connect, $q);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_object($res);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Detail Perangkat Kelurahan</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($data->nama) ?>" disabled>
            </div>

            <div class="mb-3">
                <label>Jabatan</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($data->jabatan) ?>" disabled>
            </div>

            <div class="mb-3">
                <label>Foto</label><br>
                <?php if ($data->foto): ?>
                    <img src="../../../storages/perangkat_kelurahan/<?= htmlspecialchars($data->foto) ?>" class="rounded border" width="40%">
                <?php else: ?>
                    <p class="text-muted fst-italic">Tidak ada foto</p>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label>Keterangan</label>
                <textarea class="form-control" rows="5" disabled><?= htmlspecialchars($data->keterangan) ?></textarea>
            </div>

            <div class="mb-3">
                <label>Dibuat Pada</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($data->created_at) ?>" disabled>
            </div>

            <a href="./index.php" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>