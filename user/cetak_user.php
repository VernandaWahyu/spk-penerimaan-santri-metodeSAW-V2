<?php 
session_start();
include "../lib/koneksi.php";
if (isset($_SESSION['user'])) {
    $session_user = $_SESSION['user']; 
    $tampilsantri = mysqli_query($mysqli, "SELECT Email, Nama, kuota, Tanggal_Lahir, Alamat, Asal_Sekolah, Jarak_Rumah, Penghasilan_Orang_Tua, Yatim_Piatu, Nilai_Akhir FROM santri p JOIN kuota j ON p.Id_kuota = j.Id_kuota WHERE No_Pendaftaran = '$session_user'");
    $santri = mysqli_fetch_assoc($tampilsantri);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bukti Pendaftaran <?php echo $session_user; ?> - <?php echo $santri['Nama']; ?></title>
</head>
<body>
    <center>
        <h2>Sekolah Menengah Kejuruan Negeri 1 Jenangan</h2>
        <h6>Jl. Niken Gandini No.98, Plampitan, Setono, Kec. Jenangan, Kabupaten Ponorogo, Jawa Timur 63492</h6>
    </center>
    <hr>
    <br/>
    <center>
        <h3>Bukti Pendaftaran Calon santri Didik</h3>
        <table border="0">
            <tr>
                <td>No Pendaftaran</td>
                <td>:</td>
                <td><?php echo $session_user; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><?php echo $santri['Email']; ?></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?php echo $santri['Nama']; ?></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td><?php echo date("d-m-Y", strtotime($santri['Tanggal_Lahir'])); ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?php echo $santri['Alamat']; ?></td>
            </tr>
            <tr>
                <td>Asal Sekolah</td>
                <td>:</td>
                <td><?php echo $santri['Asal_Sekolah']; ?></td>
            </tr>
            <tr>
                <td>Jarak Rumah</td>
                <td>:</td>
                <td>
					<?php if ($santri['Jarak_Rumah'] == 100  ) {
                                echo "< 5 km";
                            } elseif ($santri['Jarak_Rumah'] == 75 ) {
                                echo "5 s.d < 10 km";
                            } elseif ($santri['Jarak_Rumah'] == 50 ) {
                                echo ">10 s.d < 15 km";
                            } elseif ($santri['Jarak_Rumah'] > 0 ) {
                                echo "> 15 km";
                            } else {
                                echo 0; // Default value for invalid input
                            }
                          ?>
						  </td>
            </tr>
            <tr>
                <td>Penghasilan Orang Tua</td>
                <td>:</td>
                <td>
					<?php if ($santri['Penghasilan_Orang_Tua'] == 100 ) {
                                echo "<= 1.000.000";
                            } elseif ($santri['Penghasilan_Orang_Tua'] == 75 ) {
                                echo ">1.000.000 s.d <= 2.000.000";
                            } elseif ($santri['Penghasilan_Orang_Tua'] == 50 ) {
                                echo ">2.000.000 s.d <= 3.000.000";
                            } elseif ($santri['Penghasilan_Orang_Tua'] == 0 ) {
                                echo ">= 3.000.000";
                            } else {
                                echo 0; // Default value for invalid input
                            }
                    ?>
			</td>
            </tr>
            <tr>
                <td>Yatim Piatu</td>
                <td>:</td>
                <td>
					<?php if ($santri['Yatim_Piatu'] == 100 ) {
                                echo "Yatim Piatu";
                            } elseif ($santri['Yatim_Piatu'] == 75 ) {
                                echo ">Yatim";
                            } elseif ($santri['Yatim_Piatu'] == 50 ) {
                                echo ">Piatu";
                            } elseif ($santri['Yatim_Piatu'] == 0 ) {
                                echo "Tidak";
                            } else {
                                echo 0; // Default value for invalid input
                            }
                    ?>
			</td>
            </tr>
        </table>
    </center>
    <script>
        setTimeout(function() {
            window.print();
            window.location = '../user';
        }, 1000); // Delay printing and redirection by 1 second
    </script>
</body>
</html>
<?php 
} else {
    header("Location: ../login/");
    exit();
}
?>
