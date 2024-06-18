<!DOCTYPE html>
<html lang="en">
<head>
<title>Login-Santri</title>
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

	<div class="features">
		<div class="container">
			<div class="row features_row justify-content-center">
				
				<!-- Features Item -->
				<div class="col-md-6">
		          <div class="card-group">
		            <div class="card p-4">
		              <div class="card-body">
		                <h1>Login</h1>
		                <p class="text-muted">Sign In to your account</p>
		                <form action="login_action.php" method="POST">
		                  <div class="input-group mb-3">
		                    <div class="input-group-prepend">
		                      <span class="input-group-text">
		                        <i class="icon-user"></i>
		                      </span>
		                    </div>
		                    <input class="form-control" type="email" placeholder="Email" name="email">
		                  </div>
		                  <div class="input-group mb-4">
		                    <div class="input-group-prepend">
		                      <span class="input-group-text">
		                        <i class="icon-lock"></i>
		                      </span>
		                    </div>
		                    <input class="form-control" type="password" placeholder="Password" name="password">
		                  </div>
		                  <div class="row">
		                    <div class="col-6">
		                      <button type="submit" class="btn btn-primary px-4">Login</button>
		                    </div>
		                    <div class="col-6 text-right">
		                      <button class="btn btn-link px-0" type="button"><a href="../daftar">Belum Punya akun?</a></button>
		                    </div>
		                  </div>
		                </form>
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