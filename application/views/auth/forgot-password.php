 <div class="container">
    <div class="card card-login mx-auto mt-5">
<<<<<<< HEAD
      <div class="card-header">Reset Password</div>
      <div class="card-body">
		  <?php $this->load->view('template/success_error_message'); ?>
        <div class="text-center mb-4">
          <h4>Forgot your password?</h4>
          <p>Enter your email address and we will send you instructions on how to reset your password.</p>
=======
      <div class="card-header"><?php echo $this->lang->line('reset').' '.$this->lang->line('password'); ?></div>
      <div class="card-body">
		  <?php $this->load->view('template/success_error_message'); ?>
        <div class="text-center mb-4">
          <h4><?php echo $this->lang->line('forgot').' '.$this->lang->line('your').' '.$this->lang->line('password'); ?>?</h4>
          <p><?php echo $this->lang->line('forgot_password_page'); ?>.</p>
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
        </div>
        <form method="post" action="">
          <div class="form-group">
            <div class="form-label-group">
<<<<<<< HEAD
              <input type="email" id="inputEmail" name="forgotPassEmail" class="form-control" placeholder="Enter email address" required="required" autofocus="autofocus">
              <label for="inputEmail">Enter email address</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="<?php echo base_url('reg') ?>">Register an Account</a>
          <a class="d-block small" href="<?php echo base_url('login') ?>">Login Page</a>
=======
              <input type="email" id="inputEmail" name="forgotPassEmail" class="form-control" placeholder="<?php echo $this->lang->line('enter').' '.$this->lang->line('email').' '.$this->lang->line('address'); ?>" required="required" autofocus="autofocus">
              <label for="inputEmail"><?php echo $this->lang->line('enter').' '.$this->lang->line('email').' '.$this->lang->line('address'); ?></label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block"><?php echo $this->lang->line('reset').' '.$this->lang->line('password'); ?></button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="<?php echo base_url('reg') ?>"><?php echo $this->lang->line('register').' '.$this->lang->line('an').' '.$this->lang->line('account'); ?></a>
          <a class="d-block small" href="<?php echo base_url('login') ?>"><?php echo $this->lang->line('login').' '.$this->lang->line('page'); ?></a>
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
        </div>
      </div>
    </div>
  </div>
