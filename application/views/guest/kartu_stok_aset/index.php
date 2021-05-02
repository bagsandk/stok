  <section class="section">
      <div class="section-header">
          <h1>DATA KARTU STOK ASET</h1>
      </div>
      <div class="section-body">
          <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                  <div class="card">
                      <div class="card-header">
                          <a href="<?= base_url('kartu_stok_aset/add') ?>" class="badge badge-success">Tambah</a>
                          <!-- <a href="rawbt:data:application/pdf;base64,<?= $base64 ?>" class="badge badge-success">Test</a> -->
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-striped" id="myTable">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>QRCode</th>
                                          <th>Gambar</th>
                                          <th>No Inventasis</th>
                                          <th>harga Perolehan</th>
                                          <th>Masa Manfaat</th>
                                          <th>Suplier</th>
                                          <th>Pengguna</th>
                                          <th>No PO</th>
                                          <th>Status Perolehan</th>
                                          <th>Lokasi</th>
                                          <th>Kondisi</th>
                                          <th>Garansi</th>
                                          <th>Nomor</th>
                                          <th>Kendaraan</th>
                                          <th>Actions</th>
                                      </tr>
                                  </thead>
                                  <tbody id="pp">
                                      <?php
                                        $no = 1;
                                        foreach ($kartu_stok_aset_ as $t) { ?>
                                          <tr>
                                              <td><?php echo $no; ?></td>
                                              <td>
                                                  <button type="button" class="btn btn-primary btn-sm m-1" data-html="true" data-toggle="popover" title="<?= $t['noInventaris']; ?>" data-content="<img class='img-responsive' src='<?= base_url('assets/img/' . $t['noInventaris'] . '.png') ?>'>">Detail</button>
                                                  <a href="javascript:void(0)" data-id="<?= $t['noInventaris'] ?>" class="btn btn-sm btn-warning m-1 cetak">Cetak</a>
                                              </td>
                                              <td>
                                                  <?php $gambar =  view('product', ['id' => $t['productId']], 'gambar') ?>
                                                  <?php if ($gambar == '-') { ?>
                                                      <?= form_open_multipart('kartu_stok_aset/uploadgambar/' . $t['productId']); ?>
                                                      <label class="selectgroup-item">
                                                          <input onchange="this.form.submit();" type="file" name="gambar" capture="camera" class="selectgroup-input" accept="image/*">
                                                          <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-camera"></i></span>
                                                      </label>
                                                      <?= form_close(); ?>
                                                  <?php } else { ?>
                                                      <img width="80"  alt="image" src="<?= base_url('assets/img/aset/' . view('product', ['id' => $t['productId']], 'gambar')) ?>" class="img-fluid" data-html="true" data-toggle="popover" data-content="<img class='img-responsive' src='<?= base_url('assets/img/aset/' . view('product', ['id' => $t['productId']], 'gambar')) ?>' width='240'>">
                                                      <?= form_open_multipart('kartu_stok_aset/uploadgambar/' . $t['productId']); ?>
                                                      <label class="selectgroup-item">
                                                          <input onchange="this.form.submit();" type="file" name="gambar" capture="camera" class="selectgroup-input" accept="image/*">
                                                          <span class="mt-2 badge badge-warning">
                                                              Upload ulang
                                                          </span>
                                                      </label>
                                                      <?= form_close(); ?>
                                                  <?php } ?>
                                              </td>
                                              <td><?= $t['noInventaris']; ?></td>
                                              <td><?= 'Rp ' . number_format($t['hargaPerolehan']); ?></td>
                                              <td><?= $t['masaManfaat']; ?></td>
                                              <td><?= $t['supplier']; ?></td>
                                              <td><?= $t['pengguna']; ?></td>
                                              <td><?= $t['noPo']; ?></td>
                                              <td><?= $t['statusPerolehan']; ?></td>
                                              <td><?= $t['lokasi']; ?></td>
                                              <td><?= $t['kondisi']; ?></td>
                                              <td>
                                                  <?php if ($t['isWaranty']) { ?>
                                                      <ul>
                                                          <li>NO :
                                                              <?= view('kartu_garansi', ['noInventaris' => $t['noInventaris']], 'noKartuGaransi'); ?>
                                                          </li>
                                                          <li>Masa :
                                                              <?= view('kartu_garansi', ['noInventaris' => $t['noInventaris']], 'masaGaransi'); ?>
                                                          </li>
                                                          <li>Jenis :
                                                              <?= view('kartu_garansi', ['noInventaris' => $t['noInventaris']], 'jenisGaransi'); ?>
                                                          </li>
                                                      </ul>
                                                  <?php } else { ?>
                                                      Tidak Bergaransi
                                                  <?php } ?>
                                              <td>
                                                  <ul>
                                                      <?php
                                                        $nomor = $this->db->get_where('ksa_nomor', ['ksa' => $t['noInventaris']])->result_array();
                                                        foreach ($nomor as $n) {
                                                        ?>
                                                          <li><?= $n['nama'] . ' : ' . $n['nomor'] ?></li>
                                                      <?php } ?>
                                                  </ul>
                                              </td>
                                              <td><?php if (view('ksa_kendaraan', ['ksa' => $t['noInventaris']], 'namaStnk') != '') { ?>
                                                      <ul>
                                                          <li>Nama :
                                                              <?= view('ksa_kendaraan', ['ksa' => $t['noInventaris']], 'namaStnk'); ?>
                                                          </li>
                                                          <li>Alamat :
                                                              <?= view('ksa_kendaraan', ['ksa' => $t['noInventaris']], 'alamatStnk'); ?>
                                                          </li>
                                                      </ul>
                                                  <?php } ?>
                                              </td>
                                              <td>
                                                  <a href="<?php echo base_url('kartu_stok_aset/edit/' . $t['noInventaris']); ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-pen"></span></a>
                                                  <a href="<?php echo base_url('kartu_stok_aset/remove/' . $t['noInventaris']); ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete"><span class="fa fa-trash"></span></a>
                                              </td>
                                          </tr>
                                      <?php
                                            $no++;
                                        } ?>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>

          </div>
      </div>
  </section>

  <script>
      $(function() {
          $('[data-toggle=popover]').popover({
              html: true
          })
      })
  </script>