<div id="content-wrapper">

	<div class="container-fluid">

		<!-- Breadcrumbs-->
		<ol class="breadcrumb d-sm-flex align-items-center mb-4">
			<li class="breadcrumb-item">
				<a href="<?php echo base_url('admin') ?>"><?php echo $this->lang->line('dashboard'); ?></a>
			</li>
			<li class="breadcrumb-item active"><?php echo ($billId != '' ? $this->lang->line('bill_details') : $this->lang->line('product')." ".$this->lang->line('details') ); ?></li class="breadcrumb-item active">
		</ol>
		<?php $this->load->view('template/success_error_message'); ?>
		<div class="alert alert-primary" role="alert" id="billDetailMessage"  style="text-align: center; display:none;"></div>
		<!-- DataTables Example -->
		<div class="card mb-3">
			<div class="card-header" <?php if ($billId == ''){ echo 'style="display:none;"'; } ?>>
				<?php echo $this->lang->line('bill').' '.$this->lang->line('number'); ?>: <span id="billDetailNumber"><?php echo $billRow[0]['billnumber']; ?></span><br>
				<?php echo $this->lang->line('bill').' '.$this->lang->line('price'); ?>: <span id="billDetailTotal"><?php echo $billRow[0]['totalPrice']; ?></span><br>
				<?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('number').' '.$this->lang->line('of').' '.$this->lang->line('product'); ?>: <span id="billDetailProducts"><?php echo $billRow[0]['totalProducts']; ?></span><br>
				<?php echo $this->lang->line('added_date'); ?>: <span id="billDetailAddedAt"><?php echo $billRow[0]['addeddate']; ?></span><br>
				<?php echo $this->lang->line('last_updated'); ?>: <span id="billDetailUpdatedAt"><?php echo $billRow[0]['lastupdated']; ?></span><br>
				<?php echo $this->lang->line('comments'); ?>: <span id="billDetailComment"><?php echo $billRow[0]['comments']; ?></span>
				<span class="d-sm-flex">
				<button style="margin-left: auto" data-billid="<?php if($billId != '') { echo $billRow[0]['id']; } ?>" id="addNewProduct" type="button" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-product-hunt fa-sm text-white-50"></i> <?php echo $this->lang->line('add_more'); ?> <?php echo $this->lang->line('products'); ?> </button>
				</span>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
						<tr>
							<th><?php echo $this->lang->line('product_name'); ?></th>
							<th><?php echo $this->lang->line('quantity'); ?></th>
							<th><?php echo $this->lang->line('remaining'); ?></th>
							<th><?php echo $this->lang->line('price'); ?> <?php echo $this->lang->line('per'); ?> <?php echo $this->lang->line('quantity'); ?></th>
							<th><?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('price'); ?></th>
							<th><?php echo $this->lang->line('unit'); ?></th>
							<th><?php echo $this->lang->line('comments'); ?></th>
							<th><?php echo $this->lang->line('description'); ?></th>
							<th><?php echo $this->lang->line('added_date'); ?></th>
							<th><?php echo $this->lang->line('last_updated'); ?></th>
							<th><?php echo $this->lang->line('operations'); ?></th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th><?php echo $this->lang->line('product_name'); ?></th>
							<th><?php echo $this->lang->line('quantity'); ?></th>
							<th><?php echo $this->lang->line('remaining'); ?></th>
							<th><?php echo $this->lang->line('price'); ?> <?php echo $this->lang->line('per'); ?> <?php echo $this->lang->line('quantity'); ?></th>
							<th><?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('price'); ?></th>
							<th><?php echo $this->lang->line('unit'); ?></th>
							<th><?php echo $this->lang->line('comments'); ?></th>
							<th><?php echo $this->lang->line('description'); ?></th>
							<th><?php echo $this->lang->line('added_date'); ?></th>
							<th><?php echo $this->lang->line('last_updated'); ?></th>
							<th><?php echo $this->lang->line('operations'); ?></th>
						</tr>
						</tfoot>
						<tbody id="productRow">
						<?php
						foreach ($productRow as $row)
						{
							?>
							<tr id="productRow<?php echo $row['id']; ?>">
								<td class="editable editableProductName"><?php echo $row['productname']; ?></td>
								<td class="editable editableProductQuantity"><?php echo $row['quantity'] ?></td>
								<td id="editableProductRemaining<?php echo $row['id']; ?>"><?php echo $row['remaining'] ?></td>
								<td class="editable editableProductPrice"><?php echo $row['price'] ?></td>
								<td id="editableProductTotal<?php echo $row['id']; ?>"><?php echo $row['totalPrice'] ?></td>
								<td class="editableProductUnit">
									<select id="editableProductUnit<?php echo $row['id']; ?>" class="form-control" disabled>
										<option <?php echo ($row['unit'] == '/KG' ? 'selected' :''); ?> value="/KG">/<?php echo $this->lang->line('kg'); ?></option>
										<option <?php echo ($row['unit'] == '/Metre' ? 'selected':''); ?> value="/Metre">/<?php echo $this->lang->line('metre'); ?></option>
										<option <?php echo ($row['unit'] == '/Square Metre' ? 'selected':''); ?> value="/Square Metre">/<?php echo $this->lang->line('square'); ?> <?php echo $this->lang->line('metre'); ?></option>
										<option <?php echo ($row['unit'] == '/1000 Metre' ? 'selected':'') ?>; value="/1000 Metre">/1000 <?php echo $this->lang->line('metre'); ?></option>
										<option <?php echo ($row['unit'] == '/100 Metre' ? 'selected':''); ?> value="/100 Metre">/100 <?php echo $this->lang->line('metre'); ?></option>
										<option <?php echo ($row['unit'] == '/10 Metre' ? 'selected':''); ?> value="/10 Metre">/10 <?php echo $this->lang->line('metre'); ?></option>
										<option <?php echo ($row['unit'] == '/100 GM' ? 'selected':''); ?> value="/100 GM">/100 <?php echo $this->lang->line('gm'); ?></option>
										<option <?php echo ($row['unit'] == '/100 Millilitres' ? 'selected':''); ?> value="/100 Millilitres">/100 <?php echo $this->lang->line('millilitres'); ?></option>
										<option <?php echo ($row['unit'] == '/Item Included' ? 'selected':''); ?> value="/Item Included">/<?php echo $this->lang->line('item_included'); ?></option>
										<option <?php echo ($row['unit'] == 'Other' ? 'selected':''); ?> value="Other"><?php echo $this->lang->line('other'); ?></option>
									</select>
									</td>
								<td class="editable editableProductComments"><?php echo $row['comments']; ?></td>
								<td class="editable editableProductDescription"><?php echo $row['description']; ?></td>
								<td><?php echo $row['addeddate']; ?></td>
								<td id="updatedAt<?php echo $row['id']; ?>"><?php echo $row['lastupdated']; ?></td>
								<td>
									<button data-productid="<?php echo $row['id']; ?>" type="button" <?php echo ($row['remaining'] == '0' ? 'disabled' :''); ?> class="btn btn-outline-secondary sellProduct"><?php echo $this->lang->line('sell'); ?></button>
									<?php if ($billId != '') { ?>
										<button data-productprice="<?php echo $row['totalPrice']; ?>" data-productid="<?php echo $row['id']; ?>" type="button" class="btn btn-outline-secondary updateProduct"><?php echo $this->lang->line('update'); ?></button>
										<button data-productprice="<?php echo $row['totalPrice']; ?>" data-productid="<?php echo $row['id']; ?>" type="button" class="btn btn-outline-danger deleteProduct"><?php echo $this->lang->line('delete'); ?></button>
									<?php } ?>
								</td>
							</tr>
							<?php
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
			<div <?php if ($billId == ''){ echo 'style="display:none;"'; } ?> class="card-footer small text-muted"><?php echo $this->lang->line('last_updated'); ?> <?php echo $this->lang->line('at'); ?> <span id="pageLastUpdated"><?php echo $billRow[0]['lastupdated']; ?></span></div>
		</div>

	</div>
	<!-- /.container-fluid -->
