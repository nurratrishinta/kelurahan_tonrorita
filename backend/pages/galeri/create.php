<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul']);
    $deskripsi = trim($_POST['deskripsi']);
    $kategori = $_POST['kategori'];
    $fileName = $_FILES['gambar']['name'] ?? '';

    $finalGambar = '';
    if ($fileName) {
        $dir = "../../../storages/galeri/";
        if (!is_dir($dir)) mkdir($dir, 0777, true);

        $newName = time() . "_" . basename($fileName);
        $path = $dir . $newName;
        move_uploaded_file($_FILES['gambar']['tmp_name'], $path);
        $finalGambar = $newName;
    }

    // ✅ Sesuai struktur tabel (tanpa updated_at)
    $qInsert = "INSERT INTO galeri (judul, gambar, deskripsi, kategori) 
                VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($connect, $qInsert);
    mysqli_stmt_bind_param($stmt, "ssss", $judul, $finalGambar, $deskripsi, $kategori);
    mysqli_stmt_execute($stmt);

    echo "<script>alert('Data berhasil ditambahkan'); window.location.href='./index.php';</script>";
}
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Tambah Galeri</h5>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                    <label>Kategori</label>
                    <select name="kategori" class="form-select" required>
                        <option value="kegiatan">Kegiatan</option>
                        <option value="fasilitas">Fasilitas</option>
                        <option value="umum">Umum</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Gambar</label>
                    <input type="file" name="gambar" class="form-control" required>
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