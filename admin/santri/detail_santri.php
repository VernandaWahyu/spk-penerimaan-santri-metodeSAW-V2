<?php 
session_start();
  include "../../lib/koneksi.php";
  $no_daftar=$_GET['No_Pendaftaran'];
  $session_admin = $_SESSION['admin']; 
  if(isset($_SESSION['admin']))
  {
    include "../template/header.php";
?>
      <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="../santri">Santri</a></li>
          <li class="breadcrumb-item active">Detail Santri</li>
        </ol>
        <?php  
          $tampilpeserta = mysqli_query($mysqli, "SELECT Email, Nama, Tanggal_Lahir, Alamat, Asal_Sekolah, Jarak_Rumah,Penghasilan_Orang_Tua,Yatim_Piatu, Nilai_Akhir, Kuota FROM santri p join kuota j on p.Id_kuota = j.Id_kuota where No_Pendaftaran = '$no_daftar'");
          $santri = mysqli_fetch_assoc($tampilpeserta);

          $tampilranking = mysqli_query($mysqli, "SELECT DISTINCT No_Pendaftaran, Nama, Nilai_Akhir, Ranking FROM (SELECT No_Pendaftaran, Nama, Nilai_Akhir, @ranking := @ranking + 1 AS Ranking FROM santri, (SELECT @ranking := 0) AS r ORDER BY Nilai_Akhir DESC) AS ranked_peserta WHERE No_Pendaftaran = '$no_daftar'");

          $ranking = mysqli_fetch_assoc($tampilranking);
        ?>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row justify-content-center">
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header">Data Santri</div>
                  <form>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="callout callout-info">
                            <small class="text-muted">Nilai Akhir</small>
                            <br>
                            <strong class="h4">
                              <?php 
                                if ($santri['Nilai_Akhir'] == NULL) {
                                  echo "0";
                                } else {
                                  echo $santri['Nilai_Akhir'];
                                }
                              ?>
                            </strong>
                            <div class="chart-wrapper">
                              <canvas id="sparkline-chart-1" width="100" height="30"></canvas>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="callout callout-danger">
                            <small class="text-muted">Ranking</small>
                            <br>
                            <strong class="h4">
                              <?php 
                                echo $ranking['Ranking'];
                              ?>
                            </strong>
                            <div class="chart-wrapper">
                              <canvas id="sparkline-chart-1" width="100" height="30"></canvas>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <?php 
                  if ($ranking['Ranking'] <= $santri['Kuota']) {
                ?>
                <div class="card text-white bg-success">
                  <div class="card-body">
                    <div class="text-value"><center>Diterima</center></div>
                    <div>Selamat, Anda dinyatakan diterima sebagai santri penghuni asrama</div>
                  </div>
                </div>
                <?php
                  }else{
                ?>
                <div class="card text-white bg-danger">
                  <div class="card-body">
                    <div class="text-value"><center>Tidak Diterima</center></div>
                    <div>Mohon Maaf, Anda belum diterima sebagai santri penghuni asrama </div>
                  </div>
                </div>
                <?php  
                  }
                ?>
                
              </div>
              <div class="col-md-8">
                <div class="card">
                  <div class="card-header">Detail Data Peserta</div>
                  <div class="card-body">
                    <div class="bd-example">
                      <dl class="row">
                        <dt class="col-sm-3">No Pendaftaran</dt>
                        <dd class="col-sm-9"><?php echo $no_daftar; ?></dd>
                      </dl>
                      <dl class="row">
                        <dt class="col-sm-3">Email</dt>
                        <dd class="col-sm-9"><?php echo $santri['Email']; ?></dd>
                      </dl>
                      <hr class="mt-0">
                      <dl class="row">
                        <dt class="col-sm-3">Nama</dt>
                        <dd class="col-sm-9"><?php echo $santri['Nama']; ?></dd>
                      </dl>
                      <dl class="row">
                        <dt class="col-sm-3">Tanggal Lahir</dt>
                        <dd class="col-sm-9">
                          <?php 
                            $originalDate = $santri['Tanggal_Lahir'];
                            $newDate = date("d-m-Y", strtotime($originalDate));
                            echo $newDate;
                          ?>
                        </dd>
                      </dl>
                      <dl class="row">
                        <dt class="col-sm-3">Alamat</dt>
                        <dd class="col-sm-9"><?php echo $santri['Alamat']; ?></dd>
                      </dl>
                      <hr class="mt-0">
                      <dl class="row">
                        <dt class="col-sm-3">Asal Sekolah</dt>
                        <dd class="col-sm-9"><?php echo $santri['Asal_Sekolah']; ?></dd>
                      </dl>
                      <dl class="row">
                        <dt class="col-sm-3">Jarak Rumah</dt>
                        <dd class="col-sm-9">
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
                        </dd>
                      </dl>
                      <dl class="row">
                        <dt class="col-sm-3">Penghasilan Orang Tua</dt>
                        <dd class="col-sm-9">
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
                          </dd>
                      </dl>
                      <dl class="row">
                        <dt class="col-sm-3">Yatim Piatu</dt>
                        <dd class="col-sm-9">
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
                          </dd>
                      </dl>
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