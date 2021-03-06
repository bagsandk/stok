<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Pendataan</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- CSS Libraries -->
    <!-- <link rel="stylesheet" href="../node_modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="../node_modules/summernote/dist/summernote-bs4.css">
    <link rel="stylesheet" href="../node_modules/owl.carousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="../node_modules/owl.carousel/dist/assets/owl.theme.default.min.css"> -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/components.css">

</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <ul class="navbar-nav navbar-left mr-auto">
                </ul>
                <ul class="navbar-nav navbar-right">
                    <?php $not = $this->db->join('tbl_alumni', 'tbl_alumni.npm=tbl_kritik_saran.npm')->get_where('tbl_kritik_saran', ['status_baca' => 'belum'])->result_array(); ?>
                    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg <?php echo (count($not) >= 1) ? 'beep' : ''; ?>"><i class="far fa-bell"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">Notifications
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons">
                                <?php
                                foreach ($not as $nn) {
                                ?>
                                    <a href="<?php echo base_url('data_kritik_saran/index') ?>" class="dropdown-item dropdown-item-unread">
                                        <div class="dropdown-item-icon bg-primary text-white">
                                            <i class="fas fa-code"></i>
                                        </div>
                                        <div class="dropdown-item-desc">
                                            <?php echo $nn['nama']; ?>
                                        </div>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="<?php echo base_url(); ?>assets/img/avatar/<?= $this->session->userdata('pict'); ?>" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, <?php
                                                                            if ($this->session->userdata('level') == 1) {
                                                                                echo "Administrator";
                                                                            }
                                                                            ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="<?php echo base_url('profile') ?>" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="<?php echo base_url('auth/logout') ?>" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <img class="p-2" src="<?= base_url('assets/dds.png') ?>" width="180" alt="">
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">DDS</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Menu</li>
                        <li class="<?php echo (empty($this->uri->segment(1)) || $this->uri->segment(1) == 'admin') ? 'active' : ''; ?>">
                            <a class="nav-link" href="<?php echo base_url('admin/index'); ?>">
                                <i class="fas fa-fire"></i> <span>Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <?php if ($this->session->flashdata('message')) {
                        echo $this->session->flashdata('message');
                    } ?>
                    <?php
                    if (isset($_view) && $_view)
                        $this->load->view($_view);
                    ?>
                </section>
            </div>
        </div>
    </div>

    <!-- General JS Scripts -->

    <!-- <script src="<?php echo base_url(); ?>assets/js/stisla.js"></script> -->

    <!-- JS Libraies -->
    <!-- <script src="../node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="../node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="../node_modules/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="../node_modules/summernote/dist/summernote-bs4.js"></script>
    <script src="../node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script> -->
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <!-- Template JS File -->
    <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/advance-form.js"></script>

</body>

</html>