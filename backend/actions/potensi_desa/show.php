<?php
include '../../app.php';

if (!isset($_GET['id'])) {
    echo "
        <script>
            alert('ID tidak ditemukan');
            window.location.href='../../pages/potensi_desa/index.php';
        </script>
    ";
    exit;
}

$id = intval($_GET['id']);
$qSelect = "SELECT * FROM potensi_desa WHERE id = '$id'";
$result = mysqli_query($connect, $qSelect) or die(mysqli_error($connect));

$potensi_desa = $result->fetch_object();
if (!$potensi_desa) {
    die("Data potensi desa tidak ditemukan");
}
?>
