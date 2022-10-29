  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Soal</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Admin</li>
              <li class="breadcrumb-item active">Daftar Soal</li>
              <li class="breadcrumb-item active">Soal</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card card-solid">
        <div class="card-header">
          <h3 class="card-title font-weight-bold">
            <?=$questiongroup['subject']?> ( <?=$questiongroup['tot_question']?> Soal )
          </h3>
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
          <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#modal-xl_questionadd"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Soal</button>

              <div class="modal fade" id="modal-xl_questionadd">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Tambah Soal <?=$questiongroup['subject']?></h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="POST" action="<?=base_url('admin/question_save')?>" enctype="multipart/form-data">
                    <div class="modal-body">
                      <div class="form-group">
                        <?php
                        if (null !== $this->uri->segment(3)) {
                        ?>
                        <input type="hidden" name="questiongroup_id" value="<?=$this->uri->segment(3)?>">
                        <?php } ?>
                      </div>
                      <!-- nama -->
                      <div class="form-group">
                        <label for="nama">Gambar*</label>
                        <div class="col-sm-10">
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" name="img_q1" class="custom-file-input" id="exampleInputFile">
                              <label class="custom-file-label" for="exampleInputFile"></label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- question -->

                      <div class="form-group">
                        <label for="question" class="col-sm-12 col-form-label">Pertanyaan</label>
                        <div class="col-sm-12">
                          <textarea id="compose-textarea" name="question" class="form-control" style="height: 300px">
                            
                          </textarea>
                        </div>
                      </div>

                      <!-- <div class="form-group">
                        <label for="question" class="col-sm-12 col-form-label">Pilihan A-E</label>
                        <div class="col-sm-12">
                          <textarea id="compose-textarea2" name="options" class="form-control" style="height: 300px">
                            
                          </textarea>
                        </div>
                      </div> -->

                      <!-- <div class="form-group">
                        <label for="question" class="col-sm-12 col-form-label">Pertanyaan</label>
                        <div class="col-sm-12">
                          <textarea rows="7" style="white-space: pre-wrap;" class="form-control" id="question" name="question"></textarea>
                        </div>
                      </div> -->
                      <!-- Pilihan -->
                      <div class="form-group">
                        <label for="options" class="col-sm-12 col-form-label">Pilihan A-E</label>
                        <div class="col-sm-12">
                          <textarea rows="5" class="form-control" id="options" name="options"></textarea>
                        </div>
                      </div>
                      <!-- jawaban -->
                      <div class="form-group">
                        <label for="ans" class="col-sm-12 col-form-label">Jawaban</label>
                        <div class="col-sm-1">
                          <select class="custom-select" id="ans" name="ans">
                              <option value="A">A</option>
                              <option value="B">B</option>
                              <option value="C">C</option>
                              <option value="D">D</option>
                              <option value="E">E</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="nama" class="col-sm-12 col-form-label">Gambar Pilihan A *</label>
                        <div class="col-sm-10">
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" name="img_ans_a" class="custom-file-input" id="jawabanA">
                              <label class="custom-file-label" for="jawabanA"></label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="nama" class="col-sm-12 col-form-label">Gambar Pilihan b *</label>
                        <div class="col-sm-10">
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" name="img_ans_b" class="custom-file-input" id="jawabanb">
                              <label class="custom-file-label" for="jawabanb"></label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="nama" class="col-sm-12 col-form-label">Gambar Pilihan c *</label>
                        <div class="col-sm-10">
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" name="img_ans_c" class="custom-file-input" id="jawabanc">
                              <label class="custom-file-label" for="jawabanc"></label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="nama" class="col-sm-12 col-form-label">Gambar Pilihan d *</label>
                        <div class="col-sm-10">
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" name="img_ans_d" class="custom-file-input" id="jawaband">
                              <label class="custom-file-label" for="jawaband"></label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="nama" class="col-sm-12 col-form-label">Gambar Pilihan e *</label>
                        <div class="col-sm-10">
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" name="img_ans_e" class="custom-file-input" id="jawabane">
                              <label class="custom-file-label" for="jawabane"></label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="score" class="col-sm-12 col-form-label">Score</label>
                        <div class="col-sm-1">
                          <input type="number" value="1" class="form-control" id="score" name="score">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="random" class="col-sm-2 col-form-label">Acak Pilihan</label>
                        <div class="col-sm-2">
                          <select class="custom-select" id="random" name="random">
                              <option value="Y">YA</option>
                              <option value="N">Tidak</option>
                          </select>
                        </div>
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
      <?php
      // print_r($questions);
      ?>
      <!-- Default box -->
      <?php 
      $no=1;
      foreach ($questions as $p) { ?>
      <div class="card card-solid">
        <div class="card-body">
          <div class="d-flex align-items-center p-3 my-3 text-dark rounded shadow-sm bg-seconday">
            <!-- <img class="me-3" src="dist/bootstrap/svg/bootstrap-logo-white.svg" alt="" width="48" height="38"> -->
            <!-- <h5 class="me-3">3</h5> -->
            <div class="lh-1">
              <h5 class="border-bottom pb-2 mb-3 text-primary">Soal No. <?=$no?></h5>
              <?php if ($p->img_q1 !== null) { 
                if ($p->img_q1 !== '') {
              ?>
              <img src="<?=base_url('assets/gambar/'.$p->img_q1)?>" class="img-fluid mb-3" alt="gambar_soal">
              <?php } }
              if ($p->question !== 'null') {
              ?>
              <h1 class="h6 mb-0 text-dark lh-2"><?=$p->question?></h1>
              <?php } if (!is_null($p->audio_q1)) { ?>
              <audio class="mt-3" controls autoplay>
                <!-- <source src="horse.ogg" type="audio/ogg"> -->
                <source src="<?=base_url('assets/audio/'.$p->audio_q1)?>" type="audio/mpeg">
              Your browser does not support the audio element.
              </audio>
              <?php }  ?>

              <!-- <small>Since 2011</small> -->
            </div>
          </div>

          <div class="my-3 p-3 bg-body rounded shadow-sm">
            <h6 class="border-bottom pb-2 mb-0">Pilihan Jawaban :</h6>
            <?php 
            $abjad = str_split('abcde');
            foreach ($abjad as $abc) { 
              if ($p->{'ans_' . $abc} == "") {
                $p->{'ans_' . $abc} = null;
              }
              $fill = (strtolower($p->ans) === $abc) ? '<i class="far fa-check-square text-danger"></i>' : '';
              // echo $fill;
            ?>
            <div class="d-flex text-muted pt-3">
              <p class="pb-0 mb-0 small lh-sm border-bottom">
                <?php if ($p->{'img_ans_' . $abc} !== null) { ?>
                <img src="<?=base_url('assets/gambar/'.$p->{'img_ans_' . $abc})?>" class="img-fluid" alt="gambar_soal"><?=$fill?>
                <?php } 
                if ($p->{'ans_' . $abc} !== null) {
                ?>
                <strong class="h6 d-block text-dark"><?=$p->{'ans_' . $abc}?> <?=$fill?></i></strong>
                <?php } ?>
              </p>
            </div>
            <?php } ?>
          </div>
          <div class="my-0 p-1 bg-body rounded shadow-sm">
            <button class="btn btn-danger btn-sm" title="Hapus soal"  data-toggle="modal" data-target="#modal-default_del_<?=$p->id?>"><i class="fa fa-trash"></i> Hapus</button>
              <div class="modal fade" id="modal-default_del_<?=$p->id?>">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Hapus Soal</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Menghapus soal no. <?=$no?></p>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                      <a href="<?=base_url('admin/questions/'.$this->uri->segment(3).'/'.$p->id)?>" type="button" class="btn btn-danger">Hapus</a>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
      <?php $no++;} ?>
    </section>
  </div>
