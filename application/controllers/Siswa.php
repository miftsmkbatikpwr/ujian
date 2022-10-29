<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	private $userData = null;
	public function __construct() {
        parent::__construct();
        // print_r($_SESSION);
        if ( $this->session->userdata('role') =='A') {
			redirect('admin');
		} 
		if ( $this->session->userdata('role') =='G' ) {
			redirect('guru');
		} 
		if ( $this->session->userdata('role') =='P' ) {
			redirect('proktor');
		}
		if ( $this->session->userdata('role') ==null ) {
			redirect('');
		}
		$this->load->model('user_model', 'm_user');
		$this->userData = $this->m_user->get_user();
    }

    public function index() {
		if ($this->userData['onexam']) {
			redirect('/siswa/exam');
		}
		$this->load->model('exam_model', 'm_exam');
		$data['header'] = $this->m_exam->get_examtitle();
		$data['available_exam'] = $this->m_exam->get_examavailable_students($_SESSION['id']);
		$data['student'] = $this->userData;
		// print_r($data); exit();
		// $this->load->view('templates/header', $dataheader);
		$this->load->view('studentexam/home', $data);
		// $this->load->view('templates/footer');
	}

	public function index_old() {
		if ($this->userData['onexam']) {
			redirect('/siswa/exam');
		}
		$this->load->model('exam_model', 'm_exam');
		$dataheader = $this->m_exam->get_examtitle();
		$data['available_exam'] = $this->m_exam->get_examavailable_students($_SESSION['id']);
		// print_r($data); exit();
		$this->load->view('templates/header', $dataheader);
		$this->load->view('student/home', $data);
		$this->load->view('templates/footer');
	}

	public function data_old() {
		if ($this->userData['onexam']) {
			redirect('/siswa/exam');
		}
		$this->load->model('exam_model', 'm_exam');
		$dataheader = $this->m_exam->get_examtitle();
		$data['student'] = $this->userData;
		// print_r($data); exit();
		$this->load->view('templates/header', $dataheader);
		$this->load->view('student/student', $data);
		$this->load->view('templates/footer');
	}

	

	public function exam_start() {
		if ($this->userData['onexam']) {
			redirect('/siswa/exam');
		}
		$this->load->model('exam_model', 'm_exam');
		if (null !== $this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			// validasi pilihan ujian siswa, validasi waktu ujian
			$exam = $this->m_exam->validate_examavailable_students($this->userData['id'],$this->uri->segment(3));
			// print_r($exam);
			if ($exam) {
				// Generate Exam
				$examdata = $this->m_exam->generate_exam($exam['id']);
				if ($examdata) {
					redirect('/siswa/exam');
				}
				// echo "<pre>"; print_r($examdata); echo "</pre>"; exit();
				
			}
		}
		redirect('/siswa');
	}

	public function exam() {
		if (!$this->userData['onexam']) {
			redirect('/siswa');
		}
		$this->load->model('exam_model', 'm_exam');
		$checktime_exrundata = $this->m_exam->checktime_exrundata();
		if ($checktime_exrundata <= 0) {
			redirect('/siswa/exam_time_up');
		}
		$data['student'] = $this->userData;
		$this->load->view('studentexam/exam', $data);
	}

	public function json_question() {
		if (!$this->userData['onexam']) {
			redirect('/siswa');
		}
		$student = $this->userData;
		$this->load->model('exam_model', 'm_exam');
		$checktime_exrundata = $this->m_exam->checktime_exrundata();
		if ($checktime_exrundata > 0) {
			if ($this->input->post('number') !== null && is_numeric($this->input->post('number'))) {
				$res = $this->m_exam->change_number($this->input->post('number'));
				echo $res;
			}
		}
		$exam = $this->m_exam->get_examrunningdata();
		echo json_encode($exam);
	}

	public function json_question_number() {
		if (!$this->userData['onexam']) {
			redirect('/siswa');
		}
		$student = $this->userData;
		$this->load->model('exam_model', 'm_exam');
		$checktime_exrundata = $this->m_exam->checktime_exrundata();
		if ($checktime_exrundata > 0) {
			if (null !== $this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
				$res = $this->m_exam->change_number($this->uri->segment(3));
				// echo $res;
			}
		}
		$exam = $this->m_exam->get_examrunningdata();
		echo json_encode($exam);
	}

	public function json_question_doubt() {
		if (!$this->userData['onexam']) {
			redirect('/siswa');
		}
		$student = $this->userData;
		$this->load->model('exam_model', 'm_exam');
		$checktime_exrundata = $this->m_exam->checktime_exrundata();
		if ($checktime_exrundata > 0) {
			$res = $this->m_exam->change_doubt();
		}
		$exam = $this->m_exam->get_examrunningdata();
		echo json_encode($exam);
	}

	public function json_question_ans() {
		if (!$this->userData['onexam']) {
			redirect('/siswa');
		}
		$student = $this->userData;
		$this->load->model('exam_model', 'm_exam');
		$checktime_exrundata = $this->m_exam->checktime_exrundata();
		if ($checktime_exrundata > 0) {
			if (null !== $this->uri->segment(3)) {
				$answer = strtolower($this->uri->segment(3));
				if ($answer=="a" || $answer=="b" || $answer=="c" || $answer=="d" || $answer=="e") {
					$res = $this->m_exam->change_answer($answer);
				}
			}
		}
		$exam = $this->m_exam->get_examrunningdata();
		echo json_encode($exam);
	}

	public function exam_time_up() {
		if (!$this->userData['onexam']) {
			redirect('/siswa');
		}
		$this->load->model('exam_model', 'm_exam');
		$checktime_exrundata = $this->m_exam->checktime_exrundata();
		if ($checktime_exrundata > 0) {
			redirect('siswa/exam');
		}
		$data['header'] = $this->m_exam->get_examtitle();
		$data['student'] = $this->userData;
		$this->load->view('studentexam/examtimeup', $data);
	}

	public function finish_exam() {
		if (!$this->userData['onexam']) {
			redirect('/siswa');
		}
		$this->load->model('exam_model', 'm_exam');
		$data['header'] = $this->m_exam->get_examtitle();
		// calculate score
		$data['score'] = $this->m_exam->calculate_score();
		// echo "<pre>"; print_r($data); echo "</pre>";
		$data['student'] = $this->userData;
		$this->load->view('studentexam/examfinish', $data);
	}
}
