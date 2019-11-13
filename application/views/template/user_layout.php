	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title><?php echo $title; ?></title>

		<script> var baseUrl = "<?php echo base_url(); ?>";</script>
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
		<!-- Bootstrap core CSS -->
		<link href="<?php echo base_url('assets/front_end/css/bootstrap.min.css') ?>" rel="stylesheet">
		<!-- Material Design Bootstrap -->
		<link href="<?php echo base_url('assets/front_end/css/mdb.min.css') ?>" rel="stylesheet">
		<!-- Your custom styles (optional) -->
		<link href="<?php echo base_url('assets/front_end/css/style.min.css') ?>" rel="stylesheet">
		<style type="text/css">
			html,
			body,
			header,
			.carousel {
				height: 60vh;
			}

			@media (max-width: 740px) {

				html,
				body,
				header,
				.carousel {
					height: 100vh;
				}
			}

			@media (min-width: 800px) and (max-width: 850px) {

				html,
				body,
				header,
				.carousel {
					height: 100vh;
				}
			}

		</style>
	</head>

<body>

<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
	<div class="container">

		<!-- Brand -->
		<a class="navbar-brand waves-effect" href="<?php echo base_url(); ?>">
			<strong class="blue-text"><?php echo $this->config->item('site_name');; ?></strong>
		</a>

		<!-- Collapse -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<!-- Links -->
		<div class="collapse navbar-collapse" id="navbarSupportedContent">

			<!-- Left -->
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link waves-effect" href="#">Home
						<span class="sr-only">(current)</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link waves-effect" href="#">About</a>
				</li>
				<li class="nav-item">
					<a class="nav-link waves-effect" href="#">Contact Us</a>
				</li>
			</ul>

			<!-- Right -->
			<ul class="navbar-nav nav-flex-icons">
				<li class="nav-item">
					<a class="nav-link waves-effect">
						<span class="badge red z-depth-1 mr-1"> 1 </span>
						<i class="fas fa-shopping-cart"></i>
						<span class="clearfix d-none d-sm-inline-block"> Cart </span>
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link waves-effect" target="_blank">
						<i class="fab fa-facebook-f"></i>
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link waves-effect" target="_blank">
						<i class="fab fa-twitter"></i>
					</a>
				</li>
<!--				<li class="nav-item">-->
<!--					<a href="https://github.com/mdbootstrap/bootstrap-material-design" class="nav-link border border-light rounded waves-effect"-->
<!--					   target="_blank">-->
<!--						<i class="fab fa-github mr-2"></i>MDB GitHub-->
<!--					</a>-->
<!--				</li>-->
			</ul>

		</div>

	</div>
</nav>
<!-- Navbar -->

