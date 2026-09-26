<?php
class ControllerStudentStudentReport extends Controller {
	private $error = array();
	
	public function __construct($params) {
		parent::__construct($params);
		$this->load->model('student/student');
		$this->load->model('user/user');
		$this->load->language('student/student');
	}
	
	public function index() {
		$this->document->setTitle('My Student Report');
		$data['token'] = $this->session->data['token'];
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => 'My Student Report',
			'href' => $this->url->link('student/student_report', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);
		
		if (isset($this->request->get['filter_date_added'])) {
			$filter_data['filter_link_start_date'] = $this->request->get['filter_date_added'];
		} else {
			$filter_data['filter_link_start_date'] = date('Y-m-01');
		}
		
		if (isset($this->request->get['filter_date_ended'])) {
			$filter_data['filter_link_end_date'] = $this->request->get['filter_date_ended'];
		} else {
			$filter_data['filter_link_end_date'] = date('Y-m-t');
		}
		
		if($this->user->getGroupId() == 15){ // Counsellor
			$filter_data['filter_status']=0;
			$filter_data['filter_link_user_id']=$this->user->getId();
			$results = $this->model_student_student->getItemsForCounsellor($filter_data);
			
		}elseif($this->user->getGroupId() == 13){ // STL
			$user_ids = $this->model_user_user->getMyTrainersForSeniorTeamLeader($this->user->getId(), false);
			if($user_ids != ''){
				$filter_data['filter_link_user_id']= $user_ids;
			}
			$filter_data['filter_team_leader_no'] = $filter_team_leader_no;
			$results = $this->model_student_student->getMyItems($filter_data);
		}elseif($this->user->getGroupId() == 12){ //Team Leader
			$user_ids = $this->model_user_user->getMyTrainersForTeamLeader($this->user->getId(), false);
			if($user_ids != ''){
				$filter_data['filter_link_user_id']= $user_ids;
			}
			//print_r($filter_data);
			$results = $this->model_student_student->getMyItems($filter_data);
		}elseif($this->user->getGroupId() == 11){ //Trainer
			
			$filter_data['filter_link_user_id']=$this->user->getId();
			//print_r($filter_data);
			$results = $this->model_student_student->getMyItems($filter_data);
		}
		
		$data['total_records'] = $results['recordsFiltered'];
		
		$data['link'] = $this->url->link('module/mystudent', '&token=' . $this->session->data['token'], TRUE);
		
		if (isset($this->request->get['filter_date_added'])) {
			$data['filter_start_date'] = $this->request->get['filter_date_added'];
		} else {
			$data['filter_start_date'] = date('Y-m-01');
		}
		
		if (isset($this->request->get['filter_date_ended'])) {
			$data['filter_end_date'] = $this->request->get['filter_date_ended'];
		} else {
			$data['filter_end_date'] = date('Y-m-t');
		}
		
		$data['user_id'] = $this->user->getId();
		$data['user_group_id'] = $this->user->getGroupId();
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('student/student_report.tpl', $data));
	}
}