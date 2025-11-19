<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

$id = $_GET['id'] ?? 0;
$qSelect = "SELECT * FROM berita WHERE id = ?";
$stmt = mysqli_prepare($connect, $qSelect);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("<script>alert('Berita tidak ditemukan!'); window.location.href='./index.php';</script>");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul']);
    $isi = trim($_POST['isi']);
    $penulis = trim($_POST['penulis']);
    $tanggal = $_POST['tanggal'];
    $kategori = $_POST['kategori'];
    $fileName = $_FILES['gambar']['name'] ?? '';

    $finalGambar = $data['gambar'];

    if ($fileName) {
        $dir = "../../../storages/berita/";
        if (!is_dir($dir)) mkdir($dir, 0777, true);

        $newName = time() . "_" . basename($fileName);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $dir . $newName);

        if (!empty($data['gambar']) && file_exists($dir . $data['gambar'])) {
            unlink($dir . $data['gambar']);
        }

        $finalGambar = $newName;
    }

    $qUpdate = "UPDATE berita SET judul=?, isi=?, gambar=?, penulis=?, tanggal=?, kategori=? WHERE id=?";
    $stmt = mysqli_prepare($connect, $qUpdate);
    mysqli_stmt_bind_param($stmt, "ssssssi", $judul, $isi, $finalGambar, $penulis, $tanggal, $kategori, $id);
    mysqli_stmt_execute($stmt);

    echo "<script>alert('Berita berhasil diperbarui!'); window.location.href='./index.php';</script>";
}
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Edit Berita</h5>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($data['judul']) ?>" required>
                </div>

                <div class="mb-3">
                    <label>Isi Berita</label>
                    <textarea name="isi" class="form-control" rows="6" required><?= htmlspecialchars($data['isi']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label>Penulis</label>
                    <input type="text" name="penulis" class="form-control" value="<?= htmlspecialchars($data['penulis']) ?>" required>
                </div>

                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="<?= htmlspecialchars($data['tanggal']) ?>" required>
                </div>

                <div class="mb-3">
                    <label>Kategori</label>
                    <select name="kategori" class="form-select" required>
                        <option value="umum" <?= $data['kategori'] === 'umum' ? 'selected' : '' ?>>Umum</option>
                        <option value="kegiatan" <?= $data['kategori'] === 'kegiatan' ? 'selected' : '' ?>>Kegiatan</option>
                        <option value="pengumuman" <?= $data['kategori'] === 'pengumuman' ? 'selected' : '' ?>>Pengumuman</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Gambar Saat Ini:</label><br>
                    <?php if ($data['gambar']): ?>
                        <img src="../../../storages/berita/<?= htmlspecialchars($data['gambar']) ?>" width="100" class="rounded mb-2">
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