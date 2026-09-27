<?php
class User {
	private $user_id;
	private $user_group_id;
	private $username;
	private $permission = array();

	public function __construct($registry) {
		$this->db = $registry->get('db');
		$this->request = $registry->get('request');
		$this->session = $registry->get('session');

		if (isset($this->session->data['user_id'])) {
			$user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE user_id = '" . (int)$this->session->data['user_id'] . "' AND status = '1'");

			if ($user_query->num_rows) {
				$this->user_id = $user_query->row['user_id'];
				$this->username = $user_query->row['username'];
				$this->user_group_id = $user_query->row['user_group_id'];

				$this->db->query("UPDATE " . DB_PREFIX . "user SET ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE user_id = '" . (int)$this->session->data['user_id'] . "'");

				$user_group_query = $this->db->query("SELECT permission FROM " . DB_PREFIX . "user_group WHERE user_group_id = '" . (int)$user_query->row['user_group_id'] . "'");

				$permissions = unserialize($user_group_query->row['permission']);

				if (is_array($permissions)) {
					foreach ($permissions as $key => $value) {
						$this->permission[$key] = $value;
					}
				}
			} else {
				$this->logout();
			}
		}
	}

	public function login($username, $password) {
		$user_query = $this->db->query("SELECT u.* FROM " . DB_PREFIX . "user u LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id=ue.user_id WHERE (u.username = '" . $this->db->escape($username) . "' OR u.email = '" . $this->db->escape($username) . "' OR ue.user_no = '" . $this->db->escape($username) . "') AND (u.password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR u.password = '" . $this->db->escape(md5($password)) . "') AND status = '1'");

		if ($user_query->num_rows) {
			$this->session->data['user_id'] = $user_query->row['user_id'];

			$this->user_id = $user_query->row['user_id'];
			$this->username = $user_query->row['username'];
			$this->user_group_id = $user_query->row['user_group_id'];

			$user_group_query = $this->db->query("SELECT permission FROM " . DB_PREFIX . "user_group WHERE user_group_id = '" . (int)$user_query->row['user_group_id'] . "'");

			$permissions = unserialize($user_group_query->row['permission']);

			if (is_array($permissions)) {
				foreach ($permissions as $key => $value) {
					$this->permission[$key] = $value;
				}
			}

			return true;
		} else {
			return false;
		}
	}
	
	public function loginUpdate($username, $password, $user_group_id) {
		//echo "SELECT u.* FROM " . DB_PREFIX . "user u LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id=ue.user_id WHERE (u.username = '" . $this->db->escape($username) . "' OR u.email = '" . $this->db->escape($username) . "' OR ue.user_no = '" . $this->db->escape($username) . "') AND (u.password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR u.password = '" . $this->db->escape(md5($password)) . "') AND user_group_id = '".$user_group_id."' AND status = '1'";exit;
		$user_query = $this->db->query("SELECT u.* FROM " . DB_PREFIX . "user u LEFT JOIN " . DB_PREFIX . "user_extra ue ON u.user_id=ue.user_id WHERE (u.username = '" . $this->db->escape($username) . "' OR u.email = '" . $this->db->escape($username) . "' OR ue.user_no = '" . $this->db->escape($username) . "') AND (u.password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR u.password = '" . $this->db->escape(md5($password)) . "') AND user_group_id = '".$user_group_id."' AND status = '1'");

		if ($user_query->num_rows) {
			$this->session->data['user_id'] = $user_query->row['user_id'];

			$this->user_id = $user_query->row['user_id'];
			$this->username = $user_query->row['username'];
			$this->user_group_id = $user_query->row['user_group_id'];

			$user_group_query = $this->db->query("SELECT permission FROM " . DB_PREFIX . "user_group WHERE user_group_id = '" . (int)$user_query->row['user_group_id'] . "'");

			$permissions = unserialize($user_group_query->row['permission']);

			if (is_array($permissions)) {
				foreach ($permissions as $key => $value) {
					$this->permission[$key] = $value;
				}
			}

			return true;
		} else {
			return false;
		}
	}

