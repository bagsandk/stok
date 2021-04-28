<section class="section">
	<div class="section-header">
		<h1>TAMBAH DATA RUANGAN</h1>
	</div>
	<div class="section-body">
		<div class="row">
			<div class="col-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<?php echo form_open('ruangan/add'); ?>
						<div class="row">
							<div class="col-md-6">
								<label for="gedungId" class="control-label"><span class="text-danger">*</span>Gedung</label>
								<div class="form-group">
									<select name="gedungId" class="form-control select2">
										<option value="">Pilih Gedung</option>
										<?php
										foreach ($gedung as $value) {
											$selected = ($value['id'] == $this->input->post('gedungId')) ? ' selected="selected"' : "";
											echo '<option value="' . $value['id'] . '" ' . $selected . '>' . $value['namaGedung'] . '</option>';
										}
										?>
									</select>
									<span class="text-danger"><?php echo form_error('gedungId'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="nama" class="control-label"><span class="text-danger">*</span>Nama</label>
								<div class="form-group">
									<input type="text" name="nama" value="<?php echo $this->input->post('nama'); ?>" class="form-control" id="nama" />
									<span class="text-danger"><?php echo form_error('nama'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="jenisRuangan" class="control-label"><span class="text-danger">*</span>Jenis Ruangan</label>
								<div class="form-group">
									<input type="text" name="jenisRuangan" value="<?php echo $this->input->post('jenisRuangan'); ?>" class="form-control" id="jenisRuangan" />
									<span class="text-danger"><?php echo form_error('jenisRuangan'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="posisiRuangan" class="control-label"><span class="text-danger">*</span>Posisi Ruangan</label>
								<div class="form-group">
									<input type="text" name="posisiRuangan" value="<?php echo $this->input->post('posisiRuangan'); ?>" class="form-control" id="posisiRuangan" />
									<span class="text-danger"><?php echo form_error('posisiRuangan'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="ukuranRuangan" class="control-label"><span class="text-danger">*</span>Ukuran Ruangan</label>
								<div class="form-group">
									<input type="text" name="ukuranRuangan" value="<?php echo $this->input->post('ukuranRuangan'); ?>" class="form-control" id="ukuranRuangan" />
									<span class="text-danger"><?php echo form_error('ukuranRuangan'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="kapasitasRuangan" class="control-label"><span class="text-danger">*</span>Kapasitas</label>
								<div class="form-group">
									<input type="number" name="kapasitasRuangan" value="<?php echo $this->input->post('kapasitasRuangan'); ?>" class="form-control" id="kapasitasRuangan" />
									<span class="text-danger"><?php echo form_error('kapasitasRuangan'); ?></span>
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