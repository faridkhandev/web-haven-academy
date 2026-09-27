<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Frontend_Controller {
	
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
			$this->form_validation->set_rules('student_city', 'City', 'required');
			if ($this->form_validation->run() === TRUE){
				/*$post = $this->input->post();  
                $clean = $this->security->xss_clean($post);
				$this->db->where('id', $this->session->userdata('id'));
				$this->db->update('bh_student', array('student_name' => $clean['student_name'], 'student_whatsapp' => $clean['student_whatsapp'], 'student_gender' => $clean['student_gender'], 'student_language' => $clean['student_language'], 'student_city' => $clean['student_city'], 'student_country' => $clean['student_country']));
				$data['success'] = 'Your account information successfully updated.'; */
				if(!empty($_FILES['student_image']['name'])){ 
					$config['upload_path']          = './uploads/';
					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = 2048;
					$config['encrypt_name'] = TRUE;
					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload('student_image'))
					{
						$data['error'] = $this->upload->display_errors();
					}else{
						$uploadData = $this->upload->data(); 
						$filename = 'uploads/'.$uploadData['file_name']; 
					}
				}else{
					$filename = $clean['student_image_hidden'];
				}
				
				if(empty($data['error'])){
					$post = $this->input->post();  
					$clean = $this->security->xss_clean($post);
					
					$this->db->where('id', $this->session->userdata('id'));
					$this->db->update('bh_student', array('student_city' => $clean['student_city'], 'student_fb_link' => $clean['student_fb_link'], 'student_youtube_link' => $clean['student_youtube_link'], 'student_image' => $filename));
					$data['success'] = 'Your account information successfully updated.';
				}
			}
		}
		$query = $this->db->query("SELECT s.*, ue.user_no, u.firstname, u.lastname FROM bh_student s LEFT JOIN bh_user u ON s.link_user_id=u.user_id LEFT JOIN bh_user_extra ue ON u.user_id = ue.user_id WHERE s.id ='".$this->session->userdata('id')."'");
		$data['student']=$query->row_array();
		$data['page']='Profile';
	    $this->load->view('student/profile', $data);
	}
}