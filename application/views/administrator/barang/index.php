  <section class="section">
      <div class="section-header">
          <h1>DATA BARANG</h1>
      </div>
      <div class="section-body">
          <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                  <div class="card">
                      <div class="card-header">
                          <a href="<?= base_url('barang/add') ?>" class="badge badge-success">Tambah Barang</a>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-striped" id="myTable">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Barang</th>
                                          <th>Sub Kelompok</th>
                                          <th>Actions</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                        $no = 1;
                                        foreach ($barang_ as $t) { ?>
                                          <tr>
                                              <td><?php echo $no; ?></td>
                                              <td><?php echo $t['namaBarang']; ?></td>
                                              <td><?php echo view('sub_kelompok', ['id' => $t['kodeSub']], 'namaSub') ?></td>
                                              <td>
                                                  <a href="<?php echo base_url('barang/edit/' . $t['id']); ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-pen"></span></a>
                                                  <a href="<?php echo base_url('barang/remove/' . $t['id']); ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete"><span class="fa fa-trash"></span></a>
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