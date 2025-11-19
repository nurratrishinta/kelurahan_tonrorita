<?php
include '../../app.php';

if (!isset($_GET['id'])) {
    echo "
        <script>
            alert('ID tidak ditemukan');
            window.location.href='../../pages/admin/index.php';
        </script>
    ";
    exit;
}

$id = intval($_GET['id']);
$qSelect = "SELECT * FROM admin WHERE id = '$id'";
$result = mysqli_query($connect, $qSelect) or die(mysqli_error($connect));

$admin = $result->fetch_object();
if (!$admin) {
    die("Data admin tidak ditemukan");
}
?>
