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
		$error = array();
		$data = [];
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			if (empty($_POST['payment_medium'])) {
				$error['payment_medium'] = 'Please as at lease one payment medium.';
			}
			if (isset($_POST['payment_medium'])) {
				foreach ($_POST['payment_medium'] as $key => $value) {
					
					if (empty($value['medium_name'])) {
						$error['medium'][$key]['medium_name'] = 'Invalid Medium Name.';
					}
					if (empty($value['medium_code'])) {
						$error['medium'][$key]['medium_code'] = 'Invalid Medium Code.';
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