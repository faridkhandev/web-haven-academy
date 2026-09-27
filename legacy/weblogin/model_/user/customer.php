<?php
class ModelUserCustomer extends Model {
	public $columns = array('c.customer_id', 'c.customer_id', 'ct.name', 'c.firstname', 'total_dogs', 'c.email', 'c.telephone', 'location_name', 'c.address', 'wallet_balance', 'dues_amount', 'c.status');
	
	public function getCustomerTypeId($customer_id){
		$type=[];
		$query = $this->db->query("SELECT type_id FROM " . DB_PREFIX . "customer_to_type WHERE customer_id='" . (int)$customer_id . "'");
		foreach($query->rows as $row){
			$type[]=$row['type_id'];
		}
		return $type;
	}
	
	public function getCustomerTypes($customer_id){
		$type=[];
		$query = $this->db->query("SELECT dt.name FROM " . DB_PREFIX . "customer_to_type d2t INNER JOIN " . DB_PREFIX . "customer_type dt ON  d2t.type_id = dt.id WHERE d2t.customer_id='" . (int)$customer_id . "'");
		foreach($query->rows as $row){
			$type[]=$row['name'];
		}
		return $type;
	}
	
	public function addCustomer($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "customer SET firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', alternate_telephone = '" . $this->db->escape($data['alternate_telephone']) . "', gender = '" . $this->db->escape($data['gender']) . "', address = '" . $this->db->escape($data['address']) . "', location_id = '" . (int)$data['location_id'] . "', zipcode = '" . $this->db->escape($data['zipcode']) . "', second_owner_name = '" . $this->db->escape($data['second_owner_name']) . "', custom_field = '', status = '" . (int)$data['status'] . "', salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1('123456')))) . "', date_added = NOW(), date_modified = NOW()");
		$customer_id = $this->db->getLastId();
		
		if (isset($data['customer_type'])) {
			/* foreach($data['customer_type'] as $type_id){ */
				$this->db->query("INSERT INTO " . DB_PREFIX . "customer_to_type SET customer_id = '" . (int)$customer_id . "', type_id = '" . (int)$data['customer_type'] . "'");
			/* } */
		}
		$source_dir = DIR_IMAGE.'catalog/customer/'.$customer_id.'/';
		if (!file_exists ($source_dir))
		{
			mkdir($source_dir,0777,true);  
		}
		return $customer_id;
	}
	
	public function addBoardingCustomer($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "customer SET firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "',salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', alternate_telephone = '', gender = '', address = '', zipcode = '', second_owner_name = '', custom_field = '', status = '0', approved = '0', date_added = NOW(), date_modified = NOW()");
		$customer_id = $this->db->getLastId();
		return $customer_id;
	}

	public function editCustomer($customer_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', alternate_telephone = '" . $this->db->escape($data['alternate_telephone']) . "', gender = '" . $this->db->escape($data['gender']) . "', address = '" . $this->db->escape($data['address']) . "', location_id = '" . (int)$data['location_id'] . "', zipcode = '" . $this->db->escape($data['zipcode']) . "', second_owner_name = '" . $this->db->escape($data['second_owner_name']) . "', custom_field = '', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE customer_id = '" . (int)$customer_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_to_type WHERE customer_id = '" . (int)$customer_id . "'");
		if (isset($data['customer_type'])) {
			/* foreach($data['customer_type'] as $type_id){ */
				$this->db->query("INSERT INTO " . DB_PREFIX . "customer_to_type SET customer_id = '" . (int)$customer_id . "', type_id = '" . (int)$data['customer_type'] . "'");
			/* } */
		}
		
