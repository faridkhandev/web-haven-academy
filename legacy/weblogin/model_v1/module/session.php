<?php
class ModelModuleSession extends Model {
	public $columns = array('s.session_id','c.course_name','s.session_no','s.session_date', 'u.firstname', 's.session_created_at');
	public $scolumns = array('scs.id','s.student_name','s.student_no','', 'scs.point', 'scs.date_added');

	public function add($data) {
		$this->load->model('module/course');
		$course_info = $this->model_module_course->get($data['course_id']);
		$session_point = $course_info['per_session_point'];
		
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "course_to_session SET course_id = '" . (int)$data['course_id'] . "', session_date = '" . $this->db->escape($data['session_date']) . "', session_time = '" . $this->db->escape($data['session_time']) . "', session_teacher_id = '" . $this->db->escape($data['session_teacher_id']) . "', session_point = '" . $this->db->escape($session_point) . "', session_no = '" . $this->db->escape($data['session_no']) . "', meeting_link = '" . $this->db->escape($data['meeting_link']) . "', session_created_at = '".date('Y-m-d H:i:s')."', session_updated_at = '".date('Y-m-d H:i:s')."', session_created_by='".$this->user->getId()."', session_updated_by='".$this->user->getId()."'");
		
		$session_id = $this->db->getLastId();
		return $session_id;
	}

	public function edit($course_id,$data) {
		$this->load->model('module/course');
		$course_info = $this->model_module_course->get($data['course_id']);
		$session_point = $course_info['per_session_point'];
		
		$this->db->query("UPDATE " . DB_PREFIX . "course_to_session SET course_id = '" . (int)$data['course_id'] . "', session_date = '" . $this->db->escape($data['session_date']) . "', session_time = '" . $this->db->escape($data['session_time']) . "', session_teacher_id = '" . $this->db->escape($data['session_teacher_id']) . "', session_point = '" . $this->db->escape($session_point) . "', session_no = '" . $this->db->escape($data['session_no']) . "', meeting_link = '" . $this->db->escape($data['meeting_link']) . "', session_updated_at = '".date('Y-m-d H:i:s')."', session_updated_by='".$this->user->getId()."' WHERE session_id = '" . (int)$session_id . "'");
	}

	public function delete($session_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "course_to_session SET delete_status = '1' WHERE session_id = '" . (int)$session_id . "'");
	}
	
	public function get($session_id) {
		$query = $this->db->query("SELECT cs.*, c.course_name FROM " . DB_PREFIX . "course_to_session cs INNER JOIN " . DB_PREFIX . "course c ON cs.course_id = c.course_id WHERE cs.session_id = '" . (int)$session_id . "'");

		return $query->row;
	}
	
	public function getItems($data = array()) {
		//print_r($data);
		$query = $this->db->query("SELECT session_id FROM " . DB_PREFIX . "course_to_session WHERE delete_status=0");
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT cs.*, c.course_name, u.firstname, u.lastname FROM " . DB_PREFIX . "course_to_session cs INNER JOIN " . DB_PREFIX . "course c ON cs.course_id = c.course_id INNER JOIN " . DB_PREFIX . "user u ON cs.session_teacher_id = u.user_id WHERE cs.delete_status=0";
		
		if (isset($data['filter_course']) && !is_null($data['filter_course'])) {
			$sql .= " AND cs.course_id = '" . $data['filter_course'] . "'";
		}
		
		if (isset($data['filter_teacher']) && !is_null($data['filter_teacher'])) {
			$sql .= " AND cs.session_teacher_id = '" . $data['filter_teacher'] . "'";
		}
		
		if (!empty($data['filter_start_date'])) {
			$sql .= " AND DATE(cs.session_date) >= '" . $this->db->escape($data['filter_start_date']) . "'";
		}

		if (!empty($data['filter_end_date'])) {
			$sql .= " AND DATE(cs.session_date) <= '" . $this->db->escape($data['filter_end_date']) . "'";
		}
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->columns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY session_id DESC";
		}
		//echo $sql;
		$query = $this->db->query($sql);
		$recordsFiltered = (int)$query->num_rows;
		if (isset($data['start']) || isset($data['length'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}
			if ($data['length'] < 1) {
				$data['length'] = 20;
			}
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['length'];
		}
		//echo $sql;
		$query = $this->db->query($sql);
		$result = $query->rows;
		return array('recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered, 'result' => $result);
	}
	
	public function getSessionItems($data = array()) {
		//print_r($data);
		$sql = "SELECT scs.id FROM " . DB_PREFIX . "student_to_course_session scs INNER JOIN " . DB_PREFIX . "student s ON scs.student_id = s.id INNER JOIN " . DB_PREFIX . "course_to_session cs ON cs.session_id = scs.session_id WHERE scs.session_id='".$data['filter_session_id']."'";
		
		if($this->user->getGroupId() == 14){
			$sql .= " AND cs.session_teacher_id = '".$this->user->getId()."'";
		}
		//echo $sql;
		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT scs.*, s.student_name, s.student_no FROM " . DB_PREFIX . "student_to_course_session scs INNER JOIN " . DB_PREFIX . "student s ON scs.student_id = s.id INNER JOIN " . DB_PREFIX . "course_to_session cs ON cs.session_id = scs.session_id WHERE scs.session_id='".$data['filter_session_id']."'";
		
		if (isset($data['filter_student']) && !is_null($data['filter_student'])) {
			$sql .= " AND s.student_no LIKE '%" . $data['filter_student'] . "%'";
		}
		
		if($this->user->getGroupId() == 14){
			$sql .= " AND cs.session_teacher_id = '".$this->user->getId()."'";
		}else{
			if (isset($data['filter_teacher_id']) && !is_null($data['filter_teacher_id'])) {
				$sql .= " AND cs.session_teacher_id = '" . $data['filter_teacher_id'] . "'";
			}
		}
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->scolumns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY scs.id DESC";
		}
		//echo $sql;
		$query = $this->db->query($sql);
		$recordsFiltered = (int)$query->num_rows;
		if (isset($data['start']) || isset($data['length'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}
			if ($data['length'] < 1) {
				$data['length'] = 20;
			}
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['length'];
		}
		//echo $sql;
		$query = $this->db->query($sql);
		$result = $query->rows;
		return array('recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered, 'result' => $result);
	}
}