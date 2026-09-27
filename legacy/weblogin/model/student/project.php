<?php
class ModelStudentProject extends Model {
	public $columns = array('s.id', 's1.student_no', 's1.student_name', 's.project_type', '', 's.status', 's.point_given', 'u.firstname', 's.added_date', 's.verified_at');
	
	public function delete($id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "student_project_zoon` WHERE id = '" . (int)$id . "'");
	}
	
	public function get($id) {
		$query = $this->db->query("SELECT s.*, s1.student_name, s1.student_no, u.firstname, u.lastname, u.email, ue.user_no FROM `" . DB_PREFIX . "student_project_zoon` s INNER JOIN " . DB_PREFIX . "student s1 ON s.student_id = s1.id LEFT JOIN " . DB_PREFIX . "user u ON u.user_id = s.verified_by LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id WHERE s.id = '" . (int)$id . "'");

		return $query->row;
	}
	
	public function getItems($data = array()) {
		//print_r($data);
		$query = $this->db->query("SELECT id FROM " . DB_PREFIX . "student_project_zoon");
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT s.*, s1.student_name, s1.student_no, u.firstname, u.lastname, u.email, ue.user_no FROM `" . DB_PREFIX . "student_project_zoon` s INNER JOIN " . DB_PREFIX . "student s1 ON s.student_id = s1.id LEFT JOIN " . DB_PREFIX . "user u ON u.user_id = s.verified_by LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id WHERE 1=1";
		
		/* if (isset($data['filter_search']) && !is_null($data['filter_search'])) {
			$sql .= " AND (s.student_name LIKE '%" . $data['filter_search'] . "%' OR s.student_no LIKE '%" . $data['filter_search'] . "%' OR s.student_phone LIKE '" . $data['filter_search'] . "' OR s.student_email LIKE '" . $data['filter_search'] . "' OR s.student_gender LIKE '" . $data['filter_search'] . "' OR u.firstname LIKE '" . $data['filter_search'] . "' OR s1.student_name LIKE '" . $data['filter_search'] . "' OR s1.student_no LIKE '" . $data['filter_search'] . "' OR DATE(s.activated_at) = '" . $data['filter_search'] . "' OR DATE(s.created_at) = '" . $data['filter_search'] . "')";
		} */
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND s1.student_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_email'])) {
			$sql .= " AND s1.student_email LIKE '%" . $this->db->escape($data['filter_email']) . "%'";
		}
		
		if (!empty($data['filter_phone'])) {
			$sql .= " AND s1.student_phone LIKE '%" . $this->db->escape($data['filter_phone']) . "%'";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND s.status = '" . $data['filter_status'] . "'";
		}
		
		if (isset($data['filter_project_type']) && !is_null($data['filter_project_type'])) {
			$sql .= " AND s.project_type = '" . $data['filter_project_type'] . "'";
		}
		
		if (isset($data['filter_student_no']) && !is_null($data['filter_student_no'])) {
			$sql .= " AND s1.student_no = '" . $data['filter_student_no'] . "'";
		}
		
		if (!empty($data['filter_verified_start_date'])) {
			$sql .= " AND DATE(s.verified_at) >= '" . $this->db->escape($data['filter_verified_start_date']) . "'";
		}

		if (!empty($data['filter_verified_end_date'])) {
			$sql .= " AND DATE(s.verified_at) <= '" . $this->db->escape($data['filter_verified_end_date']) . "'";
		}
		
		$sql .= " GROUP BY s.id";
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->columns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY s.id DESC";
		}
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