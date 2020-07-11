<div class="container">
	<div class="card card-login mx-auto mt-5">
<<<<<<< HEAD
		<div class="card-header">Reset Password</div>
		<div class="card-body">
			<?php $this->load->view('template/success_error_message'); ?>
			<div class="text-center mb-4">
				<h4>Reset your password</h4>
=======
		<div class="card-header"><?php echo $this->lang->line('reset').' '.$this->lang->line('password'); ?></div>
		<div class="card-body">
			<?php $this->load->view('template/success_error_message'); ?>
			<div class="text-center mb-4">
				<h4><?php echo $this->lang->line('reset').' '.$this->lang->line('your').' '.$this->lang->line('password'); ?></h4>
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
			</div>
			<?php if($status) { ?>
				<form method="post" action="">
					<div class="form-group">
						<div class="form-label-group">
<<<<<<< HEAD
							<input type="password" id="resetPassword" name="resetPassword" class="form-control" placeholder="Enter new password" required="required" autofocus="autofocus">
							<label for="resetPassword">Enter new password</label>
=======
							<input type="password" id="resetPassword" name="resetPassword" class="form-control" placeholder="<?php echo $this->lang->line('enter').' '.$this->lang->line('new').' '.$this->lang->line('password'); ?>" required="required" autofocus="autofocus">
							<label for="resetPassword"><?php echo $this->lang->line('enter').' '.$this->lang->line('new').' '.$this->lang->line('password'); ?></label>
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
							<?php echo form_error('resetPassword', '<p class="alert alert-warning" role="alert">'); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="form-label-group">
<<<<<<< HEAD
							<input type="password" id="repeatResetPassword" name="repeatResetPassword" class="form-control" placeholder="Repeat new password" required="required">
							<label for="repeatResetPassword">Repeat new password</label>
							<?php echo form_error('repeatResetPassword', '<p class="alert alert-warning" role="alert">'); ?>
						</div>
					</div>
					<button type="submit" class="btn btn-primary btn-block">Reset Password</button>
=======
							<input type="password" id="repeatResetPassword" name="repeatResetPassword" class="form-control" placeholder="<?php echo $this->lang->line('repeat').' '.$this->lang->line('new').' '.$this->lang->line('password'); ?>" required="required">
							<label for="repeatResetPassword"><?php echo $this->lang->line('repeat').' '.$this->lang->line('new').' '.$this->lang->line('password'); ?></label>
							<?php echo form_error('repeatResetPassword', '<p class="alert alert-warning" role="alert">'); ?>
						</div>
					</div>
					<button type="submit" class="btn btn-primary btn-block"><?php echo $this->lang->line('reset').' '.$this->lang->line('password'); ?></button>
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
				</form>
			<?php } else  {
				echo $message;
			} ?>
			<div class="text-center" style="margin-bottom: 20px;">
<<<<<<< HEAD
				<a class="d-block small" href="<?php echo base_url('login') ?>">Login Page</a>
=======
				<a class="d-block small" href="<?php echo base_url('login') ?>"><?php echo $this->lang->line('login').' '.$this->lang->line('page'); ?></a>
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
			</div>
		</div>
	</div>
</div>
