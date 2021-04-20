<section class="section">
	<div class="section-header">
		<h1>EDIT DATA KARTU STOK NON ASET</h1>
	</div>
	<div class="section-body">
		<div class="row">
			<div class="col-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<?php echo form_open('produk_kendaraan/edit/' . $produk_kendaraan['id']); ?>
						<div class="row">
							<div class="col-md-6">
								<label for="nama" class="control-label"><span class="text-danger">*</span>Nama Produk</label>
								<div class="form-group">
									<input type="text" name="nama" value="<?php echo $this->input->post('nama') ? $this->input->post('nama')  : view('product', ['id' => $kartu_stok_non_aset['productId']], 'nama') ?>" class="form-control" id="nama" />
									<span class="text-danger"><?php echo form_error('nama'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="kodeBarang" class="control-label"><span class="text-danger">*</span>Barang</label>
								<div class="form-group">
									<select name="kodeBarang" class="form-control">
										<?php
										foreach ($barang as $value) {
											$selected = ($value['id'] == view('product', ['id' => $kartu_stok_non_aset['productId']], 'kodeBarang')) ? ' selected="selected"' : "";
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
									<input type="text" name="merek" value="<?php echo $this->input->post('merek') ? $this->input->post('merek')  : view('product', ['id' => $kartu_stok_non_aset['productId']], 'merek') ?>" class="form-control" id="merek" />
									<span class="text-danger"><?php echo form_error('merek'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="satuan" class="control-label"><span class="text-danger">*</span>Satuan</label>
								<div class="form-group">
									<select name="satuan" class="form-control">
										<?php
										$stauan = ['pcs', 'kg', 'pack', 'dus', 'unit'];
										foreach ($stauan as $value) {
											$selected = ($value == view('product', ['id' => $kartu_stok_non_aset['productId']], 'satuan')) ? ' selected="selected"' : "";
											echo '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>';
										}
										?>
									</select>
									<span class="text-danger"><?php echo form_error('satuan'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="deskripsi" class="control-label"><span class="text-danger">*</span>Deskripsi Produk</label>
								<div class="form-group">
									<input type="text" name="deskripsi" value="<?php echo $this->input->post('deskripsi') ? $this->input->post('deskripsi')  : view('product', ['id' => $kartu_stok_non_aset['productId']], 'deskripsi') ?>" class="form-control" id="deskripsi" />
									<span class="text-danger"><?php echo form_error('deskripsi'); ?></span>
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
									<input type="text" name="lokasiRak" value="<?php echo $this->input->post('loaksiRak') ? $this->input->post('loaksiRak')  : view('kartu_stok_non_aset', ['id' => $kartu_stok_non_aset['id']], 'loaksiRak') ?>" class="form-control" id="lokasiRak" />
									<span class="text-danger"><?php echo form_error('lokasiRak'); ?></span>
								</div>
							</div>
							<!-- <div class="col-md-6">
								<label for="satuan" class="control-label"><span class="text-danger">*</span>Satuan</label>
								<div class="form-group">
									<select name="satuan" class="form-control">
										<?php
										// $stauan = ['pcs', 'kg', 'pack', 'dus', 'unit'];
										// foreach ($stauan as $value) {
										// 	$selected = ($value == $this->input->post('satuan')) ? ' selected="selected"' : "";
										// 	echo '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>';
										// }
										?>
									</select>
									<span class="text-danger"><?php //echo form_error('satuan'); ?></span>
								</div>
							</div> -->
							<div class="col-md-6">
								<label for="jumlahStok" class="control-label"><span class="text-danger">*</span>Jumlah Stok</label>
								<div class="form-group">
									<input type="text" name="jumlahStok" value="<?php echo $this->input->post('jumlahStok') ? $this->input->post('jumlahStok')  : view('kartu_stok_non_aset', ['id' => $kartu_stok_non_aset['id']], 'jumlahStok') ?>" class="form-control" id="jumlahStok" />
									<span class="text-danger"><?php echo form_error('jumlahStok'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="hargaRerata" class="control-label"><span class="text-danger">*</span>Harga Rerata</label>
								<div class="form-group">
									<input type="text" name="hargaRerata" value="<?php echo $this->input->post('hargaRerata') ? $this->input->post('hargaRerata')  : view('kartu_stok_non_aset', ['id' => $kartu_stok_non_aset['id']], 'hargaRerata') ?>" class="form-control" id="hargaRerata" />
									<span class="text-danger"><?php echo form_error('hargaRerata'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="saldoMin" class="control-label"><span class="text-danger">*</span>Minimal Saldo</label>
								<div class="form-group">
									<input type="text" name="saldoMin" value="<?php echo $this->input->post('saldoMin') ? $this->input->post('saldoMin')  : view('kartu_stok_non_aset', ['id' => $kartu_stok_non_aset['id']], 'saldoMin') ?>" class="form-control" id="saldoMin" />
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