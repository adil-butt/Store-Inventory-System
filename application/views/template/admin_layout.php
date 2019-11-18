<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?php echo $title ?></title>

	<script> var baseUrl = "<?php echo base_url(); ?>";</script>

	<script>
        var addNewBill = "<?php echo $this->lang->line('add_new_bill'); ?>";
        var addBillButton = "<?php echo $this->lang->line('add'); ?>";
        var updateBill = "<?php echo $this->lang->line('update').' '.$this->lang->line('bill'); ?>";
        var updateBillButton = "<?php echo $this->lang->line('update'); ?>";
        var langSaveButton = "<?php echo $this->lang->line('save'); ?>";
        var langDelete = "<?php echo $this->lang->line('delete'); ?>";
        var langViewDetails = "<?php echo $this->lang->line('view_details'); ?>";
        var addMore = "<?php echo $this->lang->line('add_more'); ?>";
        var langBill = "<?php echo $this->lang->line('bill'); ?>";
        var langNumber = "<?php echo $this->lang->line('number'); ?>";
        var products = "<?php echo $this->lang->line('product'); ?>";
        var langProductName = "<?php echo $this->lang->line('product_name'); ?>";
        var langQuantity = "<?php echo $this->lang->line('quantity'); ?>";
        var langPrice = "<?php echo $this->lang->line('price'); ?>";
        var langUnit = "<?php echo $this->lang->line('unit'); ?>";
        var langKg = "<?php echo $this->lang->line('kg'); ?>";
        var langMetre = "<?php echo $this->lang->line('metre'); ?>";
        var langSquare = "<?php echo $this->lang->line('square'); ?>";
        var langGm = "<?php echo $this->lang->line('gm'); ?>";
        var langMillilitres = "<?php echo $this->lang->line('millilitres'); ?>";
        var langItemIncluded = "<?php echo $this->lang->line('item_included'); ?>";
        var langOther = "<?php echo $this->lang->line('other'); ?>";
        var langProductComments = "<?php echo $this->lang->line('product_comments'); ?>";
        var LangOptional = "<?php echo $this->lang->line('optional'); ?>";
        var LangIsEmpty = "<?php echo $this->lang->line('is_empty'); ?>";
        var LangMustNumeric = "<?php echo $this->lang->line('must_numeric'); ?>";
        var LangRemaining = "<?php echo $this->lang->line('remaining'); ?>";
        var langSell = "<?php echo $this->lang->line('sell'); ?>";
        var langSale = "<?php echo $this->lang->line('sale'); ?>";
        var langSales = "<?php echo $this->lang->line('sales'); ?>";
        var langDescription = "<?php echo $this->lang->line('description'); ?>";
	</script>

	<!-- Custom fonts for this template-->
	<link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">

	<!-- Page level plugin CSS-->
	<link href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.css') ?>" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="<?php echo base_url('assets/css/sb-admin.css') ?>" rel="stylesheet">
	<script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>

</head>

<body id="page-top">

