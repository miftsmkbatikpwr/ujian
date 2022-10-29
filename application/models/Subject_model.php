<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function get_subject($id) {
		return $this->db->get_where('subjects', ['id'=>$id])->row_array();
	}

	public function add_subject($value) {
		$data = array(
	        'name' => $value,
		);
		$this->db->insert('subjects', $data);
		return $this->db->affected_rows();
	}

	public function del_subject($id) {
		$this->db->where('id', $id);
		$this->db->delete('subjects');
		return $this->db->affected_rows();
	}

	public function update_subject($id, $subject) {
		$this->db->set('name', $subject);
		$this->db->where('id', $id);
		$this->db->update('subjects');
		return $this->db->affected_rows();
	}

	public function get_subjects() {
		$this->db->select('subjects.*, ROW_NUMBER() OVER(ORDER BY id) no');
		return $this->db->get('subjects')->result_array();
	}
}