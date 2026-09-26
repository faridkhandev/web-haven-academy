<?php
class ModelStudentStudent extends Model {
	public $mycolumns = array('s.id', 's.student_no', 's.student_name', 's.student_phone', 's.student_email', 's.student_whatsapp', 's.student_gender', 's.student_city', 's.student_country', 's.student_language', 's.created_at');
	public $columns = array('s.id', 's.student_no', 's.student_name', 's.student_phone', 's.student_email', 's.student_point', 's1.student_refer_name', 'u.firstname', 's.activated_at');
	public $inactivecolumns = array('s.id', 's.student_no', 's.student_name', 's.student_phone', 's.student_email', 's.student_whatsapp', 's.student_language', 's1.student_refer_name', 'u.firstname', 's.created_at');
	public $counsellorcolumns = array('s.id', 's.student_no', 's.student_name', 's.student_phone', 's.student_email', 's.student_whatsapp', 's.student_gender', 's.student_city', 's.student_country', 's.student_language', 's.student_point','s1.student_refer_name', 's.created_at');

	public function edit($id,$data) {
		$str = "UPDATE `" . DB_PREFIX . "student` SET ";
		$arr = [];
		foreach($data as $key => $value){	
			/* if($value != ''){
				$arr[] = $key.'="'.$value.'"';
			} */
			$arr[] = $key.'="'.$value.'"';
		}
		$str .= implode(',', $arr);
		$str .= " WHERE id = '" . (int)$id . "'";	
		//echo $str;exit;	
		$this->db->query($str);
		return $this->db->countAffected();
	}
	
	public function saveStudentTrainer($id,$data) {
		$student = $this->get($id);
		if($student['link_user_id'] != $data['link_user_id']){
			$data['link_user_at'] = date('Y-m-d H:i:s');
		}
		
		$str = "UPDATE `" . DB_PREFIX . "student` SET ";
		$arr = [];
		foreach($data as $key => $value){
			$arr[] = $key.'="'.$value.'"';
		}
		$str .= implode(',', $arr);
		$str .= " WHERE id = '" . (int)$id . "'";	
		//echo $str;exit;	
		$this->db->query($str);
		return $this->db->countAffected();
	}

	public function updatePassword($id, $password) {
		$this->db->query("UPDATE `" . DB_PREFIX . "student` set student_password = '" . $this->db->escape(md5($password)) . "' WHERE id = '" . (int)$id . "'");
	}
	
	public function getStudentPaymentMedium($student_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "student_payment_medium` WHERE student_id = '" . $student_id . "'");

