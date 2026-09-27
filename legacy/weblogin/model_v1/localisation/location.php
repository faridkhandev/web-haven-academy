<?php
class ModelLocalisationLocation extends Model {
	public $columns = array('l.location_id', 'l.location_name', 'c.name', 'z.name', 'co.name', 'l.location_status');
	
	public function add($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "location SET location_name = '" . $this->db->escape($data['location_name']) . "', city_id = '" . (int)$data['city_id'] . "', location_status = '" . (int)$data['location_status'] . "', location_date_added = '".date('Y-m-d H:i:s')."', location_date_modified = '".date('Y-m-d H:i:s')."', location_added_by='".$this->user->getId()."', location_modified_by='".$this->user->getId()."', location_own_by='".$this->user->getId()."'");
		$location_id = $this->db->getLastId();
		return $location_id;
	}

	public function edit($location_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "location SET name = '" . $this->db->escape($data['name']) . "', zone_id = '" . (int)$data['zone_id'] . "', latitude = '" . $this->db->escape($data['latitude']) . "', longitude = '" . $this->db->escape($data['longitude']) . "', status = '" . (int)$data['status'] . "' WHERE location_id = '" . (int)$location_id . "'");
	}

	public function delete($location_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "location SET delete_status=1 WHERE location_id = '" . (int)$location_id . "'");
	}

	public function get($location_id) {
		$query = $this->db->query("SELECT DISTINCT l.*, c.name as city, z.zone_id as zone_id, z.name as zone, c1.country_id, c1.name as country FROM " . DB_PREFIX . "location l INNER JOIN " . DB_PREFIX . "city c ON (c.city_id = l.city_id) LEFT JOIN " . DB_PREFIX . "zone z ON (z.zone_id = c.zone_id) LEFT JOIN " . DB_PREFIX . "country c1 ON (c1.country_id = z.country_id) WHERE l.location_id = '" . (int)$location_id . "'");

		return $query->row;
	}
	
	public function getTotalCities($data = []) {
		$sql = "SELECT COUNT(l.location_id) AS total FROM " . DB_PREFIX . "location l INNER JOIN " . DB_PREFIX . "city c ON (c.city_id = l.city_id) INNER JOIN " . DB_PREFIX . "zone z ON (z.zone_id = c.zone_id) INNER JOIN " . DB_PREFIX . "country c1 ON (c1.country_id = z.country_id)";
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " WHERE l.location_status = '" . (int)$data['filter_status'] . "'";
		} else {
			$sql .= " WHERE l.location_status != '2'";
		}

		if (!empty($data['filter_name'])) {
			$sql .= " AND l.location_name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_city'])) {
			$sql .= " AND c.city_id = '" . (int)$data['filter_city'] . "'";
		}
		
		if (!empty($data['filter_country'])) {
			$sql .= " AND c1.country_id = '" . (int)$data['filter_country'] . "'";
		}
		
		if (!empty($data['filter_zone'])) {
			$sql .= " AND z.zone_id = '" . (int)$data['filter_zone'] . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	public function getItems($data = array()) {
		$query = $this->db->query("SELECT c.location_id FROM " . DB_PREFIX . "location c WHERE c.delete_status = 0");
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT l.*, c.name as city, z.name AS zone, c1.name AS country FROM " . DB_PREFIX . "location l INNER JOIN " . DB_PREFIX . "city c ON (c.city_id = l.city_id) INNER JOIN " . DB_PREFIX . "zone z ON (z.zone_id = c.zone_id) INNER JOIN " . DB_PREFIX . "country c1 ON (c1.country_id = z.country_id) WHERE l.delete_status = 0";

		$implode = array();
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$implode[] = "l.status = '" . (int)$data['filter_status'] . "'";
		}
		
		if (!empty($data['filter_name'])) {
			$implode[] = "l.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_country'])) {
			$implode[] = "c1.country_id = '" . (int)$data['filter_country'] . "'";
		}
		
		if (!empty($data['filter_zone'])) {
			$implode[] = "z.zone_id = '" . (int)$data['filter_zone'] . "'";
		}
		
		if (!empty($data['filter_city'])) {
			$implode[] = "l.city_id = '" . (int)$data['filter_city'] . "'";
		}
		
		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}

		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->columns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY l.location_name ASC";
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