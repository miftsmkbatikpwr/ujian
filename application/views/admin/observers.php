  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pengawas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Admin</li>
              <li class="breadcrumb-item active">Master Data</li>
              <li class="breadcrumb-item active">Daftar Pengawas</li>
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
                <table id="table_observers" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="50px">No</th>
                    <th>Pengawas</th>
                    <th width="50px">Status</th>
                    <th width="110px" class="text-center">
                      <button type="button" class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#modal-add_egt">
                        <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                      </button>
                    </th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($observer as $key => $val) {
                      ?>
                      <tr>
                        <td><?=$key+1?>.</td>
                        <td><?=$val['name']?></td>
                        <td>
                          <?php
                            $col = $val['status'] ? 'bg-success' : 'bg-danger';
                            echo '<span class="badge '.$col.'">Aktif</span> ';
                          ?>
                        </td>
                        <td>
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-default_del_<?=$val['id']?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
                          <a href="<?=base_url('admin/change_act_observer/'.$val['id'])?>" type="button" class="btn btn-sm <?=$val['status'] ? 'btn-danger' : 'btn-success'?>"><i class="fa fa-power-off" aria-hidden="true"></i></a>

                          <div class="modal fade" id="modal-default_del_<?=$val['id']?>">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Hapus Pengawas</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <p class="text-center">Menghapus Pengawas <br/><br/><strong><?=$val['name']?></strong><br/><br/>Demi kevalidan data diharapkan untuk tidak menghapus data pengawas.</p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                  <a type="button" href="<?=base_url('admin/observers/'.$val['id'])?>" class="btn btn-danger">Hapus</a>
                                </div>
                              </div>
                            </div>
                          </div>


                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th width="50px">No</th>
                    <th>Pengawas</th>
                    <th width="50px">Status</th>
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
                          <h4 class="modal-title">Tambah Pengawas Ujian</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="POST" action="<?=base_url($this->uri->segment(1).'/observer_save')?>">
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="observer">Nama Pengawas</label>
                            <input type="text" class="form-control" id="observer" name="observer" placeholder="Nama Pengawas">
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