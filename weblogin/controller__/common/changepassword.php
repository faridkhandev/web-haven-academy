<?php
class ControllerCommonChangepassword extends Controller {
	private $error = array();

	public function __construct($params) {
		parent::__construct($params);
		$this->load->model('user/user');
		$this->load->language('common/reset');
	}

	public function index() {
		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
			$this->model_user_user->changePassword($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success_2');
			$this->session->data['redirect'] = TRUE;

			$this->response->redirect($this->url->link('common/changepassword', 'token=' . $this->session->data['token'], true));
		}

		$this->getForm();
	}

	public function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = $this->language->get('text_change_password');

		$data['entry_password'] = $this->language->get('entry_password');
		$data['entry_confirm'] = $this->language->get('entry_confirm');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['text_success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['text_success'] = '';
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

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('common/changepassword', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('common/changepassword', 'token=' . $this->session->data['token'], true);
		$data['cancel'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		if (isset($this->session->data['redirect'])) {
			$data['disabed'] = TRUE;
			$this->user->logout();
			unset($this->session->data['redirect']);
			unset($this->session->data['token']);
			header("refresh:3;url=" . $this->url->link('common/login', '', TRUE) . "");
		}

		$this->response->setOutput($this->load->view('common/change_password_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'common/changepassword')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen(trim($this->request->post['password'])) < 4) || (utf8_strlen(trim($this->request->post['password'])) > 20)) {
			$this->error['password'] = $this->language->get('error_password');
		}

		if (trim($this->request->post['password']) != trim($this->request->post['confirm'])) {
			$this->error['confirm'] = $this->language->get('error_confirm');
		}

		return !$this->error;
	}
}