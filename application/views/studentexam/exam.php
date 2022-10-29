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

    .border-ans-doubt {
      border-left: 15px solid #ffc107;
    }

    .border-ans-selected {
      border-left: 15px solid #21af04;
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
<script src="<?=base_url('assets/')?>js/babel.min.js"></script>
<script type="text/babel">
  // const url = "http://localhost/ujian/siswa"
  const url = "<?=base_url('siswa')?>"
  function Exam() {
    const { useEffect, useState } = React
    const [loading, setLoading] = useState(true);
    // const [firstRend, setFirstRend] = useState(false);
    const [data, setData] = useState(null);
    // const [isChecked, setIsChecked] = useState(false);
    useEffect(() => {
      const controller = new AbortController()
      console.log('Exam useEffect')
      
      if (data == null) {
        console.log('Fetch Exam')
        fetch(url+'/json_question', { signal: controller.signal })
          .then((response) => response.json())
          .then(res => {
            // setFirstRend(true)
            if (res.countdown_sec <= 0) {
              window.location.href = url+'/exam_time_up'
            } else {
              setLoading(false)
              setData(res)
            }
            
          })
          .catch((error) => {
            console.error('Error:', error);
          })
      }
      return () => {
        controller.abort()
      }
    },[data])
    console.log(data);

    return (
      <React.Fragment>
        {loading && <ContentLoading/>}
        {!loading && <ContentHeader data={data} setLoading={setLoading} setData={setData} /> }
        {!loading && <ContentContainer data={data} setLoading={setLoading} setData={setData} /> }
      </React.Fragment>
    )
  }

  

  function ContentHeader({data,setLoading,setData}) {

    const handleCheck = () => {
      // setIsChecked(!isChecked)
      setLoading(true)
      console.log("change doubt")
      fetch(url+'/json_question_doubt')
        .then((response) => response.json())
        .then(res => {
          setLoading(false)
          setData(res)
        })
        .catch((error) => {
          console.error('Error:', error);
        })
    }

    return (
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
            { data !== null && <h5 class={`m-0 font-weight-bold`+(data.doubt ? ' text-warning':'')}>Soal No.{data.number}</h5>}
            </div>
            <div class="col-sm-6">
              <div class="form-check float-sm-right">
                <input type="checkbox" onChange={()=>handleCheck()} defaultChecked={data.doubt} className="form-check-input makechange-cursor-pointer" />
                RAGU-RAGU
              </div>
            </div>
          </div>
        </div>
      </div>
    )
  }

  function ContentContainer({data,setLoading,setData}) {
    const handleChangeNo = (number) => {
      setLoading(true)
      console.log('Set Number '+number)
      fetch(url+'/json_question_number/'+number)
        .then((response) => response.json())
        .then(res => {
          setLoading(false)
          setData(res)
        })
        .catch((error) => {
          console.error('Error:', error);
        })
    }

    const handleChangeAnswer = (ans) => {
      setLoading(true)
      console.log('Set Answer '+ans)
      fetch(url+'/json_question_ans/'+ans)
        .then((response) => response.json())
        .then(res => {
          setLoading(false)
          setData(res)
        })
        .catch((error) => {
          console.error('Error:', error);
        })
    }

    return (
      <div class="content">
        <div class="container">
          <Question data={data} />
          <Answer data={data} handleChangeAnswer={handleChangeAnswer} />
          <FooterQuestion data={data} handleChangeNo={handleChangeNo} />
        </div>
        
        <ModalNumbers data={data} handleChangeNo={handleChangeNo} />
      </div>
    )
  }

  function Question({data}) {
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

  function Answer({data,handleChangeAnswer}) {
    const url = `<?=base_url('assets/gambar/')?>`
    const img_a = data !== null ? data.answer.img_ans_a : null
    const img_b = data !== null ? data.answer.img_ans_b : null
    const img_c = data !== null ? data.answer.img_ans_c : null
    const img_d = data !== null ? data.answer.img_ans_d : null
    const img_e = data !== null ? data.answer.img_ans_e : null
    const cClass = "callout makechange-cursor-pointer border-ans"
    const cDoubt = data.doubt == true ? " border-ans-doubt" : ""
    
    return (
      <React.Fragment>
        <h5>Pilihan Jawaban :</h5>
        { data !== null && <div onClick={()=>handleChangeAnswer('a')} class={cClass+cDoubt+(data.std_ans=='a' ? ' border-ans-selected' : '')}>
          {img_a !== null && <img width="100%" src={url+img_a} alt="Gambar Soal"/> }
          {data.answer.ans_a}</div> }
        { data !== null && <div onClick={()=>handleChangeAnswer('b')} class={cClass+cDoubt+(data.std_ans=='b' ? ' border-ans-selected' : '')}>
          {img_b !== null && <img width="100%" src={url+img_b} alt="Gambar Soal"/> }
          {data.answer.ans_b}</div> }
        { data !== null && <div onClick={()=>handleChangeAnswer('c')} class={cClass+cDoubt+(data.std_ans=='c' ? ' border-ans-selected' : '')}>
          {img_c !== null && <img width="100%" src={url+img_c} alt="Gambar Soal"/> }
          {data.answer.ans_c}</div> }
        { data !== null && <div onClick={()=>handleChangeAnswer('d')} class={cClass+cDoubt+(data.std_ans=='d' ? ' border-ans-selected' : '')}>
          {img_d !== null && <img width="100%" src={url+img_d} alt="Gambar Soal"/> }
          {data.answer.ans_d}</div> }
        { data !== null && <div onClick={()=>handleChangeAnswer('e')} class={cClass+cDoubt+(data.std_ans=='e' ? ' border-ans-selected' : '')}>
          {img_e !== null && <img width="100%" src={url+img_e} alt="Gambar Soal"/> }
          {data.answer.ans_e}</div> }
      </React.Fragment>
    )
  }

  function FooterQuestion({data,handleChangeNo}) {
    const { useEffect, useState } = React
    const [cdTime, setCdTime] = useState(data.countdown_sec);
    const [hms, setHMS] = useState({ "h": 0, "m": 0, "s": 0 })

    useEffect(() => {
      const interval = setInterval(() => {
          const hhmmss = secondsToTime(cdTime)
          setHMS(hhmmss);
          if (parseInt(cdTime) <= 0) {window.location.href = url+'/exam_time_up'}
          if (hhmmss.h <= 0 && hhmmss.m <= 0 && hhmmss.s <= 0) return () => clearInterval(interval);
          console.log(cdTime)
          setCdTime((t) => t - 1);
        }, 1000);

        return () => clearInterval(interval);
    }, [cdTime]);

    return (
      <div class="card">
        <div class="card-body">
          <div class="progress">
            <div class="progress-bar bg-success progress-bar-striped" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
        <div class="card-footer">
          <span class="h2 mb-1 mt-1 text-danger bg-danger pl-2 pr-2 rounded">{hms.h < 10 ? `0`+hms.h : hms.h}:{hms.m < 10 ? `0`+hms.m : hms.m}:{hms.s < 10 ? `0`+hms.s : hms.s}</span>
          <div class="btn-group float-right mb-1 mt-1">
            {(parseInt(data.answered) == Object.keys(data.numbers).length) && <button type="button" className="btn btn-danger" data-toggle="modal" data-target='#modal-exam_finish'>Akhiri Ujian</button>}
            {data.number > 1 && <button onClick={()=>handleChangeNo(parseInt(data.number)-1)} type="button" className="btn btn-info">Soal No.{parseInt(data.number)-1}</button>}
            <button type="button" className="btn btn-dark" data-toggle="modal" data-target='#modal-lg_numbers'>Pilih No</button>
            {(parseInt(data.number) < Object.keys(data.numbers).length) && <button onClick={()=>handleChangeNo(parseInt(data.number)+1)} type="button" className="btn btn-info">Soal No.{parseInt(data.number)+1}</button>}
          </div>
          <ModalFinish/>
        </div>
      </div>
    )
  }

  const secondsToTime = (secs) => {
    let hours = Math.floor(secs / (60 * 60));

    let divisor_for_minutes = secs % (60 * 60);
    let minutes = Math.floor(divisor_for_minutes / 60);

    let divisor_for_seconds = divisor_for_minutes % 60;
    let seconds = Math.ceil(divisor_for_seconds);

    let obj = {
      "h": hours,
      "m": minutes,
      "s": seconds
    };
    return obj;
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
              <p class="text-center">Silahkan manfaatkan waktu sebaik mungkin, cek kembali jawabanmu jika sisa waktumu masih banyak.</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Lanjutkan Ujian</button>
              <a href="<?=base_url('siswa/finish_exam');?>" type="button" class="btn btn-danger">Akhiri Ujian Sekarang</a>
            </div>
          </div>
        </div>
      </div>
    )
  }

  function ModalNumbers({data,handleChangeNo}) {
    const numberselect = Object.keys(data.numbers).map((key,index)=> {
    const colorbtnans = data.numbers[key].std_ans !== null ? ' bg-success' : ''
    const colorbtn = (data.numbers[key].doubt == true) && data.numbers[key].order != data.number ? ' bg-warning' : ''
    const colorbtnselect = data.numbers[key].order == data.number ? ' bg-primary' : ' bg-secondary'
    return (
        <a key={index} data-dismiss="modal" onClick={()=>handleChangeNo(data.numbers[key].order)} className={`btn btn-app`+colorbtnans+colorbtn+colorbtnselect}>
            <h4> {data.numbers[key].order}</h4>
        </a>
      )
    })

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
              {numberselect}
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
