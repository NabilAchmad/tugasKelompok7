<?php
require 'koneksi.php';
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'read';

switch ($aksi) {
    case 'read':


?>

        <h1>Data Mahasiswa</h1>
        <a href="index.php?page=mahasiswa&aksi=create" class="btn btn-primary">Tambah Data</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Proda</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Hobi</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $queryMhs = mysqli_query($db, "SELECT m.*, p.nama_prodi, p.jenjang FROM mahasiswa m JOIN prodi p ON m.prodi_id = p.id");
                $no = 1;
                while ($data = mysqli_fetch_array($queryMhs)) {


                ?>
                    <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= $data['nama']  ?></td>
                        <td><?= $data['email'] ?></td>
                        <td><?= $data['nim'] ?></td>
                        <td><?= $data['nama_prodi'] ?></td>
                        <td><?= $data['gender'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                        <td><?= $data['hobi'] ?></td>
                        <td><?= $data['alamat'] ?></td>
                        <td>
                            <a href="index.php?page=mahasiswa&aksi=update&id=<?= $data['id']  ?>" class="btn btn-warning">Edit</a>
                            <?php if ($_SESSION['level'] == 'admin'): ?>
                                <a href="proses_mahasiswa.php?proses=hapus&id=<?= $data['id']  ?>" onclick="return confirm('Menghapus Data Ini?')" class="btn btn-danger">Hapus</a>
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
        <h1>Input Data Mahasiswa</h1>
        <form action="proses_mahasiswa.php?proses=simpan" method="POST">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" inputmode="numeric" class="form-control" id="nim" name="nim" required>
            </div>
            <div class="mb-3">
                <label for="prodi" class="form-label">Prodi</label>
                <select class="form-select" id="prodi" name="prodi">
                    <option value="">Pilih Prodi</option>
                    <?php
                    $queryProdi = mysqli_query($db, "SELECT * FROM prodi");
                    while ($dataProdi = mysqli_fetch_array($queryProdi)) {
                    ?>
                        <option value="<?= $dataProdi['id'] ?>"><?= $dataProdi['nama_prodi'] ?></option>
                    <?php    } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="L" name="gender" id="gender">
                    <label class="form-check-label" for="gender">
                        Laki-laki
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="P" name="gender" id="gender">
                    <label class="form-check-label" for="gender">
                        Perempuan
                    </label>
                </div>
                <div class="mb-3">
                    <label for="hobi" class="form-label">Hobi</label>
                    <div class="form-check">
                        <input class="form-check-input" name="hobi[]" type="checkbox" value="Mancing" id="hobi">
                        <label class="form-check-label" for="hobi">
                            Mancing
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="hobi[]" type="checkbox" value="Olahraga" id="hobi">
                        <label class="form-check-label" for="hobi">
                            Olahraga
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="hobi[]" type="checkbox" value="Gaming" id="hobi">
                        <label class="form-check-label" for="hobi">
                            Gaming
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat"></textarea>
                </div>
            </div>
            <button type="submit" name="submit" value="simpan" class="btn btn-primary">Submit</button>
        </form>
    <?php
        break;
    case 'update':
    ?>
        <h1>Edit Data Mahasiswa</h1>
        <?php
        $id = $_GET['id'];
        $query = mysqli_query($db, "SELECT * FROM mahasiswa WHERE id=$id");
        $row = mysqli_fetch_array($query);
        $hobbies = explode(", ", $row['hobi']);
        ?>
        <form action="proses_mahasiswa.php?proses=edit" method="POST">
            <input type="hidden" value="<?= $id ?>" name="id">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $row['nama'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $row['email'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" inputmode="numeric" class="form-control" id="nim" name="nim" value="<?= $row['nim'] ?>" required readonly>
            </div>
            <div class="mb-3">
                <label for="prodi" class="form-label">Prodi</label>
                <select class="form-select" id="prodi" name="prodi">
                    <option value="">Pilih Prodi</option>
                    <?php
                    $queryProdi = mysqli_query($db, "SELECT * FROM prodi");
                    while ($dataProdi = mysqli_fetch_array($queryProdi)) {
                    ?>
                        <option value="<?= $dataProdi['id'] ?>" <?= $dataProdi['id'] == $row['prodi_id'] ? 'selected' : '' ?>><?= $dataProdi['nama_prodi'] ?></option>
                    <?php    } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="L" name="gender" id="gender" <?= $row['gender'] == 'L' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="gender">
                        Laki-laki
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="P" name="gender" id="gender" <?= $row['gender'] == 'P' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="gender">
                        Perempuan
                    </label>
                </div>
                <div class="mb-3">
                    <label for="hobi" class="form-label">Hobi</label>
                    <div class="form-check">
                        <input class="form-check-input" name="hobi[]" type="checkbox" value="Berenang" id="hobi" <?= in_array("Berenang", $hobbies) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="hobi">
                            Berenang
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="hobi[]" type="checkbox" value="Sepak Bola" id="hobi" <?= in_array("Sepak Bola", $hobbies) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="hobi">
                            Sepak Bola
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="hobi[]" type="checkbox" value="Voli" id="hobi" <?= in_array("Voli", $hobbies) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="hobi">
                            Voli
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" required><?= $row['alamat'] ?></textarea>
                </div>
            </div>
            <button type="submit" name="update" value="update" class="btn btn-primary">Submit</button>
        </form>
<?php
        break;
}
?>