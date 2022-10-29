<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exam_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		// $this->load->database();
	}

	public function get_examtitle() {
		$data['app_name'] = "PAS Gasal";
		$data['app_year'] = "2022/2023";
		return $data;
	}

	public function get_exam_activegrouptypes() {
		$this->db->select("exams.id,DATE_FORMAT(exams.startdatetime,'%d-%m-%Y | (%H:%m)') exam_date,subjects.name subject_exam, questiongroups.level , questiongroups.group");
		$this->db->join('questiongroups', 'exams.questiongroup_id = questiongroups.id', 'left');
		$this->db->join('subjects', 'questiongroups.subject_id = subjects.id', 'left');
		$this->db->join('examgrouptypes', 'examgrouptypes.id = questiongroups.examgrouptype_id', 'left');
		$this->db->where('examgrouptypes.status', 1);
		$this->db->order_by('exams.startdatetime', 'ASC');
		$this->db->order_by('subjects.name', 'ASC');
        	$query = $this->db->get('exams');
		return $query->result_array();
	}

	public function get_exam_scores($idexam) {
		$this->db->select("examstudents.id,users.username,users.name,classes.`level`,classes.`group`,classes.classorder,examstudents.temp_score,examstudents.score, ROW_NUMBER() OVER(ORDER BY users.username) no");
		$this->db->join('exams', 'exams.id=examstudents.exam_id', 'left');
		$this->db->join('users', 'users.id=examstudents.user_id', 'left');
		$this->db->join('classes', 'classes.id=users.class_id', 'left');
		$this->db->join('rooms', 'rooms.id=users.room', 'left');
		$this->db->where('exams.id', $idexam);
		$this->db->order_by('users.username', 'ASC');
        	$query = $this->db->get('examstudents');
		return $query->result_array();
	}

	public function get_exams() {
		$this->db->select("exams.id,questiongroups.level,questiongroups.group,exams.active,exams.show,date_format(exams.startdatetime,'%d %M %Y') date,exams.duration,time_format(exams.startdatetime,'%H:%i') starttime,subjects.name,questiongroups.kode,questiongroups.tot_question");
		$this->db->join('questiongroups', 'exams.questiongroup_id = questiongroups.id', 'left');
		$this->db->join('subjects', 'questiongroups.subject_id = subjects.id', 'left');
		$this->db->order_by('exams.startdatetime', 'ASC');
        	$query = $this->db->get('exams');
		return $query->result_array();
	}

	public function get_examavailable_students($studentid) {
		$this->db->select('users.*, classes.level, classes.group, classes.classorder');
		$this->db->join('classes', 'classes.id = users.class_id', 'left');
		$studentdata =  $this->db->get_where('users', ['users.id'=>$studentid])->row_array(); 

		$query = $this->db->query("SELECT exams.id,questiongroups.level,questiongroups.group,exams.active,exams.show,date_format(exams.startdatetime,'%d %M %Y') date,exams.duration,time_format(exams.startdatetime,'%H:%i') starttime,time_format(DATE_ADD(exams.startdatetime, INTERVAL exams.duration MINUTE),'%H:%i') endtime,subjects.name,questiongroups.kode,questiongroups.tot_question
			FROM exams
			LEFT JOIN questiongroups ON exams.questiongroup_id = questiongroups.id
			LEFT JOIN subjects ON questiongroups.subject_id = subjects.id
			WHERE questiongroups.group LIKE'%".$studentdata['group']."%' AND questiongroups.level='".$studentdata['level']."' AND exams.show=1 AND exams.id NOT IN (SELECT exam_id FROM examstudents WHERE user_id=".$studentid.") ORDER BY exams.startdatetime");
		return $query->result();
	}

	public function validate_examavailable_students($studentid,$examid) {
		$this->db->select('users.*, classes.level, classes.group, classes.classorder');
		$this->db->join('classes', 'classes.id = users.class_id', 'left');
		$studentdata =  $this->db->get_where('users', ['users.id'=>$studentid])->row_array(); 

		$query = $this->db->query("SELECT exams.id,questiongroups.level,questiongroups.group,exams.active,exams.show,date_format(exams.startdatetime,'%d-%m-%Y') date,exams.startdatetime datetime,exams.duration,time_format(exams.startdatetime,'%H:%i') starttime,subjects.name,questiongroups.kode,questiongroups.tot_question
			FROM exams
			LEFT JOIN questiongroups ON exams.questiongroup_id = questiongroups.id
			LEFT JOIN subjects ON questiongroups.subject_id = subjects.id
			WHERE exams.startdatetime<now() AND exams.id='".$examid."' AND questiongroups.group LIKE'%".$studentdata['group']."%' AND questiongroups.level='".$studentdata['level']."' AND exams.show=1 AND exams.active=1 AND exams.id NOT IN (SELECT exam_id FROM examstudents WHERE user_id=".$studentid.") ORDER BY exams.startdatetime");
		return $query->row_array();
	}

	public function add_exam($data) {
		$this->db->insert('exams', $data);
		return $this->db->affected_rows();
	}

	public function del_exam($id) {
		$this->db->where('exam_id', $id);
		$query = $this->db->get('examstudents')->result_array();
		if ($query) {
			return 0;
		}
		$this->db->where('id', $id);
		$this->db->delete('exams');
		return $this->db->affected_rows();
	}

	public function act_exam($id,$key) {
		$this->db->where('id', $id);
		$res = $this->db->get('exams')->row_array();
		$newval = 1;
		if ($res && $res[$key] == 1) {
			$newval = 0;
		}
		$this->db->set($key, $newval);
		$this->db->where('id', $id);
		$this->db->update('exams');
		return $this->db->affected_rows();
	}

	public function generate_exam($examid,$studentid=null) {
		$studentid = ($studentid==null) ? $this->session->userdata('id') : $studentid;
		// Exam
		// $this->db->where('id', $examid);
		$exam = $this->db->get_where('exams',['id' => $examid])->row_array();
		// Questions
		$this->db->select("id,ans_a,ans_b,ans_c,ans_d,ans_e,img_ans_a,img_ans_b,img_ans_c,img_ans_d,img_ans_e,q_type,ans,score,random,random_qt");
		$this->db->where('questiongroup_id', $exam['questiongroup_id']);
		$questions = $this->db->get('questions')->result_array();
		$questions = $this->random_answer($questions);
		$questions = $this->random_question($questions);
		$questions = $this->reformat_question($questions);
		// insert examstudents
		$starttime = date_create('now')->format('Y-m-d H:i:s');
		$data = array(
	        'user_id' => $studentid,
	        'exam_id' => $examid,
	        'starttime' =>  $starttime,
	        'endtime' => date('Y-m-d H:i:s', strtotime("+".$exam['duration']." minutes",strtotime($starttime))),
	        'duration' => $exam['duration'],
	        'student_question' => json_encode($questions)
		);
		$this->db->insert('examstudents', $data);
		$this->db->set('onexam', 1);
		$this->db->where('id', $studentid);
		$this->db->update('users');
		return true;
	}

	public function get_examrunningdata($studentid=null) {
		$studentid = ($studentid==null) ? $this->session->userdata('id') : $studentid;
		$exam = $this->exrundata();
		$data = [];
		if ($exam) {
			$decr = json_decode($exam['student_question'],true);
			$data['numbers'] = $this->mod_numbers($decr);
			$data['answered'] = $this->count_answered($decr);
			$data['number'] = $exam['e_number'];
			$data['endtime'] = $exam['endtime'];
			$endtime = strtotime($data['endtime']);
			$timenow = strtotime(date_create('now')->format('Y-m-d H:i:s'));
			// $data['et'] = $endtime;
			// $data['now'] = $timenow;
			$data['countdown_sec'] = $endtime-$timenow >= 0 ? $endtime-$timenow : 0;
			// $data['q'] = json_decode($exam['student_question'],true);
			$data['question_raw'] = $decr[$exam['e_number']-1];
			$data['std_ans'] = $decr[$exam['e_number']-1]['std_ans'];
			$data['question_raw']['rand_obj2'] = str_split($data['question_raw']['rand_obj']);
			$data['q_data_raw'] = $this->questiondata($data['question_raw']['id']);
			$data['question'] = array(
				'img_q1' => $data['q_data_raw']['img_q1'],
				'audio_q1' => $data['q_data_raw']['audio_q1'],
				'question' => $data['q_data_raw']['question']
			);
			$data['answer'] = [];
			foreach ($data['question_raw']['rand_obj2'] as $key => $val) {
				$spl = str_split('abcde');
				$data['answer']['ans_'.$spl[$key]] = $data['q_data_raw']['ans_'.$val];
				$data['answer']['img_ans_'.$spl[$key]] = $data['q_data_raw']['img_ans_'.$val];
			}
			$data['doubt'] = $data['question_raw']['doubt'];
			unset($data['q_data_raw']);
			unset($data['question_raw']);
			return $data;
		}
		return $exam;
	}

	public function change_number($number=1,$studentid=null) {
		$studentid = ($studentid==null) ? $this->session->userdata('id') : $studentid;
		$exam = $this->exrundata();
		$number = $number < 1 ? 1 : $number;
		$number = $number > $exam['tot_question'] ? $exam['tot_question'] : $number;
		$this->db->set('e_number', $number);
		$this->db->where('id', $exam['id']);
		$this->db->update('examstudents');
		return $number;
	}

	public function change_doubt($studentid=null) {
		$studentid = ($studentid==null) ? $this->session->userdata('id') : $studentid;
		$exam = $this->exrundata();
		if ($exam) {
			$number = $exam['e_number'];
			$decr = json_decode($exam['student_question'],true);
			if ($decr[$number-1]['order'] == $number) {
				$decr[$number-1]['doubt'] = ($decr[$number-1]['doubt']==true) ? false : true ;
			}
			$this->db->set('student_question', json_encode($decr));
			$this->db->where('id', $exam['id']);
			$this->db->update('examstudents');
		}
		return 1;
	}

	public function change_answer($answer,$studentid=null) {
		$studentid = ($studentid==null) ? $this->session->userdata('id') : $studentid;
		$exam = $this->exrundata();
		if ($exam) {
			$number = $exam['e_number'];
			$decr = json_decode($exam['student_question'],true);
			if ($decr[$number-1]['order'] == $number) {
				$decr[$number-1]['std_ans'] = $answer;
			}
			$decr = $this->auto_checkanswer($number,$decr);
			$this->db->set('temp_score', $this->auto_calculatescore($decr));
			$this->db->set('student_question', json_encode($decr));
			$this->db->where('id', $exam['id']);
			$this->db->update('examstudents');
		}
	}

	public function calculate_score($studentid=null) {
		$studentid = ($studentid==null) ? $this->session->userdata('id') : $studentid;
		$exam = $this->exrundata();
		$student_question = $exam['student_question'];
		$questiongroup_id = $exam['questiongroup_id'];
		$tot_question = $exam['tot_question'];
		$data_question_final = $this->mask_last_questiondata($questiongroup_id,$student_question);
		$timenow = date_create('now')->format('Y-m-d H:i:s');
		$this->db->set('submit_time', $timenow);
		$this->db->set('score', $data_question_final['fScore']);
		$this->db->set('calc_question_score', json_encode($data_question_final['data']));
		$this->db->where('id', $exam['id']);
		$this->db->update('examstudents');

		$this->db->set('onexam', 0);
		$this->db->where('id', $studentid);
		$this->db->update('users');

		return $data_question_final['fScore'];

	}

	private function mask_last_questiondata($questiongroupid,$student_question) {
		$decr = json_decode($student_question,true);
		$this->db->select("id,ans,score,random");
		$this->db->where('questiongroup_id', $questiongroupid);
		$questions =  $this->db->get('questions',count($decr))->result_array();
		$newdata = [];
		foreach ($questions as $k => $val) {
			$newdata[$val['id']] = $val;
			$newdata[$val['id']]['number'] = $k+1;
		}
		foreach ($decr as $k => $val) {
			$newdata[$val['id']]['std_ans'] = $val['std_ans'];
			$newdata[$val['id']]['rand_obj'] = $val['rand_obj'];
			$newdata[$val['id']]['point_old'] = $val['point'];
		}
		// scoring
		$tot_score = 0;
		$tot_point = 0;
		$objective = 'abcde';
		$splitObj = str_split($objective);
		foreach ($newdata as $ky => $val) {
			$splitRandObj = str_split($val['rand_obj']);
			foreach ($splitRandObj as $k => $v) {
				if ($val['std_ans']==$splitObj[$k]) {
					if ($splitRandObj[$k] == strtolower($val['ans'])) {
						$newdata[$ky]['point'] = $val['score'];
						$tot_point+=$val['score'];
					} else {
						$newdata[$ky]['point'] = 0;
					}
					$newdata[$ky]['r_std_ans'] = $v;
					break;
				}
			}
			$tot_score+=$val['score'];
		}
		// return ($tot_point*100)/$tot_score;
		return ['data' => $newdata, 'fScore' => ($tot_point*100)/$tot_score];
	}

	private function auto_calculatescore($decr) {
		$tot_point = 0;
		$tot_score = 0;
		foreach ($decr as $k => $v) {
			$tot_point += $v['point'];
			$tot_score += $v['score'];
		}
		return ($tot_point*100)/$tot_score;
	}

	private function auto_checkanswer($number,$decr) {
		if ($decr[$number-1]['order'] == $number) {
			$id_question = $decr[$number-1]['id'];

			$this->db->where('id', $id_question);
			$res = $this->db->get('questions')->row_array();
			$score = $res['score'];
			$key = $res['ans'];

			$answer = $decr[$number-1]['std_ans'];
			// $score = $decr[$number-1]['score'];
			// $key = $decr[$number-1]['ans'];
			$rand_obj = $decr[$number-1]['rand_obj'];
			$objective = 'abcde';
			$splitRandObj = str_split($rand_obj);
			$splitObj = str_split($objective);
			foreach ($splitRandObj as $k => $v) {
				if ($answer==$splitObj[$k]) {
					if ($splitRandObj[$k] == strtolower($key)) {
						$decr[$number-1]['point'] = $score;
					} else {
						$decr[$number-1]['point'] = 0;
					}
					break;
				}
			}
		}
		return $decr;
	}

	private function count_answered($numbers) {
		$ans = 0;
		foreach ($numbers as $k => $v) {
			if ($v['std_ans'] !== null) {
				$ans++;
			}
		}
		return $ans;
	}

	private function mod_numbers($numbers) {
		// remove ans, rand_obj, id
		$res = [];
		foreach ($numbers as $k => $v) {
			$res[$k]['order'] = $v['order'];
			$res[$k]['std_ans'] = $v['std_ans'];
			$res[$k]['score'] = $v['score'];
			$res[$k]['doubt'] = $v['doubt'];
		}
		return $res;
	}

	public function checktime_exrundata($studentid=null) {
		$studentid = ($studentid==null) ? $this->session->userdata('id') : $studentid;
		$this->db->where('examstudents.score', null);
		$this->db->where('examstudents.user_id', $studentid);
		$res = $this->db->get('examstudents',1)->row_array();
		if ($res) {
			$endtime = $res['endtime'];
			$endtime = strtotime($endtime);
			$timenow = strtotime(date_create('now')->format('Y-m-d H:i:s'));
			return $endtime-$timenow >= 0 ? $endtime-$timenow : 0;
		}
		return 0;
	}

	private function exrundata($studentid=null) {
		$studentid = ($studentid==null) ? $this->session->userdata('id') : $studentid;
		$this->db->select("examstudents.*,exams.questiongroup_id,subjects.name subject,questiongroups.kode,questiongroups.level,questiongroups.group,questiongroups.tot_question");
		$this->db->where('examstudents.score', null);
		$this->db->where('examstudents.user_id', $studentid);
		$this->db->join('exams', 'exams.id = examstudents.exam_id', 'left');
		$this->db->join('questiongroups', 'questiongroups.id = exams.questiongroup_id', 'left');
		$this->db->join('subjects', 'subjects.id = questiongroups.subject_id', 'left');
		return $this->db->get('examstudents')->row_array();
	}

	private function questiondata($id) {
		$this->db->select("img_q1,audio_q1,question,ans_a,ans_b,ans_c,ans_d,ans_e,img_ans_a,img_ans_b,img_ans_c,img_ans_d,img_ans_e,ans,score");
		$this->db->where('id', $id);
		return $this->db->get('questions')->row_array();
	}

	// Acak Pilihan
	private function random_answer($questions) {
		foreach ($questions as $k_q => $val_q) {
			$questions[$k_q]['random_objective'] = $this->createRandomObjective($val_q);
		}
		return $questions;
	}
	private function createRandomObjective($question) {
        if ((is_null($question['ans_e']) || $question['ans_e']=='') && (is_null($question['img_ans_e']) || $question['img_ans_e'] == '')) {
                $rand = 'abcd';
        } else {
                $rand = 'abcde';  
        }
                if ($question['random'] == 'N') {
                return $rand;
        }
        return str_shuffle($rand);
    }

    // Acak Urutan Soal
    private function random_question($questions) {
    	$arrayFix = [];
    	$arrayRand = [];
    	foreach ($questions as $k_q => $val_q) {
    		if ($val_q['random_qt'] == 'Y') {
    			array_push($arrayRand,$k_q);
    		} else {
    			$arrayFix[$k_q] =  $val_q;
    			$arrayFix[$k_q]['order'] = $k_q+1;
    		}
    	}
    	shuffle($arrayRand);
    	$k_order = 0;
    	foreach ($questions as $k_q => $val_q) {
    		if (!isset($arrayFix[$k_q])) {
    			$arrayFix[$k_q] = $questions[$arrayRand[$k_order]];
    			$arrayFix[$k_q]['order'] = $k_q+1;
    			$k_order++;
    		}
    	}
    	return $arrayFix;
    }
    private function reformat_question($questions) {
    	$ret = [];
    	foreach ($questions as $k_q => $val_q) {
    		$ret[$k_q]['order'] = $val_q['order'];
    		$ret[$k_q]['id'] = $val_q['id'];
    		$ret[$k_q]['ans'] = $val_q['ans'];
    		$ret[$k_q]['std_ans'] = null;
    		$ret[$k_q]['doubt'] = false;
    		$ret[$k_q]['score'] = $val_q['score'];
    		$ret[$k_q]['point'] = 0;
    		$ret[$k_q]['rand_obj'] = $val_q['random_objective'];
    	}
    	return $ret;
    }
}