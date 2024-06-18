<?php 
session_start();

if (empty($_SESSION['admin'])) {
	echo "<center> Untuk mengakses modul, Anda harus Login<br>";
	echo "<a href=../login><b>LOGIN</b></a></center>";
} else {
include "../../lib/koneksi.php";

$no_daftar = $_GET['No_Pendaftaran'];

$queryGetFile = mysqli_query($mysqli, "SELECT Bukti_Pembayaran FROM santri WHERE No_Pendaftaran='$no_daftar'");
if ($queryGetFile) {
    $data = mysqli_fetch_assoc($queryGetFile);
    $file_path1 = "../admin/pembayaran/uploads/" . $data['Bukti_Pembayaran']; // Path untuk folder pertama
    $file_path2 = "../uploads/" . $data['Bukti_Pembayaran']; // Path untuk folder kedua

    if (file_exists($file_path1)) {
        unlink($file_path1);
    }

    if (file_exists($file_path2)) {
        unlink($file_path2);
    }

    $queryHapus = mysqli_query($mysqli, "DELETE FROM pembayaran WHERE No_Pendaftaran='$no_daftar'");
    if ($queryHapus) {
        echo "<script> alert('Data Pembayaran Berhasil Dihapus'); window.location='../pembayaran';</script>";
    } else {
        echo "<script> alert('Data Pembayaran Gagal Dihapus'); window.location='../pembayaran';</script>";
    }
} else {
    echo "<script> alert('Data Pembayaran Tidak Ditemukan'); window.location='../pembayaran';</script>";
}
}
?>