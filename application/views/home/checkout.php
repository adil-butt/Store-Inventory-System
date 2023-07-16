<!--Main layout-->
<main class="mt-5 pt-4">
	<div class="container wow fadeIn">

		<div style="margin-top: 50px;">
			<?php $this->load->view('template/success_error_message'); ?>
		</div>
		<!-- Heading -->
		<h2 class="my-5 h2 text-center"><?php echo $this->lang->line('checkout'); ?></h2>

		<!--Grid row-->
		<div class="row">

			<!--Grid column-->
			<div class="col-md-12 mb-4">

				<!--Card-->
				<div class="card">

					<!--Card content-->
					<form method="post" action="<?php base_url('user/checkout') ?>" class="card-body">

						<!--Grid row-->
						<div class="row">

							<!--Grid column-->
							<div class="col-md-6 mb-2">

								<!--firstName-->
								<div class="md-form ">
									<input type="text" id="firstName" value="<?php echo isset($_SESSION['user']['firstname']) ? $_SESSION['user']['firstname'] : ''; ?>" class="form-control">
									<label for="firstName" class=""><?php echo $this->lang->line('first_name'); ?></label>
								</div>

							</div>
							<!--Grid column-->

							<!--Grid column-->
							<div class="col-md-6 mb-2">

								<!--lastName-->
								<div class="md-form">
									<input type="text" id="lastName" value="<?php echo isset($_SESSION['user']['firstname']) ? $_SESSION['user']['lastname'] : ''; ?>" class="form-control">
									<label for="lastName" class=""><?php echo $this->lang->line('last_name'); ?></label>
								</div>

							</div>
							<!--Grid column-->

						</div>
						<!--Grid row-->

						<!--Username-->
						<div class="md-form input-group pl-0 mb-5">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">@</span>
							</div>
							<input type="text" class="form-control py-0" placeholder="<?php echo $this->lang->line('user_name'); ?>" value="<?php echo isset($_SESSION['user']['username']) ? $_SESSION['user']['username'] : '' ; ?>" aria-describedby="basic-addon1">
						</div>

						<!--email-->
						<div class="md-form mb-5">
							<input type="text" id="email" class="form-control" placeholder="youremail@example.com" value="<?php echo isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : '' ; ?>">
							<label for="email" class=""><?php echo $this->lang->line('email'); ?></label>
						</div>

						<!--address-->
						<div class="md-form mb-5">
							<input type="text" id="address" name="address" class="form-control" placeholder="1234 Main St" value="<?php echo isset($_SESSION['user']['address']) ? $_SESSION['user']['address'] : '' ; ?>">
							<label for="address" class=""><?php echo $this->lang->line('address'); ?></label>
							<?php echo form_error('address', '<p class="alert alert-warning" role="alert">'); ?>
						</div>

						<!--address-2-->
						<div class="md-form mb-5">
							<input type="text" id="address-2" class="form-control" placeholder="Apartment or suite">
							<label for="address-2" class=""><?php echo $this->lang->line('address'); ?> 2 (<?php echo $this->lang->line('optional'); ?>)</label>
						</div>

						<!--phone-->
						<div class="md-form mb-5">
							<input type="text" id="phone" name="phone" class="form-control" placeholder="03XX-XXXXXXX" value="<?php echo isset($_SESSION['user']['phone']) ? $_SESSION['user']['phone'] : ''; ?>">
							<label for="phone" class=""><?php echo $this->lang->line('phone'); ?></label>
							<?php echo form_error('phone', '<p class="alert alert-warning" role="alert">'); ?>
						</div>

						<!--Grid row-->
						<div class="row">

							<!--Grid column-->
							<div class="col-lg-4 col-md-12 mb-4">

								<label for="country"><?php echo $this->lang->line('country'); ?></label>
								<select class="custom-select d-block w-100" id="country" required>
									<option value=""><?php echo $this->lang->line('choose'); ?>...</option>
									<option selected><?php echo $this->lang->line('pakistan'); ?></option>
								</select>
								<div class="invalid-feedback">
									<?php echo $this->lang->line('please').' '.$this->lang->line('select').' a '.$this->lang->line('valid').' '.$this->lang->line('country'); ?>.
								</div>

							</div>
							<!--Grid column-->

							<!--Grid column-->
							<div class="col-lg-4 col-md-6 mb-4">

								<label for="state"><?php echo $this->lang->line('state'); ?></label>
								<select class="custom-select d-block w-100" id="state" name="state" required>
									<option value=""><?php echo $this->lang->line('choose'); ?>...</option>
									<option><?php echo $this->lang->line('punjab'); ?></option>
									<option><?php echo $this->lang->line('islamabad'); ?></option>
									<option><?php echo $this->lang->line('sindh'); ?></option>
									<option>KPK</option>
									<option><?php echo $this->lang->line('balochistan'); ?></option>
									<option><?php echo $this->lang->line('northern_areas'); ?></option>
								</select>
								<?php echo form_error('state', '<p class="alert alert-warning" role="alert">'); ?>
								<div class="invalid-feedback">
									<?php echo $this->lang->line('please').' '.$this->lang->line('provide').' a '.$this->lang->line('valid').' '.$this->lang->line('state'); ?>.
								</div>

							</div>
							<!--Grid column-->

							<!--Grid column-->
							<div class="col-lg-4 col-md-6 mb-4">

								<label for="zip"><?php echo $this->lang->line('zip'); ?></label>
								<input type="text" name="zip" class="form-control" id="zip" placeholder="" required>
								<div class="invalid-feedback">
									<?php echo $this->lang->line('zip').' '.$this->lang->line('code').' '.$this->lang->line('required'); ?>.
								</div>
								<?php echo form_error('zip', '<p class="alert alert-warning" role="alert">'); ?>

							</div>
							<!--Grid column-->

						</div>
						<!--Grid row-->

						<hr>

						<div class="d-block my-3">
							<div class="custom-control custom-radio">
								<input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
								<label class="custom-control-label" for="credit"><?php echo $this->lang->line('credit'); ?> <?php echo $this->lang->line('card'); ?></label>
							</div>
							<div class="custom-control custom-radio">
								<input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
								<label class="custom-control-label" for="debit"><?php echo $this->lang->line('debit'); ?> <?php echo $this->lang->line('card'); ?></label>
							</div>
							<div class="custom-control custom-radio">
								<input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
								<label class="custom-control-label" for="paypal"><?php echo $this->lang->line('paypal'); ?></label>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 mb-3">
								<label for="cc-name"><?php echo $this->lang->line('name').' '.$this->lang->line('on').' '.$this->lang->line('card'); ?></label>
								<input type="text" class="form-control" id="cc-name" placeholder="" required>
								<small class="text-muted"><?php echo $this->lang->line('full').' '.$this->lang->line('name').' '.$this->lang->line('as').
										' '.$this->lang->line('displayed').' '.$this->lang->line('on').' '.$this->lang->line('card'); ?></small>
								<div class="invalid-feedback">
									<?php echo $this->lang->line('name').' '.$this->lang->line('on').' '.$this->lang->line('card').' '.$this->lang->line('is').' '.$this->lang->line('required'); ?>.
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="cc-number"><?php echo $this->lang->line('credit').' '.$this->lang->line('card').' '.$this->lang->line('number'); ?></label>
								<input type="text" class="form-control" id="cc-number" placeholder="" required>
								<div class="invalid-feedback">
									<?php echo $this->lang->line('credit').' '.$this->lang->line('card').' '.$this->lang->line('number').' '.$this->lang->line('is').' '.$this->lang->line('required'); ?>.
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 mb-3">
								<label for="cc-expiration"><?php echo $this->lang->line('expiration'); ?></label>
								<input type="text" class="form-control" id="cc-expiration" placeholder="" required>
								<div class="invalid-feedback">
									<?php echo $this->lang->line('expiration').' '.$this->lang->line('date').' '.$this->lang->line('is').' '.$this->lang->line('required'); ?>.
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="cc-expiration">CVV</label>
								<input type="text" class="form-control" id="cc-cvv" placeholder="" required>
								<div class="invalid-feedback">
									<?php echo $this->lang->line('security').' '.$this->lang->line('code').' '.$this->lang->line('required'); ?>.
								</div>
							</div>
						</div>
						<hr class="mb-4">
						<button class="btn btn-primary btn-lg btn-block" type="submit"><?php echo $this->lang->line('continue').' '.$this->lang->line('to').' '.$this->lang->line('checkout'); ?></button>

					</form>

				</div>
				<!--/.Card-->

			</div>
			<!--Grid column-->

		</div>
		<!--Grid row-->

	</div>
</main>
<!--Main layout-->
