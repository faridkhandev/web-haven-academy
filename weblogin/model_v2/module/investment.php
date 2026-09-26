<?php
class ModelModuleInvestment extends Model {
	public $columns = array('di.doctor_investment_id','d.doctor_name','di.description', 'di.investment_amount', 'di.limit_amount', 'di.investment_status', 'di.date_added');

	public function add($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "doctor_investment SET doctor_id = '" . (int)$data['doctor_id'] . "', description = '" . $this->db->escape($data['description']) . "', investment_amount = '" . $this->db->escape($data['investment_amount']) . "', limit_amount = '" . $this->db->escape($data['limit_amount']) . "', own_by = '" . $this->user->getId() . "', date_added = '".date('Y-m-d H:i:s')."', added_by = '".$this->user->getId()."'");
		
		return $doctor_investment_id = $this->db->getLastId();
	}

	public function edit($doctor_investment_id,$data) {
		$this->db->query("UPDATE " . DB_PREFIX . "doctor_investment SET doctor_id = '" . (int)$data['doctor_id'] . "', description = '" . $this->db->escape($data['description']) . "', investment_amount = '" . $this->db->escape($data['investment_amount']) . "', limit_amount = '" . $this->db->escape($data['limit_amount']) . "', own_by = '" . $this->db->escape($data['own_by']) . "' WHERE doctor_investment_id = '" . (int)$doctor_investment_id . "'");
	}
	
	public function copy($doctor_investment_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "doctor_investment WHERE doctor_investment_id = '" . (int)$doctor_investment_id . "'");

		if ($query->num_rows) {
			$data = $query->row;
			$this->add($data);
		}
	}

	public function delete($doctor_investment_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "doctor_investment SET doctor_delete_status = '1' WHERE doctor_investment_id = '" . (int)$doctor_investment_id . "'");
	}
	
	public function get($doctor_investment_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "doctor_investment WHERE doctor_investment_id = '" . (int)$doctor_investment_id . "'");

		return $query->row;
	}
	
	public function getItems($data = array()) {
		//print_r($data);
		$query = $this->db->query("SELECT doctor_investment_id FROM " . DB_PREFIX . "doctor_investment WHERE delete_status=0");
		$recordsTotal = (int)$query->num_rows;
		$sql = "SELECT di.*, d.doctor_name FROM " . DB_PREFIX . "doctor_investment di INNER JOIN " . DB_PREFIX . "doctor d ON di.doctor_id=d.doctor_id";
		
		
		$sql .= " WHERE di.delete_status=0";
		
		if (!empty($data['doctor_investment_id'])) {
			$sql .= " AND di.doctor_investment_id = '" . $this->db->escape($data['doctor_investment_id']) . "'";
		}
		if (!empty($data['filter_doctor_id'])) {
			$sql .= " AND di.doctor_id = '" . $this->db->escape($data['filter_doctor_id']) . "'";
		}
		if (!empty($data['filter_name'])) {
			$sql .= " AND d.doctor_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['minimum_investment_amount'])) {
			$sql .= " AND di.investment_amount >= '" . $this->db->escape($data['minimum_investment_amount']) . "'";
		}

		if (!empty($data['maximum_investment_amount'])) {
			$sql .= " AND di.investment_amount <= '" . $this->db->escape($data['maximum_investment_amount']) . "'";
		}
		
		if (!empty($data['minimum_limit_amount'])) {
			$sql .= " AND di.limit_amount >= '" . $this->db->escape($data['minimum_limit_amount']) . "'";
		}

		if (!empty($data['maximum_limit_amount'])) {
			$sql .= " AND di.limit_amount <= '" . $this->db->escape($data['maximum_limit_amount']) . "'";
		}
		
		if (!empty($data['filter_start_date'])) {
			$sql .= " AND DATE(di.date_added) >= '" . $this->db->escape($data['filter_date_start']) . "'";
		}

		if (!empty($data['filter_date_end'])) {
			$sql .= " AND DATE(di.date_added) <= '" . $this->db->escape($data['filter_date_end']) . "'";
		}
		
		$sql .= " GROUP BY di.doctor_investment_id";
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->columns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY di.doctor_investment_id DESC";
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