<section class="section">
	<div class="section-header">
		<h1>UBAH DATA KARTU STOK ASET</h1>
	</div>
	<div class="section-body">
		<div class="row">
			<div class="col-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<?php echo form_open('kartu_stok_aset/edit/' . $kartu_stok_aset['noInventaris']); ?>
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
								<label for="noInventaris" class="control-label"><span class="text-danger">*</span>No Inventaris</label>
								<div class="form-group">
									<input readonly type="text" name="noInventaris" value="<?php echo $this->input->post('noInventaris') ? $this->input->post('noInventaris') : $kartu_stok_aset['noInventaris']; ?>" class="form-control" id="noInventaris" />
									<span class="text-danger"><?php echo form_error('noInventaris'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="noPo" class="control-label"><span class="text-danger">*</span>No PO</label>
								<div class="form-group">
									<input type="text" name="noPo" value="<?php echo $this->input->post('noPo') ? $this->input->post('noPo') : $kartu_stok_aset['noPo']; ?>" class="form-control" id="noPo" />
									<span class="text-danger"><?php echo form_error('noPo'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="pengguna" class="control-label"><span class="text-danger">*</span>Pengguna</label>
								<div class="form-group">
									<input type="text" name="pengguna" value="<?php echo $this->input->post('pengguna') ? $this->input->post('pengguna') : $kartu_stok_aset['pengguna']; ?>" class="form-control" id="pengguna" />
									<span class="text-danger"><?php echo form_error('pengguna'); ?></span>
								</div>
							</div>

							<div class="col-md-3">
								<label for="gedung" class="control-label"><span class="text-danger">*</span>Gedung</label>
								<div class="form-group">
									<select id="gedung" name="gedung" class="form-control select2 select2">
										<option value="">Pilih Gedung</option>
										<?php
										foreach ($gedung as $value) {
											$selected = ($value['id'] == $this->input->post('gedung')) ? ' selected="selected"' : "";
											echo '<option value="' . $value['id'] . '" ' . $selected . '>' . $value['namaGedung'] . '</option>';
										}
										?>
									</select>
									<span class="text-danger"><?php echo form_error('gedung'); ?></span>
								</div>
							</div>
							<div class="col-md-3">
								<label for="ruang" class="control-label"><span class="text-danger">*</span>Ruang</label>
								<div class="form-group">
									<select id="ruang" name="ruang" class="form-control select2 select2">
										<option value="">Pilih Ruang</option>
									</select>
									<span class="text-danger"><?php echo form_error('ruang'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="masaManfaat" class="control-label"><span class="text-danger">*</span>Masa Manfaat</label>
								<div class="form-group">
									<input type="text" name="masaManfaat" value="<?php echo $this->input->post('masaManfaat') ? $this->input->post('masaManfaat') : $kartu_stok_aset['masaManfaat']; ?>" class="form-control" id="masaManfaat" />
									<span class="text-danger"><?php echo form_error('masaManfaat'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="supplier" class="control-label"><span class="text-danger">*</span>Supplier</label>
								<div class="form-group">
									<input type="text" name="supplier" value="<?php echo $this->input->post('supplier') ? $this->input->post('supplier') : $kartu_stok_aset['supplier']; ?>" class="form-control" id="supplier" />
									<span class="text-danger"><?php echo form_error('supplier'); ?></span>
								</div>
							</div>
							<div class="col-md-6">
								<label for="hargaPerolehan" class="control-label"><span class="text-danger">*</span>Harga Perolehan</label>
								<div class="form-group">
									<input type="text" name="hargaPerolehan" value="<?php echo $this->input->post('hargaPerolehan') ? $this->input->post('hargaPerolehan') : $kartu_stok_aset['hargaPerolehan']; ?>" class="form-control currency" id="hargaPerolehan" />
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
											$selected = ($value == $kartu_stok_aset['statusPerolehan']) ? ' selected="selected"' : "";
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
									<input type="text" name="lokasi" value="<?php echo $this->input->post('lokasi') ? $this->input->post('lokasi') : $kartu_stok_aset['lokasi']; ?>" class="form-control" id="lokasi" />
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
											$selected = ($value == $kartu_stok_aset['kondisi']) ? ' selected="selected"' : "";
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
										<input type="checkbox" <?= $kartu_garansi != null ? 'checked="true"' : '' ?> value="true" name="isWaranty" id="isWaranty" class="custom-switch-input">
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">Garansi</span>
									</label>
								</div>
							</div>
							<div id="formWaranty" class="col-md-12" <?= $kartu_garansi != null ? '' : 'hidden' ?>>
								<div class="row">
									<div class="col-md-4">
										<label for="noKartuGaransi" class="control-label"><span class="text-danger">*</span>No Kartu Garansi</label>
										<div class="form-group">
											<input type="text" name="noKartuGaransi" value="<?php echo $this->input->post('noKartuGaransi') ? $this->input->post('noKartuGaransi') : ($kartu_garansi != null ? $kartu_garansi['noKartuGaransi'] : ''); ?>" class="form-control" id="noKartuGaransi" />
											<span class="text-danger"><?php echo form_error('noKartuGaransi'); ?></span>
										</div>
									</div>
									<div class="col-md-4">
										<label for="jenisGaransi" class="control-label"><span class="text-danger">*</span>Jenis Garansi</label>
										<div class="form-group">
											<input type="text" name="jenisGaransi" value="<?php echo $this->input->post('jenisGaransi') ? $this->input->post('jenisGaransi') : ($kartu_garansi != null ? $kartu_garansi['jenisGaransi'] : ''); ?>" class="form-control" id="jenisGaransi" />
											<span class="text-danger"><?php echo form_error('jenisGaransi'); ?></span>
										</div>
									</div>
									<div class="col-md-4">
										<label for="masaGaransi" class="control-label"><span class="text-danger">*</span>Masa Garansi (per bulan)</label>
										<div class="form-group">
											<input type="number" name="masaGaransi" value="<?php echo $this->input->post('masaGaransi') ? $this->input->post('masaGaransi') : ($kartu_garansi != null ? $kartu_garansi['masaGaransi'] : ''); ?>" class="form-control" id="masaGaransi" />
											<span class="text-danger"><?php echo form_error('masaGaransi'); ?></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="custom-switch mt-2">
										<input type="checkbox" value="true" name="isKendaraan" id="kendaraan" class="custom-switch-input" <?= $ksa_kendaraan != null ? 'checked="true"' : '' ?>>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">Kendaraan</span>
									</label>
								</div>
							</div>
							<div id="formKendaraan" class="col-md-12" <?= $ksa_kendaraan != null ? '' : 'hidden' ?>>
								<div class="row">
									<div class="col-md-4">
										<label for="namaStnk" class="control-label"><span class="text-danger">*</span>Nama STNK</label>
										<div class="form-group">
											<input type="text" name="namaStnk" value="<?php echo $this->input->post('namaStnk') ? $this->input->post('namaStnk') : ($ksa_kendaraan != null ? $ksa_kendaraan['namaStnk'] : ''); ?>" class="form-control" id="namaStnk" />
											<span class="text-danger"><?php echo form_error('namaStnk'); ?></span>
										</div>
									</div>
									<div class="col-md-4">
										<label for="alamatStnk" class="control-label"><span class="text-danger">*</span>Alamat STNK</label>
										<div class="form-group">
											<input type="text" name="alamatStnk" value="<?php echo $this->input->post('alamatStnk') ? $this->input->post('alamatStnk') : ($ksa_kendaraan != null ? $ksa_kendaraan['alamatStnk'] : ''); ?>" class="form-control" id="alamatStnk" />
											<span class="text-danger"><?php echo form_error('alamatStnk'); ?></span>
										</div>
									</div>
									<div class="col-md-4">
										<label for="peruntukan" class="control-label"><span class="text-danger">*</span>Peruntukan</label>
										<div class="form-group">
											<input type="text" name="peruntukan" value="<?php echo $this->input->post('peruntukan') ? $this->input->post('peruntukan') : ($ksa_kendaraan != null ? $ksa_kendaraan['peruntukan'] : ''); ?>" class="form-control" id="peruntukan" />
											<span class="text-danger"><?php echo form_error('peruntukan'); ?></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="custom-switch mt-2">
										<input type="checkbox" value="true" name="isNomor" id="isNomor" class="custom-switch-input" <?= $ksa_nomor != null  ? 'checked="true"' : '' ?>>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">Penomoran</span>
									</label>
								</div>
							</div>
							<div class="col-md-12" <?= $ksa_nomor != null ? '' : 'hidden' ?> id="formInputNomor">
								<div id="formTambahNomor-0" class="col-md-12 formTambahNomor">
									<div class="row">
										<div class="col-md-2">
											<label for="kode" class="control-label">kode Nomor</label>
											<div class="form-group">
												<input readonly type="text" name="kode[]" value="<?php echo $this->input->post('kode[0]') ? $this->input->post('kode[0]') : ($ksa_nomor != null ? $ksa_nomor[0]['kode'] : ''); ?>" class="form-control" id="kode" />
												<span class="text-danger"><?php echo form_error('kode'); ?></span>
											</div>
										</div>
										<div class="col-md-4">
											<label for="nama" class="control-label">Nama Nomor</label>
											<div class="form-group">
												<input type="text" name="nama[]" value="<?php echo $this->input->post('nama[0]') ? $this->input->post('nama[0]') : ($ksa_nomor != null ? $ksa_nomor[0]['nama'] : ''); ?>" class="form-control" id="nama" />
												<span class="text-danger"><?php echo form_error('nama'); ?></span>
											</div>
										</div>
										<div class="col-md-4">
											<label for="nomor" class="control-label">Nomor</label>
											<div class="form-group">
												<input type="text" name="nomor[]" value="<?php echo $this->input->post('nomor[0]') ? $this->input->post('nomor[0]') : ($ksa_nomor != null ? $ksa_nomor[0]['nomor'] : ''); ?>" class="form-control" id="nomor" />
												<span class="text-danger"><?php echo form_error('nomor'); ?></span>
											</div>
										</div>
										<div class="col-md-2 d-flex align-items-center">
											<button type="button" class=" btn btn-sm btn-rounded btn-success" id="tambahNomor">Tambah Nomor</button>
										</div>
									</div>
								</div>
								<?php ?>
								<?php if ($ksa_nomor != null  && count($ksa_nomor) > 1) {
									foreach ($ksa_nomor as $i => $nom) { ?>
										<?php if ($i == 0) {
											continue;
										} ?>
										<div id="formTambahNomor-<?= $i ?>" class="col-md-12 formTambahNomor">
											<div class="row">
												<div class="col-md-2">
													<label for="kode" class="control-label">kode Nomor</label>
													<div class="form-group">
														<input readonly type="text" name="kode[]" value="<?php echo $nom['kode'] ?>" class="form-control" id="kode" />
														<span class="text-danger"><?php echo form_error('kode'); ?></span>
													</div>
												</div>
												<div class="col-md-4">
													<label for="nama" class="control-label">Nama Nomor</label>
													<div class="form-group"> <input type="text" name="nama[]" value="<?php echo $nom['nama']; ?>" class="form-control" id="nama" /> <span class="text-danger"><?php echo form_error('nama'); ?></span> </div>
												</div>
												<div class="col-md-4"> <label for="nomor" class="control-label">Nomor</label>
													<div class="form-group"> <input type="text" name="nomor[]" value="<?php echo $nom['nomor'] ?>" class="form-control" id="nomor" /> <span class="text-danger"><?php echo form_error('nomor'); ?></span> </div>
												</div>
												<div class="col-md-2 d-flex align-items-center"> <a onclick=" return confirmDeleteNomor(<?= $i ?>)" class=" btn btn-sm btn-rounded btn-danger hapus-nomor" href="<?= base_url('kartu_stok_aset/hapusnomor/'.$kartu_stok_aset['noInventaris'].'/'.$nom['kode']) ?>">Hapus Nomor</a>
												</div>
												
											</div>
										</div>
								<?php }
								} ?>
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