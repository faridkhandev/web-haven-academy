<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends Frontend_Controller {
	
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
		$query = $this->db->query("SELECT * FROM bh_course WHERE course_delete_status = 0 AND course_status= 1 ORDER BY priority ASC");
		$data['courses']=$query->result_array();
		$data['page']='course';
		$this->load->view('student/courses', $data);
	}
	
	public function view(){
		if(isset($_GET['id'])){
			$query = $this->db->query("SELECT * FROM bh_course WHERE course_id='".$_GET['id']."'");
			$data['course']=$query->row_array();
			$data['page']='coursedetails';
			$this->load->view('student/coursedetails', $data); 
		}else{
			redirect(base_url('student/course'));
		}
	}
	
	public function sessionview(){
		if(isset($_GET['id'])){
			if(isset($_GET['session_no'])){
				$query = $this->db->query("SELECT * FROM bh_course WHERE course_id='".$_GET['id']."'");
				$data['course']=$query->row_array();
				
				$query = $this->db->query("SELECT cs.*, c.course_name, u.firstname, u.lastname FROM bh_course_to_session cs INNER JOIN bh_course c ON cs.course_id = c.course_id INNER JOIN bh_user u ON cs.session_teacher_id = u.user_id WHERE cs.delete_status=0 AND cs.course_id='".$_GET['id']."' AND cs.session_no='".$_GET['session_no']."' ORDER BY session_id DESC LIMIT 1");
				$data['session']=$query->row_array();
				
				$query = $this->db->query("SELECT * FROM bh_student_to_course_session WHERE course_id='".$_GET['id']."' AND session_id = '".$data['session']['session_id']."' AND student_id='".$this->session->userdata('id')."' AND point_status = 1");
				$data['student_status']=$query->row_array();
				
				$query = $this->db->query("SELECT * FROM bh_student_to_course_session WHERE course_id='".$_GET['id']."' AND session_id = '".$data['session']['session_id']."' AND student_id='".$this->session->userdata('id')."'");
				$data['submit_status']=$query->row_array();
				
				$data['page']='coursedetails';
				$this->load->view('student/sessiondetails', $data); 
			}else{
				redirect(base_url('student/course/view').'?id='.$_GET['id']);
			}
		}else{
			redirect(base_url('student/course'));
		}
	}
	
	public function addrequest(){
		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			if(empty($_POST['link'])){
				$json['error'] = 'Please add link';
			}
			if(empty($_POST['course_id'])){
				$json['error'] = 'Course not found, please select course then select session.';
			}
			if(empty($_POST['session_id'])){
				$json['error'] = 'Please select session.';
			}
			if (empty($json['error'])) {
				
				$query = $this->db->query("SELECT * FROM bh_student_to_course_session WHERE student_id = '" . $this->session->userdata('id') . "' AND date(date_added) = '".date('Y-m-d')."'");
				$row = $query->row_array();
				if (isset($row)){
					$json['error'] = 'You already submited one task for today, you can not submit more. Submit tomorrow.';
				}else{				
					$this->db->insert('bh_student_to_course_session', array('student_id'=>$this->session->userdata('id'), 'session_id'=>$_POST['session_id'], 'course_id'=>$_POST['course_id'], 'work_link'=>$_POST['link'], 'point_status'=>2, 'date_added'=>date('Y-m-d H:i:s')));
					
					$id = $this->db->insert_id();
					if($id){
						$json['success'] = 'Your request successfully send to admin.';
					}else{
						$json['error'] = 'Request did not send due to system error. Try again';
					}
				}
			}
		}
		echo json_encode($json);
	}
}