<?php
session_start();
if (!isset($_SESSION["session_login"]) ){
    header('location: login.php');
    exit;
}

require 'function_karyawan.php';

if (isset($_POST['submit'])) {

    if (tambah_data($_POST) > 0) {
        echo "<script>
            alert('Data sudah berhasil ditambah');
            document.location.href = 'karyawan.php';
        </script>";

    } else {
        echo "<script>
            alert('Data gagal ditambah');
        </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah karyawan</title>

    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <a href="karyawan.php" class="nav-link">
                <i class="fas fa-arrow-left"></i> Karyawan
            </a>
        </nav>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container">
                    <h1>Tambah karyawan</h1>
                </div>
            </section>

            <section class="content">
                <div class="container">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Karyawan</h3>
                        </div>

                        <form method="POST" action="">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Karyawan</label>
                                    <input class="form-control" type="text" name="nama_karyawan"
                                        placeholder="Masukkan nama karyawan baru">
                                </div>

                                <div class="form-group">
                                    <label>jabatan</label>
                                    <select class="form-control" name="jabatan">
                                        <option value="">-- Pilih jabatan --</option>
                                        <option value="Barista">Barista</option>
                                        <option value="Kasir">Kasir</option>
                                        <option value="Manager">Manager</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>No HP</label>
                                    <input class="form-control" type="number" name="no_hp" placeholder="Masukkan No HP">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input class="form-control" type="text" name="alamat" placeholder="Masukkan Alamat">
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" name="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Tambahkan
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
    </div>

    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/dist/js/adminlte.min.js"></script>

</body>

</html>