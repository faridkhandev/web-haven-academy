<?php
class ControllerStudentStudent extends Controller {
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
		$filter_name = isset($this->request->post['filter_name']) ? $this->request->post['filter_name'] : null;
		$filter_search = isset($this->request->post['filter_search']) ? $this->request->post['filter_search'] : null;
		$filter_phone = isset($this->request->post['filter_phone']) ? $this->request->post['filter_phone'] : null;
		$filter_email = isset($this->request->post['filter_email']) ? $this->request->post['filter_email'] : null;
		$filter_gender = isset($this->request->post['filter_gender']) ? $this->request->post['filter_gender'] : null;
		$filter_student_no = isset($this->request->post['filter_student_no']) ? $this->request->post['filter_student_no'] : null;
		$filter_user_no = isset($this->request->post['filter_user_no']) ? $this->request->post['filter_user_no'] : null;
		$filter_counsellor_no = isset($this->request->post['filter_counsellor_no']) ? $this->request->post['filter_counsellor_no'] : null;
		$filter_refer_no = isset($this->request->post['filter_refer_no']) ? $this->request->post['filter_refer_no'] : null;
		$filter_link_user_id = isset($this->request->post['filter_link_user_id']) ? $this->request->post['filter_link_user_id'] : null;
		$filter_refer_id = isset($this->request->post['filter_refer_id']) ? $this->request->post['filter_refer_id'] : null;
		$filter_status = isset($this->request->post['filter_status']) ? $this->request->post['filter_status'] : 1;
		$filter_activated_start_date = isset($this->request->post['filter_activated_start_date']) ? $this->request->post['filter_activated_start_date'] : null;
		$filter_activated_end_date = isset($this->request->post['filter_activated_end_date']) ? $this->request->post['filter_activated_end_date'] : null;
		$filter_created_start_date = isset($this->request->post['filter_date_added']) ? $this->request->post['filter_date_added'] : null;
		$filter_created_end_date = isset($this->request->post['filter_date_ended']) ? $this->request->post['filter_date_ended'] : null;
		$order = isset($this->request->post['order']) ? $this->request->post['order'] : null;
		$start = isset($this->request->post['start']) ? (int)$this->request->post['start'] : 0;
		$length = isset($this->request->post['length']) ? (int)$this->request->post['length'] : $this->config->get('config_limit_admin');

		$filter_data = [
			'filter_search'              => $filter_search,
			'filter_name'                => $filter_name,
			'filter_phone'               => $filter_phone,
			'filter_email'               => $filter_email,
			'filter_gender'              => $filter_gender,
			'filter_student_no'          => $filter_student_no,
			'filter_user_no'             => $filter_user_no,
			'filter_counsellor_no'       => $filter_counsellor_no,
			'filter_refer_no'            => $filter_refer_no,
			'filter_refer_id'            => $filter_refer_id,
			'filter_link_user_id'        => $filter_link_user_id,
			'filter_created_start_date'  => $filter_created_start_date,
			'filter_created_end_date'    => $filter_created_end_date,
			'filter_activated_start_date'=> $filter_activated_start_date,
			'filter_activated_end_date'  => $filter_activated_end_date,
			'filter_status'              => 1,
			'order'   				     => $order,
			'start'   				     => $start,
			'length'   				     => $length
		];

		$items = array();
		$results = $this->model_student_student->getItems($filter_data);
		if (!empty($results['result'])) {
			foreach($results['result'] as $key => $result) {
				$items[] = array(
					'id'                  => isset($result['id']) ? $result['id'] : '',
					'student_no'          => isset($result['student_no']) ? $result['student_no'] : '',
					'student_name'        => isset($result['student_name']) ? $result['student_name'] : '',
					'student_phone_raw'   => isset($result['student_phone']) ? $result['student_phone'] : '',
					'student_phone'       => !empty($result['student_whatsapp']) ? '<a target="_blank" href="https://api.whatsapp.com/send?phone='.ltrim($result['student_whatsapp'], '+').'">'.$result['student_whatsapp'].'</a>' : '',
					'student_whatsapp'    => isset($result['student_whatsapp']) ? $result['student_whatsapp'] : '',
					'student_telegram'    => isset($result['student_telegram']) ? $result['student_telegram'] : '',
					'student_gender'      => isset($result['student_gender']) ? $result['student_gender'] : '',
					'student_city'        => isset($result['student_city']) ? $result['student_city'] : '',
					'student_country'     => isset($result['student_country']) ? $result['student_country'] : '',
					'student_language'    => isset($result['student_language']) ? $result['student_language'] : '',
					'student_point'       => isset($result['student_point']) ? $result['student_point'] : 0,
					'student_refer_name'  => (isset($result['refer_student_name']) ? $result['refer_student_name'] : '') . '-' . (isset($result['refer_student_no']) ? $result['refer_student_no'] : ''),
					'trainer_name'        => (isset($result['firstname']) ? $result['firstname'] : '') . ' ' . (isset($result['lastname']) ? $result['lastname'] : '') . '-' . (isset($result['user_no']) ? $result['user_no'] : ''),
					'counsellor_name'     => (isset($result['cfirstname']) ? $result['cfirstname'] : '') . ' ' . (isset($result['clastname']) ? $result['clastname'] : '') . '-' . (isset($result['cuser_no']) ? $result['cuser_no'] : ''),
					'activated_at'        => (!empty($result['actual_activation_date']) || !empty($result['activated_at'])) ? date('d/m/Y h:i:s A', strtotime(!empty($result['actual_activation_date']) ? $result['actual_activation_date'] : $result['activated_at'])) : '',
					'whatsapp_join'       => isset($result['whatsapp_join']) ? $result['whatsapp_join'] : 0,
					'telegram_join'       => isset($result['telegram_join']) ? $result['telegram_join'] : 0,
					'joining_point'       => isset($result['joining_point']) ? $result['joining_point'] : 0,
					'admin_approve'       => isset($result['admin_approve']) ? $result['admin_approve'] : 0,
					'is_point_requested'  => isset($result['is_point_requested']) ? $result['is_point_requested'] : 0,
					'is_point_send'       => isset($result['is_point_send']) ? $result['is_point_send'] : 0,
					'action'              => isset($result['id']) ? $result['id'] : ''
				);
			}
		}

