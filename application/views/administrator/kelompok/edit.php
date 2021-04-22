<section class="section">
	<div class="section-header">
		<h1>UBAH DATA KELOMPOK</h1>
	</div>
	<div class="section-body">
		<div class="row">
			<div class="col-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<?php echo form_open('kelompok/edit/' . $this->uri->segment(3)); ?>
						<div class="row">
							<div class="col-md-6">
								<label for="namaKelompok" class="control-label"><span class="text-danger">*</span>kelompok</label>
								<div class="form-group">
									<input type="text" name="namaKelompok" value="<?php echo ($this->input->post('namaKelompok') ? $this->input->post('namaKelompok') : $kelompok['namaKelompok']); ?>" class="form-control" id="namaKelompok" />
									<span class="text-danger"><?php echo form_error('namaKelompok'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="kodeGol" class="control-label"><span class="text-danger">*</span>Golongan</label>
								<div class="form-group">
									<select name="kodeGol" class="form-control select2">
										<?php

										foreach ($golongan_ as $value) {
											$selected = ($value['id'] == $kelompok['kodeGol']) ? ' selected="selected"' : "";

											echo '<option value="' . $value['id'] . '" ' . $selected . '>' . $value['namaGolongan'] . '</option>';
										}
										?>
									</select>
									<span class="text-danger"><?php echo form_error('kodeGol'); ?></span>
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