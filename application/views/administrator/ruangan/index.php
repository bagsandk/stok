  <section class="section">
      <div class="section-header">
          <h1>DATA RUANGAN</h1>
      </div>
      <div class="section-body">
          <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                  <div class="card">
                      <div class="card-header">
                          <a href="<?= base_url('ruangan/add') ?>" class="badge badge-success">Tambah Ruangan</a>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-striped" id="myTable">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Nama</th>
                                          <th>Jenis Ruangan</th> 
                                          <th>Posisi Ruangan</th> 
                                          <th>Ukuran Ruangan</th> 
                                          <th>Kapasitas</th> 
                                          <th>Actions</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                        $no = 1;
                                        foreach ($ruangan as $t) { ?>
                                          <tr>
                                              <td><?php echo $no; ?></td>
                                              <td><?php echo $t['nama']; ?></td>
                                              <td><?php echo $t['jenisRuangan']; ?></td>
                                              <td><?php echo $t['posisiRuangan']; ?></td>
                                              <td><?php echo $t['ukuranRuangan']; ?></td>
                                              <td><?php echo $t['kapasitasRuangan']; ?></td>
                                              <td>
                                                  <a href="<?php echo base_url('ruangan/edit/' . $t['id']); ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-pen"></span></a>
                                                  <a href="<?php echo base_url('ruangan/remove/' . $t['id']); ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete"><span class="fa fa-trash"></span></a>
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