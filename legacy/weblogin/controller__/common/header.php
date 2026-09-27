<?php
class ControllerCommonHeader extends Controller {
	public function index() {
		$data['title'] = $this->document->getTitle();
		if ($this->request->server['HTTPS']) {
			$data['base'] = HTTPS_SERVER;
		} else {
			$data['base'] = HTTP_SERVER;
		}
		
		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		$data['serverurl'] = HTTPS_CATALOG;
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');

		$this->load->language('common/header');

		$data['heading_title'] = $this->language->get('heading_title');
		$data['logo'] = $this->config->get('config_logo') ? HTTPS_IMAGE . $this->config->get('config_logo') : "catalog/logo.png";
		$data['app_name'] = $this->config->get('config_name') ? $this->config->get('config_name') : "Om-Boarding";
		$data['app_time_zone'] = $this->config->get('config_timezone') ? $this->config->get('config_timezone') : 'Asia/Kolkata';


		$data['text_order'] = $this->language->get('text_order');
		$data['text_order_status'] = $this->language->get('text_order_status');
		$data['text_complete_status'] = $this->language->get('text_complete_status');
		$data['text_return'] = $this->language->get('text_return');
		$data['text_customer'] = $this->language->get('text_customer');
		$data['text_online'] = $this->language->get('text_online');
		$data['text_approval'] = $this->language->get('text_approval');
		$data['text_product'] = $this->language->get('text_product');
		$data['text_stock'] = $this->language->get('text_stock');
		$data['text_review'] = $this->language->get('text_review');
		$data['text_affiliate'] = $this->language->get('text_affiliate');
		$data['text_store'] = $this->language->get('text_store');
		$data['text_front'] = $this->language->get('text_front');
		$data['text_help'] = $this->language->get('text_help');
		$data['text_homepage'] = $this->language->get('text_homepage');
		$data['text_documentation'] = $this->language->get('text_documentation');
		$data['text_support'] = $this->language->get('text_support');
		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->user->getUserName());
		$data['text_logout'] = $this->language->get('text_logout');
		
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

		if (!isset($this->request->get['token']) || !isset($this->session->data['token']) || ($this->request->get['token'] != $this->session->data['token'])) {
			$data['logged'] = '';
			$data['class'] = 'login';
			$data['home'] = $this->url->link('common/dashboard', '', 'SSL');
		} else {
			$data['token'] = $this->session->data['token'];
			$data['logged'] = true;
			$data['class'] = 'dashboard';
			$data['home'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL');
			$data['logout'] = $this->url->link('common/logout', 'token=' . $this->session->data['token'], 'SSL');
			$data['profile'] = $this->url->link('user/user_profile', 'token=' . $this->session->data['token'], 'SSL');
			$data['user_group_id'] = $this->user->getGroupId();
			$data['change_password'] = $this->url->link('common/changepassword', 'token=' . $this->session->data['token'], true);
			$data['profile'] = $this->url->link('user/user/edit', 'token=' . $this->session->data['token'] . '&user_id=' . $this->user->getId(), true);
			$data['useradd'] = $this->url->link('user/user/add', 'token=' . $this->session->data['token'], true);
			$data['user_profile'] = $this->url->link('user/user_profile', 'token=' . $this->session->data['token'], 'SSL');
			
			$data['doctor'] = $this->url->link('module/doctor', 'token=' . $this->session->data['token'], true);
			$data['doctoradd'] = $this->url->link('module/doctor/add', 'token=' . $this->session->data['token'], true);
			$data['investment'] = $this->url->link('module/investment', 'token=' . $this->session->data['token'], true);
			$data['transaction'] = $this->url->link('module/transaction', 'token=' . $this->session->data['token'], true);
			$data['state'] = $this->url->link('localisation/zone', 'token=' . $this->session->data['token'], true);
			$data['city'] = $this->url->link('localisation/city', 'token=' . $this->session->data['token'], true);
			$data['cityadd'] = $this->url->link('localisation/city/add', 'token=' . $this->session->data['token'], true);
			$data['location'] = $this->url->link('localisation/location', 'token=' . $this->session->data['token'], true);
			$data['reportone'] = $this->url->link('report/doctor', 'token=' . $this->session->data['token'], true);
			$data['reporttwo'] = $this->url->link('report/notification', 'token=' . $this->session->data['token'], true);
			
		}
		$this->load->model('user/user');
		$this->load->model('user/user_group');

		$this->load->model('tool/image');
		
		$user_info = $this->model_user_user->getUser($this->user->getId());
		$data['user_group_info'] = $this->model_user_user_group->getUserGroup($this->user->getGroupId());

		if ($user_info) {
			$data['firstname'] = $user_info['firstname'];
			$data['lastname'] = $user_info['lastname'];
			$data['username'] = $user_info['username'];

			$data['user_group'] = $user_info['user_group'] ;

			if (is_file(DIR_IMAGE . $user_info['image'])) {
				$data['image'] = $this->model_tool_image->resize($user_info['image'], 45, 45);
			} else {
				$data['image'] = $this->model_tool_image->resize('no_image.png', 45, 45);
			}
		} else {
			$data['username'] = '';
			$data['image'] = '';
		}
		$data['tagline'] = $this->config->get('config_tagline');
		$data['config_theme_css'] = $this->config->get('config_theme_css');
		return $this->load->view('common/header.tpl', $data);
	}
}