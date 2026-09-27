<?php
class ControllerStudentProject extends Controller {
	private $error = array();
	
	public function __construct($params) {
		parent::__construct($params);
		$this->load->model('student/project');
		$this->load->language('student/project');
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
		
		if (isset($this->request->post['filter_student_no'])) {
			$filter_student_no = $this->request->post['filter_student_no'];
		} else {
			$filter_student_no = null;
		}

		if (isset($this->request->post['filter_status'])) {
			$filter_status = $this->request->post['filter_status'];
		} else {
			$filter_status = null;
		}
		
		if (isset($this->request->post['filter_verified_by'])) {
			$filter_verified_by = $this->request->post['filter_verified_by'];
		} else {
			$filter_verified_by = null;
		}
		
		if (isset($this->request->post['filter_verified_start_date'])) {
			$filter_verified_start_date = $this->request->post['filter_verified_start_date'];
		} else {
			$filter_verified_start_date = null;
		}
		
		if (isset($this->request->post['filter_verified_end_date'])) {
			$filter_verified_end_date = $this->request->post['filter_verified_end_date'];
		} else {
			$filter_verified_end_date = null;
		}
		
		if (isset($this->request->post['filter_project_type'])) {
			$filter_project_type = $this->request->post['filter_project_type'];
		} else {
			$filter_project_type = null;
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
			'filter_status'              => $filter_status,
			'filter_name'              => $filter_name,
			'filter_phone'              => $filter_phone,
			'filter_email'              => $filter_email,
			'filter_verified_by'              => $filter_verified_by,
			'filter_student_no'              => $filter_student_no,
			'filter_verified_start_date'              => $filter_verified_start_date,
			'filter_verified_end_date'              => $filter_verified_end_date,
			'filter_project_type'             => $filter_project_type,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];

		$items = array();
		$results = $this->model_student_project->getItems($filter_data);
		foreach($results['result'] as $key => $result) {
			if($result['verified_at'] == '0000-00-00 00:00:00'){
				$verified_at = 'N/A';
			}else{
				$verified_at = date($this->config->get('config_date_format'), strtotime($result['verified_at']));
			}
			
			$items[] = array(
				'id' => $result['id'],
				'student_no' => $result['student_no'],
				'student_name'   => $result['student_name'],
				'project_file'   => '<a href="'.$result['work_file'].'" target="_blank" class="btn btn-primary btn-sm">View</a>',
				'status'   => $result['status'],
				'project_type'   => $result['project_type'],
				'point'   => $result['point_given'],
				'given_by'   => $result['firstname'].' '.$result['lastname'].'-'.$result['user_no'],
				'created_at'			=>	date($this->config->get('config_date_format'), strtotime($result['added_date'])),
				'point_added_at'			=> $verified_at,
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
	
	public function delete() {

		$this->document->setTitle($this->language->get('heading_title'));

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $id) {
				$this->model_student_project->delete($id);
			}

			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('student/project', 'token=' . $this->session->data['token'], 'SSL'));
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
		$data['edit'] = $this->url->link('student/student/edit', '&token=' . $this->session->data['token'], TRUE);
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('student/student_project_list.tpl', $data));
	}
}