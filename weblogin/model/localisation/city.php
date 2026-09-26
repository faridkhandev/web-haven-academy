<?php
class ModelLocalisationCity extends Model {
	public $columns = array('c.city_id', 'c1.name', 'z.name', 'c.name', 'status');
	
	public function addCity($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "city SET name = '" . $this->db->escape($data['name']) . "', zone_id = '" . (int)$data['zone_id'] . "', latitude = '" . $this->db->escape($data['latitude']) . "', longitude = '" . $this->db->escape($data['longitude']) . "', status = '" . (int)$data['status'] . "'");
		$city_id = $this->db->getLastId();
		return $city_id;
	}

	public function editCity($city_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "city SET name = '" . $this->db->escape($data['name']) . "', zone_id = '" . (int)$data['zone_id'] . "', latitude = '" . $this->db->escape($data['latitude']) . "', longitude = '" . $this->db->escape($data['longitude']) . "', status = '" . (int)$data['status'] . "' WHERE city_id = '" . (int)$city_id . "'");
	}

	public function delete($city_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "city SET delete_status=1 WHERE city_id = '" . (int)$city_id . "'");
	}

	public function getCity($city_id) {
		$query = $this->db->query("SELECT DISTINCT c.*, z.name as zone, c1.country_id, c1.name as country FROM " . DB_PREFIX . "city c LEFT JOIN " . DB_PREFIX . "zone z ON (z.zone_id = c.zone_id) LEFT JOIN " . DB_PREFIX . "country c1 ON (c1.country_id = z.country_id) WHERE c.city_id = '" . (int)$city_id . "'");

		return $query->row;
	}
	
	public function getTotalCities($data = []) {
		$sql = "SELECT COUNT(c.city_id) AS total FROM " . DB_PREFIX . "city c INNER JOIN " . DB_PREFIX . "zone z ON (z.zone_id = c.zone_id) INNER JOIN " . DB_PREFIX . "country c1 ON (c1.country_id = z.country_id)";
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " WHERE c.status = '" . (int)$data['filter_status'] . "'";
		} else {
			$sql .= " WHERE c.status != '2'";
		}

		if (!empty($data['filter_name'])) {
			$sql .= " AND c.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
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
		if ($data) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "city c WHERE c.delete_status = 0");
			$recordsTotal = (int)$query->num_rows;
			
			$sql = "SELECT c.*, z.name AS zone, c1.name AS country FROM " . DB_PREFIX . "city c INNER JOIN " . DB_PREFIX . "zone z ON (z.zone_id = c.zone_id) INNER JOIN " . DB_PREFIX . "country c1 ON (c1.country_id = z.country_id) WHERE c.delete_status = 0";

			$implode = array();
			
			if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
				$implode[] = "c.status = '" . (int)$data['filter_status'] . "'";
			}
			
			if (!empty($data['filter_name'])) {
				$implode[] = "c.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
			}
			
			if (!empty($data['filter_country'])) {
				$implode[] = "c1.country_id = '" . (int)$data['filter_country'] . "'";
			}
			
			if (!empty($data['filter_zone'])) {
				$implode[] = "z.zone_id = '" . (int)$data['filter_zone'] . "'";
			}
			
			if ($implode) {
				$sql .= " AND " . implode(" AND ", $implode);
			}

			if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
				$sql .= " ORDER BY " . $this->columns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
			} else {
				$sql .= " ORDER BY c.name ASC";
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
			/* echo $sql; */
			$query = $this->db->query($sql);
			$result = $query->rows;

			return array('recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered, 'result' => $result);
		} else {
			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "city` c WHERE c.delete_status = 0");
			return $query->rows;
		}
	}
	
	public function getCities($data = []) {
		if ($data) {
			$sql = "SELECT c.*, z.name AS zone, c1.name AS country FROM " . DB_PREFIX . "city c INNER JOIN " . DB_PREFIX . "zone z ON (z.zone_id = c.zone_id) INNER JOIN " . DB_PREFIX . "country c1 ON (c1.country_id = z.country_id)";
			
			if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
				$implode[] = "c.status = '" . (int)$data['filter_status'] . "'";
			}
			
			if (!empty($data['filter_name'])) {
				$implode[] = " AND c.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
			}
			
			if (!empty($data['filter_country'])) {
				$implode[] = " AND c1.country_id = '" . (int)$data['filter_country'] . "'";
			}
			
			if (!empty($data['filter_zone'])) {
				$implode[] = " AND z.zone_id = '" . (int)$data['filter_zone'] . "'";
			}
			
			$sort_data = array(
				'c.name',
				'z.name',
				'c1.name'
			);

			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY c.name";
			}

			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC";
			} else {
				$sql .= " ASC";
			}

			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}

				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}

				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}
		} else {
			$sql = "SELECT * FROM " . DB_PREFIX . "city c ORDER BY c.name ASC";
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	public function getTotalCitiesByZoneId($zone_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "city WHERE zone_id = '" . (int)$zone_id . "'");

		return $query->row['total'];
	}

	public function getCitiesByZoneId($zone_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "city WHERE zone_id = '" . (int)$zone_id . "' AND status = '1' ORDER BY name");
		$city_data = $query->rows;
		return $city_data;
	}
}