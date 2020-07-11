<div class="container">
	<div class="card card-login mx-auto mt-5">
		<div class="card-header">Reset Password</div>
		<div class="card-body">
			<?php $this->load->view('template/success_error_message'); ?>
			<div class="text-center mb-4">
				<h4>Reset your password</h4>
			</div>
			<?php if($status) { ?>
				<form method="post" action="">
					<div class="form-group">
						<div class="form-label-group">
							<input type="password" id="resetPassword" name="resetPassword" class="form-control" placeholder="Enter new password" required="required" autofocus="autofocus">
							<label for="resetPassword">Enter new password</label>
							<?php echo form_error('resetPassword', '<p class="alert alert-warning" role="alert">'); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="form-label-group">
							<input type="password" id="repeatResetPassword" name="repeatResetPassword" class="form-control" placeholder="Repeat new password" required="required">
							<label for="repeatResetPassword">Repeat new password</label>
							<?php echo form_error('repeatResetPassword', '<p class="alert alert-warning" role="alert">'); ?>
						</div>
					</div>
					<button type="submit" class="btn btn-primary btn-block">Reset Password</button>
				</form>
			<?php } else  {
				echo $message;
			} ?>
			<div class="text-center" style="margin-bottom: 20px;">
				<a class="d-block small" href="<?php echo base_url('login') ?>">Login Page</a>
			</div>
		</div>
	</div>
</div>
