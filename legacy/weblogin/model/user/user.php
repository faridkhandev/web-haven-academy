<?php
class ModelUserUser extends Model {
	public $columns = array('u.user_id', 'u.username', 'ug.name', 'u.date_added', 'u.status');
	public $subcolumns = array('ue.user_no', 'u.firstname', 'u.email','ue.phone', 'ue.whatsapp', 'u1.firstname', 'u.date_added', 'u.status');
	public $controllercolumns = array('ue.user_no', 'u.firstname', 'u.email','ue.phone', 'ue.whatsapp', 'ul.permission_language', 'u1.firstname', 'u.date_added', 'u.status');
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
		$this->db->query("UPDATE `" . DB_PREFIX . "user` SET password = '" . $this->db->escape(md5($data['password'])) . "', code = '' WHERE user_id = '" . (int)$this->user->getId() . "'");
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
	
	public function getControllerUser($user_id) {
		$query = $this->db->query("SELECT u.*, (SELECT ug.name FROM `" . DB_PREFIX . "user_group` ug WHERE ug.user_group_id = u.user_group_id) AS user_group, ue.*, ul.permission_language FROM `" . DB_PREFIX . "user` u LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id LEFT JOIN " . DB_PREFIX . "user_to_language ul ON u.user_id = ul.user_id WHERE u.user_id = '" . (int)$user_id . "'");

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
	
	public function getGroupUserByEmail($email, $user_group_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user` WHERE email = '" . $this->db->escape($email) . "' AND user_group_id='".$user_group_id."'");

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
		$sql ="SELECT u.user_id FROM " . DB_PREFIX . "user u JOIN " . DB_PREFIX . "user_group ug ON u.user_group_id=ug.user_group_id";
		
		if (isset($data['filter_group_id']) && !is_null($data['filter_group_id'])) {
			$sql .= " AND u.user_group_id = '" . (int)$data['filter_group_id'] . "'";
		}
		
		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT u.*, ug.name as user_group, ue.phone, ue.whatsapp, ue.link_user_id, ue.gender, ue.city, ue.language, ue.user_no, u1.firstname as reference_firstname, u1.lastname  as reference_lastname, ue1.user_no as reference_user_no FROM " . DB_PREFIX . "user u JOIN " . DB_PREFIX . "user_group ug ON u.user_group_id=ug.user_group_id LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id LEFT JOIN " . DB_PREFIX . "user u1 ON ue.link_user_id = u1.user_id LEFT JOIN " . DB_PREFIX . "user_extra ue1 ON ue1.user_id = u1.user_id WHERE 1=1";
		
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
			$implode[] = "u.email LIKE '%" . $data['filter_email'] . "%'";
		}
		
		if (!empty($data['filter_language'])) {
			$implode[] = "ue.language IN (" . $data['filter_language'] . ")";
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
	
	public function getControllerItems($data = array()) {
		//print_r($data);	
		$sql ="SELECT u.user_id FROM " . DB_PREFIX . "user u JOIN " . DB_PREFIX . "user_group ug ON u.user_group_id=ug.user_group_id";
		
		if (isset($data['filter_group_id']) && !is_null($data['filter_group_id'])) {
			$sql .= " AND u.user_group_id = '" . (int)$data['filter_group_id'] . "'";
		}
		
		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT u.*, ug.name as user_group, ue.phone, ue.whatsapp, ue.link_user_id, ue.gender, ue.city, ue.language, ue.user_no, u1.firstname as reference_firstname, u1.lastname  as reference_lastname, ue1.user_no as reference_user_no, ul.permission_language FROM " . DB_PREFIX . "user u JOIN " . DB_PREFIX . "user_group ug ON u.user_group_id=ug.user_group_id LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id LEFT JOIN " . DB_PREFIX . "user_to_language ul ON u.user_id = ul.user_id LEFT JOIN " . DB_PREFIX . "user u1 ON ue.link_user_id = u1.user_id LEFT JOIN " . DB_PREFIX . "user_extra ue1 ON ue1.user_id = u1.user_id WHERE 1=1";
		
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
			$implode[] = "u.email LIKE '%" . $data['filter_email'] . "%'";
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
			$sql .= " ORDER BY " . $this->controllercolumns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
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
	
	public function getMyTrainers($data = array()) {
		//print_r($data);	
		if($this->user->getGroupId() == 13){
			$mytrainers = $this->getMyTrainersForSeniorTeamLeader($this->user->getId(), false);
		}
		if($this->user->getGroupId() == 12){
			$mytrainers = $this->getMyTrainersForTeamLeader($this->user->getId(), false);
		}
		$sql ="SELECT u.user_id FROM " . DB_PREFIX . "user u JOIN " . DB_PREFIX . "user_group ug ON u.user_group_id=ug.user_group_id";
		
		$sql .= " AND u.user_group_id = 11 AND u.user_id IN(".$mytrainers.")";
		
		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT u.*, ug.name as user_group, ue.phone, ue.whatsapp, ue.link_user_id, ue.gender, ue.city, ue.language, ue.user_no, u1.firstname as reference_firstname, u1.lastname  as reference_lastname, ue1.user_no as reference_user_no FROM " . DB_PREFIX . "user u JOIN " . DB_PREFIX . "user_group ug ON u.user_group_id=ug.user_group_id LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id LEFT JOIN " . DB_PREFIX . "user u1 ON ue.link_user_id = u1.user_id LEFT JOIN " . DB_PREFIX . "user_extra ue1 ON ue1.user_id = u1.user_id WHERE 1=1";
		
		$sql .= " AND u.user_group_id = 11 AND u.user_id IN(".$mytrainers.")";
		
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
	
	public function getMyTeamLeaderItems($data = array()) {
		//print_r($data);	
		$myusers = $this->getMyUsers($this->user->getId());
		$sql ="SELECT u.user_id FROM " . DB_PREFIX . "user JOIN " . DB_PREFIX . "user_group ug ON u.user_group_id=ug.user_group_id";
		
		$sql .= " AND u.user_group_id = 11 AND u.user_id IN(".$myusers.")";
		
		$query = $this->db->query($sql);
		$recordsTotal = (int)$query->num_rows;
		
		$sql = "SELECT u.*, ug.name as user_group, ue.phone, ue.whatsapp, ue.link_user_id, ue.gender, ue.city, ue.language, ue.user_no, u1.firstname as reference_firstname, u1.lastname  as reference_lastname, ue1.user_no as reference_user_no FROM " . DB_PREFIX . "user u JOIN " . DB_PREFIX . "user_group ug ON u.user_group_id=ug.user_group_id LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id LEFT JOIN " . DB_PREFIX . "user u1 ON ue.link_user_id = u1.user_id LEFT JOIN " . DB_PREFIX . "user_extra ue1 ON ue1.user_id = u1.user_id WHERE 1=1";
		
		$sql .= " AND u.user_group_id = 12 AND u.user_id IN(".$myusers.")";
		
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
		$this->db->query("UPDATE `" . DB_PREFIX . "user` SET firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "' WHERE user_id = '" . (int)$user_id . "'");
		
		$this->db->query("UPDATE " . DB_PREFIX . "user_extra SET phone = '" . $this->db->escape($data['phone']) . "', whatsapp = '" . $this->db->escape($data['whatsapp']) . "', gender = '" .$data['gender']. "', city = '" . $this->db->escape($data['city']) . "', language = '" . $this->db->escape($data['language']) . "' WHERE user_id = '" . (int)$user_id . "'");
		
		if ($data['image']) {
			$this->db->query("UPDATE `" . DB_PREFIX . "user` SET image = '" . $this->db->escape($data['image']) . "' WHERE user_id = '" . (int)$user_id . "'");
		}
		if ($data['password']) {
			$this->db->query("UPDATE `" . DB_PREFIX . "user` SET salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "' WHERE user_id = '" . (int)$user_id . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "user_payment_medium WHERE user_id = '" . (int)$user_id . "'");
		if(isset($data['payment_medium'])){
			foreach($data['payment_medium'] as $item){
				$this->db->query("INSERT INTO " . DB_PREFIX . "user_payment_medium SET user_id = '" . (int)$user_id . "', medium_name = '" . $this->db->escape($item['medium_name']) . "', medium_code = '" . $this->db->escape($item['medium_code']) . "', medium_status = '" . $this->db->escape($item['medium_status']) . "'");
			}
		}
	}
	
	public function addSubUser($data) {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "user` SET username = '', user_group_id = '" . (int)$data['user_group_id'] . "', salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', image = '" . $this->db->escape($data['image']) . "', status = '" . (int)$data['status'] . "', date_added = NOW()");
		
		$user_id = $this->db->getLastId();
		
		$user_total = $this->getTotalUsers(array('filter_group_id'=>$data['user_group_id']));
		
		if($data['user_group_id']==11){
			$user_no='TRA'.(1111111+$user_total);
			$group='Trainer';
		}elseif($data['user_group_id']==12){
			$user_no='TLE'.(1111111+$user_total);
			$group='Team Leader';
		}elseif($data['user_group_id']==13){
			$user_no='STL'.(1111111+$user_total);
			$group='Senior Team Leader';
		}elseif($data['user_group_id']==14){
			$user_no='TEA'.(1111111+$user_total);
			$group='Teacher';
		}elseif($data['user_group_id']==15){
			$user_no='COU'.(1111111+$user_total);
			$group='Cousellor';
		}elseif($data['user_group_id']==16){
			$user_no='CON'.(1111111+$user_total);
			$group='Controller';
		}elseif($data['user_group_id']==17){
			$user_no='PBS'.(1111111+$user_total);
			$group='Point Buy Sell';
		}
		
		$this->db->query("UPDATE `" . DB_PREFIX . "user` SET username = '" . $this->db->escape($user_no) . "' WHERE user_id = '" . (int)$user_id . "'");
		
		
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "user_extra SET user_id = '" . (int)$user_id . "', phone = '" . $this->db->escape($data['phone']) . "', whatsapp = '" . $this->db->escape($data['whatsapp']) . "', link_user_id = '" . $this->db->escape($data['link_user_id']) . "', gender = '" .$data['gender']. "', city = '" . $this->db->escape($data['city']) . "', country = '" . $this->db->escape($data['country']) . "', language = '" . $this->db->escape($data['language']) . "', user_no = '" . $this->db->escape($user_no) . "'");
		
 		if(isset($data['payment_medium'])){
			foreach($data['payment_medium'] as $item){
				$this->db->query("INSERT INTO " . DB_PREFIX . "user_payment_medium SET user_id = '" . (int)$user_id . "', medium_name = '" . $this->db->escape($item['medium_name']) . "', medium_code = '" . $this->db->escape($item['medium_code']) . "', medium_status = '" . $this->db->escape($item['medium_status']) . "'");
			}
		}
		
		if(isset($data['permission_language'])){
			$this->db->query("DELETE FROM " . DB_PREFIX . "user_to_language WHERE user_id = '" . (int)$user_id . "'");
			foreach($data['permission_language'] as $lang){
				$this->db->query("INSERT INTO " . DB_PREFIX . "user_to_language SET user_id = '" . (int)$user_id . "', permission_language = '" . $this->db->escape($lang) . "'");
			}
		}
		
		$store_name = $this->config->get('config_name');
		$store_url = HTTP_CATALOG . 'index.php?route=account/login';
				
		$message  = 'Welcome to KOS Digital System ' . "\n\n";
		$message .= 'You account successfully created into our system. Your login url is given below: ' . "\n";
		$message .= 'Login Url:'.$store_url . "\n\n";
		$message .= 'Sub Admin Type:'.$group . "\n\n";
		$message .= 'Username:'.$user_no . "\n\n";
		$message .= 'Password:'.$data['password'] . "\n\n";

		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port');
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

		$mail->setTo($data['email']);
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender(html_entity_decode($store_name, ENT_QUOTES, 'UTF-8'));
		$mail->setSubject(sprintf('New Sub Admin Account Created in %s', html_entity_decode($store_name, ENT_QUOTES, 'UTF-8')));
		$mail->setText($message);
		$mail->send();
	}

