<div id="content-wrapper">

	<div class="container-fluid">

		<!-- Breadcrumbs-->
		<ol class="breadcrumb d-sm-flex align-items-center mb-4">
			<li class="breadcrumb-item">
				<a href="<?php echo base_url('admin'); ?>"><?php echo $this->lang->line('dashboard'); ?></a>
			</li>
			<li class="breadcrumb-item active"><?php echo $this->lang->line('search'); ?></li class="breadcrumb-item active">
		</ol>
		<!-- DataTables Example -->
		<div class="card mb-3">
			<div class="card-header">
				<i class="fas fa-search"></i>
				<?php echo $this->lang->line('search')." ".$this->lang->line('table'); ?></div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
						<tr>
							<th><?php echo $this->lang->line('table')." ".$this->lang->line('name'); ?></th>
							<th><?php echo $this->lang->line('matched')." ".$this->lang->line('value'); ?></th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th><?php echo $this->lang->line('table')." ".$this->lang->line('name'); ?></th>
							<th><?php echo $this->lang->line('matched')." ".$this->lang->line('value'); ?></th>
						</tr>
						</tfoot>
						<tbody>
						<?php foreach ($accounts as $value) {
<<<<<<< HEAD
							$value = get_object_vars($value);
=======
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
							?>
							<tr>
								<td><?php echo $this->lang->line('account'); ?></td>
								<td>
									<?php echo $this->lang->line('user_name'); ?>: <?php echo $value['username']; ?> <br>
									<?php echo $this->lang->line('first_name'); ?>: <?php echo $value['firstname']; ?> <br>
									<?php echo $this->lang->line('last_name'); ?>: <?php echo $value['lastname']; ?> <br>
									<?php echo $this->lang->line('email'); ?>: <?php echo $value['email']; ?> <br>
									<?php echo $this->lang->line('nic'); ?>: <?php echo $value['nic']; ?> <br>
									<?php echo $this->lang->line('phone'); ?>: <?php echo $value['phone']; ?> <br>
									<?php echo $this->lang->line('address'); ?>: <?php echo $value['address']; ?> <br>
									<?php echo $this->lang->line('registration_time'); ?>: <?php echo $value['regtime']; ?>
								</td>
							</tr>
						<?php } ?>
						<?php foreach ($bills as $value) {
<<<<<<< HEAD
							$value = get_object_vars($value);
=======
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
							?>
							<tr>
								<td><?php echo $this->lang->line('bills'); ?></td>
								<td>
									<?php echo $this->lang->line('bill'); ?> <?php echo $this->lang->line('number'); ?>: <?php echo $value['billnumber']; ?> <br>
									<?php echo $this->lang->line('comments'); ?>: <?php echo $value['comments']; ?> <br>
									<?php echo $this->lang->line('added_date'); ?>: <?php echo $value['addeddate']; ?> <br>
									<?php echo $this->lang->line('last_updated'); ?>: <?php echo $value['lastupdated']; ?>
								</td>
							</tr>
						<?php } ?>
						<?php foreach ($products as $value) {
<<<<<<< HEAD
							$value = get_object_vars($value);
=======
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
							?>
							<tr>
								<td><?php echo $this->lang->line('products'); ?></td>
								<td>
									<?php echo $this->lang->line('product_name'); ?>: <?php echo $value['productname']; ?> <br>
									<?php echo $this->lang->line('quantity'); ?>: <?php echo $value['quantity']; ?> <br>
									<?php echo $this->lang->line('remaining'); ?>: <?php echo $value['remaining']; ?> <br>
									<?php echo $this->lang->line('price'); ?>: <?php echo $value['price']; ?> <br>
									<?php echo $this->lang->line('unit'); ?>: <?php echo $value['unit']; ?> <br>
									<?php echo $this->lang->line('comments'); ?>: <?php echo $value['comments']; ?> <br>
<<<<<<< HEAD
=======
									<?php echo $this->lang->line('description'); ?>: <?php echo $value['description']; ?> <br>
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
									<?php echo $this->lang->line('added_date'); ?>: <?php echo $value['addeddate']; ?> <br>
									<?php echo $this->lang->line('last_updated'); ?>: <?php echo $value['lastupdated']; ?>
								</td>
							</tr>
						<?php } ?>
						<?php foreach ($sales as $value) {
<<<<<<< HEAD
							$value = get_object_vars($value);
=======
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
							$where = array(
								'id' => $value['productid'],
							);
							$row = $this->Product_Model->getResultOfProducts($where);
							$value['pName'] = $row[0]['productname'];
							?>
							<tr>
								<td><?php echo $this->lang->line('sales'); ?></td>
								<td>
									<?php echo $this->lang->line('product_name'); ?>: <?php echo $value['pName']; ?> <br>
									<?php echo $this->lang->line('quantity'); ?>: <?php echo $value['quantity']; ?> <br>
									<?php echo $this->lang->line('discount'); ?>: <?php echo $value['discount']; ?> <br>
									<?php echo $this->lang->line('comments'); ?>: <?php echo $value['comments']; ?> <br>
									<?php echo $this->lang->line('added_date'); ?>: <?php echo $value['addeddate']; ?> <br>
									<?php echo $this->lang->line('last_updated'); ?>: <?php echo $value['lastupdated']; ?>
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	</div>
	<!-- /.container-fluid -->
