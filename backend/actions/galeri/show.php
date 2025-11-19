<?php
include '../../app.php';

if (!isset($_GET['id'])) {
    echo "
        <script>
            alert('ID tidak ditemukan');
            window.location.href='../../pages/galeri/index.php';
        </script>
    ";
    exit;
}

$id = intval($_GET['id']);
$qSelect = "SELECT * FROM galeri WHERE id = '$id'";
$result = mysqli_query($connect, $qSelect) or die(mysqli_error($connect));

$galeri = $result->fetch_object();
if (!$galeri) {
    die("Data galeri tidak ditemukan");
}
?>
    