<?php 
session_start();

if (empty($_SESSION['admin'])) {
	echo "<center> Untuk mengakses modul, Anda harus Login<br>";
	echo "<a href=../login><b>LOGIN</b></a></center>";
} else {
	include "../../lib/koneksi.php";

	$no_daftar = $_POST['no_daftar'];
	$C1 = $_POST['C1'];
	$C2 = $_POST['C2'];
	$C3 = $_POST['C3'];
	$C4 = $_POST['C4'];
	$C5 = $_POST['C5'];
	
	$querySimpan = mysqli_query($mysqli, "UPDATE nilai SET C1=$C1, C2=$C2, C3=$C3, C4=$C4, C5=$C5 WHERE No_Pendaftaran='$no_daftar'");
	$query = mysqli_query($mysqli, "UPDATE santri SET Jarak_Rumah=$C3,Penghasilan_Orang_Tua=$C4,Yatim_Piatu=$C5 WHERE No_Pendaftaran='$no_daftar'");
	if ($querySimpan && $query) {
		echo "<script> alert ('Data Nilai Berhasil Disimpan'); window.location='../nilai';</script>";
	}else{
		echo "<script> alert ('Data Nilai Berhasil Disimpan'); window.location='../nilai';</script>";
	}
}
?>
