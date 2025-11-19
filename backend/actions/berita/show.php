<?php
include '../../app.php';

if (!isset($_GET['id'])) {
    echo "
        <script>
            alert('ID berita tidak ditemukan');
            window.location.href='../../pages/berita/index.php';
        </script>
    ";
    exit;
}

$id = intval($_GET['id']);
$qSelect = "SELECT * FROM berita WHERE id = '$id'";
$result = mysqli_query($connect, $qSelect) or die(mysqli_error($connect));

$berita = $result->fetch_object();
if (!$berita) {
    die("Data berita tidak ditemukan");
}
?>
