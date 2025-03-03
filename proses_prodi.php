<?php
session_start();

require 'koneksi.php';
if (($_GET['proses']) == 'simpan') {
    if (isset($_POST['submit'])) {
        $namaProdi = $_POST['nama'];
        $jenjang = $_POST['jenjang'];
        $keterangan = $_POST['keterangan'];

        //Cek NIM sudah ada atau belum
        /*$cekNIM = mysqli_query($db,"SELECT nim FROM mahasiswa WHERE nim ='$nim' ");
        if (mysqli_num_rows($cekNIM) > 0) {
            echo "<script>alert('Data gagal disimpan!!! NIM sudah terdaftar');window.location='index.php?page=mahasiswa&aksi=create'</script>";
            exit();
        }
        */

        $query = mysqli_query($db, "INSERT INTO prodi(nama_prodi, jenjang, keterangan) VALUES ('$namaProdi','$jenjang','$keterangan')");

        if ($query) {
            echo "<script>alert('Data berhasil disimpan');window.location='index.php?page=prodi'</script>";
        } else {
            echo "<script>alert('Data gagal disimpan!!!');window.location='index.php?page=prodi&aksi=create'</script>";
        }
    }
}
if (($_GET['proses']) == 'edit') {
    $id = $_POST['id'];
    $namaProdi = $_POST['nama'];
    $jenjang = $_POST['jenjang'];
    $keterangan = $_POST['keterangan'];

    $query = mysqli_query($db, "UPDATE prodi SET nama_prodi = '$namaProdi', jenjang = '$jenjang', keterangan = '$keterangan' where id=$id");
    if ($query) {
        echo "<script>alert('Data berhasil disimpan');window.location='index.php?page=prodi'</script>";
    } else {
        echo "<script>alert('Data gagal disimpan!!!');window.location='index.php?page=prodi&aksi=create'</script>";
    }
}
if (($_GET['proses']) == 'hapus') {
    if ($_SESSION['level'] == 'admin') {
        $id = $_GET['id'];
        $query = mysqli_query($db, "DELETE FROM prodi WHERE id=$id");
        if ($query) {
            echo "<script>alert('Data berhasil dihapus');window.location='index.php?page=prodi'</script>";
        } else {
            echo "<script>alert('Data gagal dihapus');window.location='index.php?page=prodi'</script>";
        }
    }
}
?>