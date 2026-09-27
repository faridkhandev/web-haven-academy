<?php
class ControllerModuleTseatbooking extends Controller {
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
		
		if (isset($this->request->post['filter_whatsapp'])) {
			$filter_whatsapp = $this->request->post['filter_whatsapp'];
		} else {
			$filter_whatsapp = null;
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
		
		if (isset($this->request->post['filter_refer_no'])) {
			$filter_refer_no = $this->request->post['filter_refer_no'];
		} else {
			$filter_refer_no = null;
		}
		
		if (isset($this->request->post['filter_user_no'])) {
			$filter_user_no = $this->request->post['filter_user_no'];
		} else {
			$filter_user_no = null;
		}
		
		if (isset($this->request->post['filter_team_leader_no'])) {
			$filter_team_leader_no = $this->request->post['filter_team_leader_no'];
		} else {
			$filter_team_leader_no = null;
		}
		
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
		
		$filter_data['filter_link_user_id']=$this->user->getId();
		
		$user_info = $this->model_user_user->getUser($this->user->getId());
		$results = $this->model_student_student->getSeatItemsForTrainer($filter_data);
		foreach($results['result'] as $key => $result) {
			$items[] = array(
				'id' => $result['id'],
				'student_no' => $result['student_no'],
				'student_name'   => $result['student_name'],
				'student_phone'   => '<a target="_blank" data-toggle="tooltip" title="'.$result['student_phone'].'">Phone No</a>',
				'student_whatsapp'   => '<a target="_blank" href="https://api.whatsapp.com/send?phone='.ltrim($result['student_whatsapp'], '+').'">Go to whatsapp</a>',
				'student_telegram'   => '<a target="_blank" href="https://telegram.me/'.trim($result['student_telegram']).'">'.$result['student_telegram'].'</a>',
				'student_gender'   => $result['student_gender'],
				'student_city'   => $result['student_city'],
				'student_country'   => $result['student_country'],
				'student_language'   => $result['student_language'],
				'student_email'   => $result['student_email'],
				'student_point'   => $result['student_point'],
				'message_status'   => $result['message_status'],
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
			'text' => 'Seat Booking',
			'href' => $this->url->link('module/tseatbooking', 'token=' . $this->session->data['token'] . $url, 'SSL')
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
			$data['filter_start_date'] = '';
		}
		
		if (isset($this->request->post['filter_end_date'])) {
			$data['filter_end_date'] = $this->request->post['filter_end_date'];
		} else {
			$data['filter_end_date'] = '';
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

		$this->response->setOutput($this->load->view('module/trainer_seatbooking_list.tpl', $data));
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
				$json['success'] = 'Whatsapp done added for this student.';
			}
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}