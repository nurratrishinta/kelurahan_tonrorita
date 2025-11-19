<?php
// koneksi database dan layout
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

// cek id
if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan'); window.location.href='./index.php';</script>";
    exit;
}

$id = (int) $_GET['id'];

// ambil data berdasarkan id
$qSelect = "SELECT 
                id,
                nama_kelurahan,
                visi,
                misi,
                sejarah,
                alamat,
                telepon,
                email,
                logo
            FROM profil_kelurahan
            WHERE id = ?
            LIMIT 1";

$stmt = mysqli_prepare($connect, $qSelect);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

if (!$res || mysqli_num_rows($res) === 0) {
    echo "<script>alert('Data tidak ditemukan'); window.location.href='./index.php';</script>";
    exit;
}

$data = mysqli_fetch_assoc($res);

// proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kelurahan = trim($_POST['nama_kelurahan']);
    $visi           = trim($_POST['visi']);
    $misi           = trim($_POST['misi']);
    $sejarah        = trim($_POST['sejarah']);
    $alamat         = trim($_POST['alamat']);
    $telepon        = trim($_POST['telepon']);
    $email          = trim($_POST['email']);
    $logoLama       = $_POST['logo_lama'];
    $finalLogo      = $logoLama;

    // === Upload Logo Baru ===
    if (!empty($_FILES['logo']['name'])) {
        $targetDir = "../../../storages/logo/";
        $fileName = time() . "_" . basename($_FILES['logo']['name']);
        $targetFilePath = $targetDir . $fileName;

        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($fileType, $allowed)) {
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            if (move_uploaded_file($_FILES['logo']['tmp_name'], $targetFilePath)) {
                // hapus file lama jika ada
                if (!empty($logoLama) && file_exists($targetDir . $logoLama)) {
                    unlink($targetDir . $logoLama);
                }
                $finalLogo = $fileName;
            } else {
                echo "<script>alert('Gagal mengunggah file logo baru!');</script>";
            }
        } else {
            echo "<script>alert('Format logo tidak didukung! Hanya JPG, JPEG, PNG, GIF, WEBP.');</script>";
        }
    }

    // === Query Update ===
    $qUpdate = "UPDATE profil_kelurahan 
                SET nama_kelurahan = ?, visi = ?, misi = ?, sejarah = ?, alamat = ?, telepon = ?, email = ?, logo = ?, updated_at = NOW()
                WHERE id = ?";

    $stmtUpd = mysqli_prepare($connect, $qUpdate);
    mysqli_stmt_bind_param(
        $stmtUpd,
        "ssssssssi",
        $nama_kelurahan,
        $visi,
        $misi,
        $sejarah,
        $alamat,
        $telepon,
        $email,
        $finalLogo,
        $id
    );

    if (mysqli_stmt_execute($stmtUpd)) {
        echo "<script>alert('Data profil kelurahan berhasil diperbarui'); window.location.href='./index.php';</script>";
        exit;
    } else {
        echo "Error update: " . mysqli_error($connect);
    }
}
?>

<!-- Content -->
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Profil Kelurahan</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="nama_kelurahan" class="form-label">Nama Kelurahan</label>
                                <input type="text" name="nama_kelurahan" id="nama_kelurahan" class="form-control"
                                    value="<?= htmlspecialchars($data['nama_kelurahan']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="visi" class="form-label">Visi</label>
                                <textarea name="visi" id="visi" class="form-control" rows="3" required><?= htmlspecialchars($data['visi']) ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="misi" class="form-label">Misi</label>
                                <textarea name="misi" id="misi" class="form-control" rows="3" required><?= htmlspecialchars($data['misi']) ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="sejarah" class="form-label">Sejarah</label>
                                <textarea name="sejarah" id="sejarah" class="form-control" rows="4" required><?= htmlspecialchars($data['sejarah']) ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control" rows="2" required><?= htmlspecialchars($data['alamat']) ?></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="telepon" class="form-label">Telepon</label>
                                    <input type="text" name="telepon" id="telepon" class="form-control"
                                        value="<?= htmlspecialchars($data['telepon']) ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        value="<?= htmlspecialchars($data['email']) ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="logo" class="form-label">Logo Kelurahan</label><br>
                                <?php if (!empty($data['logo'])): ?>
                                    <img src="../../../storages/logo/<?= htmlspecialchars($data['logo']) ?>" width="100" class="mb-2" style="border-radius:5px;"><br>
                                <?php endif; ?>
                                <input type="file" name="logo" id="logo" class="form-control" accept="image/*">
                                <input type="hidden" name="logo_lama" value="<?= htmlspecialchars($data['logo']) ?>">
                            </div>

                            <button type="submit" name="submit" class="btn btn-success">Update</button>
                            <a href="./index.php" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>