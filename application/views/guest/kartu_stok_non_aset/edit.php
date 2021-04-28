<section class="section">
	<div class="section-header">
		<h1>EDIT DATA KARTU STOK NON ASET</h1>
	</div>
	<div class="section-body">
		<div class="row">
			<div class="col-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<?php echo form_open('kartu_stok_non_aset/edit/' . $kartu_stok_non_aset['id']); ?>
						<div class="row">
							<div class="col-md-12">
								<label for="productId" class="control-label"><span class="text-danger">*</span>Produk</label>
								<div class="form-group">
									<select name="productId" class="form-control select2">
										<?php
										foreach ($produk as $value) {
											$selected = ($value['id'] == $kartu_stok_aset['productId']) ? ' selected="selected"' : "";
											echo '<option value="' . $value['id'] . '" ' . $selected . '>' . $value['nama'] . ' | ' . $value['merek'] . ' | ' . $value['satuan'] . '</option>';
										}
										?>
									</select>
									<span class="text-danger"><?php echo form_error('productId'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="lokasiGudang" class="control-label"><span class="text-danger">*</span>Lokasi Gudang</label>
								<div class="form-group">
									<input type="text" name="lokasiGudang" value="<?php echo $this->input->post('lokasiGudang') ? $this->input->post('lokasiGudang')  : view('kartu_stok_non_aset', ['id' => $kartu_stok_non_aset['id']], 'lokasiGudang') ?>" class="form-control" id="lokasiGudang" />
									<span class="text-danger"><?php echo form_error('lokasiGudang'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="lokasiRak" class="control-label"><span class="text-danger">*</span>Lokasi Rak</label>
								<div class="form-group">
									<input type="text" name="lokasiRak" value="<?php echo $this->input->post('lokasiRak') ? $this->input->post('lokasiRak')  : view('kartu_stok_non_aset', ['id' => $kartu_stok_non_aset['id']], 'lokasiRak') ?>" class="form-control" id="lokasiRak" />
									<span class="text-danger"><?php echo form_error('lokasiRak'); ?></span>
								</div>
							</div>

							<div class="col-md-6">
								<label for="jumlahStok" class="control-label"><span class="text-danger">*</span>Jumlah Stok</label>
								<div class="form-group">
									<input type="number" name="jumlahStok" value="<?php echo $this->input->post('jumlahStok') ? $this->input->post('jumlahStok')  : view('kartu_stok_non_aset', ['id' => $kartu_stok_non_aset['id']], 'jumlahStok') ?>" class="form-control" id="jumlahStok" />
									<span class="text-danger"><?php echo form_error('jumlahStok'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="hargaRerata" class="control-label"><span class="text-danger">*</span>Harga Rerata</label>
								<div class="form-group">
									<input type="text" name="hargaRerata" value="<?php echo $this->input->post('hargaRerata') ? $this->input->post('hargaRerata')  : view('kartu_stok_non_aset', ['id' => $kartu_stok_non_aset['id']], 'hargaRerata') ?>" class="form-control currency" id="hargaRerata" />
									<span class="text-danger"><?php echo form_error('hargaRerata'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="saldoMin" class="control-label"><span class="text-danger">*</span>Minimal Saldo</label>
								<div class="form-group">
									<input type="number" name="saldoMin" value="<?php echo $this->input->post('saldoMin') ? $this->input->post('saldoMin')  : view('kartu_stok_non_aset', ['id' => $kartu_stok_non_aset['id']], 'saldoMin') ?>" class="form-control" id="saldoMin" />
									<span class="text-danger"><?php echo form_error('saldoMin'); ?></span>
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