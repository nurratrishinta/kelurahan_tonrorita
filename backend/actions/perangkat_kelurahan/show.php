<?php
include '../../app.php';

if (!isset($_GET['id'])) {
    echo "
        <script>
            alert('ID tidak ditemukan');
            window.location.href='../../pages/perangkat_kelurahan/index.php';
        </script>
    ";
    exit;
}

$id = intval($_GET['id']);
$qSelect = "SELECT * FROM perangkat_kelurahan WHERE id = '$id'";
$result = mysqli_query($connect, $qSelect) or die(mysqli_error($connect));

$perangkat = $result->fetch_object();
if (!$perangkat) {
    die("Data perangkat kelurahan tidak ditemukan");
}
?>
