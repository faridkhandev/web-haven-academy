<?php
class ModelUserUser extends Model {
	public $columns = array('u.user_id', 'u.username', 'ug.name', 'u.date_added', 'u.status');
	public $subcolumns = array('ue.user_no', 'u.firstname', 'u.username', 'u.email','ue.phone', 'ue.whatsapp', 'u1.firstname', 'u.date_added', 'u.status');
	public function addUser($data) {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "user` SET username = '" . $this->db->escape($data['username']) . "', user_group_id = '" . (int)$data['user_group_id'] . "', salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', image = '" . $this->db->escape($data['image']) . "', status = '" . (int)$data['status'] . "', date_added = NOW()");
	}

	public function editUser($user_id, $data) {
		$this->db->query("UPDATE `" . DB_PREFIX . "user` SET username = '" . $this->db->escape($data['username']) . "', user_group_id = '" . (int)$data['user_group_id'] . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', image = '" . $this->db->escape($data['image']) . "', status = '" . (int)$data['status'] . "' WHERE user_id = '" . (int)$user_id . "'");

		if ($data['password']) {
			$this->db->query("UPDATE `" . DB_PREFIX . "user` SET salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "' WHERE user_id = '" . (int)$user_id . "'");
		}
	}

	public function editPassword($user_id, $password) {
		$this->db->query("UPDATE `" . DB_PREFIX . "user` SET salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($password)))) . "', code = '' WHERE user_id = '" . (int)$user_id . "'");
	}
	
	public function changePassword($data) {
		$this->db->query("UPDATE `" . DB_PREFIX . "user` SET salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', code = '' WHERE user_id = '" . (int)$this->user->getId() . "'");
	}

	public function editCode($email, $code) {
		$this->db->query("UPDATE `" . DB_PREFIX . "user` SET code = '" . $this->db->escape($code) . "' WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");
	}

	public function deleteUser($user_id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "user` WHERE user_id = '" . (int)$user_id . "'");
	}

	public function getUser($user_id) {
		$query = $this->db->query("SELECT u.*, (SELECT ug.name FROM `" . DB_PREFIX . "user_group` ug WHERE ug.user_group_id = u.user_group_id) AS user_group, ue.* FROM `" . DB_PREFIX . "user` u LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id WHERE u.user_id = '" . (int)$user_id . "'");

		return $query->row;
	}
	
	public function get($user_id) {
		$query = $this->db->query("SELECT u.*, (SELECT ug.name FROM `" . DB_PREFIX . "user_group` ug WHERE ug.user_group_id = u.user_group_id) AS user_group, ue.* FROM `" . DB_PREFIX . "user` u LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id WHERE u.user_id = '" . (int)$user_id . "'");

		return $query->row;
	}
	
	/* public function getUserByGroup($user_id, ) {
		$query = $this->db->query("SELECT u.*, ue.*, ug.name FROM `" . DB_PREFIX . "user` u INNER JOIN " . DB_PREFIX . "user_group ug ON u.user_group_id = ug.user_group_id WHERE u.user_id = '" . (int)$user_id . "'");

		return $query->row;
	} */

	public function getUserByUsername($username) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user` WHERE username = '" . $this->db->escape($username) . "'");

		return $query->row;
	}
	
	public function getUserByEmail($email) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user` WHERE email = '" . $this->db->escape($email) . "'");

		return $query->row;
	}

	public function getUserByCode($code) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user` WHERE code = '" . $this->db->escape($code) . "' AND code != ''");

		return $query->row;
	}
	
	public function getItems($data = array()) {
		//print_r($data);
		$query = $this->db->query("SELECT user_id FROM " . DB_PREFIX . "user WHERE delete_status=0 AND user_group_id=3");
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT u.*, ue.* FROM " . DB_PREFIX . "user u LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id";
		
		$sql .= " WHERE u.delete_status=0 AND u.user_group_id=3";
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND ug.alias_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND u.status = '" . $data['filter_status'] . "'";
		}
		if (isset($data['filter_mobile']) && !is_null($data['filter_mobile'])) {
			$sql .= " AND ug.business_contact = '" . $data['filter_mobile'] . "'";
		}
		
		if (!empty($data['filter_start_date'])) {
			$sql .= " AND DATE(u.date_added) >= '" . $this->db->escape($data['filter_start_date']) . "'";
		}

		if (!empty($data['filter_end_date'])) {
			$sql .= " AND DATE(u.date_modified) <= '" . $this->db->escape($data['filter_end_date']) . "'";
		}
		
		$sql .= " GROUP BY u.user_id";
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->columns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY u.user_id DESC";
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
	
	public function getSubItems($data = array()) {
		//print_r($data);	
		$sql ="SELECT u.user_id FROM " . DB_PREFIX . "user JOIN " . DB_PREFIX . "user_group ug ON u.user_group_id=ug.user_group_id";
		
		if (isset($data['filter_group_id']) && !is_null($data['filter_group_id'])) {
			$sql .= " AND u.user_group_id = '" . (int)$data['filter_group_id'] . "'";
		}
		
		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT u.*, ug.name as user_group, ue.phone, ue.whatsapp, ue.link_user_id, ue.gender, ue.city, ue.language, ue.user_no, u1.firstname as reference_firstname, u1.lastname  as reference_lastname, ue1.user_no as reference_user_no FROM " . DB_PREFIX . "user u JOIN " . DB_PREFIX . "user_group ug ON u.user_group_id=ug.user_group_id LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id LEFT JOIN " . DB_PREFIX . "user u1 ON ue.link_user_id = u1.user_id LEFT JOIN " . DB_PREFIX . "user_extra ue1 ON ue1.link_user_id = u1.user_id WHERE 1=1";
		
		if (isset($data['filter_group_id']) && !is_null($data['filter_group_id'])) {
			$implode[] = "u.user_group_id = '" . (int)$data['filter_group_id'] . "'";
		}
		
		if (!empty($data['filter_name'])) {
			$implode[] = "u.firstname LIKE '%" . $data['filter_name'] . "%'";
		}
		
		if (!empty($data['filter_phone'])) {
			$implode[] = "ue.phone LIKE '%" . $data['filter_phone'] . "%'";
		}
		
		if (!empty($data['filter_user_no'])) {
			$implode[] = "ue.user_no LIKE '%" . $data['filter_user_no'] . "%'";
		}
		
		if (!empty($data['filter_email'])) {
			$implode[] = "u.phone LIKE '%" . $data['filter_email'] . "%'";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$implode[] = "u.status = '" . (int)$data['filter_status'] . "'";
		}
		
		if (isset($data['filter_relation_id']) && !is_null($data['filter_relation_id'])) {
			$implode[] = "ue.link_user_id = '" . (int)$data['filter_relation_id'] . "'";
		}
		
		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}
		
		$sql .= " GROUP BY u.user_id";
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->subcolumns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY u.date_added";
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

	public function getUsers($data = array()) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "user`";
		if (!empty($data['filter_group_id'])) {
			$sql .= " AND user_group_id = '" . (int)$data['filter_group_id'] . "'";
		}
		$sort_data = array(
			'username',
			'status',
			'date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY username";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotalUsers($data=array()) {
		$sql ="SELECT COUNT(*) AS total FROM " . DB_PREFIX . "user u INNER JOIN " . DB_PREFIX . "user_group ug ON u.user_group_id=ug.user_group_id WHERE 1=1";
		
		if (isset($data['filter_group_id']) && !is_null($data['filter_group_id'])) {
			$implode[] = "u.user_group_id = '" . (int)$data['filter_group_id'] . "'";
		}
		
		if (!empty($data['filter_name'])) {
			$implode[] = "u.firstname LIKE '%" . $data['filter_name'] . "%'";
		}
		
		if (!empty($data['filter_phone'])) {
			$implode[] = "ue.phone LIKE '%" . $data['filter_phone'] . "%'";
		}
		
		if (!empty($data['filter_user_no'])) {
			$implode[] = "ue.user_no LIKE '%" . $data['filter_user_no'] . "%'";
		}
		
		if (!empty($data['filter_email'])) {
			$implode[] = "u.phone LIKE '%" . $data['filter_email'] . "%'";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$implode[] = "u.status = '" . (int)$data['filter_status'] . "'";
		}
		
		if (isset($data['filter_team_leader']) && !is_null($data['filter_team_leader'])) {
			$implode[] = "ue.link_user_id = '" . (int)$data['filter_team_leader'] . "'";
		}
		
		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}
		//echo $sql;
		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	public function getTotalUsersAjax() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "user` WHERE user_group_id = '10'");

		return $query->row['total'];
	}

	public function getTotalUsersByGroupId($user_group_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "user` WHERE user_group_id = '" . (int)$user_group_id . "'");

		return $query->row['total'];
	}

	public function getTotalUsersByEmail($email) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "user` WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row['total'];
	}
	
	public function getTotalUsersByDay() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "user` WHERE DATE(date_added) = DATE(NOW()) AND user_group_id = 10");
		return $query->row['total'];
	}
	
	public function getTotalUsersByWeek() {
		$date_start = strtotime('-' . date('w') . ' days');
		
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "user` WHERE DATE(date_added) >= DATE('" . $this->db->escape(date('Y-m-d', $date_start)) . "') AND user_group_id = 10");
		return $query->row['total'];
	}
	
	public function getTotalUsersByMonth() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "user` WHERE DATE(date_added) >= '" . $this->db->escape(date('Y') . '-' . date('m') . '-1') . "' AND user_group_id = 10");
		return $query->row['total'];
	}
	
	public function getTotalUsersByYear() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "user` WHERE YEAR(date_added) = YEAR(NOW()) AND user_group_id = 10");
		return $query->row['total'];
	}
	
	public function editUserProfile($user_id, $data){
		$this->db->query("UPDATE `" . DB_PREFIX . "user` SET firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', image = '" . $this->db->escape($data['image']) . "' WHERE user_id = '" . (int)$user_id . "'");
		
		$this->db->query("UPDATE " . DB_PREFIX . "user_extra SET phone = '" . $this->db->escape($data['phone']) . "', whatsapp = '" . $this->db->escape($data['whatsapp']) . "', gender = '" .$data['gender']. "', city = '" . $this->db->escape($data['city']) . "', language = '" . $this->db->escape($data['language']) . "' WHERE user_id = '" . (int)$user_id . "'");
		
		if ($data['password']) {
			$this->db->query("UPDATE `" . DB_PREFIX . "user` SET salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "' WHERE user_id = '" . (int)$user_id . "'");
		}
	}
	
	public function addSubUser($data) {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "user` SET username = '', user_group_id = '" . (int)$data['user_group_id'] . "', salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', image = '" . $this->db->escape($data['image']) . "', status = '" . (int)$data['status'] . "', date_added = NOW()");
		
		$user_id = $this->db->getLastId();
		
		$user_total = $this->getTotalUsers(array('filter_group_id'=>$data['user_group_id']));
		
		if($data['user_group_id']==11){
			$user_no='TRA'.(1111111+$user_total);
		}elseif($data['user_group_id']==12){
			$user_no='TLE'.(1111111+$user_total);
		}elseif($data['user_group_id']==13){
			$user_no='STL'.(1111111+$user_total);
		}elseif($data['user_group_id']==14){
			$user_no='TEA'.(1111111+$user_total);
		}elseif($data['user_group_id']==15){
			$user_no='COU'.(1111111+$user_total);
		}
		
		$this->db->query("UPDATE `" . DB_PREFIX . "user` SET username = '" . $this->db->escape($user_no) . "' WHERE user_id = '" . (int)$user_id . "'");
		
		
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "user_extra SET user_id = '" . (int)$user_id . "', phone = '" . $this->db->escape($data['phone']) . "', whatsapp = '" . $this->db->escape($data['whatsapp']) . "', link_user_id = '" . $this->db->escape($data['link_user_id']) . "', gender = '" .$data['gender']. "', city = '" . $this->db->escape($data['city']) . "', language = '" . $this->db->escape($data['language']) . "', user_no = '" . $this->db->escape($user_no) . "'");
		
 		if(isset($data['payment_medium'])){
			foreach($data['payment_medium'] as $item){
				$this->db->query("INSERT INTO " . DB_PREFIX . "user_payment_medium SET user_id = '" . (int)$user_id . "', medium_name = '" . $this->db->escape($item['medium_name']) . "', medium_code = '" . $this->db->escape($item['medium_code']) . "', medium_status = '" . $this->db->escape($item['medium_status']) . "'");
			}
		}
	}

	public function editSubUser($user_id, $data) {
		$this->db->query("UPDATE `" . DB_PREFIX . "user` SET username = '" . $this->db->escape($data['username']) . "', user_group_id = '" . (int)$data['user_group_id'] . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', image = '" . $this->db->escape($data['image']) . "', status = '" . (int)$data['status'] . "' WHERE user_id = '" . (int)$user_id . "'");

		if ($data['password']) {
			$this->db->query("UPDATE `" . DB_PREFIX . "user` SET salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "' WHERE user_id = '" . (int)$user_id . "'");
		}
		
		$this->db->query("UPDATE " . DB_PREFIX . "user_extra SET phone = '" . $this->db->escape($data['phone']) . "', whatsapp = '" . $this->db->escape($data['whatsapp']) . "', link_user_id = '" . $this->db->escape($data['link_user_id']) . "', gender = '" .$data['gender']. "', city = '" . $this->db->escape($data['city']) . "', language = '" . $this->db->escape($data['language']) . "' WHERE user_id = '" . (int)$user_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "user_payment_medium WHERE user_id = '" . (int)$user_id . "'");
		if(isset($data['payment_medium'])){
			foreach($data['payment_medium'] as $item){
				$this->db->query("INSERT INTO " . DB_PREFIX . "user_payment_medium SET user_id = '" . (int)$user_id . "', medium_name = '" . $this->db->escape($item['medium_name']) . "', medium_code = '" . $this->db->escape($item['medium_code']) . "', medium_status = '" . $this->db->escape($item['medium_status']) . "'");
			}
		}
	}
	
	public function getUserPaymentMedium($user_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user_payment_medium` WHERE user_id = '" . $user_id . "'");

		return $query->rows;
	}
	
	public function getMyUsers($user_id) {
		$query = $this->db->query("SELECT user_id FROM `" . DB_PREFIX . "user_extra` WHERE link_user_id = '" . $user_id . "'");
		$users = [];
		$result = $query->rows;
		$user_ids=implode(', ', array_map(function ($result) {
			return $result['user_id'];
		}, $result));
		return $user_ids;
	}
}