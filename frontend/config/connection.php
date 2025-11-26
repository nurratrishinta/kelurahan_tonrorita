<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "kelurahan_tonrorita";

// Membuat koneksi ke database (versi OOP)
$db = new mysqli($hostname, $username, $password, $database);

// Cek koneksi
if ($db->connect_error) {
    die("Koneksi gagal: " . $db->connect_error);
}
?>
