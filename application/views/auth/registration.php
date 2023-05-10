<div class="container">
	<div class="card card-register mx-auto mt-5">
		<div class="card-header"><?php echo $this->lang->line('register').' '.$this->lang->line('an').' '.$this->lang->line('account'); ?></div>
		<?php $this->load->view('template/success_error_message'); ?>
		<div class="card-body">
			<?php $attributes = array('id' => 'accRegForm'); ?>
			<?php echo form_open_multipart('', $attributes); ?>
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-6">
							<div class="form-label-group">
								<?php $data = array(
									'name'          => 'accRegFirstName',
									'id'            => 'accRegFirstName',
									'value'			=> set_value('accRegFirstName'),
									'class'			=> 'form-control',
									'placeholder'	=> $this->lang->line('first_name'),
									'required'		=> '',
									'autofocus'		=> 'autofocus',
								);
								echo form_input($data);
								echo form_label($this->lang->line('first_name'), 'accRegFirstName');
								echo form_error('accRegFirstName', '<p class="alert alert-warning" role="alert">');
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-label-group">
								<?php $data = array(
									'name'          => 'accRegLastName',
									'id'            => 'accRegLastName',
									'value'			=> set_value('accRegLastName'),
									'class'			=> 'form-control',
									'placeholder'	=> $this->lang->line('last_name'),
									'required'		=> '',
								);
								echo form_input($data);
								echo form_label($this->lang->line('last_name'), 'accRegLastName');
								echo form_error('accRegLastName', '<p class="alert alert-warning" role="alert">');
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="form-label-group">
						<?php $data = array(
							'name'          => 'accRegUsername',
							'id'            => 'accRegUsername',
							'value'			=> set_value('accRegUsername'),
							'class'			=> 'form-control',
							'placeholder'	=> $this->lang->line('user_name'),
							'required'		=> '',
						);
						echo form_input($data);
						echo form_label($this->lang->line('user_name'), 'accRegUsername');
						echo form_error('accRegUsername', '<p class="alert alert-warning" role="alert">');
						?>
					</div>
				</div>
				<div class="form-group">
					<div class="form-label-group">
						<?php $data = array(
							'name'          => 'accRegEmail',
							'id'            => 'accRegEmail',
							'value'			=> set_value('accRegEmail'),
							'class'			=> 'form-control',
							'placeholder'	=> $this->lang->line('email').' '.$this->lang->line('address'),
							'required'		=> '',
						);
						echo form_input($data);
						echo form_label($this->lang->line('email').' '.$this->lang->line('address'), 'accRegEmail');
						echo form_error('accRegEmail', '<p class="alert alert-warning" role="alert">');
						?>
					</div>
				</div>
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-6">
							<div class="form-label-group">
								<?php $data = array(
									'name'          => 'accRegPassword',
									'id'            => 'accRegPassword',
									'value'			=> set_value('accRegPassword'),
									'class'			=> 'form-control',
									'placeholder'	=> $this->lang->line('password'),
									'required'		=> '',
								);
								echo form_password($data);
								echo form_label($this->lang->line('password'), 'accRegPassword');
								echo form_error('accRegPassword', '<p class="alert alert-warning" role="alert">');
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-label-group">
								<?php $data = array(
									'name'          => 'accRegConfirmPassword',
									'id'            => 'accRegConfirmPassword',
									'value'			=> set_value('accRegConfirmPassword'),
									'class'			=> 'form-control',
									'placeholder'	=> $this->lang->line('confirm').' '.$this->lang->line('password'),
									'required'		=> '',
								);
								echo form_password($data);
								echo form_label($this->lang->line('confirm').' '.$this->lang->line('password'), 'accRegConfirmPassword');
								echo form_error('accRegConfirmPassword', '<p class="alert alert-warning" role="alert">');
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-6">
							<div class="form-label-group">
								<?php $data = array(
									'name'          => 'accRegNic',
									'id'            => 'accRegNic',
									'value'			=> set_value('accRegNic'),
									'class'			=> 'form-control',
									'placeholder'	=> $this->lang->line('nic'),
									'required'		=> '',
								);
								echo form_input($data);
								echo form_label($this->lang->line('nic'), 'accRegNic');
								echo form_error('accRegNic', '<p class="alert alert-warning" role="alert">');
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-label-group">
								<?php $data = array(
									'name'          => 'accRegPhone',
									'id'            => 'accRegPhone',
									'value'			=> set_value('accRegPhone'),
									'class'			=> 'form-control',
									'placeholder'	=> $this->lang->line('phone'),
									'required'		=> '',
								);
								echo form_input($data);
								echo form_label($this->lang->line('phone'), 'accRegPhone');
								echo form_error('accRegPhone', '<p class="alert alert-warning" role="alert">');
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="form-label-group">
						<?php $data = array(
							'name'          => 'accRegAddress',
							'id'            => 'accRegAddress',
							'value'			=> set_value('accRegAddress'),
							'class'			=> 'form-control',
							'placeholder'	=> $this->lang->line('address'),
							'required'		=> '',
						);
						echo form_input($data);
						echo form_label($this->lang->line('address'), 'accRegAddress');
						echo form_error('accRegAddress', '<p class="alert alert-warning" role="alert">');
						?>
					</div>
				</div>

				<div class="form-group">
					<div class="form-label-group">
						<input type="file" name="accRegProfileImage" id="accRegProfileImage" />
						<?php echo form_label($this->lang->line('choose').' '.$this->lang->line('profile').' '.$this->lang->line('image'), 'accRegProfileImage'); ?>
						<?php
						echo $this->upload->display_errors('<p class="alert alert-warning" role="alert">');
						?>
					</div>
				</div>
				<?php echo form_submit('accRegSubmit', $this->lang->line('register'), 'class="btn btn-primary btn-block"'); ?>
			<?php echo form_close(); ?>
			<div class="text-center">
				<a class="d-block small mt-3" href="<?php echo base_url('login') ?>"><?php echo $this->lang->line('login').' '.$this->lang->line('page'); ?></a>
				<a class="d-block small" href="<?php echo base_url('forgot-password') ?>"><?php echo $this->lang->line('forgot_password'); ?>?</a>
			</div>
		</div>
	</div>
</div>
