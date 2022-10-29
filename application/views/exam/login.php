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
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=base_url('assets/')?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('assets/')?>dist/css/adminlte.min.css">
  <link rel="icon" href="<?=base_url('assets/images/BGSMK5050.png')?>">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b><?=$app_name?></b><br/><?=$app_year?></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in untuk akses CAT</p>
      <?php if (validation_errors()) { ?>
      <div class="alert alert-danger alert-dismissible">
        <h5><i class="icon fas fa-ban"></i> Login Gagal</h5>
        <?=validation_errors(); ?>
      </div>
      <?php } ?>
      <?php if ($this->session->flashdata('login_failed')) { ?>
      <div class="alert alert-danger alert-dismissible">
        <h5><i class="icon fas fa-ban"></i> Login Gagal</h5>
        <?=$this->session->flashdata('login_failed')?>
      </div>
      <?php } ?>
      <form action="<?=base_url('user')?>" method="post">
        <div class="input-group mb-3">
          <input type="text" name="user" class="form-control" placeholder="Username" value="<?php echo set_value('user'); ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="password" name="pass" class="form-control" placeholder="Password" value="<?php echo set_value('pass'); ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span onmouseover="showPassword(this)" onmouseout="hidePassword(this)" class="fas fa-eye"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?=base_url('assets/')?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url('assets/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/')?>dist/js/adminlte.min.js"></script>
<script>
function showPassword(x) {
  myButton = document.getElementById("password");
  myButton.type = "text";
}

function hidePassword(x) {
  myButton = document.getElementById("password");
  myButton.type = "password";
}
</script>
</body>
</html>
