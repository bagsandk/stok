<section class="section">
    <div class="section-header">
        <h1>DATA HISTORY</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Recent Activities</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled list-unstyled-border">
                            <?php foreach ($history as $h) { ?>
                                <li class="media">
                                    <img class="mr-3 rounded-circle" width="50" src="<?php echo base_url('assets/img/avatar/' . $h['profile']); ?>" alt="avatar">
                                    <div class="media-body">
                                        <div class="float-right text-primary"><?php echo timeAgo($h['log_date']); ?></div>
                                        <div class="media-title"><?php echo $h['first_name'] . " " . $h['last_name']; ?></div>
                                        <?php
                                        if ($h['type'] == 'Insert') {
                                            $text = "Menambahkan data pada tabel ";
                                            $string = explode("VALUES", $h['query']);
                                            // satu 
                                            $stringAwal = explode(" ", $string[0]);
                                            $tabel = str_replace('"', '', $stringAwal[2]);
                                            if($tabel == 'kartu_stok_aset'){
                                                $tabelText = 'Kartu Stok Aset';
                                            }
                                            if($tabel == 'kartu_stok_non_aset'){
                                                $tabelText = 'Kartu Stok Non Aset';
                                            }
                                            if($tabel == 'product'){
                                                $tabelText = 'Produk';
                                            }
                                            if($tabel == 'product_kendaraan'){
                                                $tabelText = 'Produk Kendaraan';
                                            }
                                            if($tabel == 'barang'){
                                                $tabelText = 'Barang';
                                            }
                                            if($tabel == 'sub_kelompok'){
                                                $tabelText = 'Sub Kelompok';
                                            }
                                            if($tabel == 'kelompok'){
                                                $tabelText = 'Kelompok';
                                            }
                                            if($tabel == 'golongan'){
                                                $tabelText = 'Golongan';
                                            }
                                            
                                        }
                                        if ($h['type'] == 'Delete') {
                                        }
                                        if ($h['type'] == 'Update') {
                                        }

                                        ?>
                                        <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                        <!-- <div class="text-center pt-1 pb-1">
                                <a href="#" class="btn btn-primary btn-lg btn-round">
                                    View All
                                </a>
                            </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>