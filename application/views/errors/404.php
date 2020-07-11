<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>404 Error</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.css') ?>" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url('assets/css/sb-admin.css') ?>" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="#"><?php echo $this->lang->line('page')." ".$this->lang->line('not')." ".$this->lang->line('found'); ?></a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
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
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">404 <?php echo $this->lang->line('error'); ?></li>
        </ol>

        <!-- Page Content -->
        <h1 class="display-1">404</h1>
        <p class="lead"><?php echo $this->lang->line('page_not_found'); ?>. <?php echo $this->lang->line('you_can'); ?>
          <a href="javascript:history.back()"><?php echo $this->lang->line('go_back'); ?></a>
			<?php echo $this->lang->line('to_the_previous_page'); ?>.</p>

      </div>
      <!-- /.container-fluid -->

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

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url('assets/js/sb-admin.min.js') ?>"></script>

</body>

</html>
