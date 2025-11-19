<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

$id = $_GET['id'] ?? 0;
$qSelect = "SELECT * FROM layanan WHERE id = ?";
$stmt = mysqli_prepare($connect, $qSelect);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("<script>alert('Data layanan tidak ditemukan!'); window.location.href='./index.php';</script>");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_layanan = trim($_POST['nama_layanan']);
    $deskripsi = trim($_POST['deskripsi']);
    $syarat = trim($_POST['syarat']);
    $biaya = trim($_POST['biaya']);
    $waktu_proses = trim($_POST['waktu_proses']);

    $qUpdate = "UPDATE layanan SET nama_layanan=?, deskripsi=?, syarat=?, biaya=?, waktu_proses=? WHERE id=?";
    $stmt = mysqli_prepare($connect, $qUpdate);
    mysqli_stmt_bind_param($stmt, "sssssi", $nama_layanan, $deskripsi, $syarat, $biaya, $waktu_proses, $id);
    mysqli_stmt_execute($stmt);

    echo "<script>alert('Layanan berhasil diperbarui!'); window.location.href='./index.php';</script>";
}
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Edit Layanan</h5>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label>Nama Layanan</label>
                    <input type="text" name="nama_layanan" class="form-control" value="<?= htmlspecialchars($data['nama_layanan']) ?>" required>
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4" required><?= htmlspecialchars($data['deskripsi']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label>Syarat</label>
                    <textarea name="syarat" class="form-control" rows="4" required><?= htmlspecialchars($data['syarat']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label>Biaya</label>
                    <input type="text" name="biaya" class="form-control" value="<?= htmlspecialchars($data['biaya']) ?>" required>
                </div>

                <div class="mb-3">
                    <label>Waktu Proses</label>
                    <input type="text" name="waktu_proses" class="form-control" value="<?= htmlspecialchars($data['waktu_proses']) ?>" required>
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