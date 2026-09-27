<?php
class ControllerModuleCourse extends Controller {
	private $error = array();
	
	public function __construct($params) {
		parent::__construct($params);
		$this->load->model('module/course');
		$this->load->language('module/course');
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
			'filter_name'              => $filter_name,
			'filter_status'            => $filter_status,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];

		$items = array();
		$results = $this->model_module_course->getItems($filter_data);
		foreach($results['result'] as $key => $result) {
			$items[] = array(
				'course_id' => $result['course_id'],
				'course_name'   => $result['course_name'],
				'no_of_classes'   => $result['no_of_classes'],
				'priority'   => $result['priority'],
				'status'     => $result['course_status'],
				'created_at'			=>	date($this->config->get('config_date_format'), strtotime($result['created_at'])),
				'action'				=>	$result['course_id']
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
			$this->model_module_course->add($data);

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

			$this->response->redirect($this->url->link('module/course', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$data = $this->request->post;
			$data['link_id'] = 0;
			$this->model_module_course->edit($this->request->get['course_id'], $data);

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

			$this->response->redirect($this->url->link('module/course', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {

		$this->document->setTitle($this->language->get('heading_title'));

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $course_id) {
				$this->model_module_course->delete($course_id);
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

			$this->response->redirect($this->url->link('module/course', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
			'href' => $this->url->link('module/course', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['add'] = $this->url->link('module/course/add', 'token=' . $this->session->data['token'], 'SSL');
		$data['delete'] = $this->url->link('module/course/delete', 'token=' . $this->session->data['token'], 'SSL');

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
		
		$data['user_group_id'] = $this->user->getGroupId();
		$data['user_id'] = $this->user->getId();
		
		$data['page_length'] = $this->config->get('config_limit_admin');
		$data['edit'] = $this->url->link('module/course/edit', '&token=' . $this->session->data['token'], TRUE);
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/course_list.tpl', $data));
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

		if (isset($this->error['course_name'])) {
			$data['error_course_name'] = $this->error['course_name'];
		} else {
			$data['error_course_name'] = '';
		}

		if (isset($this->error['no_of_classes'])) {
			$data['error_no_of_classes'] = $this->error['no_of_classes'];
		} else {
			$data['error_no_of_classes'] = '';
		}

		if (isset($this->error['priority'])) {
			$data['error_priority'] = $this->error['priority'];
		} else {
			$data['error_priority'] = '';
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
			'href' => $this->url->link('module/course', 'token=' . $this->session->data['token'], 'SSL')
		);

		if (!isset($this->request->get['course_id'])) {
			$data['action'] = $this->url->link('module/course/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('module/course/edit', 'token=' . $this->session->data['token'] . '&course_id=' . $this->request->get['course_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('module/course', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['course_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$user_info = $this->model_module_course->get($this->request->get['course_id']);
		}

		if (isset($this->request->post['course_name'])) {
			$data['course_name'] = $this->request->post['course_name'];
		} elseif (!empty($user_info)) {
			$data['course_name'] = $user_info['course_name'];
		} else {
			$data['course_name'] = '';
		}

		if (isset($this->request->post['course_description'])) {
			$data['course_description'] = $this->request->post['course_description'];
		} elseif (!empty($user_info)) {
			$data['course_description'] = $user_info['course_description'];
		} else {
			$data['course_description'] = '';
		}

		if (isset($this->request->post['no_of_classes'])) {
			$data['no_of_classes'] = $this->request->post['no_of_classes'];
		} elseif (!empty($user_info)) {
			$data['no_of_classes'] = $user_info['no_of_classes'];
		} else {
			$data['no_of_classes'] = '';
		}

		if (isset($this->request->post['priority'])) {
			$data['priority'] = $this->request->post['priority'];
		} elseif (!empty($user_info)) {
			$data['priority'] = $user_info['priority'];
		} else {
			$data['priority'] = '';
		}

		if (isset($this->request->post['course_status'])) {
			$data['course_status'] = $this->request->post['course_status'];
		} elseif (!empty($user_info)) {
			$data['course_status'] = $user_info['course_status'];
		} else {
			$data['course_status'] = '';
		}
		
		if (isset($this->request->post['per_session_point'])) {
			$data['per_session_point'] = $this->request->post['per_session_point'];
		} elseif (!empty($user_info)) {
			$data['per_session_point'] = $user_info['per_session_point'];
		} else {
			$data['per_session_point'] = '';
		}
		
		if (isset($this->request->post['require_validation'])) {
			$data['require_validation'] = $this->request->post['require_validation'];
		} elseif (!empty($user_info)) {
			$data['require_validation'] = $user_info['require_validation'];
		} else {
			$data['require_validation'] = '';
		}

		if (isset($this->request->post['course_image'])) {
			$data['course_image'] = $this->request->post['course_image'];
		} elseif (!empty($user_info)) {
			$data['course_image'] = $user_info['course_image'];
		} else {
			$data['course_image'] = '';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['course_image']) && is_file(DIR_IMAGE . $this->request->post['course_image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['course_image'], 100, 100);
		} elseif (!empty($user_info) && $user_info['course_image'] && is_file(DIR_IMAGE . $user_info['course_image'])) {
			$data['thumb'] = $this->model_tool_image->resize($user_info['course_image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		if (isset($this->request->post['course_status'])) {
			$data['course_status'] = $this->request->post['course_status'];
		} elseif (!empty($user_info)) {
			$data['course_status'] = $user_info['course_status'];
		} else {
			$data['course_status'] = 1;
		}
		
		$data['text_form'] = !isset($this->request->get['course_id']) ? $this->language->get('text_add') : 'Edit Course';
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/course_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'module/course')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['course_name']) < 3) || (utf8_strlen($this->request->post['course_name']) > 50)) {
			$this->error['course_name'] = 'Invalid course name';
		}

		if (utf8_strlen(trim($this->request->post['no_of_classes'])) < 1) {
			$this->error['no_of_classes'] = 'Invalid no of classes/sessions';
		}
		
		if (utf8_strlen(trim($this->request->post['priority'])) < 1) {
			$this->error['priority'] = 'Invalid priority';
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'module/course')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['selected'] as $course_id) {
			if ($this->user->getId() == $course_id) {
				$this->error['warning'] = $this->language->get('error_account');
			}
		}

		return !$this->error;
	}
}