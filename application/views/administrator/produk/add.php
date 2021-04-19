<section class="section">
	<div class="section-header">
		<h1>TAMBAH DATA PRODUK</h1>
	</div>
	<div class="section-body">
		<div class="row">
			<div class="col-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<?php echo form_open('produk/add'); ?>
						<div class="row">
							<div class="col-md-6">
								<label for="nama" class="control-label"><span class="text-danger">*</span>Nama Produk</label>
								<div class="form-group">
									<input type="text" name="nama" value="<?php echo $this->input->post('nama'); ?>" class="form-control" id="nama" />
									<span class="text-danger"><?php echo form_error('nama'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="kodeBarang" class="control-label"><span class="text-danger">*</span>Barang</label>
								<div class="form-group">
									<select name="kodeBarang" class="form-control">
										<?php
										foreach ($barang as $value) {
											$selected = ($value['id'] == $this->input->post('kodeBarang')) ? ' selected="selected"' : "";
											echo '<option value="' . $value['id'] . '" ' . $selected . '>' . $value['namaBarang'] . '</option>';
										}
										?>
									</select>
									<span class="text-danger"><?php echo form_error('kodeBarang'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="merek" class="control-label"><span class="text-danger">*</span>Merek Produk</label>
								<div class="form-group">
									<input type="text" name="merek" value="<?php echo $this->input->post('merek'); ?>" class="form-control" id="merek" />
									<span class="text-danger"><?php echo form_error('merek'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="satuan" class="control-label"><span class="text-danger">*</span>Satuan</label>
								<div class="form-group">
									<select name="satuan" class="form-control">
										<?php
										$stauan = ['pcs','kg','pack','dus'];
										foreach ($stauan as $value) {
											$selected = ($value == $this->input->post('satuan')) ? ' selected="selected"' : "";
											echo '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>';
										}
										?>
									</select>
									<span class="text-danger"><?php echo form_error('satuan'); ?></span>
								</div>
							</div>
							<div class="col-md-12">
								<label for="deskripsi" class="control-label"><span class="text-danger">*</span>Deskripsi Produk</label>
								<div class="form-group">
									<input type="text" name="deskripsi" value="<?php echo $this->input->post('deskripsi'); ?>" class="form-control" id="deskripsi" />
									<span class="text-danger"><?php echo form_error('deskripsi'); ?></span>
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