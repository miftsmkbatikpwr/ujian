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
          <a class="nav-link text-danger" role="button" data-toggle="modal" data-target="#modal-default">Sign Out <i class="fa fa-sign-out-alt"></i>
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 font-weight-bold">
              <i class="fa fa-home"></i> Home
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
        <div class="card card-info card-outline text-dark">
          <div class="card-body">
            <dl class="row mb-0">
              <dt class="col-sm-4">Username</dt>
              <dd class="col-sm-8"><?=$student['username']?></dd>
              <dt class="col-sm-4">Nama</dt>
              <dd class="col-sm-8"><?=$student['name']?></dd>
              <dt class="col-sm-4">Kelas</dt>
              <dd class="col-sm-8"><?=$student['group']?> - (<?=$student['level']?> | <?=$student['classorder']?>)</dd>
            </dl>
          </div>
        </div>
        <div class="row">
          <?php if (count($available_exam) <= 0 ) { ?>
          <div class="col-12">
            <div class="card card-info card-outline text-dark">
              <div class="card-body text-center">
                <strong>Ujian Tidak Tersedia</strong>
              </div>
            </div>
          </div>
          <?php } ?>
          <?php foreach ($available_exam as $ae) { ?>
          <div class="col-md-6 col-lg-4">
            <div class="card card-info card-outline text-dark">
              <div class="card-header">
                <h3 class="card-title"><?=$ae->date?></h3>
              </div>
              <div class="card-body">
                <h4><?=$ae->name?></h4>
                <p class="card-text"><?=$ae->starttime?>-<?=$ae->endtime?> WIB (<?=$ae->duration?> menit) - <?=$ae->tot_question?> Soal 
                  <br><?=$ae->level?> | <?=$ae->group?> </p>
                <?php if ($ae->active) { ?>
                <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-exam_<?=$ae->id?>">Pilih Ujian</a>
                <?php } ?>
                <?php if (!$ae->active) { ?>
                <a class="btn btn-secondary btn-sm disabled" data-toggle="modal" data-target="#modal-exam_<?=$ae->id?>">Pilih Ujian</a>
                <?php } ?>
              </div>
            </div>
            <?php if ($ae->active) { ?>
            <div class="modal fade" id="modal-exam_<?=$ae->id?>">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p class="text-center">Kamu memilih untuk mengerjakan ujian</p>
                    <h4 class="text-center"><?=$ae->name?></h4>
                    <p class="text-center">Berdoalah dahulu lalu klik tombol <strong>Mulai Ujian</strong> jika sudah siap untuk mengerjakan ujian. </p>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <a type="button" href="<?=base_url('siswa/exam_start/'.$ae->id)?>" class="btn btn-success"><i class="fas fa-clock"></i> Mulai Ujian</a>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Konfirmasi</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Yakin mau keluar dari halaman ini ? <br>Klik Sign Out untuk keluar dari halaman ini </p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <a href="<?=base_url('user/logout');?>" type="button" class="btn btn-danger">Sign Out</a>
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
