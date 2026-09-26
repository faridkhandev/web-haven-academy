<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medium extends Frontend_Controller {
	
	public function __construct (){
		parent::__construct();
		$this->load->model('student_model');			
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
		
		$data = [];
		$query = $this->db->query("SELECT s.*, ue.user_no, u.firstname, u.lastname FROM bh_student s LEFT JOIN bh_user u ON s.link_user_id=u.user_id LEFT JOIN bh_user_extra ue ON u.user_id = ue.user_id WHERE s.id ='".$this->session->userdata('id')."'");
		$data['student']=$query->row_array();
		
		if($data['student']['student_country']=="India"){
			$payment = array('Gpay', 'Phone Pay', 'Paytm', 'Binance');
		}elseif($data['student']['student_country']=="Bangladesh"){
			$payment = array('Bkash', 'Nagad', 'Rocket', 'Binance');
		}elseif($data['student']['student_country']=="Nepal"){
			$payment = array('eSewa', 'Binance');
		}
		
		$error = array();
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			if (empty($_POST['payment_medium'])) {
				$error['payment_medium'] = 'Please add at lease one payment medium.';
			}
			if (isset($_POST['payment_medium'])) {
				foreach ($_POST['payment_medium'] as $key => $value) {
					
					if (empty($value['medium_name'])) {
						$error['medium'][$key]['medium_name'] = 'Invalid Medium Name.';
					}
					if (empty($value['medium_code'])) {
						$error['medium'][$key]['medium_code'] = 'Invalid No.';
					}
					
					if(!empty($value['medium_name']) && ($value['medium_name']=='Bkash')){
						if(strlen($value['medium_code']) != 11){
							$error['medium'][$key]['medium_code'] = 'No must be 11 digit.';
						}
					}
					
					if(!empty($value['medium_name']) && ($value['medium_name']=='Nagad')){
						if(strlen($value['medium_code']) != 11){
							$error['medium'][$key]['medium_code'] = 'No must be 11 digit.';
						}
					}
					
					if(!empty($value['medium_name']) && ($value['medium_name']=='Rocket')){
						if(strlen($value['medium_code']) != 12){
							$error['medium'][$key]['medium_code'] = 'No must be 12 digit.';
						}
					}
					
					if(!empty($value['medium_name']) && ($value['medium_name']=='Gpay' || $value['medium_name']=='Phone Pay' || $value['medium_name']=='Paytm')){
						if(strlen($value['medium_code']) != 10){
							$error['medium'][$key]['medium_code'] = 'No must be 10 digit.';
						}
					}
				}
			}
			
			if(empty($error)){
				$this->db->delete('bh_student_payment_medium', array('student_id' => $this->session->userdata('id')));
				foreach ($_POST['payment_medium'] as $key => $value) {
					$this->db->insert('bh_student_payment_medium', array('student_id'=>$this->session->userdata('id'), 'medium_name'=>$value['medium_name'], 'medium_code'=>$value['medium_code'], 'medium_status'=>1));
				}
				$data['success'] = 'Withdrawal Medium Successfully Updated.';
			}
		}		
		$query = $this->db->query("SELECT * FROM bh_student_payment_medium WHERE student_id = '" . $this->session->userdata('id') . "'");
		$data['action'] = base_url('student/medium');
		//print_r($query->rows);
		//$data['payment_medium'] = $query->rows;
		
		if (isset($_POST['payment_medium'])) {
			$data['payment_medium'] = $_POST['payment_medium'];
		} elseif (!empty($query->result_array())) {
			$data['payment_medium'] = $query->result_array();
		} else {
			$data['payment_medium'] = array();
		}
		
		//print_r($data['payment_medium']);
		if (isset($error['payment_medium'])) {
			$data['error_payment_medium'] = $error['payment_medium'];
		} else {
			$data['error_payment_medium'] = '';
		}
		
		if (isset($error['medium'])) {
			$data['error_medium'] = $error['medium'];
		} else {
			$data['error_medium'] = array();
		}
		
		$this->load->view('student/medium', $data);
	}
}	