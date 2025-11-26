<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul']);
    $isi = trim($_POST['isi']);
    $penulis = trim($_POST['penulis']);
    $tanggal = $_POST['tanggal'];
    $kategori = $_POST['kategori'];
    $fileName = $_FILES['gambar']['name'] ?? '';

    $finalGambar = '';
    if ($fileName) {
        $dir = "../../../storages/berita/";
        if (!is_dir($dir)) mkdir($dir, 0777, true);

        $newName = time() . "_" . basename($fileName);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $dir . $newName);
        $finalGambar = $newName;
    }

    $qInsert = "INSERT INTO berita (judul, isi, gambar, penulis, tanggal, kategori)
                VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connect, $qInsert);
    mysqli_stmt_bind_param($stmt, "ssssss", $judul, $isi, $finalGambar, $penulis, $tanggal, $kategori);
    mysqli_stmt_execute($stmt);

    echo "<script>alert('Berita berhasil ditambahkan'); window.location.href='./index.php';</script>";
}
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Tambah Berita</h5>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Isi Berita</label>
                    <textarea name="isi" class="form-control" rows="6" required></textarea>
                </div>

                <div class="mb-3">
                    <label>Penulis</label>
                    <input type="text" name="penulis" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Kategori</label>
                    <select name="kategori" class="form-select" required>
                        <option value="umum">Umum</option>
                        <option value="kegiatan">Kegiatan</option>
                        <option value="pengumuman">Pengumuman</option>
                    </select>
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