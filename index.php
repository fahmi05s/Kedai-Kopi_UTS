<?php
session_start();
if (!isset($_SESSION["session_login"]) ){
    header('location: login.php');
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "kedai_kopi");

$jumlah_menu = query_db("SELECT COUNT(*) AS total FROM menu");
$jumlah_karyawan = query_db("SELECT COUNT(*) AS total FROM karyawan");
function query_db($query)
{
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Kedai Kopi</title>
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

        <!-- SIDEBAR -->
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
                            <a href="index.php" class="nav-link active">
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

        <!-- MAIN CONTENT -->
        <div class="content-wrapper">

            <!-- Header -->
            <section class="content-header">
                <div class="container-fluid">

                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Dashboard</h1>
                        </div>
                    </div>

                </div>
            </section>

            <!-- Dashboard Content -->
            <section class="content">
                <div class="container-fluid">

                    <!-- Welcome -->
                    <div class="card">
                        <div class="card-body">
                            <h4>Selamat Datang di Kedai Kopi!</h4>
                            <p class="text-muted mb-0">
                                Sistem Informasi Manajemen Kedai Kopi.
                                Kelola data menu dan karyawan dengan mudah.
                            </p>
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="row">

                        <!-- Total Menu -->
                        <div class="col-lg-6 col-12">
                            <div class="small-box bg-info">

                                <div class="inner">
                                    <h3><?= (int) $jumlah_menu[0]["total"]; ?></h3>
                                    <p>Total Menu</p>
                                </div>

                                <div class="icon">
                                    <i class="fas fa-coffee"></i>
                                </div>

                                <a href="menu.php" class="small-box-footer">
                                    Lihat Data Menu
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>

                            </div>
                        </div>

                        <!-- Total Karyawan -->
                        <div class="col-lg-6 col-12">
                            <div class="small-box bg-success">

                                <div class="inner">
                                    <h3><?= (int) $jumlah_karyawan[0]["total"]; ?></h3>
                                    <p>Total Karyawan</p>
                                </div>

                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>

                                <a href="karyawan.php" class="small-box-footer">
                                    Lihat Data Karyawan
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>

                            </div>
                        </div>

                    </div>

                    <!-- Quick Access -->
                    <div class="card card-primary card-outline">

                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-th-large mr-2"></i>
                                Akses Cepat
                            </h3>
                        </div>

                        <div class="card-body">

                            <a href="menu.php" class="btn btn-info mr-2 mb-2">
                                <i class="fas fa-coffee mr-1"></i>
                                Kelola Menu
                            </a>

                            <a href="karyawan.php" class="btn btn-success mb-2">
                                <i class="fas fa-users mr-1"></i>
                                Kelola Karyawan
                            </a>

                            <a href="tambah_menu.php" class="btn btn-primary mr-2 mb-2">
                                <i class="fas fa-plus mr-1"></i>
                                Tambah Menu
                            </a>

                            <a href="tambah_karyawan.php" class="btn btn-warning mb-2">
                                <i class="fas fa-user-plus mr-1"></i>
                                Tambah Karyawan
                            </a>
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