<?php
class ControllerModuleInactiveStudentCount extends Controller {
	private $error = array();
	
	public function __construct($params) {
		parent::__construct($params);
		$this->load->model('student/student');
		$this->load->model('user/user');
		$this->load->language('student/student');
	}
	
	public function index() {
		$this->document->setTitle($this->language->get('heading_title'));
		$this->getList();
	}
	
	protected function getList() {
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => 'Inactive Student Count',
			'href' => $this->url->link('module/inactivestudentcount', 'token=' . $this->session->data['token'], 'SSL')
		);


		$data['heading_title'] = 'Inactive Student Count';
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
		
		if (isset($this->request->get['filter_start_date'])) {
			$data['filter_start_date'] = $filter_data['filter_created_start_date'] = $this->request->get['filter_start_date'];
		} else {
			$data['filter_start_date'] = $filter_data['filter_created_start_date'] = date('Y-m-01');
		}
		
		if (isset($this->request->get['filter_end_date'])) {
			$data['filter_end_date'] = $filter_data['filter_created_end_date'] = $this->request->get['filter_end_date'];
		} else {
			$data['filter_end_date'] = $filter_data['filter_created_end_date'] = date('Y-m-t');
		}
		
		$results = $this->model_student_student->countInactiveItems($filter_data);
		$data['recordsFiltered'] = $results;
		$data['user_id'] = $this->user->getId();
		$data['user_group_id'] = $this->user->getGroupId();
		
		$data['page_length'] = $this->config->get('config_limit_admin');
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/inactive_student_count.tpl', $data));
	}
}