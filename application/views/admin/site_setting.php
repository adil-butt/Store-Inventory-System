<!-- Begin Page Content -->
<div class="container-fluid" style="margin-top: 50px">
	<?php $this->load->view('template/success_error_message'); ?>
	<a style="font-size: x-large; color: black" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
		<i class="fas fa-fw fa-images"></i>
		<span><?php echo $this->lang->line('change').' '.$this->lang->line('slider').' '.$this->lang->line('images'); ?></span>
	</a>

	<div class="collapse" id="collapseExample">
		<div class="card card-body">
			<form method="post" action="<?php echo base_url('site_setting') ?>" enctype="multipart/form-data">
				<div class="form-group collapse-item">
					<div class="form-label-group">
						<input type="file" name="sliderImage1" id="sliderImage1" />
						<?php echo form_label($this->lang->line('slider').' '.$this->lang->line('image').' 1 ('.$this->lang->line('optional').') '.$this->lang->line('only').' .jpg '.$this->lang->line('format'), 'sliderImage1'); ?>
					</div>
				</div>
				<div class="form-group collapse-item">
					<div class="form-label-group">
						<input type="file" name="sliderImage2" id="sliderImage2" />
						<?php echo form_label($this->lang->line('slider').' '.$this->lang->line('image').' 2 ('.$this->lang->line('optional').') '.$this->lang->line('only').' .jpg '.$this->lang->line('format'), 'sliderImage2'); ?>
					</div>
				</div>
				<div class="form-group collapse-item">
					<div class="form-label-group">
						<input type="file" name="sliderImage3" id="sliderImage3" />
						<?php echo form_label($this->lang->line('slider').' '.$this->lang->line('image').' 3 ('.$this->lang->line('optional').') '.$this->lang->line('only').' .jpg '.$this->lang->line('format'), 'sliderImage3'); ?>
					</div>
				</div>
				<div class="dropdown-divider"></div>
				<div class="form-group collapse-item">
					<div class="form-label-group">
						<button type="submit" class="button btn btn-primary"><?php echo $this->lang->line('update'); ?></button>
					</div>
				</div>
			</form>
		</div>
	</div>

</div>
