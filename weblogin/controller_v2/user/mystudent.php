<?php
class ControllerUserMystudent extends Controller {
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
		if (isset($this->request->post['filter_link_user_id'])) {
			$filter_link_user_id = $this->request->post['filter_link_user_id'];
		} else {
			$filter_link_user_id = null;
		}
		
		if (isset($this->request->post['filter_name'])) {
			$filter_name = $this->request->post['filter_name'];
		} else {
			$filter_name = null;
		}
		
		if (isset($this->request->post['filter_status'])) {
			$filter_status = $this->request->post['filter_status'];
		} else {
			$filter_status = null;
		}
		
		if (isset($this->request->post['filter_search'])) {
			$filter_search = $this->request->post['filter_search'];
		} else {
			$filter_search = null;
		}
		
		if (isset($this->request->post['filter_phone'])) {
			$filter_phone = $this->request->post['filter_phone'];
		} else {
			$filter_phone = null;
		}
		
		if (isset($this->request->post['filter_email'])) {
			$filter_email = $this->request->post['filter_email'];
		} else {
			$filter_email = null;
		}
		
		if (isset($this->request->post['filter_gender'])) {
			$filter_gender = $this->request->post['filter_gender'];
		} else {
			$filter_gender = null;
		}
		
		if (isset($this->request->post['filter_student_no'])) {
			$filter_student_no = $this->request->post['filter_student_no'];
		} else {
			$filter_student_no = null;
		}
		
		if (isset($this->request->post['filter_start_date'])) {
			$filter_start_date = $this->request->post['filter_start_date'];
		} else {
			$filter_start_date = date('Y-m-01');
		}
		
		if (isset($this->request->post['filter_end_date'])) {
			$filter_end_date = $this->request->post['filter_end_date'];
		} else {
			$filter_end_date = date('Y-m-t');
		}
		
		if (isset($this->request->post['order'])) {
			$order = $this->request->post['order'];
		} else {
			$order = NULL;
		}

		if (isset($this->request->post['start'])) {
			$start = $this->request->post['start'];
		} else {
			$start = 0;
		}

		if (isset($this->request->post['length'])) {
			$length = $this->request->post['length'];
		} else {
			$length = $this->config->get('config_limit_admin');
		}
		
		if(!empty($this->request->post['filter_link_user_id'])){
			$user_info = $this->model_user_user->getUser($this->request->post['filter_link_user_id']);
			if($user_info['user_group_id']==11){
				$filter_link_user_id = $this->request->post['filter_link_user_id'];
			}elseif($user_info['user_group_id']==12){
				$filter_link_user_id = $this->model_user_user->getMyTrainersForTeamLeader($this->request->post['filter_link_user_id'], false);
			}elseif($user_info['user_group_id']==13){
				$filter_link_user_id = $this->model_user_user->getMyTrainersForSeniorTeamLeader($this->request->post['filter_link_user_id'], false);
			}
		}

		$filter_data = [
			'filter_search'           => $filter_search,
			'filter_status'           => $filter_status,
			'filter_name'             => $filter_name,
			'filter_phone'            => $filter_phone,
			'filter_email'            => $filter_email,
			'filter_gender'           => $filter_gender,
			'filter_student_no'       => $filter_student_no,
			'filter_link_user_id'     => $filter_link_user_id,
			'filter_created_start_date'       => $filter_start_date,
			'filter_created_end_date'         => $filter_end_date,
			'order'   				  => $order,
			'start'   				  => $start,
			'length'   				  => $length
		];
		//print_r($filter_data);
		$items = array();
		$results = $this->model_student_student->getMyItems($filter_data);
		//print_r($filter_data);
		foreach($results['result'] as $key => $result) {
			$items[] = array(
				'id' => $result['id'],
				'student_no' => $result['student_no'],
				'student_name'   => $result['student_name'],
				'student_phone'   => $result['student_phone'],
				'student_whatsapp'   => '<a target="_blank" href="https://api.whatsapp.com/send?phone='.ltrim($result['student_whatsapp'], '+').'">'.$result['student_whatsapp'].'</a>',
				'student_gender'   => $result['student_gender'],
				'student_email'   => $result['student_email'],
				'student_status'   => $result['student_status'],
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
			'href' => $this->url->link('module/mystudent', 'token=' . $this->session->data['token'] . $url, 'SSL')
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
		
		if (isset($this->request->get['id'])) {
			$data['id'] = $this->request->get['id'];
		} else {
			$data['id'] = '';
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
		$user_info = $this->model_user_user->getUser($this->request->get['id']);
		$data['page_length'] = $this->config->get('config_limit_admin');
		
		$data['text_list'] = !isset($this->request->get['id']) ? 'My Student List' : 'My Student List'.'(<div class="miltiInfo"><span>Id:'.$user_info['user_id'].'</span>||<span>Username:'.$user_info['username'].'</span>||<span>Name:'.$user_info['firstname'].' '.$user_info['lastname'].'</span></div>)';
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('user/student_list.tpl', $data));
	}
}