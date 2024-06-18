<?php 
session_start();

if (empty($_SESSION['admin'])) {
	echo "<center> Untuk mengakses modul, Anda harus Login<br>";
	echo "<a href=../login><b>LOGIN</b></a></center>";
} else {
	include "../../lib/koneksi.php";

	$id_kuota = $_POST['id_kuota'];
	$kuota = $_POST['kuota'];

	$querySimpan = mysqli_query($mysqli, "UPDATE kuota SET Kuota=$kuota WHERE Id_kuota=$id_kuota");
	if ($querySimpan) {
		echo "<script> alert ('Data Kuota Berhasil Disimpan'); window.location='../kuota';</script>";
	}else{
		echo "<script> alert ('Data Kuota Gagal Disimpan'); window.location='../kuota';</script>";
	}
}
?>
