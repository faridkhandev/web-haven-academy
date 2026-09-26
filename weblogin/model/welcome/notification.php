<?php
class ModelWelcomeNotification extends Model {
	public $columns = array('id','notifcation','status', 'created_at');

	public function add($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "notification SET status = '" . (int)$data['status'] . "', added_by = '" . (int)$this->user->getId() . "', notifcation = '" . $this->db->escape($data['notifcation']) . "', created_at = '".date('Y-m-d H:i:s')."'");
		
		$id = $this->db->getLastId();
		return $id;
	}
	
	public function edit($id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "notification SET status = '" . (int)$data['status'] . "', notifcation = '" . $this->db->escape($data['notifcation']) . "' WHERE id = '" . (int)$id . "'");
	}
	
	public function get($id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "notification WHERE id = '" . (int)$id . "'");

		return $query->row;
	}
	
	public function delete($id) {
		$query = $this->db->query("DELETE FROM " . DB_PREFIX . "notification WHERE id = '" . (int)$id . "'");

		return $query->row;
	}
	
	public function getItems($data = array()) {
		//print_r($data);
		$query = $this->db->query("SELECT id FROM " . DB_PREFIX . "notification");
		$recordsTotal = (int)$query->num_rows;
		$sql = "SELECT * FROM " . DB_PREFIX . "notification WHERE 1=1";
		
		if (!empty($data['filter_status'])) {
			$sql .= " AND status = '" . $this->db->escape($data['filter_status']) . "'";
		}
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND notifcation LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
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