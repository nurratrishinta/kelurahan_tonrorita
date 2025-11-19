<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

$id = $_GET['id'] ?? 0;
$qSelect = "SELECT * FROM kontak WHERE id=?";
$stmt = mysqli_prepare($connect, $qSelect);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("<script>alert('Data kontak tidak ditemukan!'); window.location.href='./index.php';</script>");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $no_hp = trim($_POST['no_hp']);
    $pesan = trim($_POST['pesan']);
    $status = $_POST['status'];

    $qUpdate = "UPDATE kontak SET nama=?, email=?, no_hp=?, pesan=?, status=? WHERE id=?";
    $stmt = mysqli_prepare($connect, $qUpdate);
    mysqli_stmt_bind_param($stmt, "sssssi", $nama, $email, $no_hp, $pesan, $status, $id);
    mysqli_stmt_execute($stmt);

    echo "<script>alert('Data kontak berhasil diperbarui!'); window.location.href='./index.php';</script>";
}
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Edit Kontak</h5>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama']) ?>" required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($data['email']) ?>" required>
                </div>

                <div class="mb-3">
                    <label>No HP</label>
                    <input type="text" name="no_hp" class="form-control" value="<?= htmlspecialchars($data['no_hp']) ?>" required>
                </div>

                <div class="mb-3">
                    <label>Pesan</label>
                    <textarea name="pesan" class="form-control" rows="6" required><?= htmlspecialchars($data['pesan']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="belum_dibaca" <?= $data['status'] == 'belum_dibaca' ? 'selected' : '' ?>>Belum Dibaca</option>
                        <option value="dibalas" <?= $data['status'] == 'dibalas' ? 'selected' : '' ?>>Dibalas</option>
                    </select>
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