		if ($data['password']) {
			$this->db->query("UPDATE `" . DB_PREFIX . "customer` SET salt = '" . $this->db->escape($salt = token(9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "' WHERE customer_id = '" . (int)$customer_id . "'");
		}
	}
	
	public function editCustomerProfile($customer_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', alternate_telephone = '" . $this->db->escape($data['alternate_telephone']) . "', gender = '" . $this->db->escape($data['gender']) . "', address = '" . $this->db->escape($data['address']) . "', zipcode = '" . $this->db->escape($data['zipcode']) . "', second_owner_name = '" . $this->db->escape($data['second_owner_name']) . "', custom_field = '', date_modified = NOW() WHERE customer_id = '" . (int)$customer_id . "'");
		
		if ($data['password']) {
			$this->db->query("UPDATE `" . DB_PREFIX . "customer` SET salt = '" . $this->db->escape($salt = token(9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "' WHERE customer_id = '" . (int)$customer_id . "'");
		}
	}

	public function deleteCustomer($customer_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "dog WHERE customer_id = '" . (int)$customer_id . "'");
	}

	public function getCustomer($customer_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT count(id) AS total FROM " . DB_PREFIX . "booking_order bo WHERE bo.customer_id = c.customer_id AND bo.status != 'Complete') AS total_dues, (SELECT count(id) AS total FROM " . DB_PREFIX . "invoice i WHERE i.customer_id = c.customer_id AND i.payment_status = '0') AS total_due_payment,(CASE WHEN uas.wallet_balance IS NULL THEN '0.00' ELSE uas.wallet_balance END) AS wallet_balance, (CASE WHEN uas.dues_amount IS NULL THEN '0.00' ELSE uas.dues_amount END) AS dues_amount FROM " . DB_PREFIX . "customer c LEFT JOIN " . DB_PREFIX . "user_account_summery uas ON (uas.reference_id = c.customer_id AND uas.reference_type='Customer') WHERE c.customer_id = '" . (int)$customer_id . "'");

		return $query->row;
	}
	public function getTotalCustomerByEmail($email) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");
		return $query->row['total'];
	}
	
