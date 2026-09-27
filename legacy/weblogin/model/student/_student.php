<?php
class ModelStudentStudent extends Model {
	public $mycolumns = array('s.id','', 's.student_no', 's.student_name', 's.student_phone', 's.student_email', 's.student_whatsapp', 's.student_telegram', 's.student_gender', 's.student_city', 's.student_country', 's.student_language', 's.created_at');
	public $assigncolumns = array('s.id','', 's.student_no', 's.student_name', 's.student_phone', 's.student_email', 's.student_whatsapp', 's.student_telegram', 's.student_gender', 's.student_city', 's.student_country', 's.student_language', 's.created_at');
	public $columns = array('s.id', 's.student_no', 's.student_name', 's.student_phone', 's.student_email', 's.student_point', 's1.student_refer_name', 'u.firstname', 'u1.firstname', 's.activated_at');
	public $inactivecolumns = array('s.id', 's.student_no', 's.student_name', 's.student_phone', 's.student_email', 's.student_whatsapp', 's.student_telegram', 's.student_language', 's.created_at', 's.student_point', 's.join_point');
	public $controllerinactivecolumns = array('s.id', 's.student_no', 's.student_name', 's.student_phone', 's.student_email', 's.student_whatsapp', 's.student_telegram', 's.student_language', 's.created_at');
	public $counsellorcolumns = array('s.id', 's.student_no', 's.student_name', 's.student_phone', 's.student_email', 's.student_whatsapp', 's.student_telegram', 's.student_gender', 's.student_city', 's.student_country', 's.student_language', 's.student_point','s1.student_refer_name', 's.created_at');
	public $counsellorseatcolumns = array('s.student_no', 's.student_name', 's.student_phone', 's.student_whatsapp', 's.student_telegram', 's.student_gender', 's.student_city', 's.student_country', 's.student_language', 's.created_at', 's1.student_refer_name', 's.student_status', 's.student_point');

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
		$query = $this->db->query("SELECT s.*, u.firstname, u.lastname, u.email, ue.user_no, CONCAT(u1.firstname, ' ', u1.lastname) as counsellor_name, s1.student_name as refer_student_name, s1.student_no as refer_student_no FROM `" . DB_PREFIX . "student` s LEFT JOIN " . DB_PREFIX . "user u ON u.user_id = s.link_user_id LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id LEFT JOIN " . DB_PREFIX . "student s1 ON s.refer_id = s1.id LEFT JOIN " . DB_PREFIX . "student_to_counsellor sc ON s.id = sc.student_id LEFT JOIN " . DB_PREFIX . "user u1 ON u1.user_id = sc.user_id LEFT JOIN " . DB_PREFIX . "user_extra ue1 ON u1.user_id = ue1.user_id WHERE s.id = '" . (int)$id . "'");

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
	
