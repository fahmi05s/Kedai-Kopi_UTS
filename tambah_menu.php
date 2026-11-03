<?php
session_start();
if (!isset($_SESSION["session_login"]) ){
    header('location: login.php');
    exit;
}

require 'function_menu.php';

if (isset($_POST['submit'])) {

    if (tambah_data($_POST) > 0) {
        echo "<script>
            alert('Data sudah berhasil ditambah');
            document.location.href = 'menu.php';
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
    <title>Tambah Menu</title>

    <link rel="stylesheet"
          href="assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet"
          href="assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition layout-top-nav">
<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <a href="index.php" class="nav-link">
            <i class="fas fa-arrow-left"></i> Dashboard
        </a>
    </nav>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container">
                <h1>Tambah Menu</h1>
            </div>
        </section>

        <section class="content">
            <div class="container">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form Tambah Menu</h3>
                    </div>

                    <form method="POST" action="">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Menu</label>
                                <input class="form-control" type="text" name="nama_menu" placeholder="Masukkan nama menu" >
                            </div>

                            <div class="form-group">
                                <label>kategori</label>
                                <select class="form-control" name="kategori">
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="Coffee">Coffee</option>
                                    <option value="Non-Coffee">Non-Coffee</option>
                                    <option value="Food">Food</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Harga</label>
                                <input class="form-control" type="number" name="harga" placeholder="Masukkan harga" >
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit"name="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Tambahkan
                            </button>

                            <a href="index.php"
                               class="btn btn-secondary">
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
