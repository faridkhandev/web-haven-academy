<?php
class ControllerModuleTeamleaderreport extends Controller {
	private $error = array();
	
	public function __construct($params) {
		parent::__construct($params);
		$this->load->model('module/report');
		$this->load->model('user/user');
		$this->load->language('student/student');
	}

	public function index() {
		$this->document->setTitle('Team Leader Report');
		$this->getList();
	}
	
	protected function getList() {
		if (isset($this->request->get['filter_start_date'])) {
			$filter_start_date = $this->request->get['filter_start_date'];
		} else {
			$filter_start_date = date('Y-m-01');
		}
		
		if (isset($this->request->get['filter_end_date'])) {
			$filter_end_date = $this->request->get['filter_end_date'];
		} else {
			$filter_end_date = date('Y-m-t');
		}
		
		$url = '';

		if (isset($this->request->get['filter_start_date'])) {
			$url .= '&filter_start_date=' . urlencode(html_entity_decode($this->request->get['filter_start_date'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_end_date'])) {
			$url .= '&filter_end_date=' . urlencode(html_entity_decode($this->request->get['filter_end_date'], ENT_QUOTES, 'UTF-8'));
		}
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => 'Student Report',
			'href' => $this->url->link('module/teamleaderreport', 'token=' . $this->session->data['token'] . $url, true)
		);
		
		$user_ids = $this->model_user_user->getMyTrainersForTeamLeader($this->user->getId(), false);
		
		$filter_data = array(
			'filter_start_date'	  => $filter_start_date,
			'filter_end_date'	  => $filter_end_date
		);
		if($user_ids != ''){
			$filter_data['filter_user_id']= $user_ids;
		}

		$data['total'] = $this->model_module_report->getTotalStudentsActivated($filter_data);
		$data['token'] = $this->session->data['token'];

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
		$data['filter_start_date'] = $filter_start_date;
		$data['filter_end_date'] = $filter_end_date;
		
		$data['user_id'] = $this->user->getId();
		$data['user_group_id'] = $this->user->getGroupId();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/teamleader_report.tpl', $data));
	}
}