<?php
// Koneksi database dan layout
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

// ===== QUERY DATA BERITA =====
$qBerita = "SELECT * FROM berita ORDER BY created_at DESC";
$result = mysqli_query($connect, $qBerita) or die("Query error: " . mysqli_error($connect));
?>

<!-- CSS untuk merapikan JUDUL agar tidak melebar -->
<style>
    .kolom-judul {
        white-space: normal !important;
        word-wrap: break-word;
        word-break: break-word;
        max-width: 350px;
        text-align: left !important;
    }
</style>

<!-- Content Wrapper -->
<div class="body-wrapper">
    <div class="container-fluid">

        <!-- Judul Halaman -->
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold mb-0"><i class="bi bi-newspaper"></i> Data Berita</h4>
                <div>
                    <a href="./create.php" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Tambah Berita
                    </a>
                    <a href="./print_berita.php" target="_blank" class="btn btn-success btn-sm">
                        <i class="bi bi-printer"></i> Print
                    </a>
                </div>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="card shadow-sm">
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
                        <table id="datatable" class="table table-bordered table-hover align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
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
                                while ($item = $result->fetch_object()):
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>

                                        <!-- Judul rapi, auto wrap + potong 10 kata -->
                                        <td class="kolom-judul">
                                            <?php
                                            $kata = explode(' ', $item->judul);
                                            $judulPendek = (count($kata) > 10)
                                                ? implode(' ', array_slice($kata, 0, 10)) . '...'
                                                : $item->judul;

                                            echo htmlspecialchars($judulPendek);
                                            ?>
                                        </td>

                                        <td>
                                            <?php if (!empty($item->gambar)): ?>
                                                <img src="../../../storages/berita/<?= htmlspecialchars($item->gambar) ?>" width="70" class="rounded shadow-sm">
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