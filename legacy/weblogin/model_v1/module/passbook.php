<?php
class ModelModulePassbook extends Model {
	public $columns = array('id','reason','description', 'credit_point', 'balance_point', 'created_at');
	
	public function add($data) {
		$last_record = $this->getLastRecord($data['user_id']);
		if(!empty($last_record)){
			$current_balance_point = $data['balance_point'];
		}else{
			$current_balance_point = 0;
		}
		
		if($data['type']=='Credit'){
			$balance_point = $last_record['balance_point']+$current_balance_point;
		}else{
			$balance_point = $last_record['balance_point']-$current_balance_point;
		}
			
		$this->db->query("INSERT INTO " . DB_PREFIX . "user_passbook SET user_id = '" . (int)$data['user_id'] . "', reason = '" . $this->db->escape($data['reason']) . "', description = '" . $this->db->escape($data['description']) . "', credit_point = '" . $this->db->escape($data['credit_point']) . "', debit_point = '" . $this->db->escape($data['debit_point']) . "', balance_point = '" . $this->db->escape($balance_point) . "', type = '" . $this->db->escape($data['type']) . "', created_at = '".date('Y-m-d H:i:s')."'");
		
		return $this->db->getLastId();
	}
	
	public function getLastRecord($user_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user_passbook WHERE user_id = '" . (int)$user_id . "'");
		return $query->row;
	}
	
	public function getItems($data = array()) {
		//print_r($data);
		$query = $this->db->query("SELECT id FROM " . DB_PREFIX . "user_passbook WHERE user_id='" . $this->db->escape($data['filter_user']) . "'");
		$recordsTotal = (int)$query->num_rows;
		$sql = "SELECT * FROM " . DB_PREFIX . "user_passbook";
		
		
		$sql .= " WHERE 1=1";
		
		if (!empty($data['filter_user'])) {
			$sql .= " AND user_id = '" . $this->db->escape($data['filter_user']) . "'";
		}
		
		if (!empty($data['filter_reason'])) {
			$sql .= " AND reason LIKE '%" . $this->db->escape($data['filter_reason']) . "%'";
		}
		
		if (!empty($data['filter_type'])) {
			$sql .= " AND type = '" . $this->db->escape($data['filter_type']) . "'";
		}
		
		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(created_at) >= '" . $this->db->escape($data['filter_date_added']) . "'";
		}

		if (!empty($data['filter_date_ended'])) {
			$sql .= " AND DATE(created_at) <= '" . $this->db->escape($data['filter_date_ended']) . "'";
		}
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->columns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY created_at DESC";
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