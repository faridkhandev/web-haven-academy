<?php
class ModelUserWithdrawal extends Model {
	public $columns = array('uph.id','ue.user_no','u.firstname','ug.name','uph.withdrawal_point','uph.payment_medium', 'uph.approve_status', 'uph.requested_at', 'uph.approve_at', 'uph.cancelled_at');
	public function add($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "user_withdrawal_request SET user_id = '" . (int)$data['user_id'] . "', withdrawal_point = '" . $this->db->escape($data['withdrawal_point']) . "', approve_status = '" . $this->db->escape($data['approve_status']) . "', withdrawal_message = '" . $this->db->escape($data['withdrawal_message']) . "', payment_medium = '" . $this->db->escape($data['payment_medium']) . "', point_value = '".$this->config->get('config_subadmin_money_conversion')."', requested_at = '".date('Y-m-d H:i:s')."'");
		
		return $this->db->getLastId();
	}
	public function edit($id, $data) {
		if(	$data['approve_status'] =='Paid'){
			$approve_at = date('Y-m-d H:i:s');
		}else{
			$approve_at = '';
		}
		if(	$data['approve_status'] =='Cancel'){
			$cancelled_at = date('Y-m-d H:i:s');
		}else{
			$cancelled_at = '';
		}
		$this->db->query("UPDATE " . DB_PREFIX . "user_withdrawal_request SET approve_status = '" . $data['approve_status'] . "', admin_message = '" . $data['admin_message'] . "', approve_at = '" . $approve_at . "', cancelled_at = '" . $cancelled_at . "', action_user_id = '" . $this->user->getId() . "' WHERE id='".$id."'");
		
		return $this->db->getLastId();
	}
	
	public function getItems($data = array()) {
		//print_r($data);
		$query = $this->db->query("SELECT id FROM " . DB_PREFIX . "user_withdrawal_request");
		
		$recordsTotal = (int)$query->num_rows;
		$sql = "SELECT uph.*, ue.user_no, u.firstname, u.lastname, ug.name as user_group FROM " . DB_PREFIX . "user_withdrawal_request uph INNER JOIN " . DB_PREFIX . "user u ON uph.user_id=u.user_id INNER JOIN " . DB_PREFIX . "user_extra ue ON u.user_id=ue.user_id INNER JOIN " . DB_PREFIX . "user_group ug ON u.user_group_id=ug.user_group_id";
		
		
		$sql .= " WHERE 1=1";
		
		if (!empty($data['filter_user'])) {
			$sql .= " AND uph.user_id = '" . $this->db->escape($data['filter_user']) . "'";
		}
		
		if (!empty($data['filter_user_group'])) {
			$sql .= " AND u.user_group_id = '" . $this->db->escape($data['filter_user_group']) . "'";
		}
		
		if (!empty($data['filter_status'])) {
			$sql .= " AND uph.approve_status = '" . $this->db->escape($data['filter_status']) . "'";
		}
		
		if (!empty($data['filter_user_no'])) {
			$sql .= " AND ue.user_no = '" . $this->db->escape($data['filter_user_no']) . "'";
		}
		
		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(uph.requested_at) >= '" . $this->db->escape($data['filter_date_added']) . "'";
		}

		if (!empty($data['filter_date_ended'])) {
			$sql .= " AND DATE(uph.requested_at) <= '" . $this->db->escape($data['filter_date_ended']) . "'";
		}
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->columns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY uph.requested_at DESC";
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