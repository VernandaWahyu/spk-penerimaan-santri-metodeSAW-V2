<?php 
session_start();
  include "../../lib/koneksi.php";
  $id_jurusan=$_GET['id_jurusan'];
  $session_admin = $_SESSION['admin']; 
  if(isset($_SESSION['admin']))
  {
    $tampilmax = mysqli_query($mysqli, "SELECT MAX(C1) as maxC1, MAX(C2) as maxC2, MAX(C3) as maxC3, MAX(C4) as maxC4, MAX(C5) as maxC5 FROM peserta p join jurusan j on p.Id_Jurusan=j.Id_Jurusan join nilai n on p.No_Pendaftaran = n.No_Pendaftaran where p.Id_Jurusan = $id_jurusan");
    $maksimal = mysqli_fetch_assoc($tampilmax);

    $i=1;
    $tampilbobot = mysqli_query($mysqli, "SELECT Bobot from kriteria");
    while($bobot_kriteria = mysqli_fetch_assoc($tampilbobot)){
    $bobot[$i] = $bobot_kriteria['Bobot'];
    $i++;
    }

    $jumlah = 1;
    $tampilpeserta = mysqli_query($mysqli, "SELECT p.No_Pendaftaran, Nama, C1, C2, C3, C4, C5 FROM peserta p join jurusan j on p.Id_Jurusan=j.Id_Jurusan join nilai n on p.No_Pendaftaran = n.No_Pendaftaran where p.Id_Jurusan = $id_jurusan");
    while($peserta = mysqli_fetch_array($tampilpeserta))
    {
      $nomor[$jumlah] = $peserta['No_Pendaftaran'];
      $C1[$jumlah] = $peserta['C1'];
      $C2[$jumlah] = $peserta['C2'];
      $C3[$jumlah] = $peserta['C3'];
      $C4[$jumlah] = $peserta['C4'];
      $C5[$jumlah] = $peserta['C5'];
      $jumlah = $jumlah + 1;
      }

      for ($j=1; $j < $jumlah ; $j++) { 
        $normalC1[$j] = $C1[$j] / $maksimal['maxC1'];
        $normalC2[$j] = $C2[$j] / $maksimal['maxC2'];
        $normalC3[$j] = $C3[$j] / $maksimal['maxC3'];
        $normalC4[$j] = $C4[$j] / $maksimal['maxC4'];
        $normalC5[$j] = $C5[$j] / $maksimal['maxC5'];
        $simpan = mysqli_query($mysqli, "UPDATE normalisasi SET C1=$normalC1[$j], C2=$normalC2[$j], C3=$normalC3[$j], C4=$normalC4[$j], C5=$normalC5[$j], where No_Pendaftaran = '$nomor[$j]'");

        $akhir = ($normalC1[$j] * $bobot[1]) + ($normalC2[$j] * $bobot[2]) + ($normalC3[$j] * $bobot[3]) + ($normalC4[$j] * $bobot[4]) + ($normalC5[$j] * $bobot[5]);
        $totalakhir = number_format($akhir,6);
        $simpan_nilai = mysqli_query($mysqli, "UPDATE peserta SET Nilai_Akhir = $totalakhir where No_Pendaftaran = '$nomor[$j]'");
      }
      
    include "../template/header.php";
?>
      <main class="main">
        <!-- Breadcrumb-->
        <?php 
          $tampiljurusan = mysqli_query($mysqli, "SELECT * FROM jurusan where Id_Jurusan = $id_jurusan");
          $jurusan = mysqli_fetch_assoc($tampiljurusan);
        ?>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="../normalisasi">Normalisasi</a></li>
          <li class="breadcrumb-item active"><?php echo $jurusan['Nama_Jurusan']; ?></li>
          <!-- Breadcrumb Menu-->
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">Data Normalisasi <?php echo $jurusan['Nama_Jurusan']; ?></div>
                  <div class="card-body">
                    <h3>Nilai Alternatif Kriteria</h3>
                    <table class="table table-responsive-sm table-striped" style="margin-top: 20px">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <?php
                            $tampilkriteria = mysqli_query($mysqli, "SELECT * FROM kriteria");
                            while($kriteria = mysqli_fetch_array($tampilkriteria))
                            {
                          ?>
                          <th><?php echo$kriteria['Nama_Kriteria']; ?></th>
                          <?php 
                            } 
                          ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $tampilpeserta = mysqli_query($mysqli, "SELECT p.No_Pendaftaran, Nama, Nama_Jurusan, C1, C2, C3, C4, C5 FROM peserta p join jurusan j on p.Id_Jurusan=j.Id_Jurusan join nilai n on p.No_Pendaftaran = n.No_Pendaftaran where p.Id_Jurusan = $id_jurusan");
                          while($peserta = mysqli_fetch_array($tampilpeserta))
                          {
                        ?>
                        <tr>
                          <td><?php echo $peserta['No_Pendaftaran']; ?></td>
                          <td><?php echo $peserta['Nama']; ?></td>
                          <td><?php echo $peserta['C1']; ?></td>
                          <td><?php echo $peserta['C2']; ?></td>
                          <td><?php echo $peserta['C3']; ?></td>
                          <td><?php echo $peserta['C4']; ?></td>
                          <td><?php echo $peserta['C5']; ?></td>
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
                            while($kriteria = mysqli_fetch_array($tampilkriteria))
                            {
                          ?>
                          <th><?php echo$kriteria['Nama_Kriteria']; ?></th>
                          <?php 
                            } 
                          ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $tampilpeserta = mysqli_query($mysqli, "SELECT p.No_Pendaftaran, Nama, Nama_Jurusan, C1, C2, C3, C4, C5 FROM peserta p join jurusan j on p.Id_Jurusan=j.Id_Jurusan join normalisasi n on p.No_Pendaftaran = n.No_Pendaftaran where p.Id_Jurusan = $id_jurusan");
                          while($peserta = mysqli_fetch_array($tampilpeserta))
                          {
                        ?>
                        <tr>
                          <td><?php echo $peserta['No_Pendaftaran']; ?></td>
                          <td><?php echo $peserta['Nama']; ?></td>
                          <td><?php echo $peserta['C1']; ?></td>
                          <td><?php echo $peserta['C2']; ?></td>
                          <td><?php echo $peserta['C3']; ?></td>
                          <td><?php echo $peserta['C4']; ?></td>
                          <td><?php echo $peserta['C5']; ?></td>
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
                          $tampilpeserta = mysqli_query($mysqli, "SELECT * FROM peserta p join jurusan j on p.Id_Jurusan=j.Id_Jurusan where p.Id_Jurusan = $id_jurusan ORDER BY Nilai_Akhir DESC");
                          while($peserta = mysqli_fetch_array($tampilpeserta))
                          {
                            $rank = $rank + 1;
                        ?>
                        <tr>
                          <td><?php echo $rank; ?></td>
                          <td><?php echo $peserta['No_Pendaftaran']; ?></td>
                          <td><?php echo $peserta['Nama']; ?></td>
                          <td><?php echo $peserta['Nilai_Akhir']; ?></td>
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
  }
  else
  {
    header("location: ../login/");
  } 
?>