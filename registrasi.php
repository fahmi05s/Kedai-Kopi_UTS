<?php
require 'function_registrasi.php';

if (isset($_POST["register"])) {

    if (registrasi($_POST) > 0) {
        echo "<script>
                    alert('User baru berhasil ditambahkan!');
                 </script>
            ";
    } else {
        echo mysqli_error($conn);
    }

}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Kedai Kopi</title>

    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">

    <div class="register-box">

        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h2>Kedai Kopi</h2>
            </div>

            <div class="card-body register-card-body">

                <p class="login-box-msg">Registrasi Akun Baru</p>
                <form action="" method="POST">

                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username"
                            maxlength="50" autocomplete="username" required>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" 
                            required>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="konfirmasi_password" class="form-control" placeholder="Konfirmasi Password"
                              required>
                    </div>

                    <button type="submit" name="register" class="btn btn-primary btn-block">
                        Registrasi
                    </button>

                </form>

                <p class="mt-3 mb-0">
                    <a href="login.php">Sudah punya akun? Login</a>
                </p>

            </div>
        </div>

    </div>

    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/dist/js/adminlte.min.js"></script>

</body>

</html>