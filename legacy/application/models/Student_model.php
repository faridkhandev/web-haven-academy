<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student_model extends CI_Model {
	public $columns = array('s.student_name', 's.student_email', 's.student_phone', 's.student_whatsapp', 's.student_gender', 's.created_at', 's.student_status');
	
	public $wcolumns = array('swr.id','swr.withdrawal_point','swr.approve_status', 'swr.requested_at', 'swr.approve_at', 'swr.cancelled_at');
	
	public $pcolumns = array('reason', 'credit_point','debit_point','balance_point', 'created_at', 'description');
	
	public function getReferItems($data = array()) {
		$sql = "SELECT id FROM bh_student WHERE student_delete_status = '0'";
		if (!empty($data['filter_refer_id'])) {
			$sql .=" AND refer_id = '".(int)$data['filter_refer_id']."'";
		}
		if (isset($data['filter_status'])) {
			$sql .=" AND student_status = '".(int)$data['filter_status']."'";
		}
		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows();
		
		$sql = "SELECT s.id, s.student_name, s.student_no, s.student_phone, s.student_whatsapp, s.student_gender, s.created_at, s.student_status, sc.whatsapp_status FROM bh_student s LEFT JOIN bh_student_to_counsellor sc ON s.id = sc.student_id WHERE s.student_delete_status = '0'";
		if (!empty($data['filter_refer_id'])) {
			$sql .=" AND s.refer_id = '".(int)$data['filter_refer_id']."'";
		}
		
		if (isset($data['filter_status'])) {
			$sql .=" AND s.student_status = '".(int)$data['filter_status']."'";
		}
		
		if (!empty($data['filter_start_date']) && !empty($data['filter_end_date'])) {
			$sql .= " AND (DATE(s.created_at) BETWEEN DATE('" . $data['filter_start_date'] . "') AND DATE('" . $data['filter_end_date'] . "'))";
		}elseif (!empty($data['filter_start_date'])) {
			$sql .= " AND DATE(s.created_at) >= DATE('" . $data['filter_start_date'] . "')";
		}elseif (!empty($data['filter_end_date'])) {
			$sql .= " AND DATE(s.created_at) <= DATE('" . $data['filter_end_date'] . "')";
		}
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->columns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY s.created_at DESC";
		}
		//echo $sql;
		$query = $this->db->query($sql);
		$recordsFiltered = (int)$query->num_rows();
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
		$result = $query->result_array();
		return array('recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered, 'result' => $result);
	}
	
	public function getWithdrawalItems($data = array()) {
		$sql = "SELECT id FROM bh_student_withdrawal_request WHERE 1=1";
		if (!empty($data['filter_student_id'])) {
			$sql .=" AND student_id = '".(int)$data['filter_student_id']."'";
		}
		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows();
		
		$sql = "SELECT swr.*, s.student_no, s.student_name FROM bh_student_withdrawal_request swr INNER JOIN bh_student s ON swr.student_id=s.id";
		
		
		$sql .= " WHERE 1=1";
		
		if (!empty($data['filter_student_id'])) {
			$sql .= " AND swr.student_id = '" . (int)$data['filter_student_id'] . "'";
		}
		
		if (!empty($data['filter_student_no'])) {
			$sql .= " AND s.student_no = '" . $data['filter_student_no'] . "'";
		}
		
		if (!empty($data['filter_approve_status'])) {
			$sql .= " AND swr.approve_status = '" . $data['filter_approve_status'] . "'";
		}
		
		if (!empty($data['filter_start_date']) && !empty($data['filter_end_date'])) {
			$sql .= " AND (DATE(swr.requested_at) BETWEEN DATE('" . $data['filter_start_date'] . "') AND DATE('" . $data['filter_end_date'] . "'))";
		}elseif (!empty($data['filter_start_date'])) {
			$sql .= " AND DATE(swr.requested_at) >= DATE('" . $data['filter_start_date'] . "')";
		}elseif (!empty($data['filter_end_date'])) {
			$sql .= " AND DATE(swr.requested_at) <= DATE('" . $data['filter_end_date'] . "')";
		}
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->wcolumns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY swr.requested_at DESC";
		}
		
		$query = $this->db->query($sql);
		$recordsFiltered = (int)$query->num_rows();
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
		$result = $query->result_array();
		return array('recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered, 'result' => $result);
	}
	
	public function getSellPointItems($data = array()) {
		$sql = "SELECT id FROM point_hold WHERE 1=1";
		if (!empty($data['filter_student_id'])) {
			$sql .=" AND student_id = '".(int)$data['filter_student_id']."'";
		}
		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows();
		
		$sql = "SELECT swr.*, s.student_no, s.student_name, u.username FROM point_hold swr INNER JOIN bh_student s ON swr.student_id=s.id INNER JOIN bh_user u ON swr.user_id=u.user_id";
		
		
		$sql .= " WHERE 1=1";
		
		if (!empty($data['filter_student_id'])) {
			$sql .= " AND swr.student_id = '" . (int)$data['filter_student_id'] . "'";
		}
		
		if (!empty($data['filter_student_no'])) {
			$sql .= " AND s.student_no = '" . $data['filter_student_no'] . "'";
		}
		
		if (!empty($data['filter_approve_status'])) {
			$sql .= " AND swr.approve_status = '" . $data['filter_approve_status'] . "'";
		}
		
		if (!empty($data['filter_start_date']) && !empty($data['filter_end_date'])) {
			$sql .= " AND (DATE(swr.requested_at) BETWEEN DATE('" . $data['filter_start_date'] . "') AND DATE('" . $data['filter_end_date'] . "'))";
		}elseif (!empty($data['filter_start_date'])) {
			$sql .= " AND DATE(swr.requested_at) >= DATE('" . $data['filter_start_date'] . "')";
		}elseif (!empty($data['filter_end_date'])) {
			$sql .= " AND DATE(swr.requested_at) <= DATE('" . $data['filter_end_date'] . "')";
		}
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->wcolumns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY swr.requested_at DESC";
		}
		
		$query = $this->db->query($sql);
		$recordsFiltered = (int)$query->num_rows();
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
		$result = $query->result_array();
		return array('recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered, 'result' => $result);
	}

   public function getPassbookItems($data = array()) {
		$sql = "SELECT id FROM bh_student_passbook WHERE 1=1";
		if (!empty($data['filter_student_id'])) {
			$sql .=" AND student_id = '".(int)$data['filter_student_id']."'";
		}
		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows();
		
		$sql = "SELECT * FROM bh_student_passbook";
		
		
		$sql .= " WHERE 1=1";
		
		if (!empty($data['filter_student_id'])) {
			$sql .= " AND student_id = '" . (int)$data['filter_student_id'] . "'";
		}
		
		if (!empty($data['filter_reason'])) {
			$sql .= " AND reason LIKE '%" . $data['filter_reason'] . "%'";
		}
		
		if (!empty($data['filter_type'])) {
			$sql .= " AND type = '" . $data['filter_type'] . "'";
		}
		
		if (!empty($data['filter_start_date']) && !empty($data['filter_end_date'])) {
			$sql .= " AND (DATE(created_at) BETWEEN DATE('" . $data['filter_start_date'] . "') AND DATE('" . $data['filter_end_date'] . "'))";
		}elseif (!empty($data['filter_start_date'])) {
			$sql .= " AND DATE(created_at) >= DATE('" . $data['filter_start_date'] . "')";
		}elseif (!empty($data['filter_end_date'])) {
			$sql .= " AND DATE(created_at) <= DATE('" . $data['filter_end_date'] . "')";
		}
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->pcolumns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY created_at DESC";
		}
		
		$query = $this->db->query($sql);
		$recordsFiltered = (int)$query->num_rows();
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
		$result = $query->result_array();
		return array('recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered, 'result' => $result);
	}

}