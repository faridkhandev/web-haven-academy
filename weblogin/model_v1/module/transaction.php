<?php
class ModelModuleTransaction extends Model {
	public $columns = array('dt.doctor_transaction_id','d.doctor_name','di.description', 'di.amount', 'l.location_name', 'dt.date_added');

	public function add($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "doctor_transaction SET doctor_id = '" . (int)$data['doctor_id'] . "', area_id = '" . (int)$data['area_id'] . "', description = '" . $this->db->escape($data['description']) . "', amount = '" . $this->db->escape($data['amount']) . "', own_by = '" . $this->db->escape($data['own_by']) . "', date_added = '".date('Y-m-d H:i:s')."', added_by = '".$this->user->getId()."'");
				
		$doctor_transaction_id = $this->db->getLastId();
		
		$this->calculateInvestment($doctor_transaction_id, $data);
		
		return $doctor_transaction_id;
	}

	public function edit($doctor_transaction_id,$data) {
		$this->db->query("UPDATE " . DB_PREFIX . "doctor_transaction SET doctor_id = '" . (int)$data['doctor_id'] . "', area_id = '" . (int)$data['area_id'] . "', description = '" . $this->db->escape($data['description']) . "', amount = '" . $this->db->escape($data['amount']) . "', own_by = '" . $this->db->escape($data['own_by']) . "', WHERE doctor_transaction_id = '" . (int)$doctor_transaction_id . "'");
		
		$this->calculateInvestment($doctor_transaction_id, $data);
	}
	
	public function calculateInvestment($doctor_transaction_id, $data){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "doctor_investment WHERE doctor_id = '" . (int)$data['doctor_id'] . "' AND investment_status = 1 ORDER BY doctor_investment_id ASC LIMIT 1");
		$investment = $query->row; //Which goal amount/limit_amount to calculate
		$doctor_investment_id = $investment['doctor_investment_id']; 
		$limit_amount = $investment['limit_amount']; 
		$date_added = $investment['date_added']; 
		
		$this->db->query("UPDATE " . DB_PREFIX . "doctor_transaction SET doctor_investment_id = '" . (int)$doctor_investment_id . "' WHERE doctor_transaction_id = '" . (int)$doctor_transaction_id . "'");
		
		$calculate = $this->db->query("SELECT SUM(amount) as total_amount FROM " . DB_PREFIX . "doctor_transaction WHERE doctor_investment_id = '" . (int)$doctor_investment_id . "'");
		$total_amount = $calculate->row['total_amount'];
		
		//update investment status to complete(2) and insert into notification table
		if($total_amount>=$limit_amount){ 
			$this->db->query("UPDATE " . DB_PREFIX . "doctor_investment SET investment_status = '2' WHERE doctor_investment_id = '" . (int)$doctor_investment_id . "'");
			
			$this->db->query("INSERT INTO " . DB_PREFIX . "notification SET doctor_investment_id = '" . (int)$doctor_investment_id . "', description = 'Limit ".$limit_amount." reach on ".$date_added." when ".$data['amount']." added by ".$data['own_by'].".', date_added = '".date('Y-m-d H:i:s')."'");
		}
	}
	
	public function copy($doctor_transaction_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "doctor_transaction WHERE doctor_transaction_id = '" . (int)$doctor_transaction_id . "'");

		if ($query->num_rows) {
			$data = $query->row;
			$this->add($data);
		}
	}

	public function delete($doctor_transaction_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "doctor_transaction SET delete_status = '1' WHERE doctor_transaction_id = '" . (int)$doctor_transaction_id . "'");
	}
	
	public function get($doctor_transaction_id) {
		$query = $this->db->query("SELECT di.*, d.doctor_name, l.location_name, c.city_id, c.name as city_name, z.zone_id, z.name as zone_name FROM " . DB_PREFIX . "doctor_transaction di INNER JOIN " . DB_PREFIX . "doctor d ON di.doctor_id=d.doctor_id INNER JOIN " . DB_PREFIX . "location l ON di.area_id=l.location_id INNER JOIN " . DB_PREFIX . "city c ON l.city_id=c.city_id INNER JOIN " . DB_PREFIX . "zone z ON c.zone_id=z.zone_id WHERE di.doctor_transaction_id = '" . (int)$doctor_transaction_id . "'");

		return $query->row;
	}
	
	public function getItems($data = array()) {
		//print_r($data);
		$query = $this->db->query("SELECT doctor_transaction_id FROM " . DB_PREFIX . "doctor_transaction WHERE delete_status=0");
		$recordsTotal = (int)$query->num_rows;
		$sql = "SELECT di.*, d.doctor_name, l.location_name, c.name as city_name, z.name as zone_name FROM " . DB_PREFIX . "doctor_transaction di INNER JOIN " . DB_PREFIX . "doctor d ON di.doctor_id=d.doctor_id INNER JOIN " . DB_PREFIX . "location l ON di.area_id=l.location_id INNER JOIN " . DB_PREFIX . "city c ON l.city_id=c.city_id INNER JOIN " . DB_PREFIX . "zone z ON c.zone_id=z.zone_id";
		
		
		$sql .= " WHERE di.delete_status=0";
		if (!empty($data['filter_doctor_id'])) {
			$sql .= " AND di.doctor_id = '" . $this->db->escape($data['filter_doctor_id']) . "'";
		}
		
		if (!empty($data['doctor_investment_id'])) {
			$sql .= " AND di.doctor_investment_id = '" . $this->db->escape($data['doctor_investment_id']) . "'";
		}
		
		if (!empty($data['filter_minimum_amount'])) {
			$sql .= " AND di.amount >= '" . $this->db->escape($data['filter_minimum_amount']) . "'";
		}

		if (!empty($data['filter_maximum_amount'])) {
			$sql .= " AND di.amount <= '" . $this->db->escape($data['filter_maximum_amount']) . "'";
		}
		
		if (!empty($data['filter_location_id'])) {
			$sql .= " AND di.location_id = '" . $this->db->escape($data['filter_location_id']) . "'";
		}
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND d.doctor_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_start_date'])) {
			$sql .= " AND DATE(di.date_added) >= '" . $this->db->escape($data['filter_date_start']) . "'";
		}

		if (!empty($data['filter_date_end'])) {
			$sql .= " AND DATE(di.date_added) <= '" . $this->db->escape($data['filter_date_end']) . "'";
		}
		
		$sql .= " GROUP BY di.doctor_transaction_id";
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->columns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY di.doctor_transaction_id DESC";
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