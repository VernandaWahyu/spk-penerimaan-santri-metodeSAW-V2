<?php 
session_start();
  include "../../lib/koneksi.php";
  $session_admin = $_SESSION['admin']; 
  if(isset($_SESSION['admin']))
  {
    include "../template/header.php";
?>
      <main class="main">
        <!-- Breadcrumb-->
        
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../dasboard">Home</a></li>
          <li class="breadcrumb-item"><a href="../laporan">Laporan</a></li>
          <!-- <li class="breadcrumb-item active"><?php echo $jurusan['Nama_Jurusan']; ?></li> -->
          <!-- Breadcrumb Menu-->
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">Laporan diterima </div>
                  <div class="card-body">
                    <div class="col-6 col-sm-4 col-md mb-3 mb-xl-0">
                      <a href="cetak_diterima.php" class="btn btn-primary">
                        <i class="fa fa-file"> Cetak Laporan</i>
                      </a>
                    </div>
                    <div>
                    <table class="table table-responsive-sm table-striped" style="margin-top: 20px">
                      <thead>
                        <tr>
                          <th>Ranking</th>
                          <th>No Pendaftaran</th>
                          <th>Nama</th>
                          <th>Asal Sekolah</th>
                          <th>Nilai Akhir</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $rank = 0;
                          $tampilpeserta = mysqli_query($mysqli, "SELECT * FROM santri  ORDER BY Nilai_Akhir DESC");
                          while($peserta = mysqli_fetch_array($tampilpeserta))
                          {
                            $rank = $rank + 1;
                        ?>
                        <tr>
                          <td><?php echo $rank; ?></td>
                          <td><?php echo $peserta['No_Pendaftaran']; ?></td>
                          <td><?php echo $peserta['Nama']; ?></td>
                          <td><?php echo $peserta['Asal_Sekolah']; ?></td>
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