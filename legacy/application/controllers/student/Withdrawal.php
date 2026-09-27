<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdrawal extends Frontend_Controller {
	
	public function __construct (){
		parent::__construct();
		$this->load->model('student_model');	
		$this->load->model('student_m');	
		$this->load->model('settings_m');			
		/*$this->load->model('service_m');	
		$this->load->model('block_m');	
		$this->load->model('category_m'); */
		/* if(!isset($_SESSION['id')){
			redirect(base_url().'login');
		} */
		if(!$this->session->userdata('student')){
			redirect(base_url().'login');
		}
		
		if($this->session->userdata('student_status')==0){
			redirect(base_url('student/dashboard'));
		}
	}
	
	public function index(){
		$data['page']='withdrawal';
		$data['student_pending_point'] = $this->settings_m->getSettingValue('config_student_pending_point');
		$data['minimum_withdrawal_point'] = $this->settings_m->getSettingValue('config_student_minimum_withdrawal_point');
		$data['money_conversion'] = $this->settings_m->getSettingValue('config_money_conversion');
		$data['total_credit_point'] = $this->student_m->getStudentTotalCreditPoint($this->session->userdata('id'));
		$data['total_debit_point'] = $this->student_m->getStudentTotalDebitPoint($this->session->userdata('id'));
		$data['total_withdrawal_request_point'] = $this->student_m->getStudentTotalWithdrawalRequestPoint($this->session->userdata('id'));
		$data['balance_point'] = $this->student_m->getStudentPoint($this->session->userdata('id'));
		$query = $this->db->query("SELECT * FROM bh_student_payment_medium WHERE student_id = '" . $this->session->userdata('id') . "'");
		$data['payment_medium'] = $query->result_array();
		
		$query = $this->db->query("SELECT * FROM bh_student_withdrawal_request WHERE student_id = '" . $this->session->userdata('id') . "' AND approve_status !='Cancel'");
		$data['status'] = !empty($query->result_array())?1:0;
		
		$data['filter_start_date'] = date('Y-m-01');
		$data['filter_end_date'] = date('Y-m-t');
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$output = $this->getlist();
			echo json_encode($output);
		} else {
			$this->load->view('student/withdrawal', $data);
		}
	}
	
	public function getlist(){
		$postData = $this->input->post();
		if (isset($postData['filter_start_date'])) {
			$filter_start_date = $postData['filter_start_date'];
		} else {
			$filter_start_date = date('m-01-Y');
		}

		if (isset($postData['filter_end_date'])) {
			$filter_end_date = $postData['filter_end_date'];
		} else {
			$filter_end_date = date('m-t-Y');
		}
		
		if (isset($postData['filter_approve_status'])) {
			$filter_approve_status = $postData['filter_approve_status'];
		} else {
			$filter_approve_status = null;
		}
		
		if (isset($postData['order'])) {
			$order = $postData['order'];
		} else {
			$order = NULL;
		}

		if (isset($postData['start'])) {
			$start = $postData['start'];
		} else {
			$start = 0;
		}

		if (isset($postData['length'])) {
			$length = $postData['length'];
		} else {
			$length = 20;
		}
		$filter_data = [
			'filter_student_id'     => $this->session->userdata('id'),
			'filter_start_date'     => $filter_start_date,
			'filter_end_date'       => $filter_end_date,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];

		$items = array();
		$results = $this->student_model->getWithdrawalItems($filter_data);
		//print_r($results);
		foreach($results['result'] as $key => $result) {
			if(is_null($result['approve_at'])){
				$approve_at = 'N/A';
			}elseif($result['approve_at'] == '0000-00-00 00:00:00'){
				$approve_at = 'N/A';
			}else{
				$approve_at = date('Y-m-d g:i A', strtotime($result['approve_at']));
			}
			
			if(is_null($result['cancelled_at'])){
				$cancelled_at = 'N/A';
			}elseif($result['cancelled_at'] == '0000-00-00 00:00:00'){
				$cancelled_at = 'N/A';
			}else{
				$cancelled_at = date('Y-m-d g:i A', strtotime($result['cancelled_at']));
			}
			
			$items[] = array(
				'id' => $result['id'],
				'withdrawal_point' => $result['withdrawal_point'],
				'comment' => $result['withdrawal_message'],
				'approve_at'           => $approve_at,
				'cancelled_at'           => $cancelled_at,
				'requested_at'      => date('Y-m-d g:i A', strtotime($result['requested_at'])),
				'approve_status'      => ($result['approve_status']=='Pending')? '<span class="badge badge-warning">Pending</span>':(($result['approve_status']=='Paid')? '<span class="badge badge-success">Paid</span>':'<span class="badge badge-danger">Cancel</span>'),
			);
		}

		$json = array(
			'draw'				=>	(int)$postData['draw'],
			'recordsTotal'		=>	$results['recordsTotal'],
			'recordsFiltered'	=>	$results['recordsFiltered'],
			'data'				=>	$items,
		);
		return $json;
	}
	
	public function addrequest(){
		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$query = $this->db->query("SELECT * FROM bh_student_withdrawal_request WHERE student_id = '" . $this->session->userdata('id') . "' AND approve_status != 'Cancel'");
			$pointstatus = !empty($query->result_array())?1:0;
			$student_pending_point = $this->settings_m->getSettingValue('config_student_pending_point');
			
			$balance_point = $this->student_m->getStudentPoint($this->session->userdata('id'));
			$minimum_withdrawal_point = $this->settings_m->getSettingValue('config_student_minimum_withdrawal_point');
			$money_conversion = $this->settings_m->getSettingValue('config_money_conversion');
			
			$status = true;
			
			$query = $this->db->query("SELECT * FROM bh_student_withdrawal_request WHERE student_id = '" . $this->session->userdata('id') . "' AND type=1 ORDER BY id DESC LIMIT 1");
			$row = $query->row_array();
			if (isset($row)){
				if($row['approve_status'] == 'Pending'){
					$requested_at = $row['requested_at'];
				}elseif($row['approve_status'] == 'Paid'){
					$requested_at = $row['approve_at'];
				}else{
					$requested_at = $row['cancelled_at'];
				}
				if($row['approve_status'] != 'Pending'){
					$date1 = new DateTime(date('Y-m-d', strtotime($requested_at)));
					$date2 = new DateTime(date('Y-m-d', strtotime(date('Y-m-d'))));
					$days = $date1->diff($date2)->days;
					if($days <=7){
						$status = false;
					}
				}else{
					$status = false;
				}
			}
			
			if($status == false){
				$json['error'] = 'You can only send request once in a week.';
			}
			
			if(empty($_POST['withdrawal_point'])){
				$json['error'] = 'Please add point';
			}
			
			if(empty($_POST['payment_medium'])){
				$json['error'] = 'Please select payment medium';
			}
			
			if($pointstatus == 1){
				if($_POST['withdrawal_point']<$minimum_withdrawal_point){
					$json['error'] = 'Minimum withdrawal point condition not match.';
				}
			}else{
				if($_POST['withdrawal_point']<$student_pending_point){
					$json['error'] = 'Pending withdrawal point condition not match.';
				}
			}
			
			if($_POST['withdrawal_point']>$balance_point){
				$json['error'] = 'Wrong withdrawal point request, please check balace point in your account.';
			}
			
			if (empty($json['error'])) {
				if($pointstatus == 1){
					$type=1; //regular;
					$this->db->insert('bh_student_withdrawal_request', array('student_id'=>$this->session->userdata('id'), 'withdrawal_point'=>$_POST['withdrawal_point'], 'requested_at'=>date('Y-m-d H:i:s'), 'approve_status'=>'Pending', 'payment_medium'=>$_POST['payment_medium'], 'withdrawal_message'=>$_POST['withdrawal_message'], 'point_value'=>$money_conversion, 'type'=>$type));
				}else{
					$type=2; //pending point;
					
					$this->student_m->managePoint(array('student_id'=>$this->session->userdata('id'), 'reason'=>'Pending Point Deduction', 'description'=>'Automatically deduction of pending point by system','credit_point'=>0,'debit_point'=>$student_pending_point, 'type'=>'Debit'));
					
					$this->db->insert('bh_student_withdrawal_request', array('student_id'=>$this->session->userdata('id'), 'withdrawal_point'=>$student_pending_point, 'requested_at'=>date('Y-m-d H:i:s'), 'approve_at'=>date('Y-m-d H:i:s'), 'approve_status'=>'Paid', 'payment_medium'=>$_POST['payment_medium'], 'withdrawal_message'=>'Pending Fees', 'point_value'=>$money_conversion, 'type'=>$type));
				}
				
				$id = $this->db->insert_id();
				if($id){
					$json['success'] = 'Withdrawal request successfully send to admin.';
				}else{
					$json['error'] = 'Request did not send due to system error. Try again';
				}
			}
			//print_r($json);
		}
		echo json_encode($json);
	}
	
	public function joinrequest(){
	    $this->db->query("UPDATE bh_student SET is_point_requested = 1 WHERE id = '" . $this->session->userdata('id') . "' AND admin_approve=1");
	    echo 'success';
	}
}