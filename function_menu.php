<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "kedai_kopi");

// Menghitung jumlah menu
$jumlah_menu = query_db("SELECT COUNT(*) AS total FROM menu");


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

	$query = "SELECT * FROM menu
			  WHERE
			  nama_menu LIKE '%$keyword%' 
              OR kategori LIKE '%$keyword%'
              ORDER BY id_menu ASC ";

	return query_db($query);
}

function tambah_data($data){
	global $conn;

	$nama_menu = $data['nama_menu'];
	$kategori = $data['kategori'];
	$harga = $data['harga'];

	$query = "INSERT INTO menu(nama_menu, kategori, harga)
              VALUES ('$nama_menu', '$kategori', '$harga')
        	 ";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function hapus_data($id_menu)
{
    global $conn;

    $query = "DELETE FROM menu WHERE id_menu = $id_menu";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function edit_data($data)
{
    global $conn;

    $id_menu = $data['id_menu'];
    $nama_menu = $data['nama_menu'];
    $kategori = $data['kategori'];
    $harga = $data['harga'];

    $query = "UPDATE menu SET
    id_menu = '$id_menu',
    nama_menu = '$nama_menu',
    kategori = '$kategori',
    harga = '$harga'
    
    WHERE id_menu= $id_menu
    ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
?>