<script src="<?php echo base_url('assets/vendor/chart.js/Chart.min.js') ?>"></script>
<div id="content-wrapper">

      <div class="container-fluid">
		  <?php $this->load->view('template/success_error_message'); ?>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
			  <a href="<?php echo base_url('admin') ?>"><?php echo $this->lang->line('dashboard'); ?></a>
          </li>
          <li class="breadcrumb-item active"><?php echo $this->lang->line('overview'); ?></li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-cart-plus"></i>
                </div>
                <div class="mr-5"><?php echo $this->lang->line('sales')." ".$this->lang->line('of')." ".$this->lang->line('today')." ".$todaySales; ?> </div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="<?php echo base_url('admin/sales'); ?>">
                <span class="float-left"><?php echo $this->lang->line('view_details'); ?></span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-cart-plus"></i>
                </div>
                <div class="mr-5"><?php echo $this->lang->line('sales')." ".$this->lang->line('of')." ".$this->lang->line('this')." ".$this->lang->line('month')." ".$monthSales; ?></div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="<?php echo base_url('admin/sales'); ?>">
                <span class="float-left"><?php echo $this->lang->line('view_details'); ?></span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5"><?php echo $this->lang->line('purchases')." ".$this->lang->line('of')." ".$this->lang->line('today')." ".$todayPurchases; ?></div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="<?php echo base_url('admin/all_products'); ?>">
                <span class="float-left"><?php echo $this->lang->line('view_details'); ?></span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5"><?php echo $this->lang->line('purchases')." ".$this->lang->line('of')." ".$this->lang->line('this')." ".$this->lang->line('month')." ".$monthPurchases; ?></div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="<?php echo base_url('admin/all_products'); ?>">
                <span class="float-left"><?php echo $this->lang->line('view_details'); ?></span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>

        <!-- Area Chart Example-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
			  <?php echo $this->lang->line('sales')." ".$this->lang->line('of')." ".$this->lang->line('the')." ".$this->lang->line('last')." ".$this->lang->line('month'); ?></div>
          <div class="card-body">
            <canvas id="myAreaChart" width="100%" height="30"></canvas>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->

	<script>
        var labels = <?php echo $chartLabels; ?>;
        var data = <?php echo $chartData; ?>;
	</script>
	<script src="<?php echo base_url('assets/js/demo/chart-area-demo.js') ?>"></script>
