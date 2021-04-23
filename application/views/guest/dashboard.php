<section class="section">
    <div class="section-header">
        <h1>DASHBOARD</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-6">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fa fa-plus fa-2x" style="color:white"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Insert</h4>
                        </div>
                        <div class="card-body">
                            <?= $insert; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fa fa-pen fa-2x" style="color:white"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Update</h4>
                        </div>
                        <div class="card-body">
                            <?= $update; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fa fa-trash fa-2x" style="color:white"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Delete</h4>
                        </div>
                        <div class="card-body">
                            <?= $delete; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6">
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
                                        <span class="text-small text-muted"><?php echo $h['query']; ?></span>
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