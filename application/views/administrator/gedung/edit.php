<section class="section">
	<div class="section-header">
		<h1>UBAH DATA DEPARTMENT</h1>
	</div>
	<div class="section-body">
		<div class="row">
			<div class="col-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<?php echo form_open('gedung/edit/' . $gedung['id']); ?>
						<div class="row">
							<div class="col-md-6">
								<label for="namaGedung" class="control-label"><span class="text-danger">*</span>Nama Gedung</label>
								<div class="form-group">
									<input type="text" name="namaGedung" value="<?php echo ($this->input->post('namaGedung') ? $this->input->post('namaGedung') : $gedung['namaGedung']); ?>" class="form-control" id="namaGedung" />
									<span class="text-danger"><?php echo form_error('namaGedung'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="thnPembangunan" class="control-label"><span class="text-danger">*</span>Tahun Pembangunan</label>
								<div class="form-group">
									<input type="number" name="thnPembangunan" value="<?php echo ($this->input->post('thnPembangunan') ? $this->input->post('thnPembangunan') : $gedung['thnPembangunan']); ?>" class="form-control" id="thnPembangunan" />
									<span class="text-danger"><?php echo form_error('thnPembangunan'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="luasGedung" class="control-label"><span class="text-danger">*</span>Luas Gedung</label>
								<div class="form-group">
									<input type="number" name="luasGedung" value="<?php echo ($this->input->post('luasGedung') ? $this->input->post('luasGedung') : $gedung['luasGedung']); ?>" class="form-control" id="luasGedung" />
									<span class="text-danger"><?php echo form_error('luasGedung'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="alamatGedung" class="control-label"><span class="text-danger">*</span>Alamat Gedung</label>
								<div class="form-group">
									<input type="text" name="alamatGedung" value="<?php echo ($this->input->post('alamatGedung') ? $this->input->post('alamatGedung') : $gedung['alamatGedung']); ?>" class="form-control" id="alamatGedung" />
									<span class="text-danger"><?php echo form_error('alamatGedung'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="jmlLantai" class="control-label"><span class="text-danger">*</span>Jumlah Lantai</label>
								<div class="form-group">
									<input type="number" name="jmlLantai" value="<?php echo ($this->input->post('jmlLantai') ? $this->input->post('jmlLantai') : $gedung['jmlLantai']); ?>" class="form-control" id="jmlLantai" />
									<span class="text-danger"><?php echo form_error('jmlLantai'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="jmlRuangan" class="control-label"><span class="text-danger">*</span>Jumlah Ruang</label>
								<div class="form-group">
									<input type="number" name="jmlRuangan" value="<?php echo ($this->input->post('jmlRuangan') ? $this->input->post('jmlRuangan') : $gedung['jmlRuangan']); ?>" class="form-control" id="jmlRuangan" />
									<span class="text-danger"><?php echo form_error('jmlRuangan'); ?></span>
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