<?php
class ControllerModuleSession extends Controller {
	private $error = array();
	
	public function __construct($params) {
		parent::__construct($params);
		$this->load->model('module/course');
		$this->load->model('module/session');
		$this->load->model('user/user');
		$this->load->language('module/session');
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
		if (isset($this->request->post['filter_start_date'])) {
			$filter_start_date = $this->request->post['filter_start_date'];
		} else {
			$filter_start_date = null;
		}
		
		if (isset($this->request->post['filter_end_date'])) {
			$filter_end_date = $this->request->post['filter_end_date'];
		} else {
			$filter_end_date = null;
		}
		
		if (isset($this->request->post['filter_course'])) {
			$filter_course = $this->request->post['filter_course'];
		} else {
			$filter_course = null;
		}

		if (isset($this->request->post['filter_teacher'])) {
			$filter_teacher = $this->request->post['filter_teacher'];
		} else {
			$filter_teacher = null;
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

		$filter_data = [
			'filter_start_date'              => $filter_start_date,
			'filter_end_date'              => $filter_end_date,
			'filter_course'              => $filter_course,
			'filter_teacher'            => $filter_teacher,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];
		
		if($this->user->getGroupId()==14){
			$filter_data['filter_teacher'] = $this->user->getId();
		}

		$items = array();
		$results = $this->model_module_session->getItems($filter_data);
		foreach($results['result'] as $key => $result) {
			$items[] = array(
				'session_id' => $result['session_id'],
				'course_name'   => $result['course_name'],
				'session_no'   => $result['session_no'],
				'teacher_name'   => $result['firstname'].' '.$result['lastname'],
				'session_point'     => $result['session_point'],
				'session_date'			=>	$result['session_date'].'-'.$result['session_time'],
				'created_at'			=>	date($this->config->get('config_date_format'), strtotime($result['session_created_at'])),
				'action'				=>	$result['session_id']
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

	public function add() {
		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$data = $this->request->post;
			$this->model_module_session->add($data);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('module/session', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$data = $this->request->post;
			$this->model_module_session->edit($this->request->get['session_id'], $data);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('module/session', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {

		$this->document->setTitle($this->language->get('heading_title'));

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $session_id) {
				$this->model_module_session->delete($session_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('module/session', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/session', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['add'] = $this->url->link('module/session/add', 'token=' . $this->session->data['token'], 'SSL');
		$data['delete'] = $this->url->link('module/session/delete', 'token=' . $this->session->data['token'], 'SSL');

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
		
		$data['page_length'] = $this->config->get('config_limit_admin');
		$data['edit'] = $this->url->link('module/session/edit', '&token=' . $this->session->data['token'], TRUE);
		$data['view'] = $this->url->link('module/session/view', '&token=' . $this->session->data['token'], TRUE);
		
		$teachers = $this->model_user_user->getSubItems(array('filter_group_id'=>14));
		$data['teachers'] = $teachers['result'];
		
		$courses = $this->model_module_course->getItems();
		$data['courses'] = $courses['result'];
		
		$data['user_id'] = $this->user->getId();
		$data['user_group_id'] = $this->user->getGroupId();
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/session_list.tpl', $data));
	}

	protected function getForm() {
		$data['user_group_id'] = $this->user->getGroupId();
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_username'] = $this->language->get('entry_username');
		$data['entry_user_group'] = $this->language->get('entry_user_group');
		$data['entry_password'] = $this->language->get('entry_password');
		$data['entry_confirm'] = $this->language->get('entry_confirm');
		$data['entry_firstname'] = $this->language->get('entry_firstname');
		$data['entry_lastname'] = $this->language->get('entry_lastname');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['course_id'])) {
			$data['error_course_id'] = $this->error['course_id'];
		} else {
			$data['error_course_id'] = '';
		}
		
		if (isset($this->error['session_teacher_id'])) {
			$data['error_session_teacher_id'] = $this->error['session_teacher_id'];
		} else {
			$data['error_session_teacher_id'] = '';
		}

		if (isset($this->error['session_no'])) {
			$data['error_session_no'] = $this->error['session_no'];
		} else {
			$data['error_session_no'] = '';
		}

		if (isset($this->error['meeting_link'])) {
			$data['error_meeting_link'] = $this->error['meeting_link'];
		} else {
			$data['error_meeting_link'] = '';
		}
		
		if (isset($this->error['session_date'])) {
			$data['session_date'] = $this->error['session_date'];
		} else {
			$data['session_date'] = '';
		}
		
		if (isset($this->error['session_time'])) {
			$data['session_time'] = $this->error['session_time'];
		} else {
			$data['session_time'] = '';
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/session', 'token=' . $this->session->data['token'], 'SSL')
		);

		if (!isset($this->request->get['session_id'])) {
			$data['action'] = $this->url->link('module/session/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('module/session/edit', 'token=' . $this->session->data['token'] . '&session_id=' . $this->request->get['session_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('module/session', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['session_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$user_info = $this->model_module_session->get($this->request->get['session_id']);
		}

		if (isset($this->request->post['course_id'])) {
			$data['course_id'] = $this->request->post['course_id'];
		} elseif (!empty($user_info)) {
			$data['course_id'] = $user_info['course_id'];
		} else {
			$data['course_id'] = '';
		}

		if (isset($this->request->post['session_teacher_id'])) {
			$data['session_teacher_id'] = $this->request->post['session_teacher_id'];
		} elseif (!empty($user_info)) {
			$data['session_teacher_id'] = $user_info['session_teacher_id'];
		} else {
			$data['session_teacher_id'] = '';
		}

		if (isset($this->request->post['meeting_link'])) {
			$data['meeting_link'] = $this->request->post['meeting_link'];
		} elseif (!empty($user_info)) {
			$data['meeting_link'] = $user_info['meeting_link'];
		} else {
			$data['meeting_link'] = '';
		}
	
		if (isset($this->request->post['session_date'])) {
			$data['session_date'] = $this->request->post['session_date'];
		} elseif (!empty($user_info)) {
			$data['session_date'] = $user_info['session_date'];
		} else {
			$data['session_date'] = '';
		}

		if (isset($this->request->post['session_time'])) {
			$data['session_time'] = $this->request->post['session_time'];
		} elseif (!empty($user_info)) {
			$data['session_time'] = $user_info['session_time'];
		} else {
			$data['session_time'] = '';
		}
		
		if (isset($this->request->post['session_no'])) {
			$data['session_no'] = $this->request->post['session_no'];
		} elseif (!empty($user_info)) {
			$data['session_no'] = $user_info['session_no'];
		} else {
			$data['session_no'] = '';
		}
		
		if (isset($this->request->post['no_of_classes'])) {
			$data['no_of_classes'] = $this->request->post['no_of_classes'];
		} else {
			$data['no_of_classes'] = '';
		}
		
		$teachers = $this->model_user_user->getSubItems(array('filter_group_id'=>14));
		$data['teachers'] = $teachers['result'];
		
		$courses = $this->model_module_course->getItems();
		$data['courses'] = $courses['result'];
		
		$data['user_id'] = $this->user->getId();
		$data['user_group_id'] = $this->user->getGroupId();
		
		$data['text_form'] = !isset($this->request->get['session_id']) ? $this->language->get('text_add') : 'Edit Session';
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/session_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'module/session')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (utf8_strlen(trim($this->request->post['course_id'])) < 1) {
			$this->error['course_id'] = 'Invalid course';
		}
		
		if (utf8_strlen(trim($this->request->post['session_teacher_id'])) < 1) {
			$this->error['session_teacher_id'] = 'Invalid Teacher';
		}
		
		if (utf8_strlen(trim($this->request->post['session_date'])) < 1) {
			$this->error['session_date'] = 'Invalid session start date';
		}
		
		if (utf8_strlen(trim($this->request->post['session_time'])) < 1) {
			$this->error['session_time'] = 'Invalid session time date';
		}
		
		if (utf8_strlen(trim($this->request->post['session_no'])) < 1) {
			$this->error['session_no'] = 'Invalid session no';
		}
		
		if (utf8_strlen(trim($this->request->post['meeting_link'])) < 1) {
			$this->error['meeting_link'] = 'Invalid meeting link';
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'module/session')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		/* foreach ($this->request->post['selected'] as $session_id) {
			if ($this->user->getId() == $course_id) {
				$this->error['warning'] = $this->language->get('error_account');
			}
		} */

		return !$this->error;
	}
	
	public function view() {
		$this->document->setTitle($this->language->get('heading_title'));
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && (strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($this->getSessionStudentItems()));
		} else {
			$this->getSessionStudentList();
		}
	}
	
	private function getSessionStudentItems() {
		$data['user_id'] = $this->user->getId();
		$data['user_group_id'] = $this->user->getGroupId();
		if (isset($this->request->post['filter_student'])) {
			$filter_student = $this->request->post['filter_student'];
		} else {
			$filter_student = null;
		}
		
		if (isset($this->request->post['session_id'])) {
			$filter_session_id = $this->request->post['session_id'];
		} else {
			$filter_session_id = null;
		}

		if($user_group_id == 14){
			$filter_teacher_id = $this->user->getId();
		}elseif (isset($this->request->post['filter_teacher'])) {
			$filter_teacher_id = $this->request->post['filter_teacher'];
		} else {
			$filter_teacher_id = null;
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

		$filter_data = [
			'filter_student'              => $filter_student,
			'filter_session_id'              => $filter_session_id,
			'filter_teacher_id'            => $filter_teacher_id,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];

		$items = array();
		$results = $this->model_module_session->getSessionItems($filter_data);
		foreach($results['result'] as $key => $result) {
			$items[] = array(
				'id' => $result['id'],
				'point_status'   => $result['point_status'],
				'student_name'   => $result['student_name'],
				'student_no'   => $result['student_no'],
				'point'   => $result['point'],
				'work_link'   => ($result['work_link']!= '')?'<a target="_blank" href="'.$result['work_link'].'" class="btn">View</a>':'',
				'date_added'			=>	date($this->config->get('config_date_format'), strtotime($result['date_added'])),
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

	protected function getSessionStudentList() {
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/session', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['add'] = $this->url->link('module/session/add', 'token=' . $this->session->data['token'], 'SSL');
		$data['delete'] = $this->url->link('module/session/delete', 'token=' . $this->session->data['token'], 'SSL');

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
		
		$data['page_length'] = $this->config->get('config_limit_admin');
		$data['edit'] = $this->url->link('module/session/edit', '&token=' . $this->session->data['token'], TRUE);
		$data['view'] = $this->url->link('module/session/view', '&token=' . $this->session->data['token'], TRUE);
		
		$teachers = $this->model_user_user->getSubItems(array('filter_group_id'=>14));
		$data['teachers'] = $teachers['result'];
		
		$courses = $this->model_module_course->getItems();
		$data['courses'] = $courses['result'];
		
		$data['user_id'] = $this->user->getId();
		$data['user_group_id'] = $this->user->getGroupId();
		$data['session_id'] = $this->request->get['session_id'];
		
		$data['session_info'] = $this->model_module_session->get($this->request->get['session_id']);
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/session_student_list.tpl', $data));
	}
	
}