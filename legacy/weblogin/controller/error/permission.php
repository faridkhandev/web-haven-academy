<?php
class ControllerErrorPermission extends Controller {
	public function index() {
		$data['user_group_id'] = $this->user->getGroupId();
		$this->load->language('error/permission');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_permission'] = $this->language->get('text_permission');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('error/permission', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('error/permission.tpl', $data));
	}

	public function check() {
		$data['user_group_id'] = $this->user->getGroupId();
		if (isset($this->request->get['route'])) {
			$route = '';

			$part = explode('/', $this->request->get['route']);

			if (isset($part[0])) {
				$route .= $part[0];
			}

			if (isset($part[1])) {
				$route .= '/' . $part[1];
			}

			$ignore = array(
				'common/dashboard',
				'common/profile',
				'common/changepassword',
				'common/login',
				'common/adminlogin',
				'event/compatibility',
				'event/theme',
				'customer/forgotten',
				'customer/login',
				'customer/logout',
				'customer/account',
				'customer/register',
				'customer/reset',
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
				'tool/backup',
				'tool/error_log',
				'tool/reset',
				'tool/upload',
				'tool/upload_file',
				'common/logout',
				'common/forgotten',
				'common/reset',
				'error/not_found',
				'error/permission',
				'dashboard/order',
				'dashboard/sale',
				'dashboard/customer',
				'dashboard/online',
				'dashboard/map',
				'dashboard/activity',
				'dashboard/chart',
				'dashboard/recent'
			);

			if (!in_array($route, $ignore) && !$this->user->hasPermission('access', $route)) {
				return new Action('error/permission');
			}
		}
	}
}