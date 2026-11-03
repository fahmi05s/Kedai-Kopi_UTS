<?php
session_start();
if (!isset($_SESSION["session_login"]) ){
    header('location: login.php');
    exit;
}

require 'function_karyawan.php';
$id_karyawan = $_GET['id_karyawan'];

$karyawan = query_db("SELECT * FROM karyawan WHERE id_karyawan = $id_karyawan")[0];

if (isset($_POST['submit'])) {
    if (edit_data($_POST) > 0) {
        echo "<script>
                alert('Data sudah berhasil diubah!');
                document.location.href = 'karyawan.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal diubah!');
                </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit karyawan - Kedai Kopi</title>

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <a href="karyawan.php" class="nav-link">
                <i class="fas fa-arrow-left"></i> Karyawan
            </a>
        </nav>

        <!-- Content Wrapper -->
        <div class="content-wrapper">

            <section class="content-header">
                <div class="container">
                    <h1>Edit Karyawan</h1>
                </div>
            </section>

            <section class="content">
                <div class="container">

                    <div class="card card-warning">

                        <div class="card-header">
                            <h3 class="card-title">Form Edit Karyawan</h3>
                        </div>

                        <form action="" method="POST">
                            <input type="hidden" name="id_karyawan" value="<?= $karyawan['id_karyawan']; ?>">
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="nama_karyawan">Nama karyawan</label>
                                    <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control"
                                        value="<?= $karyawan["nama_karyawan"] ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="jabatan">Jabatan</label>
                                    <select name="jabatan" id="jabatan" class="form-control" required>

                                        <option value="Barista" <?= $karyawan['jabatan'] == 'Barista' ? 'selected' : ''; ?>>
                                            Barista
                                        </option>

                                        <option value="Kasir" <?= $karyawan['jabatan'] == 'Kasir' ? 'selected' : ''; ?>>
                                            Kasir
                                        </option>

                                        <option value="Manager" <?= $karyawan['jabatan'] == 'Manager' ? 'selected' : ''; ?>>
                                            Manager
                                        </option>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="no_hp">No HP</label>
                                    <input type="number" name="no_hp" id="no_hp" class="form-control" min="0"
                                        step="0.01" value="<?= $karyawan["no_hp"] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" name="alamat" id="alamat" class="form-control"
                                        value="<?= $karyawan["alamat"] ?>" required>
                                </div>

                            </div>

                            <div class="card-footer">

                                <button type="submit" name="submit" class="btn btn-warning">
                                    <i class="fas fa-save"></i>
                                    Update
                                </button>

                                <a href="karyawan.php" class="btn btn-secondary">
                                    Kembali
                                </a>

                            </div>

                        </form>
                    </div>

                </div>
            </section>

        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- /.wrapper -->

    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE JS -->
    <script src="assets/dist/js/adminlte.min.js"></script>

</body>

</html>