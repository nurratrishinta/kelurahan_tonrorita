<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kategori = trim($_POST['kategori']);
    $judul = trim($_POST['judul']);
    $deskripsi = trim($_POST['deskripsi']);
    $fileName = $_FILES['gambar']['name'] ?? '';

    $finalGambar = '';
    if ($fileName) {
        $dir = "../../../storages/potensi_desa/";
        if (!is_dir($dir)) mkdir($dir, 0777, true);

        $newName = time() . "_" . basename($fileName);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $dir . $newName);
        $finalGambar = $newName;
    }

    $qInsert = "INSERT INTO potensi_desa (kategori, judul, deskripsi, gambar, created_at)
                VALUES (?, ?, ?, ?, NOW())";
    $stmt = mysqli_prepare($connect, $qInsert);
    mysqli_stmt_bind_param($stmt, "ssss", $kategori, $judul, $deskripsi, $finalGambar);
    mysqli_stmt_execute($stmt);

    echo "<script>alert('Potensi desa berhasil ditambahkan'); window.location.href='./index.php';</script>";
}
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Tambah Potensi Desa</h5>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>Kategori</label>
                    <input type="text" name="kategori" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="6" required></textarea>
                </div>

                <div class="mb-3">
                    <label>Gambar</label>
                    <input type="file" name="gambar" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="./index.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>