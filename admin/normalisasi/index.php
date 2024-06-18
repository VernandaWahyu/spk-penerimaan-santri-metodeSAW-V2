<?php 
session_start();
include "../../lib/koneksi.php";
$session_admin = $_SESSION['admin']; 

if (isset($_SESSION['admin'])) {
    $tampilmax = mysqli_query($mysqli, "SELECT MAX(C1) as maxC1, MAX(C2) as maxC2, MAX(C3) as maxC3, MAX(C4) as maxC4, MAX(C5) as maxC5 FROM santri p JOIN nilai n ON p.No_Pendaftaran = n.No_Pendaftaran");
    $maksimal = mysqli_fetch_assoc($tampilmax);

    $i = 1;
    $tampilbobot = mysqli_query($mysqli, "SELECT Bobot FROM kriteria");
    while ($bobot_kriteria = mysqli_fetch_assoc($tampilbobot)) {
        $bobot[$i] = $bobot_kriteria['Bobot'];
        $i++;
    }

    $tampilsantri = mysqli_query($mysqli, "SELECT p.No_Pendaftaran, Nama, C1, C2, C3, C4, C5 FROM santri p JOIN nilai n ON p.No_Pendaftaran = n.No_Pendaftaran");
    while ($santri = mysqli_fetch_array($tampilsantri)) {
        $nomor = $santri['No_Pendaftaran'];
        $normalC1 = number_format($santri['C1'] / $maksimal['maxC1'], 6);
        $normalC2 = number_format($santri['C2'] / $maksimal['maxC2'], 6);
        $normalC3 = number_format($santri['C3'] / $maksimal['maxC3'], 6);
        $normalC4 = number_format($santri['C4'] / $maksimal['maxC4'], 6);
        $normalC5 = number_format($santri['C5'] / $maksimal['maxC5'], 6);

        $simpan = mysqli_query($mysqli, "UPDATE normalisasi SET C1=$normalC1, C2=$normalC2, C3=$normalC3, C4=$normalC4, C5=$normalC5 WHERE No_Pendaftaran = '$nomor'");

        $akhir = number_format(($normalC1 * $bobot[1]) + ($normalC2 * $bobot[2]) + ($normalC3 * $bobot[3]) + ($normalC4 * $bobot[4]) + ($normalC5 * $bobot[5]), 6);
        $simpan_nilai = mysqli_query($mysqli, "UPDATE santri SET Nilai_Akhir = $akhir WHERE No_Pendaftaran = '$nomor'");
    }

    include "../template/header.php";
?>
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
        <li class="breadcrumb-item"><a href="../normalisasi">Normalisasi</a></li>
        <li class="breadcrumb-item active">All Participants</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Data Normalisasi All Participants</div>
                        <div class="card-body">
                            <h3>Nilai Alternatif Kriteria</h3>
                            <table class="table table-responsive-sm table-striped" style="margin-top: 20px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <?php
                                        $tampilkriteria = mysqli_query($mysqli, "SELECT * FROM kriteria");
                                        while ($kriteria = mysqli_fetch_array($tampilkriteria)) {
                                        ?>
                                            <th><?php echo $kriteria['Nama_Kriteria']; ?></th>
                                        <?php 
                                        } 
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $tampilsantri = mysqli_query($mysqli, "SELECT p.No_Pendaftaran, Nama, C1, C2, C3, C4, C5 FROM santri p JOIN nilai n ON p.No_Pendaftaran = n.No_Pendaftaran");
                                    while ($santri = mysqli_fetch_array($tampilsantri)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $santri['No_Pendaftaran']; ?></td>
                                        <td><?php echo $santri['Nama']; ?></td>
                                        <td><?php if ($santri['C1'] > 85 && $santri['C1'] <= 100) {
                                echo 4;
                            } elseif ($santri['C1'] > 70 && $santri['C1'] <= 85) {
                                echo 3;
                            } elseif ($santri['C1'] > 55 && $santri['C1'] <= 70) {
                                echo 2;
                            } elseif ($santri['C1'] > 0 && $santri['C1'] <= 55) {
                                echo 1;
                            } else {
                                echo 0; // Default value for invalid input
                            }
                          ?></td>
                          <td><?php if ($santri['C2'] > 85 && $santri['C2'] <= 100) {
                                echo 4;
                            } elseif ($santri['C2'] > 70 && $santri['C2'] <= 85) {
                                echo 3;
                            } elseif ($santri['C2'] > 55 && $santri['C2'] <= 70) {
                                echo 2;
                            } elseif ($santri['C2'] > 0 && $santri['C2'] <= 55) {
                                echo 1;
                            } else {
                                echo 0; // Default value for invalid input
                            }
                          ?></td>
                          <td><?php 
                          if ($santri['C3'] >76 ) {
                              echo 4;
                          } elseif ($santri['C3'] >= 5 && $santri['C3'] < 76) {
                              echo 3;
                          } elseif ($santri['C3'] >= 10 && $santri['C3'] < 51) {
                              echo 2;
                          } elseif ($santri['C3'] >= 0) {
                              echo 1;
                          } else {
                              echo 0; // Default value for invalid input
                          }
                          ?>
                          </td>
                          <td><?php 
                          if ($santri['C4'] >76 ) {
                              echo 4;
                          } elseif ($santri['C4'] >= 5 && $santri['C4'] < 76) {
                              echo 3;
                          } elseif ($santri['C4'] >= 10 && $santri['C4'] < 51) {
                              echo 2;
                          } elseif ($santri['C4'] >= 0) {
                              echo 1;
                          } else {
                              echo 0; // Default value for invalid input
                          }
                          ?></td>
                          <td><?php 
                          if ($santri['C5'] == 100) {
                              echo 4;
                          } elseif ($santri['C5'] == 55) {
                              echo 3;
                          } elseif ($santri['C5'] == 50) {
                              echo 2;
                          } elseif ($santri['C5'] == 0) {
                              echo 1;
                          } else {
                              echo 0; // Default value for invalid input
                          }
                          ?>
                          </td>
                                    </tr>
                                    <?php 
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <h3>Nilai Normalisasi R</h3>
                            <table class="table table-responsive-sm table-striped" style="margin-top: 20px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <?php  
                                        $tampilkriteria = mysqli_query($mysqli, "SELECT * FROM kriteria");
                                        while ($kriteria = mysqli_fetch_array($tampilkriteria)) {
                                        ?>
                                            <th><?php echo $kriteria['Nama_Kriteria']; ?></th>
                                        <?php 
                                        } 
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $tampilsantri = mysqli_query($mysqli, "SELECT p.No_Pendaftaran, Nama, C1, C2, C3, C4, C5 FROM santri p JOIN normalisasi n ON p.No_Pendaftaran = n.No_Pendaftaran");
                                    while ($santri = mysqli_fetch_array($tampilsantri)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $santri['No_Pendaftaran']; ?></td>
                                        <td><?php echo $santri['Nama']; ?></td>
                                        <td><?php echo $santri['C1']; ?></td>
                                        <td><?php echo $santri['C2']; ?></td>
                                        <td><?php echo $santri['C3']; ?></td>
                                        <td><?php echo $santri['C4']; ?></td>
                                        <td><?php echo $santri['C5']; ?></td>
                                    </tr>
                                    <?php 
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <h3>Nilai Akhir</h3>
                            <div class="col-md-6">
                                <table class="table table-responsive-sm table-striped" style="margin-top: 20px">
                                    <thead>
                                        <tr>
                                            <th>Ranking</th>
                                            <th>No Pendaftaran</th>
                                            <th>Nama</th>
                                            <th>Nilai Akhir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $rank = 0;
                                        $tampilsantri = mysqli_query($mysqli, "SELECT * FROM santri ORDER BY Nilai_Akhir DESC");
                                        while ($santri = mysqli_fetch_array($tampilsantri)) {
                                            $rank = $rank + 1;
                                        ?>
                                        <tr>
                                            <td><?php echo $rank; ?></td>
                                            <td><?php echo $santri['No_Pendaftaran']; ?></td>
                                            <td><?php echo $santri['Nama']; ?></td>
                                            <td><?php echo $santri['Nilai_Akhir']; ?></td>
                                        </tr>
                                        <?php 
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- /.row-->
        </div>
    </div>
</main>
<?php
    include "../template/footer.php";
} else {
    header("location: ../login/");
}
?>
