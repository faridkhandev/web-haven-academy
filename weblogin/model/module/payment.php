<?php
class ModelModulePayment extends Model {
	public $columns = array('uph.id','uph.amount','uwr.withdrawal_point', 'uph.conversion_rate', 'uph.transaction_id', 'uph.payment_medium_id', 'uph.payment_date');
	
	/* public function add($data) {
			
		$this->db->query("INSERT INTO " . DB_PREFIX . "user_payment_history SET user_id = '" . (int)$data['user_id'] . "', amount = '" . $this->db->escape($data['amount']) . "', withdrawal_request_id = '" . $this->db->escape($data['withdrawal_request_id']) . "', conversion_rate = '" . $this->db->escape($data['conversion_rate']) . "', payment_medium_id = '" . $this->db->escape($data['payment_medium_id']) . "', payment_date = '" . $this->db->escape($data['payment_date']) . "', created_by = '".date('Y-m-d H:i:s')."'");
		
		return $this->db->getLastId();
	} */
	
	public function getItems($data = array()) {
		//print_r($data);
		$query = $this->db->query("SELECT uph.id FROM " . DB_PREFIX . "user_payment_history uph INNER JOIN " . DB_PREFIX . "user_withdrawal_request uwr ON uph.withdrawal_request_id=uwr.id LEFT JOIN " . DB_PREFIX . "user_payment_medium pd ON uph.payment_medium_id=pd.id WHERE uph.user_id = '" . $this->db->escape($data['filter_user']) . "'");
		
		$recordsTotal = (int)$query->num_rows;
		$sql = "SELECT uph.*, uwr.withdrawal_point FROM " . DB_PREFIX . "user_payment_history uph INNER JOIN " . DB_PREFIX . "user_withdrawal_request uwr ON uph.withdrawal_request_id=uwr.id";
		
		
		$sql .= " WHERE 1=1";
		
		if (!empty($data['filter_user'])) {
			$sql .= " AND uph.user_id = '" . $this->db->escape($data['filter_user']) . "'";
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