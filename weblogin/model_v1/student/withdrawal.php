<?php
class ModelStudentWithdrawal extends Model {
	public $columns = array('swr.id','s.student_no','s.student_name','swr.withdrawal_point','swr.approve_status', 'swr.requested_at', 'swr.approve_at', 'swr.cancelled_at');
	
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
		$this->db->query("UPDATE " . DB_PREFIX . "student_withdrawal_request SET approve_status = '" . $data['approve_status'] . "', admin_message = '" . $data['admin_message'] . "', approve_at = '" . $approve_at . "', cancelled_at = '" . $cancelled_at . "', action_user_id = '" . $this->user->getId() . "' WHERE id='".$id."'");
		
		return $this->db->getLastId();
	}
	
	public function getItems($data = array()) {
		//print_r($data);
		$query = $this->db->query("SELECT id FROM " . DB_PREFIX . "student_withdrawal_request");
		
		$recordsTotal = (int)$query->num_rows;
		$sql = "SELECT swr.*, s.student_no, s.student_name FROM " . DB_PREFIX . "student_withdrawal_request swr INNER JOIN " . DB_PREFIX . "student s ON swr.student_id=s.id";
		
		
		$sql .= " WHERE 1=1";
		
		if (!empty($data['filter_student_no'])) {
			$sql .= " AND s.student_no = '" . $this->db->escape($data['filter_student_no']) . "'";
		}
		
		if (!empty($data['filter_approve_status'])) {
			$sql .= " AND swr.approve_status = '" . $this->db->escape($data['filter_approve_status']) . "'";
		}
		
		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(swr.requested_at) >= '" . $this->db->escape($data['filter_date_added']) . "'";
		}

		if (!empty($data['filter_date_ended'])) {
			$sql .= " AND DATE(swr.requested_at) <= '" . $this->db->escape($data['filter_date_ended']) . "'";
		}
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->columns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY swr.requested_at DESC";
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