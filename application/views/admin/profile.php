<!-- Begin Page Content -->
<div class="container-fluid" style="margin-top: 50px">
	<?php $this->load->view('template/success_error_message'); ?>
	<form id="updateProfileForm" class="user" method="post" action="" enctype="multipart/form-data">
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="updateFirstName"><?php echo $this->lang->line('first_name'); ?></label>
				<input type="text" class="form-control" id="updateFirstName" name="updateFirstName" placeholder="Enter First Name" value="<?PHP echo $_SESSION['admin']['firstname']; ?>">
				<?php echo form_error('updateFirstName', '<p class="alert alert-warning" role="alert">'); ?>
			</div>
			<div class="form-group col-md-6">
				<label for="updateLastName"><?php echo $this->lang->line('last_name'); ?></label>
				<input type="text" class="form-control" id="updateLastName" name="updateLastName" placeholder="Enter Last Name" value="<?PHP echo $_SESSION['admin']['lastname']; ?>">
				<?php echo form_error('updateLastName', '<p class="alert alert-warning" role="alert">'); ?>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label><?php echo $this->lang->line('user_name'); ?></label>
				<input type="text" class="form-control" readonly value="<?PHP echo $_SESSION['admin']['username']; ?>">
			</div>
			<div class="form-group col-md-6">
				<label><?php echo $this->lang->line('email'); ?></label>
				<input type="text" class="form-control" readonly value="<?PHP echo $_SESSION['admin']['email']; ?>">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="updatePassword"><?php echo $this->lang->line('password'); ?></label>
				<input type="password" class="form-control" id="updatePassword" name="updatePassword" placeholder="Enter Password">
				<?php echo form_error('updatePassword', '<p class="alert alert-warning" role="alert">'); ?>
			</div>
			<div class="form-group col-md-6">
				<label for="updateRepeatPassword"><?php echo $this->lang->line('repeat_password'); ?></label>
				<input type="password" class="form-control" id="updateRepeatPassword" name="updateRepeatPassword" placeholder="Repeat Password">
				<?php echo form_error('updateRepeatPassword', '<p class="alert alert-warning" role="alert">'); ?>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="updateNic"><?php echo $this->lang->line('nic'); ?></label>
				<input type="text" class="form-control" id="updateNic" name="updateNic" placeholder="Enter NIC" value="<?PHP echo $_SESSION['admin']['nic']; ?>">
				<?php echo form_error('updateNic', '<p class="alert alert-warning" role="alert">'); ?>
			</div>
			<div class="form-group col-md-6">
				<label for="updatePhone"><?php echo $this->lang->line('phone'); ?></label>
				<input type="text" class="form-control" id="updatePhone" name="updatePhone" placeholder="Enter Phone" value="<?PHP echo $_SESSION['admin']['phone']; ?>">
				<?php echo form_error('updatePhone', '<p class="alert alert-warning" role="alert">'); ?>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="updateAddress"><?php echo $this->lang->line('address'); ?></label>
				<input type="text" class="form-control" id="updateAddress" name="updateAddress" placeholder="Enter Address" value="<?PHP echo $_SESSION['admin']['address']; ?>">
				<?php echo form_error('updateAddress', '<p class="alert alert-warning" role="alert">'); ?>
			</div>
			<div class="form-group col-md-6">
				<label><?php echo $this->lang->line('registration_time'); ?></label>
				<input type="text" class="form-control" placeholder="Enter Phone" readonly value="<?PHP echo $_SESSION['admin']['created_at']; ?>">
			</div>
		</div>
		<div class="form-group">
			<div class="form-label-group">
				<input type="file" name="updateProfileImage" id="updateProfileImage" />
				<?php echo form_label($this->lang->line('change_profile_image'), 'updateProfileImage'); ?>
				<?php
				echo $this->upload->display_errors('<p class="alert alert-warning" role="alert">');
				?>
			</div>
		</div>
		<button type="submit" class="button btn btn-primary btn-lg btn-block"><?php echo $this->lang->line('update'); ?></button>
	</form>
</div>
