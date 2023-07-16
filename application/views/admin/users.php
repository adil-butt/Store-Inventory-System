<div id="content-wrapper">

	<div class="container-fluid">

		<!-- Breadcrumbs-->
			<ol class="breadcrumb d-sm-flex align-items-center mb-4">
				<li class="breadcrumb-item">
					<a href="<?php echo base_url('admin') ?>"><?php echo $this->lang->line('dashboard'); ?></a>
				</li>
				<li class="breadcrumb-item active"><?php echo $this->lang->line('users')." ".$this->lang->line('table'); ?></li class="breadcrumb-item active">
				<li class="d-none d-sm-inline-block" style="margin-left: auto">
					<button id="addNewUser" type="button" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-money-bill-wave fa-sm text-white-50"></i> <?php echo $this->lang->line('add_new_user'); ?></button>
				</li>
			</ol>
		<div class="alert alert-primary" role="alert" id="createUserMessage"  style="text-align: center; display:none;"></div>
		<div class="alert alert-primary" role="alert" id="imageUploadMessage"  style="text-align: center; display:none;"></div>
		<!-- DataTables Example -->
		<div class="card mb-3">
			<div class="card-header">
				<i class="fas fa-money-bill-wave"></i>
				<?php echo $this->lang->line('users')." ".$this->lang->line('table'); ?></div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
						<tr>
							<th><?php echo $this->lang->line('id'); ?></th>
							<th><?php echo $this->lang->line('user_name'); ?></th>
							<th><?php echo $this->lang->line('full') . ' ' . $this->lang->line('name'); ?></th>
							<th><?php echo $this->lang->line('email'); ?></th>
							<th><?php echo $this->lang->line('nic'); ?></th>
							<th><?php echo $this->lang->line('phone'); ?></th>
							<th><?php echo $this->lang->line('address'); ?></th>
							<th><?php echo $this->lang->line('role'); ?></th>
							<th><?php echo $this->lang->line('status'); ?></th>
							<th><?php echo $this->lang->line('registration_time'); ?></th>
							<th><?php echo $this->lang->line('operations'); ?></th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th><?php echo $this->lang->line('id'); ?></th>
							<th><?php echo $this->lang->line('user_name'); ?></th>
							<th><?php echo $this->lang->line('full') . ' ' . $this->lang->line('name'); ?></th>
							<th><?php echo $this->lang->line('email'); ?></th>
							<th><?php echo $this->lang->line('nic'); ?></th>
							<th><?php echo $this->lang->line('phone'); ?></th>
							<th><?php echo $this->lang->line('address'); ?></th>
							<th><?php echo $this->lang->line('role'); ?></th>
							<th><?php echo $this->lang->line('status'); ?></th>
							<th><?php echo $this->lang->line('registration_time'); ?></th>
							<th><?php echo $this->lang->line('operations'); ?></th>
						</tr>
						</tfoot>
						<tbody id="userRow">
							<?php 
								foreach ($users as $user)
								{
									?>
									<tr id="userRow<?php echo $user['id']; ?>">
										<td id="userid<?php echo $user['id']; ?>"><?php echo $user['id']; ?></td>
										<td id="username<?php echo $user['id']; ?>"><?php echo $user['username']; ?></td>
										<td><?php echo $user['firstname'] . ' ' . $user['lastname']; ?></td>
										<td><?php echo $user['email']; ?></td>
										<td><?php echo $user['nic']; ?></td>
										<td><?php echo $user['phone']; ?></td>
										<td><?php echo $user['address']; ?></td>
										<td><?php echo ($user['role'] == 1) ? 'Admin' : 'User'; ?></td>
										<td><?php echo ($user['status'] == 1) ? 'Active' : 'In Active'; ?></td>
										<td><?php echo $user['created_at']; ?></td>
										<td>
											<button data-userid="<?php echo $user['id']; ?>" type="button" class="btn btn-outline-secondary updateBill"><?php echo $this->lang->line('update'); ?></button>
											<button data-userid="<?php echo $user['id']; ?>" type="button" class="btn btn-outline-danger deleteUser"><?php echo $this->lang->line('delete'); ?></button>
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

	<!-- Delete Bill Modal -->
<!-- Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php echo $this->lang->line('confirm').' '.$this->lang->line('delete'); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input id="deleteUserId" type="hidden" class="form-control">
				<?php echo $this->lang->line('sure').$this->lang->line('delete').'?'; ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
				<button type="button" id="deleteUser" class="btn btn-danger"><?php echo $this->lang->line('delete'); ?></button>
			</div>
		</div>
	</div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="userModalTitle"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger" role="alert" id="addUserBackendError"  style="text-align: center; display:none;"></div>
				<form id="userForm" name="userForm"  enctype="multipart/form-data">
					<h5><b><?php echo $this->lang->line('user').' '.$this->lang->line('information'); ?></b></h5>
					<input id="userId" name="userId" value="<?php echo set_value('userId'); ?>" type="hidden" class="form-control">
					<div class="form-group">
						<label for="username"><?php echo $this->lang->line('user') . ' ' . $this->lang->line('name'); ?></label>
						<input type="text" class="form-control" id="username" name="username" placeholder="<?php echo $this->lang->line('user') . ' ' . $this->lang->line('name'); ?>">
						<div class="alert alert-warning" role="alert" id="usernameError"  style="text-align: center; display:none;"></div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="firstname"><?php echo $this->lang->line('first_name'); ?></label>
							<input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo set_value('firstname'); ?>" placeholder="<?php echo $this->lang->line('first_name'); ?>">
						</div>
						<div class="form-group col-md-6">
							<label for="lastname"><?php echo $this->lang->line('last_name'); ?></label>
							<input type="text" class="form-control" id="lastname" name="last_name" value="<?php echo set_value('last_name'); ?>" placeholder="<?php echo $this->lang->line('last_name'); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="email"><?php echo $this->lang->line('email'); ?></label>
						<input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="<?php echo $this->lang->line('email'); ?>">
					</div>
					<div class="form-group">
						<label for="password"><?php echo $this->lang->line('password'); ?></label>
						<input type="password" class="form-control" id="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="<?php echo $this->lang->line('password'); ?>">
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="nic"><?php echo $this->lang->line('nic'); ?></label>
							<input type="text" class="form-control" id="nic" name="nic" value="<?php echo set_value('nic'); ?>" placeholder="<?php echo $this->lang->line('nic'); ?>">
						</div>
						<div class="form-group col-md-6">
							<label for="phone"><?php echo $this->lang->line('phone'); ?></label>
							<input type="text" class="form-control" id="phone" name="phone" value="<?php echo set_value('phone'); ?>" placeholder="<?php echo $this->lang->line('phone'); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="address"><?php echo $this->lang->line('address'); ?></label>
						<input type="address" class="form-control" id="address" name="address" value="<?php echo set_value('address'); ?>" placeholder="<?php echo $this->lang->line('address'); ?>">
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="role"><?php echo $this->lang->line('role'); ?></label>
							<select id="role" name="role" class="form-control">
								<option value="1"><?php echo $this->lang->line('admin'); ?></option>
								<option value="2" selected="selected"><?php echo $this->lang->line('user'); ?></option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label for="status"><?php echo $this->lang->line('status'); ?></label>
							<select id="status" name="status" class="form-control">
								<option value="1"><?php echo $this->lang->line('active'); ?></option>
								<option value="0" selected="selected"><?php echo $this->lang->line('in_active'); ?></option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="form-label-group">
							<input type="file" name="updateProfileImage" id="userProfileImage" />
							<label for="phone"><?php echo $this->lang->line('profile') . ' ' . $this->lang->line('image'); ?></label>
							<?php
							echo $this->upload->display_errors('<p class="alert alert-warning" role="alert">');
							?>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
				<button id="submitUserButton" type="button" class="btn btn-primary"></button>
			</div>
		</div>
	</div>
</div>
