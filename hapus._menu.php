<?php
session_start();
if (!isset($_SESSION["session_login"]) ){
    header('location: login.php');
    exit;
}

require 'function_menu.php';
$id_menu = $_GET['id_menu'];


if (hapus_data($id_menu) > 0) {
    echo "<script>
            alert('Data sudah berhasil dihapus!');
            document.location.href = 'index.php';
        </script>";

} else {
    echo "<script>
            alert('Data gagal dihapus!');
        </script>";
}
exit;
?>