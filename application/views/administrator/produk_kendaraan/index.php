  <section class="section">
      <div class="section-header">
          <h1>DATA PRODUK KENDARAAN</h1>
      </div>
      <div class="section-body">
          <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                  <div class="card">
                      <div class="card-header">
                          <a href="<?= base_url('produk_kendaraan/add') ?>" class="badge badge-success">Tambah Produk</a>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-striped" id="myTable">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Nama</th>
                                          <th>Merek</th>
                                          <th>Satuan</th>
                                          <th>Deskripsi</th>
                                          <th>Barang</th>
                                          <th>Tipe</th>
                                          <th>Bahan Bakar</th>
                                          <th>Tahun Pembuatan</th>
                                          <th>Warna</th>
                                          <th>HP</th>
                                          <th>Actions</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                        $no = 1;
                                        foreach ($produk_kendaraan_ as $t) { ?>
                                          <tr>
                                              <td><?php echo $no; ?></td>
                                              <td><?php echo view('product', ['id' => $t['productId']], 'nama') ?></td>
                                              <td><?php echo view('product', ['id' => $t['productId']], 'merek') ?></td>
                                              <td><?php echo view('product', ['id' => $t['productId']], 'satuan') ?></td>
                                              <td><?php echo view('product', ['id' => $t['productId']], 'deskripsi') ?></td>
                                              <td><?php $kb =  view('product', ['id' => $t['productId']], 'kodeBarang');
                                                    echo  view('barang', ['id' => $kb], 'namaBarang') ?></td>
                                              <td><?= $t['tipe']; ?></td>
                                              <td><?= $t['bahanBakar']; ?></td>
                                              <td><?= $t['thPembuatan']; ?></td>
                                              <td><?= $t['warna']; ?></td>
                                              <td><?= $t['hp']; ?></td>
                                              <td>
                                                  <a href="<?php echo base_url('produk_kendaraan/edit/' . $t['id']); ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-pen"></span></a>
                                                  <a href="<?php echo base_url('produk_kendaraan/remove/' . $t['id']); ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete"><span class="fa fa-trash"></span></a>
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