<!-- end of header -->

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

	<a class="navbar-brand mr-1" href="#"><?php echo $_SESSION['user']['username'].' ('.$this->lang->line('admin').')'; ?></a>
	<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
		<i class="fas fa-bars"></i>
	</button>

	<!-- Navbar Search -->
	<form method="post" action="<?php echo base_url().'admin/search'; ?>" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
		<div class="input-group">
			<input type="text" name="searchItem" class="form-control" placeholder="<?php echo $this->lang->line('search')." ".$this->lang->line('for')." ".$this->lang->line('anything') ?>..." aria-label="Search" aria-describedby="basic-addon2">
			<div class="input-group-append">
				<button class="btn btn-primary" type="submit">
					<i class="fas fa-search"></i>
				</button>
			</div>
		</div>
	</form>
	<!-- Navbar -->
	<ul class="navbar-nav ml-auto ml-md-0">
		<li class="nav-item dropdown no-arrow">
			<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<img class="rounded-circle" id="profileImage" src="<?php echo base_url('assets/profileimages/'.$_SESSION['user']['profilepath']); ?>" width="50" height="45">
			</a>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
				<a class="dropdown-item" href="<?php echo base_url().'admin/profile'; ?>"><?php echo $this->lang->line('profile'); ?></a>
				<a class="dropdown-item" id="viewProfilePhoto" href="#"><?php echo $this->lang->line('view_profile_photo'); ?></a>
				<div class="dropdown-divider"></div>
				<?php
				if($this->session->userdata('site_lang') == 'japanese') { ?>
					<a class="dropdown-item" href="<?php echo base_url().'languageswitcher/switchLang/english'; ?>">
						<?php echo $this->lang->line('change_language_to_english'); ?>
					</a>
				<?php } else { ?>
					<a class="dropdown-item" href="<?php echo base_url().'languageswitcher/switchLang/japanese'; ?>">
						<?php echo $this->lang->line('change_language_to_japanese'); ?>
					</a>
				<?php } ?>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><?php echo $this->lang->line('logout'); ?></a>
			</div>
		</li>
	</ul>
</nav>

<!-- end of navbar -->
<?php
	$dashboard = 'admin';
?>
<div id="wrapper">
	<!-- Sidebar -->
	<ul class="sidebar navbar-nav">
		<li class="nav-item active">
			<a class="nav-link" href="<?php echo base_url($dashboard); ?>">
				<i class="fas fa-fw fa-tachometer-alt"></i>
				<span><?php echo $this->lang->line('dashboard'); ?></span>
			</a>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-fw fa-folder"></i>
				<span><?php echo $this->lang->line('pages'); ?></span>
			</a>
			<div class="dropdown-menu" aria-labelledby="pagesDropdown">
				<h6 class="dropdown-header"><?php echo $this->lang->line('login_screens').':'; ?></h6>
				<a class="dropdown-item" href="<?php echo base_url('login'); ?>"><?php echo $this->lang->line('login'); ?></a>
				<a class="dropdown-item" href="<?php echo base_url('reg'); ?>"><?php echo $this->lang->line('register'); ?></a>
				<a class="dropdown-item" href="<?php echo base_url('forgot-password'); ?>"><?php echo $this->lang->line('forgot_password'); ?></a>
				<div class="dropdown-divider"></div>
				<h6 class="dropdown-header"><?php echo $this->lang->line('other_pages').':'; ?></h6>
				<a class="dropdown-item" href="<?php echo base_url('my404') ?>"><?php echo $this->lang->line('404_page'); ?></a>
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="<?php echo base_url().'admin/bills'; ?>">
				<i class="fas fa-fw fa-table"></i>
				<span><?php echo $this->lang->line('bills')." ".$this->lang->line('table'); ?></span></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="<?php echo base_url().'admin/all_products'; ?>">
				<i class="fas fa-fw fa-table"></i>
				<span><?php echo $this->lang->line('all')." ".$this->lang->line('products'); ?></span></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="<?php echo base_url().'admin/sales'; ?>">
				<i class="fas fa-fw fa-table"></i>
				<span><?php echo $this->lang->line('sales')." ".$this->lang->line('table'); ?></span></a>
		</li>
	</ul>

<!-- end of sidebar -->

	<!-- PAGE CONTENT BEGINS -->
	<?php echo $contents;?>
	<!-- PAGE CONTENT ENDS -->

	<!-- Sticky Footer -->
	<footer class="sticky-footer">
		<div class="container my-auto">
			<div class="copyright text-center my-auto">
				<span><?php echo $this->lang->line('copyright'); ?></span>
			</div>
		</div>
	</footer>

</div>
<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
	<i class="fas fa-angle-up"></i>
</a>

