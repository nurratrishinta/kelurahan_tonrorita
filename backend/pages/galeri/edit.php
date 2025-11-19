<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

// Ambil ID dari parameter
$id = $_GET['id'] ?? 0;

// Ambil data lama
$qSelect = "SELECT * FROM galeri WHERE id = ?";
$stmt = mysqli_prepare($connect, $qSelect);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("<script>alert('Data tidak ditemukan!'); window.location.href='./index.php';</script>");
}

// Proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul']);
    $deskripsi = trim($_POST['deskripsi']);
    $kategori = $_POST['kategori'];
    $fileName = $_FILES['gambar']['name'] ?? '';

    $finalGambar = $data['gambar']; // pakai gambar lama dulu

    if ($fileName) {
        $dir = "../../../storages/galeri/";
        if (!is_dir($dir)) mkdir($dir, 0777, true);

        $newName = time() . "_" . basename($fileName);
        $path = $dir . $newName;
        move_uploaded_file($_FILES['gambar']['tmp_name'], $path);

        // hapus gambar lama
        if (!empty($data['gambar']) && file_exists($dir . $data['gambar'])) {
            unlink($dir . $data['gambar']);
        }

        $finalGambar = $newName;
    }

    // ✅ Tidak ada updated_at di tabel, jadi jangan dimasukkan
    $qUpdate = "UPDATE galeri SET judul=?, gambar=?, deskripsi=?, kategori=? WHERE id=?";
    $stmt = mysqli_prepare($connect, $qUpdate);
    mysqli_stmt_bind_param($stmt, "ssssi", $judul, $finalGambar, $deskripsi, $kategori, $id);
    mysqli_stmt_execute($stmt);

    echo "<script>alert('Data berhasil diperbarui!'); window.location.href='./index.php';</script>";
}
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Edit Galeri</h5>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($data['judul']) ?>" required>
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4" required><?= htmlspecialchars($data['deskripsi']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label>Kategori</label>
                    <select name="kategori" class="form-select" required>
                        <option value="kegiatan" <?= $data['kategori'] === 'kegiatan' ? 'selected' : '' ?>>Kegiatan</option>
                        <option value="fasilitas" <?= $data['kategori'] === 'fasilitas' ? 'selected' : '' ?>>Fasilitas</option>
                        <option value="umum" <?= $data['kategori'] === 'umum' ? 'selected' : '' ?>>Umum</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Gambar Sekarang:</label><br>
                    <?php if (!empty($data['gambar'])): ?>
                        <img src="../../../storages/galeri/<?= htmlspecialchars($data['gambar']) ?>" width="100" class="rounded mb-2">
                    <?php else: ?>
                        <p class="text-muted">Tidak ada gambar</p>
                    <?php endif; ?>
                    <input type="file" name="gambar" class="form-control">
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