<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Examgrouptypes_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	// public function get_subject($id) {
	// 	return $this->db->get_where('subjects', ['id'=>$id])->row_array();
	// }

	public function add_examgrouptype($value) {
		$data = array(
	        'name' => $value,
		);
		$this->db->insert('examgrouptypes', $data);
		return $this->db->affected_rows();
	}

	public function del_examgrouptype($id) {
		$this->db->where('id', $id);
		$this->db->delete('examgrouptypes');
		return $this->db->affected_rows();
	}

	public function update_examgrouptype($id, $name) {
		$this->db->set('name', $name);
		$this->db->where('id', $id);
		$this->db->update('examgrouptypes');
		return $this->db->affected_rows();
	}

	public function activate_examgrouptype($id) {
		$this->db->set('status', 0);
		$this->db->update('examgrouptypes');
		$this->db->set('status', 1);
		$this->db->where('id', $id);
		$this->db->update('examgrouptypes');
		return $this->db->affected_rows();
	}

	public function get_examgrouptypes() {
		$this->db->select('examgrouptypes.*, ROW_NUMBER() OVER(ORDER BY id) no');
		return $this->db->get('examgrouptypes')->result_array();
	}
}