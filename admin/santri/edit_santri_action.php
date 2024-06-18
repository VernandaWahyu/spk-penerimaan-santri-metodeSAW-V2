<?php 
session_start();

if (empty($_SESSION['admin'])) {
	echo "<center> Untuk mengakses modul, Anda harus Login<br>";
	echo "<a href=../login><b>LOGIN</b></a></center>";
} else {
	include "../../lib/koneksi.php";

	$no_daftar = $_POST['no_daftar'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$nama = $_POST['nama'];
	$kuota = $_POST['kuota'];
	$smp = $_POST['smp'];
	$jarak = $_POST['jarak'];
	$penghasilan = $_POST['penghasilan'];
	$yatim = $_POST['yatim'];
	$lahir = $_POST['date-input'];
	$alamat = $_POST['alamat'];

	$querySimpan = mysqli_query($mysqli, "UPDATE santri SET Email='$email', Password='$pass', Id_kuota=$kuota, Nama='$nama', Tanggal_Lahir='$lahir', Alamat='$alamat', Asal_Sekolah='$smp', Jarak_Rumah=$jarak,Penghasilan_Orang_Tua=$penghasilan,Yatim_Piatu=$yatim WHERE No_Pendaftaran='$no_daftar'");
	$queryNilai = mysqli_query($mysqli, "UPDATE nilai SET C3 = $jarak,C4 = $penghasilan,C5 = $yatim WHERE No_Pendaftaran = '$no_daftar'");
	if ($querySimpan && $queryNilai) {
		echo "<script> alert ('Data Santri Berhasil Disimpan'); window.location='../santri';</script>";
	}else{
		echo "<script> alert ('Data Santri Gagal Disimpan'); window.location='../santri';</script>";
	}
}
?>
