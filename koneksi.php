<?php
// Konfigurasi database
$host = "localhost";        // Nama host server database
$user = "root";             // Username untuk database
$password = "";             // Password untuk database
$database = "web_trpld2d";   // Nama database yang akan diakses

// Membuat koneksi ke database
$db = mysqli_connect($host, $user, $password, $database);

// Memeriksa apakah koneksi berhasil atau tidak
if (!$db) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>