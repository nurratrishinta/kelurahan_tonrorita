<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

$id = (int) $_GET['id'];
$q = "SELECT * FROM admin WHERE id=?";
$stmt = mysqli_prepare($connect, $q);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_object($res);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Detail Admin</h5>
        </div>
        <div class="card-body">
            <div class="mb-3 text-center">
                <?php if ($data->foto): ?>
                    <img src="../../../storages/admin/<?= $data->foto ?>" class="rounded-circle border shadow-sm" width="150">
                <?php else: ?>
                    <i class="bi bi-person-circle fs-1 text-secondary"></i>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label>Username</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($data->username) ?>" disabled>
            </div>

            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($data->nama_lengkap) ?>" disabled>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($data->email) ?>" disabled>
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