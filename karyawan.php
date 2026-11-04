<?php
session_start();
if (!isset($_SESSION["session_login"]) ){
    header('location: login.php');
    exit;
}
require_once "function_karyawan.php";

// Menghitung jumlah semua menu
$jumlah_karyawan = query_db("SELECT COUNT(*) AS total FROM menu");

// Cari Data
$keyword = trim($_GET["keyword"] ?? "");

// Menampilkan semua menu atau hasil pencarian
if ($keyword !== "") {
    $semuaKaryawan = cari_data($keyword);
} else {
    $semuaKaryawan = query_db("SELECT * FROM karyawan ORDER BY id_karyawan ASC");
}

// Pagination
$jumlahData = count($semuaKaryawan);
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
$karyawan = array_slice($semuaKaryawan, $awalData, $jumlahDataPerhalaman);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data karyawan</title>
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
                            <a href="menu.php" class="nav-link">
                                <i class="nav-icon fas fa-coffee"></i>
                                <p>Manajemen Menu</p>
                            </a>
                        </li>

                        <!-- Manajemen Karyawan -->
                        <li class="nav-item">
                            <a href="karyawan.php" class="nav-link active">
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
                    <h1>Manajemen Karyawan</h1>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">

                    <!-- Small Boxes -->
                    <div class="row">

                        <!-- Jumlah Produk -->
                        <div class="col-lg-12 col-12">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?= (int) $jumlah_karyawan[0]["total"]; ?></h3>
                                    <p>karyawan</p>
                                </div>

                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Produk -->
                    <div class="card" id="data-produk">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Produk Kedai Kopi</h3>
                            <div class="card-tools">
                                <a href="tambah_karyawan.php" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Tambah
                                </a>
                            </div>

                        </div>

                        <div class="card-body">

                            <!-- Search -->
                            <form method="GET" action="karyawan.php" class="mb-3">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control"
                                        placeholder="Cari nama atau jabatan karyawan...">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i> Cari
                                        </button>

                                        <a href="karyawan.php" class="btn btn-secondary">
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
                                            <th>ID karyawan</th>
                                            <th>Nama karyawan</th>
                                            <th>Jabatan</th>
                                            <th>No HP</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $no = $awalData + 1; ?>
                                        <?php foreach ($karyawan as $data): ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $data["id_karyawan"] ?></td>
                                                <td><?= $data["nama_karyawan"] ?></td>
                                                <td><?= $data["jabatan"] ?></td>
                                                <td><?= $data["no_hp"] ?></td>
                                                <td><?= $data["alamat"] ?></td>
                                                <td>
                                                    <a href="edit_karyawan.php?id_karyawan=<?php echo $data["id_karyawan"] ?>"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                    <a href="hapus_karyawan.php?id_karyawan=<?php echo $data["id_karyawan"] ?>"
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