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
			'filter_refer_no'              => $filter_refer_no,
			'filter_refer_id'             => $filter_refer_id,
			'filter_link_user_id'             => $filter_link_user_id,
			'filter_created_start_date'             => $filter_created_start_date,
			'filter_created_end_date'             => $filter_created_end_date,
			'filter_status'            => 1,
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
				'student_gender'   => $result['student_gender'],
				'student_city'   => $result['student_city'],
				'student_country'   => $result['student_country'],
				'student_language'   => $result['student_language'],
				'student_email'   => $result['student_email'],
				'student_point'   => $result['student_point'],
				'student_refer_name'   => $result['refer_student_name'].'-'.$result['refer_student_no'],
				'trainer_name'   => $result['firstname'].' '.$result['lastname'].'-'.$result['user_no'],
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

	public function add() {
		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$data = $this->request->post;
			$data['link_user_id'] = 0;
			$this->model_student_student->addSubUser($data);

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

			$this->response->redirect($this->url->link('student/student', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$data = array('student_name'=>$this->request->post['student_name'], 'student_phone'=>$this->request->post['student_phone'], 'student_whatsapp'=>$this->request->post['student_whatsapp'], 'student_email'=>$this->request->post['student_email'], 'student_gender'=>$this->request->post['student_gender'], 'student_city'=>$this->request->post['student_city'], 'student_language'=>$this->request->post['student_language'], 'student_country'=>$this->request->post['student_country'], 'student_status'=>$this->request->post['student_status']);
			
			$this->model_student_student->edit($this->request->get['id'], $data);
			
			$this->model_student_student->saveStudentTrainer($this->request->get['id'], array('link_user_id'=>$this->request->post['link_user_id']));
			
			if ($this->request->post['password']) {
				$this->model_student_student->updatePassword($this->request->get['id'], $this->request->post['password']);
			}
			
			if ($this->request->post['payment_medium']) {
				$this->model_student_student->updatePaymentMedium($this->request->get['id'], $this->request->post['payment_medium']);
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

			$this->response->redirect($this->url->link('student/student', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

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
			'href' => $this->url->link('student/student', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('student/student/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
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

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['student_name'])) {
			$data['error_student_name'] = $this->error['student_name'];
		} else {
			$data['error_student_name'] = '';
		}

		if (isset($this->error['student_phone'])) {
			$data['error_student_phone'] = $this->error['student_phone'];
		} else {
			$data['error_student_phone'] = '';
		}

		if (isset($this->error['student_whatsapp'])) {
			$data['error_student_whatsapp'] = $this->error['student_whatsapp'];
		} else {
			$data['error_student_whatsapp'] = '';
		}

		if (isset($this->error['student_email'])) {
			$data['error_student_email'] = $this->error['student_email'];
		} else {
			$data['error_student_email'] = '';
		}
		
		if (isset($this->error['password'])) {
			$data['error_password'] = $this->error['password'];
		} else {
			$data['error_password'] = '';
		}

		if (isset($this->error['confirm'])) {
			$data['error_confirm'] = $this->error['confirm'];
		} else {
			$data['error_confirm'] = '';
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
			'href' => $this->url->link('student/student', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['id'])) {
			$data['action'] = $this->url->link('student/student/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('student/student/edit', 'token=' . $this->session->data['token'] . '&id=' . $this->request->get['id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('student/student', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$user_info = $this->model_student_student->get($this->request->get['id']);
		}

		if (isset($this->request->post['student_name'])) {
			$data['student_name'] = $this->request->post['student_name'];
		} elseif (!empty($user_info)) {
			$data['student_name'] = $user_info['student_name'];
		} else {
			$data['student_name'] = '';
		}

		if (isset($this->request->post['student_phone'])) {
			$data['student_phone'] = $this->request->post['student_phone'];
		} elseif (!empty($user_info)) {
			$data['student_phone'] = $user_info['student_phone'];
		} else {
			$data['student_phone'] = '';
		}

		if (isset($this->request->post['student_whatsapp'])) {
			$data['student_whatsapp'] = $this->request->post['student_whatsapp'];
		} elseif (!empty($user_info)) {
			$data['student_whatsapp'] = $user_info['student_whatsapp'];
		} else {
			$data['student_whatsapp'] = '';
		}

		if (isset($this->request->post['student_gender'])) {
			$data['student_gender'] = $this->request->post['student_gender'];
		} elseif (!empty($user_info)) {
			$data['student_gender'] = $user_info['student_gender'];
		} else {
			$data['student_gender'] = '';
		}

		if (isset($this->request->post['student_city'])) {
			$data['student_city'] = $this->request->post['student_city'];
		} elseif (!empty($user_info)) {
			$data['student_city'] = $user_info['student_city'];
		} else {
			$data['student_city'] = '';
		}
		
		if (isset($this->request->post['student_country'])) {
			$data['student_country'] = $this->request->post['student_country'];
		} elseif (!empty($user_info)) {
			$data['student_country'] = $user_info['student_country'];
		} else {
			$data['student_country'] = '';
		}
		
		if (isset($this->request->post['student_language'])) {
			$data['student_language'] = $this->request->post['student_language'];
		} elseif (!empty($user_info)) {
			$data['student_language'] = $user_info['student_language'];
		} else {
			$data['student_language'] = '';
		}
		
		if (isset($this->request->post['student_email'])) {
			$data['student_email'] = $this->request->post['student_email'];
		} elseif (!empty($user_info)) {
			$data['student_email'] = $user_info['student_email'];
		} else {
			$data['student_email'] = '';
		}
		
		if (isset($this->request->post['link_user_id'])) {
			$data['link_user_id'] = $this->request->post['link_user_id'];
		} elseif (!empty($user_info)) {
			$data['link_user_id'] = $user_info['link_user_id'];
		} else {
			$data['link_user_id'] = '';
		}
		
		if (isset($this->request->post['student_status'])) {
			$data['student_status'] = $this->request->post['student_status'];
		} elseif (!empty($user_info)) {
			$data['student_status'] = $user_info['student_status'];
		} else {
			$data['student_status'] = 1;
		}
		
		if (!empty($user_info)) {
			$data['payment_medium'] = $this->model_student_student->getStudentPaymentMedium($this->request->get['id']);
		} else {
			$data['payment_medium'] = array();
		}
		
		if (isset($this->request->post['password'])) {
			$data['password'] = $this->request->post['password'];
		} else {
			$data['password'] = '';
		}

		if (isset($this->request->post['confirm'])) {
			$data['confirm'] = $this->request->post['confirm'];
		} else {
			$data['confirm'] = '';
		}
		
		$trainers = $this->model_user_user->getSubItems(array('filter_group_id'=>11));
		$data['trainers']=$trainers['result'];
		
		$data['text_form'] = !isset($this->request->get['id']) ? $this->language->get('text_add') : '<h4>Edit Student '.'(<div class="miltiInfo"><span>No:'.$user_info['student_no'].'</span>||<span>Total Point:'.$user_info['student_point'].'</span>||<span>Last Login:'.$user_info['last_login'].'</span>||<span>Refer By:'.$user_info['refer_student_name'].'-'.$user_info['refer_student_no'].'</span></div>)</h4>';
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
		
		$user_info = $this->model_student_student->getStudentByEmail($this->request->post['student_email']);

		if (!isset($this->request->get['id'])) {
			if ($user_info) {
				$this->error['warning'] = 'Email already exist, try different email id.';
			}
		} else {
			if ($user_info && ($this->request->get['id'] != $user_info['id'])) {
				$this->error['warning'] = 'Email already exist, try different email id.';
			}
		}

		if ((utf8_strlen(trim($this->request->post['student_name'])) < 1) || (utf8_strlen(trim($this->request->post['student_name'])) > 32)) {
			$this->error['student_name'] = 'Invalid Name';
		}

		if ((utf8_strlen(trim($this->request->post['student_phone'])) < 1) || (utf8_strlen(trim($this->request->post['student_phone'])) > 32)) {
			$this->error['student_phone'] = 'Invalid Phone';
		}
		
		
		if ((utf8_strlen(trim($this->request->post['student_email'])) < 1) || (utf8_strlen(trim($this->request->post['student_email'])) > 32)) {
			$this->error['student_email'] = 'Invalid Email';
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
		if (isset($this->request->post['filter_search'])) {
			$filter_search = $this->request->post['filter_search'];
		} else {
			$filter_search = null;
		}
		
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
		
		if (isset($this->request->post['filter_refer_no'])) {
			$filter_refer_no = $this->request->post['filter_refer_no'];
		} else {
			$filter_refer_no = null;
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
			'filter_refer_no'              => $filter_refer_no,
			'filter_created_start_date'              => $filter_created_start_date,
			'filter_created_end_date'              => $filter_created_end_date,
			'filter_status'            => 1,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];

		$items = array();
		$results = $this->model_student_student->getInactiveItems($filter_data);
		foreach($results['result'] as $key => $result) {
			$items[] = array(
				'id' => $result['id'],
				'student_no' => $result['student_no'],
				'student_name'   => $result['student_name'],
				'student_phone'   => $result['student_phone'],
				'student_whatsapp'   => $result['student_whatsapp'],
				'student_gender'   => $result['student_gender'],
				'student_city'   => $result['student_city'],
				'student_country'   => $result['student_country'],
				'student_language'   => $result['student_language'],
				'student_email'   => $result['student_email'],
				'student_refer_name'   => $result['refer_student_name'].'-'.$result['refer_student_no'],
				'counsellor_name'   => $result['firstname'].' '.$result['lastname'].'-'.$result['user_no'],
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

	protected function getInactiveList() {
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
		
		$results = $this->model_user_user->getSubItems(array('filter_group_id'=>15,'filter_status'=>1));
		$data['counsellors'] = $results['result'];
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('student/student_inactive_list.tpl', $data));
	}
	
	public function assignstudent(){
		$json = array();
		if (isset($this->request->get['counsellor_id'])) {
			$counsellor_id = (int)$this->request->get['counsellor_id'];
		}
		
		if (isset($this->request->get['filter'])) {
			$filter = $this->request->get['filter'];
		}
		if($counsellor_id != '' && $filter != ''){
			$this->model_student_student->addToCounsellor($counsellor_id, $filter);
			$json = array(
				'success'       => 'Student added successfully to counsellor.'
			);
		}else{
			$json = array(
				'error'       => 'Please check the form carefully.'
			);
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function activestudent(){
		$json = array();
		if (isset($this->request->get['filter'])) {
			$filter = $this->request->get['filter'];
		}
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
				$passbook_id = $this->model_student_student->managePoint(array('student_id'=>$_POST['student_id'], 'reason'=>$_POST['reason'], 'description'=>$_POST['payment_note'], 'credit_point'=>$_POST['point'], 'debit_point'=>0, 'type'=>'Credit'));
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
}