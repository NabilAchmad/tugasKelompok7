<?php
require 'koneksi.php';
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'read';

switch ($aksi) {
    case 'read':


?>

        <h1>Data Prodi</h1>
        <a href="index.php?page=prodi&aksi=create" class="btn btn-primary">Tambah Data</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Prodi</th>
                    <th scope="col">Jenjang</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Aksi</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $queryMhs = mysqli_query($db, "SELECT * FROM prodi");
                $no = 1;
                while ($data = mysqli_fetch_array($queryMhs)) {


                ?>
                    <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= $data['nama_prodi']  ?></td>
                        <td><?= $data['jenjang'] ?></td>
                        <td><?= $data['keterangan'] ?></td>

                        <td>
                            <a href="index.php?page=prodi&aksi=update&id=<?= $data['id']  ?>" class="btn btn-warning">Edit</a>
                            <?php if($_SESSION['level'] == 'admin'): ?>
                            <a href="proses_prodi.php?proses=hapus&id=<?= $data['id']  ?>" onclick="return confirm('Menghapus Data Ini?')" class="btn btn-danger">Hapus</a>
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
        <h1>Input Data Prodi</h1>
        <form action="proses_prodi.php?proses=simpan" method="POST">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Prodi</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Jenjang</label>
                <select name="jenjang" id="jenjang" class="form-control">
                    <option value="">Pilih Jenjang</option>
                    <option value="D2">D2</option>
                    <option value="D3">D3</option>
                    <option value="D4">D4</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="nim" class="form-label">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
            </div>
            <button type="submit" name="submit" value="simpan" class="btn btn-primary">Submit</button>
        </form>
    <?php
        break;
    case 'update':
    ?>
        <h1>Edit Data Prodi</h1>
        <?php
        $id = $_GET['id'];
        $query = mysqli_query($db, "SELECT * FROM prodi WHERE id=$id");
        $row = mysqli_fetch_array($query);
        ?>
        <form action="proses_prodi.php?proses=edit" method="POST">
            <input type="hidden" value="<?= $id ?>" name="id">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Prodi</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $row['nama_prodi'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="jenjang" class="form-label">Jenjang</label>
                <select name="jenjang" id="jenjang" class="form-control" value="<?= $row['jenjang'] ?>">
                    <option value="D2">Pilih Jenjang</option>
                    <option value="D2" <?= $row['jenjang'] == 'D2' ? 'selected' : '' ?>>D2</option>
                    <option value="D3" <?= $row['jenjang'] == 'D3' ? 'selected' : '' ?>>D3</option>
                    <option value="D4" <?= $row['jenjang'] == 'D4' ? 'selected' : '' ?>>D4</option>
                    <option value="S1" <?= $row['jenjang'] == 'S1' ? 'selected' : '' ?>>S1</option>
                    <option value="S2" <?= $row['jenjang'] == 'S2' ? 'selected' : '' ?>>S2</option>

                </select>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" required><?= $row['keterangan'] ?></textarea>
            </div>
            <button type="submit" name="submit" value="simpan" class="btn btn-primary">Submit</button>
        </form>
<?php
        break;
}
?>