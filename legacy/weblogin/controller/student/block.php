<?php
class ControllerStudentBlock extends Controller {
	private $error = array();
	
	public function __construct($params) {
		parent::__construct($params);
		$this->load->model('student/student');
		$this->load->model('student/passbook');
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
		if (isset($this->request->post['filter_name'])) {
			$filter_name = $this->request->post['filter_name'];
		} else {
			$filter_name = null;
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
		
		if (isset($this->request->post['filter_user_no'])) {
			$filter_user_no = $this->request->post['filter_user_no'];
		} else {
			$filter_user_no = null;
		}
		
		if (isset($this->request->post['filter_counsellor_no'])) {
			$filter_counsellor_no = $this->request->post['filter_counsellor_no'];
		} else {
			$filter_counsellor_no = null;
		}
		
		if (isset($this->request->post['filter_refer_no'])) {
			$filter_refer_no = $this->request->post['filter_refer_no'];
		} else {
			$filter_refer_no = null;
		}
		
		if (isset($this->request->post['filter_link_user_id'])) {
			$filter_link_user_id = $this->request->post['filter_link_user_id'];
		} else {
			$filter_link_user_id = null;
		}
		
		if (isset($this->request->post['filter_refer_id'])) {
			$filter_refer_id = $this->request->post['filter_refer_id'];
		} else {
			$filter_refer_id = null;
		}

		if (isset($this->request->post['filter_status'])) {
			$filter_status = $this->request->post['filter_status'];
		} else {
			$filter_status = null;
		}
		
		if (isset($this->request->post['filter_activated_start_date'])) {
			$filter_activated_start_date = $this->request->post['filter_activated_start_date'];
		} else {
			$filter_activated_start_date = null;
		}
		
		if (isset($this->request->post['filter_activated_end_date'])) {
			$filter_activated_end_date = $this->request->post['filter_activated_end_date'];
		} else {
			$filter_activated_end_date = null;
		}
		
		if (isset($this->request->post['filter_date_added'])) {
			$filter_created_start_date = $this->request->post['filter_date_added'];
		} else {
			$filter_created_start_date = null;
		}
		
		if (isset($this->request->post['filter_date_ended'])) {
			$filter_created_end_date = $this->request->post['filter_date_ended'];
		} else {
			$filter_created_end_date = null;
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
			'filter_name'              => $filter_name,
			'filter_phone'              => $filter_phone,
			'filter_email'              => $filter_email,
			'filter_gender'              => $filter_gender,
			'filter_student_no'              => $filter_student_no,
			'filter_user_no'              => $filter_user_no,
			'filter_counsellor_no'              => $filter_counsellor_no,
			'filter_refer_no'              => $filter_refer_no,
			'filter_refer_id'             => $filter_refer_id,
			'filter_link_user_id'             => $filter_link_user_id,
			'filter_created_start_date'             => $filter_created_start_date,
			'filter_created_end_date'             => $filter_created_end_date,
			'filter_activated_start_date'             => $filter_activated_start_date,
			'filter_activated_end_date'             => $filter_activated_end_date,
			'filter_status'            => 2,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];

		$items = array();
		$results = $this->model_student_student->getItems($filter_data);
		foreach($results['result'] as $key => $result) {
			$items[] = array(
				'id' => $result['id'],
				'student_no' => $result['student_no'],
				'student_name'   => $result['student_name'],
				'student_phone'   => $result['student_phone'],
				'student_whatsapp'   => $result['student_whatsapp'],
				'student_telegram'   => $result['student_telegram'],
				'student_gender'   => $result['student_gender'],
				'student_city'   => $result['student_city'],
				'student_country'   => $result['student_country'],
				'student_language'   => $result['student_language'],
				'student_email'   => $result['student_email'],
				'student_point'   => $result['student_point'],
				'student_refer_name'   => $result['refer_student_name'].'-'.$result['refer_student_no'],
				'trainer_name'   => $result['firstname'].' '.$result['lastname'].'-'.$result['user_no'],
				'counsellor_name'   => $result['cfirstname'].' '.$result['clastname'].'-'.$result['cuser_no'],
				'activated_at'			=>	date($this->config->get('config_date_format'), strtotime($result['activated_at'])),
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
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('student/student', 'token=' . $this->session->data['token'] . $url, 'SSL')
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
		
		$data['page_length'] = $this->config->get('config_limit_admin');
		$data['edit'] = $this->url->link('student/student/edit', '&token=' . $this->session->data['token'], TRUE);
		$data['refer'] = $this->url->link('student/refer', '&token=' . $this->session->data['token'], TRUE);
		$data['payment'] = $this->url->link('student/payment', '&token=' . $this->session->data['token'], TRUE);
		$data['withdrawal'] = $this->url->link('student/withdrawal', '&token=' . $this->session->data['token'], TRUE);
		$data['passbook'] = $this->url->link('student/passbook', '&token=' . $this->session->data['token'], TRUE);
		
		$trainers = $this->model_user_user->getSubItems(array('filter_group_id'=>11));
		$data['trainers']=$trainers['result'];
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('student/student_block_list.tpl', $data));
	}
}