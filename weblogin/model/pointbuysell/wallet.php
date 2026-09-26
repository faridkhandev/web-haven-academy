<?php
class ModelPointbuysellWallet extends Model {
	public $buycolumns = array('id','type','point', '', 'created_at');
	public $sellcolumns = array('id','type','point', '', 'created_at');
	
	public function add($data) {
		if($data['account_type'] == 'Buy'){
			$this->db->query("INSERT INTO point_buy SET user_id = '" . (int)$data['user_id'] . "', reason = '" . $this->db->escape($data['reason']) . "', point = '" . $this->db->escape($data['point']) . "', type = '" . $this->db->escape($data['type']) . "', created_at = '".date('Y-m-d H:i:s')."'");
		}
		
		if($data['account_type'] == 'Sell'){
			$this->db->query("INSERT INTO point_sell SET user_id = '" . (int)$data['user_id'] . "', student_id = 0, reason = '" . $this->db->escape($data['reason']) . "', point = '" . $this->db->escape($data['point']) . "', type = '" . $this->db->escape($data['type']) . "', created_at = '".date('Y-m-d H:i:s')."'");
		}
		return $this->db->getLastId();
	}
	
	public function getLastRecord($user_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user_passbook WHERE user_id = '" . (int)$user_id . "' ORDER BY id DESC LIMIT 1");
		return $query->row;
	}
	
	public function pointBuySummeryByUser($user_id) {
		$sql = "SELECT SUM(COALESCE(CASE WHEN type = '1' THEN point END,0)) total_credits, SUM(COALESCE(CASE WHEN type = '2' THEN point END,0)) total_debits, SUM(COALESCE(CASE WHEN type = '1' THEN point END,0)) - SUM(COALESCE(CASE WHEN type = '2' THEN point END,0)) balance FROM point_buy WHERE user_id = '" . (int)$user_id . "'";
		$query = $this->db->query($sql);
		return $query->row;
	}
	
	public function pointSellSummeryByUser($user_id) {
		$sql = "SELECT SUM(COALESCE(CASE WHEN type = '1' THEN point END,0)) total_credits, SUM(COALESCE(CASE WHEN type = '2' THEN point END,0)) total_debits, SUM(COALESCE(CASE WHEN type = '1' THEN point END,0)) - SUM(COALESCE(CASE WHEN type = '2' THEN point END,0)) balance FROM point_sell WHERE user_id = '" . (int)$user_id . "'";
		$query = $this->db->query($sql);
		return $query->row;
	}
	
	public function pointBuyList() {
		$sql = "SELECT SUM(COALESCE(CASE WHEN type = '1' THEN point END,0)) total_credits, SUM(COALESCE(CASE WHEN type = '2' THEN point END,0)) total_debits, SUM(COALESCE(CASE WHEN type = '1' THEN point END,0)) - SUM(COALESCE(CASE WHEN type = '2' THEN point END,0)) balance FROM point_buy GROUP BY user_id";
		$query = $this->db->query($sql);
		return $query->rows;
	}
	
	public function pointSellList() {
		$sql = "SELECT SUM(COALESCE(CASE WHEN type = '1' THEN point END,0)) total_credits, SUM(COALESCE(CASE WHEN type = '2' THEN point END,0)) total_debits, SUM(COALESCE(CASE WHEN type = '1' THEN point END,0)) - SUM(COALESCE(CASE WHEN type = '2' THEN point END,0)) balance FROM point_sell GROUP BY user_id";
		$query = $this->db->query($sql);
		return $query->rows;
	}
	
	public function getBuyItems($data = array()) {
		//print_r($data);
		$query = $this->db->query("SELECT id FROM point_buy WHERE user_id='" . $this->db->escape($data['filter_user_id']) . "'");
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT pb.*, s.student_no, s.student_name FROM point_buy pb LEFT JOIN bh_student s ON pb.student_id = s.id WHERE pb.user_id='" . $this->db->escape($data['filter_user_id']) . "'";
		
		if (!empty($data['filter_type'])) {
			$sql .= " AND pb.type = '" . $this->db->escape($data['filter_type']) . "'";
		}
		
		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(pb.created_at) >= '" . $this->db->escape($data['filter_date_added']) . "'";
		}

		if (!empty($data['filter_date_ended'])) {
			$sql .= " AND DATE(pb.created_at) <= '" . $this->db->escape($data['filter_date_ended']) . "'";
		}
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->buycolumns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY pb.created_at DESC";
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
	
	public function getSellItems($data = array()) {
		//print_r($data);
		$query = $this->db->query("SELECT id FROM point_sell WHERE user_id='" . $this->db->escape($data['filter_user_id']) . "'");
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT ps.*, s.student_no, s.student_name FROM point_sell ps LEFT JOIN bh_student s ON ps.student_id = s.id WHERE ps.user_id='" . $this->db->escape($data['filter_user_id']) . "'";
		
		if (!empty($data['filter_type'])) {
			$sql .= " AND ps.type = '" . $this->db->escape($data['filter_type']) . "'";
		}
		
		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(ps.created_at) >= '" . $this->db->escape($data['filter_date_added']) . "'";
		}

		if (!empty($data['filter_date_ended'])) {
			$sql .= " AND DATE(ps.created_at) <= '" . $this->db->escape($data['filter_date_ended']) . "'";
		}
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->sellcolumns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY ps.created_at DESC";
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