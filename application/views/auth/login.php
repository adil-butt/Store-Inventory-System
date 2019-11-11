<div class="container">
	<div class="card card-login mx-auto mt-5">
		<div class="card-header">Login</div>
		<div class="card-body">
			<?php $this->load->view('template/success_error_message'); ?>
			<form method="post" action="">
				<div class="form-group">
					<div class="form-label-group">
						<input type="text" id="inputEmailOrUsername" name="inputEmailOrUsername" class="form-control" placeholder="Email address/User Name" required="required" autofocus="autofocus">
						<label for="inputEmailOrUsername">Email address/User Name</label>
					</div>
				</div>
				<div class="form-group">
					<div class="form-label-group">
						<input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required="required">
						<label for="inputPassword">Password</label>
					</div>
				</div>
				<!--<div class="form-group">
					<div class="checkbox">
						<label>
							<input type="checkbox" value="remember-me">
							Remember Password
						</label>
					</div>
				</div>-->
				<button type="submit" class="btn btn-primary btn-block">Login</button>
			</form>
			<div class="text-center">
				<a class="d-block small mt-3" href="<?php echo base_url('reg') ?>">Register an Account</a>
				<a class="d-block small" href="<?php echo base_url('forgot-password'); ?>">Forgot Password?</a>
			</div>
		</div>
	</div>
</div>

