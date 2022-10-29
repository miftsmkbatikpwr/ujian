<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questiongroup_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		// $this->load->database();
	}

	public function egt() {
		return $this->db->get_where('examgrouptypes', array('status' => 1), 1)->row_array();
	}

	public function get_questiongroups($examgrouptype=null) {
		if ($examgrouptype == null) {
			$egrt = $this->egt();
			$this->db->where('questiongroups.examgrouptype_id', $egrt['id']);
		} else {
			$this->db->where('questiongroups.examgrouptype_id', $examgrouptype);
		}
		$this->db->select('questiongroups.*, subjects.name');
		$this->db->join('subjects', 'subjects.id = questiongroups.subject_id');
		return $this->db->get('questiongroups')->result();
	}

	public function get_questiongroup($id) {
		$this->db->select('questiongroups.*,subjects.name subject');
		$this->db->where('questiongroups.id', $id);
		$this->db->join('subjects', 'subjects.id = questiongroups.subject_id');
		return $this->db->get('questiongroups')->row_array();
	}

	public function del_questiongroup($id) {
		$this->db->select('count(*) jml');
		$this->db->join('questiongroups', 'exams.questiongroup_id = questiongroups.id');
		$this->db->where('questiongroup_id', $id);
		$res = $this->db->get('exams')->row_array();
		if ($res['jml'] > 0) {
			return 0;
		}

		$this->db->where('id', $id);
		$this->db->where('tot_question', 0);
		$this->db->delete('questiongroups');
		return $this->db->affected_rows();
	}
}