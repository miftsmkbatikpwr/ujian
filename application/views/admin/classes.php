  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Kelas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Admin</li>
              <li class="breadcrumb-item active">Master Data</li>
              <li class="breadcrumb-item active">Daftar Kelas</li>
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
                <table id="table_classes" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="50px">No</th>
                    <th>Tingkat</th>
                    <th>Kelompok</th>
                    <th>Ruang</th>
                    <th width="110px" class="text-center">
                      <button type="button" class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#modal-add_egt">
                        <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                      </button>
                    </th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($classes as $key => $val) {
                      ?>
                      <tr>
                        <td><?=$key+1?>.</td>
                        <td><?=$val['level']?></td>
                        <td><?=$val['group']?></td>
                        <td><?=$val['classorder']?></td>
                        <td>
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-default_del_<?=$val['id']?>"><i class="fa fa-trash" aria-hidden="true"></i></button>

                          <div class="modal fade" id="modal-default_del_<?=$val['id']?>">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Hapus Kelas</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <p class="text-center">Menghapus Kelas <br/><br/><strong><?=$val['level']?> <?=$val['classorder']?></strong><br/><br/>Demi kevalidan data diharapkan untuk tidak menghapus data kelas.</p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                  <a type="button" href="<?=base_url('admin/classes/'.$val['id'])?>" class="btn btn-danger">Hapus</a>
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
                    <th>Tingkat</th>
                    <th>Kelompok</th>
                    <th>Ruang</th>
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
                          <h4 class="modal-title">Tambah Kelas Ujian</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="POST" action="<?=base_url($this->uri->segment(1).'/class_save')?>">
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="level">Tingkat</label>
                            <input type="text" class="form-control" id="level" name="level" placeholder="Tingkat">
                          </div>
                          <div class="form-group">
                            <label for="group">Kelompok</label>
                            <input type="text" class="form-control" id="group" name="group" placeholder="Kelompok">
                          </div>
                          <div class="form-group">
                            <label for="classorder">Ruang</label>
                            <input type="text" class="form-control" id="classorder" name="classorder" placeholder="Ruang">
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