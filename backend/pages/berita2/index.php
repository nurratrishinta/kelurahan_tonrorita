<?php
// Koneksi database dan layout
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

// Ambil data berita terbaru
$qBerita = "SELECT * FROM berita ORDER BY created_at DESC";
$result = mysqli_query($connect, $qBerita) or die("Query error: " . mysqli_error($connect));
?>

<div class="body-wrapper">
    <div class="container-fluid">

        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>📰 Data Berita</h5>
                <!-- <a href="./create.php" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Berita
                </a> -->
            </div>

            <div class="card-body">
                <?php if (mysqli_num_rows($result) === 0): ?>
                    <div class="text-center p-5 text-muted">
                        <i class="bi bi-newspaper fs-1"></i>
                        <p class="mt-3 mb-0">Belum ada berita yang ditambahkan.</p>
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
                                    <th>Penulis</th>
                                    <th>Kategori</th>
                                    <th>Tanggal</th>
                                    <th>Dibuat</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;

                                // Fungsi pemotong judul 10 kata
                                function potongJudul($text, $limit = 10)
                                {
                                    $kata = explode(' ', trim($text));
                                    if (count($kata) <= $limit) {
                                        return $text;
                                    }
                                    return implode(' ', array_slice($kata, 0, $limit)) . '...';
                                }

                                while ($item = $result->fetch_object()): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>

                                        <!-- JUDUL MAKSIMAL 10 KATA -->
                                        <td style="max-width:300px; white-space:normal;">
                                            <?= htmlspecialchars(potongJudul($item->judul)) ?>
                                        </td>

                                        <td>
                                            <?php if (!empty($item->gambar)): ?>
                                                <img src="../../../storages/berita/<?= htmlspecialchars($item->gambar) ?>"
                                                    width="70" class="rounded shadow-sm">
                                            <?php else: ?>
                                                <span class="text-muted">Tidak ada</span>
                                            <?php endif; ?>
                                        </td>

                                        <td><?= htmlspecialchars($item->penulis) ?></td>
                                        <td><?= htmlspecialchars($item->kategori) ?></td>
                                        <td><?= htmlspecialchars($item->tanggal) ?></td>
                                        <td><?= htmlspecialchars($item->created_at) ?></td>

                                        
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