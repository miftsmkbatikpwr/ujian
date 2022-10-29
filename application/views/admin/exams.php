  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ujian</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Admin</li>
              <li class="breadcrumb-item active">Master Ujian</li>
              <li class="breadcrumb-item active">Daftar Ujian</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="col-md-11">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Ujian <?=$examgrouptype['name']?></h3>
          </div>
          <div class="card-body">
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
            <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#modal-lg_examadd"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Ujian</button>

            <div class="modal fade" id="modal-lg_examadd">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Tambah Ujian <?=$examgrouptype['name']?></h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="POST" action="<?=base_url('admin/exam_save')?>" enctype="multipart/form-data">
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Soal</label>
                        <select name="exam_question" class="form-control select2" style="width: 100%;">
                          <?php
                          foreach ($questiongroup as $key => $val) {
                            if ($key==0) {
                              echo "<option selected='selected' value='".$val->id."'>".$val->name." | ".$val->level." - ".$val->group."</option>";
                            } else {
                              echo "<option value='".$val->id."'>".$val->name." | ".$val->level." - ".$val->group."</option>";
                            }
                          }?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Tanggal dan Jam:</label>
                          <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                              <input name="date_time" type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime"/>
                              <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                        <label for="inputDuration">Durasi</label>
                        <input name="duration" type="number" class="form-control" id="inputDuration" placeholder="Durasi" value="90">
                      </div>
                      <div class="form-group">
                        <label>Aktif</label>
                        <select name="active" class="form-control select2" style="width: 100%;">
                          <option value='1'>Ya</option>
                          <option selected='selected' value='0'>Tidak</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Tampilkan</label>
                        <select name="show" class="form-control select2" style="width: 100%;">
                          <option value='1'>Ya</option>
                          <option selected='selected' value='0'>Tidak</option>
                        </select>
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
          <!-- /.card-header -->
          <div class="card-body">
            <table id="table_exams" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th style="width: 150px">Tanggal</th>
                  <th>Ujian</th>
                  <th style="width: 120px">Status</th>
                  <th style="width: 40px">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($exam as $key => $val) {
                ?>
                <tr>
                  <td><?=$no?>.</td>
                  <td><?=$val['date']?></td>
                  <td><b><?=$val['name']?></b> || (<?=$val['level']?>-<?=$val['group']?>) || <strong><?=$val['starttime']?></strong></td>
                  <td>
                    <?php
                    // if ($val['active']) {
                      $txtt = 'Aktif';
                      $col = $val['active'] ? 'bg-success' : 'bg-danger';
                      echo '<span class="badge '.$col.'">'.$txtt.'</span> ';
                    // }
                    // if ($val['show']) {
                      $txtt = 'Tampil';
                      $col = $val['show'] ? 'bg-success' : 'bg-danger';
                      echo '<span class="badge '.$col.'">'.$txtt.'</span>';
                    // } 
                    ?>
                  </td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-default_del_<?=$val['id']?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
                      <button type="button" class="btn btn-secondary dropdown-toggle dropdown-icon btn-sm" data-toggle="dropdown">
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="<?=base_url('admin/change_act_exam/'.$val['id'])?>">Aktifkan/NonAktifkan</a>
                        <a class="dropdown-item" href="<?=base_url('admin/change_act_view/'.$val['id'])?>">Tampilkan/Sembunyikan</a>
                        <!-- <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a> -->
                      </div>
                      <div class="modal fade" id="modal-default_del_<?=$val['id']?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Hapus Ujian</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <p class="text-center">Menghapus ujian <br/><br/><strong><?=$val['name']?></strong><br/>(<?=$val['level']?>-<?=$val['group']?>) || <strong><?=$val['starttime']?></strong><br/><br/>Hanya diperbolehkan menghapus ujian yang belum digunakan untuk ujian.</p>
                            </div>
                            <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                              <a type="button" href="<?=base_url('admin/exam_delete/'.$val['id'])?>" class="btn btn-danger">Hapus</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              <?php $no++; } ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


