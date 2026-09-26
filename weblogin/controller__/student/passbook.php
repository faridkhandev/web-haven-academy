<?php
class ControllerStudentPassbook extends Controller {
	private $error = array();
	
	public function __construct($params) {
		parent::__construct($params);
		$this->load->model('student/student');
		$this->load->model('student/passbook');
		$this->load->model('user/user');
		$this->load->language('student/passbook');
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
		if (isset($this->request->post['filter_student_no'])) {
			$filter_student_no = $this->request->post['filter_student_no'];
		} else {
			$filter_student_no = null;
		}
		
		if (isset($this->request->post['filter_reason'])) {
			$filter_reason = $this->request->post['filter_reason'];
		} else {
			$filter_reason = null;
		}
		
		if (isset($this->request->post['filter_search'])) {
			$filter_search = $this->request->post['filter_search'];
		} else {
			$filter_search = null;
		}
		
		if (isset($this->request->post['filter_type'])) {
			$filter_type = $this->request->post['filter_type'];
		} else {
			$filter_type = null;
		}
		
		if (isset($this->request->post['filter_date_added'])) {
			$filter_date_added = $this->request->post['filter_date_added'];
		} else {
			$filter_date_added = null;
		}
		
		if (isset($this->request->post['filter_date_ended'])) {
			$filter_date_ended = $this->request->post['filter_date_ended'];
		} else {
			$filter_date_ended = null;
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
			'filter_search'              => $filter_search,
			'filter_student_id'              => $this->request->get['id'],
			'filter_student_no'              => $filter_student_no,
			'filter_reason'              => $filter_reason,
			'filter_type'              => $filter_type,
			'filter_date_added'              => $filter_date_added,
			'filter_date_ended'              => $filter_date_ended,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];
		
		$items = array();
		$results = $this->model_student_passbook->getItems($filter_data);
		
		foreach($results['result'] as $key => $result) {
			$items[] = array(
				'id' => $result['id'],
				'reason' => $result['reason'],
				'description'   => $result['description'],
				'credit_point'   => $result['credit_point'],
				'debit_point'   => $result['debit_point'],
				'balance_point'   => $result['balance_point'],
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
			'text' => 'Student Passbook',
			'href' => $this->url->link('student/passbook', 'token=' . $this->session->data['token'], 'SSL')
			
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
		
		if (isset($this->request->get['student_no'])) {
			$data['student_no'] = $this->request->get['student_no'];
		} else {
			$data['student_no'] = '';
		}
		$data['user_id'] = $this->user->getId();
		$data['user_group_id'] = $this->user->getGroupId();
		
		$data['page_length'] = $this->config->get('config_limit_admin');
		
		$user_info = $this->model_student_student->get($this->request->get['id']);
		
		$data['cancel'] = $this->url->link('student/student', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['text_form'] = !isset($this->request->get['id']) ? 'Passbook' : 'View Passbook '.'(<div class="miltiInfo"><span>Id:'.$this->request->get['id'].'</span>||<span>No:'.$user_info['student_no'].'</span>||<span>Name:'.$user_info['student_name'].'</span>||<span>Total Point:'.$user_info['student_point'].'</span>||<span>Refer By:'.$user_info['refer_student_name'].'-'.$user_info['refer_student_no'].'</span></div>)';
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('student/passbook_list.tpl', $data));
	}
}