	public function mappingremove($code) {
		$std_info = $this->getStudentByNo($code);
		
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "student_passbook` WHERE student_id = '" . $this->db->escape($std_info['id']) . "' AND reason='Student Cashback Point' AND description='Cashback Point From Admin' AND type='Credit' LIMIT 1");
		$point = $query->row;
		$credit_point = $point['credit_point'];
		//print_r($std_info);echo $credit_point;exit;
		/* if($credit_point){
			$this->managePoint(array('student_id'=>$std_info['id'], 'reason'=>'Inactive Student Cashback Point', 'description'=>'Cashback Point Deduction From Admin','credit_point'=>0, 'debit_point'=>$credit_point,'type'=>'Debit'));
		} */
		
		
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "student_active_history` WHERE student_id = '" . $this->db->escape($std_info['id']) . "'");
		$active_history = $query->row;
		$refer_student_id = $active_history['refer_student_id'];
		
		//print_r($std_info);echo $credit_point; echo $refer_student_id;exit;
		if($refer_student_id){
			$refer_activated_point = $this->config->get('config_refer_activated_point');
			$data = array('student_id'=>$refer_student_id, 'reason'=>'Refer Student Activated Deduction', 'description'=>'Point Deduction for activated refer ID '.$code.' Name '.$std_info['student_name'],'debit_point'=>$refer_activated_point, 'credit_point'=>0,'type'=>'Debit');
			
			$this->managePoint($data);
		}
		$this->db->query("UPDATE `" . DB_PREFIX . "student` set student_status = 0 WHERE id = '" . $std_info['id'] . "'");
		
		$this->db->query("DELETE FROM `" . DB_PREFIX . "student_active_history` WHERE student_id = '" . $this->db->escape($std_info['id']) . "'");
	}
	
	/* public function getItems($data = array()) {
		$sql = "SELECT id FROM " . DB_PREFIX . "student WHERE student_delete_status=0";
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND student_status = '" . $data['filter_status'] . "'";
		}
		
		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT s.*, u.firstname, u.lastname, u.email, ue.user_no, s1.student_name as refer_student_name, s1.student_no as refer_student_no FROM `" . DB_PREFIX . "student` s LEFT JOIN " . DB_PREFIX . "user u ON u.user_id = s.link_user_id LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id LEFT JOIN " . DB_PREFIX . "student s1 ON s.refer_id = s1.id";
		
		$sql .= " WHERE s.student_delete_status=0";
		
		if (isset($data['filter_search']) && !is_null($data['filter_search'])) {
			$sql .= " AND (s.student_name LIKE '%" . $data['filter_search'] . "%' OR s.student_no LIKE '%" . $data['filter_search'] . "%' OR s.student_phone LIKE '" . $data['filter_search'] . "' OR s.student_whatsapp LIKE '" . $data['filter_search'] . "' OR s.student_email LIKE '" . $data['filter_search'] . "' OR s.student_gender LIKE '" . $data['filter_search'] . "' OR s.student_language LIKE '" . $data['filter_search'] . "' OR u.firstname LIKE '" . $data['filter_search'] . "' OR s1.student_name LIKE '" . $data['filter_search'] . "' OR s1.student_no LIKE '" . $data['filter_search'] . "' OR DATE(s.activated_at) = '" . $data['filter_search'] . "' OR DATE(s.created_at) = '" . $data['filter_search'] . "')";
		}
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND s.student_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_phone'])) {
			$sql .= " AND (s.student_phone LIKE '%" . $this->db->escape($data['filter_phone']) . "%' OR s.student_whatsapp LIKE '%" . $this->db->escape($data['filter_phone']) . "%')";
		}
		
		if (!empty($data['filter_whatsapp'])) {
			$sql .= " AND s.student_whatsapp LIKE '%" . $this->db->escape($data['filter_whatsapp']) . "%'";
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
	} */
	
	public function getItems($data = array()) {
		//print_r($data);
		$sql = "SELECT id FROM " . DB_PREFIX . "student WHERE student_delete_status=0";
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND student_status = '" . $data['filter_status'] . "'";
		}
		
		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT @@SELECTCOLS@@ FROM " . DB_PREFIX . "student s @@MOREJOIN@@ WHERE s.student_delete_status=0";
		
		if (isset($data['filter_search']) && !is_null($data['filter_search'])) {
			$sql .= " AND (s.student_name LIKE '%" . $data['filter_search'] . "%' OR s.student_no LIKE '%" . $data['filter_search'] . "%' OR s.student_phone LIKE '" . $data['filter_search'] . "' OR s.student_whatsapp LIKE '" . $data['filter_search'] . "' OR s.student_email LIKE '" . $data['filter_search'] . "' OR s.student_gender LIKE '" . $data['filter_search'] . "' OR s.student_language LIKE '" . $data['filter_search'] . "' OR u.firstname LIKE '" . $data['filter_search'] . "' OR s1.student_name LIKE '" . $data['filter_search'] . "' OR s1.student_no LIKE '" . $data['filter_search'] . "' OR DATE(s.activated_at) = '" . $data['filter_search'] . "' OR DATE(s.created_at) = '" . $data['filter_search'] . "')";
		}
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND s.student_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_phone'])) {
			$sql .= " AND (s.student_phone LIKE '%" . $this->db->escape($data['filter_phone']) . "%' OR s.student_whatsapp LIKE '%" . $this->db->escape($data['filter_phone']) . "%')";
		}
		
		if (!empty($data['filter_whatsapp'])) {
			$sql .= " AND s.student_whatsapp LIKE '%" . $this->db->escape($data['filter_whatsapp']) . "%'";
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
		
		if (isset($data['filter_counsellor_no']) && !is_null($data['filter_counsellor_no'])) {
			$sql .= " AND ue1.user_no = '" . $data['filter_counsellor_no'] . "'";
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
			$Odr= " ORDER BY " . $this->columns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$Odr= " ORDER BY s.id DESC";
		}
		
		$filterJoin = '';
		
		if($this->columns[$data['order'][0]['column']] == 'u.firstname' || !empty($data['filter_user_no'])){
			$filterJoin.=" LEFT JOIN " . DB_PREFIX . "user u ON u.user_id = s.link_user_id LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id";
		}
		
		if($this->columns[$data['order'][0]['column']] == 's1.student_refer_name' || !empty($data['filter_refer_no'])){
			$filterJoin.=" LEFT JOIN " . DB_PREFIX . "student s1 ON s.refer_id = s1.id";
		}
		
		if($this->columns[$data['order'][0]['column']] == 'u1.firstname' || !empty($data['filter_counsellor_no'])){
			$filterJoin.=" LEFT JOIN " . DB_PREFIX . "student_to_counsellor sc ON s.id = sc.student_id LEFT JOIN " . DB_PREFIX . "user u1 ON u1.user_id = sc.user_id LEFT JOIN " . DB_PREFIX . "user_extra ue1 ON u1.user_id = ue1.user_id";
		}
		
		$sqlTemp=str_replace('@@SELECTCOLS@@','s.id',$sql);
		$sqlTemp=str_replace('@@MOREJOIN@@',$filterJoin,($sqlTemp.$Odr));
		//echo $sqlTemp;			
		$query = $this->db->query($sqlTemp);
		$result = $query->rows; //has enquiry ids filtered as array @ 15-mar-2023 -for faster result
		$recordsFiltered = (int)$query->num_rows;
		
		$ids =implode(', ', array_map(function ($result) {
			return $result['id'];
		}, $result));
		
		if(empty($ids)) $ids = 0;
		
		if (isset($data['start']) && isset($data['length'])) { 
			$LIMIT= " LIMIT " . (int)$data['start'] . "," . (int)$data['length'];
		}
		
		$finalSql = 'SELECT s.* from '. DB_PREFIX .'student s '.$filterJoin.' WHERE s.id in('.$ids.')'. $Odr. $LIMIT;
		
		/*** Abhik's Edit Starts ***/
		
		/*
		$MOREJOIN = " LEFT JOIN " . DB_PREFIX . "user u ON u.user_id = s.link_user_id LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id LEFT JOIN " . DB_PREFIX . "student s1 ON s.refer_id = s1.id LEFT JOIN " . DB_PREFIX . "student_to_counsellor sc ON s.id = sc.student_id LEFT JOIN " . DB_PREFIX . "user u1 ON u1.user_id = sc.user_id LEFT JOIN " . DB_PREFIX . "user_extra ue1 ON u1.user_id = ue1.user_id";
		
		$finalSql="Select s.*, u.firstname, u.lastname, u.email, ue.user_no, s1.student_name as refer_student_name, s1.student_no as refer_student_no, u1.firstname as cfirstname, u1.lastname as clastname, ue1.user_no as cuser_no FROM ( $finalSql )as s $MOREJOIN GROUP BY s.id $Odr ";
		*/
		
		$MOREJOIN = " LEFT JOIN " . DB_PREFIX . "user u ON u.user_id = s.link_user_id LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id LEFT JOIN " . DB_PREFIX . "student s1 ON s.refer_id = s1.id LEFT JOIN " . DB_PREFIX . "student_to_counsellor sc ON s.id = sc.student_id LEFT JOIN " . DB_PREFIX . "user u1 ON u1.user_id = sc.user_id LEFT JOIN " . DB_PREFIX . "user_extra ue1 ON u1.user_id = ue1.user_id LEFT JOIN " . DB_PREFIX . "student_active_history sah ON s.id = sah.student_id";

		$finalSql="Select s.*, u.firstname, u.lastname, u.email, ue.user_no, s1.student_name as refer_student_name, s1.student_no as refer_student_no, u1.firstname as cfirstname, u1.lastname as clastname, ue1.user_no as cuser_no, MAX(sah.added_on) as actual_activation_date FROM ( $finalSql )as s $MOREJOIN GROUP BY s.id $Odr ";
		/*** Abhik's Edit Ends ***/
		
		//echo $finalSql;
		$query = $this->db->query($finalSql);
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
			$sql2 .= " AND s.link_user_id IN(" . $data['filter_link_user_id'] . ")";
		}
		//echo $sql2;
		$query2 = $this->db->query($sql2);
		
		$res = $query2->rows;
		$student_ids =implode(', ', array_map(function ($res) {
			return $res['id'];
		}, $res));  //all active students ID
		
		$ids = [];
		foreach($query2->rows as $row){
			$ids[]=$row['id'];
		}
		
		if(!empty($res)){
			$sql3 = "SELECT s.id FROM `" . DB_PREFIX . "student` s WHERE s.student_delete_status=0 AND s.refer_id IN(".$student_ids.") AND s.student_status = 0";
			//echo $sql3;
			$query3 = $this->db->query($sql3);
			foreach($query3->rows as $row){
				$ids[]=$row['id'];
			}
		}
		//print_r($ids);exit;
		$sql = "SELECT s.*, u.firstname, u.lastname, u.email, ue.user_no, s1.student_name as refer_student_name, s1.student_no as refer_student_no FROM `" . DB_PREFIX . "student` s LEFT JOIN " . DB_PREFIX . "user u ON u.user_id = s.link_user_id LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id LEFT JOIN " . DB_PREFIX . "student s1 ON s.refer_id = s1.id";
		
		$sql .= " WHERE s.student_delete_status=0";
		
		if (isset($data['filter_search']) && !is_null($data['filter_search'])) {
			$sql .= " AND (s.student_name LIKE '%" . $data['filter_search'] . "%' OR s.student_no LIKE '%" . $data['filter_search'] . "%' OR s.student_phone LIKE '" . $data['filter_search'] . "' OR s.student_email LIKE '" . $data['filter_search'] . "' OR s.student_gender LIKE '" . $data['filter_search'] . "' OR u.firstname LIKE '" . $data['filter_search'] . "' OR s1.student_name LIKE '" . $data['filter_search'] . "' OR s1.student_no LIKE '" . $data['filter_search'] . "' OR DATE(s.activated_at) = '" . $data['filter_search'] . "' OR DATE(s.created_at) = '" . $data['filter_search'] . "')";
		}
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND s.student_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_phone'])) {
			$sql .= " AND (s.student_phone LIKE '%" . $this->db->escape($data['filter_phone']) . "%' OR s.student_whatsapp LIKE '%" . $this->db->escape($data['filter_phone']) . "%')";
		}
		
		if (!empty($data['filter_whatsapp'])) {
			$sql .= " AND s.student_whatsapp LIKE '%" . $this->db->escape($data['filter_whatsapp']) . "%'";
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
		}else{
			$sql .= " AND s.id IN(0)";
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
		//echo $sql;exit;
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
			$sql .= " AND (s.student_phone LIKE '%" . $this->db->escape($data['filter_phone']) . "%' OR s.student_whatsapp LIKE '%" . $this->db->escape($data['filter_phone']) . "%')";
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
		
		if (!empty($data['filter_whatsapp'])) {
			$sql .= " AND s.student_whatsapp LIKE '%" . $this->db->escape($data['filter_whatsapp']) . "%'";
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
	
	public function getNotAssignItems($data = array()) {
		//print_r($data);
		$sql = "SELECT id FROM " . DB_PREFIX . "student WHERE student_delete_status=0 AND student_status = 1 AND link_user_id = 0";
		
		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows;
		
		$sql2 = "SELECT s.id FROM `" . DB_PREFIX . "student` s INNER JOIN " . DB_PREFIX . "student_active_history sah ON s.id = sah.student_id WHERE s.student_delete_status=0 AND s.student_status = 1 AND s.link_user_id = 0 AND sah.team_leader_id='".$this->user->getId()."'";
		
		$query = $this->db->query($sql2);
		
		$res = $query->rows;
		$student_ids =implode(', ', array_map(function ($res) {
			return $res['id'];
		}, $res));  //all active students ID
		
		
		$ids = [];
		foreach($query->rows as $row){
			$ids[]=$row['id'];
		}
		
		$sql = "SELECT s.*, s1.student_name as refer_student_name, s1.student_no as refer_student_no FROM `" . DB_PREFIX . "student` s INNER JOIN " . DB_PREFIX . "student_active_history sah ON s.id = sah.student_id LEFT JOIN " . DB_PREFIX . "student s1 ON s.refer_id = s1.id";
		
		$sql .= " WHERE s.student_delete_status=0 AND s.student_status = 1 AND s.link_user_id = 0 AND sah.team_leader_id='".$this->user->getId()."'";
		
		if (isset($data['filter_search']) && !is_null($data['filter_search'])) {
			$sql .= " AND (s.student_name LIKE '%" . $data['filter_search'] . "%' OR s.student_no LIKE '%" . $data['filter_search'] . "%' OR s.student_phone LIKE '" . $data['filter_search'] . "' OR s.student_email LIKE '" . $data['filter_search'] . "' OR s.student_gender LIKE '" . $data['filter_search'] . "' OR u.firstname LIKE '" . $data['filter_search'] . "' OR s1.student_name LIKE '" . $data['filter_search'] . "' OR s1.student_no LIKE '" . $data['filter_search'] . "' OR DATE(s.activated_at) = '" . $data['filter_search'] . "' OR DATE(s.created_at) = '" . $data['filter_search'] . "')";
		}
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND s.student_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_phone'])) {
			$sql .= " AND (s.student_phone LIKE '%" . $this->db->escape($data['filter_phone']) . "%' OR s.student_whatsapp LIKE '%" . $this->db->escape($data['filter_phone']) . "%')";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND s.student_status = '" . $data['filter_status'] . "'";
		}
		
		if (isset($data['filter_student_no']) && !is_null($data['filter_student_no'])) {
			$sql .= " AND s.student_no = '" . $data['filter_student_no'] . "'";
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
		
		if (!empty($data['filter_whatsapp'])) {
			$sql .= " AND s.student_whatsapp LIKE '%" . $this->db->escape($data['filter_whatsapp']) . "%'";
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
			$sql .= " ORDER BY " . $this->assigncolumns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
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
	
	public function countInactiveItems($data = array()) {
		//print_r($data);
		$sql = "SELECT id FROM " . DB_PREFIX . "student WHERE student_delete_status=0 AND student_status = 0";
		if (!empty($data['filter_created_start_date'])) {
			$sql .= " AND DATE(created_at) >= '" . $this->db->escape($data['filter_created_start_date']) . "'";
		}

		if (!empty($data['filter_created_end_date'])) {
			$sql .= " AND DATE(created_at) <= '" . $this->db->escape($data['filter_created_end_date']) . "'";
		}
		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows;
		return $recordsTotal;
	}
	public function getInactiveItems($data = array()) {

        // ---------- Base WHERE (inactive + not deleted) ----------
        $where = array();
        $where[] = "s.student_delete_status = 0";
        $where[] = "s.student_status = 0";
    
        // ---------- Filters ----------
        if (isset($data['filter_search']) && $data['filter_search'] !== null && $data['filter_search'] !== '') {
            $search = $this->db->escape($data['filter_search']);
            $where[] = "(
                s.student_name LIKE '%" . $search . "%'
                OR s.student_no LIKE '%" . $search . "%'
                OR s.student_phone LIKE '%" . $search . "%'
                OR s.student_whatsapp LIKE '%" . $search . "%'
                OR s.student_email LIKE '%" . $search . "%'
                OR s.student_gender LIKE '%" . $search . "%'
                OR s.student_language LIKE '%" . $search . "%'
            )";
        }
    
        if (!empty($data['filter_name'])) {
            $name = $this->db->escape($data['filter_name']);
            $where[] = "s.student_name LIKE '%" . $name . "%'";
        }
    
        if (!empty($data['filter_phone'])) {
            $phone = $this->db->escape($data['filter_phone']);
            $where[] = "(s.student_phone LIKE '%" . $phone . "%' OR s.student_whatsapp LIKE '%" . $phone . "%')";
        }
    
        if (!empty($data['filter_whatsapp'])) {
            $wh = $this->db->escape($data['filter_whatsapp']);
            $where[] = "s.student_whatsapp LIKE '%" . $wh . "%'";
        }
    
        if (isset($data['filter_student_no']) && $data['filter_student_no'] !== null && $data['filter_student_no'] !== '') {
            $where[] = "s.student_no = '" . $this->db->escape($data['filter_student_no']) . "'";
        }
    
        if (isset($data['filter_user_no']) && $data['filter_user_no'] !== null && $data['filter_user_no'] !== '') {
            // user_no is from user_extra, so join needed
            $where[] = "ue.user_no = '" . $this->db->escape($data['filter_user_no']) . "'";
        }
    
        if (isset($data['filter_refer_no']) && $data['filter_refer_no'] !== null && $data['filter_refer_no'] !== '') {
            $where[] = "s.refer_id = '" . $this->db->escape($data['filter_refer_no']) . "'";
        }
    
        if (isset($data['filter_refer_id']) && $data['filter_refer_id'] !== null && $data['filter_refer_id'] !== '') {
            $where[] = "s.refer_id = '" . $this->db->escape($data['filter_refer_id']) . "'";
        }
    
        if (isset($data['filter_link_user_id']) && $data['filter_link_user_id'] !== null && $data['filter_link_user_id'] !== '') {
            $where[] = "s.link_user_id = '" . $this->db->escape($data['filter_link_user_id']) . "'";
        }
    
        if (!empty($data['filter_email'])) {
            $email = $this->db->escape($data['filter_email']);
            $where[] = "s.student_email LIKE '%" . $email . "%'";
        }
    
        if (!empty($data['filter_gender'])) {
            $gender = $this->db->escape($data['filter_gender']);
            $where[] = "s.student_gender LIKE '%" . $gender . "%'";
        }
    
        if (!empty($data['filter_language'])) {
            $where[] = "s.student_language = '" . $this->db->escape($data['filter_language']) . "'";
        }
    
        // Index-friendly date filtering (NO DATE(s.created_at))
        if (!empty($data['filter_created_start_date'])) {
            $start = $this->db->escape($data['filter_created_start_date']);
            $where[] = "s.created_at >= '" . $start . " 00:00:00'";
        }
    
        if (!empty($data['filter_created_end_date'])) {
            $end = $this->db->escape($data['filter_created_end_date']);
            // < end+1 day
            $where[] = "s.created_at < DATE_ADD('" . $end . " 00:00:00', INTERVAL 1 DAY)";
        }
    
        $whereSql = '';
        if ($where) {
            $whereSql = " WHERE " . implode(" AND ", $where);
        }
    
        // ---------- Sorting ----------
        // Use your existing arrays if they exist, else fallback
        $sort = "s.id";
        $orderDir = "DESC";
    
        if (isset($data['order'][0]['column'])) {
            $colIndex = (int)$data['order'][0]['column'];
            $dir = isset($data['order'][0]['dir']) ? strtoupper($data['order'][0]['dir']) : 'DESC';
            $dir = ($dir === 'ASC') ? 'ASC' : 'DESC';
    
            // You had $this->inactivecolumns - keep it if you want
            if (isset($this->inactivecolumns[$colIndex])) {
                $sort = $this->inactivecolumns[$colIndex];
            }
    
            $orderDir = $dir;
        }
    
        $orderSql = " ORDER BY " . $sort . " " . $orderDir;
    
        // ---------- Pagination ----------
        $start = isset($data['start']) ? (int)$data['start'] : 0;
        $length = isset($data['length']) ? (int)$data['length'] : 20;
        if ($start < 0) $start = 0;
        if ($length < 1) $length = 20;
    
        $limitSql = " LIMIT " . $start . ", " . $length;
    
        // ---------- 1) recordsTotal (no joins needed) ----------
        $sqlTotal = "SELECT COUNT(*) AS total
                     FROM " . DB_PREFIX . "student
                     WHERE student_delete_status = 0 AND student_status = 0";
        $qTotal = $this->db->query($sqlTotal);
        $recordsTotal = (int)$qTotal->row['total'];
    
        // ---------- Joins (deterministic single counsellor per student) ----------
        // Pick one user_id per student (MAX) – deterministic & avoids duplicate rows
        $joinSql = "
            LEFT JOIN (
                SELECT student_id, MAX(user_id) AS user_id
                FROM " . DB_PREFIX . "student_to_counsellor
                GROUP BY student_id
            ) sc ON sc.student_id = s.id
            LEFT JOIN " . DB_PREFIX . "user u ON u.user_id = sc.user_id
            LEFT JOIN " . DB_PREFIX . "user_extra ue ON ue.user_id = u.user_id
        ";
    
        // ---------- 2) recordsFiltered ----------
        $sqlFiltered = "SELECT COUNT(*) AS total
                        FROM " . DB_PREFIX . "student s
                        " . $joinSql . "
                        " . $whereSql;
        // Since join is 1-to-1 after subquery, COUNT(*) is safe.
        $qFiltered = $this->db->query($sqlFiltered);
        $recordsFiltered = (int)$qFiltered->row['total'];
    
        // ---------- 3) result data ----------
        $sqlData = "SELECT
                        s.id,
                        s.student_no,
                        s.student_point,
                        s.joining_point,
                        s.student_name,
                        s.student_phone,
                        s.student_whatsapp,
                        s.student_telegram,
                        s.student_language,
                        s.student_email,
                        s.created_at,
                        s.student_status,
                        u.firstname,
                        u.lastname,
                        u.email,
                        ue.user_no
                    FROM " . DB_PREFIX . "student s
                    " . $joinSql . "
                    " . $whereSql . "
                    " . $orderSql . "
                    " . $limitSql;
    
        $qData = $this->db->query($sqlData);
    
        return array(
            'recordsTotal'    => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'result'          => $qData->rows
        );
    }

	/*
	public function getInactiveItems($data = array()) {
		//print_r($data);
		$sql = "SELECT id FROM " . DB_PREFIX . "student WHERE student_delete_status=0 AND student_status = 0";
		
		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT @@SELECTCOLS@@ FROM " . DB_PREFIX . "student s @@MOREJOIN@@ WHERE s.student_delete_status=0 AND s.student_status = 0";
		
		$jn_counsellor=false;
		if (isset($data['filter_search']) && !is_null($data['filter_search'])) {
			$jn_counsellor=true;
			$sql .= " AND (s.student_name LIKE '%" . $data['filter_search'] . "%' OR s.student_no LIKE '%" . $data['filter_search'] . "%' OR s.student_phone LIKE '%" . $data['filter_search'] . "%' OR s.student_whatsapp LIKE '%" . $data['filter_search'] . "%' OR s.student_email LIKE '%" . $data['filter_search'] . "%' OR s.student_gender LIKE '%" . $data['filter_search'] . "%' OR s.student_language LIKE '%" . $data['filter_search'] . "%')";
		}
		if (!empty($data['filter_name'])) {
			$sql .= " AND s.student_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_phone'])) {
			$sql .= " AND (s.student_phone LIKE '%" . $this->db->escape($data['filter_phone']) . "%' OR s.student_whatsapp LIKE '%" . $this->db->escape($data['filter_phone']) . "%')";
		}
		
		if (!empty($data['filter_whatsapp'])) {
			$sql .= " AND s.student_whatsapp LIKE '%" . $this->db->escape($data['filter_whatsapp']) . "%'";
		}
		
		if (isset($data['filter_student_no']) && !is_null($data['filter_student_no'])) {
			$sql .= " AND s.student_no = '" . $data['filter_student_no'] . "'";
		}
		
		if (isset($data['filter_user_no']) && !is_null($data['filter_user_no'])) {
			$jn_counsellor=true;
			$sql .= " AND ue.user_no = '" . $data['filter_user_no'] . "'";
		}
		
		if (isset($data['filter_refer_no']) && !is_null($data['filter_refer_no'])) {
			$sql .= " AND s.refer_id = '" . $data['filter_refer_no'] . "'";
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
		
		if (!empty($data['filter_language'])) {
			$sql .= " AND s.student_language = '" . $this->db->escape($data['filter_language']) . "'";
		}
		
		if (!empty($data['filter_created_start_date'])) {
			$sql .= " AND DATE(s.created_at) >= '" . $this->db->escape($data['filter_created_start_date']) . "'";
		}

		if (!empty($data['filter_created_end_date'])) {
			$sql .= " AND DATE(s.created_at) <= '" . $this->db->escape($data['filter_created_end_date']) . "'";
		}
		
		if($jn_counsellor){
			$sql .= " GROUP BY s.id";
		}
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$Odr= " ORDER BY " . $this->inactivecolumns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$Odr= " ORDER BY s.id DESC";
		}
		
		$filterJoin = '';
		
		if($this->columns[$data['order'][0]['column']] == 'u.firstname' || !empty($data['filter_user_no'])){
			$filterJoin.=" LEFT JOIN " . DB_PREFIX . "student_to_counsellor sc ON s.id = sc.student_id LEFT JOIN " . DB_PREFIX . "user u ON u.user_id = sc.user_id LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id";
		}
		
		$sqlTemp=str_replace('@@SELECTCOLS@@','s.id',$sql);
		$sqlTemp=str_replace('@@MOREJOIN@@',$filterJoin,($sqlTemp.$Odr));
		//echo $sqlTemp;			
		$query = $this->db->query($sqlTemp);
		$result = $query->rows; //has enquiry ids filtered as array @ 15-mar-2023 -for faster result
		$recordsFiltered = (int)$query->num_rows;
		
		$ids=implode(', ', array_map(function ($result) {
			return $result['id'];
		}, $result));
		
		if(empty($ids)) $ids = 0;
		if (isset($data['start']) && isset($data['length'])) { 
			$LIMIT= " LIMIT " . (int)$data['start'] . "," . (int)$data['length'];
		}
		
		$finalSql = 'SELECT s.* from '. DB_PREFIX .'student s '.$filterJoin.' WHERE s.id in('.$ids.')'. $Odr. $LIMIT;
		
		$MOREJOIN = " LEFT JOIN " . DB_PREFIX . "student_to_counsellor sc ON s.id = sc.student_id LEFT JOIN " . DB_PREFIX . "user u ON u.user_id = sc.user_id LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id";
		
		$finalSql="Select s.id, s.student_no, s.student_point, s.joining_point, s.student_name, s.student_phone, s.student_whatsapp, s.student_telegram, s.student_language, s.student_email, s.created_at, s.student_status, u.firstname, u.lastname, u.email, ue.user_no FROM ( $finalSql )as s $MOREJOIN GROUP BY s.id $Odr ";
	  
		//echo $finalSql;
		$query = $this->db->query($finalSql);
		$result = $query->rows;
		return array('recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered, 'result' => $result);
	}
	*/
	/* public function getInactiveItems($data = array()) {
		$where = [];
		$filterJoin = '';

		// Required base filters
		$where[] = "s.student_delete_status = 0";
		$where[] = "s.student_status = 0";

		// Language filter
		if (!empty($data['filter_language'])) {
			$where[] = "s.student_language = '" . $this->db->escape($data['filter_language']) . "'";
		}

		// Search filter
		if (!empty($data['filter_search'])) {
			$search = $this->db->escape($data['filter_search']);
			$where[] = "(s.student_name LIKE '%{$search}%' 
				OR s.student_no LIKE '%{$search}%' 
				OR s.student_phone LIKE '%{$search}%' 
				OR s.student_whatsapp LIKE '%{$search}%' 
				OR s.student_email LIKE '%{$search}%' 
				OR s.student_gender LIKE '%{$search}%' 
				OR s.student_language LIKE '%{$search}%')";
		}

		// Individual filters
		if (!empty($data['filter_name'])) {
			$where[] = "s.student_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		if (!empty($data['filter_phone'])) {
			$phone = $this->db->escape($data['filter_phone']);
			$where[] = "(s.student_phone LIKE '%{$phone}%' OR s.student_whatsapp LIKE '%{$phone}%')";
		}
		if (!empty($data['filter_whatsapp'])) {
			$where[] = "s.student_whatsapp LIKE '%" . $this->db->escape($data['filter_whatsapp']) . "%'";
		}
		if (isset($data['filter_student_no']) && $data['filter_student_no'] !== '') {
			$where[] = "s.student_no = '" . $this->db->escape($data['filter_student_no']) . "'";
		}
		if (isset($data['filter_user_no']) && $data['filter_user_no'] !== '') {
			$where[] = "ue.user_no = '" . $this->db->escape($data['filter_user_no']) . "'";
			$filterJoin .= " LEFT JOIN " . DB_PREFIX . "user u ON u.user_id = sc.user_id 
							 LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id";
		}
		if (isset($data['filter_refer_no']) && $data['filter_refer_no'] !== '') {
			$where[] = "s.refer_id = '" . $this->db->escape($data['filter_refer_no']) . "'";
		}
		if (isset($data['filter_refer_id']) && $data['filter_refer_id'] !== '') {
			$where[] = "s.refer_id = '" . $this->db->escape($data['filter_refer_id']) . "'";
		}
		if (isset($data['filter_link_user_id']) && $data['filter_link_user_id'] !== '') {
			$where[] = "s.link_user_id = '" . $this->db->escape($data['filter_link_user_id']) . "'";
		}
		if (!empty($data['filter_email'])) {
			$where[] = "s.student_email LIKE '%" . $this->db->escape($data['filter_email']) . "%'";
		}
		if (!empty($data['filter_gender'])) {
			$where[] = "s.student_gender LIKE '%" . $this->db->escape($data['filter_gender']) . "%'";
		}
		if (!empty($data['filter_created_start_date'])) {
			$where[] = "DATE(s.created_at) >= '" . $this->db->escape($data['filter_created_start_date']) . "'";
		}
		if (!empty($data['filter_created_end_date'])) {
			$where[] = "DATE(s.created_at) <= '" . $this->db->escape($data['filter_created_end_date']) . "'";
		}

		// Combine WHERE
		$whereSQL = $where ? "WHERE " . implode(" AND ", $where) : "";

		// Sorting
		if (isset($data['order'][0]['column'])) {
			$colIndex = (int)$data['order'][0]['column'];
			$orderCol = $this->inactivecolumns[$colIndex] ?? "s.id";
			$orderDir = (isset($data['order'][0]['dir']) && strtolower($data['order'][0]['dir']) === 'asc') ? "ASC" : "DESC";
		} else {
			$orderCol = "s.id";
			$orderDir = "DESC";
		}

		// Count total
		$recordquery = $this->db->query(
			"SELECT COUNT(*) AS cnt 
			 FROM " . DB_PREFIX . "student 
			 WHERE student_delete_status = 0 AND student_status = 0"
		);
		$recordsTotal = $recordquery->row['cnt'];

		// Count filtered
		$filteredquery = $this->db->query(
			"SELECT COUNT(DISTINCT s.id) AS cnt 
			 FROM " . DB_PREFIX . "student s 
			 LEFT JOIN " . DB_PREFIX . "student_to_counsellor sc ON s.id = sc.student_id
			 {$filterJoin} 
			 {$whereSQL}"
		);
		$recordsFiltered = $filteredquery->row['cnt'];

		// Pagination
		$limitSQL = "";
		if (isset($data['start']) && isset($data['length']) && $data['length'] != -1) {
			$limitSQL = " LIMIT " . (int)$data['start'] . ", " . (int)$data['length'];
		}

		// Step 1: Get only the IDs for this page
		$idQuery = $this->db->query("
			SELECT s.id
			FROM " . DB_PREFIX . "student s
			LEFT JOIN " . DB_PREFIX . "student_to_counsellor sc ON s.id = sc.student_id
			{$filterJoin}
			{$whereSQL}
			ORDER BY {$orderCol} {$orderDir}
			{$limitSQL}
		");

		$ids = array_column($idQuery->rows, 'id');

		$result = [];
		if (!empty($ids)) {
			// Step 2: Fetch full details only for these IDs
			$idList = implode(",", array_map('intval', $ids));
			$result = $this->db->query("
				SELECT s.id, s.student_no, s.student_point, s.joining_point, s.student_name, 
					   s.student_phone, s.student_whatsapp, s.student_telegram, s.student_language, 
					   s.student_email, s.created_at, s.student_status
				FROM " . DB_PREFIX . "student s
				LEFT JOIN " . DB_PREFIX . "student_to_counsellor sc ON s.id = sc.student_id
				{$filterJoin}
				WHERE s.id IN ({$idList})
				ORDER BY {$orderCol} {$orderDir}
			")->rows;
		}
		return [
			'recordsTotal'    => $recordsTotal,
			'recordsFiltered' => $recordsFiltered,
			'result'          => $result
		];
	} */

	
	public function getWhatsappItems($data = array()) {
		//print_r($data);
		$sql = "SELECT s.id FROM " . DB_PREFIX . "student s JOIN bh_student_to_counsellor sc ON s.id=sc.student_id WHERE s.student_delete_status=0 AND sc.whatsapp_status = 0";
		
		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT @@SELECTCOLS@@ FROM " . DB_PREFIX . "student s JOIN bh_student_to_counsellor sc ON s.id=sc.student_id @@MOREJOIN@@ WHERE s.student_delete_status=0 AND sc.whatsapp_status = 0";
		
		$jn_counsellor=false;
		if (isset($data['filter_search']) && !is_null($data['filter_search'])) {
			$jn_counsellor=true;
			$sql .= " AND (s.student_name LIKE '%" . $data['filter_search'] . "%' OR s.student_no LIKE '%" . $data['filter_search'] . "%' OR s.student_phone LIKE '%" . $data['filter_search'] . "%' OR s.student_whatsapp LIKE '%" . $data['filter_search'] . "%' OR s.student_email LIKE '%" . $data['filter_search'] . "%' OR s.student_gender LIKE '%" . $data['filter_search'] . "%' OR s.student_language LIKE '%" . $data['filter_search'] . "%')";
		}
		if (!empty($data['filter_name'])) {
			$sql .= " AND s.student_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_phone'])) {
			$sql .= " AND (s.student_phone LIKE '%" . $this->db->escape($data['filter_phone']) . "%' OR s.student_whatsapp LIKE '%" . $this->db->escape($data['filter_phone']) . "%')";
		}
		
		if (!empty($data['filter_whatsapp'])) {
			$sql .= " AND s.student_whatsapp LIKE '%" . $this->db->escape($data['filter_whatsapp']) . "%'";
		}
		
		if (isset($data['filter_student_no']) && !is_null($data['filter_student_no'])) {
			$sql .= " AND s.student_no = '" . $data['filter_student_no'] . "'";
		}
		
		if (isset($data['filter_user_no']) && !is_null($data['filter_user_no'])) {
			$jn_counsellor=true;
			$sql .= " AND ue.user_no = '" . $data['filter_user_no'] . "'";
		}
		
		if (isset($data['filter_refer_no']) && !is_null($data['filter_refer_no'])) {
			$sql .= " AND s.refer_id = '" . $data['filter_refer_no'] . "'";
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
		
		if (!empty($data['filter_language'])) {
			$sql .= " AND s.student_language = '" . $this->db->escape($data['filter_language']) . "'";
		}
		
		if (!empty($data['filter_created_start_date'])) {
			$sql .= " AND DATE(s.created_at) >= '" . $this->db->escape($data['filter_created_start_date']) . "'";
		}

		if (!empty($data['filter_created_end_date'])) {
			$sql .= " AND DATE(s.created_at) <= '" . $this->db->escape($data['filter_created_end_date']) . "'";
		}
		
		if($jn_counsellor){
			$sql .= " GROUP BY s.id";
		}
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$Odr= " ORDER BY " . $this->inactivecolumns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$Odr= " ORDER BY s.id DESC";
		}
		
		$filterJoin = '';
		
		/* if($this->columns[$data['order'][0]['column']] == 'u.firstname' || !empty($data['filter_user_no']) || !empty($data['filter_search'])){
			$filterJoin.=" LEFT JOIN " . DB_PREFIX . "student_to_counsellor sc ON s.id = sc.student_id LEFT JOIN " . DB_PREFIX . "user u ON u.user_id = sc.user_id LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id";
		} */
		
		if($this->columns[$data['order'][0]['column']] == 'u.firstname' || !empty($data['filter_user_no'])){
			$filterJoin.=" LEFT JOIN " . DB_PREFIX . "user u ON u.user_id = sc.user_id LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id";
		}
		
		$sqlTemp=str_replace('@@SELECTCOLS@@','s.id',$sql);
		$sqlTemp=str_replace('@@MOREJOIN@@',$filterJoin,($sqlTemp.$Odr));
		//echo $sqlTemp;			
		$query = $this->db->query($sqlTemp);
		$result = $query->rows; //has enquiry ids filtered as array @ 15-mar-2023 -for faster result
		$recordsFiltered = (int)$query->num_rows;
		
		$ids=implode(', ', array_map(function ($result) {
			return $result['id'];
		}, $result));
		
		if(empty($ids)) $ids = 0;
		
		if (isset($data['start']) && isset($data['length'])) { 
			$LIMIT= " LIMIT " . (int)$data['start'] . "," . (int)$data['length'];
		}
		
		
		$finalSql = 'SELECT s.* from '. DB_PREFIX .'student s '.$filterJoin.' WHERE s.id in('.$ids.')'. $Odr. $LIMIT;
		
		$MOREJOIN = " LEFT JOIN " . DB_PREFIX . "user u ON u.user_id = s.link_user_id LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id LEFT JOIN " . DB_PREFIX . "student s1 ON s.refer_id = s1.id";
		
		$finalSql="Select s.*, u.firstname, u.lastname, u.email, ue.user_no, s1.student_name as refer_student_name, s1.student_no as refer_student_no FROM ( $finalSql )as s $MOREJOIN GROUP BY s.id $Odr ";
	  
		//echo $finalSql;
		$query = $this->db->query($finalSql);
		$result = $query->rows;
		return array('recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered, 'result' => $result);
	}
	
	public function getItemsForCounsellor($data = array()) {
		//print_r($data);
		$sql = "SELECT s.id FROM " . DB_PREFIX . "student s INNER JOIN " . DB_PREFIX . "student_to_counsellor sc ON s.id=sc.student_id WHERE s.student_delete_status=0 AND s.student_status = 0 AND sc.user_id = '".$data['filter_link_user_id']."'";
		
		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT s.*, s1.student_name as refer_student_name, s1.student_no as refer_student_no, sc.message_status, sc.whatsapp_status FROM `" . DB_PREFIX . "student` s INNER JOIN " . DB_PREFIX . "student_to_counsellor sc ON s.id=sc.student_id LEFT JOIN " . DB_PREFIX . "student s1 ON s.refer_id = s1.id";
		
		$sql .= " WHERE s.student_delete_status=0 AND s.student_status = 0 AND sc.user_id = '".$data['filter_link_user_id']."'";
		
		if (isset($data['filter_search']) && !is_null($data['filter_search'])) {
			$sql .= " AND (s.student_name LIKE '%" . $data['filter_search'] . "%' OR s.student_no LIKE '%" . $data['filter_search'] . "%' OR s.student_phone LIKE '" . $data['filter_search'] . "' OR s.student_email LIKE '" . $data['filter_search'] . "' OR s.student_gender LIKE '" . $data['filter_search'] . "' OR u.firstname LIKE '" . $data['filter_search'] . "' OR s1.student_name LIKE '" . $data['filter_search'] . "' OR s1.student_no LIKE '" . $data['filter_search'] . "' OR DATE(s.activated_at) = '" . $data['filter_search'] . "' OR DATE(s.created_at) = '" . $data['filter_search'] . "')";
		}
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND s.student_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_phone'])) {
			$sql .= " AND (s.student_phone LIKE '%" . $this->db->escape($data['filter_phone']) . "%' OR s.student_whatsapp LIKE '%" . $this->db->escape($data['filter_phone']) . "%')";
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
	
	public function getSeatItemsForCounsellor($data = array()) {
		//print_r($data);
		$sql = "SELECT s.id FROM " . DB_PREFIX . "student s INNER JOIN " . DB_PREFIX . "student_to_counsellor sc ON s.id=sc.student_id WHERE s.student_delete_status=0 AND s.student_status = 0 AND s.student_point != 0";
		if (!empty($data['filter_link_user_id'])) {
			$sql .= " AND sc.user_id = '".$data['filter_link_user_id']."'";
		} 
		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT s.*, s1.student_name as refer_student_name, s1.student_no as refer_student_no, sc.message_status FROM `" . DB_PREFIX . "student` s INNER JOIN " . DB_PREFIX . "student_to_counsellor sc ON s.id=sc.student_id LEFT JOIN " . DB_PREFIX . "student s1 ON s.refer_id = s1.id";
		
		$sql .= " WHERE s.student_delete_status=0 AND s.student_status = 0 AND s.student_point != 0";
		if (!empty($data['filter_link_user_id'])) {
			$sql .= " AND sc.user_id = '".$data['filter_link_user_id']."'";
		}
		if (isset($data['filter_search']) && !is_null($data['filter_search'])) {
			$sql .= " AND (s.student_name LIKE '%" . $data['filter_search'] . "%' OR s.student_no LIKE '%" . $data['filter_search'] . "%' OR s.student_phone LIKE '" . $data['filter_search'] . "' OR s.student_email LIKE '" . $data['filter_search'] . "' OR s.student_gender LIKE '" . $data['filter_search'] . "' OR u.firstname LIKE '" . $data['filter_search'] . "' OR s1.student_name LIKE '" . $data['filter_search'] . "' OR s1.student_no LIKE '" . $data['filter_search'] . "' OR DATE(s.activated_at) = '" . $data['filter_search'] . "' OR DATE(s.created_at) = '" . $data['filter_search'] . "')";
		}
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND s.student_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_phone'])) {
			$sql .= " AND (s.student_phone LIKE '%" . $this->db->escape($data['filter_phone']) . "%' OR s.student_whatsapp LIKE '%" . $this->db->escape($data['filter_phone']) . "%')";
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
			$sql .= " ORDER BY " . $this->counsellorseatcolumns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
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
	
	public function getSeatItemsForTrainer($data = array()) {
		//print_r($data);
		$sql = "SELECT s.id FROM " . DB_PREFIX . "student s WHERE s.student_delete_status=0 AND s.student_status = 0 AND s.student_point != 0";
		if (!empty($data['filter_link_user_id'])) {
			$sql .= " AND s.refer_id IN(SELECT id FROM " . DB_PREFIX . "student WHERE link_user_id = '".$data['filter_link_user_id']."')";
		}
		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT s.*, s1.student_name as refer_student_name, s1.student_no as refer_student_no FROM `" . DB_PREFIX . "student` s LEFT JOIN " . DB_PREFIX . "student s1 ON s.refer_id = s1.id";
		
		$sql .= " WHERE s.student_delete_status=0 AND s.student_status = 0 AND s.student_point != 0";
		if (!empty($data['filter_link_user_id'])) {
			$sql .= " AND s.refer_id IN(SELECT id FROM " . DB_PREFIX . "student WHERE link_user_id = '".$data['filter_link_user_id']."')";
		}
		if (isset($data['filter_search']) && !is_null($data['filter_search'])) {
			$sql .= " AND (s.student_name LIKE '%" . $data['filter_search'] . "%' OR s.student_no LIKE '%" . $data['filter_search'] . "%' OR s.student_phone LIKE '" . $data['filter_search'] . "' OR s.student_email LIKE '" . $data['filter_search'] . "' OR s.student_gender LIKE '" . $data['filter_search'] . "' OR u.firstname LIKE '" . $data['filter_search'] . "' OR s1.student_name LIKE '" . $data['filter_search'] . "' OR s1.student_no LIKE '" . $data['filter_search'] . "' OR DATE(s.activated_at) = '" . $data['filter_search'] . "' OR DATE(s.created_at) = '" . $data['filter_search'] . "')";
		}
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND s.student_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_phone'])) {
			$sql .= " AND (s.student_phone LIKE '%" . $this->db->escape($data['filter_phone']) . "%' OR s.student_whatsapp LIKE '%" . $this->db->escape($data['filter_phone']) . "%')";
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
			$sql .= " AND DATE(s.added_date) >= '" . $this->db->escape($data['filter_counsellor_added_start_date']) . "'";
		}

		if (!empty($data['filter_counsellor_added_end_date'])) {
			$sql .= " AND DATE(s.added_date) <= '" . $this->db->escape($data['filter_counsellor_added_end_date']) . "'";
		}
		
		$sql .= " GROUP BY s.id";
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->counsellorseatcolumns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY s.id DESC";
		}
		
		/* echo $sql; */
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
	
	public function getSeatItemsForTeamLeader($data = array()) {
		//print_r($data);
		$sql = "SELECT s.id FROM " . DB_PREFIX . "student s WHERE s.student_delete_status=0 AND s.student_status = 0 AND s.student_point != 0";
		if (!empty($data['filter_link_user_id'])) {
			$sql .= " AND s.refer_id IN(SELECT id FROM " . DB_PREFIX . "student WHERE link_user_id IN(SELECT user_id FROM bh_user_extra WHERE link_user_id = '".$data['filter_link_user_id']."'))";
		}
		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT s.*, s1.student_name as refer_student_name, s1.student_no as refer_student_no FROM `" . DB_PREFIX . "student` s LEFT JOIN " . DB_PREFIX . "student s1 ON s.refer_id = s1.id";
		
		$sql .= " WHERE s.student_delete_status=0 AND s.student_status = 0 AND s.student_point != 0";
		if (!empty($data['filter_link_user_id'])) {
			$sql .= " AND s.refer_id IN(SELECT id FROM " . DB_PREFIX . "student WHERE link_user_id IN(SELECT user_id FROM bh_user_extra WHERE link_user_id = '".$data['filter_link_user_id']."'))";
			/* $sql .= " AND s.link_user_id IN(SELECT user_id FROM bh_user_extra WHERE link_user_id = '".$data['filter_link_user_id']."')"; */
		}
		if (isset($data['filter_search']) && !is_null($data['filter_search'])) {
			$sql .= " AND (s.student_name LIKE '%" . $data['filter_search'] . "%' OR s.student_no LIKE '%" . $data['filter_search'] . "%' OR s.student_phone LIKE '" . $data['filter_search'] . "' OR s.student_email LIKE '" . $data['filter_search'] . "' OR s.student_gender LIKE '" . $data['filter_search'] . "' OR u.firstname LIKE '" . $data['filter_search'] . "' OR s1.student_name LIKE '" . $data['filter_search'] . "' OR s1.student_no LIKE '" . $data['filter_search'] . "' OR DATE(s.activated_at) = '" . $data['filter_search'] . "' OR DATE(s.created_at) = '" . $data['filter_search'] . "')";
		}
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND s.student_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_phone'])) {
			$sql .= " AND (s.student_phone LIKE '%" . $this->db->escape($data['filter_phone']) . "%' OR s.student_whatsapp LIKE '%" . $this->db->escape($data['filter_phone']) . "%')";
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
			$sql .= " AND DATE(s.added_date) >= '" . $this->db->escape($data['filter_counsellor_added_start_date']) . "'";
		}

		if (!empty($data['filter_counsellor_added_end_date'])) {
			$sql .= " AND DATE(s.added_date) <= '" . $this->db->escape($data['filter_counsellor_added_end_date']) . "'";
		}
		
		$sql .= " GROUP BY s.id";
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->counsellorseatcolumns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY s.id DESC";
		}
		
		/* echo $sql; */
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
	
	public function getItemsForController($data = array()) {
		//print_r($data);
		$sql = "SELECT id FROM " . DB_PREFIX . "student WHERE student_delete_status=0 AND student_status = 0 AND student_language IN (SELECT permission_language FROM " . DB_PREFIX . "user_to_language WHERE user_id = '".$this->user->getId()."')";

		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows;

		$sql = "SELECT @@SELECTCOLS@@ FROM " . DB_PREFIX . "student s @@MOREJOIN@@ WHERE s.student_delete_status=0 AND s.student_status = 0";
		
		if (!empty($data['filter_language'])) {
			$sql .= " AND s.student_language = '" . $this->db->escape($data['filter_language']) . "'";
		}else{
			$sql .= " AND s.student_language IN (SELECT permission_language FROM " . DB_PREFIX . "user_to_language WHERE user_id = '".$this->user->getId()."')";
		}

		$jn_counsellor=false;
		if (isset($data['filter_search']) && !is_null($data['filter_search'])) {
			$jn_counsellor=true;
			$sql .= " AND (s.student_name LIKE '%" . $data['filter_search'] . "%' OR s.student_no LIKE '%" . $data['filter_search'] . "%' OR s.student_phone LIKE '" . $data['filter_search'] . "' OR s.student_whatsapp LIKE '" . $data['filter_search'] . "' OR s.student_email LIKE '" . $data['filter_search'] . "' OR s.student_gender LIKE '" . $data['filter_search'] . "' OR s.student_language LIKE '" . $data['filter_search'] . "' OR DATE(s.activated_at) = '" . $data['filter_search'] . "' OR DATE(s.created_at) = '" . $data['filter_search'] . "')";
		}
		if (!empty($data['filter_name'])) {
			$sql .= " AND s.student_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_phone'])) {
			$sql .= " AND (s.student_phone LIKE '%" . $this->db->escape($data['filter_phone']) . "%' OR s.student_whatsapp LIKE '%" . $this->db->escape($data['filter_phone']) . "%')";
		}

		if (!empty($data['filter_whatsapp'])) {
			$sql .= " AND s.student_whatsapp LIKE '%" . $this->db->escape($data['filter_whatsapp']) . "%'";
		}

		if (isset($data['filter_student_no']) && !is_null($data['filter_student_no'])) {
			$sql .= " AND s.student_no = '" . $data['filter_student_no'] . "'";
		}

		if (isset($data['filter_user_no']) && !is_null($data['filter_user_no'])) {
			$jn_counsellor=true;
			$sql .= " AND ue.user_no = '" . $data['filter_user_no'] . "'";
		}

		if (isset($data['filter_refer_no']) && !is_null($data['filter_refer_no'])) {
			$sql .= " AND s.refer_id = '" . $data['filter_refer_no'] . "'";
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

		if($jn_counsellor){
			$sql .= " GROUP BY s.id";
		}
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$Odr= " ORDER BY " . $this->controllerinactivecolumns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$Odr= " ORDER BY s.id DESC";
		}

		$filterJoin = '';

		if($this->columns[$data['order'][0]['column']] == 'u.firstname' || !empty($data['filter_user_no'])){
			$filterJoin.=" LEFT JOIN " . DB_PREFIX . "student_to_counsellor sc ON s.id = sc.student_id LEFT JOIN " . DB_PREFIX . "user u ON u.user_id = sc.user_id LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id";
		}

		$sqlTemp=str_replace('@@SELECTCOLS@@','s.id',$sql);
		$sqlTemp=str_replace('@@MOREJOIN@@',$filterJoin,($sqlTemp.$Odr));
		//echo $sqlTemp;			
		$query = $this->db->query($sqlTemp);
		$result = $query->rows; //has enquiry ids filtered as array @ 15-mar-2023 -for faster result
		$recordsFiltered = (int)$query->num_rows;

		$ids=implode(', ', array_map(function ($result) {
			return $result['id'];
		}, $result));

		if (isset($data['start']) && isset($data['length'])) { 
			$LIMIT= " LIMIT " . (int)$data['start'] . "," . (int)$data['length'];
		}

		$finalSql = 'SELECT s.* from '. DB_PREFIX .'student s '.$filterJoin.' WHERE s.id in('.$ids.')'. $Odr. $LIMIT;

		$MOREJOIN = " LEFT JOIN " . DB_PREFIX . "student_to_counsellor sc ON s.id = sc.student_id LEFT JOIN " . DB_PREFIX . "user u ON u.user_id = sc.user_id LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id";

		$finalSql="Select s.*, u.firstname, u.lastname, u.email, ue.user_no FROM ( $finalSql )as s $MOREJOIN GROUP BY s.id $Odr ";

		//echo $finalSql;
		$query = $this->db->query($finalSql);
		$result = $query->rows;
		return array('recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered, 'result' => $result);
	}
	
	/* public function getItemsForController($data = array()) {
		$where = [];
		$filterJoin = '';

		// Required base filters
		$where[] = "s.student_delete_status = 0";
		$where[] = "s.student_status = 0";

		// Language filter
		if (!empty($data['filter_language'])) {
			$where[] = "s.student_language = '" . $this->db->escape($data['filter_language']) . "'";
		} else {
			$where[] = "s.student_language IN (
				SELECT permission_language 
				FROM " . DB_PREFIX . "user_to_language 
				WHERE user_id = '" . (int)$this->user->getId() . "'
			)";
		}

		// Search filter
		if (!empty($data['filter_search'])) {
			$search = $this->db->escape($data['filter_search']);
			$where[] = "(s.student_name LIKE '%{$search}%' 
				OR s.student_no LIKE '%{$search}%' 
				OR s.student_phone LIKE '{$search}' 
				OR s.student_whatsapp LIKE '{$search}' 
				OR s.student_email LIKE '{$search}' 
				OR s.student_gender LIKE '{$search}' 
				OR s.student_language LIKE '{$search}' 
				OR DATE(s.activated_at) = '{$search}' 
				OR DATE(s.created_at) = '{$search}')";
			$filterJoin .= " LEFT JOIN " . DB_PREFIX . "student_to_counsellor sc ON s.id = sc.student_id 
							 LEFT JOIN " . DB_PREFIX . "user u ON u.user_id = sc.user_id 
							 LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id";
		}

		// Individual filters
		if (!empty($data['filter_name'])) {
			$where[] = "s.student_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		if (!empty($data['filter_phone'])) {
			$phone = $this->db->escape($data['filter_phone']);
			$where[] = "(s.student_phone LIKE '%{$phone}%' OR s.student_whatsapp LIKE '%{$phone}%')";
		}
		if (!empty($data['filter_whatsapp'])) {
			$where[] = "s.student_whatsapp LIKE '%" . $this->db->escape($data['filter_whatsapp']) . "%'";
		}
		if (isset($data['filter_student_no']) && $data['filter_student_no'] !== '') {
			$where[] = "s.student_no = '" . $this->db->escape($data['filter_student_no']) . "'";
		}
		if (isset($data['filter_user_no']) && $data['filter_user_no'] !== '') {
			$where[] = "ue.user_no = '" . $this->db->escape($data['filter_user_no']) . "'";
			$filterJoin .= " LEFT JOIN " . DB_PREFIX . "student_to_counsellor sc ON s.id = sc.student_id 
							 LEFT JOIN " . DB_PREFIX . "user u ON u.user_id = sc.user_id 
							 LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id";
		}
		if (isset($data['filter_refer_no']) && $data['filter_refer_no'] !== '') {
			$where[] = "s.refer_id = '" . $this->db->escape($data['filter_refer_no']) . "'";
		}
		if (isset($data['filter_refer_id']) && $data['filter_refer_id'] !== '') {
			$where[] = "s.refer_id = '" . $this->db->escape($data['filter_refer_id']) . "'";
		}
		if (isset($data['filter_link_user_id']) && $data['filter_link_user_id'] !== '') {
			$where[] = "s.link_user_id = '" . $this->db->escape($data['filter_link_user_id']) . "'";
		}
		if (!empty($data['filter_email'])) {
			$where[] = "s.student_email LIKE '%" . $this->db->escape($data['filter_email']) . "%'";
		}
		if (!empty($data['filter_gender'])) {
			$where[] = "s.student_gender LIKE '%" . $this->db->escape($data['filter_gender']) . "%'";
		}
		if (!empty($data['filter_created_start_date'])) {
			$where[] = "DATE(s.created_at) >= '" . $this->db->escape($data['filter_created_start_date']) . "'";
		}
		if (!empty($data['filter_created_end_date'])) {
			$where[] = "DATE(s.created_at) <= '" . $this->db->escape($data['filter_created_end_date']) . "'";
		}

		// Combine WHERE
		$whereSQL = $where ? "WHERE " . implode(" AND ", $where) : "";

		// Sorting
		if (isset($data['order'][0]['column'])) {
			$colIndex = (int)$data['order'][0]['column'];
			$orderCol = $this->controllerinactivecolumns[$colIndex] ?? "s.id";
			$orderDir = (isset($data['order'][0]['dir']) && strtolower($data['order'][0]['dir']) === 'asc') ? "ASC" : "DESC";
		} else {
			$orderCol = "s.id";
			$orderDir = "DESC";
		}

		// Count total
		// Count total
		$recordquery = $this->db->query(
			"SELECT COUNT(*) AS cnt 
			 FROM " . DB_PREFIX . "student 
			 WHERE student_delete_status = 0 AND student_status = 0"
		);
		$recordsTotal = $recordquery->row['cnt'];

		// Count filtered
		$filteredquery = $this->db->query(
			"SELECT COUNT(DISTINCT s.id) AS cnt 
			 FROM " . DB_PREFIX . "student s 
			 {$filterJoin} 
			 {$whereSQL}"
		);
		$recordsFiltered = $filteredquery->row['cnt'];


		// Pagination
		$limitSQL = "";
		if (isset($data['start']) && isset($data['length']) && $data['length'] != -1) {
			$limitSQL = " LIMIT " . (int)$data['start'] . ", " . (int)$data['length'];
		}

		// Final data query
		$finalSql = "
			SELECT s.id, s.student_no, s.student_point, s.joining_point, s.student_name, s.student_phone, s.student_whatsapp, s.student_telegram, s.student_language, s.student_email, s.created_at, s.student_status
			FROM " . DB_PREFIX . "student s
			{$filterJoin}
			{$whereSQL}
			GROUP BY s.id
			ORDER BY {$orderCol} {$orderDir}
			{$limitSQL}
		";

		$result = $this->db->query($finalSql)->rows;

		return [
			'recordsTotal' => $recordsTotal,
			'recordsFiltered' => $recordsFiltered,
			'result' => $result
		];
	} */

	public function addToCounsellor($counsellor_id, $filter){
		$students = explode(',', $filter);
		foreach($students as $student_id){
			$this->db->query("DELETE FROM " . DB_PREFIX . "student_to_counsellor WHERE student_id = '".$student_id."'");
			$this->db->query("INSERT INTO `" . DB_PREFIX . "student_to_counsellor` set student_id = '".$student_id."', user_id = '" . (int)$counsellor_id . "', added_date = '" . date('Y-m-d H:i:s') . "'");
		}
	}
	
	public function addToTrainer($trainer_id, $filter){
		$students = explode(',', $filter);
		foreach($students as $student_id){
			$this->db->query("UPDATE `" . DB_PREFIX . "student` set link_user_id = '".$trainer_id."' WHERE id = '".$student_id."'");
			$this->db->query("UPDATE `" . DB_PREFIX . "student_active_history` set user_id = '".$trainer_id."' WHERE student_id = '".$student_id."'");
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
	
	public function checkTeamLeaderExist(){
		$this->load->model('user/user');
		$tl_no = $this->config->get('config_team_leader_no');
		if(empty($tl_no)){
		   return false; 
		}else{
    		$data = $this->model_user_user->getSubItems(array('filter_group_id'=>12, 'filter_user_no'=>$tl_no,'filter_status'=>1));
    		if(empty($data['result'])){
    			return false;
    		}else{
    			return $data['result'];
    		}
		}
	}
	
	public function blockStudent($id){
		$std = $this->db->query("SELECT student_status FROM `bh_student` WHERE id = $id");
		if($std->row['student_status']==2){
			return false;
		}else{
			$this->db->query("UPDATE bh_student SET student_status = 2 WHERE id=".(int)$id);
			return true;
		}
	}
	
	public function unblockStudent($id){
		$std = $this->db->query("SELECT student_status FROM `bh_student` WHERE id = $id");
		if($std->row['student_status']!=2){
			return false;
		}else{
			$this->db->query("UPDATE bh_student SET student_status = 1 WHERE id=".(int)$id);
			return true;
		}
	}
	
public function activateStudent($filter){

	$teamleader = $this->checkTeamLeaderExist();

	if($teamleader == false){

		$students = explode(',', $filter);

		foreach($students as $student_id){

			$student_id = (int)$student_id;

			$std_info = $this->get($student_id);

			$refer_id = $this->getReferIdByStudentId($student_id);

			$std_refer_info = $this->get($refer_id);

			$counsellor_id = $this->getCounsellorIdByStudentId($student_id);

			$refer_student_trainer_id = 0;
			$refer_student_teamleader_id = 0;
			$refer_student_seniorteamleader_id = 0;

			$active_history = $this->db->query("
				SELECT count(*) as total 
				FROM `bh_student_active_history` 
				WHERE student_id = '".(int)$student_id."'
			");

			$total_status = $active_history->row['total'];

			if($total_status == 0){

				if($refer_id != 0){

					$refer_student_trainer_id = isset($std_refer_info['link_user_id'])
						? (int)$std_refer_info['link_user_id']
						: 0;

					// TRAINER -> TEAM LEADER
					if($refer_student_trainer_id > 0){

						$query = $this->db->query("
							SELECT * 
							FROM `bh_user_extra` 
							WHERE user_id = '".(int)$refer_student_trainer_id."'
						");

						$refer_student_teamleader_id = isset($query->row['link_user_id'])
							? (int)$query->row['link_user_id']
							: 0;
					}

					// TEAM LEADER -> SENIOR TEAM LEADER
					if($refer_student_teamleader_id > 0){

						$query = $this->db->query("
							SELECT * 
							FROM `bh_user_extra` 
							WHERE user_id = '".(int)$refer_student_teamleader_id."'
						");

						$refer_student_seniorteamleader_id = isset($query->row['link_user_id'])
							? (int)$query->row['link_user_id']
							: 0;
					}

					// Get student information
$student = $this->db->query("
    SELECT student_mobile, student_whatsapp
    FROM bh_student
    WHERE id = '".(int)$refer_id."'
")->row_array();

// Check if India (+91)
$isIndia = false;

if (!empty($student['student_mobile']) && strpos(trim($student['student_mobile']), '+91') === 0) {
    $isIndia = true;
}

if (!$isIndia && !empty($student['student_whatsapp']) && strpos(trim($student['student_whatsapp']), '+91') === 0) {
    $isIndia = true;
}

// Get Refer Activated Point
if ($isIndia) {
    $refer_activated_point = $this->config->get('config_india_refer_activated_point');
} else {
    $refer_activated_point = $this->config->get('config_refer_activated_point');
}

					$data = array(
						'student_id'   => $refer_id,
						'reason'       => 'Refer Student Activated',
						'description'  => 'Point earn for activated refer ID '.$std_info['student_no'].' Name '.$std_info['student_name'],
						'credit_point' => $refer_activated_point,
						'debit_point'  => 0,
						'type'         => 'Credit'
					);

					$this->managePoint($data);
				}

				// Get student information
$student = $this->db->query("
    SELECT student_mobile, student_whatsapp
    FROM bh_student
    WHERE id = '".(int)$student_id."'
")->row_array();

// Detect India (+91)
$isIndia = false;

if (!empty($student['student_mobile']) && strpos(trim($student['student_mobile']), '+91') === 0) {
    $isIndia = true;
} elseif (!empty($student['student_whatsapp']) && strpos(trim($student['student_whatsapp']), '+91') === 0) {
    $isIndia = true;
}

// Select cashback point
if ($isIndia) {
    $config_cashback_point = $this->config->get('config_india_cashback_point');
} else {
    $config_cashback_point = $this->config->get('config_cashback_point');
}

$this->managePoint(array(
    'student_id'   => $student_id,
    'reason'       => 'Student Cashback Point',
    'description'  => 'Cashback Point From Admin',
    'credit_point' => $config_cashback_point,
    'debit_point'  => 0,
    'type'         => 'Credit'
));

				$this->edit($student_id, array(
					'link_user_id' => $refer_student_trainer_id,
					'activated_at' => date('Y-m-d H:i:s'),
					'link_user_at' => date('Y-m-d H:i:s'),
					'student_status' => 1,
					'activated_by' => $this->user->getId()
				));

				$this->db->query("
					INSERT INTO " . DB_PREFIX . "student_active_history 
					SET 
						student_id = '".(int)$student_id."',
						refer_student_id = '".(int)$refer_id."',
						refer_student_trainer_id = '".(int)$refer_student_trainer_id."',
						refer_student_teamleader_id = '".(int)$refer_student_teamleader_id."',
						refer_student_seniorteamleader_id = '".(int)$refer_student_seniorteamleader_id."',
						user_id = '0',
						team_leader_id = '".(int)$refer_student_teamleader_id."',
						counsellor_id = '".(int)$counsellor_id."',
						added_on = '".date('Y-m-d H:i:s')."'
				");
			}
		}

		return true;

	}else{

		$students = explode(',', $filter);

		foreach($students as $student_id){

			$student_id = (int)$student_id;

			$std_info = $this->get($student_id);

			$refer_id = $this->getReferIdByStudentId($student_id);

			$std_refer_info = $this->get($refer_id);

			$counsellor_id = $this->getCounsellorIdByStudentId($student_id);

			$refer_student_trainer_id = 0;
			$refer_student_teamleader_id = 0;
			$refer_student_seniorteamleader_id = 0;

			$active_history = $this->db->query("
				SELECT count(*) as total 
				FROM `bh_student_active_history` 
				WHERE student_id = '".(int)$student_id."'
			");

			$total_status = $active_history->row['total'];

			if($total_status == 0){

				if($refer_id != 0){

					$refer_student_trainer_id = isset($std_refer_info['link_user_id'])
						? (int)$std_refer_info['link_user_id']
						: 0;

					// TRAINER -> TEAM LEADER
					if($refer_student_trainer_id > 0){

						$query = $this->db->query("
							SELECT * 
							FROM `bh_user_extra` 
							WHERE user_id = '".(int)$refer_student_trainer_id."'
						");

						$refer_student_teamleader_id = isset($query->row['link_user_id'])
							? (int)$query->row['link_user_id']
							: 0;
					}

					// TEAM LEADER -> SENIOR TEAM LEADER
					if($refer_student_teamleader_id > 0){

						$query = $this->db->query("
							SELECT * 
							FROM `bh_user_extra` 
							WHERE user_id = '".(int)$refer_student_teamleader_id."'
						");

						$refer_student_seniorteamleader_id = isset($query->row['link_user_id'])
							? (int)$query->row['link_user_id']
							: 0;
					}

					// Check activated student's mobile number
$isIndia = false;

if (!empty($std_info['student_whatsapp']) && strpos(trim($std_info['student_whatsapp']), '+91') === 0) {
    $isIndia = true;
} elseif (!empty($std_info['student_mobile']) && strpos(trim($std_info['student_mobile']), '+91') === 0) {
    $isIndia = true;
}

if ($isIndia) {
    $refer_activated_point = $this->config->get('config_india_refer_activated_point');
} else {
    $refer_activated_point = $this->config->get('config_refer_activated_point');
}

					$data = array(
						'student_id'   => $refer_id,
						'reason'       => 'Refer Student Activated',
						'description'  => 'Point earn for activated refer ID '.$std_info['student_no'].' Name '.$std_info['student_name'],
						'credit_point' => $refer_activated_point,
						'debit_point'  => 0,
						'type'         => 'Credit'
					);

					$this->managePoint($data);
				}

				// Get student mobile/WhatsApp
$student = $this->db->query("
    SELECT student_mobile, student_whatsapp
    FROM bh_student
    WHERE id = '".(int)$student_id."'
")->row_array();

// Check if India (+91)
$isIndia = false;

if (!empty($student['student_mobile']) && strpos(trim($student['student_mobile']), '+91') === 0) {
    $isIndia = true;
}

if (!$isIndia && !empty($student['student_whatsapp']) && strpos(trim($student['student_whatsapp']), '+91') === 0) {
    $isIndia = true;
}

// Get cashback point
if ($isIndia) {
    $config_cashback_point = $this->config->get('config_india_cashback_point');
} else {
    $config_cashback_point = $this->config->get('config_cashback_point');
}

$this->managePoint(array(
    'student_id'   => $student_id,
    'reason'       => 'Student Cashback Point',
    'description'  => 'Cashback Point From Admin',
    'credit_point' => $config_cashback_point,
    'debit_point'  => 0,
    'type'         => 'Credit'
));

				$this->edit($student_id, array(
					'link_user_id' => 0,
					'activated_at' => date('Y-m-d H:i:s'),
					'link_user_at' => date('Y-m-d H:i:s'),
					'student_status' => 1,
					'activated_by' => $this->user->getId()
				));

				$this->db->query("
					INSERT INTO " . DB_PREFIX . "student_active_history 
					SET 
						student_id = '".(int)$student_id."',
						refer_student_id = '".(int)$refer_id."',
						refer_student_trainer_id = '".(int)$refer_student_trainer_id."',
						refer_student_teamleader_id = '".(int)$refer_student_teamleader_id."',
						refer_student_seniorteamleader_id = '".(int)$refer_student_seniorteamleader_id."',
						user_id = '0',
						team_leader_id = '".(int)$teamleader[0]['user_id']."',
						counsellor_id = '".(int)$counsellor_id."',
						added_on = '".date('Y-m-d H:i:s')."'
				");
			}
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
	
	public function whatsappmessage($student_id) {
		$this->db->query("UPDATE `" . DB_PREFIX . "student_to_counsellor` set whatsapp_status = '0', whatspp_wrong_date='".date('Y-m-d')."' WHERE student_id = '" . (int)$student_id . "' AND user_id='".$this->user->getId()."'");
	}
	
	public function checkClassworkPointExistForADayForCourse($student_id, $description) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "student_passbook WHERE student_id = '" . (int)$student_id . "' AND description='".$description."' AND date(created_at)='".date('Y-m-d')."'");
		return $query->row;
	}
	
	public function checkClassworkPointExistForADay($student_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "student_passbook WHERE student_id = '" . (int)$student_id . "' AND reason='Sample Work' AND date(created_at)='".date('Y-m-d')."'");
		return $query->row;
	}
	
	public function getTotalWithdrawalRequestByStudent($student_id) {
		$query = $this->db->query("SELECT count(*) as total FROM " . DB_PREFIX . "student_withdrawal_request WHERE student_id = '" . (int)$student_id . "' AND approve_status != 'Cancel' ");
		return $query->row['total'];
	}
}