  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>&copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> Custom by RPL SMK Batik.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?=base_url('assets/')?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url('assets/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<!-- <script src="<?=base_url('assets/')?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> -->


<!-- Select2 -->
<script src="<?=base_url('assets/')?>plugins/select2/js/select2.full.min.js"></script>

<script src="<?=base_url('assets/')?>plugins/moment/moment.min.js"></script>
<script src="<?=base_url('assets/')?>plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->

<!-- Tempusdominus Bootstrap 4 -->
<script src="<?=base_url('assets/')?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<?php if ( isset($score_table) || isset($users_table) || isset($subject_table) || isset($examgrouptype_table) || isset($exam_table) || isset($observer_table) || isset($class_table) || isset($room_table)) { ?>
<!-- DataTables  & Plugins -->
<script src="<?=base_url('assets/')?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url('assets/')?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url('assets/')?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url('assets/')?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=base_url('assets/')?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url('assets/')?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url('assets/')?>plugins/jszip/jszip.min.js"></script>
<script src="<?=base_url('assets/')?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?=base_url('assets/')?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?=base_url('assets/')?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url('assets/')?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url('assets/')?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<?php } ?>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/')?>dist/js/adminlte.min.js"></script>
<!-- Summernote -->
<script src="<?=base_url('assets/')?>plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?=base_url('assets/')?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script>
  $(function () {
    //Add text editor
    $('#compose-textarea').summernote({
      toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['para', ['ul', 'ol', 'paragraph']]
      ]
    });

    $('#compose-textarea2').summernote({
      toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['para', ['ul', 'ol', 'paragraph']]
      ]
    });
  })
</script>

<script>
  $(function () {
    $('.select2').select2()
    bsCustomFileInput.init()
    $('#reservationdatetime').datetimepicker(
    { 
      icons: { time: 'far fa-clock' },
      format: "YYYY-MM-DD H:mm"
    });
  });
</script>
<!-- <script>
  var data = "";
  var id_x = "";
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    bsCustomFileInput.init()
    //Date and time picker
    $('#reservationdatetime').datetimepicker(
      { 
        icons: { time: 'far fa-clock' },
        format: "YYYY-MM-DD H:mm"
      });

    // $('#add_group').val(['BDP','TKJ','RPL']).change();

    <?php
    if (isset($js)) {echo $js;}
    ?>
  })
  <?php
    if (isset($js2)) {echo $js2;}
  ?>
</script> -->
<?php if (isset($subject_table)) { ?>
<script>
  $(function () {
    $('#table_subjects').DataTable({
      responsive: true,
      language: {
        info: "Halaman _PAGE_ dari _PAGES_",
        search: "Cari:",
        lengthMenu: "tampilkan _MENU_ baris",
        emptyTable: "data masih kosong",
        zeroRecords: "data tidak ditemukan",
        paginate: { first: "<<", last: ">>", next: ">", previous: "<" },
      },
      data: <?=json_encode($subjects)?>,
      columns: [
          { data: 'no', searchable: false },
          { data: 'name', searchable: true},
          // { defaultContent: '<a type="button" class="btn btn-warning btn-sm mr-2">Edit</button><a type="button" class="btn btn-danger btn-sm">Hapus</button>' },
          { data: 'id', render : function ( data, type, row, meta ) {
            return `<a type="button" class="btn btn-warning btn-sm mr-2" data-toggle="modal" data-target="#modal-edit_`+data+`">Edit</a><a type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete_`+data+`"><i class="fa fa-trash" aria-hidden="true"></i></a>
            <div class="modal fade" id="modal-edit_`+data+`">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Edit Data Mapel</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="POST" action="<?=base_url($this->uri->segment(1).'/subject_update')?>">
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="subject">Mata Pelajaran</label>
                      <input type="text" hidden name='id' value="`+row['id']+`">
                      <input type="text" class="form-control" id="subject" name="subject" placeholder="Mata Pelajaran" value="`+row['name']+`">
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
            <div class="modal fade" id="modal-delete_`+data+`">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Hapus Data Mapel</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Yakin untuk menghapus mapel <strong>`+row['name']+`?</strong></p>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <a type="button" href="<?=base_url($this->uri->segment(1).'/subjects/')?>`+data+`" class="btn btn-danger">Yakin</a>
                  </div>
                </div>
              </div>
            </div>`;
          }},
      ],
      columnDefs: [
        {  className: "text-center", targets: 0 },
        {  className: "text-center", orderable: false, targets: 2 },
      ],
    });
  });
</script>
<?php } ?>

