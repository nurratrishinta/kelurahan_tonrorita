<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

$id = $_GET['id'] ?? 0;
$qSelect = "SELECT * FROM admin WHERE id = ?";
$stmt = mysqli_prepare($connect, $qSelect);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("<script>alert('Admin tidak ditemukan!'); window.location.href='./index.php';</script>");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $nama_lengkap = trim($_POST['nama_lengkap']);
    $email = trim($_POST['email']);
    $fileName = $_FILES['foto']['name'] ?? '';

    $finalFoto = $data['foto'];
    if ($fileName) {
        $dir = "../../../storages/admin/";
        if (!is_dir($dir)) mkdir($dir, 0777, true);
        $newName = time() . "_" . basename($fileName);
        move_uploaded_file($_FILES['foto']['tmp_name'], $dir . $newName);

        if (!empty($data['foto']) && file_exists($dir . $data['foto'])) {
            unlink($dir . $data['foto']);
        }
        $finalFoto = $newName;
    }

    // Jika password diisi, update juga
    if (!empty($_POST['password'])) {
        $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $qUpdate = "UPDATE admin SET username=?, password=?, nama_lengkap=?, email=?, foto=? WHERE id=?";
        $stmt = mysqli_prepare($connect, $qUpdate);
        mysqli_stmt_bind_param($stmt, "sssssi", $username, $newPassword, $nama_lengkap, $email, $finalFoto, $id);
    } else {
        $qUpdate = "UPDATE admin SET username=?, nama_lengkap=?, email=?, foto=? WHERE id=?";
        $stmt = mysqli_prepare($connect, $qUpdate);
        mysqli_stmt_bind_param($stmt, "ssssi", $username, $nama_lengkap, $email, $finalFoto, $id);
    }

    mysqli_stmt_execute($stmt);
    echo "<script>alert('Data admin berhasil diperbarui!'); window.location.href='./index.php';</script>";
}
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Edit Admin</h5>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($data['username']) ?>" required>
                </div>

                <div class="mb-3">
                    <label>Password (kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="<?= htmlspecialchars($data['nama_lengkap']) ?>" required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($data['email']) ?>" required>
                </div>

                <div class="mb-3">
                    <label>Foto Sekarang:</label><br>
                    <?php if ($data['foto']): ?>
                        <img src="../../../storages/admin/<?= htmlspecialchars($data['foto']) ?>" width="100" class="rounded mb-2">
                    <?php else: ?>
                        <p class="text-muted">Tidak ada foto</p>
                    <?php endif; ?>
                    <input type="file" name="foto" class="form-control">
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