<!-- Sale Modal -->
<div class="modal fade" id="saleModal" tabindex="-1" role="dialog" aria-labelledby="saleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="saleModalTitle"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form  id="salePForm" method="post" action="<?php echo base_url("admin/sale_product") ?>">
				<input id="saleId" name="saleId" value="<?php echo set_value('saleId'); ?>" type="hidden" class="form-control">
				<?php if(isset($billId) && $billId != '') { ?>
					<input id="salePBillId" name="salePBillId" value="<?php echo $billRow[0]['id']; ?>" type="hidden" class="form-control">
				<?php } ?>
				<input id="salePId" name="salePId" value="<?php echo set_value('salePId'); ?>" type="hidden" class="form-control">
				<div class="modal-body">
					<div class="form-row">
						<div class="form-group col-md-8">
							<label for="salePName"><?php echo $this->lang->line('product_name'); ?></label>
							<input type="text" class="form-control" id="salePName" placeholder="<?php echo $this->lang->line('product_name'); ?>" disabled>
						</div>
						<div class="form-group col-md-4">
							<label for="salePUnit"><?php echo $this->lang->line('unit'); ?></label>
							<input type="text" class="form-control" id="salePUnit" placeholder="<?php echo $this->lang->line('unit'); ?>" disabled>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-8">
							<label for="salePQuantity"><?php echo $this->lang->line('select')." ".$this->lang->line('quantity'); ?></label>
							<input type="number" class="form-control" id="salePQuantity" name="salePQuantity" placeholder="<?php echo $this->lang->line('select')." ".$this->lang->line('quantity'); ?>" min="1" required>
						</div>
						<div class="form-group col-md-4">
							<label for="salePRemaining"><?php echo $this->lang->line('remaining'); ?></label>
							<input type="text" class="form-control" id="salePRemaining" placeholder="<?php echo $this->lang->line('remaining'); ?>" disabled>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-8">
							<label for="salePEPrice"><?php echo $this->lang->line('estimated')." ".$this->lang->line('price'); ?></label>
							<input type="text" class="form-control" id="salePEPrice" placeholder="<?php echo $this->lang->line('estimated')." ".$this->lang->line('price'); ?>" disabled>
						</div>
						<div class="form-group col-md-4">
							<label for="salePPrice"><?php echo $this->lang->line('price')." ".$this->lang->line('per')." ".$this->lang->line('unit'); ?></label>
							<input type="text" class="form-control" id="salePPrice" placeholder="<?php echo $this->lang->line('price')." ".$this->lang->line('per')." ".$this->lang->line('unit'); ?>" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="salePDiscount"><?php echo $this->lang->line('discount')."% (".$this->lang->line('if')." ".$this->lang->line('any').")"; ?></label>
						<input type="text" class="form-control" id="salePDiscount" name="salePDiscount" placeholder="<?php echo $this->lang->line('discount')."% (".$this->lang->line('if')." ".$this->lang->line('any').")"; ?>">
					</div>
					<div class="form-group">
						<textarea  class="form-control" id="salePComment" name="salePComment" value="<?php echo set_value('salePComment'); ?>" placeholder="<?php echo $this->lang->line('product_comments'); ?> (<?php echo $this->lang->line('optional'); ?>)" form="salePForm"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
					<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('sold'); ?></button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="profileImgViewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php echo $this->lang->line('image'); ?> <?php echo $this->lang->line('preview'); ?></h5>
				<button type="button" class="close closeBillModal" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<img src="" id="profileImagePreview" style="max-width: 100%" >
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
			</div>
		</div>
	</div>
</div>

