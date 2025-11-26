<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

$id = (int) $_GET['id'];
$q = "SELECT * FROM galeri WHERE id=?";
$stmt = mysqli_prepare($connect, $q);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_object($res);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Detail Galeri</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label>Judul</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($data->judul) ?>" disabled>
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea class="form-control" rows="4" disabled><?= htmlspecialchars($data->deskripsi) ?></textarea>
            </div>

            <div class="mb-3">
                <label>Kategori</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($data->kategori) ?>" disabled>
            </div>

            <div class="mb-3">
                <label>Gambar</label><br>
                <?php if ($data->gambar): ?>
                    <img src="../../../storages/galeri/<?= $data->gambar ?>" class="rounded border" width="40%">
                <?php else: ?>
                    <p class="text-muted fst-italic">Tidak ada gambar</p>
                <?php endif; ?>
            </div>

            <a href="./index.php" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>
<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>