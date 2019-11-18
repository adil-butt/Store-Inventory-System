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
		<!-- JQuery -->
		<script type="text/javascript" src="<?php echo base_url('assets/front_end/js/jquery-3.4.1.min.js') ?>"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
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
			<strong class="blue-text"><?php echo $this->config->item('site_name'); ?></strong>
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
					<a class="nav-link waves-effect" href="<?php echo base_url(); ?>">Home
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
				<?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 2) { ?>
				<li class="nav-item">
					<a href="<?php echo base_url('cart'); ?>" class="nav-link waves-effect">
						<span class="badge red z-depth-1 mr-1"> <?php echo $this->cart->total_items(); ?> </span>
						<i class="fas fa-shopping-cart"></i>
						<span class="clearfix d-none d-sm-inline-block"> Cart </span>
					</a>
				</li>
				<?php } ?>
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
				<?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 2) { ?>
					<li class="nav-item dropdown no-arrow">
						<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<img class="rounded-circle" id="userProfileImage" src="<?php echo base_url('assets/profileimages/'.$_SESSION['user']['profilepath']); ?>" width="50" height="45">
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
							<a class="dropdown-item" href="<?php echo base_url().'profile'; ?>"><?php echo $this->lang->line('profile'); ?></a>
							<a class="dropdown-item" id="viewUserProfilePhoto" href="#"><?php echo $this->lang->line('view_profile_photo'); ?></a>
							<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><?php echo $this->lang->line('logout'); ?></a>
						</div>
					</li>
				<?php } else { ?>
					<li class="nav-item">
						<a href="<?php echo base_url('login') ?>" class="nav-link waves-effect">
							<i class="fab fa-sign-in">Sign In</i>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo base_url('reg') ?>" class="nav-link waves-effect">
							<i class="fab fa-user-plus">Sign Up</i>
						</a>
					</li>
				<?php } ?>
			</ul>
		</div>

	</div>
</nav>
<!-- Navbar -->

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

<!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="userProfileImgViewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php echo $this->lang->line('image'); ?> <?php echo $this->lang->line('preview'); ?></h5>
				<button type="button" class="close closeBillModal" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<img src="" id="userProfileImagePreview" style="max-width: 100%" >
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
			</div>
		</div>
	</div>
</div>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><?php echo $this->lang->line('ready_to_leave'); ?>?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body"><?php echo $this->lang->line('select'); ?> "<?php echo $this->lang->line('logout'); ?>" <?php echo $this->lang->line('select_below_message'); ?>.</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
				<a class="btn btn-primary" href="<?php echo base_url('logout/2'); ?>"><?php echo $this->lang->line('logout'); ?></a>
			</div>
		</div>
	</div>
</div>

<!-- SCRIPTS -->
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="<?php echo base_url('assets/front_end/js/popper.min.js') ?>"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="<?php echo base_url('assets/front_end/js/bootstrap.min.js') ?>"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="<?php echo base_url('assets/front_end/js/mdb.min.js') ?>"></script>
<!-- Custom JavaScript Files-->
<script src="<?php echo base_url('assets/front_end/js/user_events.js') ?>"></script>
<!-- Initializations -->
<script type="text/javascript">
    // Animations initialization
    new WOW().init();

</script>
</body>

</html>

