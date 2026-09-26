<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sellpoint extends Frontend_Controller {
	
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
		$data['page']='sellpoint';
		$data['student_pending_point'] = $this->settings_m->getSettingValue('config_student_pending_point');
		$data['minimum_withdrawal_point'] = $this->settings_m->getSettingValue('config_student_minimum_withdrawal_point');
		$data['money_conversion'] = $this->settings_m->getSettingValue('config_money_conversion');
		$data['total_credit_point'] = $this->student_m->getStudentTotalCreditPoint($this->session->userdata('id'));
		$data['total_debit_point'] = $this->student_m->getStudentTotalDebitPoint($this->session->userdata('id'));
		$data['total_withdrawal_request_point'] = $this->student_m->getStudentTotalWithdrawalRequestPoint($this->session->userdata('id'));
		$data['balance_point'] = $this->student_m->getStudentPoint($this->session->userdata('id'));
		
		$query = $this->db->query("SELECT * FROM bh_student_withdrawal_request WHERE student_id = '" . $this->session->userdata('id') . "' AND approve_status !='Cancel'");
		$data['status'] = !empty($query->result_array())?1:0;
		
		$query = $this->db->query("SELECT u.*, ue.phone, ue.whatsapp FROM bh_user u INNER JOIN bh_user_extra ue ON u.user_id = ue.user_id WHERE ue.buy_status = '1' AND user_group_id=17");
		$data['user_lists'] = $query->result_array();
		$this->load->view('student/sellpoint', $data);
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
				$requested_at = $row['requested_at'];
				$date1 = new DateTime(date('Y-m-d', strtotime($requested_at)));
				$date2 = new DateTime(date('Y-m-d', strtotime(date('Y-m-d'))));
				$days = $date1->diff($date2)->days;
				if($days <=7){
					$status = false;
				}
			}
			
			$query = $this->db->query("SELECT * FROM point_hold WHERE student_id = '" . $this->session->userdata('id') . "' ORDER BY id DESC LIMIT 1");
			$row = $query->row_array();
			if (isset($row)){
				$requested_at = $row['requested_at'];
				$date1 = new DateTime(date('Y-m-d', strtotime($requested_at)));
				$date2 = new DateTime(date('Y-m-d', strtotime(date('Y-m-d'))));
				$days = $date1->diff($date2)->days;
				if($days <=7){
					$status = false;
				}
			}
			
			if($status == false){
				$json['error'] = 'You can only send request once in a week.';
			}
			
			if(empty($_POST['point'])){
				$json['error'] = 'Please add point';
			}
			
			if($pointstatus == 1){
				if($_POST['point']<$minimum_withdrawal_point){
					$json['error'] = 'Minimum withdrawal point condition not match.';
				}
			}else{
				if($_POST['point']<$student_pending_point){
					$json['error'] = 'Pending withdrawal point condition not match.';
				}
			}
			
			if($_POST['point']>$balance_point){
				$json['error'] = 'Wrong withdrawal point request, please check balace point in your account.';
			}
			
			if (empty($json['error'])) {
				if($pointstatus == 1){
					$this->db->insert('point_hold', array('student_id'=>$this->session->userdata('id'), 'user_id'=>$_POST['user_id'], 'point'=>$_POST['point'], 'requested_at'=>date('Y-m-d H:i:s'), 'status'=>'Pending', 'point_value'=>$money_conversion));
					$id = $this->db->insert_id();
					$query = $this->db->query("SELECT u.* FROM bh_user u WHERE u.user_id='".$_POST['user_id']."'")->row();
					
					$this->student_m->managePoint(array('student_id'=>$this->session->userdata('id'), 'reason'=>'Sell Point Deduction', 'description'=>'Sell request generated','credit_point'=>0,'debit_point'=>$_POST['point']));
				}
				
				if($id){
					$json['success'] = 'Sell Point request successfully send to Buyer ID.';
				}else{
					$json['error'] = 'Request did not send due to system error. Try again';
				}
			}
			//print_r($json);
		}
		echo json_encode($json);
	}
}