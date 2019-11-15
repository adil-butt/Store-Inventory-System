<!--Main layout-->
<main class="mt-5 pt-4">
	<div class="container wow fadeIn">

		<div style="margin-top: 50px;">
			<?php $this->load->view('template/success_error_message'); ?>
		</div>
		<!-- Heading -->
		<h2 class="my-5 h2 text-center">Checkout form</h2>

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
									<input type="text" id="firstName" value="<?php echo $_SESSION['user']['firstname']; ?>" class="form-control">
									<label for="firstName" class="">First name</label>
								</div>

							</div>
							<!--Grid column-->

							<!--Grid column-->
							<div class="col-md-6 mb-2">

								<!--lastName-->
								<div class="md-form">
									<input type="text" id="lastName" value="<?php echo $_SESSION['user']['lastname']; ?>" class="form-control">
									<label for="lastName" class="">Last name</label>
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
							<input type="text" class="form-control py-0" placeholder="Username" value="<?php echo $_SESSION['user']['username']; ?>" aria-describedby="basic-addon1">
						</div>

						<!--email-->
						<div class="md-form mb-5">
							<input type="text" id="email" class="form-control" placeholder="youremail@example.com" value="<?php echo $_SESSION['user']['email']; ?>">
							<label for="email" class="">Email</label>
						</div>

						<!--address-->
						<div class="md-form mb-5">
							<input type="text" id="address" name="address" class="form-control" placeholder="1234 Main St" value="<?php echo $_SESSION['user']['address']; ?>">
							<label for="address" class="">Address</label>
							<?php echo form_error('address', '<p class="alert alert-warning" role="alert">'); ?>
						</div>

						<!--address-2-->
						<div class="md-form mb-5">
							<input type="text" id="address-2" class="form-control" placeholder="Apartment or suite">
							<label for="address-2" class="">Address 2 (optional)</label>
						</div>

						<!--phone-->
						<div class="md-form mb-5">
							<input type="text" id="phone" name="phone" class="form-control" placeholder="03XX-XXXXXXX" value="<?php echo $_SESSION['user']['phone']; ?>">
							<label for="phone" class="">Phone</label>
							<?php echo form_error('phone', '<p class="alert alert-warning" role="alert">'); ?>
						</div>

						<!--Grid row-->
						<div class="row">

							<!--Grid column-->
							<div class="col-lg-4 col-md-12 mb-4">

								<label for="country">Country</label>
								<select class="custom-select d-block w-100" id="country" required>
									<option value="">Choose...</option>
									<option selected>Pakistan</option>
								</select>
								<div class="invalid-feedback">
									Please select a valid country.
								</div>

							</div>
							<!--Grid column-->

							<!--Grid column-->
							<div class="col-lg-4 col-md-6 mb-4">

								<label for="state">State</label>
								<select class="custom-select d-block w-100" id="state" name="state" required>
									<option value="">Choose...</option>
									<option>Punjab</option>
									<option>Islamabad</option>
									<option>Sindh</option>
									<option>KPK</option>
									<option>Balochistan</option>
									<option>Northern Areas</option>
								</select>
								<?php echo form_error('state', '<p class="alert alert-warning" role="alert">'); ?>
								<div class="invalid-feedback">
									Please provide a valid state.
								</div>

							</div>
							<!--Grid column-->

							<!--Grid column-->
							<div class="col-lg-4 col-md-6 mb-4">

								<label for="zip">Zip</label>
								<input type="text" name="zip" class="form-control" id="zip" placeholder="" required>
								<div class="invalid-feedback">
									Zip code required.
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
								<label class="custom-control-label" for="credit">Credit card</label>
							</div>
							<div class="custom-control custom-radio">
								<input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
								<label class="custom-control-label" for="debit">Debit card</label>
							</div>
							<div class="custom-control custom-radio">
								<input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
								<label class="custom-control-label" for="paypal">Paypal</label>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 mb-3">
								<label for="cc-name">Name on card</label>
								<input type="text" class="form-control" id="cc-name" placeholder="" required>
								<small class="text-muted">Full name as displayed on card</small>
								<div class="invalid-feedback">
									Name on card is required
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="cc-number">Credit card number</label>
								<input type="text" class="form-control" id="cc-number" placeholder="" required>
								<div class="invalid-feedback">
									Credit card number is required
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 mb-3">
								<label for="cc-expiration">Expiration</label>
								<input type="text" class="form-control" id="cc-expiration" placeholder="" required>
								<div class="invalid-feedback">
									Expiration date required
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="cc-expiration">CVV</label>
								<input type="text" class="form-control" id="cc-cvv" placeholder="" required>
								<div class="invalid-feedback">
									Security code required
								</div>
							</div>
						</div>
						<hr class="mb-4">
						<button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>

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
