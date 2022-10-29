  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Home</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Siswa</li>
              <li class="breadcrumb-item active">Home</li>
              <!-- <li class="breadcrumb-item active"><a href="#">Examdata</a></li> -->
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
    	<div class="row">
        <?php if (count($available_exam) <= 0 ) { ?>
          <div class="col-12">
            <div class="card bg-light">
              <div class="card-body text-center">
                <strong>Ujian Tidak Tersedia</strong>
              </div>
            </div>
          </div>
        <?php } ?>
    		<?php foreach ($available_exam as $ae) { ?>
          <div class="col-12 col-sm-6 col-md-6  col-lg-4 d-flex align-items-stretch flex-column">
            <div class="card bg-light d-flex flex-fill">
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col-12">
                    <h2 class="lead mt-3"><b><?=$ae->name?></b></h2>
                    <p class="text-muted text-sm"><b><?=$ae->kode?></b></p>
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                      <li><span class="fa-li"></span><b><?=$ae->level?> <?=$ae->group?> - <?=$ae->tot_question?> Soal</b></li>
                      <li><span class="fa-li"></span>Waktu: <b><?=$ae->duration?> menit</b></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="text-right">
                  <?php if ($ae->active) { ?>
                  <a class="btn btn-sm btn-success"  data-toggle="modal" data-target="#modal-default_start">
                    <i class="fas fa-clock"></i> Mulai
                  </a>
                  <?php } ?>
                  <?php if (!$ae->active) { ?>
                  <a class="btn btn-sm btn-secondary disabled">
                    <i class="fas fa-clock"></i> Mulai
                  </a>
                  <?php } ?>
                  <div class="modal fade" id="modal-default_start">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Mulai Ujian</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p class="text-center">Ujian dipilih: <br/><br/><strong><?=$ae->kode?></strong><br/><strong><?=$ae->name?></strong><br/><strong><?=$ae->duration?> menit</strong> <br/><br/>Klik tombol mulai untuk mulai mengerjakan ujian.</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                          <a type="button" href="<?=base_url('siswa/exam_start/'.$ae->id)?>" class="btn btn-success"><i class="fas fa-clock"></i> Mulai</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
    	</div>
    </section>
    	
  </div>