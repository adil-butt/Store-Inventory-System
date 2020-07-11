<div class="container">
	<div class="card card-login mx-auto mt-5">
<<<<<<< HEAD
		<div class="card-header">Login</div>
=======
		<div class="card-header"><?php echo $this->lang->line('login'); ?></div>
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
		<div class="card-body">
			<?php $this->load->view('template/success_error_message'); ?>
			<form method="post" action="">
				<div class="form-group">
					<div class="form-label-group">
<<<<<<< HEAD
						<input type="text" id="inputEmailOrUsername" name="inputEmailOrUsername" class="form-control" placeholder="Email address/User Name" required="required" autofocus="autofocus">
						<label for="inputEmailOrUsername">Email address/User Name</label>
=======
						<input type="text" id="inputEmailOrUsername" name="inputEmailOrUsername" class="form-control" placeholder="<?php echo $this->lang->line('email'); ?> <?php echo $this->lang->line('address'); ?>/<?php echo $this->lang->line('user_name'); ?>" required="required" autofocus="autofocus">
						<label for="inputEmailOrUsername"><?php echo $this->lang->line('email'); ?> <?php echo $this->lang->line('address'); ?>/<?php echo $this->lang->line('user_name'); ?></label>
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
					</div>
				</div>
				<div class="form-group">
					<div class="form-label-group">
<<<<<<< HEAD
						<input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required="required">
						<label for="inputPassword">Password</label>
					</div>
				</div>
				<div class="form-group">
=======
						<input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="<?php echo $this->lang->line('password'); ?>" required="required">
						<label for="inputPassword"><?php echo $this->lang->line('password'); ?></label>
					</div>
				</div>
				<!--<div class="form-group">
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
					<div class="checkbox">
						<label>
							<input type="checkbox" value="remember-me">
							Remember Password
						</label>
					</div>
<<<<<<< HEAD
				</div>
				<button type="submit" class="btn btn-primary btn-block">Login</button>
			</form>
			<div class="text-center">
				<a class="d-block small mt-3" href="<?php echo base_url('reg') ?>">Register an Account</a>
				<a class="d-block small" href="<?php echo base_url('forgot-password'); ?>">Forgot Password?</a>
=======
				</div>-->
				<button type="submit" class="btn btn-primary btn-block"><?php echo $this->lang->line('login'); ?></button>
			</form>
			<div class="text-center">
				<a class="d-block small mt-3" href="<?php echo base_url('reg') ?>"><?php echo $this->lang->line('register').' '.$this->lang->line('an').' '.$this->lang->line('account'); ?></a>
				<a class="d-block small" href="<?php echo base_url('forgot-password'); ?>"><?php echo $this->lang->line('forgot_password'); ?>?</a>
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
			</div>
		</div>
	</div>
</div>

