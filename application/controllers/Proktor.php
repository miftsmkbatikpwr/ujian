<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proktor extends CI_Controller {
	public function __construct() {
        parent::__construct();
        // print_r($_SESSION);
        if ( $this->session->userdata('role') =='S') {
			redirect('siswa');
		} 
		if ( $this->session->userdata('role') =='G' ) {
			redirect('guru');
		} 
		if ( $this->session->userdata('role') =='A' ) {
			// redirect('admin');
		}
		if ( $this->session->userdata('role') ==null ) {
			redirect('');
		}
    }

    public function index() {
    	$this->load->model('exam_model', 'm_exam');
		$dataheader = $this->m_exam->get_examtitle();
		$this->load->view('templates/header',$dataheader);
		$this->load->view('proktor/home');
		$this->load->view('templates/footer');
    }

    public function reset_loginstudent() {
    	$this->load->model('exam_model', 'm_exam');
		$this->load->model('user_model', 'm_user');
		if (null !== $this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$affRow = $this->m_user->reset_student($this->uri->segment(3));
			if ($affRow) {
				$this->session->set_flashdata('success', 'Reset data user siswa berhasil');
			} else {
				$this->session->set_flashdata('failed', 'Reset data user siswa gagal');
			}
			redirect('/proktor/reset_loginstudent');
		}
		$dataheader = $this->m_exam->get_examtitle();
		$dataheader['data_table'] = true;
		$data['users'] = $this->m_user->get_user_student_login();
		// print_r($data); exit();
		$datafooter['users_table'] = true;
		$this->load->view('templates/header',$dataheader);
		$this->load->view('proktor/student_login',$data);
		$this->load->view('templates/footer',$datafooter);
    }
}