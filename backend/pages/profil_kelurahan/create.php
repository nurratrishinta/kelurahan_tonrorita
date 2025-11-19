<?php
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';
include '../../../config/connection.php';

// ==== PROSES SIMPAN DATA PROFIL KELURAHAN ====
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kelurahan = trim($_POST['nama_kelurahan']);
    $visi           = trim($_POST['visi']);
    $misi           = trim($_POST['misi']);
    $sejarah        = trim($_POST['sejarah']);
    $alamat         = trim($_POST['alamat']);
    $telepon        = trim($_POST['telepon']);
    $email          = trim($_POST['email']);

    // === Proses upload logo ===
    $fileName = $_FILES['logo']['name'] ?? '';
    $finalLogo = '';

    if ($fileName) {
        $targetDir = "../../../storages/logo/";
        $newName = time() . "_" . basename($fileName);
        $targetPath = $targetDir . $newName;

        $fileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($fileType, $allowed)) {
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            if (move_uploaded_file($_FILES['logo']['tmp_name'], $targetPath)) {
                $finalLogo = $newName;
            } else {
                echo "<script>alert('Gagal mengupload file logo');</script>";
            }
        } else {
            echo "<script>alert('Format gambar tidak didukung! Hanya JPG, PNG, GIF, WEBP');</script>";
        }
    }

    // === Simpan ke tabel profil_kelurahan ===
    $qInsert = "
        INSERT INTO profil_kelurahan 
        (nama_kelurahan, visi, misi, sejarah, alamat, telepon, email, logo, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
    ";

    $stmt = mysqli_prepare($connect, $qInsert);
    mysqli_stmt_bind_param(
        $stmt,
        "ssssssss",
        $nama_kelurahan,
        $visi,
        $misi,
        $sejarah,
        $alamat,
        $telepon,
        $email,
        $finalLogo
    );

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Data profil kelurahan berhasil ditambahkan'); window.location.href='./index.php';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal menambahkan data: " . mysqli_error($connect) . "');</script>";
    }
}
?>

<!-- CONTENT -->
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5>Tambah Data Profil Kelurahan</h5>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="namaKelurahan" class="form-label">Nama Kelurahan</label>
                        <input type="text" name="nama_kelurahan" class="form-control" id="namaKelurahan"
                            placeholder="Masukkan nama kelurahan..." required>
                    </div>

                    <div class="mb-3">
                        <label for="visiInput" class="form-label">Visi</label>
                        <textarea name="visi" id="visiInput" class="form-control" rows="3"
                            placeholder="Masukkan visi kelurahan..." required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="misiInput" class="form-label">Misi</label>
                        <textarea name="misi" id="misiInput" class="form-control" rows="3"
                            placeholder="Masukkan misi kelurahan..." required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="sejarahInput" class="form-label">Sejarah</label>
                        <textarea name="sejarah" id="sejarahInput" class="form-control" rows="4"
                            placeholder="Masukkan sejarah kelurahan..." required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="alamatInput" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamatInput" class="form-control" rows="2"
                            placeholder="Masukkan alamat lengkap..." required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="teleponInput" class="form-label">Telepon</label>
                        <input type="text" name="telepon" class="form-control" id="teleponInput"
                            placeholder="Masukkan nomor telepon..." required>
                    </div>

                    <div class="mb-3">
                        <label for="emailInput" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="emailInput"
                            placeholder="Masukkan alamat email..." required>
                    </div>

                    <div class="mb-3">
                        <label for="logoInput" class="form-label">Logo Kelurahan</label>
                        <input type="file" name="logo" class="form-control" id="logoInput" accept="image/*" required>
                        <small class="text-muted">Format yang diizinkan: JPG, JPEG, PNG, GIF, WEBP</small>
                    </div>

                    <button type="submit" class="btn btn-success" name="tombol">Tambah</button>
                    <a href="./index.php" class="btn btn-primary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>