<!-- Bill Modal -->
<div class="modal fade" id="billModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="billModalTitle"></h5>
				<button type="button" class="close closeBillModal" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger" role="alert" id="createBillBackendError"  style="text-align: center; display:none;"></div>
				<form id="billForm" name="billForm">
					<h5><b><?php echo $this->lang->line('bill').' '.$this->lang->line('information'); ?></b></h5>
					<div class="form-group">
						<div class="form-label-group">
							<input id="addProductBillId" name="addProductBillId" value="<?php echo set_value('addProductBillId'); ?>" type="hidden" class="form-control">
							<input type="text" id="billNumber" name="billNumber" value="<?php echo set_value('billNumber'); ?>" class="form-control" placeholder="Bill Number">
							<label for="billNumber"><?php echo $this->lang->line('bill').' '.$this->lang->line('number'); ?></label>
							<div class="alert alert-warning" role="alert" id="billNumberError"  style="text-align: center; display:none;"></div>
						</div>
					</div>
					<div class="form-group">
						<textarea  class="form-control" id="billComment" name="billComment"  value="<?php echo set_value('billComment'); ?>" placeholder="<?php echo $this->lang->line('bill_comments'); ?> (<?php echo $this->lang->line('optional'); ?>)" form="billForm"></textarea>
					</div>

					<div id="tempInvoice" style="display:none;">
						<h5><b><?php echo $this->lang->line('invoice'); ?></b></h5>
						<div class="form-group">
							<div class="form-row">
								<div class="form-group col-md-3">
									<?php echo $this->lang->line('product_name'); ?><br>
									<span id="tempInvoiceName">
										<span class="invoicePName0"></span><br class="invoicePName0">
									</span>
									<b><?php echo $this->lang->line('total'); ?>: <span id="tempInvoiceTotal1">1</span></b>
								</div>
								<div class="form-group col-md-2">
									<?php echo $this->lang->line('quantity'); ?><br>
									<span id="tempInvoiceQuantity">
										<span id="invoiceQuantity0" class="invoiceQuantity0"></span><br class="invoiceQuantity0">
									</span>
									<b><span id="tempInvoiceTotal2"></span></b>
								</div>
								<div class="form-group col-md-2">
									<?php echo $this->lang->line('price'); ?>/<?php echo $this->lang->line('quantity'); ?><br>
									<span id="tempInvoicePrice">
										<span id="invoicePrice0" class="invoicePrice0"></span><br class="invoicePrice0">
									</span>
									<b><span id="tempInvoiceTotal3"></span></b>
								</div>
							</div>
						</div>
					</div>

					<div style="margin-top: 50px; margin-bottom: 20px;" class="d-sm-flex align-items-center justify-content-between mb-4">
						<h5><b><?php echo $this->lang->line('product'); ?>(s) <?php echo $this->lang->line('information'); ?></b></h5>
						<button id="addMoreProducts" type="button" class="btn btn-outline-primary"><?php echo $this->lang->line('add_more'); ?></button>
					</div>

					<div id="productsRow">
						<!--							<div class="form-group">-->
						<!--								<div class="form-row">-->
						<!--									<button style="margin-left: auto;" type="button" class="close" id="removeProductRow" aria-label="Close">-->
						<!--										<span aria-hidden="true">&times;</span>-->
						<!--									</button>-->
						<!--								</div>-->
						<!--							</div>-->
						<div class="form-group">
							<div>
								<input type="text" id="productId0" name="productId[]" class="form-control" style="text-align: center; display:none;">
								<input type="text" id="productName0" name="productName[]" data-id="0" class="form-control detectNameInput" placeholder="<?php echo $this->lang->line('product_name'); ?>">
								<div class="alert alert-warning" role="alert" id="productNameError0"  style="text-align: center; display:none;"></div>
							</div>
						</div>
						<div class="form-group">
							<div class="form-row">
								<div class="form-group col-md-5">
									<input type="text" id="productQuantity0" name="productQuantity[]" value="<?php echo set_value('productQuantity[]'); ?>" data-id="0" class="form-control detectQuantityInput" placeholder="<?php echo $this->lang->line('quantity'); ?>">
									<div class="alert alert-warning" role="alert" id="productQuantityError0"  style="text-align: center; display:none;"></div>
								</div>
								<div class="form-group col-md-5">
									<input type="text" id="productPrice0" name="productPrice[]" value="<?php echo set_value('productPrice[]'); ?>" data-id="0" class="form-control detectPriceInput" placeholder="<?php echo $this->lang->line('price'); ?>/<?php echo $this->lang->line('unit'); ?>">
									<div class="alert alert-warning" role="alert" id="productPriceError0"  style="text-align: center; display:none;"></div>
								</div>
								<div class="form-group col-md-2">
									<select id="productUnit0" name="productUnit[]" class="form-control">
										<option value="/KG">/<?php echo $this->lang->line('kg'); ?></option>
										<option value="/Metre">/<?php echo $this->lang->line('metre'); ?></option>
										<option value="/Square Metre">/<?php echo $this->lang->line('square'); ?> <?php echo $this->lang->line('metre'); ?></option>
										<option value="/1000 Metre">/1000 <?php echo $this->lang->line('metre'); ?></option>
										<option value="/100 Metre">/100 <?php echo $this->lang->line('metre'); ?></option>
										<option value="/10 Metre">/10 <?php echo $this->lang->line('metre'); ?></option>
										<option value="/100 GM">/100 <?php echo $this->lang->line('gm'); ?></option>
										<option value="/100 Millilitres">/100 <?php echo $this->lang->line('millilitres'); ?></option>
										<option value="/Item Included">/<?php echo $this->lang->line('item_included'); ?></option>
										<option value="Other"><?php echo $this->lang->line('other'); ?></option>
									</select>
									<div class="alert alert-warning" role="alert" id="productUnitError0"  style="text-align: center; display:none;"></div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<textarea  class="form-control" id="productComment0" name="productComment[]" value="<?php echo set_value('productComment[]'); ?>" placeholder="<?php echo $this->lang->line('product_comments'); ?> (<?php echo $this->lang->line('optional'); ?>)" form="billForm"></textarea>
						</div>
						<div class="form-group">
							<textarea  class="form-control" id="productDescription0" name="productDescription[]" value="<?php echo set_value('productDescription[]'); ?>" placeholder="<?php echo $this->lang->line('product').' '.$this->lang->line('description'); ?> (<?php echo $this->lang->line('optional'); ?>)" form="billForm"></textarea>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary closeBillModal" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
				<button id="submitBillButton" type="button" class="btn btn-primary"></button>
			</div>
		</div>
	</div>
