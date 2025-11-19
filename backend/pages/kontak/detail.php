<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

$id = (int) $_GET['id'];
$q = "SELECT * FROM kontak WHERE id=?";
$stmt = mysqli_prepare($connect, $q);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_object($res);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Detail Kontak</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($data->nama) ?>" disabled>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($data->email) ?>" disabled>
            </div>

            <div class="mb-3">
                <label>No HP</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($data->no_hp) ?>" disabled>
            </div>

            <div class="mb-3">
                <label>Pesan</label>
                <textarea class="form-control" rows="6" disabled><?= htmlspecialchars($data->pesan) ?></textarea>
            </div>

            <div class="mb-3">
                <label>Status</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($data->status) ?>" disabled>
            </div>

            <div class="mb-3">
                <label>Dikirim Pada</label>
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