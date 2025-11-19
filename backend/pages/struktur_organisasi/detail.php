<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

$id = (int) $_GET['id'];
$q = "
  SELECT s.*, p.nama AS atasan
  FROM struktur_organisasi s
  LEFT JOIN struktur_organisasi p ON s.parent_id = p.id
  WHERE s.id = ?
";
$stmt = mysqli_prepare($connect, $q);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$data = mysqli_fetch_object(mysqli_stmt_get_result($stmt));
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Detail Anggota Struktur Organisasi</h5>
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
                <label>Atasan</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($data->atasan ?? '-') ?>" disabled>
            </div>

            <div class="mb-3">
                <label>Foto</label><br>
                <?php if ($data->foto && file_exists("../../../storages/struktur_organisasi/$data->foto")): ?>
                    <img src="../../../storages/struktur_organisasi/<?= $data->foto ?>" alt="foto" style="height:120px;border-radius:10px;">
                <?php else: ?>
                    <p class="text-muted">Tidak ada foto</p>
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