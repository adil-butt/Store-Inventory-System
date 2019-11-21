<!-- Begin Page Content -->
<div class="container-fluid" style="margin-top: 50px">
	<?php $this->load->view('template/success_error_message'); ?>
	<div class="nav">
		<div class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="sliderImagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-fw fa-images"></i>
				<span style="font-size: x-large; color: black"><?php echo $this->lang->line('change').' '.$this->lang->line('slider').' '.$this->lang->line('images'); ?></span>
			</a>
			<div class="dropdown-menu" aria-labelledby="sliderImagesDropdown">
				<h6 class="dropdown-header"><?php echo $this->lang->line('select').' '.$this->lang->line('slider').' '.$this->lang->line('images').':'; ?></h6>
				<form class="dropdown-item" method="post" action="<?php echo base_url('site_setting') ?>" enctype="multipart/form-data">
					<div class="form-group">
						<div class="form-label-group">
							<input type="file" name="sliderImage1" id="sliderImage1" />
							<?php echo form_label($this->lang->line('slider').' '.$this->lang->line('image').' 1 ('.$this->lang->line('optional').')', 'sliderImage1'); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="form-label-group">
							<input type="file" name="sliderImage2" id="sliderImage2" />
							<?php echo form_label($this->lang->line('slider').' '.$this->lang->line('image').' 2 ('.$this->lang->line('optional').')', 'sliderImage2'); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="form-label-group">
							<input type="file" name="sliderImage3" id="sliderImage3" />
							<?php echo form_label($this->lang->line('slider').' '.$this->lang->line('image').' 3 ('.$this->lang->line('optional').')', 'sliderImage3'); ?>
						</div>
					</div>
					<div class="dropdown-divider"></div>
					<button type="submit" class="button btn btn-primary"><?php echo $this->lang->line('update'); ?></button>
				</form>
			</div>
		</div>
	</div>

</div>
