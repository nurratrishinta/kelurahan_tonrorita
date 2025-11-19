<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

$id = (int) $_GET['id'];
$q = "SELECT * FROM struktur_organisasi WHERE id=?";
$stmt = mysqli_prepare($connect, $q);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$data = mysqli_fetch_object(mysqli_stmt_get_result($stmt));

if (!$data) die("<script>alert('Data tidak ditemukan!'); window.location.href='./index.php';</script>");

$parents = mysqli_query($connect, "SELECT id, nama FROM struktur_organisasi WHERE id != $id ORDER BY nama ASC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $jabatan = trim($_POST['jabatan']);
    $parent_id = $_POST['parent_id'] ?: null;
    $foto = $data->foto;

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $dir = "../../../storages/struktur_organisasi/";
        if (!is_dir($dir)) mkdir($dir, 0777, true);

        if ($foto && file_exists($dir . $foto)) unlink($dir . $foto);
        $foto = time() . "_" . basename($_FILES['foto']['name']);
        move_uploaded_file($_FILES['foto']['tmp_name'], $dir . $foto);
    }

    $stmt = mysqli_prepare($connect, "UPDATE struktur_organisasi SET nama=?, jabatan=?, foto=?, parent_id=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "sssii", $nama, $jabatan, $foto, $parent_id, $id);
    mysqli_stmt_execute($stmt);

    echo "<script>alert('Data berhasil diperbarui!'); window.location.href='./index.php';</script>";
}
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Edit Anggota Struktur Organisasi</h5>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data->nama) ?>" required>
                </div>

                <div class="mb-3">
                    <label>Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" value="<?= htmlspecialchars($data->jabatan) ?>" required>
                </div>

                <div class="mb-3">
                    <label>Atasan (Parent)</label>
                    <select name="parent_id" class="form-control">
                        <option value="">-- Tidak Ada Atasan --</option>
                        <?php while ($p = $parents->fetch_object()): ?>
                            <option value="<?= $p->id ?>" <?= $p->id == $data->parent_id ? 'selected' : '' ?>>
                                <?= htmlspecialchars($p->nama) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Foto Sekarang</label><br>
                    <?php if ($data->foto && file_exists("../../../storages/struktur_organisasi/$data->foto")): ?>
                        <img src="../../../storages/struktur_organisasi/<?= $data->foto ?>" style="height:80px;border-radius:8px;">
                    <?php else: ?>
                        <span class="text-muted">Tidak ada foto</span>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label>Ganti Foto</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="./index.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>