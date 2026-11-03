<?php
$conn = mysqli_connect("localhost", "root", "", "kedai_kopi");
function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $konfirmasi_password = mysqli_real_escape_string($conn, $data["konfirmasi_password"]);

    // cek username apabila sudah ada di database atau belum
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
				alert('Username sudah terdaftar! Gunakan username lainnya!');
			 </script>
		";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $konfirmasi_password) {
        echo "<script>
				alert('Konfirmasi password tidak sesuai!');
			 </script>
		";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$password')");
    return mysqli_affected_rows($conn);

}

?>