<!--Carousel Wrapper-->
<div id="carousel-example-1z" class="carousel slide carousel-fade pt-4" data-ride="carousel">

	<!--Indicators-->
	<ol class="carousel-indicators">
		<li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
		<li data-target="#carousel-example-1z" data-slide-to="1"></li>
		<li data-target="#carousel-example-1z" data-slide-to="2"></li>
	</ol>
	<!--/.Indicators-->

	<!--Slides-->
	<div class="carousel-inner" role="listbox">

		<!--First slide-->
		<div class="carousel-item active">
			<div class="view" style="background-image: url('https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/8-col/img%282%29.jpg'); background-repeat: no-repeat; background-size: cover;">

				<!-- Mask & flexbox options-->
				<div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

					<!-- Content -->
					<div class="text-center white-text mx-5 wow fadeIn">
						<h1 class="mb-4">
							<strong>Learn Bootstrap 4 with MDB</strong>
						</h1>

						<p>
							<strong>Best & free guide of responsive web design</strong>
						</p>

						<p class="mb-4 d-none d-md-block">
							<strong>The most comprehensive tutorial for the Bootstrap 4. Loved by over 500 000 users. Video and
								written versions
								available. Create your own, stunning website.</strong>
						</p>

						<a target="_blank" href="https://mdbootstrap.com/education/bootstrap/" class="btn btn-outline-white btn-lg">Start
							free tutorial
							<i class="fas fa-graduation-cap ml-2"></i>
						</a>
					</div>
					<!-- Content -->

				</div>
				<!-- Mask & flexbox options-->

			</div>
		</div>
		<!--/First slide-->

		<!--Second slide-->
		<div class="carousel-item">
			<div class="view" style="background-image: url('https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/8-col/img%283%29.jpg'); background-repeat: no-repeat; background-size: cover;">

				<!-- Mask & flexbox options-->
				<div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

					<!-- Content -->
					<div class="text-center white-text mx-5 wow fadeIn">
						<h1 class="mb-4">
							<strong>Learn Bootstrap 4 with MDB</strong>
						</h1>

						<p>
							<strong>Best & free guide of responsive web design</strong>
						</p>

						<p class="mb-4 d-none d-md-block">
							<strong>The most comprehensive tutorial for the Bootstrap 4. Loved by over 500 000 users. Video and
								written versions
								available. Create your own, stunning website.</strong>
						</p>

						<a target="_blank" href="https://mdbootstrap.com/education/bootstrap/" class="btn btn-outline-white btn-lg">Start
							free tutorial
							<i class="fas fa-graduation-cap ml-2"></i>
						</a>
					</div>
					<!-- Content -->

				</div>
				<!-- Mask & flexbox options-->

			</div>
		</div>
		<!--/Second slide-->

		<!--Third slide-->
		<div class="carousel-item">
			<div class="view" style="background-image: url('https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/8-col/img%285%29.jpg'); background-repeat: no-repeat; background-size: cover;">

				<!-- Mask & flexbox options-->
				<div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

					<!-- Content -->
					<div class="text-center white-text mx-5 wow fadeIn">
						<h1 class="mb-4">
							<strong>Learn Bootstrap 4 with MDB</strong>
						</h1>

						<p>
							<strong>Best & free guide of responsive web design</strong>
						</p>

						<p class="mb-4 d-none d-md-block">
							<strong>The most comprehensive tutorial for the Bootstrap 4. Loved by over 500 000 users. Video and
								written versions
								available. Create your own, stunning website.</strong>
						</p>

						<a target="_blank" href="https://mdbootstrap.com/education/bootstrap/" class="btn btn-outline-white btn-lg">Start
							free tutorial
							<i class="fas fa-graduation-cap ml-2"></i>
						</a>
					</div>
					<!-- Content -->

				</div>
				<!-- Mask & flexbox options-->

			</div>
		</div>
		<!--/Third slide-->

	</div>
	<!--/.Slides-->

	<!--Controls-->
	<a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
	<!--/.Controls-->

</div>
<!--/.Carousel Wrapper-->

<!--Main layout-->
<?php echo $contents;?>
<!--Main layout-->

<!--Footer-->
<footer class="page-footer text-center font-small mt-4 wow fadeIn">

	<hr class="my-4">

	<!-- Social icons -->
	<div class="pb-4">
		<a href="#" target="_blank">
			<i class="fab fa-facebook-f mr-3"></i>
		</a>

		<a href="#" target="_blank">
			<i class="fab fa-twitter mr-3"></i>
		</a>

		<a href="#" target="_blank">
			<i class="fab fa-youtube mr-3"></i>
		</a>

		<a href="#" target="_blank">
			<i class="fab fa-google-plus-g mr-3"></i>
		</a>

		<a href="#" target="_blank">
			<i class="fab fa-dribbble mr-3"></i>
		</a>

		<a href="#" target="_blank">
			<i class="fab fa-pinterest mr-3"></i>
		</a>

		<a href="#" target="_blank">
			<i class="fab fa-github mr-3"></i>
		</a>

		<a href="#" target="_blank">
			<i class="fab fa-codepen mr-3"></i>
		</a>
	</div>
	<!-- Social icons -->

	<!--Copyright-->
	<div class="footer-copyright py-3">
		© 2019 Copyright: <?php echo $this->config->item('site_name'); ?>
	</div>
	<!--/.Copyright-->

</footer>
<!--/.Footer-->

<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="<?php echo base_url('assets/front_end/js/jquery-3.4.1.min.js') ?>"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="<?php echo base_url('assets/front_end/js/popper.min.js') ?>"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="<?php echo base_url('assets/front_end/js/bootstrap.min.js') ?>"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="<?php echo base_url('assets/front_end/js/mdb.min.js') ?>"></script>
<!-- Initializations -->
<script type="text/javascript">
    // Animations initialization
    new WOW().init();

</script>
</body>

</html>

