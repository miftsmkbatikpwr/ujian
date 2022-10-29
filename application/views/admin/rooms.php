  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ruang</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Admin</li>
              <li class="breadcrumb-item active">Master Data</li>
              <li class="breadcrumb-item active">Daftar Ruang</li>
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
                <table id="table_rooms" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="50px">No</th>
                    <th width="150px">Ruang</th>
                    <th>Proktor</th>
                    <th width="110px" class="text-center">
                      <button type="button" class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#modal-add_egt">
                        <i class="fa fa-plus" aria-hidden="true"></i> Tambah
                      </button>
                    </th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($rooms as $key => $val) {
                      ?>
                      <tr>
                        <td><?=$key+1?>.</td>
                        <td><?=$val['name']?></td>
                        <td><?=$val['proktor']?></td>
                        <td>
                          <button type="button" class="btn btn-warning btn-sm mr-2" data-toggle="modal" data-target="#modal-edit_<?=$val['id']?>">Edit</button>
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-default_del_<?=$val['id']?>"><i class="fa fa-trash" aria-hidden="true"></i></button>

                          <div class="modal fade" id="modal-default_del_<?=$val['id']?>">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Hapus Ruang</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <p class="text-center">Menghapus Ruang <br/><br/><strong><?=$val['name']?></strong><br/><br/>Demi kevalidan data diharapkan untuk tidak menghapus data ruang.</p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                  <a type="button" href="<?=base_url('admin/rooms/'.$val['id'])?>" class="btn btn-danger">Hapus</a>
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
                    <th width="150px">Ruang</th>
                    <th>Proktor</th>
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
                          <h4 class="modal-title">Tambah Ruang Ujian</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="POST" action="<?=base_url($this->uri->segment(1).'/room_save')?>">
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="name">Ruang</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Ruang">
                          </div>
                          <div class="form-group">
                            <label for="proktor">Kelompok</label>
                            <input type="text" class="form-control" id="proktor" name="proktor" placeholder="Proktor">
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

                  <?php
                    foreach ($rooms as $key => $val) {
                  ?>
                  <div class="modal fade" id="modal-edit_<?=$val['id']?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Edit Data Ruang</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <form method="POST" action="<?=base_url('admin/room_update')?>">
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="name">Ruang</label>
                            <input type="text" hidden="" name="id" value="<?=$val['id']?>">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Ruang" value="<?=$val['name']?>">
                          </div>
                          <div class="form-group">
                            <label for="proktor">Proktor</label>
                            <input type="text" class="form-control" id="proktor" name="proktor" placeholder="Proktor" value="<?=$val['proktor']?>">
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
                  <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </section>
      
  </div>