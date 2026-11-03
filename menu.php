<?php
session_start();
if (!isset($_SESSION["session_login"]) ){
    header('location: login.php');
    exit;
}

require_once "function_menu.php";

// Menghitung jumlah semua menu
$jumlah_menu = query_db("SELECT COUNT(*) AS total FROM menu");

// Cari Data
$keyword = trim($_GET["keyword"] ?? "");

// Menampilkan semua menu atau hasil pencarian
if ($keyword !== "") {
    $semuaMenu = cari_data($keyword);
} else {
    $semuaMenu = query_db("SELECT * FROM menu ORDER BY id_menu ASC");
}

// Pagination
$jumlahData = count($semuaMenu);
$jumlahDataPerhalaman = 5;
$jumlahHalaman = max(1, ceil($jumlahData / $jumlahDataPerhalaman));

// Halaman aktif
$halamanAktif = isset($_GET["halaman"])
    ? (int) $_GET["halaman"]
    : 1;

// Validasi halaman aktif
$halamanAktif = max(1, min($halamanAktif, $jumlahHalaman));

// Menghitung posisi awal data
$awalData = ($halamanAktif - 1) * $jumlahDataPerhalaman;

// Mengambil 5 data sesuai halaman
$menu = array_slice($semuaMenu, $awalData, $jumlahDataPerhalaman);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kedai Kopi</title>
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form action="logout.php" method="POST" class="m-0">
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->

        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <!-- Brand Logo -->
            <a href="index.php" class="brand-link">
                <span class="brand-text font-weight-light ml-3">
                    Kedai Kopi
                </span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="index.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <!-- Manajemen Menu -->
                        <li class="nav-item">
                            <a href="menu.php" class="nav-link active">
                                <i class="nav-icon fas fa-coffee"></i>
                                <p>Manajemen Menu</p>
                            </a>
                        </li>

                        <!-- Manajemen Karyawan -->
                        <li class="nav-item">
                            <a href="karyawan.php" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Manajemen Karyawan</p>
                            </a>
                        </li>

                        <!-- Menu Logout -->
                        <li class="nav-item">
                            <form action="logout.php" method="POST">
                                <button type="submit" class="nav-link btn btn-link text-left w-100">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
                                    <p>Logout</p>
                                </button>
                            </form>
                        </li>

                    </ul>
                </nav>

            </div>
        </aside>

        <!-- /.sidebar -->

        <!-- Content Wrapper -->
        <div class="content-wrapper">

            <section class="content-header">
                <div class="container-fluid">
                    <h1>Maneajemen Menu</h1>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">

                    <!-- Small Boxes -->
                    <div class="row">

                        <!-- Jumlah Produk -->
                        <div class="col-lg-12 col-12">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?= (int) $jumlah_menu[0]["total"]; ?></h3>
                                    <p>Jumlah Menu</p>
                                </div>

                                <div class="icon">
                                    <i class="fas fa-coffee"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Produk -->
                    <div class="card" id="data-produk">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Produk Kedai Kopi</h3>
                            <div class="card-tools">
                                <a href="tambah_menu.php" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Tambah Menu
                                </a>
                            </div>

                        </div>

                        <div class="card-body">

                            <!-- Search -->
                            <form method="GET" action="index.php" class="mb-3">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control"
                                        placeholder="Cari nama atau kategori menu...">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i> Cari
                                        </button>

                                        <a href="index.php#data-produk" class="btn btn-secondary">
                                            Reset
                                        </a>
                                    </div>
                                </div>
                            </form>

                            <!-- Tabel Produk -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Menu</th>
                                            <th>Nama Menu</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $no = $awalData + 1; ?>
                                        <?php foreach ($menu as $data): ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $data["id_menu"] ?></td>
                                                <td><?= $data["nama_menu"] ?></td>
                                                <td><?= $data["kategori"] ?></td>
                                                <td>Rp. <?= $data["harga"] ?></td>
                                                <td>
                                                    <a href="edit_menu.php?id_menu=<?php echo $data["id_menu"] ?>"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                    <a href="hapus_menu.php?id_menu=<?php echo $data["id_menu"] ?>"
                                                        class="btn btn-danger btn-sm">Hapus</a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- =====PAGINATION===== -->
                            <nav aria-label="Pagination Menu">
                                <ul class="pagination justify-content-center mt-3">

                                    <!-- Previous -->
                                    <li class="page-item <?= $halaman == 1 ? 'disabled' : '' ?>">
                                        <?php if ($halamanAktif > 1): ?>
                                            <a class="page-link" href="?halaman=<?= $halamanAktif - 1 ?>">
                                                Previous
                                            </a>
                                        <?php else: ?>
                                            <span class="page-link">Previous</span>
                                        <?php endif; ?>
                                    </li>

                                    <!-- Nomor Halaman -->
                                    <?php for ($i = 1; $i <= $jumlahHalaman; $i++): ?>
                                        <li class="page-item <?= $i == $halamanAktif ? 'active' : '' ?>">
                                            <a class="page-link" href="?halaman=<?= $i ?>">
                                                <?= $i ?>
                                            </a>
                                        </li>
                                    <?php endfor; ?>

                                    <!-- Next -->
                                    <li class="page-item <?= $halamanAktif == $jumlahHalaman ? 'disabled' : '' ?>">
                                        <?php if ($halamanAktif < $jumlahHalaman): ?>
                                            <a class="page-link" href="?halaman=<?= $halamanAktif + 1 ?>">
                                                Next
                                            </a>
                                        <?php else: ?>
                                            <span class="page-link">Next</span>
                                        <?php endif; ?>
                                    </li>

                                </ul>
                            </nav>

                        </div>
                    </div>

                </div>
            </section>

        </div>


    </div>
    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE JS -->
    <script src="assets/dist/js/adminlte.min.js"></script>
</body>

</html>