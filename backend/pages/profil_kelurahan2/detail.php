<?php
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

// koneksi database
include '../../../config/connection.php';

// === Ambil data berdasarkan ID ===
if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan'); window.location.href='./index.php';</script>";
    exit;
}

$id = (int) $_GET['id'];

// Ambil data dari tabel profil_kelurahan
$query = "SELECT * FROM profil_kelurahan WHERE id = ?";
$stmt = mysqli_prepare($connect, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Cek data
if (mysqli_num_rows($result) === 0) {
    echo "<script>alert('Data tidak ditemukan'); window.location.href='./index.php';</script>";
    exit;
}

$kelurahan = mysqli_fetch_object($result);
?>

<!-- content -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>Detail Data Profil Kelurahan</h5>
            </div>
            <div class="card-body">
                <form method="POST">

                    <div class="mb-3">
                        <label for="namaKelurahanInput" class="form-label">Nama Kelurahan</label>
                        <input type="text" id="namaKelurahanInput" class="form-control"
                            value="<?= htmlspecialchars($kelurahan->nama_kelurahan) ?>" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="visiInput" class="form-label">Visi</label>
                        <textarea id="visiInput" class="form-control" rows="3"
                            disabled><?= htmlspecialchars($kelurahan->visi) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="misiInput" class="form-label">Misi</label>
                        <textarea id="misiInput" class="form-control" rows="3"
                            disabled><?= htmlspecialchars($kelurahan->misi) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="sejarahInput" class="form-label">Sejarah</label>
                        <textarea id="sejarahInput" class="form-control" rows="4"
                            disabled><?= htmlspecialchars($kelurahan->sejarah) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="alamatInput" class="form-label">Alamat</label>
                        <textarea id="alamatInput" class="form-control" rows="2"
                            disabled><?= htmlspecialchars($kelurahan->alamat) ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="teleponInput" class="form-label">Telepon</label>
                            <input type="text" id="teleponInput" class="form-control"
                                value="<?= htmlspecialchars($kelurahan->telepon) ?>" disabled>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="emailInput" class="form-label">Email</label>
                            <input type="text" id="emailInput" class="form-control"
                                value="<?= htmlspecialchars($kelurahan->email) ?>" disabled>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h6>Logo Kelurahan</h6>
                        <?php if (!empty($kelurahan->logo)) : ?>
                            <img class="w-25 rounded border p-1"
                                src="../../../storages/logo/<?= htmlspecialchars($kelurahan->logo) ?>"
                                alt="Logo Kelurahan">
                        <?php else : ?>
                            <p class="text-muted fst-italic">Tidak ada logo</p>
                        <?php endif; ?>
                    </div>

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