	public function getCustomerByEmail($email) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "customer WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row;
	}
	
	public function getCustomerByTelephone($phone) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "customer WHERE LCASE(telephone) = '" . $this->db->escape(utf8_strtolower($phone)) . "'");

		return $query->row;
	}

	public function getItems($data = array()) {
		//print_r($data);
		$query = $this->db->query("SELECT customer_id FROM " . DB_PREFIX . "customer");
		$recordsTotal = (int)$query->num_rows;
		$sql = "SELECT c.customer_id, c.telephone, c.whatsapp_no, c.email, c.address, c.status, CONCAT(c.firstname, ' ', c.lastname) AS name, count(d.dog_id) as total_dogs, (SELECT count(id) AS total FROM " . DB_PREFIX . "booking_order bo WHERE bo.customer_id = c.customer_id AND bo.status != 'Complete') AS total_dues, (SELECT count(id) AS total FROM " . DB_PREFIX . "invoice i WHERE i.customer_id = c.customer_id AND i.payment_status = '0') AS total_due_payment, (CASE WHEN uas.wallet_balance IS NULL THEN '0.00' ELSE uas.wallet_balance END) AS wallet_balance, (CASE WHEN uas.dues_amount IS NULL THEN '0.00' ELSE uas.dues_amount END) AS dues_amount, pd.name as location_name, ct.name as customer_type FROM " . DB_PREFIX . "customer c";
		$sql .=" LEFT JOIN " . DB_PREFIX . "customer_to_type ctt ON ctt.customer_id = c.customer_id INNER JOIN " . DB_PREFIX . "customer_type ct ON ct.id = ctt.type_id";
		$sql .=" LEFT JOIN " . DB_PREFIX . "dog d ON d.customer_id = c.customer_id";
		$sql .=" LEFT JOIN " . DB_PREFIX . "pd_locations pd ON (c.location_id = pd.location_id)";
		$sql .=" LEFT JOIN " . DB_PREFIX . "user_account_summery uas ON (uas.reference_id = c.customer_id AND uas.reference_type='Customer') WHERE 1=1";
		//$sql .=" LEFT JOIN " . DB_PREFIX . "booking_order bo ON bo.customer_id = c.customer_id WHERE 1=1";
		$implode = array();

		if (!empty($data['filter_name'])) {
			$implode[] = "CONCAT(c.firstname, ' ', c.lastname) LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_group'])) {
			$implode[] = " AND c.customer_id IN (SELECT customer_id FROM " . DB_PREFIX . "customer_to_type WHERE type_id = '" . $this->db->escape($data['filter_group']) . "')";
		}

		if (!empty($data['filter_email'])) {
			$implode[] = "c.email LIKE '%" . $this->db->escape($data['filter_email']) . "%'";
		}
		
		if (!empty($data['filter_dog'])) {
			$implode[] = "d.name LIKE '%" . $this->db->escape($data['filter_dog']) . "%'";
		}

		if (!empty($data['filter_telephone'])) {
			$implode[] = "c.telephone LIKE '%" . $data['filter_telephone'] . "%'";
		}
				
		if (!empty($data['filter_whatsapp'])) {
			$implode[] = "c.whatsapp_no LIKE '%" . $data['filter_whatsapp'] . "%'";
		}
		
		if (!empty($data['filter_location'])) {
			$implode[] = "pd.name LIKE '%" . $data['filter_location'] . "%'";
		}
		
		if (!empty($data['filter_location_id'])) {
			$implode[] = "c.location_id = '" . $data['filter_location_id'] . "'";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$implode[] = "c.status = '" . (int)$data['filter_status'] . "'";
		}
		
		if (isset($data['filter_wallet_balance_from']) && !is_null($data['filter_wallet_balance_from'])) {
			$implode[] = "wallet_balance >= '" . (float)$data['filter_wallet_balance_from'] . "'";
		}
		
		if (isset($data['filter_wallet_balance_to']) && !is_null($data['filter_wallet_balance_to'])) {
			$implode[] = "wallet_balance <= '" . (float)$data['filter_wallet_balance_to'] . "'";
		}
		
		if (isset($data['filter_due_balance_from']) && !is_null($data['filter_due_balance_from'])) {
			$implode[] = "dues_amount >= '" . (float)$data['filter_due_balance_from'] . "'";
		}
		
		if (isset($data['filter_due_balance_to']) && !is_null($data['filter_due_balance_to'])) {
			$implode[] = "dues_amount <= '" . (float)$data['filter_due_balance_to'] . "'";
		}
		
		if (isset($data['filter_due']) && !is_null($data['filter_due'])) {
			if($data['filter_due'] == 0){
				$implode[] = "c.customer_id IN(SELECT customer_id FROM " . DB_PREFIX . "invoice WHERE payment_status = 0)";
			}
			
			if($data['filter_due'] == 1){
				$implode[] = "c.customer_id NOT IN(SELECT customer_id FROM " . DB_PREFIX . "invoice WHERE payment_status = 0)";
			}			
		}

		if (!empty($data['filter_date_added']) && !empty($data['filter_date_ended'])) {
			$implode[] = "(DATE(date_added) BETWEEN DATE('" . $this->db->escape($data['filter_date_added']) . "') AND DATE('" . $this->db->escape($data['filter_date_ended']) . "'))";
		}elseif (!empty($data['filter_date_added'])) {
			$implode[] = "DATE(date_added) >= DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}elseif (!empty($data['filter_date_ended'])) {
			$implode[] = "DATE(date_added) <= DATE('" . $this->db->escape($data['filter_date_ended']) . "')";
		}
		
		if (!empty($data['filter_selected_customer'])) {
			$implode[] = "c.customer_id IN (" . $data['filter_selected_customer'] . ")";
		}

		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}
		
		$sql .= " GROUP BY c.customer_id";
		
		$query = $this->db->query($sql);
		$recordsFiltered = (int)$query->num_rows;
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->columns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY c.date_added DESC";
		}
		
		if($data['length'] !=-1){		
			if (isset($data['start']) || isset($data['length'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}
				if ($data['length'] < 1) {
					$data['length'] = 20;
				}
				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['length'];
			}
		}
		//echo $sql;
		$query = $this->db->query($sql);
		$result = $query->rows;
		return array('recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered, 'result' => $result);
	}
	
	public function getCustomers($data = array()) {
		$sql = "SELECT *, CONCAT(c.firstname, ' ', c.lastname) AS name FROM " . DB_PREFIX . "customer c WHERE 1=1";

		$implode = array();

		if (!empty($data['filter_name'])) {
			$implode[] = "CONCAT(c.firstname, ' ', c.lastname) LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
			//$implode[] = "lower(c.firstname) LIKE '%" . $this->db->escape(strtolower(trim($data['filter_name']))) . "%'";
		}

		if (!empty($data['filter_email'])) {
			$implode[] = "c.email LIKE '" . $this->db->escape($data['filter_email']) . "%'";
		}

		if (!empty($data['filter_telephone'])) {
			$implode[] = "c.telephone LIKE '" . (int)$data['filter_telephone'] . "%'";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$implode[] = "c.status = '" . (int)$data['filter_status'] . "'";
		}

		if (!empty($data['filter_date_added']) && !empty($data['filter_date_ended'])) {
			$implode[] = "(DATE(date_added) BETWEEN DATE('" . $this->db->escape($data['filter_date_added']) . "') AND DATE('" . $this->db->escape($data['filter_date_ended']) . "'))";
		}elseif (!empty($data['filter_date_added'])) {
			$implode[] = "DATE(date_added) >= DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}elseif (!empty($data['filter_date_ended'])) {
			$implode[] = "DATE(date_added) <= DATE('" . $this->db->escape($data['filter_date_ended']) . "')";
		}
		
		if (!empty($data['filter_selected_customer'])) {
			$implode[] = "c.customer_id IN (" . $data['filter_selected_customer'] . ")";
		}

		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}

		$sort_data = array(
			'name',
			'c.email',
			'c.status',
			'c.date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name";
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
		//echo $sql;
		return $query->rows;
	}

	public function getTotalCustomers($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer";

		$implode = array();

		if (!empty($data['filter_name'])) {
			$implode[] = "CONCAT(firstname, ' ', lastname) LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_email'])) {
			$implode[] = "email LIKE '" . $this->db->escape($data['filter_email']) . "%'";
		}

		if (!empty($data['filter_telephone'])) {
			$implode[] = "telephone LIKE '" . (int)$data['filter_telephone'] . "%'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$implode[] = "status = '" . (int)$data['filter_status'] . "'";
		}

		if (!empty($data['filter_date_added']) && !empty($data['filter_date_ended'])) {
			$implode[] = "(DATE(date_added) BETWEEN DATE('" . $this->db->escape($data['filter_date_added']) . "') AND DATE('" . $this->db->escape($data['filter_date_ended']) . "'))";
		}elseif (!empty($data['filter_date_added'])) {
			$implode[] = "DATE(date_added) >= DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}elseif (!empty($data['filter_date_ended'])) {
			$implode[] = "DATE(date_added) <= DATE('" . $this->db->escape($data['filter_date_ended']) . "')";
		}

		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}

		$query = $this->db->query($sql);
		/* echo $sql; */
		return $query->row['total'];
	}
	
	public function sendsms($number,$text){
		$param = array(
			'username' => 'romishome',
			'password' => 'rhe657',
			'senderid' => 'Romishome',
			'text' => $text,
			'type' => 'text',
			'datetime' => date('Y-m-d h:i:s'),
		);
		$recipients = $number; //array('971559860299','971508137465')

		$post = 'to=' . implode(';', $recipients);
		foreach ($param as $key => $val) {
			$post .= '&' . $key . '=' . rawurlencode($val);
		}
		$url = "https://www.smartsmsgateway.com/api/api_http.php";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Connection: close"));
		$result = curl_exec($ch);
		if(curl_errno($ch)) {
			$result = "cURL ERROR: " . curl_errno($ch) . " " . curl_error($ch);
		} else {
			$returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
			switch($returnCode) {
				case 200 :
					break;
				default :
					$result = "HTTP ERROR: " . $returnCode;
			}
		}
		curl_close($ch);		
	}
	
	public function addVerificationCode($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "register_otp SET customer_id = '" . (int)$data['customer_id'] . "', email_otp = '" . (int)$data['email_otp'] . "', phone_otp = '" . (int)$data['phone_otp'] . "', status = '" . (int)$data['status'] . "', date_added = NOW()");
	}
	
	public function checkOTP($data){
		$sql = "SELECT * FROM " . DB_PREFIX . "register_otp WHERE customer_id = '".(int)$data['customer_id']."' AND email_otp = '" . (int)$data['email_otp'] . "' AND phone_otp = '" . (int)$data['phone_otp'] . "' AND status = 0";
		$query = $this->db->query($sql);
		if($query->num_rows){
			$this->db->query("UPDATE " . DB_PREFIX . "register_otp SET status = 1 WHERE customer_id = '".(int)$data['customer_id']."' AND email_otp = '" . (int)$data['email_otp'] . "' AND phone_otp = '" . (int)$data['phone_otp'] . "'");
			return true;
		}else{
			return false;
		}
	}
	
	public function updateStatus($customer_id){
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET status = '1', approved = '1' WHERE customer_id = '" . (int)$customer_id . "'");
	}
	
	public function editPassword($customer_id, $password) {
		$this->db->query("UPDATE `" . DB_PREFIX . "customer` SET salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($password)))) . "', code = '' WHERE customer_id = '" . (int)$customer_id . "'");
	}

	public function editCode($email, $code) {
		$this->db->query("UPDATE `" . DB_PREFIX . "customer` SET code = '" . $this->db->escape($code) . "' WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");
	}
	
	public function getCustomerByCode($code) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer` WHERE code = '" . $this->db->escape($code) . "' AND code != ''");

		return $query->row;
	}
	
	public function updatePayment($data){
		$payment_mode = $data['payment_mode'];
		$payment_comment = $data['payment_comment'];
		$customer_id = $data['customer_id'];
		foreach($data['selected'] as $key=>$value){
			foreach($value as $invoice_id){
				$this->db->query("UPDATE `" . DB_PREFIX . "ledger` SET payment_mode = '" . $this->db->escape($payment_mode) . "', payment_comment='" . $this->db->escape($payment_comment) . "', payment_status = 1, payment_date = '".date('Y-m-d H:i:s')."' WHERE invoice_id = '" . $invoice_id . "' AND type='Credit'");
			}
		}
	}
}