<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct() {
        parent::__construct();
        // print_r($_SESSION);
        if ( $this->session->userdata('role') =='S') {
			redirect('siswa');
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
    }

	public function index() {
		$this->load->model('exam_model', 'm_exam');
		$dataheader = $this->m_exam->get_examtitle();
		$this->load->view('templates/header',$dataheader);
		$this->load->view('admin/home');
		$this->load->view('templates/footer');
	}

	public function check_score() {

		$this->load->model('exam_model', 'm_exam');
		$dataheader = $this->m_exam->get_examtitle();
		$dataheader['data_table'] = true;
		$data['exams'] = $this->m_exam->get_exam_activegrouptypes();
		$data['id_exam'] = 0;
		if (count($data['exams']) > 0) {
			$data['id_exam'] = $data['exams'][0]['id'];
		}
		if ($this->input->post('exam') !== null) {
			$data['id_exam'] = $this->input->post('exam');
		}
		$data['exams_score'] = $this->m_exam->get_exam_scores($data['id_exam']);
		$datafooter['score_table'] = true;
		$datafooter['exams_score'] = $data['exams_score'];
		$this->load->view('templates/header',$dataheader);
		$this->load->view('admin/check_score',$data);
		$this->load->view('templates/footer',$datafooter);
	}

	// subjects
	public function subjects() {
		$this->load->model('exam_model', 'm_exam');
		$this->load->model('subject_model', 'm_subject');
		if (null !== $this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$affRow = $this->m_subject->del_subject($this->uri->segment(3));
			if ($affRow) {
				$this->session->set_flashdata('success', 'Hapus data mapel berhasil');
			} else {
				$this->session->set_flashdata('failed', 'Hapus data mapel gagal');
			}
			redirect('/admin/subjects');
		}
		$dataheader = $this->m_exam->get_examtitle();
		$dataheader['data_table'] = true;
		$data['subjects'] = $this->m_subject->get_subjects();
		$datafooter['subject_table'] = true;
		$datafooter['subjects'] = $data['subjects'];
		$this->load->view('templates/header',$dataheader);
		$this->load->view('admin/subjects',$data);
		$this->load->view('templates/footer',$datafooter);
		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';
	}

	public function subject_save() {
		if ($this->input->post('subject')) {
			$this->load->model('subject_model', 'm_subject');
			$subject_name = $this->input->post('subject');
			$affRow = $this->m_subject->add_subject($this->input->post('subject'));
			if ($affRow) {
				$this->session->set_flashdata('success', 'Tambah data mapel '.$this->input->post('subject').' berhasil');
				redirect('/admin/subjects');
			}
		}
		$this->session->set_flashdata('failed', 'Tambah data mapel gagal');
		redirect('/admin/subjects');
	}


	public function subject_update() {
		if ($this->input->post('subject') && $this->input->post('id')) {
			$this->form_validation->set_rules('subject', 'Mapel', 'is_unique[subjects.name]',
	        	['is_unique' => '%s sudah ada.',]
			);
			if (!$this->form_validation->run()) {
				$this->session->set_flashdata('failed', 'Update data mapel gagal, data sudah tersimpan di database');
				redirect('/admin/subjects');
			}
			$this->load->model('subject_model', 'm_subject');
			$subject_name = $this->input->post('subject');
			$affRow = $this->m_subject->update_subject($this->input->post('id'),$this->input->post('subject'));
			if ($affRow) {
				$this->session->set_flashdata('success', 'Update data mapel '.$this->input->post('subject').' berhasil');
				redirect('/admin/subjects');
			}
		}
		$this->session->set_flashdata('failed', 'Update data mapel gagal');
		redirect('/admin/subjects');
	}

	public function rooms() {
		$this->load->model('exam_model', 'm_exam');
		$this->load->model('rooms_model', 'm_room');
		if (null !== $this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$affRow = $this->m_room->del_room($this->uri->segment(3));
			if ($affRow) {
				$this->session->set_flashdata('success', 'Hapus data ruang berhasil');
			} else {
				$this->session->set_flashdata('failed', 'Hapus data ruang gagal');
			}
			redirect('/admin/rooms');
		}
		$dataheader = $this->m_exam->get_examtitle();
		$dataheader['data_table'] = true;
		$data['rooms'] = $this->m_room->get_rooms();
		$datafooter['room_table'] = true;
		// $datafooter['subjects'] = $data['subjects'];
		$this->load->view('templates/header',$dataheader);
		$this->load->view('admin/rooms',$data);
		$this->load->view('templates/footer',$datafooter);
	}

	public function room_save() {
		$dataInput = $_POST;
		$data = array(
	        'name' => $_POST['name'],
	        'proktor' => $_POST['proktor']
		);
		$this->db->insert('rooms', $data);
		redirect(base_url('admin/rooms'));
	}

	public function room_update() {
		if ($this->input->post('proktor') && $this->input->post('name') && $this->input->post('id')) {
			$this->load->model('rooms_model', 'm_room');
			$subject_name = $this->input->post('subject');
			$affRow = $this->m_room->update_room($this->input->post('id'),$this->input->post('name'),$this->input->post('proktor'));
			if ($affRow) {
				$this->session->set_flashdata('success', 'Update data ruang '.$this->input->post('name').' berhasil');
				redirect('/admin/rooms');
			}
		}
		$this->session->set_flashdata('failed', 'Update data ruang gagal');
		redirect('/admin/rooms');
	}


	public function classes() {
		$this->load->model('exam_model', 'm_exam');
		$this->load->model('classes_model', 'm_class');
		if (null !== $this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$affRow = $this->m_class->del_class($this->uri->segment(3));
			if ($affRow) {
				$this->session->set_flashdata('success', 'Hapus data kelas berhasil');
			} else {
				$this->session->set_flashdata('failed', 'Hapus data kelas gagal');
			}
			redirect('/admin/classes');
		}
		$dataheader = $this->m_exam->get_examtitle();
		$dataheader['data_table'] = true;
		$data['classes'] = $this->m_class->get_classes();
		$datafooter['class_table'] = true;
		// $datafooter['subjects'] = $data['subjects'];
		$this->load->view('templates/header',$dataheader);
		$this->load->view('admin/classes',$data);
		$this->load->view('templates/footer',$datafooter);
	}

	public function class_save() {
		$dataInput = $_POST;
		$data = array(
	        'level' => $_POST['level'],
	        'group' => $_POST['group'],
	        'classorder' => $_POST['classorder']
		);
		$this->db->insert('classes', $data);
		redirect(base_url('admin/classes'));
	}

	public function observers() {
		$this->load->model('exam_model', 'm_exam');
		$this->load->model('observers_model', 'm_observer');
		if (null !== $this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$affRow = $this->m_observer->del_observer($this->uri->segment(3));
			if ($affRow) {
				$this->session->set_flashdata('success', 'Hapus data pengawas ujian berhasil');
			} else {
				$this->session->set_flashdata('failed', 'Hapus data pengawas ujian gagal');
			}
			redirect('/admin/observers');
		}
		$dataheader = $this->m_exam->get_examtitle();
		$dataheader['data_table'] = true;
		$data['observer'] = $this->m_observer->get_observers();
		$datafooter['observer_table'] = true;
		// $datafooter['subjects'] = $data['subjects'];
		$this->load->view('templates/header',$dataheader);
		$this->load->view('admin/observers',$data);
		$this->load->view('templates/footer',$datafooter);
	}

	public function observer_save() {
		$dataInput = $_POST;
		$data = array(
	        'name' => $_POST['observer']
		);
		$this->db->insert('observers', $data);
		redirect(base_url('admin/observers'));
	}

	// public function observer_delete() {
	// 	if (null !== $this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
	// 		$this->load->model('observers_model', 'm_observer');
	// 		$affRow = $this->m_observer->del_observer($this->uri->segment(3));
	// 		if ($affRow) {
	// 			$this->session->set_flashdata('success', 'Hapus Pengawas berhasil');
	// 			redirect(base_url('admin/observers'));
	// 		}
	// 	}
	// 	$this->session->set_flashdata('failed', 'Hapus Pengawas gagal');
	// 	redirect(base_url('admin/observers'));
	// }

	public function change_act_observer() {
		if (null !== $this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$this->load->model('observers_model', 'm_observer');
			$affRow = $this->m_observer->activate_observer($this->uri->segment(3));
			if ($affRow) {
				$this->session->set_flashdata('success', 'Ubah status Aktif Pengawas berhasil');
				redirect(base_url('admin/observers'));
			}
		}
		$this->session->set_flashdata('failed', 'Ubah status Aktif Pengawas gagal');
		redirect(base_url('admin/observers'));
	}

	// examgrouptypes
	public function examgrouptypes() {
		$this->load->model('exam_model', 'm_exam');
		$this->load->model('examgrouptypes_model', 'm_examgrouptype');
		if (null !== $this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$affRow = $this->m_examgrouptype->del_examgrouptype($this->uri->segment(3));
			if ($affRow) {
				$this->session->set_flashdata('success', 'Hapus data kelompok ujian berhasil');
			} else {
				$this->session->set_flashdata('failed', 'Hapus data kelompok ujian gagal');
			}
			redirect('/admin/examgrouptypes');
		}
		$dataheader = $this->m_exam->get_examtitle();
		$dataheader['data_table'] = true;
		$data['examgrouptype'] = $this->m_examgrouptype->get_examgrouptypes();
		$datafooter['examgrouptype_table'] = true;
		// $datafooter['subjects'] = $data['subjects'];
		$this->load->view('templates/header',$dataheader);
		$this->load->view('admin/examgrouptypes',$data);
		$this->load->view('templates/footer',$datafooter);
	}

	public function examgrouptype_save() {
		if ($this->input->post('examgroup')) {
			$this->form_validation->set_rules('examgroup', 'Kelompok Ujian', 'is_unique[examgrouptypes.name]',
	        	['is_unique' => '%s sudah ada.',]
			);
			if (!$this->form_validation->run()) {
				$this->session->set_flashdata('failed', 'Tambah data kelompok ujian gagal, data sudah ada di database');
				redirect('/admin/examgrouptypes');
			}
			$this->load->model('examgrouptypes_model', 'm_examgrouptype');
			$examgroup = $this->input->post('examgroup');
			$affRow = $this->m_examgrouptype->add_examgrouptype($this->input->post('examgroup'));
			if ($affRow) {
				$this->session->set_flashdata('success', 'Tambah data kelompok ujian '.$examgroup.' berhasil');
				redirect('/admin/examgrouptypes');
			}
		}
		$this->session->set_flashdata('failed', 'Tambah data kelompok ujian gagal');
		redirect('/admin/examgrouptypes');
	}

	public function examgrouptype_update() {
		if ($this->input->post('examgroup') && $this->input->post('id')) {
			$this->form_validation->set_rules('examgroup', 'Kelompok Ujian', 'is_unique[examgrouptypes.name]',
	        	['is_unique' => '%s sudah ada.',]
			);
			if (!$this->form_validation->run()) {
				$this->session->set_flashdata('failed', 'Update kelompok ujian gagal, data sudah tersimpan di database');
				redirect('/admin/examgrouptypes');
			}
			$this->load->model('examgrouptypes_model', 'm_examgrouptype');
			$examgroup = $this->input->post('examgroup');
			$affRow = $this->m_examgrouptype->update_examgrouptype($this->input->post('id'),$examgroup);
			if ($affRow) {
				$this->session->set_flashdata('success', 'Update kelompok ujian '.$examgroup.' berhasil');
				redirect('/admin/examgrouptypes');
			}
		}
		$this->session->set_flashdata('failed', 'Update data kelompok ujian gagal');
		redirect('/admin/examgrouptypes');
	}

	public function examgrouptype_active() {
		if (null !== $this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$this->load->model('examgrouptypes_model', 'm_examgrouptype');
			$affRow = $this->m_examgrouptype->activate_examgrouptype($this->uri->segment(3));
			if ($affRow) {
				$this->session->set_flashdata('success', 'Pengaktifan kelompok ujian berhasil');
				redirect('/admin/examgrouptypes');
			}
		}
		$this->session->set_flashdata('failed', 'Pengaktifan kelompok ujian gagal');
		redirect('/admin/examgrouptypes');
	}

	// questiongroup
	public function questiongroups() {
		$this->load->model('exam_model', 'm_exam');
		$this->load->model('questiongroup_model', 'm_questiongroup');
		$this->load->model('subject_model', 'm_subject');
		$arr = $this->uri->uri_to_assoc(1);
		$dataheader = $this->m_exam->get_examtitle();
		$dataheader['data_table'] = true;
		// $data['examgrouptype'] = $this->m_examgrouptype->get_examgrouptypes();
		// $datafooter['examgrouptype_table'] = true;
		$this->load->view('templates/header',$dataheader);
		// if (isset($arr['delete']) && is_numeric($arr['delete'])) {
		// 	$query = $this->db->get_where('questions', array('id' => $arr['del']), 1)->row();
		// 	// print_r($query); exit();
		// 	$group = $this->db->get_where('questiongroups', ['id' => $query->questiongroupid])->row();
		// 	$this->db->delete('questions', array('id' => $arr['del']));
		// 	$this->db->set('tot_question', $group->tot_question-1);
		// 	$this->db->where('id', $group->id);
		// 	$this->db->update('questiongroups');
		// }
		// if (isset($arr['show']) && is_numeric($arr['show'])) {
		// 	$kondisi = ['questiongroupid' => $arr['show']];
		// 	$data['questions'] = $this->db->get_where('questions', $kondisi)->result();
		// 	$this->load->view('admin/showquestions', $data);
		// } else {
		// 	$data['subjects'] = $this->m_subject->get_subjects();
		// 	$data['group'] = $this->m_questiongroup->get_questiongroups();
		// 	$this->load->view('admin/questiongroups', $data);
		// }
		$data['subjects'] = $this->m_subject->get_subjects();
		$data['examgrouptype'] = $this->m_questiongroup->egt();
		$data['group'] = $this->m_questiongroup->get_questiongroups($data['examgrouptype']['id']);
		$this->load->view('admin/questiongroups', $data);

		$this->load->view('templates/footer');
	}

	public function questiongroup_delete($id) {
		if (null !== $this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$this->load->model('questiongroup_model', 'm_questiongroup');
			$affRow = $this->m_questiongroup->del_questiongroup($this->uri->segment(3));
			if ($affRow) {
				$this->session->set_flashdata('success', 'Kelompok soal berhasil dihapus');
				redirect('/admin/questiongroups');
			}
		}
		$this->session->set_flashdata('failed', 'Kelompok soal gagal dihapus');
		redirect('/admin/questiongroups');
	}
	public function questiongroup_save() {
		$dataInput = $_POST;
		$this->load->model('questiongroup_model', 'm_questiongroup');
		$egt = $this->m_questiongroup->egt();
		$data = array(
	        'level' => $_POST['level'],
	        'group' => json_encode($_POST['add_group']),
	        'kode' => $_POST['code'],
	        'examgrouptype_id' => $egt['id'],
	        'subject_id' => $_POST['subject'],
		);
		$this->db->insert('questiongroups', $data);
		redirect(base_url('admin/questiongroups'));
	}

	// questions
	public function questions() {
		if (null !== $this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$this->load->model('questiongroup_model', 'm_questiongroup');
			$data['questiongroup'] = $this->m_questiongroup->get_questiongroup($this->uri->segment(3));
			if (!$data['questiongroup']) {
				redirect(base_url('admin/questiongroups'));
			}
			$this->load->model('question_model', 'm_question');
			if (null !== $this->uri->segment(4) && is_numeric($this->uri->segment(4))) {
				$res = $this->m_question->del_question($this->uri->segment(4),$this->uri->segment(3));
				if (!$res) {
					$this->session->set_flashdata('failed', 'Hapus soal gagal');
				} else {
					$this->session->set_flashdata('success', 'Hapus soal berhasil');
				}
				redirect(base_url('admin/questions/'.$this->uri->segment(3)));
			}
			
			$data['questions'] = $this->m_question->get_questions($this->uri->segment(3));

			$this->load->model('exam_model', 'm_exam');
			$dataheader = $this->m_exam->get_examtitle();
			$this->load->view('templates/header', $dataheader);
			$this->load->view('admin/showquestions', $data);
			$this->load->view('templates/footer');
		} else {
			redirect(base_url('admin/questiongroups'));
		}
	}

	public function question_save() {
		// print_r($_POST);
		$dataInput = $_POST;
		$dataInput['timestamp'] = date('Y-m-d H:m:s');
		$pieces = explode("\n", $dataInput['options']);
		
		$dataInput['ans_a'] = ($pieces[0] && $pieces[0] != '') ? $pieces[0] : null;
		$dataInput['ans_b'] = (isset($pieces[1]) && $pieces[1] != '') ? $pieces[1] : null;
		$dataInput['ans_c'] = (isset($pieces[2]) && $pieces[2] != '') ? $pieces[2] : null;
		$dataInput['ans_d'] = (isset($pieces[3]) && $pieces[3] != '') ? $pieces[3] : null;
		$dataInput['ans_e'] = (isset($pieces[4]) && $pieces[4] != '') ? $pieces[4] : null;
		
		unset($dataInput['options']);

		$config['upload_path'] = './assets/gambar/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|svg';
		$config['max_size'] = 100000;
		$config['overwrite'] = FALSE;

		$this->load->library('upload', $config);
		if ($this->upload->do_upload('img_q1')) {
			$dataInput['img_q1'] = $this->upload->file_name;
		} else {$dataInput['img_q1'] = null;}
		if ($this->upload->do_upload('img_ans_a')) {
			$dataInput['img_ans_a'] = $this->upload->file_name;
		} else {$dataInput['img_ans_a'] = null;}
		if ($this->upload->do_upload('img_ans_b')) {
			$dataInput['img_ans_b'] = $this->upload->file_name;
		} else {$dataInput['img_ans_b'] = null;}
		if ($this->upload->do_upload('img_ans_c')) {
			$dataInput['img_ans_c'] = $this->upload->file_name;
		} else {$dataInput['img_ans_c'] = null;}
		if ($this->upload->do_upload('img_ans_d')) {
			$dataInput['img_ans_d'] = $this->upload->file_name;
		} else {$dataInput['img_ans_d'] = null;}
		if ($this->upload->do_upload('img_ans_e')) {
			$dataInput['img_ans_e'] = $this->upload->file_name;
		} else {$dataInput['img_ans_e'] = null;}
		// echo "<pre>"; print_r($dataInput); echo "</pre>"; exit();
		$this->db->insert('questions', $dataInput);
		$query = $this->db->query("UPDATE questiongroups SET tot_question=(SELECT count(*) FROM questions WHERE questions.questiongroup_id=".$dataInput['questiongroup_id'].") WHERE id=".$dataInput['questiongroup_id']);
		redirect(base_url('admin/questions/'.$dataInput['questiongroup_id']));
	}

	// exams
	public function exams() {
		$this->load->model('exam_model', 'm_exam');
		$this->load->model('questiongroup_model', 'm_questiongroup');
		$data['examgrouptype'] = $this->m_questiongroup->egt();
		$dataheader = $this->m_exam->get_examtitle();
		$data['exam'] = $this->m_exam->get_exams();
		$data['questiongroup'] = $this->m_questiongroup->get_questiongroups();
		// echo "<pre>"; print_r($data); echo "</pre>"; exit();
		$dataheader['data_table'] = true;
		$this->load->view('templates/header', $dataheader);
		$this->load->view('admin/exams',$data);
		
		$datafooter['exam_table'] = true;
		// $datafooter['subjects'] = $data['subjects'];
		$this->load->view('templates/footer',$datafooter);
	}

	public function exam_save() {
		// Array ( [exam_question] => 12 [date_time] => 2022-10-23 12:17 [duration] => 90 [active] => 0 [show] => 0 )
		if ($this->input->post('exam_question') !== null 
			&& $this->input->post('date_time') !== null
			&& $this->input->post('duration') !== null
			&& $this->input->post('active') !== null
			&& $this->input->post('show') !== null ) {
			$this->load->model('exam_model', 'm_exam');
			$data = [
				'questiongroup_id' => $this->input->post('exam_question'),
				'startdatetime' => $this->input->post('date_time'),
				'duration' => $this->input->post('duration'),
				'active' => $this->input->post('active'),
				'show' => $this->input->post('show')
			];
			$affRow = $this->m_exam->add_exam($data);
			if ($affRow) {
				$this->session->set_flashdata('success', 'Tambah data Ujian berhasil');
				redirect(base_url('admin/exams/'));
			}
		}
		$this->session->set_flashdata('failed', 'Tambah data Ujian gagal');
		redirect(base_url('admin/exams/'));
	}
	public function exam_delete() {
		if (null !== $this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$this->load->model('exam_model', 'm_exam');
			$affRow = $this->m_exam->del_exam($this->uri->segment(3));
			if ($affRow) {
				$this->session->set_flashdata('success', 'Hapus data Ujian berhasil');
				redirect(base_url('admin/exams'));
			}
		}
		$this->session->set_flashdata('failed', 'Hapus data Ujian gagal');
		redirect(base_url('admin/exams'));
	}
	public function change_act_exam() {
		if (null !== $this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$this->load->model('exam_model', 'm_exam');
			$affRow = $this->m_exam->act_exam($this->uri->segment(3),'active');
			if ($affRow) {
				$this->session->set_flashdata('success', 'Ubah status Aktif Ujian berhasil');
				redirect(base_url('admin/exams'));
			}
		}
		$this->session->set_flashdata('failed', 'Ubah status Aktif Ujian gagal');
		redirect(base_url('admin/exams'));
	}

	public function change_act_view() {
		if (null !== $this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$this->load->model('exam_model', 'm_exam');
			$affRow = $this->m_exam->act_exam($this->uri->segment(3),'show');
			if ($affRow) {
				$this->session->set_flashdata('success', 'Ubah status tampil Ujian berhasil');
				redirect(base_url('admin/exams'));
			}
		}
		$this->session->set_flashdata('failed', 'Ubah status tampil Ujian gagal');
		redirect(base_url('admin/exams'));
	}

}
