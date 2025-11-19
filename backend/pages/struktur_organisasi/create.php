<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

// Ambil daftar parent
$parents = mysqli_query($connect, "SELECT id, nama FROM struktur_organisasi ORDER BY nama ASC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $jabatan = trim($_POST['jabatan']);
    $parent_id = $_POST['parent_id'] ?: null;
    $foto = '';

    // Upload foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $dir = "../../../storages/struktur_organisasi/";
        if (!is_dir($dir)) mkdir($dir, 0777, true);

        $foto = time() . "_" . basename($_FILES['foto']['name']);
        move_uploaded_file($_FILES['foto']['tmp_name'], $dir . $foto);
    }

    $stmt = mysqli_prepare($connect, "INSERT INTO struktur_organisasi (nama, jabatan, foto, parent_id) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssi", $nama, $jabatan, $foto, $parent_id);
    mysqli_stmt_execute($stmt);

    echo "<script>alert('Anggota berhasil ditambahkan!'); window.location.href='./index.php';</script>";
}
?>

<div class="container-fluid">
  <div class="card">
    <div class="card-header">
      <h5>Tambah Anggota Struktur Organisasi</h5>
    </div>
    <div class="card-body">
      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label>Nama</label>
          <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
          <label>Jabatan</label>
          <input type="text" name="jabatan" class="form-control" required>
        </div>

        <div class="mb-3">
          <label>Atasan (Parent)</label>
          <select name="parent_id" class="form-control">
            <option value="">-- Tidak Ada Atasan --</option>
            <?php while ($p = $parents->fetch_object()): ?>
              <option value="<?= $p->id ?>"><?= htmlspecialchars($p->nama) ?></option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="mb-3">
          <label>Foto</label>
          <input type="file" name="foto" class="form-control" accept="image/*">
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
