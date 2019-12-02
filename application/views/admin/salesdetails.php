<div id="content-wrapper">

	<div class="container-fluid">

		<!-- Breadcrumbs-->
		<ol class="breadcrumb d-sm-flex align-items-center mb-4">
			<li class="breadcrumb-item">
				<a href="<?php echo base_url('admin'); ?>"><?php echo $this->lang->line('dashboard'); ?></a>
			</li>
			<li class="breadcrumb-item active"><?php echo $this->lang->line('sales')." ".$this->lang->line('table'); ?></li class="breadcrumb-item active">
		</ol>
		<?php $this->load->view('template/success_error_message'); ?>
		<div class="alert alert-primary" role="alert" id="saleMessage"  style="text-align: center; display:none;"></div>
		<!-- DataTables Example -->
		<div class="card mb-3">
			<div class="card-header">
				<i class="fas fa-money-bill-wave"></i>
				<?php echo $this->lang->line('sales')." ".$this->lang->line('table'); ?></div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
						<tr>
							<th><?php echo $this->lang->line('product_name'); ?></th>
							<th><?php echo $this->lang->line('quantity'); ?></th>
							<th><?php echo $this->lang->line('discount'); ?></th>
							<th><?php echo $this->lang->line('comments'); ?></th>
							<th><?php echo $this->lang->line('added_date'); ?></th>
							<th><?php echo $this->lang->line('last_updated'); ?></th>
							<th><?php echo $this->lang->line('operations'); ?></th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th><?php echo $this->lang->line('product_name'); ?></th>
							<th><?php echo $this->lang->line('quantity'); ?></th>
							<th><?php echo $this->lang->line('discount'); ?></th>
							<th><?php echo $this->lang->line('comments'); ?></th>
							<th><?php echo $this->lang->line('added_date'); ?></th>
							<th><?php echo $this->lang->line('last_updated'); ?></th>
							<th><?php echo $this->lang->line('operations'); ?></th>
						</tr>
						</tfoot>
						<tbody>
						<?php foreach ($row as $row) { ?>
						<tr>
							<td id="returnProductName<?php echo $row['id'] ?>"><?php echo $row['productname'] ?></td>
							<td id="returnQuantityMax<?php echo $row['id'] ?>"><?php echo $row['quantity'] ?></td>
							<td><?php echo $row['discount'] ?></td>
							<td><?php echo $row['comments'] ?></td>
							<td><?php echo $row['addeddate'] ?></td>
							<td><?php echo $row['lastupdated'] ?></td>
							<td><button type="button" data-sellid="<?php echo $row['id']; ?>" data-productid="<?php echo $row['productid']; ?>" class="btn btn-outline-secondary returnProduct"><?php echo $this->lang->line('return')." ".$this->lang->line('back'); ?></button>
							<button type="button" data-sellid="<?php echo $row['id']; ?>" data-productid="<?php echo $row['productid']; ?>" class="btn btn-outline-secondary sellUpdate"><?php echo $this->lang->line('update'); ?></button>
							<button type="button" data-sellid="<?php echo $row['id']; ?>" data-productid="<?php echo $row['productid']; ?>" class="btn btn-outline-secondary sellDelete"><?php echo $this->lang->line('delete'); ?></button></td>
						</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	</div>
	<!-- /.container-fluid -->

	<!-- Delete Sale Modal -->
	<div class="modal fade" id="deleteSaleModal" tabindex="-1" role="dialog" aria-labelledby="deleteBillModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><?php echo $this->lang->line('confirm').' '.$this->lang->line('delete'); ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="post" action="<?php echo base_url("SaleProduct/deleteSale") ?>">
				<div class="modal-body">
					<input id="deleteSaleProductId" name="deleteSaleProductId" type="hidden" class="form-control">
					<input id="deleteSaleId" name="deleteSaleId" type="hidden" class="form-control">
					<?php echo $this->lang->line('sure').$this->lang->line('delete').'?'; ?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
					<button type="submit" class="btn btn-danger"><?php echo $this->lang->line('delete'); ?></button>
				</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Return Product Modal -->
	<div class="modal fade" id="returnPModal" tabindex="-1" role="dialog" aria-labelledby="saleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><?php echo $this->lang->line('return').' '.$this->lang->line('product'); ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="post" action="<?php echo base_url("SaleProduct/returnProduct") ?>">
					<input id="returnPId" name="returnPId" value="<?php echo set_value('returnPId'); ?>" type="hidden" class="form-control">
					<input id="returnSalePId" name="returnSalePId" value="<?php echo set_value('returnSalePId'); ?>" type="hidden" class="form-control">
					<div class="modal-body">
						<div class="form-group">
							<label for="returnSalePName"><?php echo $this->lang->line('product_name'); ?></label>
							<input type="text" class="form-control" id="returnSalePName" placeholder="<?php echo $this->lang->line('product_name'); ?>" disabled>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="returnSalePQuantity"><?php echo $this->lang->line('select')." ".$this->lang->line('quantity'); ?></label>
								<input type="number" class="form-control" id="returnSalePQuantity" name="returnSalePQuantity" placeholder="<?php echo $this->lang->line('select')." ".$this->lang->line('quantity'); ?>" min="1" required>
							</div>
							<div class="form-group col-md-6">
								<label for="maxSaleQuantity"><?php echo $this->lang->line('max')." ".$this->lang->line('quantity'); ?></label>
								<input type="text" class="form-control" id="maxSaleQuantity" placeholder="<?php echo $this->lang->line('max')." ".$this->lang->line('quantity'); ?>" disabled>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
						<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('return'); ?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
