<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?=base_url('assets/images/BGSMK5050.png')?>">
  <title>CAT - SMK BATIK PERBAIK</title>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?=base_url('assets/')?>plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('assets/')?>dist/css/adminlte.min.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
  <nav class="position-sticky main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a class="navbar-brand">
        <img src="<?=base_url('assets/images/BGSMK5050.png')?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8;">
        <span class="brand-text font-weight-bold">SMK Batik Perbaik</span>
      </a>
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item">
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 font-weight-bold text-danger">
              <i class="fa fa-clock"></i> Waktu Habis
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><?=$header['app_name'].' '.$header['app_year']?></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-sm-3">
          </div>
          <div class="col-sm-6">
            <div class="card card-danger card-outline text-dark">
              <div class="card-body text-center">
                <h3>Waktu Ujian telah habis</h3>   
                <p>Klik tombol selesai untuk mengakhiri ujian</p>           
              </div>
              <div class="card-footer text-center">
                <a href="<?=base_url('siswa/finish_exam');?>" type="button" class="btn btn-danger">Akhiri Ujian</a>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="main-footer">
    <div class="container">
    <div class="float-right d-none d-sm-inline">
      Aplikasi Ujian Berbasis Komputer
    </div>
    <strong>Copyright &copy; 2022 SMK BATIK PERBAIK</strong>
    </div>
  </footer>
</div>
<!-- jQuery -->
<script src="<?=base_url('assets/')?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url('assets/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/')?>dist/js/adminlte.min.js"></script>
</body>
</html>
