  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Nilai</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Admin</li>
              <li class="breadcrumb-item active">Cek Nilai</li>
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
              <form class="form-horizontal" method="POST" action="<?=base_url('admin/check_score')?>">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="exam" class="col-sm-2 col-form-label">Pilih Ujian</label>
                    <div class="col-sm-10">
                      <select name="exam" class="form-control select2" style="width: 100%;">
                        <option>--pilih ujian--</option>
                        <?php
                        foreach ($exams as $k => $val) {
                          $selected = "";
                          if ($id_exam == $val['id']) {
                            $selected = "selected='selected'";
                          }
                          echo "<option ".$selected." value=".$val['id'].">".$val['subject_exam']." | ".$val['level']." ".$val['group']." | ".$val['exam_date']."</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary float-right">PILIH</button>
                </div>
              </form>
            </div>
            <div class="card-body">
                <table id="table_scores" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="50px">No</th>
                    <th width="110px" class="text-center">NIS</th>
                    <th>NAMA</th>
                    <th width="110px" class="text-center">NILAI SEMENTARA</th>
                    <th width="110px" class="text-center">NILAI AKHIR</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th width="50px">No</th>
                    <th width="110px" class="text-center">NIS</th>
                    <th>NAMA</th>
                    <th width="110px" class="text-center">NILAI SEMENTARA</th>
                    <th width="110px" class="text-center">NILAI AKHIR</th>
                  </tr>
                  </tfoot>
                </table>
            </div>
	        </div>
	    	</div>
    	</div>
    </section>
    	
  </div>