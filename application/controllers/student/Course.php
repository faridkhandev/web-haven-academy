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
		//print_r($_SESSION);
		if(!$this->session->userdata('student')){
			redirect(base_url().'login');
		}
		
		if($this->session->userdata('student_status')==0){
			redirect(base_url('student/dashboard'));
		}
	}
	
	public function index(){
		$query = $this->db->query("SELECT * FROM bh_course WHERE course_delete_status = 0 AND parent_id = 0 AND course_status= 1 and type_id = 1 ORDER BY sort_order ASC");
		$data['courses']=$query->result_array();
		$query = $this->db->query("SELECT * FROM bh_course WHERE course_delete_status = 0 AND course_status= 1 and type_id = 2 ORDER BY sort_order ASC");
		$data['betacourses']=$query->result_array();
		$data['page']='course';
		$this->load->view('student/courses', $data);
	}
	
	public function view(){
		if(isset($_GET['id'])){
			$query = $this->db->query("SELECT * FROM bh_course WHERE course_id='".$_GET['id']."'");
			$data['course']=$query->row_array();
			
			$query = $this->db->query("SELECT * FROM bh_course WHERE parent_id='".$_GET['id']."'");
			$data['childcourses']=$query->result_array();
			
			$data['page']='coursedetails';
			
			$query = $this->db->query("SELECT no_of_classes FROM bh_course WHERE course_id='".$_GET['id']."'");
			$course=$query->row_array();
			
			$query = $this->db->query("SELECT COUNT(session_id) AS total_count FROM bh_course_to_session WHERE session_id IN(SELECT session_id FROM bh_student_to_course_session WHERE course_id='".$_GET['id']."' AND student_id='".$this->session->userdata('id')."')");
			$course_session=$query->row_array();
			if($course['no_of_classes']<=$course_session['total_count']){
				$data['complete']=true;
			}else{
				$data['complete']=false;
			}
				
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
				
				$query = $this->db->query("SELECT cs.*, c.course_name, u.firstname, u.lastname FROM bh_course_to_session cs INNER JOIN bh_course c ON cs.course_id = c.course_id INNER JOIN bh_user u ON cs.session_teacher_id = u.user_id INNER JOIN bh_user_extra ue ON ue.user_id = u.user_id WHERE cs.delete_status=0 AND cs.course_id='".$_GET['id']."' AND cs.session_no='".$_GET['session_no']."' AND ue.language='".$this->session->userdata('student_language')."' ORDER BY session_id DESC LIMIT 1");
				$data['session']=$query->row_array();
				
				$query = $this->db->query("SELECT * FROM bh_student_to_course_session WHERE course_id='".$_GET['id']."' AND session_id = '".$data['session']['session_id']."' AND student_id='".$this->session->userdata('id')."'");
				$data['student_status']=$query->row_array();
				
				$data['student_language'] = $this->session->userdata('student_language');
				
				$query = $this->db->query("SELECT * FROM bh_student_to_course_session WHERE course_id='".$_GET['id']."' AND student_id='".$this->session->userdata('id')."' AND session_id IN(SELECT session_id FROM bh_course_to_session WHERE session_no='".$_GET['session_no']."') AND work_status = 1");
				$data['submit_status']=$query->row_array();
				
				$data['student_no']=$this->session->userdata('student_no');
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
			
			/* if (!filter_var(trim($_POST['link']), FILTER_VALIDATE_URL)) {
				$json['error'] = 'Invalid work link';
			} */
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
				    $this->db->where('student_id', $this->session->userdata('id'));
                    $this->db->where('session_id', $_POST['session_id']);
                    $this->db->where('course_id', $_POST['course_id']);
                    $this->db->delete('bh_student_to_course_session');

					$this->db->insert('bh_student_to_course_session', array('student_id'=>$this->session->userdata('id'), 'session_id'=>$_POST['session_id'], 'course_id'=>$_POST['course_id'], 'work_link'=>trim($_POST['link']), 'point_status'=>2, 'date_added'=>date('Y-m-d H:i:s')));
					
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
	
	public function uploadrequest(){
		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			if (is_file($_FILES['screenshot']['tmp_name'])) {
				$filename = basename(html_entity_decode($_FILES['screenshot']['name'], ENT_QUOTES, 'UTF-8'));
				
				$allowed = array('jpg','jpeg','gif','png');
				if (!in_array(strtolower(substr(strrchr($filename, '.'), 1)), $allowed)) {
					$json['error'] = 'Invalid file type. Only JPG, PNG allowed.';
				}
				
				$allowed = array('image/jpeg','image/pjpeg','image/png','image/x-png','image/gif');
				if (!in_array($_FILES['screenshot']['type'], $allowed)) {
					$json['error'] = 'Invalid file type. Only JPG, PNG allowed.';
				}
				
				if ($_FILES['screenshot']['error'] != UPLOAD_ERR_OK) {
					$json['error'] = 'File upload error, please try again.'. $_FILES['screenshot']['error'];
				}
			}else{
				$json['error'] = 'No File uploaded, please try again.';
			}			
			
			if(empty($_POST['course_id'])){
				$json['error'] = 'Course not found, please select course then select session.';
			}
			if(empty($_POST['session_id'])){
				$json['error'] = 'Please select session.';
			}
			
			if (empty($json['error'])) {
				$querymain = $this->db->query("SELECT * FROM bh_student_to_course_session WHERE student_id = '" . $this->session->userdata('id') . "' AND course_id = '".$_POST['course_id']."' AND session_id = '".$_POST['session_id']."'");
				$rowmain = $querymain->row_array();
				if (!empty($rowmain)){
					$json['error'] = 'You already submited task for this course and session.';
				}else{
				
					$query = $this->db->query("SELECT * FROM bh_student_to_course_session WHERE student_id = '" . $this->session->userdata('id') . "' AND date(date_added) = '".date('Y-m-d')."'");
					$row = $query->row_array();
					if (isset($row)){
						$json['error'] = 'You already submited one task for today, you can not submit more. Submit tomorrow.';
					}else{		
						$temp = explode(".", $_FILES["screenshot"]["name"]);
						$newfilename = round(microtime(true)) . '.' . end($temp);
						
						$link = base_url().'uploads/' . $newfilename;
						
						move_uploaded_file($_FILES['screenshot']['tmp_name'], '/home/dhes7qmvbgxu/public_html/uploads/' . $newfilename);
						
						$this->db->insert('bh_student_to_course_session', array('student_id'=>$this->session->userdata('id'), 'session_id'=>$_POST['session_id'], 'course_id'=>$_POST['course_id'], 'work_link'=>$link, 'point_status'=>2, 'date_added'=>date('Y-m-d H:i:s')));
						
						$id = $this->db->insert_id();
						if($id){
							$json['success'] = 'Your request successfully send to admin.';
						}else{
							$json['error'] = 'Request did not send due to system error. Try again';
						}
					}
				}
			}
		}
		echo json_encode($json);
	}
}