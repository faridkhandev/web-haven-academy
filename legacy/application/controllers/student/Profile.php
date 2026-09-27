<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Frontend_Controller {
	
	public function __construct (){
		parent::__construct();
		$this->load->model('settings_m');			
		$this->load->model('student_m');			
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
			
			
			$query = $this->db->query("SELECT count(id) as total_whatsapp_status FROM bh_student_to_counsellor WHERE student_id ='".$this->session->userdata('id')."' AND whatsapp_status = 0");
			$data['total_whatsapp_status']=$query->row_array();
		
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
					//echo $data['total_whatsapp_status']['total_whatsapp_status']; echo $_POST['student_whatsapp'];exit;
					if($data['total_whatsapp_status']['total_whatsapp_status']){
						if(!empty($_POST['student_whatsapp'])){
							//echo 'test';exit;
							$this->db->where('id', $this->session->userdata('id'));
							$this->db->update('bh_student', array('student_whatsapp' => $clean['student_whatsapp']));
							
							$this->db->where('student_id', $this->session->userdata('id'));
							$this->db->update('bh_student_to_counsellor', array('whatsapp_status' => 1));
						}
					}
					$data['success'] = 'Your account information successfully updated.';
				}
			}
		}
		$query = $this->db->query("SELECT s.*, ue.user_no, u.firstname, u.lastname FROM bh_student s LEFT JOIN bh_user u ON s.link_user_id=u.user_id LEFT JOIN bh_user_extra ue ON u.user_id = ue.user_id WHERE s.id ='".$this->session->userdata('id')."'");
		$data['student']=$query->row_array();
		
		$data['page']='Profile';
	    $this->load->view('student/profile', $data);
	}
	
	public function active(){

	if ($this->input->is_ajax_request()) {

		$student_id = (int)$this->session->userdata('id');

		$std_info = $this->db->query("
			SELECT 
				s.*, 
				ue.user_no, 
				u.firstname, 
				u.lastname 
			FROM bh_student s 
			LEFT JOIN bh_user u 
				ON s.link_user_id = u.user_id 
			LEFT JOIN bh_user_extra ue 
				ON u.user_id = ue.user_id 
			WHERE s.id = '".$student_id."'
		")->row_array();

		$query = $this->db->query("
			SELECT refer_id 
			FROM bh_student 
			WHERE id = '".$student_id."'
		")->row_array();

		$refer_id = isset($query['refer_id']) ? $query['refer_id'] : 0;

		$std_refer_info = $this->db->query("
			SELECT s.* 
			FROM bh_student s 
			WHERE s.id = '".$refer_id."'
		")->row_array();

		$counsellor = $this->db->query("
			SELECT user_id 
			FROM bh_student_to_counsellor 
			WHERE student_id = '".$student_id."'
		")->row_array();

		$counsellor_id = isset($counsellor['user_id']) 
			? $counsellor['user_id'] 
			: 0;

		$refer_student_trainer_id = 0;
		$refer_student_teamleader_id = 0;
		$refer_student_seniorteamleader_id = 0;

		// CHECK CURRENT STATUS ONLY

$student_status_query = $this->db->query("
	SELECT student_status
	FROM bh_student
	WHERE id = '".$student_id."'
")->row_array();

$current_status = isset($student_status_query['student_status'])
	? (int)$student_status_query['student_status']
	: 0;

// ALREADY ACTIVE

if($current_status == 1){

	echo 'Your account is already activated.';
	exit;
}

		// =========================
		// NEW ACTIVATION
		// =========================

		if($refer_id != 0){

			$refer_student_trainer_id = isset($std_refer_info['link_user_id'])
				? (int)$std_refer_info['link_user_id']
				: 0;

			// TRAINER -> TEAM LEADER
			if($refer_student_trainer_id > 0){

				$query = $this->db->query("
					SELECT * 
					FROM bh_user_extra 
					WHERE user_id = '".(int)$refer_student_trainer_id."'
				")->row_array();

				$refer_student_teamleader_id = isset($query['link_user_id'])
					? (int)$query['link_user_id']
					: 0;
			}

			// TEAM LEADER -> SENIOR TEAM LEADER
			if($refer_student_teamleader_id > 0){

				$query = $this->db->query("
					SELECT * 
					FROM bh_user_extra 
					WHERE user_id = '".(int)$refer_student_teamleader_id."'
				")->row_array();

				$refer_student_seniorteamleader_id = isset($query['link_user_id'])
					? (int)$query['link_user_id']
					: 0;
			}

			$refer_activated_point = $this->settings_m->getSettingValue('config_refer_activated_point');

			$data = array(
				'student_id'   => $refer_id,
				'reason'       => 'Refer Student Activated',
				'description'  => 'Point earn for activated refer ID '.$std_info['student_no'].' Name '.$std_info['student_name'],
				'credit_point' => $refer_activated_point,
				'debit_point'  => 0,
				'type'         => 'Credit'
			);

			$this->student_m->managePoint($data);
		}

		$config_cashback_point = $this->settings_m->getSettingValue('config_cashback_point');

		$id_activation_point = $this->settings_m->getSettingValue('config_id_activation_point');

		$this->student_m->managePoint(array(
			'student_id'   => $student_id,
			'reason'       => 'Student Activation Point',
			'description'  => 'Student Activation Point Remove',
			'credit_point' => 0,
			'debit_point'  => $id_activation_point,
			'type'         => 'Debit'
		));

		$this->student_m->managePoint(array(
			'student_id'   => $student_id,
			'reason'       => 'Student Cashback Point',
			'description'  => 'Cashback Point From Admin',
			'credit_point' => $config_cashback_point,
			'debit_point'  => 0,
			'type'         => 'Credit'
		));

		$tl_no = $this->settings_m->getSettingValue('config_team_leader_no');

		$query = $this->db->query("
			SELECT * 
			FROM bh_user 
			WHERE username = '".$tl_no."'
		")->row_array();

		$team_leader_id = isset($query['user_id'])
			? $query['user_id']
			: 151;

		$this->db->query("
			UPDATE bh_student 
			SET 
				link_user_id = 0,
				activated_at = '".date('Y-m-d H:i:s')."',
				link_user_at = '".date('Y-m-d H:i:s')."',
				student_status = 1,
				activated_by = 0
			WHERE id = '".$student_id."'
		");

		$this->db->query("
			INSERT INTO bh_student_active_history 
			SET
				student_id = '".$student_id."',
				refer_student_id = '".$refer_id."',
				refer_student_trainer_id = '".$refer_student_trainer_id."',
				refer_student_teamleader_id = '".$refer_student_teamleader_id."',
				refer_student_seniorteamleader_id = '".$refer_student_seniorteamleader_id."',
				user_id = 0,
				team_leader_id = '".$team_leader_id."',
				counsellor_id = '".$counsellor_id."',
				added_on = '".date('Y-m-d H:i:s')."'
		");

		echo 'Your account successfully activated.';
		exit;
	}
}
}