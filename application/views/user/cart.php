<main class="mt-5 pt-4">
	<div class="container dark-grey-text mt-5">

		<?php $this->load->view('template/success_error_message'); ?>

<?php echo form_open(base_url('user/updateCart')); ?>

<table cellpadding="6" cellspacing="1" style="width:100%" border="0">

	<tr>
		<th>QTY</th>
		<th>Item Description</th>
		<th style="text-align:right">Item Price</th>
		<th style="text-align:right">Sub-Total</th>
	</tr>

	<?php $i = 1; ?>

	<?php foreach ($this->cart->contents() as $items): ?>
		<?php
		$check = $this->cart->get_item($items['rowid']);
		$where = array(
		'id' => $check['id'],
		);
		$product = $this->Product_Model->getResultOfProducts($where);
		?>

		<?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

		<tr>
			<td><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?> Max: <?php echo $product[0]['remaining']; ?></td>
			<td>
				<?php echo $items['name']; ?>

				<?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

					<p>
						<?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

							<strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

						<?php endforeach; ?>
					</p>

				<?php endif; ?>

			</td>
			<td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
			<td style="text-align:right">$<?php echo $this->cart->format_number($items['subtotal']); ?></td>
		</tr>

		<?php $i++; ?>

	<?php endforeach; ?>

	<tr>
		<td colspan="2"> </td>
		<td class="right"><strong>Total</strong></td>
		<td class="right">$<?php echo $this->cart->format_number($this->cart->total()); ?></td>
	</tr>

</table>

		<?php if($this->cart->total_items() > 0) { ?>
			<?php echo form_submit('', 'Update your Cart', 'class="btn btn-primary"'); ?>
			<a href="<?php echo base_url('checkout') ?>" class="btn btn-primary float-right"> Checkout</a>
		<?php } ?>
		<?php echo form_close(); ?>

	</div>
</main>