		$json = array(
			'draw'				=>	isset($this->request->post['draw']) ? (int)$this->request->post['draw'] : 1,
			'recordsTotal'		=>	isset($results['recordsTotal']) ? (int)$results['recordsTotal'] : 0,
			'recordsFiltered'	=>	isset($results['recordsFiltered']) ? (int)$results['recordsFiltered'] : 0,
			'data'				=>	$items,
		);

		return $json;
	}

	public function add() {
		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$data = $this->request->post;
			$data['link_user_id'] = 0;
			$this->model_student_student->addSubUser($data);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			if (isset($this->request->get['sort'])) $url .= '&sort=' . $this->request->get['sort'];
			if (isset($this->request->get['order'])) $url .= '&order=' . $this->request->get['order'];
			if (isset($this->request->get['page'])) $url .= '&page=' . $this->request->get['page'];

			$this->response->redirect($this->url->link('student/student', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$data = array(
				'student_name'    => $this->request->post['student_name'], 
				'student_phone'   => $this->request->post['student_phone'], 
				'student_whatsapp'=> $this->request->post['student_whatsapp'],  
				'student_gender'  => $this->request->post['student_gender'], 
				'student_language'=> $this->request->post['student_language'], 
				'student_country' => $this->request->post['student_country'], 
				'student_status'  => $this->request->post['student_status'], 
				'refer_id'        => $this->request->post['refer_id']
			);
			
			$this->model_student_student->edit($this->request->get['id'], $data);
			$this->model_student_student->saveStudentTrainer($this->request->get['id'], array('link_user_id'=>$this->request->post['link_user_id']));
			
			if (!empty($this->request->post['password'])) {
				$this->model_student_student->updatePassword($this->request->get['id'], $this->request->post['password']);
			}
			
			if (isset($this->request->post['payment_medium'])) {
				$this->model_student_student->updatePaymentMedium($this->request->get['id'], $this->request->post['payment_medium']);
			}
			
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			if (isset($this->request->get['sort'])) $url .= '&sort=' . $this->request->get['sort'];
			if (isset($this->request->get['order'])) $url .= '&order=' . $this->request->get['order'];
			if (isset($this->request->get['page'])) $url .= '&page=' . $this->request->get['page'];

			$this->response->redirect($this->url->link('student/student', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}
	
	public function inactiveedit() {
		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$data = array(
				'student_name'    => $this->request->post['student_name'], 
				'student_phone'   => $this->request->post['student_phone'], 
				'student_whatsapp'=> $this->request->post['student_whatsapp'], 
				'student_gender'  => $this->request->post['student_gender'], 
				'student_city'    => $this->request->post['student_city'], 
				'student_language'=> $this->request->post['student_language'], 
				'student_country' => $this->request->post['student_country'], 
				'refer_id'        => $this->request->post['refer_id']
			);
			
			$this->model_student_student->edit($this->request->get['id'], $data);
			
			if (!empty($this->request->post['password'])) {
				$this->model_student_student->updatePassword($this->request->get['id'], $this->request->post['password']);
			}
			
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			if (isset($this->request->get['sort'])) $url .= '&sort=' . $this->request->get['sort'];
			if (isset($this->request->get['order'])) $url .= '&order=' . $this->request->get['order'];
			if (isset($this->request->get['page'])) $url .= '&page=' . $this->request->get['page'];

			$this->response->redirect($this->url->link('student/student/inactive', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->document->setTitle($this->language->get('heading_title'));

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $id) {
				$this->model_student_student->delete($id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			if (isset($this->request->get['sort'])) $url .= '&sort=' . $this->request->get['sort'];
			if (isset($this->request->get['order'])) $url .= '&order=' . $this->request->get['order'];
			if (isset($this->request->get['page'])) $url .= '&page=' . $this->request->get['page'];

			$this->response->redirect($this->url->link('student/student', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
			'href' => $this->url->link('student/student', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['add'] = $this->url->link('student/student/add', 'token=' . $this->session->data['token'], 'SSL');
		$data['delete'] = $this->url->link('student/student/delete', 'token=' . $this->session->data['token'], 'SSL');

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

		$data['error_warning'] = isset($this->error['warning']) ? $this->error['warning'] : '';

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['selected'] = isset($this->request->post['selected']) ? (array)$this->request->post['selected'] : array();
		
		$data['page_length'] = $this->config->get('config_limit_admin');
		$data['edit'] = $this->url->link('student/student/edit', '&token=' . $this->session->data['token'], TRUE);
		$data['refer'] = $this->url->link('student/refer', '&token=' . $this->session->data['token'], TRUE);
		$data['payment'] = $this->url->link('student/payment', '&token=' . $this->session->data['token'], TRUE);
		$data['withdrawal'] = $this->url->link('student/withdrawal', '&token=' . $this->session->data['token'], TRUE);
		$data['passbook'] = $this->url->link('student/passbook', '&token=' . $this->session->data['token'], TRUE);
		
		$trainers = $this->model_user_user->getSubItems(array('filter_group_id'=>11));
		$data['trainers'] = isset($trainers['result']) ? $trainers['result'] : array();
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('student/student_list.tpl', $data));
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

		$data['error_warning'] = isset($this->error['warning']) ? $this->error['warning'] : '';
		$data['error_student_name'] = isset($this->error['student_name']) ? $this->error['student_name'] : '';
		$data['error_student_phone'] = isset($this->error['student_phone']) ? $this->error['student_phone'] : '';
		$data['error_student_whatsapp'] = isset($this->error['student_whatsapp']) ? $this->error['student_whatsapp'] : '';
		$data['error_password'] = isset($this->error['password']) ? $this->error['password'] : '';
		$data['error_confirm'] = isset($this->error['confirm']) ? $this->error['confirm'] : '';
		
		$url = '';
		if (isset($this->request->get['sort'])) $url .= '&sort=' . $this->request->get['sort'];
		if (isset($this->request->get['order'])) $url .= '&order=' . $this->request->get['order'];
		if (isset($this->request->get['page'])) $url .= '&page=' . $this->request->get['page'];

		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('student/student', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);
		
		$user_info = array();
		if (isset($this->request->get['id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$user_info = $this->model_student_student->get($this->request->get['id']);
		}

		if (!isset($this->request->get['id'])) {
			$data['action'] = $this->url->link('student/student/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			if(isset($user_info['student_status']) && $user_info['student_status'] == 1){
				$data['action'] = $this->url->link('student/student/edit', 'token=' . $this->session->data['token'] . '&id=' . $this->request->get['id'] . $url, 'SSL');
			}else{
				$data['action'] = $this->url->link('student/student/inactiveedit', 'token=' . $this->session->data['token'] . '&id=' . $this->request->get['id'] . $url, 'SSL');
			}
		}

		$data['cancel'] = $this->url->link('student/student', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['student_name'] = isset($this->request->post['student_name']) ? $this->request->post['student_name'] : (!empty($user_info['student_name']) ? $user_info['student_name'] : '');
		$data['student_phone'] = isset($this->request->post['student_phone']) ? $this->request->post['student_phone'] : (!empty($user_info['student_phone']) ? $user_info['student_phone'] : '');
		$data['student_whatsapp'] = isset($this->request->post['student_whatsapp']) ? $this->request->post['student_whatsapp'] : (!empty($user_info['student_whatsapp']) ? $user_info['student_whatsapp'] : '');
		$data['refer_id'] = isset($this->request->post['refer_id']) ? $this->request->post['refer_id'] : (!empty($user_info['refer_id']) ? $user_info['refer_id'] : '');
		$data['student_telegram'] = isset($this->request->post['student_telegram']) ? $this->request->post['student_telegram'] : (!empty($user_info['student_telegram']) ? $user_info['student_telegram'] : '');
		$data['student_gender'] = isset($this->request->post['student_gender']) ? $this->request->post['student_gender'] : (!empty($user_info['student_gender']) ? $user_info['student_gender'] : '');
		$data['student_city'] = isset($this->request->post['student_city']) ? $this->request->post['student_city'] : (!empty($user_info['student_city']) ? $user_info['student_city'] : '');
		$data['student_country'] = isset($this->request->post['student_country']) ? $this->request->post['student_country'] : (!empty($user_info['student_country']) ? $user_info['student_country'] : '');
		$data['student_language'] = isset($this->request->post['student_language']) ? $this->request->post['student_language'] : (!empty($user_info['student_language']) ? $user_info['student_language'] : '');
		$data['link_user_id'] = isset($this->request->post['link_user_id']) ? $this->request->post['link_user_id'] : (!empty($user_info['link_user_id']) ? $user_info['link_user_id'] : '');
		$data['student_status'] = isset($this->request->post['student_status']) ? $this->request->post['student_status'] : (!empty($user_info['student_status']) ? $user_info['student_status'] : 1);
		$data['student_fb_link'] = isset($this->request->post['student_fb_link']) ? $this->request->post['student_fb_link'] : (!empty($user_info['student_fb_link']) ? $user_info['student_fb_link'] : '');

		if (!empty($user_info) && isset($this->request->get['id'])) {
			$data['payment_medium'] = $this->model_student_student->getStudentPaymentMedium($this->request->get['id']);
		} else {
			$data['payment_medium'] = array();
		}
		
		$data['password'] = isset($this->request->post['password']) ? $this->request->post['password'] : '';
		$data['confirm'] = isset($this->request->post['confirm']) ? $this->request->post['confirm'] : '';
		
		$trainers = $this->model_user_user->getSubItems(array('filter_group_id'=>11));
		$data['trainers'] = isset($trainers['result']) ? $trainers['result'] : array();
		
		$data['text_form'] = !isset($this->request->get['id']) ? $this->language->get('text_add') : '<h4>Edit Student '.'(<div class="miltiInfo"><span>No:'.(isset($user_info['student_no'])?$user_info['student_no']:'').'</span>||<span>Total Point:'.(isset($user_info['student_point'])?$user_info['student_point']:'').'</span>||<span>Last Login:'.(isset($user_info['last_login'])?$user_info['last_login']:'').'</span>||<span>Refer By:'.(isset($user_info['refer_student_name'])?$user_info['refer_student_name']:'').'-'.(isset($user_info['refer_student_no'])?$user_info['refer_student_no']:'').'</span>||<span>Counsellor :'.(isset($user_info['counsellor_name'])?$user_info['counsellor_name']:'').'</span></div>)</h4>';
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('student/student_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'student/student')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['student_whatsapp']) < 3) || (utf8_strlen($this->request->post['student_whatsapp']) > 20)) {
			$this->error['student_whatsapp'] = 'Invalid Whatsapp.';
		}

		$user_info = $this->model_student_student->getStudentByPhone($this->request->post['student_phone']);

		if (!isset($this->request->get['id'])) {
			if ($user_info) {
				$this->error['warning'] = 'This Phone no already exist, try different.';
			}
		} else {
			if ($user_info && ($this->request->get['id'] != $user_info['id'])) {
				$this->error['warning'] = 'This Phone no already exist, try different.';
			}
		}

		if ((utf8_strlen(trim($this->request->post['student_name'])) < 1) || (utf8_strlen(trim($this->request->post['student_name'])) > 32)) {
			$this->error['student_name'] = 'Invalid Name';
		}
		
		if ($this->request->post['password'] || (!isset($this->request->get['id']))) {
			if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
				$this->error['password'] = 'Password Length 4 to 20 characters.';
			}

			if ($this->request->post['password'] != $this->request->post['confirm']) {
				$this->error['confirm'] = 'Password and Confirm Password not match';
			}
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'student/student')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['selected'] as $id) {
			if ($this->user->getId() == $id) {
				$this->error['warning'] = $this->language->get('error_account');
			}
		}

		return !$this->error;
	}
	
	public function inactive() {
		$this->document->setTitle($this->language->get('heading_title'));
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && (strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($this->getInactiveItems()));
		} else {
			$this->getInactiveList();
		}
	}

	private function getInactiveItems() {
		$filter_search = isset($this->request->post['filter_search']) ? $this->request->post['filter_search'] : null;
		$filter_name = isset($this->request->post['filter_name']) ? $this->request->post['filter_name'] : null;
		$filter_phone = isset($this->request->post['filter_phone']) ? $this->request->post['filter_phone'] : null;
		$filter_email = isset($this->request->post['filter_email']) ? $this->request->post['filter_email'] : null;
		$filter_gender = isset($this->request->post['filter_gender']) ? $this->request->post['filter_gender'] : null;
		$filter_student_no = isset($this->request->post['filter_student_no']) ? $this->request->post['filter_student_no'] : null;
		$filter_user_no = isset($this->request->post['filter_user_no']) ? $this->request->post['filter_user_no'] : null;
		$filter_refer_no = isset($this->request->post['filter_refer_no']) ? $this->request->post['filter_refer_no'] : null;
		$filter_language = isset($this->request->post['filter_language']) ? $this->request->post['filter_language'] : null;
		$filter_created_start_date = isset($this->request->post['filter_date_added']) ? $this->request->post['filter_date_added'] : null;
		$filter_created_end_date = isset($this->request->post['filter_date_ended']) ? $this->request->post['filter_date_ended'] : null;
		$order = isset($this->request->post['order']) ? $this->request->post['order'] : null;
		$start = isset($this->request->post['start']) ? (int)$this->request->post['start'] : 0;
		$length = isset($this->request->post['length']) ? (int)$this->request->post['length'] : $this->config->get('config_limit_admin');

		$filter_data = [
			'filter_search'              => $filter_search,
			'filter_name'                => $filter_name,
			'filter_phone'               => $filter_phone,
			'filter_email'               => $filter_email,
			'filter_gender'              => $filter_gender,
			'filter_student_no'          => $filter_student_no,
			'filter_user_no'             => $filter_user_no,
			'filter_refer_no'            => $filter_refer_no,
			'filter_created_start_date'  => $filter_created_start_date,
			'filter_created_end_date'    => $filter_created_end_date,
			'filter_language'            => $filter_language,
			'filter_status'              => 0,
			'order'   				     => $order,
			'start'   				     => $start,
			'length'   				     => $length
		];

		$items = array();
		$results = $this->model_student_student->getInactiveItems($filter_data);

		if (!empty($results['result'])) {
			foreach($results['result'] as $key => $result) {
				$whatsapp_link = !empty($result['student_whatsapp']) ? '<a target="_blank" href="https://api.whatsapp.com/send?phone=' . ltrim($result['student_whatsapp'], '+') . '">' . $result['student_whatsapp'] . '</a>' : '';
				$telegram_link = !empty($result['student_telegram']) ? '<a href="javascript:void(0);" onclick="copyImo(\'' . addslashes($result['student_telegram']) . '\')">' . $result['student_telegram'] . '</a>' : '';
				$counsellor_name = trim((isset($result['firstname']) ? $result['firstname'] : '') . ' ' . (isset($result['lastname']) ? $result['lastname'] : ''));

				$items[] = array(
					'id'               => isset($result['id']) ? $result['id'] : '',
					'student_no'       => isset($result['student_no']) ? $result['student_no'] : '',
					'student_name'     => isset($result['student_name']) ? $result['student_name'] : '',
					'student_phone'    => isset($result['student_phone']) ? $result['student_phone'] : '',
					'student_whatsapp' => $whatsapp_link,
					'student_telegram' => $telegram_link,
					'student_language' => isset($result['student_language']) ? $result['student_language'] : '',
					'created_at'	   => !empty($result['created_at']) ? date($this->config->get('config_date_format'), strtotime($result['created_at'])) : '',
					'student_point'    => isset($result['student_point']) ? $result['student_point'] : 0,
					'joining_point'    => isset($result['joining_point']) ? $result['joining_point'] : 0,
					'counsellor'       => $counsellor_name,
					'admin_approve'    => isset($result['admin_approve']) ? $result['admin_approve'] : 0,
					'action'		   => isset($result['id']) ? $result['id'] : ''
				);
			}
		}

		$json = array(
			'draw'				=>	isset($this->request->post['draw']) ? (int)$this->request->post['draw'] : 1,
			'recordsTotal'		=>	isset($results['recordsTotal']) ? (int)$results['recordsTotal'] : 0,
			'recordsFiltered'	=>	isset($results['recordsFiltered']) ? (int)$results['recordsFiltered'] : 0,
			'data'				=>	$items,
		);

		return $json;
	}

	protected function getInactiveList() {
		$url = '';
		if (isset($this->request->get['sort'])) $url .= '&sort=' . $this->request->get['sort'];
		if (isset($this->request->get['order'])) $url .= '&order=' . $this->request->get['order'];
		if (isset($this->request->get['page'])) $url .= '&page=' . $this->request->get['page'];

		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('student/student/inactive', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['delete'] = $this->url->link('student/student/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

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

		$data['error_warning'] = isset($this->error['warning']) ? $this->error['warning'] : '';

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['selected'] = isset($this->request->post['selected']) ? (array)$this->request->post['selected'] : array();
		
		$data['page_length'] = $this->config->get('config_limit_admin');
		$data['edit'] = $this->url->link('student/student/edit', '&token=' . $this->session->data['token'], TRUE);
		
		$results = $this->model_user_user->getSubItems(array('filter_group_id'=>15,'filter_status'=>1));
		$data['counsellors'] = isset($results['result']) ? $results['result'] : array();
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('student/student_inactive_list.tpl', $data));
	}
	
	public function whatsapp() {
		$this->document->setTitle($this->language->get('heading_title'));
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && (strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($this->getWhatsappItems()));
		} else {
			$this->getWhatsappList();
		}
	}
	
	private function getWhatsappItems() {
		$filter_name = isset($this->request->post['filter_name']) ? $this->request->post['filter_name'] : null;
		$filter_search = isset($this->request->post['filter_search']) ? $this->request->post['filter_search'] : null;
		$filter_phone = isset($this->request->post['filter_phone']) ? $this->request->post['filter_phone'] : null;
		$filter_gender = isset($this->request->post['filter_gender']) ? $this->request->post['filter_gender'] : null;
		$filter_student_no = isset($this->request->post['filter_student_no']) ? $this->request->post['filter_student_no'] : null;
		$filter_refer_no = isset($this->request->post['filter_refer_no']) ? $this->request->post['filter_refer_no'] : null;
		$order = isset($this->request->post['order']) ? $this->request->post['order'] : null;
		$start = isset($this->request->post['start']) ? (int)$this->request->post['start'] : 0;
		$length = isset($this->request->post['length']) ? (int)$this->request->post['length'] : $this->config->get('config_limit_admin');

		$filter_data = [
			'filter_search'     => $filter_search,
			'filter_name'       => $filter_name,
			'filter_phone'      => $filter_phone,
			'filter_gender'     => $filter_gender,
			'filter_student_no' => $filter_student_no,
			'filter_refer_no'   => $filter_refer_no,
			'filter_status'     => 1,
			'order'   		    => $order,
			'start'   		    => $start,
			'length'   		    => $length
		];

		$items = array();
		$results = $this->model_student_student->getWhatsappItems($filter_data);
		if (!empty($results['result'])) {
			foreach($results['result'] as $key => $result) {
				$items[] = array(
					'id'                 => isset($result['id']) ? $result['id'] : '',
					'student_no'         => isset($result['student_no']) ? $result['student_no'] : '',
					'student_name'       => isset($result['student_name']) ? $result['student_name'] : '',
					'student_phone'      => isset($result['student_phone']) ? $result['student_phone'] : '',
					'student_refer_name' => (isset($result['refer_student_name']) ? $result['refer_student_name'] : '') . '-' . (isset($result['refer_student_no']) ? $result['refer_student_no'] : ''),
					'created_at'		 => !empty($result['created_at']) ? date($this->config->get('config_date_format'), strtotime($result['created_at'])) : '',
					'action'			 => 'Wrong Whatsapp'
				);
			}
		}

		$json = array(
			'draw'				=>	isset($this->request->post['draw']) ? (int)$this->request->post['draw'] : 1,
			'recordsTotal'		=>	isset($results['recordsTotal']) ? (int)$results['recordsTotal'] : 0,
			'recordsFiltered'	=>	isset($results['recordsFiltered']) ? (int)$results['recordsFiltered'] : 0,
			'data'				=>	$items,
		);

		return $json;
	}
	
	protected function getWhatsappList() {
		$url = '';
		if (isset($this->request->get['sort'])) $url .= '&sort=' . $this->request->get['sort'];
		if (isset($this->request->get['order'])) $url .= '&order=' . $this->request->get['order'];
		if (isset($this->request->get['page'])) $url .= '&page=' . $this->request->get['page'];

		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => 'Whatsapp List',
			'href' => $this->url->link('student/student/whatsapp', 'token=' . $this->session->data['token'] . $url, 'SSL')
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

		$data['error_warning'] = isset($this->error['warning']) ? $this->error['warning'] : '';

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['selected'] = isset($this->request->post['selected']) ? (array)$this->request->post['selected'] : array();
		
		$data['page_length'] = $this->config->get('config_limit_admin');
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('student/student_whatsapp_list.tpl', $data));
	}
	
	public function assignstudent(){
		$json = array();
		$counsellor_id = isset($this->request->post['counsellor_id']) ? (int)$this->request->post['counsellor_id'] : 0;
		$filter = isset($this->request->post['filter']) ? $this->request->post['filter'] : '';
		
		if($counsellor_id != 0 && $filter != ''){
			$this->model_student_student->addToCounsellor($counsellor_id, $filter);
			$json = array('success' => 'Student added successfully to counsellor.');
		}else{
			$json = array('error' => 'Please check the form carefully.');
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function activestudent(){
		$json = array();
		$filter = isset($this->request->get['filter']) ? $this->request->get['filter'] : '';
		
		if($filter != ''){
			$status = $this->model_student_student->activateStudent($filter);
			if($status){
				$json['success'] = 'Student activated successfully.';
			}else{
				$json['error'] = 'No trainer id added in the system. please add one.';
			}
		}else{
			$json['error'] = 'Some error occur, please check the form carefully.';
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function blockstudent(){
		$json = array();
		if(!empty($this->request->get['student_id'])){
			$status = $this->model_student_student->blockStudent($this->request->get['student_id']);
			if($status){
				$json['success'] = 'Student block successfully.';
			}else{
				$json['error'] = 'Student already blocked.';
			}
		}else{
			$json['error'] = 'Some error occur, please check the form carefully.';
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function sendlinkjoiningstudent(){
		$json = array();
		if(!empty($this->request->get['student_id'])){
			$this->db->query("UPDATE bh_student SET is_point_send = 1 WHERE id='".(int)$this->request->get['student_id']."' AND whatsapp_join = 1 AND telegram_join = 1 AND admin_approve = 1 AND is_point_requested = 1");
			$json['success'] = 'Student joining point send successfully.';
		}else{
			$json['error'] = 'Some error occur, please check the form carefully.';
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function unblockstudent(){
		$json = array();
		if(!empty($this->request->get['student_id'])){
			$status = $this->model_student_student->unblockStudent($this->request->get['student_id']);
			if($status){
				$json['success'] = 'Student unblock successfully.';
			}else{
				$json['error'] = 'Student already blocked.';
			}
		}else{
			$json['error'] = 'Some error occur, please check the form carefully.';
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function addpoint(){
		$json = array();
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && (strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
			if(empty($_POST['student_id'])){
				$json['error'] = 'Not a valid request. Try again';
			}
			
			if(empty($_POST['point'])){
				$json['error'] = 'Please add point';
			}
			
			if(empty($_POST['reason'])){
				$json['error'] = 'Please add valid reason';
			}
			
			if (!isset($json['error'])) {
				$payment_note = isset($_POST['payment_note']) ? $_POST['payment_note'] : '';
				$passbook_id = $this->model_student_student->managePoint(array('student_id'=>$_POST['student_id'], 'reason'=>$_POST['reason'], 'description'=>$payment_note, 'credit_point'=>$_POST['point'], 'debit_point'=>0, 'type'=>'Credit'));
				if($passbook_id){
					$json['success'] = 'Point successfully added into passbook.';
				}else{
					$json['error'] = 'Point did not add into passbook due to system error. Try again';
				}
			}
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function joinpoint(){
		$json = array();
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && (strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
			if(empty($_POST['student_id'])){
				$json['error'] = 'Not a valid request. Try again';
			}
			
			if (!isset($json['error'])) {
				$this->db->query("UPDATE bh_student SET admin_approve = 1 WHERE id = '".(int)$_POST['student_id']."'");
				$json['success'] = 'Join point approvement is done.';
			}
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function deductpoint(){
		$json = array();
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && (strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
			if(empty($_POST['student_id'])){
				$json['error'] = 'Not a valid request. Try again';
			}
			
			if(empty($_POST['point'])){
				$json['error'] = 'Please add point';
			}
			
			if(empty($_POST['reason'])){
				$json['error'] = 'Please add valid reason';
			}
			
			if (!isset($json['error'])) {
				$comment = isset($_POST['comment']) ? $_POST['comment'] : '';
				$passbook_id = $this->model_student_student->managePoint(array('student_id'=>$_POST['student_id'], 'reason'=>$_POST['reason'], 'description'=>$comment, 'credit_point'=>0, 'debit_point'=>$_POST['point'], 'type'=>'Debit'));
				if($passbook_id){
					$json['success'] = 'Point successfully debited from passbook.';
				}else{
					$json['error'] = 'Point did not debited from passbook due to system error. Try again';
				}
			}
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function removepoint(){
		$json = array();
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && (strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
			if(empty($_POST['student_id'])){
				$json['error'] = 'Not a valid request. Try again';
			}
			
			if(empty($_POST['point'])){
				$json['error'] = 'Please add point';
			}
			
			if(empty($_POST['reason'])){
				$json['error'] = 'Please add valid reason';
			}
			
			if (!isset($json['error'])) {
				$passbook = $this->model_student_passbook->getLastRecord($_POST['student_id']);
				if(isset($passbook['balance_point']) && $_POST['point'] > $passbook['balance_point']){
					$json['error'] = 'Student balance point is less than given point.';
				}
				if (!isset($json['error'])) {
					$passbook_id = $this->model_student_student->managePoint(array('student_id'=>$_POST['student_id'], 'reason'=>'Point deduct by admin', 'description'=>$_POST['reason'], 'credit_point'=>0, 'debit_point'=>$_POST['point'], 'type'=>'Debit'));
					if($passbook_id){
						$json['success'] = 'Point successfully debited from passbook.';
					}else{
						$json['error'] = 'Point did not debited from passbook due to system error. Try again';
					}
				}
			}
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function quick_active() {
		$this->document->setTitle('Quick Active Student List');
		$data['heading_title'] = 'Active Students (Quick View)';
		$data['status'] = 'active';
		$data['status_type'] = 'active';
		$data['token'] = $this->session->data['token'];

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$page = isset($this->request->get['page']) ? (int)$this->request->get['page'] : 1;
		$limit = 50;
		$start = ($page - 1) * $limit;

		$total_query = $this->db->query("SELECT COUNT(*) AS total FROM bh_student WHERE student_status = '1'");
		$student_total = $total_query->row['total'];

		$sql = "SELECT s.id, s.student_no, s.student_name, s.student_phone, s.student_whatsapp, s.student_telegram, 
		               s.created_at, s.activated_at, s.student_point, s.joining_point, 
		               TRIM(CONCAT(IFNULL(u.firstname,''), ' ', IFNULL(u.lastname,''))) AS counsellor_name
		        FROM bh_student s
		        LEFT JOIN " . DB_PREFIX . "user u ON (s.link_user_id = u.user_id)
		        WHERE s.student_status = '1' 
		        ORDER BY s.id DESC LIMIT " . (int)$start . "," . (int)$limit;

		$query = $this->db->query($sql);

		$data['students'] = array();
		foreach ($query->rows as $row) {
			$act_date = !empty($row['activated_at']) ? $row['activated_at'] : '';
			$row['activated_at_formatted'] = !empty($act_date) ? date('d/m/Y h:i:s A', strtotime($act_date)) : '';
			
			$row['edit_link']       = $this->url->link('student/student/edit', 'token=' . $this->session->data['token'] . '&id=' . $row['id'], 'SSL');
			$row['passbook_link']   = $this->url->link('student/passbook', 'token=' . $this->session->data['token'] . '&student_id=' . $row['id'], 'SSL');
			$row['refer_link']      = $this->url->link('student/refer', 'token=' . $this->session->data['token'] . '&student_id=' . $row['id'], 'SSL');
			$row['payment_link']    = $this->url->link('student/payment', 'token=' . $this->session->data['token'] . '&student_id=' . $row['id'], 'SSL');
			$row['withdrawal_link'] = $this->url->link('student/withdrawal', 'token=' . $this->session->data['token'] . '&student_id=' . $row['id'], 'SSL');

			$data['students'][] = $row;
		}

		$pagination = new Pagination();
		$pagination->total = $student_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('student/student/quick_active', 'token=' . $this->session->data['token'] . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();
		$data['results'] = sprintf('Showing %d to %d of %d entries', ($student_total) ? $start + 1 : 0, ((($start + $limit) > $student_total) ? $student_total : ($start + $limit)), $student_total);

		$this->response->setOutput($this->load->view('student/quick_student.tpl', $data));
	}

	public function quick_inactive() {
		$this->document->setTitle('Quick Inactive Student List');
		$data['heading_title'] = 'Inactive Students (Quick View)';
		$data['status'] = 'inactive';
		$data['status_type'] = 'inactive';
		$data['token'] = $this->session->data['token'];

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$page = isset($this->request->get['page']) ? (int)$this->request->get['page'] : 1;
		$limit = 50;
		$start = ($page - 1) * $limit;

		$total_query = $this->db->query("SELECT COUNT(*) AS total FROM bh_student WHERE student_status = '0'");
		$student_total = $total_query->row['total'];

		$sql = "SELECT s.id, s.student_no, s.student_name, s.student_phone, s.student_whatsapp, s.student_telegram, 
		               s.created_at, s.activated_at, s.student_point, s.joining_point, 
		               TRIM(CONCAT(IFNULL(u.firstname,''), ' ', IFNULL(u.lastname,''))) AS counsellor_name
		        FROM bh_student s
		        LEFT JOIN " . DB_PREFIX . "user u ON (s.link_user_id = u.user_id)
		        WHERE s.student_status = '0' 
		        ORDER BY s.id DESC LIMIT " . (int)$start . "," . (int)$limit;

		$query = $this->db->query($sql);

		$data['students'] = array();
		foreach ($query->rows as $row) {
			$act_date = !empty($row['activated_at']) ? $row['activated_at'] : '';
			$row['activated_at_formatted'] = !empty($act_date) ? date('d/m/Y h:i:s A', strtotime($act_date)) : '';
			
			$row['edit_link']       = $this->url->link('student/student/inactiveedit', 'token=' . $this->session->data['token'] . '&id=' . $row['id'], 'SSL');
			$row['passbook_link']   = $this->url->link('student/passbook', 'token=' . $this->session->data['token'] . '&student_id=' . $row['id'], 'SSL');
			$row['refer_link']      = $this->url->link('student/refer', 'token=' . $this->session->data['token'] . '&student_id=' . $row['id'], 'SSL');
			$row['payment_link']    = $this->url->link('student/payment', 'token=' . $this->session->data['token'] . '&student_id=' . $row['id'], 'SSL');
			$row['withdrawal_link'] = $this->url->link('student/withdrawal', 'token=' . $this->session->data['token'] . '&student_id=' . $row['id'], 'SSL');

			$data['students'][] = $row;
		}

		$pagination = new Pagination();
		$pagination->total = $student_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('student/student/quick_inactive', 'token=' . $this->session->data['token'] . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();
		$data['results'] = sprintf('Showing %d to %d of %d entries', ($student_total) ? $start + 1 : 0, ((($start + $limit) > $student_total) ? $student_total : ($start + $limit)), $student_total);

		$this->response->setOutput($this->load->view('student/quick_student.tpl', $data));
	}
}
