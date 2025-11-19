<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

$id = (int) $_GET['id'];
$q = "SELECT * FROM layanan WHERE id=?";
$stmt = mysqli_prepare($connect, $q);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_object($res);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Detail Layanan</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label>Nama Layanan</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($data->nama_layanan) ?>" disabled>
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea class="form-control" rows="4" disabled><?= htmlspecialchars($data->deskripsi) ?></textarea>
            </div>

            <div class="mb-3">
                <label>Syarat</label>
                <textarea class="form-control" rows="4" disabled><?= htmlspecialchars($data->syarat) ?></textarea>
            </div>

            <div class="mb-3">
                <label>Biaya</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($data->biaya) ?>" disabled>
            </div>

            <div class="mb-3">
                <label>Waktu Proses</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($data->waktu_proses) ?>" disabled>
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