  <section class="section">
      <div class="section-header">
          <h1>DATA KARTU STOK NON ASET</h1>
      </div>
      <div class="section-body">
          <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                  <div class="card">
                      <div class="card-header">
                          <a href="<?= base_url('kartu_stok_non_aset/add') ?>" class="badge badge-success">Tambah Produk</a>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-striped" id="myTable">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Nama</th>
                                          <th>Gambar</th>
                                          <th>Merek</th>
                                          <th>Lokasi Gudang</th>
                                          <th>Lokasi Rak</th>
                                          <th>Satuan</th>
                                          <th>Jumlah Stok</th>
                                          <th>Harga Rerata</th>
                                          <th>Minimal Saldo</th>
                                          <th>Actions</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                        $no = 1;
                                        foreach ($kartu_stok_non_aset_ as $t) { ?>
                                          <tr>
                                              <td><?php echo $no; ?></td>
                                              <td data-toggle="tooltip" data-html="true" title='
                                              <div class="row">
                                                <div class="col-md-6">
                                                    Desc:
                                                </div>
                                                <div class="col-md-6">
                                                    <em><?php echo view('product', ['id' => $t['productId']], 'deskripsi') ?></em>
                                                </div>
                                              </div>
                                              '><?php echo view('product', ['id' => $t['productId']], 'nama') ?></td>
                                              <td><?php echo view('product', ['id' => $t['productId']], 'gambar') ?></td>
                                              <td><?php echo view('product', ['id' => $t['productId']], 'merek') ?></td>
                                              <td><?= $t['lokasiGudang']; ?></td>
                                              <td><?= $t['lokasiRak']; ?></td>
                                              <td><?= $t['satuan']; ?></td>
                                              <td><?= $t['jumlahStok']; ?></td>
                                              <td><?= 'Rp ' . number_format($t['hargaRerata']); ?></td>
                                              <td><?= $t['saldoMin']; ?></td>
                                              <td>
                                                  <a href="<?php echo base_url('kartu_stok_non_aset/edit/' . $t['id']); ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-pen"></span></a>
                                                  <a href="<?php echo base_url('kartu_stok_non_aset/remove/' . $t['id']); ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete"><span class="fa fa-trash"></span></a>
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