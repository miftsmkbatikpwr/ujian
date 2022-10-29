<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?=base_url('assets/images/BGSMK5050.png')?>">
  <title>CAT - SMK BATIK PERBAIK</title>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?=base_url('assets/')?>plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('assets/')?>dist/css/adminlte.min.css">
  <style>
    .login-page {
      background-color: #fff;
    }

    .blink_me {
      animation: blinker 1s linear infinite;
    }

    .no-box-shadow {
      box-shadow: none;
    }

    .input-group-text.mod {
      background-color: #17a2b8;
      color: #fff;
    }

    .makechange-cursor-pointer {
      cursor: pointer;
    }

    .makechange-cursor-auto {
      cursor: progress;
    }

    .border-ans {
      border-left: 15px solid #d1d3d3;
    }

    .border-ans-selected {
      border-left: 15px solid #21af04;
    }

    .border-ans-doubt {
      border-left: 15px solid #eff313;
    }

    div.card-body.img-question {
      padding: 0;
    }

    @keyframes blinker {
      50% {
        opacity: 0;
      }
    }
  </style>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
  <nav class="position-sticky main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a class="navbar-brand">
        <img src="<?=base_url('assets/images/BGSMK5050.png')?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8;">
        <span class="brand-text font-weight-bold">SMK Batik Perbaik</span>
      </a>
      <div class="collapse navbar-collapse order-3" id="navbarCollapse"></div>
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item"></li>
      </ul>
    </div>
  </nav>

  <div id="root" class="content-wrapper">
  <div class="content p-5">
      <div class="container">
        <div class="card">
          <div class="card-body text-center">
          <h5 class="blink_me">Loading</h5>
          <h5><i class="fa fa-spinner fa-spin"></i></h5>
          </div>
        </div>
      </div>
    </div>
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h5 class="m-0 font-weight-bold">Soal No.-</h5>
          </div>
          <div class="col-sm-6">
            <div class="form-check float-sm-right">
              <input type="checkbox" class="form-check-input makechange-cursor-pointer">RAGU
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container">
        <div class="card">
          <div class="card-body img-question"></div>
        </div>
        <div class="card">
          <div class="card-body">
            <div>Pertanyaan</div>
          </div>
        </div>
        <h5>Pilihan Jawaban :</h5>
        <div class="callout makechange-cursor-pointer border-ans border-ans-selected">a</div>
        <div class="callout makechange-cursor-pointer border-ans">b</div>
        <div class="callout makechange-cursor-pointer border-ans">c</div>
        <div class="callout makechange-cursor-pointer border-ans">d</div>
        <div class="callout makechange-cursor-pointer border-ans">e</div>
        <div class="card">
          <div class="card-body">
            <div class="progress">
              <div class="progress-bar bg-success progress-bar-striped" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: 2%;"></div>
            </div>
          </div>
          <div class="card-footer">
            <span class="h2 mb-1 mt-1 text-danger bg-danger pl-2 pr-2 rounded">00:00:00</span>
            <div class="btn-group float-right mb-1 mt-1">
              <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal-lg_numbers">Pilih No</button>
              <button type="button" class="btn btn-info">Soal No.-</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="main-footer">
    <div class="container">
    <div class="float-right d-none d-sm-inline">
      Aplikasi Ujian Berbasis Komputer
    </div>
    <strong>Copyright &copy; 2022 SMK BATIK PERBAIK</strong>
    </div>
  </footer>
