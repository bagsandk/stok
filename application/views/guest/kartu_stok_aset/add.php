<section class="section">
	<div class="section-header">
		<h1>TAMBAH DATA KARTU STOK ASET</h1>
	</div>
	<div class="section-body">
		<div class="row">
			<div class="col-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<?php echo form_open('kartu_stok_aset/add'); ?>
						<div class="row">
							<div class="col-md-12">
								<label for="productId" class="control-label"><span class="text-danger">*</span>Produk</label>
								<div class="form-group">
									<select name="productId" class="form-control select2 select2">
										<option value="">Pilih Produk</option>
										<?php
										foreach ($produk as $value) {
											$selected = ($value['id'] == $this->input->post('productId')) ? ' selected="selected"' : "";
											echo '<option value="' . $value['id'] . '" ' . $selected . '>' . $value['nama'] . ' | ' . $value['merek'] . ' | ' . $value['satuan'] . '</option>';
										}
										?>
									</select>
									<span class="text-danger"><?php echo form_error('productId'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="departement" class="control-label"><span class="text-danger">*</span>Departement</label>
								<div class="form-group">
									<select name="departement" class="form-control select2 select2">
										<option value="">Pilih Departement</option>
										<?php
										$departement = ['BAAK','SDM'];
										foreach ($departement as $value) {
											$selected = ($value == $this->input->post('departement')) ? ' selected="selected"' : "";
											echo '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>';
										}
										?>
									</select>
									<span class="text-danger"><?php echo form_error('departement'); ?></span>
								</div>
							</div>
							<!-- <div class="col-md-6">
								<label for="noInventaris" class="control-label"><span class="text-danger">*</span>No Inventaris</label>
								<div class="form-group">
									<input type="text" name="noInventaris" value="<?php echo $this->input->post('noInventaris'); ?>" class="form-control" id="noInventaris" />
									<span class="text-danger"><?php echo form_error('noInventaris'); ?></span>
								</div>
							</div> -->
							<div class="col-md-6">
								<label for="noPo" class="control-label"><span class="text-danger">*</span>No PO</label>
								<div class="form-group">
									<input type="text" name="noPo" value="<?php echo $this->input->post('noPo'); ?>" class="form-control" id="noPo" />
									<span class="text-danger"><?php echo form_error('noPo'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="pengguna" class="control-label"><span class="text-danger">*</span>Pengguna</label>
								<div class="form-group">
									<input type="text" name="pengguna" value="<?php echo $this->input->post('pengguna'); ?>" class="form-control" id="pengguna" />
									<span class="text-danger"><?php echo form_error('pengguna'); ?></span>
								</div>
							</div>

							<div class="col-md-6">
								<label for="ruang" class="control-label"><span class="text-danger">*</span>Ruang</label>
								<div class="form-group">
									<input type="text" name="ruang" value="<?php echo $this->input->post('ruang'); ?>" class="form-control" id="ruang" />
									<span class="text-danger"><?php echo form_error('ruang'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="masaManfaat" class="control-label"><span class="text-danger">*</span>Masa Manfaat</label>
								<div class="form-group">
									<input type="text" name="masaManfaat" value="<?php echo $this->input->post('masaManfaat'); ?>" class="form-control" id="masaManfaat" />
									<span class="text-danger"><?php echo form_error('masaManfaat'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="supplier" class="control-label"><span class="text-danger">*</span>Supplier</label>
								<div class="form-group">
									<input type="text" name="supplier" value="<?php echo $this->input->post('supplier'); ?>" class="form-control" id="supplier" />
									<span class="text-danger"><?php echo form_error('supplier'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="hargaPerolehan" class="control-label"><span class="text-danger">*</span>Harga Perolehan</label>
								<div class="form-group">
									<input type="text" name="hargaPerolehan" value="<?php echo $this->input->post('hargaPerolehan'); ?>" class="form-control currency" id="hargaPerolehan" />
									<span class="text-danger"><?php echo form_error('hargaPerolehan'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="statusPerolehan" class="control-label"><span class="text-danger">*</span>Status Perolehan</label>
								<div class="form-group">
									<select name="statusPerolehan" class="form-control select2 select2">
										<option value="">Pilih Status Perolehan</option>
										<?php
										$statusPerolehan = ['Beli','Hibah'];
										foreach ($statusPerolehan as $value) {
											$selected = ($value == $this->input->post('statusPerolehan')) ? ' selected="selected"' : "";
											echo '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>';
										}
										?>
									</select>
									<span class="text-danger"><?php echo form_error('statusPerolehan'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="lokasi" class="control-label"><span class="text-danger">*</span>Lokasi</label>
								<div class="form-group">
									<input type="text" name="lokasi" value="<?php echo $this->input->post('lokasi'); ?>" class="form-control" id="lokasi" />
									<span class="text-danger"><?php echo form_error('lokasi'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="kondisi" class="control-label"><span class="text-danger">*</span>Kondisi</label>
								<div class="form-group">
									<select name="kondisi" class="form-control select2 select2">
										<option value="">Pilih kondisi</option>
										<?php
										$kondisi = ['Baik','Rusak'];
										foreach ($kondisi as $value) {
											$selected = ($value == $this->input->post('kondisi')) ? ' selected="selected"' : "";
											echo '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>';
										}
										?>
									</select>
									<span class="text-danger"><?php echo form_error('kondisi'); ?></span>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="custom-switch mt-2">
										<input type="checkbox" <?= $this->input->post('isWaranty') ? 'checked="true"' : '' ?> value="true" name="isWaranty" id="isWaranty" class="custom-switch-input">
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">Garansi</span>
									</label>
								</div>
							</div>
							<div id="formWaranty" class="col-md-12" <?= $this->input->post('isWaranty') ? '' : 'hidden' ?>>
								<div class="row">
									<div class="col-md-4">
										<label for="noKartuGaransi" class="control-label"><span class="text-danger">*</span>No Kartu Garansi</label>
										<div class="form-group">
											<input type="text" name="noKartuGaransi" value="<?php echo $this->input->post('noKartuGaransi'); ?>" class="form-control" id="noKartuGaransi" />
											<span class="text-danger"><?php echo form_error('noKartuGaransi'); ?></span>
										</div>
									</div>
									<div class="col-md-4">
										<label for="jenisGaransi" class="control-label"><span class="text-danger">*</span>Jenis Garansi</label>
										<div class="form-group">
											<input type="text" name="jenisGaransi" value="<?php echo $this->input->post('jenisGaransi'); ?>" class="form-control" id="jenisGaransi" />
											<span class="text-danger"><?php echo form_error('jenisGaransi'); ?></span>
										</div>
									</div>
									<div class="col-md-4">
										<label for="masaGaransi" class="control-label"><span class="text-danger">*</span>Masa Garansi per Bulan</label>
										<div class="form-group">
											<input type="number" name="masaGaransi" value="<?php echo $this->input->post('masaGaransi'); ?>" class="form-control" id="masaGaransi" />
											<span class="text-danger"><?php echo form_error('masaGaransi'); ?></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="custom-switch mt-2">
										<input type="checkbox" value="true" name="isKendaraan" id="kendaraan" class="custom-switch-input" <?= $this->input->post('isKendaraan') ? 'checked="true"' : '' ?>>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">Kendaraan</span>
									</label>
								</div>
							</div>
							<div id="formKendaraan" class="col-md-12" <?= $this->input->post('isKendaraan') ? '' : 'hidden' ?>>
								<div class="row">
									<div class="col-md-4">
										<label for="namaStnk" class="control-label"><span class="text-danger">*</span>Nama STNK</label>
										<div class="form-group">
											<input type="text" name="namaStnk" value="<?php echo $this->input->post('namaStnk'); ?>" class="form-control" id="namaStnk" />
											<span class="text-danger"><?php echo form_error('namaStnk'); ?></span>
										</div>
									</div>
									<div class="col-md-4">
										<label for="alamatStnk" class="control-label"><span class="text-danger">*</span>Alamat STNK</label>
										<div class="form-group">
											<input type="text" name="alamatStnk" value="<?php echo $this->input->post('alamatStnk'); ?>" class="form-control" id="alamatStnk" />
											<span class="text-danger"><?php echo form_error('alamatStnk'); ?></span>
										</div>
									</div>
									<div class="col-md-4">
										<label for="peruntukan" class="control-label"><span class="text-danger">*</span>Peruntukan</label>
										<div class="form-group">
											<input type="text" name="peruntukan" value="<?php echo $this->input->post('peruntukan'); ?>" class="form-control" id="peruntukan" />
											<span class="text-danger"><?php echo form_error('peruntukan'); ?></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="custom-switch mt-2">
										<input type="checkbox" value="true" name="isNomor" id="isNomor" class="custom-switch-input" <?= $this->input->post('isNomor') ? 'checked="true"' : '' ?>>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">Penomoran</span>
									</label>
								</div>
							</div>
							<div class="col-md-12" <?= $this->input->post('isNomor') ? '' : 'hidden' ?> id="formInputNomor">
								<div id="formTambahNomor-0" class="col-md-12 formTambahNomor">
									<div class="row">
										<div class="col-md-5">
											<label for="nama" class="control-label">Nama Nomor</label>
											<div class="form-group">
												<input type="text" name="nama[]" value="<?php echo $this->input->post('nama[0]'); ?>" class="form-control" id="nama" />
												<span class="text-danger"><?php echo form_error('nama'); ?></span>
											</div>
										</div>
										<div class="col-md-5">
											<label for="nomor" class="control-label">Nomor</label>
											<div class="form-group">
												<input type="text" name="nomor[]" value="<?php echo $this->input->post('nomor[0]'); ?>" class="form-control" id="nomor" />
												<span class="text-danger"><?php echo form_error('nomor'); ?></span>
											</div>
										</div>
										<div class="col-md-2 d-flex align-items-center">
											<button type="button" class=" btn btn-sm btn-rounded btn-success" id="tambahNomor">Tambah Nomor</button>
										</div>
									</div>
								</div>
								<?php ?>
								<?php if (!empty($this->input->post('nama')) && count($this->input->post('nama')) > 1) {
									foreach ($this->input->post('nama') as $i => $nom) { ?>
										<?php if ($i == 0) {
											continue;
										} ?>
										<div id="formTambahNomor-<?= $i ?>" class="col-md-12 formTambahNomor">
											<div class="row">
												<div class="col-md-5"> <label for="nama" class="control-label">Nama Nomor</label>
													<div class="form-group"> <input type="text" name="nama[]" value="<?php echo $this->input->post('nama[' . $i . ']'); ?>" class="form-control" id="nama" /> <span class="text-danger"><?php echo form_error('nama'); ?></span> </div>
												</div>
												<div class="col-md-5"> <label for="nomor" class="control-label">Nomor</label>
													<div class="form-group"> <input type="text" name="nomor[]" value="<?php echo $this->input->post('nomor[' . $i . ']'); ?>" class="form-control" id="nomor" /> <span class="text-danger"><?php echo form_error('nomor'); ?></span> </div>
												</div>
												<div class="col-md-2 d-flex align-items-center"> <button type="button" onclick="hapusNomor(<?= $i ?>)" class=" btn btn-sm btn-rounded btn-danger hapus-nomor" ">Hapus Nomor</button> </div> </div></div>
								<?php }
								} ?>
							</div>
						</div>
						<button type=" button" onclick="goBack()" class="btn btn-danger btn-sm">
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