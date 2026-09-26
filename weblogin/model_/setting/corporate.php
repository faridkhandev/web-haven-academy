<?php
class ModelSettingCorporate extends Model {
	public $columns = array('id','name', 'domain', 'discount_percentage', 'status', 'date_added');
	public function add($data) {
		/* print_r($data);exit(); */
		$this->db->query("INSERT INTO " . DB_PREFIX . "corporate_list SET name = '" . $this->db->escape($data['name']) . "', domain = '" . $this->db->escape($data['domain']) . "', discount_percentage = '" . (float)$data['discount_percentage'] . "', status = '" . (int)$data['status'] . "', date_added = NOW()");
		
		$id = $this->db->getLastId();
		
		return $id;
	}
	
	public function edit($id,$data) {
		/* echo "UPDATE " . DB_PREFIX . "corporate_list SET name = '" . $this->db->escape($data['name']) . "', domain = '" . $this->db->escape($data['domain']) . "',discount_percentage = '" . (float)$data['discount_percentage'] . "', status = '" . (int)$data['status'] . "', WHERE id = '" . (int)$id . "'";exit(); */
		$this->db->query("UPDATE " . DB_PREFIX . "corporate_list SET name = '" . $this->db->escape($data['name']) . "', domain = '" . $this->db->escape($data['domain']) . "',discount_percentage = '" . (float)$data['discount_percentage'] . "', status = '" . (int)$data['status'] . "' WHERE id = '" . (int)$id . "'");
	}
	 
	public function copy($id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "corporate_list WHERE id = '" . (int)$id . "'");

		if ($query->num_rows) {
			$data = $query->row;
			$data['status'] = '0';
			$this->add($data);
		}
	}
	
	public function delete($id) {
		$this->db->query("UPDATE " . DB_PREFIX . "corporate_list SET delete_status = '1' WHERE id = '" . (int)$id . "'");
	}
	
	public function getItem($id) {
		$query = $this->db->query("SELECT DISTINCT p.* FROM " . DB_PREFIX . "corporate_list p WHERE p.id = '" . (int)$id . "' AND delete_status = '0'");

		return $query->row;
	}
	
	public function getItemByDomain($domain) {
		$query = $this->db->query("SELECT DISTINCT p.* FROM " . DB_PREFIX . "corporate_list p WHERE p.domain = '" . $domain . "' AND status = '1' AND delete_status = '0'");

		return $query->row;
	}
	
	public function getItems($data = array()) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "corporate_list WHERE delete_status=0");
		$recordsTotal = (int)$query->num_rows;
		$sql = "SELECT * FROM " . DB_PREFIX . "corporate_list WHERE delete_status=0";
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "name LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}
			}

			$sql .= ")";
		}

		if (isset($data['filter_domain']) && !is_null($data['filter_domain'])) {
			$sql .= " AND domain LIKE '%" . $data['filter_domain'] . "%'";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND status = '" . $data['filter_status'] . "'";
		}
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->columns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY date_added";
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
	}

	public function getTotalItems($data = array()) {
		$sql = "SELECT COUNT(DISTINCT p.id) AS total FROM " . DB_PREFIX . "corporate_list p WHERE delete_status = '0'";


		if (!empty($data['filter_name'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "p.name LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}
			}

			$sql .= ")";
		}

		if (isset($data['filter_domain']) && !is_null($data['filter_domain'])) {
			$sql .= " AND p.domain = '" . $data['filter_domain'] . "'";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . $data['filter_status'] . "'";
		}
		
		$query = $this->db->query($sql);

		return $query->row['total'];
	}
}	