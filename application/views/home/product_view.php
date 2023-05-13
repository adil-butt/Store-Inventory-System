<!--Main layout-->
<main class="mt-5 pt-4">
	<div class="container dark-grey-text mt-5">

		<?php $this->load->view('template/success_error_message'); ?>

		<!--Grid row-->
		<div class="row wow fadeIn">

			<!--Grid column-->
			<div class="col-md-6 mb-4">

				<img src="<?php echo base_url('assets/product_images/').$product[0]['imgpath'] ?>" class="img-fluid" alt="">

			</div>
			<!--Grid column-->

			<!--Grid column-->
			<div class="col-md-6 mb-4">

				<!--Content-->
				<div class="p-4">

					<!--<div class="mb-3">
						<a href="">
							<span class="badge purple mr-1">Category 2</span>
						</a>
						<a href="">
							<span class="badge blue mr-1">New</span>
						</a>
						<a href="">
							<span class="badge red mr-1">Bestseller</span>
						</a>
					</div>-->

					<!--<p class="lead">
              <span class="mr-1">
                <del>$200</del>
              </span>
						<span>$100</span>
					</p>-->

					<h1><?php echo $product[0]['productname']; ?></h1>
					<p class="lead font-weight-bold"><?php echo $this->lang->line('available'); ?>: <?php echo $product[0]['remaining']; ?></p>
					<p class="lead font-weight-bold"><?php echo $this->lang->line('price'); ?>: <?php echo $product[0]['price']; ?></p>
					<p class="lead font-weight-bold"><?php echo $this->lang->line('unit'); ?>: <?php echo $product[0]['unit']; ?></p>

					<p class="lead font-weight-bold"><?php echo $this->lang->line('description'); ?></p>

					<p><?php echo $product[0]['description']; ?></p>

					<form method="post" action="<?php echo base_url('user/addItemsToCart')?>" id="addToCartForm" class="d-flex justify-content-left">
						<!-- Default input -->
						<input name="pBuyId" style="display: none" value="<?php echo $product[0]['id']; ?>">
						<input name="pBuyName" style="display: none" value="<?php echo $product[0]['productname']; ?>">
						<input name="pBuyPrice" style="display: none" value="<?php echo $product[0]['price']; ?>">
						<input id="addCartQuantity" name="pBuyQuantity" type="number" value="1" min="1" max="<?php echo $product[0]['remaining']; ?>" class="form-control" style="width: 100px">
						<button id="addToCartButton" class="btn btn-primary btn-md my-0 p" type="button"><?php echo $this->lang->line('add')." ".$this->lang->line('to')." ".$this->lang->line('cart'); ?>
							<i class="fas fa-shopping-cart ml-1"></i>
						</button>

					</form>

				</div>
				<!--Content-->

			</div>
			<!--Grid column-->

		</div>
		<!--Grid row-->

		<hr>

		<!--Grid row-->
		<div class="row d-flex justify-content-center wow fadeIn">

			<!--Grid column-->
			<div class="col-md-6 text-center">

				<h4 class="my-4 h4">Additional information</h4>

				<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus suscipit modi sapiente illo soluta odit
					voluptates,
					quibusdam officia. Neque quibusdam quas a quis porro? Molestias illo neque eum in laborum.</p>

			</div>
			<!--Grid column-->

		</div>
		<!--Grid row-->

		<!--Grid row-->
		<div class="row wow fadeIn">

			<!--Grid column-->
			<div class="col-lg-4 col-md-12 mb-4">

				<img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/11.jpg" class="img-fluid" alt="">

			</div>
			<!--Grid column-->

			<!--Grid column-->
			<div class="col-lg-4 col-md-6 mb-4">

				<img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/12.jpg" class="img-fluid" alt="">

			</div>
			<!--Grid column-->

			<!--Grid column-->
			<div class="col-lg-4 col-md-6 mb-4">

				<img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/13.jpg" class="img-fluid" alt="">

			</div>
			<!--Grid column-->

		</div>
		<!--Grid row-->

	</div>
</main>
<!--Main layout-->

<script>
    $(document).ready(function () {
        $("#addToCartButton").click(function(event){
            let isCorrect = 1;
            let message="";
            let quantity = $.trim($("#addCartQuantity").val());
            if (quantity  == '') {
                isCorrect = 0;
                message = langQuantity + ' ' + langMust + ' ' + langNot + ' '+ langBe + ' ' + langEmpty;
			} else if(quantity < 1 || quantity > <?php echo $product[0]['remaining']; ?> ) {
                isCorrect = 0;
                message = langUserSelectQuantity + ' ' + <?php echo $product[0]['remaining']; ?>;
			}
            if (isCorrect) {
				<?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 2) { ?>
                $("#addToCartForm").submit();
				<?php } else { ?>
                event.preventDefault();
                $.alert({
                    title: langNot + ' ' + langLog + ' ' + langIn + '!',
                    content: langUserNotLogIn + '. ' + langLogInToAddItem,
                });
				<?php } ?>
            } else {
                event.preventDefault();
                $.dialog({
                    title: langAlert + '!',
                    content: message,
                });
            }
        });
    });

</script>
