<section class="section">
	<div class="section-header">
		<h1>TAMBAH DATA GOLONGAN</h1>
	</div>
	<div class="section-body">
		<div class="row">
			<div class="col-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<?php echo form_open('golongan/add'); ?>
						<div class="row">
							<div class="col-md-6">
								<label for="golongan" class="control-label"><span class="text-danger">*</span>Golongan</label>
								<div class="form-group">
									<input type="text" name="golongan" value="<?php echo $this->input->post('golongan'); ?>" class="form-control" id="golongan" />
									<span class="text-danger"><?php echo form_error('golongan'); ?></span>
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