<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Frontend_Controller {
	
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
		$student_id = $this->session->userdata('id');
		
		$query = $this->db->query("SELECT * FROM bh_student WHERE id=$student_id");
		$data['student']=$query->row_array();
		if($data['student']['student_status'] == 0){

    // Load only Photo Zoon
    $data['photos'] = [];

    $video_module = $this->settings_m->getSettingValue('video_module');
    if(!empty($video_module)){
        foreach($video_module['items'] as $photo){
            $data['photos'][] = 'https://webhavenmedia.com/weblogin/image/'.$photo['image'];
        }
    }

    $data['page'] = 'welcome';
    $this->load->view('student/welcome', $data);
    return;
}
		if($data['student']['student_status'] == 1){
		$query = $this->db->query("SELECT * FROM bh_notification WHERE status =1 ORDER BY created_at DESC");
		$data['notifications']=$query->result_array();
		
		$query = $this->db->query("SELECT * FROM weekly_activity WHERE status =1 ORDER BY created_at DESC");
		$data['weekly_activity']=$query->result_array();
		
			$trainer_id = $data['student']['link_user_id'];
			if(!empty($trainer_id)){
				$query = $this->db->query("SELECT u.firstname, u.lastname, ue.whatsapp FROM bh_user u INNER JOIN bh_user_extra ue ON u.user_id = ue.user_id WHERE u.user_id=$trainer_id");
				$data['mytrainer']=$query->row_array();
			
				$query = $this->db->query("SELECT * FROM bh_user_extra WHERE user_id=$trainer_id");
				$data['trainer']=$query->row_array();
			}else{
				$data['mytrainer']= [];
				$data['trainer']= [];
			}
			$team_leader_id = $data['trainer']['link_user_id'];
			if(!empty($team_leader_id)){
				$query = $this->db->query("SELECT u.firstname, u.lastname, ue.whatsapp FROM bh_user u INNER JOIN bh_user_extra ue ON u.user_id = ue.user_id WHERE u.user_id=$team_leader_id");
				$data['mytl']=$query->row_array();
			}else{
				$data['mytl']=array();
			}
			
			$query = $this->db->query("SELECT * FROM bh_user_extra WHERE user_id=$team_leader_id");
			$data['stl']=$query->row_array();
			$stl_id = $data['stl']['link_user_id'];
			
			$query = $this->db->query("SELECT u.firstname, u.lastname, ue.whatsapp FROM bh_user u INNER JOIN bh_user_extra ue ON u.user_id = ue.user_id WHERE u.user_id=$stl_id");
			$data['mystl']=$query->row_array();
		}else{
			$data['mytrainer']= [];
			$data['mytl']= [];
			$data['mystl']= [];
		}
		$helpline_module = $this->settings_m->getSettingValue('helpline_module');
		$data['helpline_link']= isset($helpline_module['items'][1]['link'])?$helpline_module['items'][1]['link']:'';
		
		$townhall_module = $this->settings_m->getSettingValue('townhall_module');
		$data['townhall_link']=isset($townhall_module['items'][1]['link'])?$townhall_module['items'][1]['link']:'';
		
		$motivational_module = $this->settings_m->getSettingValue('motivational_module');
		$data['motivational_link']=isset($motivational_module['items'][1]['link'])?$motivational_module['items'][1]['link']:'';
		
		$data['photos']=[];
		$video_module = $this->settings_m->getSettingValue('video_module');
		if(!empty($video_module)){
			foreach($video_module['items'] as $photo){
				$data['photos'][]= 'https://webhavenmedia.com/weblogin/image/'. $photo['image'];
			}
		}
		
		$query = $this->db->query("SELECT * FROM bh_bestperformer WHERE type ='student'");
		$data['week_student']=$query->row_array();
		
		$query = $this->db->query("SELECT * FROM bh_bestperformer WHERE type ='trainer'");
		$data['week_trainer']=$query->row_array();
		
		$query = $this->db->query("SELECT * FROM bh_bestperformer WHERE type ='teamleader'");
		$data['week_teamleader']=$query->row_array();
		
		$query = $this->db->query("SELECT * FROM bh_dailyperformer");
		$data['daily']=$query->result_array();
		
		$data['page']='welcome';
	    $this->load->view('student/welcome', $data);
	}
}