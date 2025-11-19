<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_layanan = trim($_POST['nama_layanan']);
    $deskripsi = trim($_POST['deskripsi']);
    $syarat = trim($_POST['syarat']);
    $biaya = trim($_POST['biaya']);
    $waktu_proses = trim($_POST['waktu_proses']);

    $qInsert = "INSERT INTO layanan (nama_layanan, deskripsi, syarat, biaya, waktu_proses, created_at)
                VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = mysqli_prepare($connect, $qInsert);
    mysqli_stmt_bind_param($stmt, "sssss", $nama_layanan, $deskripsi, $syarat, $biaya, $waktu_proses);
    mysqli_stmt_execute($stmt);

    echo "<script>alert('Layanan berhasil ditambahkan'); window.location.href='./index.php';</script>";
}
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Tambah Layanan</h5>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label>Nama Layanan</label>
                    <input type="text" name="nama_layanan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                    <label>Syarat</label>
                    <textarea name="syarat" class="form-control" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                    <label>Biaya</label>
                    <input type="text" name="biaya" class="form-control" placeholder="Contoh: Gratis / Rp 10.000" required>
                </div>

                <div class="mb-3">
                    <label>Waktu Proses</label>
                    <input type="text" name="waktu_proses" class="form-control" placeholder="Contoh: 2 Hari Kerja" required>
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