	public function logout() {
		unset($this->session->data['user_id']);

		$this->user_id = '';
		$this->username = '';
	}

	public function hasPermission($key, $value) {
		if (isset($this->permission[$key])) {
			return in_array($value, $this->permission[$key]);
		} else {
			return false;
		}
	}

	public function isLogged() {
		return $this->user_id;
	}

	public function getId() {
		return $this->user_id;
	}

	public function getUserName() {
		return $this->username;
	}

	public function getGroupId() {
		return $this->user_group_id;
	}
	
	public function hasAccess($class_name, $function_name){
		$user_group_id = $this->getGroupId();
		$user_id = $this->getId();
		/* Get Controller Id */
		$cquery = $this->db->query("SELECT * FROM " . DB_PREFIX . "controller WHERE classname = '" . $class_name . "'");
		$controller_id = $cquery->row['id'];
		/* Get Controller Task Id */
		$fquery = $this->db->query("SELECT * FROM " . DB_PREFIX . "controller_to_task WHERE controller_id = '".$controller_id."' AND function_name = '" . $function_name . "'");
		$ctid = $fquery->row['ctid'];
		
		$query = $this->db->query("SELECT * FROM  ". DB_PREFIX ."controller_task_group WHERE customer_group_id =".$user_group_id." AND ctid =".$ctid);
		if ($query->num_rows>0) {
			if ($query->row['value'] == -1) {
				return true;
			}else{
				$cquery = $this->db->query("SELECT * FROM " . DB_PREFIX . "user_usage WHERE user_id = '" . $user_id . "' AND ctid = '".$ctid."'");
				if($function_name !='index'){
					if($query->row['value'] >= $cquery->row['value']){
						return true;
					}else{
						return false;
					}
				}else{
					if($query->row['value'] > $cquery->row['value']){
						return true;
					}else{
						return false;
					}
				}
				
			}
		} else {
			return false;
		}
	}
	
	public function taskUpdate($class_name, $function_name){
		
		$user_id = ($this->getId()) ? $this->getId() : 0;
		/* $group_id = ($this->getId()) ? $this->getId() : 0; */
		/*  Get Controler Id */
		$cquery = $this->db->query("SELECT * FROM " . DB_PREFIX . "controller WHERE classname = '" . $class_name . "'");
		$controller_id = $cquery->row['id'];
		
		/*  Get Controler Task Id */
		$fquery = $this->db->query("SELECT * FROM " . DB_PREFIX . "controller_to_task WHERE controller_id = '".$controller_id."' AND function_name = '" . $function_name . "'");
		$ctid = $fquery->row['ctid'];
			
		$cquery = $this->db->query("SELECT count(*) as total FROM " . DB_PREFIX . "user_usage WHERE user_id = '" . $user_id . "' AND ctid = '".$ctid."'");
		
		if($cquery->row['total']>0){
			$this->db->query("UPDATE " . DB_PREFIX . "user_usage SET value = (value+1) WHERE user_id = $user_id AND ctid = $ctid");
		}else{
			$this->db->query("INSERT INTO " . DB_PREFIX . "user_usage SET value = 1, user_id = $user_id, ctid = $ctid");
		}
	}
	
	public function taskExistInCustomer($class_name, $function_name){
		$user_id = ($this->getId()) ? $this->getId() : 0;
		$cquery = $this->db->query("SELECT * FROM " . DB_PREFIX . "controller WHERE classname = '" . $class_name . "'");
		$controller_id = $cquery->row['id'];
		
		/*  Get Controler Task Id */
		$fquery = $this->db->query("SELECT * FROM " . DB_PREFIX . "controller_to_task WHERE controller_id = '".$controller_id."' AND function_name = '" . $function_name . "'");
		$ctid = $fquery->row['ctid'];
			
		$cquery = $this->db->query("SELECT count(*) as total FROM " . DB_PREFIX . "user_usage WHERE user_id = '" . $user_id . "' AND ctid = '".$ctid."'");
		
		if($cquery->row['total']>0){
			return true;
		}else{
			return false;
		}
	}
}