<?php if (isset($examgrouptype_table)) { ?>
<script>
  $(function () {
    $('#table_examgrouptypes').DataTable({
      responsive: true,
      language: {
        info: "Halaman _PAGE_ dari _PAGES_",
        search: "Cari:",
        lengthMenu: "tampilkan _MENU_ baris",
        emptyTable: "data masih kosong",
        zeroRecords: "data tidak ditemukan",
        paginate: { first: "<<", last: ">>", next: ">", previous: "<" },
      },
      data: <?=json_encode($examgrouptype)?>,
      columns: [
          { data: 'no', searchable: false },
          { data: 'name', searchable: true},
          { data: 'status', searchable: true, render : function ( data, type, row, meta ) {
            return data == 1 ? `<span class="text-success"><strong>Aktif</strong><span>` : `<button type="submit" class="btn btn-block bg-gradient-primary btn-sm" data-toggle="modal" data-target="#modal-active_`+data+`">Aktifkan</button>
            <div class="modal fade" id="modal-active_`+data+`">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Aktifkan Kelompok Ujian</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Pengaktifkan kelompok ujian baru akan otomatis menonaktifkan kelompok ujian yang lama<br/>Klik tombol aktifkan untuk mengaktifkan kelompok ujian <br/><strong>`+row['name']+`</strong</p>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <a type="button" href="<?=base_url($this->uri->segment(1).'/examgrouptype_active/')?>`+row['id']+`" class="btn btn-primary">Aktifkan</a>
                  </div>
                </div>
              </div>
            </div>
            `;
          }},
          // { defaultContent: '<a type="button" class="btn btn-warning btn-sm mr-2">Edit</button><a type="button" class="btn btn-danger btn-sm">Hapus</button>' },
          { data: 'id', render : function ( data, type, row, meta ) {
            return `<a type="button" class="btn btn-warning btn-sm mr-2" data-toggle="modal" data-target="#modal-edit_`+data+`">Edit</a><a type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete_`+data+`"><i class="fa fa-trash" aria-hidden="true"></i></a>
            <div class="modal fade" id="modal-edit_`+data+`">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Edit kelompok Ujian</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="POST" action="<?=base_url($this->uri->segment(1).'/examgrouptype_update')?>">
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="examgroup">kelompok Ujian</label>
                      <input type="text" hidden name='id' value="`+row['id']+`">
                      <input type="text" class="form-control" id="examgroup" name="examgroup" placeholder="Kelompok Ujian" value="`+row['name']+`">
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
            <div class="modal fade" id="modal-delete_`+data+`">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Hapus Kelompok Ujian</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Yakin untuk menghapus kelompok ujian <strong>`+row['name']+`?</strong></p>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <a type="button" href="<?=base_url($this->uri->segment(1).'/examgrouptypes/')?>`+data+`" class="btn btn-danger">Yakin</a>
                  </div>
                </div>
              </div>
            </div>`;
          }},
      ],
      columnDefs: [
        {  className: "text-center", targets: 0 },
        {  className: "text-center", orderable: false, targets: 3 },
        {  className: "text-center", targets: 2 },
      ],
    });
  });
</script>
<?php } ?>

<?php if (isset($exam_table)) { ?>
<script>
  $(function () {
    $('#table_exams').DataTable({
      responsive: true,
      language: {
        info: "Halaman _PAGE_ dari _PAGES_",
        search: "Cari:",
        lengthMenu: "tampilkan _MENU_ baris",
        emptyTable: "data masih kosong",
        zeroRecords: "data tidak ditemukan",
        paginate: { first: "<<", last: ">>", next: ">", previous: "<" },
      },
      columnDefs: [
        {  className: "text-center", targets: 0 },
        {  className: "text-center", targets: 1 },
        { orderable: false, targets: 3, className: "text-center" },
        { orderable: false, targets: 4 },
      ],
    });
  })
</script>
<?php } ?>

<?php if (isset($observer_table)) { ?>
<script>
  $(function () {
    $('#table_observers').DataTable({
      responsive: true,
      language: {
        info: "Halaman _PAGE_ dari _PAGES_",
        search: "Cari:",
        lengthMenu: "tampilkan _MENU_ baris",
        emptyTable: "data masih kosong",
        zeroRecords: "data tidak ditemukan",
        paginate: { first: "<<", last: ">>", next: ">", previous: "<" },
      },
      columnDefs: [
        {  className: "text-center", targets: 0 },
        // {  className: "text-center", targets: 1 },
        { orderable: false, targets: 2, className: "text-center" },
        { orderable: false, targets: 3, className: "text-center" },
      ],
    });
  })
</script>
<?php } ?>

