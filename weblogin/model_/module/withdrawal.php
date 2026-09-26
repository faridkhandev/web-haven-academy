<?php
class ModelModuleWithdrawal extends Model {
	public $columns = array('id','withdrawal_point','approve_status', 'requested_at', 'approve_at', 'cancelled_at');
	
	public function add($data) {
			
		$this->db->query("INSERT INTO " . DB_PREFIX . "user_withdrawal_request SET user_id = '" . (int)$data['user_id'] . "', withdrawal_point = '" . $this->db->escape($data['withdrawal_point']) . "', approve_status = 'Pending', requested_at = '".date('Y-m-d H:i:s')."'");
		
		return $this->db->getLastId();
	}
	
	public function getItems($data = array()) {
		//print_r($data);
		$query = $this->db->query("SELECT id FROM " . DB_PREFIX . "user_withdrawal_request WHERE user_id = '" . $this->db->escape($data['filter_user']) . "'");
		
		$recordsTotal = (int)$query->num_rows;
		$sql = "SELECT * FROM " . DB_PREFIX . "user_withdrawal_request";
		
		
		$sql .= " WHERE 1=1";
		
		if (!empty($data['filter_user'])) {
			$sql .= " AND user_id = '" . $this->db->escape($data['filter_user']) . "'";
		}
		
		if (!empty($data['filter_approve_status'])) {
			$sql .= " AND approve_status = '" . $this->db->escape($data['filter_approve_status']) . "'";
		}
		
		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(requested_at) >= '" . $this->db->escape($data['filter_date_added']) . "'";
		}

		if (!empty($data['filter_date_ended'])) {
			$sql .= " AND DATE(requested_at) <= '" . $this->db->escape($data['filter_date_ended']) . "'";
		}
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->columns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY requested_at DESC";
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