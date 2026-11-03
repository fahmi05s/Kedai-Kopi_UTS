<?php 
session_start();

    require 'function_registrasi.php';

    if(isset($_POST['login'])){

        // var_dump($_POST);
        $username = $_POST['username'];
        $password = $_POST['password'];

        $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' ");

        // cek username
        if(mysqli_num_rows($result) === 1){

            // cek password
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row['password'])){
                // set session
                $_SESSION['session_login'] = true;
                $_SESSION['username'] = $username;

                header('Location: index.php');
                exit;
            }else{
                echo "<script>
                    alert('Password yang kamu masukkan salah!');
                    </script>
                ";  
            }
        }else{
            echo "<script>
                alert('Username yang kamu masukkan salah atau tidak ditemukan!');
                </script>
            ";
        }

    }

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kedai Kopi</title>

    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">

<div class="login-box">

    <div class="card card-outline card-primary">

        <div class="card-header text-center">
            <h2>Kedai Kopi</h2>
        </div>

        <div class="card-body login-card-body">

            <p class="login-box-msg">
                Silakan login untuk masuk ke sistem
            </p>

            <form action="login.php" method="POST">

                <!-- Username -->
                <div class="input-group mb-3">
                    <input type="text"
                           name="username"
                           class="form-control"
                           placeholder="Username"
                           required>

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>

                <!-- Password -->
                <div class="input-group mb-3">
                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Password"
                           required>

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <button type="submit" name="login" class="btn btn-primary btn-block">
                    Login
                </button>

            </form>

            <p class="mt-3 mb-0">
                <a href="registrasi.php">
                    Belum punya akun? Registrasi
                </a>
            </p>

        </div>
    </div>

</div>

<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/dist/js/adminlte.min.js"></script>

</body>
</html>