<?php if (isset($class_table)) { ?>
<script>
  $(function () {
    $('#table_classes').DataTable({
      responsive: true,
      language: {
        info: "Halaman _PAGE_ dari _PAGES_",
        search: "Cari:",
        lengthMenu: "tampilkan _MENU_ baris",
        emptyTable: "data masih kosong",
        zeroRecords: "data tidak ditemukan",
        paginate: { first: "<<", last: ">>", next: ">", previous: "<" },
      },
      columnDefs: [
        { className: "text-center", targets: 0 },
        { targets: 1, className: "text-center" },
        { targets: 2, className: "text-center" },
        { targets: 3, className: "text-center" },
        { orderable: false, targets: 4, className: "text-center" },
      ],
    });
  })
</script>
<?php } ?>

<?php if (isset($room_table)) { ?>
<script>
  $(function () {
    $('#table_rooms').DataTable({
      responsive: true,
      language: {
        info: "Halaman _PAGE_ dari _PAGES_",
        search: "Cari:",
        lengthMenu: "tampilkan _MENU_ baris",
        emptyTable: "data masih kosong",
        zeroRecords: "data tidak ditemukan",
        paginate: { first: "<<", last: ">>", next: ">", previous: "<" },
      },
      columnDefs: [
        { className: "text-center", targets: 0 },
        { targets: 1,},
        { targets: 2,},
        { orderable: false, targets: 3, className: "text-center" },
      ],
    });
  })
</script>
<?php } ?>


<?php if (isset($users_table)) { ?>
<script>
  $(function () {
    $('#table_users').DataTable({
      responsive: true,
      language: {
        info: "Halaman _PAGE_ dari _PAGES_",
        search: "Cari:",
        lengthMenu: "tampilkan _MENU_ baris",
        emptyTable: "Belum ada siswa login",
        zeroRecords: "data tidak ditemukan",
        paginate: { first: "<<", last: ">>", next: ">", previous: "<" },
      },
      data: <?=json_encode($users)?>,
      columns: [
          { data: 'no', searchable: false },
          { data: 'username', searchable: true},
          { data: 'name', searchable: true},
          { data: 'level', render : function ( data, type, row, meta ) {
            return row['level']+" "+row['classorder'];                
          }},
          // { defaultContent: '<a type="button" class="btn btn-warning btn-sm mr-2">Edit</button><a type="button" class="btn btn-danger btn-sm">Hapus</button>' },
          { data: 'id', render : function ( data, type, row, meta ) {
            return `<a type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete_`+data+`"><i class="fa fa-recycle" aria-hidden="true"></i> Reset `+row['username']+`</a>
            <div class="modal fade" id="modal-delete_`+data+`">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Reset Login Siswa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Reset user <strong>`+row['username']+` | `+row['name']+`</strong> ?</p>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <a type="button" href="<?=base_url($this->uri->segment(1).'/reset_loginstudent/')?>`+data+`" class="btn btn-danger">Reset</a>
                  </div>
                </div>
              </div>
            </div>`;
          }},
      ],
      columnDefs: [
        { className: "text-center", targets: 0 },
        { targets: 1, className: "text-center" },
        { targets: 3, className: "text-center" },
        { orderable:false ,targets: 4, className: "text-center" },
      ],
    });
  })
</script>
<?php } ?>


<?php if (isset($score_table)) { ?>
<script>
  $(function () {
    $('#table_scores').DataTable({
      responsive: true,
      language: {
        info: "Halaman _PAGE_ dari _PAGES_",
        search: "Cari:",
        lengthMenu: "tampilkan _MENU_ baris",
        emptyTable: "Belum ada siswa login",
        zeroRecords: "data tidak ditemukan",
        paginate: { first: "<<", last: ">>", next: ">", previous: "<" },
      },
      data: <?=json_encode($exams_score)?>,
      columns: [
          { data: 'no', searchable: false },
          { data: 'username', searchable: true},
          { data: 'name', searchable: true},
          { data: 'temp_score', searchable: true},
          { data: 'score', searchable: true},
      ],
      columnDefs: [
        { className: "text-center", targets: 0 },
        { targets: 1, className: "text-center" },
        { targets: 3, className: "text-center" },
        { targets: 4, className: "text-center" },
      ],
    });
  })
</script>
<?php } ?>

</body>
</html>