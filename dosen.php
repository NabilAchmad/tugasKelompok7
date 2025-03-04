<?php
require 'koneksi.php';
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'read';
switch ($aksi) {
    case "read": ?>
        <h1>Data Dosen</h1>
        <a href="index.php?page=dosen&aksi=create " class="btn btn-primary">Tambah Data</a>
        <table class="table" id="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">NIP</th>
                    <th scope="col">Nama Dosen</th>
                    <th scope="col">Prodi</th>
                    <th scope="col">Foto Dosen</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $queryMhs = mysqli_query($db, "SELECT dosen.*, prodi.nama_prodi FROM dosen LEFT JOIN prodi ON dosen.prodi_id = prodi.id");

                $no = 1;

                while ($data = mysqli_fetch_array($queryMhs)) {
                ?>
                    <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= $data['nip'] ?></td>
                        <td><?= $data['nama_dosen'] ?></td>
                        <td><?= $data['nama_prodi'] ?></td>
                        <td><img src="<?= $data['foto'] ?>" alt="Foto" width="100"></td>
                        <td>
                            <a href="index.php?page=dosen&aksi=update&id=<?= $data['nip'] ?>" class="btn btn-warning">Edit</a>
                            <?php if ($_SESSION['level'] == 'admin'): ?>
                                <a href="proses_dosen.php?proses=hapus&id=<?= $data['nip'] ?>" onclick="return confirm('Apakah anda yakin menghapus data ini ?')" class="btn btn-danger">Hapus</a>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php
        break;
    case "create":
    ?>

        <h1>Input data Dosen</h1>
        <form action="proses_dosen.php?proses=simpan" method="POST" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" class="form-control" id="nip" name="nip" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Dosen</label>
                <input type="text" class="form-control" id="nama" name="nama_dosen" required>
            </div>

            <!-- Prodi from table prodi -->
            <div class="mb-3">
                <label for="prodi" class="form-label">Program Studi</label>
                <select class="form-control" name="prodi_id" required>
                    <option value="">Pilih Program Studi</option>
                    <?php
                    $queryProdi = mysqli_query($db, "SELECT * FROM prodi");
                    while ($prodi = mysqli_fetch_array($queryProdi)) {
                        echo "<option value='" . $prodi['id'] . "'>" . $prodi['nama_prodi'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto" required>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>

    <?php
        break;
    case "update":
        $nip = $_GET['id'];
        $query = mysqli_query($db, "SELECT * FROM dosen WHERE nip='$nip'");
        $data = mysqli_fetch_array($query);
    ?>
        <h1>Edit Data Dosen</h1>
        <form action="proses_dosen.php?proses=edit" method="POST">
            <input type="hidden" name="old_nip" value="<?= $data['nip'] ?>">
            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" class="form-control" id="nip" name="nip" value="<?= $data['nip'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Dosen</label>
                <input type="text" class="form-control" id="nama" name="nama_dosen" value="<?= $data['nama_dosen'] ?>" required>
            </div>


            <div class="mb-3">
                <label for="prodi" class="form-label">Program Studi</label>
                <select class="form-control" name="prodi_id" required>
                    <option value="">Pilih Program Studi</option>
                    <?php
                    $queryProdi = mysqli_query($db, "SELECT * FROM prodi");
                    while ($prodi = mysqli_fetch_array($queryProdi)) {
                        $selected = $prodi['id'] == $data['prodi_id'] ? 'selected' : '';
                        echo "<option value='" . $prodi['id'] . "' $selected>" . $prodi['nama_prodi'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto">
            </div>
            <input type="hidden" name="existing_foto" value="<?= $data['foto'] ?>">




            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
<?php
        break;
}
?>