	public function editSubUser($user_id, $data) {
		$this->db->query("UPDATE `" . DB_PREFIX . "user` SET username = '" . $this->db->escape($data['username']) . "', user_group_id = '" . (int)$data['user_group_id'] . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', image = '" . $this->db->escape($data['image']) . "', status = '" . (int)$data['status'] . "' WHERE user_id = '" . (int)$user_id . "'");

		if ($data['password']) {
			$this->db->query("UPDATE `" . DB_PREFIX . "user` SET salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "' WHERE user_id = '" . (int)$user_id . "'");
		}
		
		$this->db->query("UPDATE " . DB_PREFIX . "user_extra SET phone = '" . $this->db->escape($data['phone']) . "', whatsapp = '" . $this->db->escape($data['whatsapp']) . "', link_user_id = '" . $this->db->escape($data['link_user_id']) . "', gender = '" .$data['gender']. "', city = '" . $this->db->escape($data['city']) . "', country = '" . $this->db->escape($data['country']) . "', language = '" . $this->db->escape($data['language']) . "' WHERE user_id = '" . (int)$user_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "user_payment_medium WHERE user_id = '" . (int)$user_id . "'");
		if(isset($data['payment_medium'])){
			foreach($data['payment_medium'] as $item){
				$this->db->query("INSERT INTO " . DB_PREFIX . "user_payment_medium SET user_id = '" . (int)$user_id . "', medium_name = '" . $this->db->escape($item['medium_name']) . "', medium_code = '" . $this->db->escape($item['medium_code']) . "', medium_status = '" . $this->db->escape($item['medium_status']) . "'");
			}
		}
		
		if(isset($data['permission_language'])){
			$this->db->query("DELETE FROM " . DB_PREFIX . "user_to_language WHERE user_id = '" . (int)$user_id . "'");
			foreach($data['permission_language'] as $lang){
				$this->db->query("INSERT INTO " . DB_PREFIX . "user_to_language SET user_id = '" . (int)$user_id . "', permission_language = '" . $this->db->escape($lang) . "'");
			}
		}
	}
	
	public function getUserPaymentMedium($user_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user_payment_medium` WHERE user_id = '" . $user_id . "'");

		return $query->rows;
	}
	
	public function getUserPoint($user_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user_passbook` WHERE user_id = '" . $user_id . "' ORDER BY created_at DESC");

		return isset($query->row['balance_point'])?$query->row['balance_point']:0;
	}
	
	public function getUserTotalCreditPoint($user_id) {
		$query = $this->db->query("SELECT sum(credit_point) as total_credit_point FROM `" . DB_PREFIX . "user_passbook` WHERE user_id = '" . $user_id . "' AND type='Credit'");
		return isset($query->row['total_credit_point'])?$query->row['total_credit_point']:0;
	}
	
	public function getUserTotalDebitPoint($user_id) {
		$query = $this->db->query("SELECT sum(debit_point) as total_debit_point FROM `" . DB_PREFIX . "user_passbook` WHERE user_id = '" . $user_id . "' AND type='Debit'");
		return isset($query->row['total_debit_point'])?$query->row['total_debit_point']:0;
	}
	
	public function getUserTotalPayment($user_id) {
		$query = $this->db->query("SELECT sum(amount) as total_amount FROM `" . DB_PREFIX . "user_payment_history` WHERE user_id = '" . $user_id . "'");
		return isset($query->row['total_amount'])?$query->row['total_amount']:0;
	}
	
	public function getUserTotalWithdrawalRequestPoint($user_id) {
		$query = $this->db->query("SELECT sum(withdrawal_point) as total_withdrawal_point FROM `" . DB_PREFIX . "user_withdrawal_request` WHERE user_id = '" . $user_id . "' AND approve_status='Pending'");
		return isset($query->row['total_withdrawal_point'])?$query->row['total_withdrawal_point']:0;
	}
	
	public function getUserTotalWithdrawalPoint($user_id) {
		$query = $this->db->query("SELECT sum(withdrawal_point) as total_withdrawal_point FROM `" . DB_PREFIX . "user_withdrawal_request` WHERE user_id = '" . $user_id . "' AND approve_status='Paid'");
		return isset($query->row['total_withdrawal_point'])?$query->row['total_withdrawal_point']:0;
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
	
	public function getMyTrainersForTeamLeader($user_id, $type=true) {
		$query = $this->db->query("SELECT user_id FROM `" . DB_PREFIX . "user_extra` WHERE link_user_id = '" . $user_id . "'");
		$users = [];
		foreach($query->rows as $row){
			$users[]=$row['user_id'];
		}
		if($type){
			return $users;
		}else{
			return implode(',', $users);
		}
	}
	
	public function getMyTrainersForSeniorTeamLeader($user_id, $type=true) {
		$query = $this->db->query("SELECT user_id FROM `" . DB_PREFIX . "user_extra` WHERE link_user_id = '" . $user_id . "'");
		$users = [];
		foreach($query->rows as $row){
			$users2 = $this->getMyTrainersForTeamLeader($row['user_id'], true);
			foreach($users2 as $id){
				$users[]=$id;
			}
		}
		if($type){
			return $users;
		}else{
			return implode(',', $users);
		}
	}
	
	public function getTeamLeaderFromTrainerId($user_id) {
		$query = $this->db->query("SELECT u.*, ue.* FROM " . DB_PREFIX . "user u LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id WHERE u.user_id = (SELECT link_user_id FROM " . DB_PREFIX . "user_extra WHERE user_id = '" . $user_id . "')");
		return $query->row;
	}
	
	public function getPermissionLanguages($user_id) {
		$query = $this->db->query("SELECT permission_language FROM " . DB_PREFIX . "user_to_language WHERE user_id = '" . $user_id . "'");
		return $query->rows;
	}
	
	public function getSelectPermissionLanguages($user_id) {
		$query = $this->db->query("SELECT permission_language FROM " . DB_PREFIX . "user_to_language WHERE user_id = '" . $user_id . "'");
		$lang = [];
		foreach($query->rows as $language){
			$lang[]=$language['permission_language'];
		}
		return $lang;
	}
}