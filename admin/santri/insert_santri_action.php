<?php
session_start();

if (empty($_SESSION['admin'])) {
	echo "<center> Untuk mengakses modul, Anda harus Login<br>";
	echo "<a href=../login><b>LOGIN</b></a></center>";
} else {
	include "../../lib/koneksi.php";
	
	$query = "SELECT max(No_Pendaftaran) as maxKode FROM santri";
	$hasil = mysqli_query($mysqli,$query);
	$data = mysqli_fetch_array($hasil);
	$kodesantri = $data['maxKode'];
	 
	// mengambil angka atau bilangan dalam kode anggota terbesar,
	// dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
	// misal 'BRG001', akan diambil '001'
	// setelah substring bilangan diambil lantas dicasting menjadi integer
	$noUrut = (int) substr($kodesantri, 4, 4);
	 
	// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
	$noUrut++;
	 
	// membentuk kode anggota baru
	// perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
	// misal sprintf("%03s", 12); maka akan dihasilkan '012'
	// atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
	$char = "S-";
	$kodesantri = $char . sprintf("%04s", $noUrut);
	echo $kodesantri;	


	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$nama = $_POST['nama'];
	$kuota= $_POST['kuota'];
	$smp = $_POST['smp'];
	$jarak = $_POST['jarak'];
	$penghasilan = $_POST['penghasilan'];
	$yatim = $_POST['yatim'];
	$lahir = $_POST['date-input'];
	$alamat = $_POST['alamat'];
	//echo $email;
	//echo $pass;
	//echo $nisn;
	//echo $nama;
	//echo $jurusan;
	//echo $smp;
	//echo $un;
	//echo $kelamin;
	//echo $lahir;
	//echo $alamat;

	$querySimpan = mysqli_query($mysqli, "INSERT INTO santri (No_Pendaftaran, Email, Password, Id_kuota, Nama, Tanggal_Lahir, Alamat, Asal_Sekolah, Jarak_Rumah,Penghasilan_Orang_Tua,Yatim_Piatu) VALUES ('$kodesantri', '$email', '$pass','$kuota', '$nama', '$lahir', '$alamat', '$smp', $jarak, $penghasilan, $yatim)");
	
	if ($querySimpan) {
		$querynilai = mysqli_query($mysqli, "INSERT INTO nilai (No_Pendaftaran, C1, C2, C3, C4, C5) VALUES ('$kodesantri', 0, 0, $jarak, $penghasilan,$yatim)");
		$querynormalisasi = mysqli_query($mysqli, "INSERT INTO normalisasi (No_Pendaftaran, C1, C2, C3, C4, C5) VALUES ('$kodesantri', 0, 0, 0, 0, 0)");
		echo "<script> alert ('Data Santri Berhasil Disimpan'); window.location='../santri';</script>";
	}else{
		echo "<script> alert ('Data Santri Gagal Disimpan'); window.location='../santri';</script>";
	}
}
?>
