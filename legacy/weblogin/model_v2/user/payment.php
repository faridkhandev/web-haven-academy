<?php
class ModelUserPayment extends Model {
	public $columns = array('uph.id','ue.user_no','u.firstname','ug.name','uph.amount','uwr.withdrawal_point', 'uph.conversion_rate', 'uph.transaction_id', 'uph.payment_medium_id', 'uph.payment_date');
	
	public function add($data) {
			
		$this->db->query("INSERT INTO " . DB_PREFIX . "user_payment_history SET user_id = '" . (int)$data['user_id'] . "', amount = '" . $this->db->escape($data['amount']) . "', withdrawal_request_id = '" . $this->db->escape($data['withdrawal_request_id']) . "', conversion_rate = '" . $this->db->escape($data['conversion_rate']) . "', payment_medium_id = '" . $this->db->escape($data['payment_medium_id']) . "', transaction_id = '" . $this->db->escape($data['transaction_id']) . "', comment = '" . $this->db->escape($data['comment']) . "', screenshot_image = '" . $this->db->escape($data['screenshot_image']) . "', payment_date = '".date('Y-m-d H:i:s')."', created_by = '".$this->user->getId()."'");
		
		return $this->db->getLastId();
	}
	
	public function getItems($data = array()) {
		//print_r($data);
		$query = $this->db->query("SELECT uph.id FROM " . DB_PREFIX . "user_payment_history uph");
		
		$recordsTotal = (int)$query->num_rows;
		$sql = "SELECT uph.*, ue.user_no, u.firstname, u.lastname, ug.name as user_group, uwr.withdrawal_point FROM " . DB_PREFIX . "user_payment_history uph INNER JOIN " . DB_PREFIX . "user_withdrawal_request uwr ON uph.withdrawal_request_id=uwr.id INNER JOIN " . DB_PREFIX . "user u ON uph.user_id=u.user_id INNER JOIN " . DB_PREFIX . "user_extra ue ON u.user_id=ue.user_id INNER JOIN " . DB_PREFIX . "user_group ug ON u.user_group_id=ug.user_group_id";
		
		
		$sql .= " WHERE 1=1";
		
		if (!empty($data['filter_user'])) {
			$sql .= " AND uph.user_id = '" . $this->db->escape($data['filter_user']) . "'";
		}
		
		if (!empty($data['filter_user_group'])) {
			$sql .= " AND u.user_group_id = '" . $this->db->escape($data['filter_user_group']) . "'";
		}
		
		if (!empty($data['filter_transaction_no'])) {
			$sql .= " AND uph.transaction_id = '" . $this->db->escape($data['filter_transaction_no']) . "'";
		}
		
		if (!empty($data['filter_user_no'])) {
			$sql .= " AND ue.user_no = '" . $this->db->escape($data['filter_user_no']) . "'";
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