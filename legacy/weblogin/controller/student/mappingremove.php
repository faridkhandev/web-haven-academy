<?php
class ControllerStudentMappingremove extends Controller {
	private $error = array();
	
	public function __construct($params) {
		parent::__construct($params);
		$this->load->model('student/student');
		$this->load->language('student/student');
	}
	
	public function index() {
		$this->document->setTitle($this->language->get('heading_title'));
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_student_student->mappingremove($this->request->post['student_no']);
			$this->session->data['success'] = $this->language->get('text_success');
		} else {
			$this->getList();
		}
	}
	
	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'student/student')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (utf8_strlen($this->request->post['student_no']) == 0 ) {
			$this->error['student_no'] = 'Invalid Student No.';
		}
		
		$user_info = $this->model_student_student->getStudentByNo($this->request->post['student_no']);

		if (empty($user_info)) {
			$this->error['warning'] = 'This Student no does not exist, try again.';
		} else {
			if ($user_info && ($user_info['student_status'] == 0)) {
				$this->error['warning'] = 'This Student no already inactive, try different Student no.';
			}
		}

		return !$this->error;
	}
	
	protected function getList() {
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('student/project', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['delete'] = $this->url->link('student/project/delete', 'token=' . $this->session->data['token'], 'SSL');

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

		if (isset($this->error['student_no'])) {
			$data['error_student_no'] = $this->error['student_no'];
		} else {
			$data['error_student_no'] = '';
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
		$data['action'] = $this->url->link('student/mappingremove', '&token=' . $this->session->data['token'], TRUE);
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('student/student_mapping_remove.tpl', $data));
	}
	
}