<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

$id = $_GET['id'] ?? 0;

$qSelect = "SELECT * FROM sosial_media WHERE id = ?";
$stmt = mysqli_prepare($connect, $qSelect);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("<script>alert('Data tidak ditemukan!'); window.location.href='./index.php';</script>");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_platform = trim($_POST['nama_platform']);
    $link = trim($_POST['link']);
    $icon = trim($_POST['icon']);

    $qUpdate = "UPDATE sosial_media SET nama_platform=?, link=?, icon=? WHERE id=?";
    $stmt = mysqli_prepare($connect, $qUpdate);
    mysqli_stmt_bind_param($stmt, "sssi", $nama_platform, $link, $icon, $id);
    mysqli_stmt_execute($stmt);

    echo "<script>alert('Data berhasil diperbarui!'); window.location.href='./index.php';</script>";
}
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Edit Sosial Media</h5>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label>Nama Platform</label>
                    <input type="text" name="nama_platform" class="form-control" value="<?= htmlspecialchars($data['nama_platform']) ?>" required>
                </div>

                <div class="mb-3">
                    <label>Link</label>
                    <input type="url" name="link" class="form-control" value="<?= htmlspecialchars($data['link']) ?>" required>
                </div>

                <div class="mb-3">
                    <label>Icon (Bootstrap/Icon Class)</label>
                    <input type="text" name="icon" class="form-control" value="<?= htmlspecialchars($data['icon']) ?>" required>
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