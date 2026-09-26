<?php
class ModelLocalisationZone extends Model {
	public $columns = array('z.zone_id', 'c.name', 'z.name', 'z.code', 'status');
	public function add($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "zone SET status = '" . (int)$data['status'] . "', name = '" . $this->db->escape($data['name']) . "', code = '" . $this->db->escape($data['code']) . "', country_id = '" . (int)$data['country_id'] . "'");
	}

	public function edit($zone_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "zone SET status = '" . (int)$data['status'] . "', name = '" . $this->db->escape($data['name']) . "', code = '" . $this->db->escape($data['code']) . "', country_id = '" . (int)$data['country_id'] . "' WHERE zone_id = '" . (int)$zone_id . "'");
	}

	public function delete($zone_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "zone SET delete_status = 1 WHERE zone_id = '" . (int)$zone_id . "'");
	}

	public function getZone($zone_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "zone WHERE zone_id = '" . (int)$zone_id . "'");

		return $query->row;
	}
	
	public function getItems($data = array()) {
		if ($data) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone");
			$recordsTotal = (int)$query->num_rows;
			
			$sql = "SELECT z.*, c.name AS country, c.country_id FROM " . DB_PREFIX . "zone z LEFT JOIN " . DB_PREFIX . "country c ON (z.country_id = c.country_id) WHERE z.delete_status=0";

			$implode = array();
			
			if (!empty($data['filter_name'])) {
				$implode[] = "z.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
			}
			
			if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
				$implode[] = "z.status = '" . (int)$data['filter_status'] . "'";
			}
			
			if (isset($data['filter_country']) && !is_null($data['filter_country'])) {
				$implode[] = "c.country_id = '" . (int)$data['filter_country'] . "'";
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
			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone`");
			return $query->rows;
		}
	}

	public function getZones($data = array()) {
		$sql = "SELECT z.*, c.name AS country, c.country_id FROM " . DB_PREFIX . "zone z LEFT JOIN " . DB_PREFIX . "country c ON (z.country_id = c.country_id) WHERE z.delete_status=0";

		$implode = array();
		
		if (!empty($data['filter_name'])) {
			$implode[] = "z.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$implode[] = "z.status = '" . (int)$data['filter_status'] . "'";
		}
		
		if (isset($data['filter_country']) && !is_null($data['filter_country'])) {
			$implode[] = "c.country_id = '" . (int)$data['filter_country'] . "'";
		}
		
		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}

		$sort_data = array(
			'c.name',
			'z.name',
			'z.code'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY z.name";
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

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getZonesByCountryId($country_id) {
		$zone_data = $this->cache->get('zone.' . (int)$country_id);

		if (!$zone_data) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone WHERE country_id = '" . (int)$country_id . "' AND status = '1' ORDER BY name");

			$zone_data = $query->rows;

			$this->cache->set('zone.' . (int)$country_id, $zone_data);
		}

		return $zone_data;
	}

	public function getTotalZones() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "zone");

		return $query->row['total'];
	}

	public function getTotalZonesByCountryId($country_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "zone WHERE country_id = '" . (int)$country_id . "'");

		return $query->row['total'];
	}
	
	public function getCountryByZoneId($zone_id){
		$query = $this->db->query("SELECT *, z.name, c.name AS country FROM " . DB_PREFIX . "zone z LEFT JOIN " . DB_PREFIX . "country c ON (z.country_id = c.country_id) WHERE zone_id = '" . (int)$zone_id . "'");
		return $query->row;
	}
	
	public function getDoctorZones($doctor_id){
		$sql = "SELECT z.zone_id, z.name FROM " . DB_PREFIX . "doctor_to_area l INNER JOIN " . DB_PREFIX . "doctor d ON (l.doctor_id = d.doctor_id) INNER JOIN " . DB_PREFIX . "location lo ON (l.area_id = lo.location_id) INNER JOIN " . DB_PREFIX . "city c ON (c.city_id = lo.city_id) INNER JOIN " . DB_PREFIX . "zone z ON (z.zone_id = c.zone_id) INNER JOIN " . DB_PREFIX . "country c1 ON (c1.country_id = z.country_id) WHERE l.doctor_id = '".$doctor_id."' GROUP BY z.zone_id";
		$query = $this->db->query($sql);
		return $query->rows;
	}	
	
	public function getDoctorAreas($doctor_id){
		$sql = "SELECT lo.location_id, lo.location_name FROM " . DB_PREFIX . "doctor_to_area l INNER JOIN " . DB_PREFIX . "doctor d ON (l.doctor_id = d.doctor_id) INNER JOIN " . DB_PREFIX . "location lo ON (l.area_id = lo.location_id) WHERE l.doctor_id = '".$doctor_id."' GROUP BY lo.location_id";
		$query = $this->db->query($sql);
		return $query->rows;
	}
}