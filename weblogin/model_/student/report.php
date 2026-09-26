<?php
class ModelStudentReport extends Model {
	public function getItems($data = array()) {
		//print_r($data);
		$query = $this->db->query("SELECT uph.id FROM " . DB_PREFIX . "student_payment_history uph INNER JOIN " . DB_PREFIX . "student s ON uph.student_id=s.id WHERE s.student_delete_status=0");
		
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT uph.*, s.student_no, s.student_name, uwr.withdrawal_point, pd.medium_name, pd.medium_code FROM " . DB_PREFIX . "student_payment_history uph INNER JOIN " . DB_PREFIX . "student_withdrawal_request uwr ON uph.withdrawal_request_id=uwr.id INNER JOIN " . DB_PREFIX . "student s ON uph.student_id=s.id LEFT JOIN " . DB_PREFIX . "student_payment_medium pd ON uph.payment_medium_id=pd.id";
		
		
		$sql .= " WHERE s.student_delete_status=0";
		
		if (!empty($data['filter_student_no'])) {
			$sql .= " AND s.student_no = '" . $this->db->escape($data['filter_student_no']) . "'";
		}
		
		if (!empty($data['filter_transaction_no'])) {
			$sql .= " AND uph.transaction_id LIKE '%" . $this->db->escape($data['filter_transaction_no']) . "%'";
		}
		
		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(uph.payment_date) >= '" . $this->db->escape($data['filter_date_added']) . "'";
		}

		if (!empty($data['filter_date_ended'])) {
			$sql .= " AND DATE(uph.payment_date) <= '" . $this->db->escape($data['filter_date_ended']) . "'";
		}
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->columns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY uph.payment_date DESC";
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