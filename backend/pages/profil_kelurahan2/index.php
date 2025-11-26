<?php
// koneksi database
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

// ✅ QUERY AMBIL DATA PROFIL KELURAHAN
$qProfil = "
    SELECT 
        id,
        nama_kelurahan,
        visi,
        misi,
        sejarah,
        alamat,
        telepon,
        email,
        logo,
        created_at,
        updated_at
    FROM profil_kelurahan
";

$result = mysqli_query($connect, $qProfil) or die("Query error: " . mysqli_error($connect));
?>

<!-- Content Wrapper -->
<div class="body-wrapper">
    <div class="container-fluid">

        <!-- Tabel Profil Kelurahan -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5>Profil Kelurahan</h5>
                        <!-- <a href="./create.php" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah
                        </a> -->
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kelurahan</th>
                                        <th>Visi</th>
                                        <th>Misi</th>
                                        <th>Sejarah</th>
                                        <th>Alamat</th>
                                        <th>Telepon</th>
                                        <th>Email</th>
                                        <th>Logo</th>
                                        <th>Dibuat</th>
                                        <th>Diperbarui</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $no = 1;
                                    while ($item = $result->fetch_object()):
                                    ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= htmlspecialchars($item->nama_kelurahan) ?></td>
                                            <td style="max-width: 180px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                <?= htmlspecialchars(substr($item->visi, 0, 50)) ?>...
                                            </td>
                                            <td style="max-width: 180px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                <?= htmlspecialchars(substr($item->misi, 0, 50)) ?>...
                                            </td>
                                            <td style="max-width: 180px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                <?= htmlspecialchars(substr($item->sejarah, 0, 50)) ?>...
                                            </td>
                                            <td style="max-width: 180px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                <?php
                                                $alamat_kata = explode(' ', $item->alamat);
                                                if (count($alamat_kata) > 20) {
                                                    echo htmlspecialchars(implode(' ', array_slice($alamat_kata, 0, 20))) . '...';
                                                } else {
                                                    echo htmlspecialchars($item->alamat);
                                                }
                                                ?>
                                            </td>

                                            <td><?= htmlspecialchars($item->telepon) ?></td>
                                            <td><?= htmlspecialchars($item->email) ?></td>
                                            <td>
                                                <?php if (!empty($item->logo)): ?>
                                                    <img src="../../../storages/logo/<?= htmlspecialchars($item->logo) ?>"
                                                        width="60" height="60"
                                                        style="object-fit: cover; border-radius: 50%;">
                                                <?php else: ?>
                                                    <span class="text-muted">Tidak ada logo</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= htmlspecialchars($item->created_at) ?></td>
                                            <td><?= htmlspecialchars($item->updated_at) ?></td>

                                            <td>
                                                <a href="./detail.php?id=<?= $item->id ?>" class="btn btn-sm btn-info text-white">
                                                    <i class="bi bi-eye"></i> Detail
                                                </a>
                                                
                                            </td>
                                        </tr>
                                    <?php
                                        $no++;
                                    endwhile;
                                    ?>
                                </tbody>
                            </table>
                        </div>
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