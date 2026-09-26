<?php
class ControllerUserCounsellor extends Controller {
	private $error = array();
	
	public function __construct($params) {
		parent::__construct($params);
		$this->load->model('user/user');
		$this->load->model('user/user_group');
		$this->load->language('user/counsellor');
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
		
		if (isset($this->request->post['filter_user_no'])) {
			$filter_user_no = $this->request->post['filter_user_no'];
		} else {
			$filter_user_no = null;
		}
		
		$filter_group_id = 15;

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
			'filter_phone'              => $filter_phone,
			'filter_email'              => $filter_email,
			'filter_user_no'              => $filter_user_no,
			'filter_group_id'             => $filter_group_id,
			'filter_status'            => $filter_status,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];

		$items = array();
		$results = $this->model_user_user->getSubItems($filter_data);
		foreach($results['result'] as $key => $result) {
			$items[] = array(
				'user_id' => $result['user_id'],
				'username'   => $result['username'],
				'name'   => $result['firstname'].' '.$result['lastname'],
				'email'   => $result['email'],
				'user_no'   => $result['user_no'],
				'phone'   => $result['phone'],
				'whatsapp'   => $result['whatsapp'],
				'gender'   => $result['gender'],
				'status'     => $result['status'],
				'date_added'			=>	date($this->config->get('config_date_format'), strtotime($result['date_added'])),
				'action'				=>	$result['user_id']
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
			$this->model_user_user->addSubUser($data);

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

			$this->response->redirect($this->url->link('user/counsellor', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$data = $this->request->post;
			$data['link_user_id'] = 0;
			$this->model_user_user->editSubUser($this->request->get['counsellor_id'], $data);

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

			$this->response->redirect($this->url->link('user/counsellor', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {

		$this->document->setTitle($this->language->get('heading_title'));

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $counsellor_id) {
				$this->model_user_user->deleteUser($counsellor_id);
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

			$this->response->redirect($this->url->link('user/counsellor', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
			'href' => $this->url->link('user/counsellor', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('user/counsellor/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('user/counsellor/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

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
		$data['edit'] = $this->url->link('user/counsellor/edit', '&token=' . $this->session->data['token'], TRUE);
		$data['payment'] = $this->url->link('user/payment', '&token=' . $this->session->data['token'], TRUE);
		$data['withdrawal'] = $this->url->link('user/withdrawal', '&token=' . $this->session->data['token'], TRUE);
		$data['passbook'] = $this->url->link('user/passbook', '&token=' . $this->session->data['token'], TRUE);
		$data['student'] = $this->url->link('user/counsellorstudent', '&token=' . $this->session->data['token'], TRUE);
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('user/counsellor_list.tpl', $data));
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

		if (isset($this->error['username'])) {
			$data['error_username'] = $this->error['username'];
		} else {
			$data['error_username'] = '';
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

		if (isset($this->error['firstname'])) {
			$data['error_firstname'] = $this->error['firstname'];
		} else {
			$data['error_firstname'] = '';
		}

		if (isset($this->error['lastname'])) {
			$data['error_lastname'] = $this->error['lastname'];
		} else {
			$data['error_lastname'] = '';
		}
		
		if (isset($this->error['phone'])) {
			$data['error_phone'] = $this->error['phone'];
		} else {
			$data['error_phone'] = '';
		}
		
		if (isset($this->error['whatsapp'])) {
			$data['error_whatsapp'] = $this->error['whatsapp'];
		} else {
			$data['error_whatsapp'] = '';
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
			'href' => $this->url->link('user/counsellor', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['counsellor_id'])) {
			$data['action'] = $this->url->link('user/counsellor/add', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('user/counsellor/edit', 'token=' . $this->session->data['token'] . '&counsellor_id=' . $this->request->get['counsellor_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('user/counsellor', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->get['counsellor_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$user_info = $this->model_user_user->getUser($this->request->get['counsellor_id']);
		}

		if (isset($this->request->post['username'])) {
			$data['username'] = $this->request->post['username'];
		} elseif (!empty($user_info)) {
			$data['username'] = $user_info['username'];
		} else {
			$data['username'] = '';
		}

		if (isset($this->request->post['user_group_id'])) {
			$data['user_group_id'] = $this->request->post['user_group_id'];
		} elseif (!empty($user_info)) {
			$data['user_group_id'] = $user_info['user_group_id'];
		} else {
			$data['user_group_id'] = '';
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

		if (isset($this->request->post['firstname'])) {
			$data['firstname'] = $this->request->post['firstname'];
		} elseif (!empty($user_info)) {
			$data['firstname'] = $user_info['firstname'];
		} else {
			$data['firstname'] = '';
		}

		if (isset($this->request->post['lastname'])) {
			$data['lastname'] = $this->request->post['lastname'];
		} elseif (!empty($user_info)) {
			$data['lastname'] = $user_info['lastname'];
		} else {
			$data['lastname'] = '';
		}

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} elseif (!empty($user_info)) {
			$data['email'] = $user_info['email'];
		} else {
			$data['email'] = '';
		}

		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($user_info)) {
			$data['image'] = $user_info['image'];
		} else {
			$data['image'] = '';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($user_info) && $user_info['image'] && is_file(DIR_IMAGE . $user_info['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($user_info['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($user_info)) {
			$data['status'] = $user_info['status'];
		} else {
			$data['status'] = 1;
		}
		
		if (isset($this->request->post['phone'])) {
			$data['phone'] = $this->request->post['phone'];
		} elseif (!empty($user_info)) {
			$data['phone'] = $user_info['phone'];
		} else {
			$data['phone'] = '';
		}
		
		if (isset($this->request->post['whatsapp'])) {
			$data['whatsapp'] = $this->request->post['whatsapp'];
		} elseif (!empty($user_info)) {
			$data['whatsapp'] = $user_info['whatsapp'];
		} else {
			$data['whatsapp'] = '';
		}
		
		if (isset($this->request->post['gender'])) {
			$data['gender'] = $this->request->post['gender'];
		} elseif (!empty($user_info)) {
			$data['gender'] = $user_info['gender'];
		} else {
			$data['gender'] = '';
		}
		
		if (isset($this->request->post['city'])) {
			$data['city'] = $this->request->post['city'];
		} elseif (!empty($user_info)) {
			$data['city'] = $user_info['city'];
		} else {
			$data['city'] = '';
		}
		
		if (isset($this->request->post['country'])) {
			$data['country'] = $this->request->post['country'];
		} elseif (!empty($user_info)) {
			$data['country'] = $user_info['country'];
		} else {
			$data['country'] = '';
		}
		
		if (isset($this->request->post['language'])) {
			$data['language'] = $this->request->post['language'];
		} elseif (!empty($user_info)) {
			$data['language'] = $user_info['language'];
		} else {
			$data['language'] = '';
		}
		
		if (isset($this->request->post['payment_medium'])) {
			$data['payment_medium'] = $this->request->post['payment_medium'];
		} elseif (!empty($user_info)) {
			$data['payment_medium'] = $this->model_user_user->getUserPaymentMedium($this->request->get['counsellor_id']);
		} else {
			$data['payment_medium'] = array();
		}
		
		if (!empty($user_info)) {
			$data['user_no'] = $user_info['user_no'];
		} else {
			$data['user_no'] = '';
		}
		
		$data['text_form'] = !isset($this->request->get['counsellor_id']) ? $this->language->get('text_add') : 'Edit counsellor '.'(<div class="miltiInfo"><span>Id:'.$user_info['user_no'].'</span>||<span>Username:'.$user_info['username'].'</span>||<span>Name:'.$user_info['firstname'].' '.$user_info['lastname'].'</span></div>)';
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('user/counsellor_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'user/counsellor')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		/* if ((utf8_strlen($this->request->post['username']) < 3) || (utf8_strlen($this->request->post['username']) > 50)) {
			$this->error['username'] = $this->language->get('error_username');
		}

		$user_info = $this->model_user_user->getUserByUsername($this->request->post['username']);

		if (!isset($this->request->get['counsellor_id'])) {
			if ($user_info) {
				$this->error['warning'] = $this->language->get('error_exists');
			}
		} else {
			if ($user_info && ($this->request->get['counsellor_id'] != $user_info['user_id'])) {
				$this->error['warning'] = $this->language->get('error_exists');
			}
		} */
		
		$user_info = $this->model_user_user->getUserByEmail($this->request->post['email']);

		if (!isset($this->request->get['counsellor_id'])) {
			if ($user_info) {
				$this->error['warning'] = 'Email already exist, try different email id.';
			}
		} else {
			if ($user_info && ($this->request->get['counsellor_id'] != $user_info['user_id'])) {
				$this->error['warning'] = 'Email already exist, try different email id.';
			}
		}

		if ((utf8_strlen(trim($this->request->post['firstname'])) < 1) || (utf8_strlen(trim($this->request->post['firstname'])) > 32)) {
			$this->error['firstname'] = $this->language->get('error_firstname');
		}

		if ((utf8_strlen(trim($this->request->post['lastname'])) < 1) || (utf8_strlen(trim($this->request->post['lastname'])) > 32)) {
			$this->error['lastname'] = $this->language->get('error_lastname');
		}
		
		
		if ((utf8_strlen(trim($this->request->post['whatsapp'])) < 1) || (utf8_strlen(trim($this->request->post['whatsapp'])) > 32)) {
			$this->error['whatsapp'] = 'Invalid Whatsapp No.';
		}
		
		if ((utf8_strlen(trim($this->request->post['phone'])) < 1) || (utf8_strlen(trim($this->request->post['phone'])) > 32)) {
			$this->error['phone'] = 'Invalid Phone No.';
		}

		if ($this->request->post['password'] || (!isset($this->request->get['counsellor_id']))) {
			if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
				$this->error['password'] = $this->language->get('error_password');
			}

			if ($this->request->post['password'] != $this->request->post['confirm']) {
				$this->error['confirm'] = $this->language->get('error_confirm');
			}
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'user/counsellor')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['selected'] as $counsellor_id) {
			if ($this->user->getId() == $counsellor_id) {
				$this->error['warning'] = $this->language->get('error_account');
			}
		}

		return !$this->error;
	}
}