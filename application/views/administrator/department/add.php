<section class="section">
	<div class="section-header">
		<h1>TAMBAH DATA DEPARTMENT</h1>
	</div>
	<div class="section-body">
		<div class="row">
			<div class="col-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<?php echo form_open('department/add'); ?>
						<div class="row">
							<div class="col-md-6">
								<label for="nameShort" class="control-label"><span class="text-danger">*</span>Nama Pendek</label>
								<div class="form-group">
									<input type="text" name="nameShort" value="<?php echo $this->input->post('nameShort'); ?>" class="form-control" id="nameShort" />
									<span class="text-danger"><?php echo form_error('nameShort'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="nameLong" class="control-label"><span class="text-danger">*</span>Nama Panjang</label>
								<div class="form-group">
									<input type="text" name="nameLong" value="<?php echo $this->input->post('nameLong'); ?>" class="form-control" id="nameLong" />
									<span class="text-danger"><?php echo form_error('nameLong'); ?></span>
								</div>
							</div>
						</div>
						<button type="button" onclick="goBack()" class="btn btn-danger btn-sm">
							<i class="fas fa-arrow-left"></i> Kembali
						</button>
						<button type="submit" class="btn btn-success btn-sm">
							<i class="fa fa-check"></i> Simpan
						</button>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>