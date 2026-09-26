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
			$this->form_validation->set_rules('student_name', 'Name', 'required');
			$this->form_validation->set_rules('student_city', 'City', 'required');
			$this->form_validation->set_rules('student_email', 'Email', 'required|valid_email|is_unique[bh_student.student_email]');
			$this->form_validation->set_rules('student_password', 'Password', 'required|matches[student_confirm_password]');
			$this->form_validation->set_rules('student_confirm_password', 'Password Confirmation', 'required');
			$this->form_validation->set_rules('student_phone', 'Phone', 'required|min_length[9]|max_length[12]|is_unique[bh_student.student_phone]');
			$this->form_validation->set_rules('student_whatsapp', 'Whatsapp', 'required|min_length[9]|max_length[12]|is_unique[bh_student.student_whatsapp]');
			
			$this->form_validation->set_message('is_unique', 'The %s already use in our database, please try different value');


			if ($this->form_validation->run() === TRUE){
				$query = $this->db->query("SELECT id FROM bh_student WHERE student_phone='".$this->input->post('phone_code').$this->input->post('student_phone')."' OR student_whatsapp = '".$this->input->post('whatsapp_code').$this->input->post('student_whatsapp')."'");
				$phonerow = $query->row_array();
				if(empty($phonerow)){
				
					if(!empty($_POST['refferal_code'])){
						$query = $this->db->query("SELECT id FROM bh_student WHERE student_no=".(int)$_POST['refferal_code']);
						$row = $query->row_array();
						if (isset($row)){
							$refer_id = $row['id'];
						}else{
							$refer_id = 0;
						}
					}else{
						$refer_id = 0;
					}
					
					if($_POST['country']=='+91'){
						$student_country = 'India';
					}elseif($_POST['country']=='+88'){
						$student_country = 'Bangladesh';
					}else{
						$student_country = 'Nepal';
					}
					$data = array(
						'student_name' => $this->input->post('student_name'),
						'student_phone' => $this->input->post('phone_code').$this->input->post('student_phone'),
						'student_whatsapp' => $this->input->post('whatsapp_code').$this->input->post('student_whatsapp'),
						'student_gender' => $this->input->post('student_gender'),
						'student_city' => $this->input->post('student_city'),
						'student_language' => $this->input->post('student_language'),
						'student_email' => $this->input->post('student_email'),
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
						$this->db->update('bh_student', array('student_no'=>$student_no,'refer_link'=>site_url('register').'?refer_id='.$student_no));
						
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
						
						$data['success'] = 'Student account successfully created. You can logged in our system. Your Password '.$this->input->post('student_password');			
					}else{
						$data['error'] = 'Some error occur in inserting data, try again.';
					}
				}else{
					$data['error'] = 'Phone Number or Whatsapp No already exist. Try another no.';
				}	
			}
		}	
		if(isset($_GET['refer_id'])){
			$data['refer_code'] = $_GET['refer_id'];
		}else{
			$data['refer_code'] = '';
		}
		$data['page']='register';
	    $this->load->view('front/register', $data);
	}
}