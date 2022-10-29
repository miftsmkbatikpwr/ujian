  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Mata Pelajaran</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Admin</li>
              <li class="breadcrumb-item active">Master Ujian</li>
              <li class="breadcrumb-item active">mapel</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
    	<div class="row">
        <div class="col-md-12">
          <?php if (validation_errors()) { ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            <?=validation_errors(); ?>
          </div>
          <?php } ?>
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
                <table id="table_examgrouptypes" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="50px">No</th>
                    <th>kelompok Ujian</th>
                    <th width="50px">Status</th>
                    <th width="110px" class="text-center">
                      <button type="button" class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#modal-add_egt">
                        <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                      </button>
                    </th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th width="50px">No</th>
                    <th>kelompok Ujian</th>
                    <th>Status</th>
                    <th width="110px" class="text-center">
                      <button type="button" class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#modal-add_egt">
                        <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                      </button>
                    </th>
                  </tr>
                  </tfoot>
                </table>
                  <!-- Modal -->
                  <div class="modal fade" id="modal-add_egt">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Tambah Kelompok Ujian</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="POST" action="<?=base_url($this->uri->segment(1).'/examgrouptype_save')?>">
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="examgroup">kelompok Ujian</label>
                            <input type="text" class="form-control" id="examgroup" name="examgroup" placeholder="Kelompok Ujian">
                          </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
            </div>
	        </div>
	    	</div>
    	</div>
    </section>
    	
  </div>