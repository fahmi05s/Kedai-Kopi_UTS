<?php
session_start();
if (!isset($_SESSION["session_login"]) ){
    header('location: login.php');
    exit;
}

require 'function_menu.php';
$id_menu = $_GET['id_menu'];

$menu = query_db("SELECT * FROM menu WHERE id_menu = $id_menu")[0];
// var_dump($mahasiswa);

if (isset($_POST['submit'])) {
    if (edit_data($_POST) > 0) {
        echo "<script>
                alert('Data sudah berhasil diubah!');
                document.location.href = 'menu.php';
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
    <title>Edit Menu - Kedai Kopi</title>

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <a href="index.php" class="nav-link">
                <i class="fas fa-arrow-left"></i> Dashboard
            </a>
        </nav>

        <!-- Content Wrapper -->
        <div class="content-wrapper">

            <section class="content-header">
                <div class="container">
                    <h1>Edit Menu</h1>
                </div>
            </section>

            <section class="content">
                <div class="container">

                    <div class="card card-warning">

                        <div class="card-header">
                            <h3 class="card-title">Form Edit Menu</h3>
                        </div>

                        <form action="" method="POST">
                            <input type="hidden" name="id_menu" value="<?= $menu['id_menu']; ?>">
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="nama_menu">Nama Menu</label>
                                    <input type="text" name="nama_menu" id="nama_menu" class="form-control"
                                        value="<?= $menu["nama_menu"] ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select name="kategori" id="kategori" class="form-control" required>

                                        <option value="Coffee" <?= $menu['kategori'] == 'Coffee' ? 'selected' : ''; ?>>
                                            Coffee
                                        </option>

                                        <option value="Non-Coffee" <?= $menu['kategori'] == 'Non-Coffee' ? 'selected' : ''; ?>>
                                            Non-Coffee
                                        </option>

                                        <option value="Food" <?= $menu['kategori'] == 'Food' ? 'selected' : ''; ?>>
                                            Food
                                        </option>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="harga">Harga (Rp)</label>
                                    <input type="number" name="harga" id="harga" class="form-control" min="0"
                                        step="0.01" value="<?= $menu["harga"] ?>" required>
                                </div>

                            </div>

                            <div class="card-footer">

                                <button type="submit" name="submit" class="btn btn-warning">
                                    <i class="fas fa-save"></i>
                                    Update Menu
                                </button>

                                <a href="index.php" class="btn btn-secondary">
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