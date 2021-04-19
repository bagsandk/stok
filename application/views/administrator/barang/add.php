<section class="section">
	<div class="section-header">
		<h1>TAMBAH DATA BARANG</h1>
	</div>
	<div class="section-body">
		<div class="row">
			<div class="col-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<?php echo form_open('barang/add'); ?>
						<div class="row">
							<div class="col-md-6">
								<label for="barang" class="control-label"><span class="text-danger">*</span>Barang</label>
								<div class="form-group">
									<input type="text" name="barang" value="<?php echo $this->input->post('barang'); ?>" class="form-control" id="barang" />
									<span class="text-danger"><?php echo form_error('barang'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="kodeSub" class="control-label"><span class="text-danger">*</span>Sub Kelompok</label>
								<div class="form-group">
									<select name="kodeSub" class="form-control">
										<?php

										foreach ($subkelompok_ as $value) {
											$selected = ($value['id'] == $this->input->post('kodeSub')) ? ' selected="selected"' : "";

											echo '<option value="' . $value['id'] . '" ' . $selected . '>' . $value['namaSub'] . '</option>';
										}
										?>
									</select>
									<span class="text-danger"><?php echo form_error('kodeSub'); ?></span>
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