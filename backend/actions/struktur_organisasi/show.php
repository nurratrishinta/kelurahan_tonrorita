<?php
include '../../app.php';

if (!isset($_GET['id'])) {
    echo "
        <script>
            alert('ID tidak ditemukan');
            window.location.href='../../pages/struktur_organisasi/index.php';
        </script>
    ";
    exit;
}

$id = intval($_GET['id']);
$qSelect = "
    SELECT s.*, p.nama AS parent_nama
    FROM struktur_organisasi s
    LEFT JOIN struktur_organisasi p ON s.parent_id = p.id
    WHERE s.id = '$id'
";
$result = mysqli_query($connect, $qSelect) or die(mysqli_error($connect));

$struktur = $result->fetch_object();
if (!$struktur) {
    die("Data struktur organisasi tidak ditemukan");
}
?>
