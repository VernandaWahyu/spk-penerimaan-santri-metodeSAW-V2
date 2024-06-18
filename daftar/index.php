<?php 
	include "../lib/koneksi.php";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Unicat</title>
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
										<div>info.deercreative@gmail.com</div>
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

	<div class="popular">
		<div class="container">
			<div class="row courses_row justify-content-center">
				
				<!-- Features Item -->
        <div class="container-fluid">
            <div class="animated fadeIn">
              <div class="row justify-content-center">
                <div class="col-md-8">
                  <div class="card">
                    <div class="card-header">Tambah Data Santri</div>
                    <form action="daftar_action.php" method="post">
                      <div class="card-body">
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input class="form-control" id="email" type="email" placeholder="Email" name="email">
                        </div>
                        <div class="form-group">
                          <label for="password">Password</label>
                          <input class="form-control" id="password" type="Password" placeholder="Password" name="pass">
                        </div>
                        <input type="hidden" name="kuota" value="1">
                        <hr class="mt-0">
                        <div class="form-group">
                          <label for="nama">Nama</label>
                          <input class="form-control" id="nama" type="text" placeholder="Nama" name="nama">
                        </div>
                        <div class="form-group">
                          <label for="date-input">Tanggal Lahir</label>
                          <input class="form-control" id="date-input" type="date" name="date-input" placeholder="Tanggal Lahir">
                        </div>
                        <div class="form-group">
                          <label for="alamat">Alamat</label>
                          <input class="form-control" id="alamat" type="text" placeholder="Alamat" name="alamat">
                        </div>
                        <hr class="mt-0">
                        <div class="form-group">
                          <label for="smp">Asal Sekolah</label>
                          <input class="form-control" id="smp" type="text" placeholder="Asal Sekolah" name="smp">
                        </div>
                        <div class="form-group">
                          <label for="Jarak_Rumah">Jarak Rumah</label>
                          <select class="form-control" id="Jarak_Rumah" name="jarak">
                            <option value="100">< 5 km</option>
                            <option value="75">5 s.d < 10 km</option>
                            <option value="50">10 s.d < 15 km</option>
                            <option value="0">> 15 km</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="Penghasilan_Orang_Tua">Penghasilan Orang Tua</label>
                          <select class="form-control" id="Penghasilan_Orang_Tua" name="penghasilan">
                            <option value="100"><= 1.000.000</option>
                            <option value="75">1.000.000 s.d <= 2.000.000</option>
                            <option value="50">2.000.000 s.d <= 3.000.000</option>
                            <option value="0">>= 3.000.000</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="Yatim_Piatu">Yatim Piatu</label>
                          <select class="form-control" id="Yatim_Piatu" name="yatim">
                            <option value="100">Yatim Piatu</option>
                            <option value="55">Yatim</option>
                            <option value="50">Piatu</option>
                            <option value="0">Tidak</option>
                          </select>
                        </div>
                        <div class="row align-items-center mt-3">
                          <div class="col-sm-6">
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Simpan</button>
                          </div>
                          <div class="col-sm-6">
                            <a class="btn btn-outline-info btn-lg btn-block" href="../">Batal</a>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- /.row-->
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
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="../https://colorlib.com" target="_blank">Colorlib</a>
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