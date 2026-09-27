<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Register extends Frontend_Controller {
	public function __construct (){
		parent::__construct();
		$this->load->model('student_m');
		$this->load->model('settings_m');
		/* $this->load->model('hotel_m');
		$this->load->model('service_m');
		$this->load->model('block_m'); */
	}

	public function index(){
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->form_validation->set_rules('student_name', 'Name', 'required|min_length[3]|max_length[30]');
			/* $this->form_validation->set_rules('student_city', 'City', 'required'); */
			/* $this->form_validation->set_rules('student_email', 'Email', 'required|max_length[35]|valid_email|is_unique[bh_student.student_email]'); */
			$this->form_validation->set_rules('student_password', 'Password', 'required|matches[student_confirm_password]|min_length[8]|callback_validate_password');
			$this->form_validation->set_rules('student_confirm_password', 'Password Confirmation', 'required');
			 $this->form_validation->set_rules('student_phone', 'Phone', 'required|numeric|min_length[9]|max_length[12]|is_unique[bh_student.student_phone]');
			$this->form_validation->set_rules('student_whatsapp', 'Whatsapp', 'required|numeric|min_length[9]|max_length[12]|is_unique[bh_student.student_whatsapp]');
			/* $this->form_validation->set_rules('student_telegram', 'Imo Number', 'required|numeric|min_length[9]|max_length[12]|is_unique[bh_student.student_telegram]'); */
			

			$this->form_validation->set_rules(
			  'student_whatsapp',
			  'Whatsapp',
			  'required|numeric|callback_validate_phone_by_country[student_whatsapp]'
			);
			
			$this->form_validation->set_message('is_unique', 'The %s already use in our database, please try different value');


			if ($this->form_validation->run() === TRUE){
				$status = true;
				$refer_code = $this->input->post('refferal_code', TRUE);
				if(!empty($refer_code)){
					$query = $this->db->query(
						"SELECT id FROM bh_student 
						 WHERE student_status = 1 
						 AND (md5(student_no)=? OR md5(student_email)=?)",
						[$refer_code, $refer_code]
					);
					$row = $query->row_array();
					if (!$row) {
						$status = false;
					}
				}
				/* print_r($row); */
				if(trim($_POST['student_name'])=='')
				{
				    $status = false;
				}
				
				
				if($status){
					/* print_r($_POST);exit; */
					$query = $this->db->query("SELECT id FROM bh_student WHERE student_whatsapp = '".$this->input->post('whatsapp_code').$this->input->post('student_whatsapp')."'");
					$phonerow = $query->row_array();
					if(empty($phonerow)){
					
						if(!empty($_POST['refferal_code'])){
							$query = $this->db->query("SELECT id FROM bh_student WHERE (md5(student_no)='".$_POST['refferal_code']."')");
							$row = $query->row_array();
							$refer_id = !empty($row['id']) ? $row['id'] : 0;
						}else{
							$refer_id = 0;
						}
						
						if($_POST['country']=='+91'){
							$student_country = 'India';
						}elseif($_POST['country']=='+88'){
							$student_country = 'Bangladesh';
						}elseif($_POST['country']=='+977'){
							$student_country = 'Nepal';
						}elseif($_POST['country']=='+966'){
							$student_country = 'Saudi Arabia';
						}elseif($_POST['country']=='+971'){
							$student_country = 'United Arab Emirates';
						}else{
							$student_country = 'India';
						}
						$data = array(
							'student_name' => $this->input->post('student_name'),
							'student_phone' => $this->input->post('whatsapp_code').$this->input->post('student_whatsapp'),
							'student_whatsapp' => $this->input->post('whatsapp_code').$this->input->post('student_whatsapp'),
							'student_telegram' => ($this->input->post('telegram_code') ?? '') .($this->input->post('student_telegram') ?? ''),
							'student_gender' => $this->input->post('student_gender') ?? '',
							'student_city' => '',
							'student_language' => $this->input->post('student_language') ?? '',
							'student_email' => '',
							'student_password' => md5($this->input->post('student_password')),
							'student_country' => $student_country,
							'student_point' => 0,
							'link_user_id' => 0,
							'refer_id' => $refer_id,
							'refer_link' => '',
							'student_status' => 0,
							'student_delete_status' => 0,
							'created_by' => 0,
							'updated_by' => 0,
							'created_at' => date('Y-m-d H:i:s'),
							'updated_at' => date('Y-m-d H:i:s')
						);

						$insert = $this->db->insert('bh_student', $data);
						$insert_id = $this->db->insert_id();
						if($insert){
							$student_no = (1000000+$insert_id);
							$this->db->where('id', $insert_id);
							$this->db->update('bh_student', array('student_no'=>$student_no,'refer_link'=>site_url('register').'?refer_id='.md5($student_no)));
							
							if($refer_id != 0){
								$refer_point = $this->settings_m->getSettingValue('config_refer_point');
								if($refer_point != 0){
									$query = $this->db->query("SELECT * FROM bh_student_passbook WHERE student_id = '" . (int)$refer_id . "' ORDER BY id DESC LIMIT 1");
									$row = $query->row_array();
									if (isset($row)){
										$balance_point = $row['balance_point']+$refer_point;
									}else{
										$balance_point = 0;
									}
									
									$this->db->insert('bh_student_passbook', array('student_id'=>$refer_id, 'reason'=>'Student Refer', 'description'=>'Point earn for refer '.$this->input->post('student_name'),'credit_point'=>$refer_point, 'balance_point'=>$balance_point, 'debit_point'=>0,'type'=>'Credit', 'created_at'=>date('Y-m-d H:i:s')));
									
									$this->db->where('id', $refer_id);
									$this->db->update('bh_student', array('student_point'=>$balance_point, 'updated_at'=>date('Y-m-d H:i:s')));
								}
							}
							
							$data['success'] = 'আপনার অ্যাকাউন্ট সফলভাবে তৈরি হয়েছে। স্টুডেন্ট আইডি:  '.$student_no.' পাসওয়ার্ড: '.$this->input->post('student_password').' লগইন করার জন্য আপনার মোবাইল নম্বর এবং পাসওয়ার্ড ব্যবহার করুন। অনুগ্রহ করে আপনার পাসওয়ার্ড কারও সঙ্গে শেয়ার করবেন না।';			
						}else{
							$data['error'] = 'Some error occur in inserting data, try again.';
						}
					}else{
						$data['error'] = 'Phone Number or Whatsapp No already exist. Try another no.';
					}	
				}else{
					$data['error'] = 'Your refer ID is inactive, You can not join by this refer ID.';
				}
			}
		}
		if(isset($_GET['refer_id'])){
			$data['refer_code'] = $refer_code = $_GET['refer_id'];
		}else{
			$data['refer_code'] = $refer_code = '';
		}
		$query = $this->db->query("SELECT id FROM bh_student WHERE student_status = 1 AND md5(student_no)=?",[$refer_code]);
		$data['student'] = $query->row_array();
		
		$data['page']='register';
	    $this->load->view('front/register', $data);
	}
	
	// Custom callback to validate password
    public function validate_password($password) {
        // Regular expression: At least 8 characters, alphanumeric, and at least one special character
        if (preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/', $password)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('validate_password', 'The {field} must be at least 8 characters long and contain at least one letter, one number, and one special character.');
            return FALSE;
        }
    }
	
	public function validate_phone_by_country($value, $field_name)
	{
		$country = $this->input->post('country', true); // e.g. +91, +88, +966, +971

		// Keep only digits (in case user pastes spaces/dashes)
		$digits = preg_replace('/\D+/', '', (string)$value);
		$len    = strlen($digits);

		// Define expected lengths by country code
		$rules = [
			'+91'  => 10, // India
			'+88'  => 11, // Bangladesh (if you want 10; change if needed)
			'+966' => 9,  // Saudi typically 9 digits (without country code)
			'+971' => 9,  // UAE typically 9 digits (without country code)
		];

		// Default if country not matched
		$expected = $rules[$country] ?? 10;

		if ($len !== $expected) {
			$this->form_validation->set_message(
				'validate_phone_by_country',
				ucfirst(str_replace('student_', '', $field_name)) . " must be exactly {$expected} digits for {$country}."
			);
			return false;
		}

		// Put cleaned digits back so you store consistent data
		$_POST[$field_name] = $digits;

		return true;
	}
}