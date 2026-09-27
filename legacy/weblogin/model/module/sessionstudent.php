<?php
class ModelModuleSessionstudent extends Model {
	public $columns = array('scs.id','s.student_name','s.student_no', 'u.firstname', 'c.course_name','s.session_no', '', 'scs.point_status', 'scs.point', 'scs.date_added');
	
	public function getItems($data = array()) {
		//print_r($data);
		$query = $this->db->query("SELECT id FROM " . DB_PREFIX . "student_to_course_session");
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT scs.*, s.student_name, s.student_no, cs.session_no, cs.session_point, c.course_name, u.username, CONCAT(u.firstname, ' ', u.lastname) as fullname FROM " . DB_PREFIX . "student_to_course_session scs INNER JOIN " . DB_PREFIX . "student s ON scs.student_id = s.id INNER JOIN " . DB_PREFIX . "course_to_session cs ON cs.session_id = scs.session_id INNER JOIN " . DB_PREFIX . "course c ON cs.course_id = c.course_id LEFT JOIN " . DB_PREFIX . "user u ON cs.session_created_by = u.user_id  WHERE 1=1";
		if (isset($data['filter_student']) && !is_null($data['filter_student'])) {
			$sql .= " AND s.student_no LIKE '%" . $data['filter_student'] . "%'";
		}
		
		if (isset($data['filter_course']) && !is_null($data['filter_course'])) {
			$sql .= " AND cs.course_id = '" . $data['filter_course'] . "'";
		}
		
		if (isset($data['filter_session_no']) && !is_null($data['filter_session_no'])) {
			$sql .= " AND cs.session_no = '" . $data['filter_session_no'] . "'";
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
			$sql .= " ORDER BY scs.session_id DESC";
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