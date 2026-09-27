<?php
class ModelLocalisationCountry extends Model {
	public $columns = array('country_id', 'name', 'iso_code_2', 'iso_code_3', 'status');
	public function add($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "country SET name = '" . $this->db->escape($data['name']) . "', iso_code_2 = '" . $this->db->escape($data['iso_code_2']) . "', iso_code_3 = '" . $this->db->escape($data['iso_code_3']) . "', address_format = '" . $this->db->escape($data['address_format']) . "', country_flag = '" . $this->db->escape($data['country_flag']) . "', country_phone_code = '" . $this->db->escape($data['country_phone_code']) . "', postcode_required = '" . (int)$data['postcode_required'] . "', status = '" . (int)$data['status'] . "'");

		$this->cache->delete('country');
	}

	public function edit($country_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "country SET name = '" . $this->db->escape($data['name']) . "', iso_code_2 = '" . $this->db->escape($data['iso_code_2']) . "', iso_code_3 = '" . $this->db->escape($data['iso_code_3']) . "', address_format = '" . $this->db->escape($data['address_format']) . "', country_flag = '" . $this->db->escape($data['country_flag']) . "', country_phone_code = '" . $this->db->escape($data['country_phone_code']) . "', postcode_required = '" . (int)$data['postcode_required'] . "', status = '" . (int)$data['status'] . "' WHERE country_id = '" . (int)$country_id . "'");

		$this->cache->delete('country');
	}

	public function deleteCountry($country_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "country WHERE country_id = '" . (int)$country_id . "'");

		$this->cache->delete('country');
	}

	public function getCountry($country_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "country WHERE country_id = '" . (int)$country_id . "'");

		return $query->row;
	}
	
	public function getItems($data = array()) {
		if ($data) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "country");
			$recordsTotal = (int)$query->num_rows;
			
			$sql = "SELECT * FROM " . DB_PREFIX . "country WHERE delete_status=0";

			$implode = array();
			
			if (!empty($data['filter_name'])) {
				$implode[] = "name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
			}
			
			if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
				$implode[] = "status = '" . (int)$data['filter_status'] . "'";
			}
			
			if ($implode) {
				$sql .= " AND " . implode(" AND ", $implode);
			}

			if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
				$sql .= " ORDER BY " . $this->columns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
			} else {
				$sql .= " ORDER BY name ASC";
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

			$query = $this->db->query($sql);
			$result = $query->rows;

			return array('recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered, 'result' => $result);
		} else {
			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country`");
			return $query->rows;
		}
	}

	public function getCountries($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "country";

			$sort_data = array(
				'name',
				'iso_code_2',
				'iso_code_3'
			);

			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY name";
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
		} else {
			$country_data = $this->cache->get('country');

			if (!$country_data) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "country ORDER BY name ASC");

				$country_data = $query->rows;

				$this->cache->set('country', $country_data);
			}

			return $country_data;
		}
	}

	public function getTotalCountries() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "country");

		return $query->row['total'];
	}
}