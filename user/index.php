<?php 
session_start();
  include "../lib/koneksi.php";
  $session_user = $_SESSION['user']; 
  if(isset($_SESSION['user']))
  {
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>SPK-Penerimaan-Santri</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Unicat project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../styles/bootstrap4/bootstrap.min.css">
<link href="../plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="../plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="../plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="../styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="../styles/responsive.css">
</head>
<body>

<div class="super_container">
	<!-- Header -->

	<header class="header">

		<!-- Top Bar -->
		<div class="top_bar">
			<div class="top_bar_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
								<ul class="top_bar_contact_list ml-auto">
									<li>
										<i class="fa fa-phone" aria-hidden="true"></i>
										<div>001-1234-88888</div>
									</li>
									<li>
										<i class="fa fa-envelope-o" aria-hidden="true"></i>
										<div>HyDeveloper@gmail.com</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>				
		</div>
	</header>

	<!-- Features -->
  <?php
if (isset($_SESSION['notifikasi'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['notifikasi'] . "</div>";
    unset($_SESSION['notifikasi']);
}
?>
	<div class="popular">
		<div class="section_background parallax-window" data-parallax="scroll" data-image-src="images/courses_background.jpg" data-speed="0.8"></div>
		<div class="container">
			<div class="row courses_row justify-content-center">
				
				<?php  
		          $tampilsantri = mysqli_query($mysqli, "SELECT Email, Nama,  Tanggal_Lahir, Alamat, Asal_Sekolah, Nilai_Akhir, Id_kuota ,Jarak_Rumah, Penghasilan_Orang_Tua, Yatim_Piatu, C1, C2, C3, C4, C5 FROM santri p join nilai n on p.No_Pendaftaran = n.No_Pendaftaran where p.No_Pendaftaran = '$session_user'");
		          $santri = mysqli_fetch_assoc($tampilsantri);

              $tampilkuota = mysqli_query($mysqli, "SELECT Kuota from kuota");
		          $kuota = mysqli_fetch_assoc($tampilkuota);

		          $tampilranking = mysqli_query($mysqli, "SELECT DISTINCT Id_kuota, No_Pendaftaran, Nama, Nilai_Akhir, Ranking FROM (SELECT Id_kuota, No_Pendaftaran, Nama, Nilai_Akhir, @santri:=CASE WHEN @Kuota <> Id_kuota THEN 1 ELSE @santri+1 END AS Ranking, @Kuota:=Id_kuota AS Kuota FROM(SELECT @santri:= 0) AS P, (SELECT @Kuota:= 0) AS J, (SELECT * FROM santri GROUP BY Id_kuota, Nilai_Akhir ORDER BY Id_kuota, Nilai_Akhir DESC) AS temp) AS temp2 where No_Pendaftaran = '$session_user'");
		          $ranking = mysqli_fetch_assoc($tampilranking);

              $i = 1;
              $tampilkriteria = mysqli_query($mysqli, "SELECT * FROM kriteria");
              while($kriteria = mysqli_fetch_assoc($tampilkriteria)){
                $C[$i] = $kriteria['Nama_Kriteria'];
                $i++;
              }
		        ?>

				<!-- Features Item -->
				<div class="col-md-4">
                <div class="card">
                  <div class="card-header">Data santri</div>
                  <form>
                    <div class="card-body">
                      <div class="row justify-content-center">
                        <div class="col-sm-6">
                          <div class="callout callout-info">
                            <small class="text-muted">Nilai Akhir</small>
                            <br>
                            <strong class="h4">
                              <?php 
                                if ($santri['Nilai_Akhir'] == NULL) {
                                  echo "Belum Mengikuti Test";
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
                        <div class="col-md-10">
                        	  
		                      <a href="cetak_user.php" class="btn btn-info btn-block">
		                        <i class="fa fa-print"> Cetak</i>
		                      </a>
                        	  <a href="../logout_user.php" class="btn btn-primary btn-block">
		                        <i class="fa fa-lock"> Logout</i>
		                      </a>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <br>
                <?php 
                  if ($ranking['Ranking'] <= $kuota['Kuota']) {
                  ?>
                      <div class="card text-white bg-success">
                          <div class="card-body">
                              <div class="text-value"><center>Lulus</center></div>
                              <div>Selamat, Anda dinyatakan diterima sebagai penghuni asrama.</div>
                          </div>
                      </div>
                      <div class="container my-3">
                  <div class="row justify-content-center">
                      <div class="col-md-10">
                          <div class="card">
                              <div class="card-body">
                                  <?php if (empty($santri['Bukti_Pembayaran'])) { ?>
                                      <h5 class="card-title">Silakan Unggah Bukti Pembayaran</h5>
                                      <form action="upload.php" method="post" enctype="multipart/form-data">
                                          <div class="form-group">
                                              <label for="No_Pendaftaran">No Pendaftaran:</label>
                                              <input type="text" class="form-control" name="No_Pendaftaran" id="No_Pendaftaran" required>
                                          </div>
                                          <div class="form-group">
                                              <label for="bukti_pembayaran">Upload Bukti Pembayaran:</label>
                                              <input type="file" class="form-control-file" name="bukti_pembayaran" id="bukti_pembayaran" required>
                                          </div>
                                          <button type="submit" class="btn btn-primary">Upload</button>
                                      </form>
                                  <?php } else { ?>
                                      <div class="alert alert-success" role="alert">
                                          Bukti pembayaran telah diunggah. Terima kasih.
                                      </div>
                                  <?php } ?>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
                  <?php
                  } else {
                  ?>
                      <div class="card text-white bg-danger">
                          <div class="card-body">
                              <div class="text-value"><center>Tidak Lulus</center></div>
                              <div>Mohon Maaf, Anda belum diterima sebagai penghuni asrama.</div>
                          </div>
                      </div>
                  <?php  
                  }
                  ?>
                 <div class="container my-3">
                  <div class="row justify-content-center">
                      <div class="col-md-10">
                          
                      </div>
                  </div>
              </div>
              </div>
              <div class="col-md-8">
                <div class="card">
                  <div class="card-header">Detail Data santri</div>
                  <div class="card-body">
                    <div class="bd-example">
                      <dl class="row">
                        <dt class="col-sm-3">No Pendaftaran</dt>
                        <dd class="col-sm-9"><?php echo $session_user; ?></dd>
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
                        <dt class="col-sm-3">Nilai <?php echo $C[1]; ?></dt>
                        <dd class="col-sm-9">
                          <?php 
                                if ($santri['C1'] == 0) {
                                  echo "Belum Melakukan Test";
                                } else {
                                  echo $santri['C1'];
                                }
                          ?>
                        </dd>
                      </dl>
                      <dl class="row">
                        <dt class="col-sm-3">Nilai <?php echo $C[2]; ?></dt>
                        <dd class="col-sm-9">
                          <?php 
                                if ($santri['C2'] == 0) {
                                  echo "Belum Melakukan Test";
                                } else {
                                  echo $santri['C2'];
                                }
                          ?>
                        </dd>
                      </dl>
                      <dl class="row">
                        <dt class="col-sm-3">Nilai <?php echo $C[3]; ?></dt>
                        <dd class="col-sm-9">
                          <?php if ($santri['C3'] == 100  ) {
                                echo "< 5 km";
                            } elseif ($santri['C3'] == 75 ) {
                                echo "5 s.d < 10 km";
                            } elseif ($santri['C3'] == 50 ) {
                                echo ">10 s.d < 15 km";
                            } elseif ($santri['C3'] == 0 ) {
                                echo "> 15 km";
                            } else {
                                echo 0; // Default value for invalid input
                            }
                          ?>
                          </dd>
                      </dl>
                      <dl class="row">
                        <dt class="col-sm-3">Nilai <?php echo $C[4]; ?></dt>
                        <dd class="col-sm-9">
                          <?php if ($santri['C4'] == 100 ) {
                                echo "<= 1.000.000";
                            } elseif ($santri['C4'] == 75 ) {
                                echo ">1.000.000 s.d <= 2.000.000";
                            } elseif ($santri['C4'] == 50 ) {
                                echo ">2.000.000 s.d <= 3.000.000";
                            } elseif ($santri['C4'] == 0 ) {
                                echo ">= 3.000.000";
                            } else {
                                echo 0; // Default value for invalid input
                            }
                          ?>
                          </dd>
                      </dl>
                      <dl class="row">
                        <dt class="col-sm-3">Nilai <?php echo $C[5]; ?></dt>
                        <dd class="col-sm-9">
                          <?php if ($santri['C5'] == 100 ) {
                                echo "Yatim Piatu";
                            } elseif ($santri['C5'] == 75 ) {
                                echo "Yatim";
                            } elseif ($santri['C5'] == 50 ) {
                                echo "Piatu";
                            } elseif ($santri['C5'] == 0 ) {
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

			</div>
		</div>
	</div>

	<!-- Footer -->

	<footer class="footer">
		<div class="container">
			<div class="row footer_row">
				<div class="col">
					
				</div>
			</div>

			<div class="row copyright_row">
				<div class="col">
					<div class="copyright d-flex flex-lg-row flex-column align-items-center justify-content-start">
						<div class="cr_text"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
						<div class="ml-lg-auto cr_links">
							<ul class="cr_list">
								<li><a href="../#">Copyright notification</a></li>
								<li><a href="../#">Terms of Use</a></li>
								<li><a href="../#">Privacy Policy</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>

<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../styles/bootstrap4/popper.js"></script>
<script src="../styles/bootstrap4/bootstrap.min.js"></script>
<script src="../plugins/greensock/TweenMax.min.js"></script>
<script src="../plugins/greensock/TimelineMax.min.js"></script>
<script src="../plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="../plugins/greensock/animation.gsap.min.js"></script>
<script src="../plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="../plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="../plugins/easing/easing.js"></script>
<script src="../plugins/parallax-js-master/parallax.min.js"></script>
<script src="../js/custom.js"></script>
</body>
</html>
<?php 
	}
	else{
		header("location: ../login/");
	}
 ?>