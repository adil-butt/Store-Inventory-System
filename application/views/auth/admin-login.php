<div class="container">
	<div class="card card-login mx-auto mt-5">
		<div class="card-header"><?php echo $this->lang->line('login'); ?></div>
		<div class="card-body">
			<?php $this->load->view('template/success_error_message'); ?>
			<form method="post" action="">
				<div class="form-group">
					<div class="form-label-group">
						<input type="text" id="inputEmailOrUsername" name="inputEmailOrUsername" class="form-control" placeholder="<?php echo $this->lang->line('email'); ?> <?php echo $this->lang->line('address'); ?>/<?php echo $this->lang->line('user_name'); ?>" required="required" autofocus="autofocus">
						<label for="inputEmailOrUsername"><?php echo $this->lang->line('email'); ?> <?php echo $this->lang->line('address'); ?>/<?php echo $this->lang->line('user_name'); ?></label>
					</div>
				</div>
				<div class="form-group">
					<div class="form-label-group">
						<input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="<?php echo $this->lang->line('password'); ?>" required="required">
						<label for="inputPassword"><?php echo $this->lang->line('password'); ?></label>
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
				<button type="submit" class="btn btn-primary btn-block"><?php echo $this->lang->line('login'); ?></button>
			</form>
			<!-- <div class="text-center">
				<a class="d-block small mt-3" href="<?php echo base_url('reg') ?>"><?php echo $this->lang->line('register').' '.$this->lang->line('an').' '.$this->lang->line('account'); ?></a>
				<a class="d-block small" href="<?php echo base_url('forgot-password'); ?>"><?php echo $this->lang->line('forgot_password'); ?>?</a>
			</div> -->
		</div>
	</div>
</div>

