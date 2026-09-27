<?php
class ControllerModuleCounsellorstudent extends Controller {
	private $error = array();
	
	public function __construct($params) {
		parent::__construct($params);
		$this->load->model('student/student');
		$this->load->model('user/user');
		$this->load->language('student/student');
	}
	
	public function index() {
		$this->document->setTitle($this->language->get('heading_title'));
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && (strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($this->getItems()));
		} else {
			$this->getList();
		}
	}
	
	private function getItems() {
		$filter_name = isset($this->request->post['filter_name']) ? $this->request->post['filter_name'] : null;
		$filter_status = isset($this->request->post['filter_status']) ? $this->request->post['filter_status'] : null;
		$filter_search = isset($this->request->post['filter_search']) ? $this->request->post['filter_search'] : null;
		$filter_phone = isset($this->request->post['filter_phone']) ? $this->request->post['filter_phone'] : null;
		$filter_whatsapp = isset($this->request->post['filter_whatsapp']) ? $this->request->post['filter_whatsapp'] : null;
		$filter_email = isset($this->request->post['filter_email']) ? $this->request->post['filter_email'] : null;
		$filter_gender = isset($this->request->post['filter_gender']) ? $this->request->post['filter_gender'] : null;
		$filter_student_no = isset($this->request->post['filter_student_no']) ? $this->request->post['filter_student_no'] : null;
		$filter_refer_no = isset($this->request->post['filter_refer_no']) ? $this->request->post['filter_refer_no'] : null;
		$filter_user_no = isset($this->request->post['filter_user_no']) ? $this->request->post['filter_user_no'] : null;
		$filter_team_leader_no = isset($this->request->post['filter_team_leader_no']) ? $this->request->post['filter_team_leader_no'] : null;
		$filter_start_date = isset($this->request->post['filter_start_date']) ? $this->request->post['filter_start_date'] : null;
		$filter_end_date = isset($this->request->post['filter_end_date']) ? $this->request->post['filter_end_date'] : null;
		$order = isset($this->request->post['order']) ? $this->request->post['order'] : NULL;
		$start = isset($this->request->post['start']) ? $this->request->post['start'] : 0;
		$length = isset($this->request->post['length']) ? $this->request->post['length'] : $this->config->get('config_limit_admin');

		$filter_data = [
			'filter_search'              => $filter_search,
			'filter_status'              => $filter_status,
			'filter_name'              => $filter_name,
			'filter_phone'              => $filter_phone,
			'filter_whatsapp'              => $filter_whatsapp,
			'filter_email'              => $filter_email,
			'filter_gender'              => $filter_gender,
			'filter_student_no'              => $filter_student_no,
			'filter_refer_no'              => $filter_refer_no,
			'filter_created_start_date'       => $filter_start_date,
			'filter_created_end_date'         => $filter_end_date,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];

		$items = array();
		$filter_data['filter_status']=0;
		$filter_data['filter_counsellor_added_start_date']=$filter_start_date;
		$filter_data['filter_counsellor_added_end_date']=$filter_end_date;
		$filter_data['filter_link_user_id']=$this->user->getId();
		
		$user_info = $this->model_user_user->getUser($this->user->getId());
		$results = $this->model_student_student->getItemsForCounsellor($filter_data);
		
		foreach($results['result'] as $key => $result) {
			$phone = !empty($result['student_whatsapp']) ? $result['student_whatsapp'] : $result['student_phone'];
			$items[] = array(
				'id' => $result['id'],
				'student_no' => $result['student_no'],
				'student_name'   => $result['student_name'],
				'student_phone'   => $result['student_phone'],
				'student_phone_raw' => $phone,
				'student_whatsapp'   => !empty($result['student_whatsapp']) ? '<a target="_blank" href="https://api.whatsapp.com/send?phone='.ltrim($result['student_whatsapp'], '+').'">'.$result['student_whatsapp'].'</a>' : '',
				'student_telegram'   => '<a onclick="copyImo(\''.addslashes($result['student_telegram']).'\')">'.$result['student_telegram'].'</a>',
				'student_gender'   => $result['student_gender'],
				'student_city'   => $result['student_city'],
				'student_country'   => $result['student_country'],
				'student_language'   => $result['student_language'],
				'student_email'   => $result['student_email'],
				'student_point'   => $result['student_point'],
				'message_status'   => $result['message_status'],
				'whatsapp_status'   => $result['whatsapp_status'],
				'student_status'   => ($result['student_status']==1)?'Active':'Inactive',
				'student_refer_name'   => $result['refer_student_name'].'-'.$result['refer_student_no'],
				'created_at'			=>	date($this->config->get('config_date_format'), strtotime($result['created_at'])),
				'action'				=>	$result['id']
			);
		}

		$json = array(
			'draw'				=>	(int)$this->request->post['draw'],
			'recordsTotal'		=>	$results['recordsTotal'],
			'recordsFiltered'	=>	$results['recordsFiltered'],
			'data'				=>	$items,
		);

		return $json;
	}

	protected function getList() {
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => 'My Student',
			'href' => $this->url->link('module/counsellorstudent', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['heading_title'] = $this->language->get('heading_title');
		$data['token'] = $this->session->data['token'];
		
		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_username'] = $this->language->get('column_username');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}
		
		if (isset($this->request->post['filter_start_date'])) {
			$data['filter_start_date'] = $this->request->post['filter_start_date'];
		} else {
			$data['filter_start_date'] = date('Y-m-01');
		}
		
		if (isset($this->request->post['filter_end_date'])) {
			$data['filter_end_date'] = $this->request->post['filter_end_date'];
		} else {
			$data['filter_end_date'] = date('Y-m-t');
		}
		
		$data['user_id'] = $this->user->getId();
		$data['user_group_id'] = $this->user->getGroupId();
		
		$data['page_length'] = $this->config->get('config_limit_admin');
		$data['refer'] = $this->url->link('student/student/refer', '&token=' . $this->session->data['token'], TRUE);
		$data['payment'] = $this->url->link('student/student/payment', '&token=' . $this->session->data['token'], TRUE);
		$data['withdrawal'] = $this->url->link('student/student/withdrawal', '&token=' . $this->session->data['token'], TRUE);
		$data['passbook'] = $this->url->link('student/student/passbook', '&token=' . $this->session->data['token'], TRUE);
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/counsellor_student_list.tpl', $data));
	}
	
	public function message(){
		$json = array();
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && (strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
			if(empty($_POST['student_id'])){
				$json['error'] = 'Not a valid request. Try again';
			}
			
			if (!isset($json['error'])) {
				$this->model_student_student->counsellormessage($_POST['student_id']);
				$json['success'] = 'Message done added for this student.';
			}
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function whatsapp(){
		$json = array();
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && (strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
			if(empty($_POST['student_id'])){
				$json['error'] = 'Not a valid request. Try again';
			}
			
			if (!isset($json['error'])) {
				$this->model_student_student->whatsappmessage($_POST['student_id']);
				$student_info = $this->model_student_student->get($_POST['student_id']);
				$refer_point = $this->config->get('config_refer_point');
				
				$this->model_student_student->managePoint(array('student_id'=>$student_info['refer_id'], 'reason'=>'Wrong Whatsapp No', 'description'=>'Due to wrong whatsapp no for refer student, refer point deduct', 'credit_point'=>0, 'debit_point'=>$refer_point, 'type'=>'Debit'));
				
				$json['success'] = 'Whatsapp done added for this student.';
			}
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
