<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_platform = trim($_POST['nama_platform']);
    $link = trim($_POST['link']);
    $icon = trim($_POST['icon']);

    $qInsert = "INSERT INTO sosial_media (nama_platform, link, icon, created_at)
                VALUES (?, ?, ?, NOW())";
    $stmt = mysqli_prepare($connect, $qInsert);
    mysqli_stmt_bind_param($stmt, "sss", $nama_platform, $link, $icon);
    mysqli_stmt_execute($stmt);

    echo "<script>alert('Data berhasil ditambahkan'); window.location.href='./index.php';</script>";
}
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Tambah Sosial Media</h5>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label>Nama Platform</label>
                    <input type="text" name="nama_platform" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Link</label>
                    <input type="url" name="link" class="form-control" placeholder="https://example.com" required>
                </div>

                <div class="mb-3">
                    <label>Icon (Bootstrap/Icon Class)</label>
                    <input type="text" name="icon" class="form-control" placeholder="bi bi-facebook" required>
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