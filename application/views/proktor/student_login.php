  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Reset Login Siswa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Proktor</li>
              <li class="breadcrumb-item active">Reset Siswa</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
    	<div class="row">
        <div class="col-md-12">
          <?php if ($this->session->flashdata('success')) { ?>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            <?=$this->session->flashdata('success')?>
          </div>
          <?php } ?>
          <?php if ($this->session->flashdata('failed')) { ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
            <?=$this->session->flashdata('failed')?>
          </div>
          <?php } ?>
        </div>
    		<div class="col-md-12">
          <div class="card card-default">
            <div class="card-body">
                <table id="table_users" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="50px">No</th>
                    <th width="110px" class="text-center">Username</th>
                    <th>Nama</th>
                    <th width="110px" class="text-center">Kelas</th>
                    <th width="120px" class="text-center">
                      Aksi
                    </th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th width="50px">No</th>
                    <th width="110px" class="text-center">Username</th>
                    <th>Nama</th>
                    <th width="110px" class="text-center">Kelas</th>
                    <th width="120px" class="text-center">
                      Aksi
                    </th>
                  </tr>
                  </tfoot>
                </table>
            </div>
	        </div>
	    	</div>
    	</div>
    </section>
    	
  </div>