</div>

<!-- Delete Bill Modal -->
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteBillModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="deleteBillModalLabel"><?php echo $this->lang->line('confirm').' '.$this->lang->line('delete'); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input id="deleteBillId" type="hidden" class="form-control">
				<input id="deleteProductId" type="hidden" class="form-control">
				<?php echo $this->lang->line('sure').$this->lang->line('delete').'?'; ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
				<button type="button" id="deleteBill" class="btn btn-danger"><?php echo $this->lang->line('delete'); ?></button>
			</div>
		</div>
	</div>
</div>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><?php echo $this->lang->line('ready_to_leave'); ?>?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body"><?php echo $this->lang->line('select'); ?> "<?php echo $this->lang->line('logout'); ?>" <?php echo $this->lang->line('select_below_message'); ?>.</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
				<a class="btn btn-primary" href="<?php echo base_url('logout/1'); ?>"><?php echo $this->lang->line('logout'); ?></a>
			</div>
		</div>
	</div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

<!-- Page level plugin JavaScript-->
<script src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.js') ?>"></script>


<!-- Custom scripts for all pages-->
<script src="<?php echo base_url('assets/js/sb-admin.min.js') ?>"></script>

<!-- Demo scripts for this page-->
<script src="<?php echo base_url('assets/js/demo/datatables-demo.js') ?>"></script>

<!-- Custom JavaScript Files-->
<script src="<?php echo base_url('assets/js/adminevents.js') ?>"></script>
<script src="<?php echo base_url('assets/js/saleevents.js') ?>"></script>

</body>

</html>

<!-- end of footer -->
