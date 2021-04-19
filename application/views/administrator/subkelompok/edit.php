<section class="section">
	<div class="section-header">
		<h1>UBAH DATA SUB KELOMPOK</h1>
	</div>
	<div class="section-body">
		<div class="row">
			<div class="col-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<?php echo form_open('subkelompok/edit/' . $this->uri->segment(3)); ?>
						<div class="row">
							<div class="col-md-6">
								<label for="namaSub" class="control-label"><span class="text-danger">*</span>Sub Kelompok</label>
								<div class="form-group">
									<input type="text" name="namaSub" value="<?php echo ($this->input->post('namaSub') ? $this->input->post('namaSub') : $subkelompok['namaSub']); ?>" class="form-control" id="namaSub" />
									<span class="text-danger"><?php echo form_error('namaSub'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="kodeKelompok" class="control-label"><span class="text-danger">*</span>Kelompok</label>
								<div class="form-group">
									<select name="kodeKelompok" class="form-control">
										<?php
										foreach ($kelompok_ as $value) {
											$selected = ($value['id'] == $subkelompok['kodeKelompok']) ? ' selected="selected"' : "";

											echo '<option value="' . $value['id'] . '" ' . $selected . '>' . $value['namaKelompok'] . '</option>';
										}
										?>
									</select>
									<span class="text-danger"><?php echo form_error('kodeKelompok'); ?></span>
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