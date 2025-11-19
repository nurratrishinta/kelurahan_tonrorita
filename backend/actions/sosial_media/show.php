<?php
include '../../app.php';

if (!isset($_GET['id'])) {
    echo "
        <script>
            alert('ID tidak ditemukan');
            window.location.href='../../pages/sosial_media/index.php';
        </script>
    ";
    exit;
}

$id = intval($_GET['id']);
$qSelect = "SELECT * FROM sosial_media WHERE id = '$id'";
$result = mysqli_query($connect, $qSelect) or die(mysqli_error($connect));

$sosial_media = $result->fetch_object();
if (!$sosial_media) {
    die("Data sosial media tidak ditemukan");
}
?>
