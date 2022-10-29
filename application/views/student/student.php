  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Siswa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Siswa</li>
              <li class="breadcrumb-item active">Data</li>
              <!-- <li class="breadcrumb-item active"><a href="#">Examdata</a></li> -->
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
    	<div class="row">
        <div class="col-lg-4 col-md-2">
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <strong>Data Siswa</strong>
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <dl>
                <dt>Nama</dt>
                <dd><?=$student['name']?></dd>
                <dt>Kelas</dt>
                <dd><?=$student['level']?> | <?=$student['group']?> ( <?=$student['classorder']?> )</dd>
                <!-- <dt>Ruang</dt>
                <dd>Ruang <?=$student['room']?></dd> -->
              </dl>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-lg-4 col-md-2">
        </div>
    	</div>
    </section>
    	
  </div>