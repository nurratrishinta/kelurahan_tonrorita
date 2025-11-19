<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

$id = (int) $_GET['id'];
$q = "SELECT * FROM berita WHERE id=?";
$stmt = mysqli_prepare($connect, $q);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_object($res);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Detail Berita</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label>Judul</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($data->judul) ?>" disabled>
            </div>

            <div class="mb-3">
                <label>Isi Berita</label>
                <textarea class="form-control" rows="6" disabled><?= htmlspecialchars($data->isi) ?></textarea>
            </div>

            <div class="mb-3">
                <label>Penulis</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($data->penulis) ?>" disabled>
            </div>

            <div class="mb-3">
                <label>Tanggal</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($data->tanggal) ?>" disabled>
            </div>

            <div class="mb-3">
                <label>Kategori</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($data->kategori) ?>" disabled>
            </div>

            <div class="mb-3">
                <label>Gambar</label><br>
                <?php if ($data->gambar): ?>
                    <img src="../../../storages/berita/<?= $data->gambar ?>" class="rounded border" width="40%">
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