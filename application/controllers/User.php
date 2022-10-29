<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct() {
        parent::__construct();
        // print_r($_SESSION);
    }

    public function logout() {
    	if ($this->session->userdata('id')) {
    		$this->load->model('user_model', 'm_user');
    		$this->m_user->set_islogin($this->session->userdata('id'),false);
    		$array_items = array('id', 'role', 'name');
    		$this->session->unset_userdata($array_items);
    	}
    	redirect('');
    }

	public function index() {
		if ( $this->session->userdata('role') =='A') {
			redirect('admin');
		} 
		if ( $this->session->userdata('role') =='G' ) {
			redirect('guru');
		} 
		if ( $this->session->userdata('role') =='S' ) {
			redirect('siswa');
		} 
		if ( $this->session->userdata('role') =='P' ) {
			redirect('proktor');
		}
		// Login POST
		if (isset($_POST['submit'])) {
			// print_r($_POST);
			$this->form_validation->set_rules('user', 'username', 'required',
	        	['required' => '%s harus diisi.',]
			);
			$this->form_validation->set_rules('pass', 'password', 'required',
	        	array('required' => '%s harus diisi.')
			);
			if ($this->form_validation->run()) {

	            $user = $this->input->post('user', TRUE);
				$pass = $this->input->post('pass');
				$this->load->model('user_model', 'm_user');
				// echo $user;
				$user = $this->m_user->get_user($user);
				// echo $user;
				if ($user) {
					if (password_verify($pass, $user['password'])) {
						$data = [
							'id' => $user['id'],
							'role' => $user['role'],
							'name' => $user['name']
						];
						// echo $_SERVER['REMOTE_ADDR'];
						if ($user['role'] == 'S' && $user['islogin'] && $user['ipaddr'] !== $_SERVER['REMOTE_ADDR']) {
							$this->session->set_flashdata('login_failed', 'Username sedang aktif');
						} else {
							$this->session->set_userdata($data);
							$this->m_user->set_islogin($user['id'],true);
							if ( $this->session->userdata('role') =='A') {
								redirect('admin');
							} elseif ( $this->session->userdata('role') =='G' ) {
								redirect('guru');
							} elseif ( $this->session->userdata('role') =='S' ) {
								redirect('siswa');
							} elseif ( $this->session->userdata('role') =='P' ) {
								redirect('proktor');
							} else {
								redirect('');
							}
						}	
					} else {
						$this->session->set_flashdata('login_failed', 'Username / Password salah');
					}
				} else {
					$this->session->set_flashdata('login_failed', 'Username / Password salah');
				}
	        }
		}
		// Exam_model
		$this->load->model('exam_model', 'm_exam');
		$data = $this->m_exam->get_examtitle();
		$this->load->view('exam/login',$data);
	}
}
