<?php
class ModelStudentPassbook extends Model {
	public $columns = array('s.id', 's.student_no', 's.student_name', 's.student_phone', 's.student_email', 's.student_whatsapp', 's.student_gender', 's.student_city', 's.student_point', 's1.student_refer_name', 's.student_status');
	
	public function getItems($data = array()) {
		//print_r($data);
		$sql = "SELECT id FROM " . DB_PREFIX . "student WHERE student_delete_status=0 ";
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND student_status = '" . $data['filter_status'] . "'";
		}
		if (isset($data['filter_refer_id']) && !is_null($data['filter_refer_id'])) {
			$sql .= " AND refer_id = '" . $data['filter_refer_id'] . "'";
		}
		
		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT s.*, s1.student_name as refer_student_name, s1.student_no as refer_student_no FROM `" . DB_PREFIX . "student` s LEFT JOIN " . DB_PREFIX . "student s1 ON s.refer_id = s1.id";
		
		$sql .= " WHERE s.student_delete_status=0";
		
		if (isset($data['filter_search']) && !is_null($data['filter_search'])) {
			$sql .= " AND (s.student_name LIKE '%" . $data['filter_search'] . "%' OR s.student_no LIKE '%" . $data['filter_search'] . "%' OR s.student_phone LIKE '" . $data['filter_search'] . "' OR s.student_email LIKE '" . $data['filter_search'] . "' OR s.student_gender LIKE '" . $data['filter_search'] . "' OR u.firstname LIKE '" . $data['filter_search'] . "' OR s1.student_name LIKE '" . $data['filter_search'] . "' OR s1.student_no LIKE '" . $data['filter_search'] . "' OR DATE(s.activated_at) = '" . $data['filter_search'] . "' OR DATE(s.created_at) = '" . $data['filter_search'] . "')";
		}
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND s.student_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_phone'])) {
			$sql .= " AND s.student_phone LIKE '%" . $this->db->escape($data['filter_phone']) . "%'";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND student_status = '" . $data['filter_status'] . "'";
		}
		
		if (isset($data['filter_refer_id']) && !is_null($data['filter_refer_id'])) {
			$sql .= " AND refer_id = '" . $data['filter_refer_id'] . "'";
		}
		
		if (isset($data['filter_student_no']) && !is_null($data['filter_student_no'])) {
			$sql .= " AND s.student_no = '" . $data['filter_student_no'] . "'";
		}
		
		if (isset($data['filter_refer_id']) && !is_null($data['filter_refer_id'])) {
			$sql .= " AND s.refer_id = '" . $data['filter_refer_id'] . "'";
		}
		
		if (isset($data['filter_link_user_id']) && !is_null($data['filter_link_user_id'])) {
			$sql .= " AND s.link_user_id = '" . $data['filter_link_user_id'] . "'";
		}
		
		if (!empty($data['filter_start_date'])) {
			$sql .= " AND DATE(s.created_at) >= '" . $this->db->escape($data['filter_start_date']) . "'";
		}

		if (!empty($data['filter_end_date'])) {
			$sql .= " AND DATE(s.created_at) <= '" . $this->db->escape($data['filter_end_date']) . "'";
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