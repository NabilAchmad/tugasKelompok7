<?php
session_start();

require 'koneksi.php';
if(isset($_GET['proses']) == 'simpan') {
    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $nim = $_POST['nim'];
        $prodi = $_POST['prodi'];
        $gender = $_POST['gender'];
        $hobi = implode(", ", $_POST['hobi']);
        $alamat = $_POST['alamat'];

        //Cek NIM sudah ada atau belum
        $cekNIM = mysqli_query($db,"SELECT nim FROM mahasiswa WHERE nim ='$nim' ");
        if (mysqli_num_rows($cekNIM) > 0) {
            echo "<script>alert('Data gagal disimpan!!! NIM sudah terdaftar');window.location='index.php?page=mahasiswa&aksi=create'</script>";
            exit();
        }

        $querySV = mysqli_query($db, "INSERT INTO mahasiswa (nama, email, nim, gender, hobi, alamat, prodi_id) VALUES ('$nama','$email','$nim','$gender','$hobi','$alamat', '$prodi')"); 
        
        if ($querySV){
            echo "<script>alert('Data berhasil disimpan');window.location='index.php?page=mahasiswa'</script>";
        } else{
            echo "<script>alert('Data gagal disimpan!!!');window.location='index.php?page=mahasiswa&aksi=create'</script>";
        }
    }
}
if(isset($_GET['proses']) == 'edit') {
    if (isset($_POST['update'])) {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $nim = $_POST['nim'];
        $prodi = $_POST['prodi'];
        $gender = $_POST['gender'];
        $hobi = implode(", ", $_POST['hobi']);
        $alamat = $_POST['alamat'];

        $queryED = mysqli_query($db, "UPDATE mahasiswa SET nama = '$nama', email='$email', gender='$gender', hobi='$hobi', alamat='$alamat', prodi_id='$prodi' WHERE nim='$nim'");
        
        if ($queryED){
            echo "<script>alert('Data berhasil disimpan');window.location='index.php?page=mahasiswa'</script>";
        } else{
            echo "<script>alert('Data gagal disimpan!!!');window.location='index.php?page=mahasiswa&aksi=create'</script>";
        }
    }
}
if(isset($_GET['proses']) == 'hapus') {
    if($_SESSION['level'] == 'admin'){

        $id = $_GET['id'];
        $queryHPS = mysqli_query($db, "DELETE FROM mahasiswa WHERE id=$id");
        if ($queryHPS){
            echo "<script>alert('Data berhasil dihapus');window.location='index.php?page=mahasiswa'</script>";
        } else{
            echo "<script>alert('Anda Tidak Punya Akses');window.location='index.php?page=mahasiswa'</script>";
        }
    }
}

?>