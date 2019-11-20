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
			<div class="view" style="background-image: url('<?php echo base_url('assets/slider_images/slide1_image.jpg'); ?>'); background-repeat: no-repeat; background-size: cover;">

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
			<div class="view" style="background-image: url('<?php echo base_url('assets/slider_images/slide2_image.jpg'); ?>'); background-repeat: no-repeat; background-size: cover;">

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
			<div class="view" style="background-image: url('<?php echo base_url('assets/slider_images/slide3_image.jpg'); ?>'); background-repeat: no-repeat; background-size: cover;">

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

<main>

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

	<div class="container">

		<!--Navbar-->
		<nav class="navbar navbar-expand-lg navbar-dark mdb-color lighten-3 mt-3 mb-5">

			<!-- Navbar brand -->
			<!--<span class="navbar-brand">Categories: </span>-->

			<!-- Collapse button -->
			<!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
					aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>-->

			<!-- Collapsible content -->
			<div class="collapse navbar-collapse" id="basicExampleNav">

				<!-- Links -->
				<!--<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="#">All
							<span class="sr-only">(current)</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Shirts</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Sport wears</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Outwears</a>
					</li>

				</ul>-->
				<!-- Links -->

				<form method="post" action="<?php echo base_url('home'); ?>" class="form-inline">
					<div class="md-form my-0">
						<input name="userSearch" class="form-control mr-sm-2" type="text" placeholder="<?php echo $this->lang->line('search'); ?>" aria-label="Search">
					</div>
				</form>
			</div>
			<!-- Collapsible content -->

		</nav>
		<!--/.Navbar-->

		<!--Section: Products v.3-->
		<section class="text-center mb-4">

			<!--Grid row-->
			<div class="row wow fadeIn">
			<?php foreach ($products as $product) { ?>
				<!--Grid column-->
				<div class="col-lg-3 col-md-6 mb-4">

					<!--Card-->
					<div class="card">

						<!--Card image-->
						<div class="view overlay">
							<img src="<?php echo base_url('assets/product_images/').$product['imgpath'] ?>" class="card-img-top"
								 alt="">
							<a href="<?php echo base_url('display_product/').$product['id']; ?>">
								<div class="mask rgba-white-slight"></div>
							</a>
						</div>
						<!--Card image-->

						<!--Card content-->
						<div class="card-body text-center">
							<!--Category & Title-->
							<a href="<?php echo base_url('display_product/').$product['id']; ?>" class="grey-text">
								<h5><?php echo $product['productname'] ?></h5>
							</a>
							<h5>
								<strong>
									<p href="" class="dark-grey-text"><?php echo $this->lang->line('remaining'); ?>: <?php echo $product['remaining'] ?>
										<!--<span class="badge badge-pill danger-color">NEW</span>-->
									</p>
								</strong>
							</h5>

							<h4 class="font-weight-bold blue-text">
								<strong><?php echo $this->lang->line('price'); ?>: <?php echo $product['price'] ?> Rs<?php echo ($product['unit'] != 'Other') ? $product['unit']: ''; ?></strong>
							</h4>

						</div>
						<!--Card content-->

						<!--share on facebook-->
						<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/share-button/" data-layout="button" data-size="large">
							<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
							   class="fb-xfbml-parse-ignore"><?php echo $this->lang->line('share'); ?></a></div>

					</div>
					<!--Card-->

				</div>
			<?php } ?>
			</div>
			<!--Grid row-->

		</section>
		<!--Section: Products v.3-->

		<!--Pagination-->
		<?php if(!isset($_POST['userSearch'])) { ?>
			<?php echo $this->pagination->create_links(); ?>
		<?php } ?>
		<!--Pagination-->

	</div>
</main>
