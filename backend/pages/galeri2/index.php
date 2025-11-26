<?php
// Koneksi database dan layout
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

// Cek kolom yang tersedia di tabel galeri
$checkColumns = mysqli_query($connect, "SHOW COLUMNS FROM galeri");
$columns = [];
while ($col = mysqli_fetch_assoc($checkColumns)) {
    $columns[] = $col['Field'];
}

// Gunakan created_at jika ada, kalau tidak urutkan berdasarkan id
$qGaleri = in_array('created_at', $columns)
    ? "SELECT * FROM galeri ORDER BY created_at DESC"
    : "SELECT * FROM galeri ORDER BY id DESC";

$result = mysqli_query($connect, $qGaleri) or die("Query error: " . mysqli_error($connect));

/**
 * Fungsi untuk membatasi jumlah kata
 */
function limit_words($text, $limit = 10)
{
    $words = explode(' ', strip_tags($text)); // hilangkan tag HTML lalu pecah jadi array
    if (count($words) > $limit) {
        return implode(' ', array_slice($words, 0, $limit)) . '...';
    } else {
        return implode(' ', $words);
    }
}
?>

<div class="body-wrapper">
    <div class="container-fluid">

        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>📸 Data Galeri</h5>
                <!-- <a href="./create.php" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Galeri
                </a> -->
            </div>

            <div class="card-body">
                <?php if (mysqli_num_rows($result) === 0): ?>
                    <div class="text-center p-5 text-muted">
                        <i class="bi bi-images fs-1"></i>
                        <p class="mt-3 mb-0">Belum ada galeri yang ditambahkan.</p>
                        <a href="./create.php" class="btn btn-outline-primary mt-3">
                            <i class="bi bi-plus-circle"></i> Tambah Sekarang
                        </a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 50px;">No</th>
                                    <th>Judul</th>
                                    <th>Gambar</th>
                                    <th>Deskripsi</th>
                                    <th>Kategori</th>
                                    <?php if (in_array('created_at', $columns)): ?>
                                        <th>Dibuat</th>
                                    <?php endif; ?>
                                    <th style="width: 160px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                while ($item = $result->fetch_object()): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($item->judul ?? '-') ?></td>
                                        <td>
                                            <?php if (!empty($item->gambar)): ?>
                                                <img src="../../../storages/galeri/<?= htmlspecialchars($item->gambar) ?>" width="70" class="rounded shadow-sm">
                                            <?php else: ?>
                                                <span class="text-muted">Tidak ada</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars(limit_words($item->deskripsi ?? '-', 3)) ?></td>
                                        <td><?= htmlspecialchars($item->kategori ?? '-') ?></td>
                                        <?php if (in_array('created_at', $columns)): ?>
                                            <td><?= htmlspecialchars($item->created_at ?? '-') ?></td>
                                        <?php endif; ?>
                                        <td>
                                            <a href="./detail.php?id=<?= $item->id ?>" class="btn btn-info btn-sm text-white">
                                                <i class="bi bi-eye"></i> Detail
                                            </a>
                                            <!-- <a href="./edit.php?id=<?= $item->id ?>" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a> -->
                                            <!-- <a href="../../actions/galeri/destroy.php?id=<?= $item->id ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Hapus data ini?')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </a> -->
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>