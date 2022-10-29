<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Observers_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	// public function get_subject($id) {
	// 	return $this->db->get_where('subjects', ['id'=>$id])->row_array();
	// }

	// public function add_examgrouptype($value) {
	// 	$data = array(
	//         'name' => $value,
	// 	);
	// 	$this->db->insert('examgrouptypes', $data);
	// 	return $this->db->affected_rows();
	// }

	public function del_observer($id) {
		$this->db->where('id', $id);
		$this->db->delete('observers');
		return $this->db->affected_rows();
	}

	// public function update_examgrouptype($id, $name) {
	// 	$this->db->set('name', $name);
	// 	$this->db->where('id', $id);
	// 	$this->db->update('examgrouptypes');
	// 	return $this->db->affected_rows();
	// }

	public function activate_observer($id) {
		$this->db->where('id', $id);
		$observer = $this->db->get('observers',1)->row_array();
		$status = $observer['status'] == 1 ? 0 : 1;
		$this->db->set('status', $status);
		$this->db->where('id', $id);
		$this->db->update('observers');
		return $this->db->affected_rows();
	}

	public function get_observers() {
		$this->db->select('observers.*, ROW_NUMBER() OVER(ORDER BY id) no');
		return $this->db->get('observers')->result_array();
	}
}