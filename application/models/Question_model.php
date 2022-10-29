<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		// $this->load->database();
	}

	public function get_questions($qgroup_id) {
		$this->db->select('questions.*');
		$this->db->join('questiongroups', 'questions.questiongroup_id = questiongroups.id');
		return $this->db->get('questions')->result();
	}

	public function del_question($id, $qgroup_id) {
		$this->db->where('id', $id);
		$this->db->where('questiongroup_id', $qgroup_id);
		$this->db->delete('questions');
		$res = $this->db->affected_rows();
		if (!$res) {
			return 0;
		}
		return $this->db->query("UPDATE questiongroups SET tot_question=(SELECT count(*) FROM questions WHERE questions.questiongroup_id=".$qgroup_id.") WHERE id=".$qgroup_id);
	}
}