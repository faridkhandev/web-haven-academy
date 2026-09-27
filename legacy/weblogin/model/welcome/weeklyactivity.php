<?php
class ModelWelcomeWeeklyactivity extends Model {
	public $columns = array('id','name', 'description','status', 'created_at');

	public function add($data) {
		$this->db->query("INSERT INTO weekly_activity SET status = '" . (int)$data['status'] . "', name = '" . $this->db->escape($data['name']) . "', image = '" . $this->db->escape($data['image']) . "', description = '" . $this->db->escape($data['description']) . "', created_at = '".date('Y-m-d H:i:s')."'");
		
		$id = $this->db->getLastId();
		return $id;
	}
	
	public function edit($id, $data) {
		$this->db->query("UPDATE weekly_activity SET status = '" . (int)$data['status'] . "', name = '" . $this->db->escape($data['name']) . "', image = '" . $this->db->escape($data['image']) . "', description = '" . $this->db->escape($data['description']) . "' WHERE id = '" . (int)$id . "'");
	}
	
	public function get($id) {
		$query = $this->db->query("SELECT DISTINCT * FROM weekly_activity WHERE id = '" . (int)$id . "'");

		return $query->row;
	}
	
	public function delete($id) {
		$query = $this->db->query("DELETE FROM weekly_activity WHERE id = '" . (int)$id . "'");

		return $query->row;
	}
	
	public function getItems($data = array()) {
		//print_r($data);
		$query = $this->db->query("SELECT id FROM weekly_activity");
		$recordsTotal = (int)$query->num_rows;
		$sql = "SELECT * FROM weekly_activity WHERE 1=1";
		
		if (!empty($data['filter_status'])) {
			$sql .= " AND status = '" . $this->db->escape($data['filter_status']) . "'";
		}
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->columns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY id DESC";
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