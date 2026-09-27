<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends Frontend_Controller {
	public function __construct (){
		parent::__construct();
		/* $this->load->model('settings_m');
		$this->load->model('hotel_m');
		$this->load->model('service_m');
		$this->load->model('block_m'); */
	}

	public function index(){
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() === TRUE){
				$post = $this->input->post();  
                $clean = $this->security->xss_clean($post);
				//echo "SELECT * FROM bh_student WHERE (student_email='".$clean['email']."' OR student_phone ='".$clean['email']."') AND student_password='".md5($clean['password'])."'";exit;
				$token = $clean['country'].$clean['email'];
				//echo "SELECT * FROM bh_student WHERE (student_email='".$token."' OR student_phone ='".$$token."') AND student_password='".md5($clean['password'])."'";exit;
				$query = $this->db->query("SELECT * FROM bh_student WHERE (student_email='".$token."' OR student_phone ='".$token."') AND student_password='".md5($clean['password'])."'");
				$row = $query->row_array();
				if (isset($row)){
					if( $row['student_delete_status'] == 0 ){
						$this->db->where('id', $row['id']);
						$this->db->update('bh_student', array('last_login' => date('Y-m-d H:i:s')));
						$this->session->set_userdata('student', $row);
						foreach($row as $key=>$val){
							$this->session->set_userdata($key, $val);
						}
						redirect(base_url().'student/dashboard');
						exit;
						/* if( $row['student_status'] == 1 ){
							$this->db->where('id', $row['id']);
							$this->db->update('bh_student', array('last_login' => date('Y-m-d H:i:s')));
							$this->session->set_userdata('student', $row);
							foreach($row as $key=>$val){
								$this->session->set_userdata($key, $val);
							}
							redirect(base_url().'student/dashboard');
							exit;
						}else{
							$data['error'] = 'Your account is not activated yet, try again.';
						} */
					}else{
						$data['error'] = 'Your account is deleted, please contact administrator.';
					}
				}else{
					$data['error'] = 'Your account credentials Not Match , try again.';
				}
			}
		}	
		$data['page']='login';
	    $this->load->view('front/login', $data);
	}
}