<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CAT - SMK BATIK PERBAIK</title>

  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('assets/')?>plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <!-- <link rel="stylesheet" href="<?=base_url('assets/')?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css"> -->
  
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?=base_url('assets/')?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?=base_url('assets/')?>plugins/select2/css/select2.min.css">

  <!-- daterange picker -->
  <link rel="stylesheet" href="<?=base_url('assets/')?>plugins/daterangepicker/daterangepicker.css">

  <link rel="stylesheet" href="<?=base_url('assets/')?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <?php if(isset($data_table)) { ?>
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url('assets/')?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url('assets/')?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url('assets/')?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <?php } ?>
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('assets/')?>dist/css/adminlte.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?=base_url('assets/')?>plugins/summernote/summernote-bs4.min.css">
  <link rel="icon" href="<?=base_url('assets/images/BGSMK5050.png')?>">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?=base_url('');?>" class="nav-link">Home (Ujian)</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a type="button" class="nav-link" data-toggle="modal" data-target="#modal-default_signout">Sign Out</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=base_url()?>" class="brand-link">
      <img src="<?=base_url('assets/images/BGSMK5050.png')?>" alt="SMK Batik Logo" class="brand-image img-circle elevation-3 bg-light" style="opacity: .8">
      <span class="brand-text font-weight-light"><?=$app_name?> <?=$app_year?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=base_url('assets/')?>images/Sample_User_Icon.png" class="img-circle elevation-2 bg-light" alt="User Image">
        </div>
        <div class="info">
          <a href="<?=base_url('')?>" class="d-block"><?=$this->session->userdata('name')?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">Menu</li>
          <?php if ($this->session->userdata('role') == 'S') { ?>
          <li class="nav-item">
            <a href="<?=base_url('siswa');?>" class="nav-link">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Home (Ujian)
                <!-- <span class="badge badge-info right">2</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url('siswa/data');?>" class="nav-link">
              <i class="nav-icon far fa-user"></i>
              <p>
                Data Siswa
              </p>
            </a>
          </li>
          <?php } ?>
          <?php if ($this->session->userdata('role') == 'P' || $this->session->userdata('role') == 'A') { ?>
            <li class="nav-item">
              <a href="<?=base_url('proktor/reset_loginstudent');?>" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Reset Login Ujian
                  <!-- <span class="badge badge-info right">2</span> -->
                </p>
              </a>
            </li>

            <!-- <li class="nav-item">
            <a href="<?=base_url('proktor/print_ba');?>" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Berita Acara
              </p>
            </a>
          </li> -->
          <?php } ?>
          <?php if ($this->session->userdata('role') == 'A') { ?>
          <!-- <li class="nav-item">
            <a href="<?=base_url('proktor/cekloginsiswa');?>" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Reset Login Siswa
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="<?=base_url('admin/check_score');?>" class="nav-link">
              <i class="nav-icon fas fa-eye"></i>
              <p>
                Cek Nilai
                <!-- <span class="badge badge-info right">2</span> -->
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Master Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url('admin/classes');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Kelas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('admin/rooms');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Ruang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('admin/observers');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Pengawas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('admin/subjects');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Mapel</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Master Ujian
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url('admin/examgrouptypes');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelompok Ujian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('admin/questiongroups');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Soal</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('admin/exams');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Ujian</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="<?=base_url('main/addqgroup');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah</p>
                </a>
              </li> -->
            </ul>
          </li>

          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Master Ujian
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url('main/examdata');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Ujian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('main/addexam');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah</p>
                </a>
              </li>
            </ul>
          </li> -->


          <!-- <li class="nav-item">
            <a href="<?=base_url('main/print_ba');?>" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Berita Acara
              </p>
            </a>
          </li> -->

          <?php } ?>
          
          <li class="nav-item">
            <a type="button" class="nav-link" data-toggle="modal" data-target="#modal-default_signout">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Sign Out
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>

    
    <!-- /.sidebar -->
  </aside>
    <div class="modal fade" id="modal-default_signout">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Sign Out</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Klik Sign Out untuk keluar.</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <a href="<?=base_url('user/logout');?>" type="button" class="btn btn-danger">Sign Out</a>
          </div>
        </div>
      </div>
    </div>