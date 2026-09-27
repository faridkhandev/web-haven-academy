<?php
class ControllerCommonAdminlogin extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('common/login');
		$this->load->model('user/user_group');
		$this->document->setTitle($this->language->get('heading_title'));

		if ($this->user->isLogged() && isset($this->request->get['token']) && ($this->request->get['token'] == $this->session->data['token'])) {
			$this->response->redirect($this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'));
		}

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->session->data['token'] = md5(mt_rand());

			if (isset($this->request->post['redirect']) && (strpos($this->request->post['redirect'], HTTP_SERVER) === 0 || strpos($this->request->post['redirect'], HTTPS_SERVER) === 0 )) {
				$this->response->redirect($this->request->post['redirect'] . '&token=' . $this->session->data['token']);
			} else {
				$this->response->redirect($this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'));
			}
		}
		
		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$data['icon'] = HTTP_CATALOG . 'image/' . $this->config->get('config_icon');
		} else {
			$data['icon'] = '';
		}
		
		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = HTTP_CATALOG . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_login'] = $this->language->get('text_login');
		$data['text_forgotten'] = $this->language->get('text_forgotten');

		$data['entry_username'] = $this->language->get('entry_username');
		$data['entry_password'] = $this->language->get('entry_password');

		$data['button_login'] = $this->language->get('button_login');
		$data['tagline'] = $this->config->get('config_tagline');

		if ((isset($this->session->data['token']) && !isset($this->request->get['token'])) || ((isset($this->request->get['token']) && (isset($this->session->data['token']) && ($this->request->get['token'] != $this->session->data['token']))))) {
			$this->error['warning'] = $this->language->get('error_token');
		}
		
		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];
			unset($this->session->data['error']);
		}elseif (isset($this->request->get['status']) && ($this->request->get['status']==2)) {
			$data['error_warning'] = 'Some error occur in mail server, please fix this.';
		}elseif (isset($this->error['warning'])) {
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
		
		if (isset($this->request->get['status']) && ($this->request->get['status']==1)) {
			$data['success'] = 'Check your email and reset your password';
		}

		$data['action'] = $this->url->link('common/adminlogin', '', 'SSL');

		if (isset($this->request->post['username'])) {
			$data['username'] = $this->request->post['username'];
		} else {
			$data['username'] = '';
		}

		if (isset($this->request->post['password'])) {
			$data['password'] = $this->request->post['password'];
		} else {
			$data['password'] = '';
		}

		if (isset($this->request->get['route'])) {
			$route = $this->request->get['route'];

			unset($this->request->get['route']);
			unset($this->request->get['token']);

			$url = '';

			if ($this->request->get) {
				$url .= http_build_query($this->request->get);
			}

			$data['redirect'] = $this->url->link($route, $url, 'SSL');
		} else {
			$data['redirect'] = '';
		}
		//print_r($data['success']);exit;
		$data['forgotten'] = $this->url->link('common/forgotten', '', 'SSL');
		$data['groups'] = $this->model_user_user_group->getUserGroups(array('filter_excelude_id'=>0,1));
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('common/adminlogin.tpl', $data));
	}

	protected function validate() {
		if (!isset($this->request->post['username']) || !isset($this->request->post['password']) || !$this->user->loginUpdate($this->request->post['username'], $this->request->post['password'], $this->request->post['user_group_id'])) {
			$this->error['warning'] = $this->language->get('error_login');
		}
		return !$this->error;
	}

	public function check() {
		$route = isset($this->request->get['route']) ? $this->request->get['route'] : '';

		$ignore = array(
			'common/login',
			'common/adminlogin',
			'common/changepassword',
			'common/forgotten',
			'customer/forgotten',
			'customer/logout',
			'customer/login',
			'customer/reset',
			'customer/account',
			'customer/register',
			'customer/register/saveData',
			'customer/register/checkOtp',
			'customer/package',
			'customer/package/detail',
			'customer/dog',
			'customer/dog/add',
			'customer/dog/edit',
			'customer/dog/delete',
			'customer/advance_booking',
			'customer/advance_booking/add',
			'customer/advance_booking/edit',
			'customer/advance_booking/delete',
			'customer/advance_booking/dogautocomplete',
			'tool/upload_file',
			'common/reset'
		);

		if (!$this->user->isLogged() && !in_array($route, $ignore)) {
			return new Action('common/login');
		}

		if (isset($this->request->get['route'])) {
			$ignore = array(
				'common/login',
				'common/adminlogin',
				'common/changepassword',
				'customer/login',
				'customer/account',
				'customer/register',
				'customer/reset',
				'customer/register/saveData',
				'customer/register/checkOtp',
				'customer/forgotten',
				'customer/logout',
				'customer/package',
				'customer/package/detail',
				'customer/dog',
				'customer/dog/add',
				'customer/dog/edit',
				'customer/dog/delete',
				'customer/advance_booking',
				'customer/advance_booking/add',
				'customer/advance_booking/edit',
				'customer/advance_booking/delete',
				'customer/advance_booking/dogautocomplete',
				'common/logout',
				'common/forgotten',
				'common/reset',
				'tool/upload_file',
				'error/not_found',
				'error/permission'
			);

			if (!in_array($route, $ignore) && (!isset($this->request->get['token']) || !isset($this->session->data['token']) || ($this->request->get['token'] != $this->session->data['token']))) {
				return new Action('common/login');
			}
		} else {
			if (!isset($this->request->get['token']) || !isset($this->session->data['token']) || ($this->request->get['token'] != $this->session->data['token'])) {
				return new Action('common/login');
			}
		}
	}
}