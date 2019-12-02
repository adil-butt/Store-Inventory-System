<style type="text/css">
	.contact-form{
		background: #fff;
		margin-top: 10%;
		margin-bottom: 5%;
	}
	.contact-form .form-control{
		border-radius:1rem;
	}
	.contact-image{
		text-align: center;
	}
	.contact-image img{
		border-radius: 6rem;
		width: 11%;
		margin-top: -3%;
		transform: rotate(29deg);
	}
	.contact-form form{
		padding: 14%;
	}
	.contact-form form .row{
		margin-bottom: -7%;
	}
	.contact-form h3{
		margin-bottom: 8%;
		margin-top: -10%;
		text-align: center;
		color: #0062cc;
	}
	.contact-form .btnContact {
		width: 50%;
		border: none;
		border-radius: 1rem;
		padding: 1.5%;
		background: #dc3545;
		font-weight: 600;
		color: #fff;
		cursor: pointer;
	}
	.btnContactSubmit
	{
		width: 50%;
		border-radius: 1rem;
		padding: 1.5%;
		color: #fff;
		background-color: #0062cc;
		border: none;
		cursor: pointer;
	}

</style>

<main class="mt-5 pt-4">
	<div class="container wow fadeIn">
		<div class="container contact-form">
			<?php $this->load->view('template/success_error_message'); ?>
			<div class="contact-image">
				<img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact"/>
			</div>
			<form method="post" action="<?php echo base_url('contact_us') ?>">
				<h3><?php echo $this->lang->line('drop'); ?> <?php echo $this->lang->line('us'); ?> a <?php echo $this->lang->line('message'); ?></h3>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" name="txtName" class="form-control" placeholder="<?php echo $this->lang->line('your').' '.$this->lang->line('name'); ?> *" value="<?php echo set_value('txtName') ?>" required/>
							<?php
							echo form_error('txtName', '<p style="border-radius:1rem;" class="alert alert-warning" role="alert">');
							?>
						</div>
						<div class="form-group">
							<input type="text" name="txtEmail" class="form-control" placeholder="<?php echo $this->lang->line('your').' '.$this->lang->line('email'); ?> *" value="<?php echo set_value('txtEmail') ?>" required/>
							<?php
							echo form_error('txtEmail', '<p style="border-radius:1rem;" class="alert alert-warning" role="alert">');
							?>
						</div>
						<div class="form-group">
							<input type="text" name="txtPhone" class="form-control" placeholder="<?php echo $this->lang->line('your').' '.$this->lang->line('phone').' '.$this->lang->line('number'); ?> *" value="<?php echo set_value('txtPhone') ?>" required/>
							<?php
							echo form_error('txtPhone', '<p style="border-radius:1rem;" class="alert alert-warning" role="alert">');
							?>
						</div>
						<div class="form-group">
							<input type="submit" name="btnSubmit" class="btnContact" value="Send Message" required/>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<textarea name="txtMsg" class="form-control" placeholder="<?php echo $this->lang->line('your').' '.$this->lang->line('message'); ?> *" style="width: 100%; height: 150px;" required><?php echo set_value('txtMsg') ?></textarea>
							<?php
							echo form_error('txtMsg', '<p style="border-radius:1rem;" class="alert alert-warning" role="alert">');
							?>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</main>
<!--Main layout-->
