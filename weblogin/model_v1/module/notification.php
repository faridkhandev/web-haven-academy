<?php
class ModelModuleNotification extends Model {
	public $columns = array('n.notification_id','d.doctor_name','n.description', 'di.investment_amount', 'di.limit_amount', 'n.date_added');

	public function add($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "notification SET doctor_investment_id = '" . (int)$data['doctor_investment_id'] . "', description = '" . $this->db->escape($data['description']) . "', date_added = '".date('Y-m-d H:i:s')."'");
		
		$notification_id = $this->db->getLastId();
		return $notification_id;
	}
	
	public function get($notification_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "notification WHERE notification_id = '" . (int)$notification_id . "'");

		return $query->row;
	}
	
	public function getItems($data = array()) {
		//print_r($data);
		$query = $this->db->query("SELECT notification_id FROM " . DB_PREFIX . "notification WHERE delete_status=0");
		$recordsTotal = (int)$query->num_rows;
		$sql = "SELECT n.*, d.doctor_name FROM " . DB_PREFIX . "notification n INNER JOIN " . DB_PREFIX . "doctor_investment di ON n.doctor_investment_id=di.doctor_investment_id INNER JOIN " . DB_PREFIX . "doctor d ON di.doctor_id=d.doctor_id";
		
		
		$sql = " WHERE n.delete_status=0";
		
		if (!empty($data['filter_id'])) {
			$sql .= " AND di.doctor_id = '" . $this->db->escape($data['filter_id']) . "'";
		}
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND d.doctor_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_start_date'])) {
			$sql .= " AND DATE(n.date_added) >= '" . $this->db->escape($data['filter_date_start']) . "'";
		}

		if (!empty($data['filter_date_end'])) {
			$sql .= " AND DATE(n.date_added) <= '" . $this->db->escape($data['filter_date_end']) . "'";
		}
		
		$sql .= " GROUP BY n.notification_id";
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->columns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY n.notification_id DESC";
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