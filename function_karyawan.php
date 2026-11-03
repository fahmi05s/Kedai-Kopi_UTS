<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "kedai_kopi");

// Menghitung jumlah produk
$jumlah_karyawan = query_db("SELECT COUNT(*) AS total FROM karyawan");


// Fungsi menampilkan data
function query_db($query) {
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}


function cari_data($keyword) {
	global $conn;

	$keyword = mysqli_real_escape_string($conn, $keyword);

	$query = "SELECT * FROM karyawan
			  WHERE
			  nama_karyawan LIKE '%$keyword%' 
              OR jabatan LIKE '%$keyword%'
              OR alamat LIKE '%$keyword%'
              ORDER BY id_karyawan ASC ";

	return query_db($query);
}

function tambah_data($data){
	global $conn;

	$nama_karyawan = $data['nama_karyawan'];
	$jabatan = $data['jabatan'];
	$no_hp = $data['no_hp'];
	$alamat = $data['alamat'];

	$query = "INSERT INTO karyawan(nama_karyawan, jabatan, no_hp, alamat)
              VALUES ('$nama_karyawan', '$jabatan', '$no_hp','$alamat')
        	 ";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function hapus_data($id)
{
    global $conn;

    $query = "DELETE FROM karyawan WHERE id_karyawan = $id";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function edit_data($data)
{
    global $conn;

    $id_karyawan = (int) $data['id_karyawan'];
    $nama_karyawan = $data['nama_karyawan'];
    $jabatan = $data['jabatan'];
    $no_hp = $data['no_hp'];
    $alamat = $data['alamat'];

    $query = "UPDATE karyawan SET
        nama_karyawan = '$nama_karyawan',
        jabatan = '$jabatan',
        no_hp = '$no_hp',
        alamat = '$alamat'
        WHERE id_karyawan = $id_karyawan
    ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
?>