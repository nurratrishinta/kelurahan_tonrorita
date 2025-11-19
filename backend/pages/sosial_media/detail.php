<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

$id = (int) $_GET['id'];
$q = "SELECT * FROM sosial_media WHERE id=?";
$stmt = mysqli_prepare($connect, $q);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_object($res);

if (!$data) {
    die("<script>alert('Data tidak ditemukan!'); window.location.href='./index.php';</script>");
}
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Detail Sosial Media</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label>Nama Platform</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($data->nama_platform) ?>" disabled>
            </div>

            <div class="mb-3">
                <label>Link</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($data->link) ?>" disabled>
            </div>

            <div class="mb-3">
                <label>Icon</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($data->icon) ?>" disabled>
                <div class="mt-2"><i class="<?= htmlspecialchars($data->icon) ?> fs-3"></i></div>
            </div>

            <div class="mb-3">
                <label>Dibuat</label>
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