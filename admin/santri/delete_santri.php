<?php 
session_start();

if (empty($_SESSION['admin'])) {
	echo "<center> Untuk mengakses modul, Anda harus Login<br>";
	echo "<a href=../login><b>LOGIN</b></a></center>";
} else {
	include "../../lib/koneksi.php";

	$no_daftar = $_GET['No_Pendaftaran'];

	$Hapus1 = mysqli_query($mysqli, "DELETE FROM nilai WHERE No_Pendaftaran='$no_daftar'");
	$Hapus2 = mysqli_query($mysqli, "DELETE FROM normalisasi WHERE No_Pendaftaran='$no_daftar'");
	$queryHapus = mysqli_query($mysqli, "DELETE FROM santri WHERE No_Pendaftaran='$no_daftar'");
	if ($queryHapus && $Hapus1 && $Hapus2) {
		echo "<script> alert ('Data Santri Berhasil Dihapus'); window.location='../santri';</script>";
	}else{
		echo "<script> alert ('Data Santri Gagal Dihapus'); window.location='../santri';</script>";
	}
}
?>
