<?php if($this->session->flashdata('success')) : ?>
	<div class='alert alert-success' role='alert'><?php echo $this->session->flashdata('success'); ?></div>
	<?php $this->session->unset_userdata('success'); ?>
<?php endif; ?>
<?php if($this->session->flashdata('error')) : ?>
	<div class='alert alert-danger' role='alert'><?php echo $this->session->flashdata('error'); ?></div>
	<?php $this->session->unset_userdata('error'); ?>
<?php endif; ?>
