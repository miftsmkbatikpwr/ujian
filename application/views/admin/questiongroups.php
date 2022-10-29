  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Soal <?=$examgrouptype['name']?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Admin</li>
              <li class="breadcrumb-item active">Master Ujian</li>
              <li class="breadcrumb-item active"><a href="#">Daftar Soal</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
      // print_r($group);
      ?>
      <!-- Default box -->
      <div class="card card-solid">
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
          <?php if (count($group)<=0) { ?>
            <h5 class="lead mt-1 text-center mb-3">Data tidak ditemukan</h5>
          <?php } ?>
          <button type="button" class="btn btn-block btn-info mb-3" data-toggle="modal" data-target="#modal-lg_qgroup"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Kelompok Soal</button>

          <div class="modal fade" id="modal-lg_qgroup">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Tambah Kelompok Soal</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="POST" action="<?=base_url('admin/questiongroup_save')?>">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="inputCode">Kode</label>
                    <input name="code" type="text" class="form-control" id="inputCode" placeholder="Kode Soal">
                  </div>
                  <div class="form-group">
                    <label>Mata Pelajaran</label>
                    <select name="subject" class="form-control select2" style="width: 100%;">
                      <?php
                      foreach ($subjects as $key => $val) {
                        if ($key==0) {
                          echo "<option selected='selected' value='".$val['id']."'>".$val['name']."</option>";
                        } else {
                          echo "<option value='".$val['id']."'>".$val['name']."</option>";
                        }
                      }?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Kelompok Kelas</label>
                    <select id='add_group' name="add_group[]" class="select2" multiple="multiple" data-placeholder="PILIH GROUP" style="width: 100%;">
                      <option value="AKL">Akuntansi dan Keuangan Lembaga</option>
                      <option value="BDP">Bisnis Daring dan Pemasaran</option>
                      <option value="OTKP">Otomatisasi dan Tata Kelola Perkantoran</option>
                      <option value="RPL">Rekayasa Perangkat Lunak</option>
                      <option value="TKJ">Teknik Komputer dan Jaringan</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Kelas</label>
                    <select name="level" class="form-control select2" style="width: 100%;">
                      <option selected='selected' value='X'>X (Sepuluh)</option>
                      <option value='XI'>XI (Sebelas)</option>
                      <option value='XII'>XII (Duabelas)</option>
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

          <div class="row">
            <?php foreach ($group as $qg) { ?>
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-12">
                      <h2 class="lead mt-1"><b><?=$qg->name?></b></h2>
                      <p class="text-muted text-sm"><b><?=$qg->kode?></b></p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"></span><b><?=$qg->level?> <?=$qg->group?> - <?=$qg->tot_question?> Soal</b></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a class="btn btn-sm btn-danger"  data-toggle="modal" data-target="#modal-default">
                      <i class="fas fa-trash"></i> Hapus
                    </a>

                    <div class="modal fade" id="modal-default">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Hapus Kelompok Soal</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p class="text-center">Menghapus kelompok soal <br/><br/><?=$qg->kode?><br/><strong><?=$qg->name?></strong> <br/><br/>Hanya diperbolehkan menghapus kelompok soal yang belum diisi soal dan belum digunakan untuk ujian.</p>
                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <a type="button" href="<?=base_url('admin/questiongroup_delete/'.$qg->id)?>" class="btn btn-danger">Hapus</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <a href="<?=base_url('admin/questions/'.$qg->id)?>" class="btn btn-sm btn-dark">
                      <i class="fas fa-eye"></i> Lihat Soal
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
        <!-- /.card-body -->
        <!-- <div class="card-footer">
        </div> -->
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
