<?php
class ModelModuleLocation extends Model {
	public $columns = array('l.doctor_location_id', 'd.doctor_name', 'lo.location_name', 'c.name', 'z.name', 'co.name', 'l.status');
	
	public function add($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "doctor_to_area SET doctor_id = '" . $this->db->escape($data['doctor_id']) . "', area_id = '" . (int)$data['area_id'] . "', status = '" . (int)$data['status'] . "', date_added = '".date('Y-m-d H:i:s')."', date_modified = '".date('Y-m-d H:i:s')."', added_by='".$this->user->getId()."', modified_by='".$this->user->getId()."', own_by='".$this->user->getId()."'");
		$location_id = $this->db->getLastId();
		return $location_id;
	}

	public function edit($doctor_location_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "doctor_to_area SET doctor_id = '" . $this->db->escape($data['doctor_id']) . "', area_id = '" . (int)$data['area_id'] . "', status = '" . (int)$data['status'] . "', date_added = '".date('Y-m-d H:i:s')."', date_modified = '".date('Y-m-d H:i:s')."', added_by='".$this->user->getId()."', modified_by='".$this->user->getId()."', own_by='".$this->user->getId()."' WHERE doctor_location_id = '" . (int)$doctor_location_id . "'");
	}

	public function delete($doctor_location_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "doctor_to_area WHERE doctor_location_id = '" . (int)$doctor_location_id . "'");
	}

	public function get($doctor_location_id) {
		$query = $this->db->query("SELECT DISTINCT l.*, d.doctor_name, lo.location_name, c.city_id, c.name as city, z.zone_id as zone_id, z.name as zone, c1.country_id, c1.name as country FROM " . DB_PREFIX . "doctor_to_area l INNER JOIN " . DB_PREFIX . "doctor d ON (l.doctor_id = d.doctor_id) INNER JOIN " . DB_PREFIX . "location lo ON (l.area_id = lo.location_id) INNER JOIN " . DB_PREFIX . "city c ON (c.city_id = lo.city_id) LEFT JOIN " . DB_PREFIX . "zone z ON (z.zone_id = c.zone_id) LEFT JOIN " . DB_PREFIX . "country c1 ON (c1.country_id = z.country_id) WHERE l.doctor_location_id = '" . (int)$doctor_location_id . "'");

		return $query->row;
	}
	
	public function getDoctorByInfo($data = array()) {
		$query = $this->db->query("SELECT DISTINCT l.* FROM " . DB_PREFIX . "doctor_to_area l WHERE l.doctor_id = '" . (int)$data['doctor_id'] . "' AND area_id = '".$data['area_id']."'");

		return $query->row;
	}
	
	public function getItems($data = array()) {
		$query = $this->db->query("SELECT c.location_id FROM " . DB_PREFIX . "doctor_to_area c");
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT DISTINCT l.*, d.doctor_name, lo.location_name, c.name as city, z.zone_id as zone_id, z.name as zone, c1.country_id, c1.name as country FROM " . DB_PREFIX . "doctor_to_area l INNER JOIN " . DB_PREFIX . "doctor d ON (l.doctor_id = d.doctor_id) INNER JOIN " . DB_PREFIX . "location lo ON (l.area_id = lo.location_id) INNER JOIN " . DB_PREFIX . "city c ON (c.city_id = lo.city_id) LEFT JOIN " . DB_PREFIX . "zone z ON (z.zone_id = c.zone_id) LEFT JOIN " . DB_PREFIX . "country c1 ON (c1.country_id = z.country_id) WHERE 1=1";

		$implode = array();
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$implode[] = "l.status = '" . (int)$data['filter_status'] . "'";
		}
		
		if (!empty($data['filter_name'])) {
			$implode[] = "d.doctor_name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_location'])) {
			$implode[] = "l.area_id = '" . (int)$data['filter_location'] . "'";
		}
		
		if (!empty($data['filter_doctor_id'])) {
			$implode[] = "l.doctor_id = '" . (int)$data['filter_doctor_id'] . "'";
		}
		
		if (!empty($data['filter_state'])) {
			$implode[] = "z.zone_id = '" . (int)$data['filter_state'] . "'";
		}
		
		if (!empty($data['filter_city'])) {
			$implode[] = "c.city_id = '" . (int)$data['filter_city'] . "'";
		}
		
		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}

		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->columns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY l.date_added DESC";
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