  <section class="section">
      <div class="section-header">
          <h1>DATA KARTU STOK ASET</h1>
      </div>
      <div class="section-body">
          <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                  <div class="card">
                      <div class="card-header">
                          <a href="<?= base_url('kartu_stok_aset/add') ?>" class="badge badge-success">Tambah Produk</a>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-striped" id="myTable">
                                  <thead>
                                      <tr>
                                          <th>No</th>
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
                                  <tbody>
                                      <?php
                                        $no = 1;
                                        foreach ($kartu_stok_aset_ as $t) { ?>
                                          <tr>
                                              <td><?php echo $no; ?></td>
                                              <td><?= $t['noInventaris']; ?></td>
                                              <td><?= $t['hargaPerolehan']; ?></td>
                                              <td><?= $t['masaManfaat']; ?></td>
                                              <td><?= $t['supplier']; ?></td>
                                              <td><?= $t['pengguna']; ?></td>
                                              <td><?= $t['noPo']; ?></td>
                                              <td><?= $t['statusPerolehan']; ?></td>
                                              <td><?= $t['lokasi']; ?></td>
                                              <td><?= $t['kondisi']; ?></td>
                                              <td>
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
                                              </td>
                                              <td><?= $t['isWaranty']; ?></td>
                                              <td>
                                                  <ul>
                                                      <li>Nama : 
                                                          <?= view('ksa_kendaraan', ['ksa' => $t['noInventaris']], 'namaStnk'); ?>
                                                      </li>
                                                      <li>Alamat : 
                                                          <?= view('ksa_kendaraan', ['ksa' => $t['noInventaris']], 'alamatStnk'); ?>
                                                      </li>
                                                  </ul>
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