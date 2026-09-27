<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password extends Frontend_Controller {
	
	public function __construct (){
		parent::__construct();
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
	}
	
	public function index(){
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->form_validation->set_rules('student_password', 'Old Password', 'required');
			$this->form_validation->set_rules('student_new_password', 'New Password', 'required');
			$this->form_validation->set_rules('student_confirm_password', 'Confirm Password', 'required|matches[student_new_password]');
			if ($this->form_validation->run() === TRUE){
				$post = $this->input->post();  
                $clean = $this->security->xss_clean($post);
				
				$query = $this->db->query("SELECT * FROM bh_student WHERE id = '".$this->session->userdata('id')."' AND student_password='".md5($clean['student_password'])."'");
				$row = $query->row_array();
				if (isset($row)){
					$this->db->where('id', $this->session->userdata('id'));
					$this->db->update('bh_student', array('student_password' => md5($clean['student_new_password'])));
					$data['success'] = 'Your password information successfully updated.';
				}else{
					$data['error'] = 'Your old password is not acorrect, try again.';
				}
			}
		}
		$data['page']='password';
	    $this->load->view('student/password', $data);
	}
}