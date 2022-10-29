<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		// $this->load->database();
	}

	public function get_user($username=null) {
		if ($username!=null) { 
			$this->db->select('users.*, classes.level, classes.group, classes.classorder');
			$this->db->join('classes', 'classes.id = users.class_id', 'left');
			return $this->db->get_where('users', ['username'=>$username])->row_array(); 
		} else {
			$this->db->select('users.*, classes.level, classes.group, classes.classorder');
			$this->db->join('classes', 'classes.id = users.class_id', 'left');
			return $this->db->get_where('users', ['users.id'=>$this->session->userdata('id')])->row_array();
			return $this->db->get('users')->row_array(); 
		}
	}


	public function get_user_student_login() {
		$this->db->select('users.*, classes.level, classes.group, classes.classorder, ROW_NUMBER() OVER(ORDER BY id) no');
		$this->db->join('classes', 'classes.id = users.class_id', 'left');
		return $this->db->get_where('users', ['users.islogin'=>1, 'users.role'=>'S'])->result_array();
	}

	public function reset_student($id) {
		$this->db->set('islogin', 0);
		$this->db->where('id', $id);
		$this->db->update('users');
		return 1;
	}

	public function set_islogin($id, $islogin=false) {
		$retVal = ($islogin) ? 1 : 0 ;
		$this->db->set('islogin', $retVal);
		$this->db->where('id', $id);
		$this->db->update('users');
	}

	public function hash_password() {
		$this->db->set('password', password_hash('1', PASSWORD_DEFAULT));
		$this->db->update('users');
	}
}