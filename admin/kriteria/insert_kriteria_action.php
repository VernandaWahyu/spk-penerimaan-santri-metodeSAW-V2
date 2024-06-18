<?php
session_start();

if (empty($_SESSION['admin'])) {
	echo "<center> Untuk mengakses modul, Anda harus Login<br>";
	echo "<a href=../login><b>LOGIN</b></a></center>";
} else {
	include "../../lib/koneksi.php";
	
	$nama_kriteria = $_POST['nama_kriteria'];
	$bobot = $_POST['bobot'];

	$querySimpan = mysqli_query($mysqli, "INSERT INTO kriteria (Nama_Kriteria, Bobot) VALUES ('$nama_kriteria', $bobot)");
	if ($querySimpan) {
		echo "<script> alert ('Data Kriteria Berhasil Disimpan'); window.location='../kriteria';</script>";
	}else{
		echo "<script> alert ('Data Kriteria Gagal Disimpan'); window.location='../kriteria';</script>";
	}
}
?>
