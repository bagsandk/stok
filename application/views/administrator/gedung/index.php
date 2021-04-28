  <section class="section">
      <div class="section-header">
          <h1>DATA GEDUNG</h1>
      </div>
      <div class="section-body">
          <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                  <div class="card">
                      <div class="card-header">
                          <a href="<?= base_url('gedung/add') ?>" class="badge badge-success">Tambah gedung</a>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-striped" id="myTable">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Nama Gedung</th>
                                          <th>Tahun Pembangunan</th> 
                                          <th>Luas</th> 
                                          <th>Alamat</th> 
                                          <th>Lantai</th> 
                                          <th>Ruang</th> 
                                          <th>Actions</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                        $no = 1;
                                        foreach ($gedung as $t) { ?>
                                          <tr>
                                              <td><?php echo $no; ?></td>
                                              <td><?php echo $t['namaGedung']; ?></td>
                                              <td><?php echo $t['thnPembangunan']; ?></td>
                                              <td><?php echo $t['luasGedung']; ?></td>
                                              <td><?php echo $t['alamatGedung']; ?></td>
                                              <td><?php echo $t['jmlLantai']; ?></td>
                                              <td><?php echo $t['jmlRuangan']; ?></td>
                                              <td>
                                                  <a href="<?php echo base_url('gedung/edit/' . $t['id']); ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-pen"></span></a>
                                                  <a href="<?php echo base_url('gedung/remove/' . $t['id']); ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete"><span class="fa fa-trash"></span></a>
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