</div>
<!-- jQuery -->
<script src="<?=base_url('assets/')?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url('assets/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/')?>dist/js/adminlte.min.js"></script>
<!-- React JS -->
<!-- <script src="https://unpkg.com/react@18/umd/react.production.min.js" crossorigin></script> -->
<script src="<?=base_url('assets/')?>js/react.production.min.js"></script>
<!-- <script src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js" crossorigin></script> -->
<script src="<?=base_url('assets/')?>js/react-dom.production.min.js"></script>
<script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
<script type="text/babel">
  function Exam() {
    const { useEffect, useState } = React
    const [loading, setLoading] = useState(false);
    const [data, setData] = useState(null);
    useEffect(() => {
      const controller = new AbortController()
      console.log('Start React')
      const url = "http://localhost/ujian/siswa/json_question"

      if (data == null) {
        fetch(url, { signal: controller.signal })
          .then((response) => response.json())
          .then(res => {
            // console.log(res)
            setData(res)
          })
          .catch((error) => {
            console.error('Error:', error);
          })
          .finally((e) => {
            console.error('Finally:', e);
          })
      }
  
      return () => {
        controller.abort()
      }
    })

    console.log(data);

    return (
      <React.Fragment>
        <ContentLoading/>
        <ContentHeader data={data} />
        <ContentContainer data={data} />
      </React.Fragment>
    )
  }

  function ContentHeader(props) {
    const data = props.data;
    return (
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
            { data !== null && <h5 class="m-0 font-weight-bold">Soal No.{data.number}</h5>}
            </div>
            <div class="col-sm-6">
              <div class="form-check float-sm-right">
                <input type="checkbox" class="form-check-input makechange-cursor-pointer" />RAGU
              </div>
            </div>
          </div>
        </div>
      </div>
    )
  }

  function ContentContainer(props) {
    return (
      <div class="content">
        <div class="container">
          <Question data={props.data} />
          <Answer data={props.data} />
          <FooterQuestion/>
        </div>
        <ModalFinish/>
        <ModalNumbers/>
      </div>
    )
  }

  function Question(props) {
    const data = props.data
    const url = `<?=base_url('assets/gambar/')?>`
    const img = data !== null ? data.question.img_q1 : null
    return (
      <React.Fragment>
        { data!==null && img!==null && <div class="card">
          <div class="card-body img-question">
            <img width="100%" src={url+img} alt="Gambar Soal"/>
          </div>
        </div> }
        { data!==null && data.question.question!==null && <div class="card">
          <div class="card-body">
            <div dangerouslySetInnerHTML={{
                __html: data.question.question
            }}></div>
          </div>
        </div> }
      </React.Fragment>
    )
  }

  function Answer(props) {
    const data = props.data;
    const url = `<?=base_url('assets/gambar/')?>`
    const img_a = data !== null ? data.answer.img_ans_a : null
    const img_b = data !== null ? data.answer.img_ans_b : null
    const img_c = data !== null ? data.answer.img_ans_c : null
    const img_d = data !== null ? data.answer.img_ans_d : null
    const img_e = data !== null ? data.answer.img_ans_e : null
    return (
      <React.Fragment>
        <h5>Pilihan Jawaban :</h5>
        { data !== null && <div class="callout makechange-cursor-pointer border-ans border-ans-selected">
          <img width="100%" src={url+img_a} alt="Gambar Soal"/>
          {data.answer.ans_a}</div> }
        { data !== null && <div class="callout makechange-cursor-pointer border-ans">
          <img width="100%" src={url+img_b} alt="Gambar Soal"/>
          {data.answer.ans_b}</div> }
        { data !== null && <div class="callout makechange-cursor-pointer border-ans">
          <img width="100%" src={url+img_c} alt="Gambar Soal"/>
          {data.answer.ans_c}</div> }
        { data !== null && <div class="callout makechange-cursor-pointer border-ans">
          <img width="100%" src={url+img_d} alt="Gambar Soal"/>
          {data.answer.ans_d}</div> }
        { data !== null && <div class="callout makechange-cursor-pointer border-ans">
          <img width="100%" src={url+img_e} alt="Gambar Soal"/>
          {data.answer.ans_e}</div> }
      </React.Fragment>
    )
  }

  function FooterQuestion() {
    return (
      <div class="card">
        <div class="card-body">
          <div class="progress">
            <div class="progress-bar bg-success progress-bar-striped" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
        <div class="card-footer">
          <span class="h2 mb-1 mt-1 text-danger bg-danger pl-2 pr-2 rounded">00:00:00</span>
          <div class="btn-group float-right mb-1 mt-1">
            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal-lg_numbers">Pilih No</button>
            <button type="button" class="btn btn-info">Soal No.-</button>
          </div>
        </div>
      </div>
    )
  }

  function ModalFinish() {
    return (
      <div class="modal fade" id="modal-exam_finish">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Konfirmasi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="text-center">Yakin Untuk mengakhiri UJIAN ?</p>
              <p class="text-center">Manfaatkan waktu sebaik mungkin, cek kembali jawabanmu jika sisa waktumu masih banyak.</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Akhiri Ujian</button>
            </div>
          </div>
        </div>
      </div>
    )
  }

  function ModalNumbers() {
    return (
      <div class="modal fade" id="modal-lg_numbers">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pilih Nomer Soal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <a data-dismiss="modal" class="btn btn-app bg-secondary bg-success">
                <h4> 1</h4>
              </a>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-dark" data-dismiss="modal">Tutup</button>
            </div>
          </div>
        </div>
      </div>
    )
  }

  const ContentLoading = () => {
      return (
        <div className="content p-5">
          <div className="container">
            <div className="card">
              <div className="card-body text-center">
              <h5 className="blink_me">Loading</h5>
              <h5><i className="fa fa-spinner fa-spin"/></h5>
              </div>
            </div>
          </div>
        </div>
      )
    }

  const container = document.getElementById('root');
  const root = ReactDOM.createRoot(container);
  root.render(<Exam />);
</script>
</body>
</html>
