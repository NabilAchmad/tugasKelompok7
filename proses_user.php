<?php
session_start();

require 'koneksi.php';
if (isset($_GET['proses']) == 'simpan') {
    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $level = $_POST['level'];
        $password = md5($_POST['password']);
        //Cek NIM sudah ada atau belum
        $cekNIM = mysqli_query($db, "SELECT email, password FROM user WHERE email ='$email' AND password = '$password' ");
        if (mysqli_num_rows($cekNIM) > 0) {
            echo "<script>alert('Data gagal disimpan!!! Email dan Password sudah terdaftar');window.location='index.php?page=mahasiswa&aksi=create'</script>";
            exit();
        }

        $querySV = mysqli_query($db, "INSERT INTO user (nama_lengkap, email, password, level) VALUES ('$nama','$email','$password', '$level')");

        if ($querySV) {
            echo "<script>alert('Data berhasil disimpan');window.location='index.php?page=user'</script>";
        } else {
            echo "<script>alert('Data gagal disimpan!!!');window.location='index.php?page=user&aksi=create'</script>";
        }
    }
}
if (isset($_GET['proses']) == 'edit') {
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $level = $_POST['level'];

        $queryED = mysqli_query($db, "UPDATE user SET nama_lengkap = '$nama', email='$email', level = '$level' WHERE id='$id'");

        if ($queryED) {
            echo "<script>alert('Data berhasil disimpan');window.location='index.php?page=user'</script>";
        } else {
            echo "<script>alert('Data gagal disimpan!!!');window.location='index.php?page=user&aksi=create'</script>";
        }
    }
}
if (isset($_GET['proses']) == 'hapus') {
    if ($_SESSION['level'] == 'admin') {

        $id = $_GET['id'];
        $queryHPS = mysqli_query($db, "DELETE FROM user WHERE id=$id");
        if ($queryHPS) {
            echo "<script>alert('Data berhasil dihapus');window.location='index.php?page=user'</script>";
        } else {
            echo "<script>alert('Data gagal dihapus');window.location='index.php?page=user'</script>";
        }
    }
}
?>