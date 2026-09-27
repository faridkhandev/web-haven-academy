<?php
class ModelModuleDoctor extends Model {
	public $columns = array('d.doctor_id','d.doctor_id','d.doctor_name','d.doctor_degree', 'd.doctor_address', 'd.doctor_contact', 'd.doctor_gender', 'd.doctor_status', 'd.doctor_date_added', 'd.doctor_date_modified');

	public function add($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "doctor SET doctor_status = '" . (int)$data['doctor_status'] . "', doctor_name = '" . $this->db->escape($data['doctor_name']) . "', doctor_degree = '" . $this->db->escape($data['doctor_degree']) . "', doctor_address = '" . $this->db->escape($data['doctor_address']) . "', doctor_contact = '" . $this->db->escape($data['doctor_contact']) . "', doctor_gender = '" . $this->db->escape($data['doctor_gender']) . "', doctor_age = '" . $this->db->escape($data['doctor_age']) . "', doctor_image = '" . $this->db->escape($data['doctor_image']) . "', doctor_delete_status = '0', doctor_date_added = '".date('Y-m-d H:i:s')."', doctor_date_modified = '".date('Y-m-d H:i:s')."', doctor_added_by='".$this->user->getId()."', doctor_modified_by='".$this->user->getId()."', doctor_own_by='".$this->user->getId()."'");
		
		$doctor_id = $this->db->getLastId();
		
		$this->db->query("UPDATE " . DB_PREFIX . "doctor SET doctor_order = '" . (int)$doctor_id . "' WHERE doctor_id = '" . (int)$doctor_id . "'");
	}

	public function edit($doctor_id,$data) {
		$this->db->query("UPDATE " . DB_PREFIX . "doctor SET doctor_status = '" . (int)$data['doctor_status'] . "', doctor_name = '" . $this->db->escape($data['doctor_name']) . "', doctor_degree = '" . $this->db->escape($data['doctor_degree']) . "', doctor_address = '" . $this->db->escape($data['doctor_address']) . "', doctor_contact = '" . $this->db->escape($data['doctor_contact']) . "', doctor_gender = '" . $this->db->escape($data['doctor_gender']) . "', doctor_age = '" . $this->db->escape($data['doctor_age']) . "', doctor_image = '" . $this->db->escape($data['doctor_image']) . "', doctor_date_modified = '".date('Y-m-d H:i:s')."', doctor_modified_by='".$this->user->getId()."' WHERE doctor_id = '" . (int)$doctor_id . "'");
	}
	
	public function copy($doctor_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "doctor WHERE doctor_id = '" . (int)$doctor_id . "'");

		if ($query->num_rows) {
			$data = $query->row;
			$data['doctor_status'] = '0';
			$this->add($data);
		}
	}

	public function delete($doctor_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "doctor SET doctor_delete_status = '1' WHERE doctor_id = '" . (int)$doctor_id . "'");
	}
	
	public function get($doctor_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "doctor WHERE doctor_id = '" . (int)$doctor_id . "'");

		return $query->row;
	}
	
	public function getItems($data = array()) {
		//print_r($data);
		$query = $this->db->query("SELECT doctor_id FROM " . DB_PREFIX . "doctor WHERE doctor_delete_status=0");
		$recordsTotal = (int)$query->num_rows;
		$sql = "SELECT d.* FROM " . DB_PREFIX . "doctor d";
		if (!empty($data['filter_state']) && !empty($data['filter_city']) && !empty($data['filter_area'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "doctor_to_area da ON d.doctor_id = da.doctor_id LEFT JOIN " . DB_PREFIX . "location l ON l.location_id=da.area_id LEFT JOIN " . DB_PREFIX . "city c ON l.city_id=c.city_id LEFT JOIN " . DB_PREFIX . "zone z ON c.zone_id=z.zone_id";
		}
		
		if (empty($data['filter_state']) && !empty($data['filter_city']) && !empty($data['filter_area'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "doctor_to_area da ON d.doctor_id = da.doctor_id LEFT JOIN " . DB_PREFIX . "location l ON l.location_id=da.area_id LEFT JOIN " . DB_PREFIX . "city c ON l.city_id=c.city_id";
		}
		
		if (empty($data['filter_state']) && empty($data['filter_city']) && !empty($data['filter_area'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "doctor_to_area da ON d.doctor_id = da.doctor_id LEFT JOIN " . DB_PREFIX . "location l ON l.location_id=da.area_id";
		}
		
		$sql .= " WHERE d.doctor_delete_status=0";
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND d.doctor_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND d.doctor_status = '" . $data['filter_status'] . "'";
		}
		if (isset($data['filter_gender']) && !is_null($data['filter_gender'])) {
			$sql .= " AND d.doctor_gender = '" . $data['filter_gender'] . "'";
		}
		
		if (!empty($data['filter_state']) && !empty($data['filter_city']) && !empty($data['filter_area'])) {
			$sql .= " AND z.zone_id = '" . $data['filter_state'] . "'";
			$sql .= " AND c.city_id = '" . $data['filter_city'] . "'";
			$sql .= " AND l.location_id = '" . $data['filter_area'] . "'";
		}
		
		if (!empty($data['filter_state']) && !empty($data['filter_city']) && empty($data['filter_area'])) {
			$sql .= " AND z.zone_id = '" . $data['filter_state'] . "'";
			$sql .= " AND c.city_id = '" . $data['filter_city'] . "'";
		}
		
		if (!empty($data['filter_state']) && empty($data['filter_city']) && empty($data['filter_area'])) {
			$sql .= " AND z.zone_id = '" . $data['filter_state'] . "'";
		}
		
		if (!empty($data['filter_start_date'])) {
			$sql .= " AND DATE(d.doctor_date_added) >= '" . $this->db->escape($data['filter_start_date']) . "'";
		}

		if (!empty($data['filter_end_date'])) {
			$sql .= " AND DATE(d.doctor_date_modified) <= '" . $this->db->escape($data['filter_end_date']) . "'";
		}
		
		$sql .= " GROUP BY d.doctor_id";
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->columns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY d.doctor_id DESC";
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
	
	public function getOnlyPendingInvestmentDoctors() {
		//print_r($data);
		$sql = "SELECT d.* FROM " . DB_PREFIX . "doctor d INNER JOIN " . DB_PREFIX . "doctor_investment di ON d.doctor_id=di.doctor_id WHERE di.investment_status = 1 AND d.doctor_delete_status = 0 AND d.doctor_status = 1";
		
		$sql .= " GROUP BY d.doctor_id ORDER BY d.doctor_name ASC";
		$query = $this->db->query($sql);
		return $query->rows;
	}
}	