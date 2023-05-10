<div id="content-wrapper">

	<div class="container-fluid">

		<!-- Breadcrumbs-->
			<ol class="breadcrumb d-sm-flex align-items-center mb-4">
				<li class="breadcrumb-item">
					<a href="<?php echo base_url('admin') ?>"><?php echo $this->lang->line('dashboard'); ?></a>
				</li>
				<li class="breadcrumb-item active"><?php echo $this->lang->line('bills')." ".$this->lang->line('table'); ?></li class="breadcrumb-item active">
				<li class="d-none d-sm-inline-block" style="margin-left: auto">
					<button id="addNewBill" type="button" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-money-bill-wave fa-sm text-white-50"></i> <?php echo $this->lang->line('add_new_bill'); ?></button>
				</li>
			</ol>
		<div class="alert alert-primary" role="alert" id="createBillMessage"  style="text-align: center; display:none;"></div>
		<div class="alert alert-primary" role="alert" id="imageUploadMessage"  style="text-align: center; display:none;"></div>
		<!-- DataTables Example -->
		<div class="card mb-3">
			<div class="card-header">
				<i class="fas fa-money-bill-wave"></i>
				<?php echo $this->lang->line('bills')." ".$this->lang->line('table'); ?></div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
						<tr>
							<th><?php echo $this->lang->line('bill').' '.$this->lang->line('number') ; ?></th>
							<th><?php echo $this->lang->line('bill').' '.$this->lang->line('price') ; ?></th>
							<th><?php echo $this->lang->line('number').' '.$this->lang->line('of').' '.$this->lang->line('product'); ?></th>
							<th><?php echo $this->lang->line('added_date'); ?></th>
							<th><?php echo $this->lang->line('operations'); ?></th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th><?php echo $this->lang->line('bill').' '.$this->lang->line('number') ; ?></th>
							<th><?php echo $this->lang->line('bill').' '.$this->lang->line('price') ; ?></th>
							<th><?php echo $this->lang->line('number').' '.$this->lang->line('of').' '.$this->lang->line('product'); ?></th>
							<th><?php echo $this->lang->line('added_date'); ?></th>
							<th><?php echo $this->lang->line('operations'); ?></th>
						</tr>
						</tfoot>
						<tbody id="billRow">
							<?php 
								foreach ($billRow as $row)
								{
									?>
									<tr id="billRow<?php echo $row['id']; ?>">
										<td id="billNumber<?php echo $row['id']; ?>"><?php echo $row['billnumber']; ?></td>
										<td id="billTotalPrice<?php echo $row['id']; ?>"><?php echo $row['totalPrice'] ?></td>
										<td><?php echo $row['totalProducts'] ?></td>
										<td><?php echo $row['created_at']; ?></td>
										<td>
											<a class="btn btn-outline-primary" href="<?php echo base_url('admin/bill_detail/').$row['id']; ?>"><?php echo $this->lang->line('view_details'); ?></a>
											<button data-billid="<?php echo $row['id']; ?>" type="button" class="btn btn-outline-secondary updateBill"><?php echo $this->lang->line('update'); ?></button>
											<button data-billid="<?php echo $row['id']; ?>" type="button" class="btn btn-outline-danger deleteBill"><?php echo $this->lang->line('delete'); ?></button>
										</td>
									</tr>
									<?php
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	</div>
	<!-- /.container-fluid -->