		return $query->rows;
	}
	
	public function updatePaymentMedium($student_id, $payment_medium) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "student_payment_medium WHERE student_id = '" . (int)$student_id . "'");
		if(isset($payment_medium)){
			foreach($payment_medium as $item){
				$this->db->query("INSERT INTO " . DB_PREFIX . "student_payment_medium SET student_id = '" . (int)$student_id . "', medium_name = '" . $this->db->escape($item['medium_name']) . "', medium_code = '" . $this->db->escape($item['medium_code']) . "', medium_status = '" . $this->db->escape($item['medium_status']) . "'");
			}
		}
	}
	
	public function delete($id) {
		$this->db->query("UPDATE `" . DB_PREFIX . "student` set student_delete_status = 1, deleted_at='".date('Y-m-d H:i:s')."', deleted_by='".$this->user->getId()."' WHERE id = '" . (int)$id . "'");
	}

	public function get($id) {
		$query = $this->db->query("SELECT s.*, u.firstname, u.lastname, u.email, ue.user_no, s1.student_name as refer_student_name, s1.student_no as refer_student_no FROM `" . DB_PREFIX . "student` s LEFT JOIN " . DB_PREFIX . "user u ON u.user_id = s.link_user_id LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id LEFT JOIN " . DB_PREFIX . "student s1 ON s.refer_id = s1.id WHERE s.id = '" . (int)$id . "'");

		return $query->row;
	}
	
	/* public function getUserByGroup($id, ) {
		$query = $this->db->query("SELECT u.*, ue.*, ug.name FROM `" . DB_PREFIX . "user` u INNER JOIN " . DB_PREFIX . "user_group ug ON u.user_group_id = ug.user_group_id WHERE u.id = '" . (int)$id . "'");

		return $query->row;
	} */

	public function getStudentByPhone($student_phone) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "student` WHERE student_phone = '" . $this->db->escape($student_phone) . "'");

		return $query->row;
	}
	
	public function getStudentByEmail($email) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "student` WHERE student_email = '" . $this->db->escape($email) . "'");

		return $query->row;
	}

	public function getStudentByNo($code) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "student` WHERE student_no = '" . $this->db->escape($code) . "'");

		return $query->row;
	}
	
	public function getItems($data = array()) {
		//print_r($data);
		$sql = "SELECT id FROM " . DB_PREFIX . "student WHERE student_delete_status=0";
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND student_status = '" . $data['filter_status'] . "'";
		}
		
		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT s.*, u.firstname, u.lastname, u.email, ue.user_no, s1.student_name as refer_student_name, s1.student_no as refer_student_no FROM `" . DB_PREFIX . "student` s LEFT JOIN " . DB_PREFIX . "user u ON u.user_id = s.link_user_id LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id LEFT JOIN " . DB_PREFIX . "student s1 ON s.refer_id = s1.id";
		
		$sql .= " WHERE s.student_delete_status=0";
		
		if (isset($data['filter_search']) && !is_null($data['filter_search'])) {
			$sql .= " AND (s.student_name LIKE '%" . $data['filter_search'] . "%' OR s.student_no LIKE '%" . $data['filter_search'] . "%' OR s.student_phone LIKE '" . $data['filter_search'] . "' OR s.student_email LIKE '" . $data['filter_search'] . "' OR s.student_gender LIKE '" . $data['filter_search'] . "' OR u.firstname LIKE '" . $data['filter_search'] . "' OR s1.student_name LIKE '" . $data['filter_search'] . "' OR s1.student_no LIKE '" . $data['filter_search'] . "' OR DATE(s.activated_at) = '" . $data['filter_search'] . "' OR DATE(s.created_at) = '" . $data['filter_search'] . "')";
		}
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND s.student_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_phone'])) {
			$sql .= " AND s.student_phone LIKE '%" . $this->db->escape($data['filter_phone']) . "%'";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND s.student_status = '" . $data['filter_status'] . "'";
		}
		
		if (isset($data['filter_student_no']) && !is_null($data['filter_student_no'])) {
			$sql .= " AND s.student_no = '" . $data['filter_student_no'] . "'";
		}
		
		if (isset($data['filter_user_no']) && !is_null($data['filter_user_no'])) {
			$sql .= " AND ue.user_no = '" . $data['filter_user_no'] . "'";
		}
		
		if (isset($data['filter_refer_no']) && !is_null($data['filter_refer_no'])) {
			$sql .= " AND s1.student_no = '" . $data['filter_refer_no'] . "'";
		}
		
		if (isset($data['filter_refer_id']) && !is_null($data['filter_refer_id'])) {
			$sql .= " AND s.refer_id = '" . $data['filter_refer_id'] . "'";
		}
		
		if (isset($data['filter_link_user_id']) && !is_null($data['filter_link_user_id'])) {
			$sql .= " AND s.link_user_id IN( " . $data['filter_link_user_id'] . ")";
		}
		
		if (!empty($data['filter_email'])) {
			$sql .= " AND s.student_email LIKE '%" . $this->db->escape($data['filter_email']) . "%'";
		}
		
		if (!empty($data['filter_gender'])) {
			$sql .= " AND s.student_gender LIKE '%" . $this->db->escape($data['filter_gender']) . "%'";
		}
		
		if (!empty($data['filter_activated_start_date'])) {
			$sql .= " AND DATE(s.activated_at) >= '" . $this->db->escape($data['filter_activated_start_date']) . "'";
		}

		if (!empty($data['filter_activated_end_date'])) {
			$sql .= " AND DATE(s.activated_at) <= '" . $this->db->escape($data['filter_activated_end_date']) . "'";
		}
		
		if (!empty($data['filter_created_start_date'])) {
			$sql .= " AND DATE(s.created_at) >= '" . $this->db->escape($data['filter_created_start_date']) . "'";
		}

		if (!empty($data['filter_created_end_date'])) {
			$sql .= " AND DATE(s.created_at) <= '" . $this->db->escape($data['filter_created_end_date']) . "'";
		}
		
		$sql .= " GROUP BY s.id";
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->columns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY s.id DESC";
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
	
	public function getMyItems($data = array()) {
		//print_r($data);
		$sql = "SELECT id FROM " . DB_PREFIX . "student WHERE student_delete_status=0";
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND student_status = '" . $data['filter_status'] . "'";
		}
		
		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows;
		
		$sql2 = "SELECT s.id FROM `" . DB_PREFIX . "student` s LEFT JOIN " . DB_PREFIX . "user u ON u.user_id = s.link_user_id LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id LEFT JOIN " . DB_PREFIX . "student s1 ON s.refer_id = s1.id WHERE s.student_delete_status=0";
		
		if (isset($data['filter_link_user_id']) && !is_null($data['filter_link_user_id'])) {
			$sql2 .= " AND s.link_user_id IN( " . $data['filter_link_user_id'] . ")";
		}
		
		$query = $this->db->query($sql2);
		
		$res = $query->rows;
		$student_ids =implode(', ', array_map(function ($res) {
			return $res['id'];
		}, $res));  //all active students ID
		
		
		$ids = [];
		foreach($query->rows as $row){
			$ids[]=$row['id'];
		}
		
		$sql2 = "SELECT s.id FROM `" . DB_PREFIX . "student` s WHERE s.student_delete_status=0 AND s.refer_id IN(".$student_ids.") AND s.student_status = 0";
		$query = $this->db->query($sql2);
		foreach($query->rows as $row){
			$ids[]=$row['id'];
		}
		
		$sql = "SELECT s.*, u.firstname, u.lastname, u.email, ue.user_no, s1.student_name as refer_student_name, s1.student_no as refer_student_no FROM `" . DB_PREFIX . "student` s LEFT JOIN " . DB_PREFIX . "user u ON u.user_id = s.link_user_id LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id LEFT JOIN " . DB_PREFIX . "student s1 ON s.refer_id = s1.id";
		
		$sql .= " WHERE s.student_delete_status=0";
		
		if (isset($data['filter_search']) && !is_null($data['filter_search'])) {
			$sql .= " AND (s.student_name LIKE '%" . $data['filter_search'] . "%' OR s.student_no LIKE '%" . $data['filter_search'] . "%' OR s.student_phone LIKE '" . $data['filter_search'] . "' OR s.student_email LIKE '" . $data['filter_search'] . "' OR s.student_gender LIKE '" . $data['filter_search'] . "' OR u.firstname LIKE '" . $data['filter_search'] . "' OR s1.student_name LIKE '" . $data['filter_search'] . "' OR s1.student_no LIKE '" . $data['filter_search'] . "' OR DATE(s.activated_at) = '" . $data['filter_search'] . "' OR DATE(s.created_at) = '" . $data['filter_search'] . "')";
		}
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND s.student_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_phone'])) {
			$sql .= " AND s.student_phone LIKE '%" . $this->db->escape($data['filter_phone']) . "%'";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND s.student_status = '" . $data['filter_status'] . "'";
		}
		
		if (isset($data['filter_student_no']) && !is_null($data['filter_student_no'])) {
			$sql .= " AND s.student_no = '" . $data['filter_student_no'] . "'";
		}
		
		if (isset($data['filter_user_no']) && !is_null($data['filter_user_no'])) {
			$sql .= " AND ue.user_no = '" . $data['filter_user_no'] . "'";
		}
		
		if (isset($data['filter_refer_no']) && !is_null($data['filter_refer_no'])) {
			$sql .= " AND s1.student_no = '" . $data['filter_refer_no'] . "'";
		}
		
		if (isset($data['filter_refer_id']) && !is_null($data['filter_refer_id'])) {
			$sql .= " AND s.refer_id = '" . $data['filter_refer_id'] . "'";
		}
		
		/* if (isset($data['filter_link_user_id']) && !is_null($data['filter_link_user_id'])) {
			$sql .= " AND s.link_user_id IN( " . $data['filter_link_user_id'] . ")";
		} */
		
		if (!empty($data['filter_email'])) {
			$sql .= " AND s.student_email LIKE '%" . $this->db->escape($data['filter_email']) . "%'";
		}
		
		if (!empty($data['filter_gender'])) {
			$sql .= " AND s.student_gender LIKE '%" . $this->db->escape($data['filter_gender']) . "%'";
		}
		
		if (!empty($data['filter_activated_start_date'])) {
			$sql .= " AND DATE(s.activated_at) >= '" . $this->db->escape($data['filter_activated_start_date']) . "'";
		}

		if (!empty($data['filter_activated_end_date'])) {
			$sql .= " AND DATE(s.activated_at) <= '" . $this->db->escape($data['filter_activated_end_date']) . "'";
		}
		
		if (!empty($data['filter_created_start_date'])) {
			$sql .= " AND DATE(s.created_at) >= '" . $this->db->escape($data['filter_created_start_date']) . "'";
		}

		if (!empty($data['filter_created_end_date'])) {
			$sql .= " AND DATE(s.created_at) <= '" . $this->db->escape($data['filter_created_end_date']) . "'";
		}
		
		if (!empty($data['filter_link_start_date'])) {
			$sql .= " AND DATE(s.link_user_at) >= '" . $this->db->escape($data['filter_link_start_date']) . "'";
		}

		if (!empty($data['filter_link_end_date'])) {
			$sql .= " AND DATE(s.link_user_at) <= '" . $this->db->escape($data['filter_link_end_date']) . "'";
		}
		
		if (!empty($ids)) {
			$sql .= " AND s.id IN(".implode(',', $ids).")";
		}
		
		$sql .= " GROUP BY s.id";
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->mycolumns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY s.id DESC";
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
		return array('recordsTotal' => count($ids), 'recordsFiltered' => $recordsFiltered, 'result' => $result);
	}
	
	public function getSTLItems($data = array()) {
		//print_r($data);
		$sql = "SELECT id FROM " . DB_PREFIX . "student WHERE student_delete_status=0";
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND student_status = '" . $data['filter_status'] . "'";
		}
		
		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows;
		
		$sql2 = "SELECT s.id FROM `" . DB_PREFIX . "student` s LEFT JOIN " . DB_PREFIX . "user u ON u.user_id = s.link_user_id LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id LEFT JOIN " . DB_PREFIX . "student s1 ON s.refer_id = s1.id WHERE s.student_delete_status=0";
		
		if (isset($data['filter_link_user_id']) && !is_null($data['filter_link_user_id'])) {
			$sql2 .= " AND s.link_user_id IN( " . $data['filter_link_user_id'] . ")";
		}
		
		$query = $this->db->query($sql2);
		
		$res = $query->rows;
		$student_ids =implode(', ', array_map(function ($res) {
			return $res['id'];
		}, $res));  //all active students ID
		
		
		$ids = [];
		foreach($query->rows as $row){
			$ids[]=$row['id'];
		}
		
		$sql2 = "SELECT s.id FROM `" . DB_PREFIX . "student` s WHERE s.student_delete_status=0 AND s.refer_id IN(".$student_ids.") AND s.student_status = 0";
		$query = $this->db->query($sql2);
		foreach($query->rows as $row){
			$ids[]=$row['id'];
		}
		
		$sql = "SELECT s.*, u.firstname, u.lastname, u.email, ue.user_no, s1.student_name as refer_student_name, s1.student_no as refer_student_no FROM `" . DB_PREFIX . "student` s INNER JOIN " . DB_PREFIX . "user u ON u.user_id = s.link_user_id INNER JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id LEFT JOIN " . DB_PREFIX . "student s1 ON s.refer_id = s1.id";
		
		$sql .= " WHERE s.student_delete_status=0";
		
		if (isset($data['filter_search']) && !is_null($data['filter_search'])) {
			$sql .= " AND (s.student_name LIKE '%" . $data['filter_search'] . "%' OR s.student_no LIKE '%" . $data['filter_search'] . "%' OR s.student_phone LIKE '" . $data['filter_search'] . "' OR s.student_email LIKE '" . $data['filter_search'] . "' OR s.student_gender LIKE '" . $data['filter_search'] . "' OR u.firstname LIKE '" . $data['filter_search'] . "' OR s1.student_name LIKE '" . $data['filter_search'] . "' OR s1.student_no LIKE '" . $data['filter_search'] . "' OR DATE(s.activated_at) = '" . $data['filter_search'] . "' OR DATE(s.created_at) = '" . $data['filter_search'] . "')";
		}
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND s.student_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_phone'])) {
			$sql .= " AND s.student_phone LIKE '%" . $this->db->escape($data['filter_phone']) . "%'";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND s.student_status = '" . $data['filter_status'] . "'";
		}
		
		if (isset($data['filter_student_no']) && !is_null($data['filter_student_no'])) {
			$sql .= " AND s.student_no = '" . $data['filter_student_no'] . "'";
		}
		
		if (isset($data['filter_user_no']) && !is_null($data['filter_user_no'])) {
			$sql .= " AND ue.user_no = '" . $data['filter_user_no'] . "'";
		}
		
		if (isset($data['filter_refer_no']) && !is_null($data['filter_refer_no'])) {
			$sql .= " AND s1.student_no = '" . $data['filter_refer_no'] . "'";
		}
		
		if (isset($data['filter_refer_id']) && !is_null($data['filter_refer_id'])) {
			$sql .= " AND s.refer_id = '" . $data['filter_refer_id'] . "'";
		}
		
		/* if (isset($data['filter_link_user_id']) && !is_null($data['filter_link_user_id'])) {
			$sql .= " AND s.link_user_id IN( " . $data['filter_link_user_id'] . ")";
		} */
		
		if (!empty($data['filter_email'])) {
			$sql .= " AND s.student_email LIKE '%" . $this->db->escape($data['filter_email']) . "%'";
		}
		
		if (!empty($data['filter_gender'])) {
			$sql .= " AND s.student_gender LIKE '%" . $this->db->escape($data['filter_gender']) . "%'";
		}
		
		if (!empty($data['filter_activated_start_date'])) {
			$sql .= " AND DATE(s.activated_at) >= '" . $this->db->escape($data['filter_activated_start_date']) . "'";
		}

		if (!empty($data['filter_activated_end_date'])) {
			$sql .= " AND DATE(s.activated_at) <= '" . $this->db->escape($data['filter_activated_end_date']) . "'";
		}
		
		if (!empty($data['filter_created_start_date'])) {
			$sql .= " AND DATE(s.created_at) >= '" . $this->db->escape($data['filter_created_start_date']) . "'";
		}

		if (!empty($data['filter_created_end_date'])) {
			$sql .= " AND DATE(s.created_at) <= '" . $this->db->escape($data['filter_created_end_date']) . "'";
		}
		
		if (!empty($data['filter_link_start_date'])) {
			$sql .= " AND DATE(s.link_user_at) >= '" . $this->db->escape($data['filter_link_start_date']) . "'";
		}

		if (!empty($data['filter_link_end_date'])) {
			$sql .= " AND DATE(s.link_user_at) <= '" . $this->db->escape($data['filter_link_end_date']) . "'";
		}
		
		if (!empty($ids)) {
			$sql .= " AND s.id IN(".implode(',', $ids).")";
		}
		
		$sql .= " GROUP BY s.id";
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->mycolumns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY s.id DESC";
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
		return array('recordsTotal' => count($ids), 'recordsFiltered' => $recordsFiltered, 'result' => $result);
	}
	
	public function getInactiveItems($data = array()) {
		//print_r($data);
		$sql = "SELECT id FROM " . DB_PREFIX . "student WHERE student_delete_status=0 AND student_status = 0";
		
		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT s.*, u.firstname, u.lastname, u.email, ue.user_no, s1.student_name as refer_student_name, s1.student_no as refer_student_no FROM `" . DB_PREFIX . "student` s LEFT JOIN " . DB_PREFIX . "student_to_counsellor sc ON s.id = sc.student_id LEFT JOIN " . DB_PREFIX . "user u ON u.user_id = sc.user_id LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id LEFT JOIN " . DB_PREFIX . "student s1 ON s.refer_id = s1.id";
		
		$sql .= " WHERE s.student_delete_status=0 AND s.student_status = 0";
		
		if (isset($data['filter_search']) && !is_null($data['filter_search'])) {
			$sql .= " AND (s.student_name LIKE '%" . $data['filter_search'] . "%' OR s.student_no LIKE '%" . $data['filter_search'] . "%' OR s.student_phone LIKE '" . $data['filter_search'] . "' OR s.student_email LIKE '" . $data['filter_search'] . "' OR s.student_gender LIKE '" . $data['filter_search'] . "' OR u.firstname LIKE '" . $data['filter_search'] . "' OR s1.student_name LIKE '" . $data['filter_search'] . "' OR s1.student_no LIKE '" . $data['filter_search'] . "' OR DATE(s.activated_at) = '" . $data['filter_search'] . "' OR DATE(s.created_at) = '" . $data['filter_search'] . "')";
		}
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND s.student_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_phone'])) {
			$sql .= " AND s.student_phone LIKE '%" . $this->db->escape($data['filter_phone']) . "%'";
		}
		
		if (isset($data['filter_student_no']) && !is_null($data['filter_student_no'])) {
			$sql .= " AND s.student_no = '" . $data['filter_student_no'] . "'";
		}
		
		if (isset($data['filter_user_no']) && !is_null($data['filter_user_no'])) {
			$sql .= " AND ue.user_no = '" . $data['filter_user_no'] . "'";
		}
		
		if (isset($data['filter_refer_no']) && !is_null($data['filter_refer_no'])) {
			$sql .= " AND s1.student_no = '" . $data['filter_refer_no'] . "'";
		}
		
		if (isset($data['filter_refer_id']) && !is_null($data['filter_refer_id'])) {
			$sql .= " AND s.refer_id = '" . $data['filter_refer_id'] . "'";
		}
		
		if (isset($data['filter_link_user_id']) && !is_null($data['filter_link_user_id'])) {
			$sql .= " AND s.link_user_id = '" . $data['filter_link_user_id'] . "'";
		}
		
		if (!empty($data['filter_email'])) {
			$sql .= " AND s.student_email LIKE '%" . $this->db->escape($data['filter_email']) . "%'";
		}
		
		if (!empty($data['filter_gender'])) {
			$sql .= " AND s.student_gender LIKE '%" . $this->db->escape($data['filter_gender']) . "%'";
		}
		
		if (!empty($data['filter_created_start_date'])) {
			$sql .= " AND DATE(s.created_at) >= '" . $this->db->escape($data['filter_created_start_date']) . "'";
		}

		if (!empty($data['filter_created_end_date'])) {
			$sql .= " AND DATE(s.created_at) <= '" . $this->db->escape($data['filter_created_end_date']) . "'";
		}
		
		$sql .= " GROUP BY s.id";
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->inactivecolumns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY s.id DESC";
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
	
	public function getItemsForCounsellor($data = array()) {
		//print_r($data);
		$sql = "SELECT s.id FROM " . DB_PREFIX . "student s INNER JOIN " . DB_PREFIX . "student_to_counsellor sc ON s.id=sc.student_id WHERE s.student_delete_status=0 AND s.student_status = 0 AND sc.user_id = '".$data['filter_link_user_id']."'";
		
		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT s.*, s1.student_name as refer_student_name, s1.student_no as refer_student_no, sc.message_status FROM `" . DB_PREFIX . "student` s INNER JOIN " . DB_PREFIX . "student_to_counsellor sc ON s.id=sc.student_id LEFT JOIN " . DB_PREFIX . "student s1 ON s.refer_id = s1.id";
		
		$sql .= " WHERE s.student_delete_status=0 AND s.student_status = 0 AND sc.user_id = '".$data['filter_link_user_id']."'";
		
		if (isset($data['filter_search']) && !is_null($data['filter_search'])) {
			$sql .= " AND (s.student_name LIKE '%" . $data['filter_search'] . "%' OR s.student_no LIKE '%" . $data['filter_search'] . "%' OR s.student_phone LIKE '" . $data['filter_search'] . "' OR s.student_email LIKE '" . $data['filter_search'] . "' OR s.student_gender LIKE '" . $data['filter_search'] . "' OR u.firstname LIKE '" . $data['filter_search'] . "' OR s1.student_name LIKE '" . $data['filter_search'] . "' OR s1.student_no LIKE '" . $data['filter_search'] . "' OR DATE(s.activated_at) = '" . $data['filter_search'] . "' OR DATE(s.created_at) = '" . $data['filter_search'] . "')";
		}
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND s.student_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_phone'])) {
			$sql .= " AND s.student_phone LIKE '%" . $this->db->escape($data['filter_phone']) . "%'";
		}
		
		if (!empty($data['filter_whatsapp'])) {
			$sql .= " AND s.student_whatsapp LIKE '%" . $this->db->escape($data['filter_whatsapp']) . "%'";
		}
		
		if (isset($data['filter_student_no']) && !is_null($data['filter_student_no'])) {
			$sql .= " AND s.student_no = '" . $data['filter_student_no'] . "'";
		}
		
		if (!empty($data['filter_refer_no'])) {
			$sql .= " AND s1.student_no = '" . $data['filter_refer_no'] . "'";
		}
		
		if (isset($data['filter_refer_id']) && !is_null($data['filter_refer_id'])) {
			$sql .= " AND s.refer_id = '" . $data['filter_refer_id'] . "'";
		}
		
		if (!empty($data['filter_email'])) {
			$sql .= " AND s.student_email LIKE '%" . $this->db->escape($data['filter_email']) . "%'";
		}
		
		if (!empty($data['filter_gender'])) {
			$sql .= " AND s.student_gender LIKE '%" . $this->db->escape($data['filter_gender']) . "%'";
		}
		
		if (!empty($data['filter_counsellor_added_start_date'])) {
			$sql .= " AND DATE(sc.added_date) >= '" . $this->db->escape($data['filter_counsellor_added_start_date']) . "'";
		}

		if (!empty($data['filter_counsellor_added_end_date'])) {
			$sql .= " AND DATE(sc.added_date) <= '" . $this->db->escape($data['filter_counsellor_added_end_date']) . "'";
		}
		
		$sql .= " GROUP BY s.id";
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->counsellorcolumns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY s.id DESC";
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
	
	public function addToCounsellor($counsellor_id, $filter){
		$students = explode(',', $filter);
		foreach($students as $student_id){
			$this->db->query("DELETE FROM " . DB_PREFIX . "student_to_counsellor WHERE student_id = '".$student_id."'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "student_to_counsellor` set student_id = '".$student_id."', user_id = '" . (int)$counsellor_id . "', added_date = '" . date('Y-m-d H:i:s') . "'");
		}
	}
	
	public function getCounsellorIdByStudentId($student_id){
		$query = $this->db->query("SELECT user_id FROM " . DB_PREFIX . "student_to_counsellor WHERE student_id=".(int)$student_id);
		return isset($query->row['user_id'])?$query->row['user_id']:0;
	}
	
	public function checkTrainerExist(){
		$this->load->model('user/user');
		$trainer_no = $this->config->get('config_trn_no');
		$trainers = $this->model_user_user->getSubItems(array('filter_group_id'=>11, 'filter_user_no'=>$trainer_no,'filter_status'=>1));
		if(empty($trainers['result'])){
			return false;
		}else{
			return $trainers['result'];
		}
	}
	
	public function activateStudent($filter){
		$trainer = $this->checkTrainerExist();
		if($trainer == false){
			return false;
		}else{
			$students = explode(',', $filter);
			foreach($students as $student_id){
				$std_info = $this->get($student_id);
				$refer_id = $this->getReferIdByStudentId($student_id);
				$counsellor_id = $this->getCounsellorIdByStudentId($student_id);
				if($refer_id != 0){
					$refer_activated_point = $this->config->get('config_refer_activated_point');
					$data = array('student_id'=>$refer_id, 'reason'=>'Refer Student Activated', 'description'=>'Point earn for activated refer '.$std_info['student_name'],'credit_point'=>$refer_activated_point, 'debit_point'=>0,'type'=>'Credit');
					
					$this->managePoint($data);
				}
				$this->edit($student_id, array('link_user_id'=>$trainer[0]['user_id'], 'activated_at'=>date('Y-m-d H:i:s'), 'link_user_at'=>date('Y-m-d H:i:s'), 'student_status'=>1, 'activated_by'=>$this->user->getId()));
				
				$this->db->query("INSERT INTO " . DB_PREFIX . "student_active_history SET student_id = '" . (int)$student_id . "', refer_student_id = '" . $refer_id . "', user_id = '" .$trainer[0]['user_id'] . "', counsellor_id = '" .$counsellor_id . "', added_on = '" . date('Y-m-d H:i:s') . "'");
			}
			return true;
		}
	}
	
	public function getReferIdByStudentId($student_id){
		$query = $this->db->query("SELECT refer_id FROM bh_student WHERE id=".(int)$student_id);
		return $query->row['refer_id'];
	}
	
	public function managePoint($data) {
		$last_record = $this->getLastRecord($data['student_id']);
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
		$this->db->query("INSERT INTO " . DB_PREFIX . "student_passbook SET student_id = '" . (int)$data['student_id'] . "', reason = '" . $this->db->escape($data['reason']) . "', description = '" . $this->db->escape($data['description']) . "', credit_point = '" . $this->db->escape($data['credit_point']) . "', debit_point = '" . $this->db->escape($data['debit_point']) . "', balance_point = '" . $this->db->escape($balance_point) . "', type = '" . $this->db->escape($data['type']) . "', created_at = '".date('Y-m-d H:i:s')."'");
		
		$inserted_id =$this->db->getLastId();
		
		$last_record = $this->getLastRecord($data['student_id']);
		$this->edit($data['student_id'], array('student_point'=>$last_record['balance_point'], 'updated_at'=>date('Y-m-d H:i:s')));
		
		return $inserted_id;
	}
	
	public function getLastRecord($student_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "student_passbook WHERE student_id = '" . (int)$student_id . "' ORDER BY id DESC LIMIT 1");
		return $query->row;
	}
	
	public function getStudentPoint($student_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "student_passbook` WHERE student_id = '" . $student_id . "' ORDER BY id DESC");

		return $query->row['balance_point'];
	}
	
	public function counsellormessage($student_id) {
		$this->db->query("UPDATE `" . DB_PREFIX . "student_to_counsellor` set message_status = '1' WHERE student_id = '" . (int)$student_id . "' AND user_id='".$this->user->getId()."'");
	}
}