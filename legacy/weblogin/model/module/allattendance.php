<?php
class ModelModuleAllattendance extends Model {
	
	/* public function add($data) {
			
		$this->db->query("INSERT INTO " . DB_PREFIX . "user_payment_history SET user_id = '" . (int)$data['user_id'] . "', amount = '" . $this->db->escape($data['amount']) . "', withdrawal_request_id = '" . $this->db->escape($data['withdrawal_request_id']) . "', conversion_rate = '" . $this->db->escape($data['conversion_rate']) . "', payment_medium_id = '" . $this->db->escape($data['payment_medium_id']) . "', payment_date = '" . $this->db->escape($data['payment_date']) . "', created_by = '".date('Y-m-d H:i:s')."'");
		
		return $this->db->getLastId();
	} */
	
	public function getItems($data = array()) {
		$query = $this->db->query("SELECT DISTINCT session_teacher_id FROM " . DB_PREFIX . "course_to_session");
		
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT CONCAT(u.firstname, ' ', u.lastname) as teacher_name, COUNT(DISTINCT cs.meeting_link) as total_class FROM " . DB_PREFIX . "course_to_session cs JOIN " . DB_PREFIX . "user u ON cs.session_teacher_id = u.user_id";
		
		$sql .= " WHERE 1=1";
		
		if (!empty($data['filter_user'])) {
			$sql .= " AND cs.session_teacher_id = '" . $this->db->escape($data['filter_user']) . "'";
		}
		
		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(cs.session_date) >= '" . $this->db->escape($data['filter_date_added']) . "'";
		}

		if (!empty($data['filter_date_ended'])) {
			$sql .= " AND DATE(cs.session_date) <= '" . $this->db->escape($data['filter_date_ended']) . "'";
		}
		
		$sql .= " GROUP BY cs.session_teacher_id";
		
		/* if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->columns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY uph.payment_date DESC";
		} */
		
		$sql .= " ORDER BY u.user_id DESC";
		
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