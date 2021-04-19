<div class="card card-body">
    <div class="row col-md-12">
        <div class="d-sm-flex justify-content-between mb-3 ">
            <h1 class="h3 ml-3 text-gray-800">Profile</h1>
        </div>
    </div>
    <div class="row col-md-12">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?= base_url('assets/img/avatar/' . $user['profile']) ?>" alt="Admin" class="rounded-circle" width="150">
                        <div class="mt-3">
                            <h4><?= $user['first_name'] . ' ' . $user['last_name'] ?></h4>
                            <p class="mb-4"><?= str_replace('_', ' ', $user['level']) ?></p>
                            <button class="btn btn-primary" data-toggle="modal" data-backdrop="false" data-target="#modalfoto">Ubah Foto</button>
                            <div class="modal fade bd-example-modal-lg" id="modalfoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Form Ubah Foto</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <?php echo form_open_multipart('profile/upFoto/'); ?>
                                            <div class="form-group">
                                                <div class="">
                                                    <label class="" for="customFile">Pilih file</label>
                                                    <input type="file" name="foto" value="" class="form-control" id="customFile" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fa fa-check"></i> Simpan
                                            </button>
                                            <?php echo form_close(); ?>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">First Name</h6>
                        </div>
                        <div class="col-sm-3">
                            <?= $user['first_name'] ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Last Name</h6>
                        </div>
                        <div class="col-sm-3">
                            <?= $user['last_name'] ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9">
                            <?= $user['email'] ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-outline-primary float-right ml-2" data-toggle="modal" data-backdrop="false" data-target="#modalpass">Ubah Password</button>
                            <div class="modal fade bd-example-modal-lg" id="modalpass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Form Ubah Password</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <?php echo form_open_multipart('profile/ubahpass/'); ?>
                                            <div class="form-group">
                                                <label for="nama">Password Baru</label>
                                                <input type="text" class="form-control" id="nama" name="password" aria-describedby="emailHelp" placeholder="Masukan Password Baru">
                                                <small id="emailHelp" class="form-text text-muted">Password min 8 karakter.</small>
                                                <span class="text-danger"><?php echo form_error('password'); ?></span>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fa fa-check"></i> Simpan
                                            </button>
                                            <?php echo form_close(); ?>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-outline-primary float-right" data-toggle="modal" data-backdrop="false" data-target="#modalprofile">Ubah Data</button>
                            <div class="modal fade bd-example-modal-lg" id="modalprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Form Ubah Profile</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <?php echo form_open_multipart('profile/edit/'); ?>
                                            <div class="form-group">
                                                <label for="first_name">Fisrt Name</label>
                                                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo ($this->input->post('first_name') ? $this->input->post('first_name') : $user['first_name']); ?>" aria-describedby="emailHelp" placeholder="Input First Name">
                                                <span class="text-danger"><?php echo form_error('first_name'); ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="last_name">Last Name</label>
                                                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo ($this->input->post('last_name') ? $this->input->post('last_name') : $user['last_name']); ?>" aria-describedby="emailHelp" placeholder="Input Last Name">
                                                <span class="text-danger"><?php echo form_error('last_name'); ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" name="email" value="<?php echo ($this->input->post('email') ? $this->input->post('email') : $user['email']); ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Email">
                                                <span class="text-danger"><?php echo form_error('email'); ?></span>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fa fa-check"></i> Simpan
                                            </button>
                                            <?php echo form_close(); ?>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>