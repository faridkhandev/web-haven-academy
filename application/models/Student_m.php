<?php
class Student_m extends MY_Model
{
	public function addRequest($data) {
		$this->db->query("INSERT INTO bh_student_withdrawal_request SET user_id = '" . (int)$data['user_id'] . "', withdrawal_point = '" . $this->db->escape($data['withdrawal_point']) . "', approve_status = '" . $this->db->escape($data['approve_status']) . "', withdrawal_message = '" . $this->db->escape($data['withdrawal_message']) . "', payment_medium = '" . $this->db->escape($data['payment_medium']) . "', point_value = '".$this->config->get('config_subadmin_money_conversion')."', requested_at = '".date('Y-m-d H:i:s')."'");
		
		return $this->db->getLastId();
	}
	
	public function managePoint($data) {
		$last_record = $this->getPassbookLastRecord($data['student_id']);
		if(!empty($last_record)){
			$current_balance_point = $last_record['balance_point'];
		}else{
			$current_balance_point = 0;
		}
		
		if($data['type']=='Credit'){
			$balance_point = $current_balance_point+$data['credit_point'];
		}else{
			$balance_point = $current_balance_point-$data['debit_point'];
		}
		
		//$data['type'] = $balance_point;
		$data['balance_point'] = $balance_point;
		$data['created_at'] = date('Y-m-d H:i:s');
		
		$this->db->insert('bh_student_passbook', $data);
		
		$this->db->where('id', $data['student_id']);
		$this->db->update('bh_student', array('student_point'=>$balance_point));
		
		return $this->db->insert_id();
	}
	
	public function getPassbookLastRecord($student_id) {
		$query = $this->db->query("SELECT * FROM bh_student_passbook WHERE student_id = '" . (int)$student_id . "' ORDER BY id DESC LIMIT 1");
		return $query->row_array();
	}
	
	public function getStudentTotalCreditPoint($student_id) {
		$query = $this->db->query("SELECT sum(credit_point) as total_credit_point FROM `bh_student_passbook` WHERE student_id = '" . $student_id . "' AND type='Credit'");
		$row = $query->row_array();
		return isset($row['total_credit_point'])?$row['total_credit_point']:0;
	}
	
	public function getStudentTotalDebitPoint($student_id) {
		$query = $this->db->query("SELECT sum(debit_point) as total_debit_point FROM `bh_student_passbook` WHERE student_id = '" . $student_id . "' AND type='Debit'");
		$row = $query->row_array();
		return isset($row['total_debit_point'])?$row['total_debit_point']:0;
	}
	
	public function getStudentTotalWithdrawalRequestPoint($student_id) {
		$query = $this->db->query("SELECT sum(withdrawal_point) as total_withdrawal_point FROM `bh_student_withdrawal_request` WHERE student_id = '" . $student_id . "' AND approve_status='Pending'");
		$row = $query->row_array();
		return isset($row['total_withdrawal_point'])?$row['total_withdrawal_point']:0;
	}
	
	public function getStudentPoint($student_id) {
		//echo "SELECT * FROM bh_student_passbook WHERE student_id = '" . $student_id . "' ORDER BY created_at DESC LIMIT 1";
		$query = $this->db->query("SELECT * FROM bh_student_passbook WHERE student_id = '" . $student_id . "' ORDER BY created_at DESC LIMIT 1");
		$row = $query->row_array();
		return isset($row['balance_point'])?$row['balance_point']:0;
	}
}