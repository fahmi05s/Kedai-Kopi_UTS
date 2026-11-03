<?php
session_start();
if (!isset($_SESSION["session_login"]) ){
    header('location: login.php');
    exit;
}

require 'function_karyawan.php';
$id_karyawan = $_GET['id_karyawan'];


if (hapus_data($id_karyawan) > 0) {
    echo "<script>
            alert('Data sudah berhasil dihapus!');
            document.location.href = 'karyawan.php';
        </script>";

} else {
    echo "<script>
            alert('Data gagal dihapus!');
        </script>";
}
exit;
?>