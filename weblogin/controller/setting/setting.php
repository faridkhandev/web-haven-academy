<?php
class ControllerSettingSetting extends Controller {
	private $error = array();

	public function __construct($params) {
		parent::__construct($params);
		$this->load->model('setting/setting');
		$this->load->language('setting/setting');
		if($this->user->getGroupId() != 0 && $this->user->getGroupId() != 1) {
			$this->response->redirect($this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'));
		}
	}
	
	public function index() {
		$data['user_group_id'] = $this->user->getGroupId();
		
		$this->load->language('setting/setting');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('config', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('setting/setting', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_product'] = $this->language->get('text_product');
		$data['text_review'] = $this->language->get('text_review');
		$data['text_account'] = $this->language->get('text_account');
		$data['text_stock'] = $this->language->get('text_stock');
		$data['text_mail'] = $this->language->get('text_mail');
		$data['text_smtp'] = $this->language->get('text_smtp');
		$data['text_google_analytics'] = $this->language->get('text_google_analytics');
		$data['text_google_captcha'] = $this->language->get('text_google_captcha');

		/* Global Setting */
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_tagline'] = $this->language->get('entry_tagline');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_telephone'] = $this->language->get('entry_telephone');
		$data['entry_fax'] = $this->language->get('entry_fax');
		$data['entry_date_format'] = $this->language->get('entry_date_format');
		$data['entry_disable_registration'] = $this->language->get('entry_disable_registration');
		$data['entry_password'] = $this->language->get('entry_password');
		$data['entry_default_language'] = $this->language->get('entry_default_language');
		$data['entry_admin_language'] = 'Select Default Admin Language';
		$data['entry_limit_admin'] = $this->language->get('entry_default_item_per_page_back');
		$data['entry_template'] = $this->language->get('entry_template');
		
		/* Account Setting  */
		$data['entry_login_attempts'] = $this->language->get('entry_login_attempts');
		$data['entry_account'] = $this->language->get('entry_account');
		$data['entry_account_mail'] = $this->language->get('entry_account_mail');
		$data['entry_review'] = $this->language->get('entry_review');
		$data['entry_review_guest'] = $this->language->get('entry_review_guest');
		$data['entry_review_mail'] = $this->language->get('entry_review_mail');
		
		/* Dog Setting  */
		$data['help_invoice_prefix'] = $this->language->get('help_invoice_prefix');
		$data['entry_invoice_prefix'] = $this->language->get('entry_invoice_prefix');
		$data['entry_tax_value'] = $this->language->get('entry_tax_value');
		$data['entry_hourly_rate'] = $this->language->get('entry_hourly_rate');
		$data['entry_date_last_heat_alert'] = $this->language->get('entry_date_last_heat_alert');
		$data['entry_date_last_heat_notify_days'] = $this->language->get('entry_date_last_heat_notify_days');
		$data['entry_date_last_heat_boarding_allow'] = $this->language->get('entry_date_last_heat_boarding_allow');
		$data['entry_last_DHPPL_valid_till'] = $this->language->get('entry_last_DHPPL_valid_till');
		$data['entry_last_DHPPL_valid_notify_days'] = $this->language->get('entry_last_DHPPL_valid_notify_days');
		$data['entry_last_DHPPL_valid_boarding_allow'] = $this->language->get('entry_last_DHPPL_valid_boarding_allow');
		$data['entry_kennel_cough_alert'] = $this->language->get('entry_kennel_cough_alert');
		$data['entry_kennel_cough_notify_days'] = $this->language->get('entry_kennel_cough_notify_days');
		$data['entry_kennel_cough_boarding_allow'] = $this->language->get('entry_kennel_cough_boarding_allow');
		$data['entry_rabbies_vacination_alert'] = $this->language->get('entry_rabbies_vacination_alert');
		$data['entry_rabbies_vacination_notify_days'] = $this->language->get('entry_rabbies_vacination_notify_days');
		$data['entry_rabbies_vacination_boarding_allow'] = $this->language->get('entry_rabbies_vacination_boarding_allow');
		$data['entry_deworming_alert'] = $this->language->get('entry_deworming_alert');
		$data['entry_deworming_notify_days'] = $this->language->get('entry_deworming_notify_days');
		$data['entry_deworming_boarding_allow'] = $this->language->get('entry_deworming_boarding_allow');
		$data['entry_accompanying_items'] = $this->language->get('entry_accompanying_items');
		$data['entry_advance_booking_timing'] = $this->language->get('entry_advance_booking_timing');
		
		/* Image Setting */
		$data['entry_logo'] = $this->language->get('entry_logo');
		$data['entry_icon'] = $this->language->get('entry_icon');
		$data['entry_image_thumb'] = $this->language->get('entry_image_thumb');
		$data['entry_image_popup'] = $this->language->get('entry_image_popup');
		$data['entry_image_product'] = $this->language->get('entry_image_product');
		$data['entry_image_additional'] = $this->language->get('entry_image_additional');
		$data['entry_image_related'] = $this->language->get('entry_image_related');
		$data['entry_image_compare'] = $this->language->get('entry_image_compare');
		$data['entry_image_wishlist'] = $this->language->get('entry_image_wishlist');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		
		/* Mail Setting */
		$data['entry_mail_protocol'] = $this->language->get('entry_mail_protocol');
		$data['entry_mail_parameter'] = $this->language->get('entry_mail_parameter');
		$data['entry_mail_smtp_hostname'] = $this->language->get('entry_mail_smtp_hostname');
		$data['entry_mail_smtp_username'] = $this->language->get('entry_mail_smtp_username');
		$data['entry_mail_smtp_password'] = $this->language->get('entry_mail_smtp_password');
		$data['entry_mail_smtp_port'] = $this->language->get('entry_mail_smtp_port');
		$data['entry_mail_smtp_timeout'] = $this->language->get('entry_mail_smtp_timeout');
		$data['entry_mail_alert'] = $this->language->get('entry_mail_alert');
		
		/* Server Setting */
		$data['entry_file_max_size'] = $this->language->get('entry_file_max_size');
		$data['entry_file_ext_allowed'] = $this->language->get('entry_file_ext_allowed');
		$data['entry_file_mime_allowed'] = $this->language->get('entry_file_mime_allowed');
		$data['entry_maintenance'] = $this->language->get('entry_maintenance');
		$data['entry_seo_url'] = $this->language->get('entry_seo_url');
		$data['entry_compression'] = $this->language->get('entry_compression');
		$data['entry_error_display'] = $this->language->get('entry_error_display');
		$data['entry_error_log'] = $this->language->get('entry_error_log');
		$data['entry_error_filename'] = $this->language->get('entry_error_filename');
		$data['entry_google_captcha_public'] = $this->language->get('entry_google_captcha_public');
		$data['entry_google_captcha_secret'] = $this->language->get('entry_google_captcha_secret');
		$data['entry_status'] = $this->language->get('entry_status');
		
		$data['help_geocode'] = $this->language->get('help_geocode');
		$data['help_open'] = $this->language->get('help_open');
		$data['help_comment'] = $this->language->get('help_comment');
		$data['help_location'] = $this->language->get('help_location');
		$data['help_currency'] = $this->language->get('help_currency');
		$data['help_currency_auto'] = $this->language->get('help_currency_auto');
		$data['help_product_limit'] = $this->language->get('help_product_limit');
		$data['help_product_description_length'] = $this->language->get('help_product_description_length');
		$data['help_limit_admin'] = $this->language->get('help_limit_admin');
		$data['help_product_count'] = $this->language->get('help_product_count');
		$data['help_review'] = $this->language->get('help_review');
		$data['help_review_guest'] = $this->language->get('help_review_guest');
		$data['help_review_mail'] = $this->language->get('help_review_mail');
		$data['help_voucher_min'] = $this->language->get('help_voucher_min');
		$data['help_voucher_max'] = $this->language->get('help_voucher_max');
		$data['help_tax_default'] = $this->language->get('help_tax_default');
		$data['help_tax_customer'] = $this->language->get('help_tax_customer');
		$data['help_customer_online'] = $this->language->get('help_customer_online');
		$data['help_customer_group'] = $this->language->get('help_customer_group');
		$data['help_customer_group_display'] = $this->language->get('help_customer_group_display');
		$data['help_customer_price'] = $this->language->get('help_customer_price');
		$data['help_login_attempts'] = $this->language->get('help_login_attempts');
		$data['help_account'] = $this->language->get('help_account');
		$data['help_account_mail'] = $this->language->get('help_account_mail');
		$data['help_icon'] = $this->language->get('help_icon');
		$data['help_ftp_root'] = $this->language->get('help_ftp_root');
		$data['help_mail_protocol'] = $this->language->get('help_mail_protocol');
		$data['help_mail_parameter'] = $this->language->get('help_mail_parameter');
		$data['help_mail_smtp_hostname'] = $this->language->get('help_mail_smtp_hostname');
		$data['help_mail_alert'] = $this->language->get('help_mail_alert');
		$data['help_secure'] = $this->language->get('help_secure');
		$data['help_shared'] = $this->language->get('help_shared');
		$data['help_robots'] = $this->language->get('help_robots');
		$data['help_seo_url'] = $this->language->get('help_seo_url');
		$data['help_file_max_size'] = $this->language->get('help_file_max_size');
		$data['help_file_ext_allowed'] = $this->language->get('help_file_ext_allowed');
		$data['help_file_mime_allowed'] = $this->language->get('help_file_mime_allowed');
		$data['help_maintenance'] = $this->language->get('help_maintenance');
		$data['help_password'] = $this->language->get('help_password');
		$data['help_encryption'] = $this->language->get('help_encryption');
		$data['help_compression'] = $this->language->get('help_compression');
		$data['help_google_analytics'] = $this->language->get('help_google_analytics');
		$data['help_google_captcha'] = $this->language->get('help_google_captcha');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_account'] = $this->language->get('tab_account');
		$data['tab_dog'] = $this->language->get('tab_dog');
		$data['tab_image'] = $this->language->get('tab_image');
		$data['tab_mail'] = $this->language->get('tab_mail');
		$data['tab_server'] = $this->language->get('tab_server');
		$data['tab_script'] = $this->language->get('tab_script');
		$data['tab_google'] = $this->language->get('tab_google');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

		if (isset($this->error['tagline'])) {
			$data['error_tagline'] = $this->error['tagline'];
		} else {
			$data['error_tagline'] = '';
		}

		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}
		
		if (isset($this->error['address'])) {
			$data['error_address'] = $this->error['address'];
		} else {
			$data['error_address'] = '';
		}

		if (isset($this->error['telephone'])) {
			$data['error_telephone'] = $this->error['telephone'];
		} else {
			$data['error_telephone'] = '';
		}

		if (isset($this->error['login_attempts'])) {
			$data['error_login_attempts'] = $this->error['login_attempts'];
		} else {
			$data['error_login_attempts'] = '';
		}

		if (isset($this->error['hourly_rate'])) {
			$data['error_hourly_rate'] = $this->error['hourly_rate'];
		} else {
			$data['error_hourly_rate'] = '';
		}

		if (isset($this->error['error_filename'])) {
			$data['error_error_filename'] = $this->error['error_filename'];
		} else {
			$data['error_error_filename'] = '';
		}

		if (isset($this->error['limit_admin'])) {
			$data['error_limit_admin'] = $this->error['limit_admin'];
		} else {
			$data['error_limit_admin'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('setting/setting', 'token=' . $this->session->data['token'], 'SSL')
		);

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['action'] = $this->url->link('setting/setting', 'token=' . $this->session->data['token'], 'SSL');

		$data['token'] = $this->session->data['token'];

		//Global Settings
		
		if (isset($this->request->post['config_name'])) {
			$data['config_name'] = $this->request->post['config_name'];
		} else {
			$data['config_name'] = $this->config->get('config_name');
		}

		if (isset($this->request->post['config_tagline'])) {
			$data['config_tagline'] = $this->request->post['config_tagline'];
		} else {
			$data['config_tagline'] = $this->config->get('config_tagline');
		}

		if (isset($this->request->post['config_description'])) {
			$data['config_description'] = $this->request->post['config_description'];
		} else {
			$data['config_description'] = $this->config->get('config_description');
		}

		if (isset($this->request->post['config_address'])) {
			$data['config_address'] = $this->request->post['config_address'];
		} else {
			$data['config_address'] = $this->config->get('config_address');
		}
		
		if (isset($this->request->post['config_trn_no'])) {
			$data['config_trn_no'] = $this->request->post['config_trn_no'];
		} else {
			$data['config_trn_no'] = $this->config->get('config_trn_no');
		}
		
		if (isset($this->request->post['config_email'])) {
			$data['config_email'] = $this->request->post['config_email'];
		} else {
			$data['config_email'] = $this->config->get('config_email');
		}

		if (isset($this->request->post['config_telephone'])) {
			$data['config_telephone'] = $this->request->post['config_telephone'];
		} else {
			$data['config_telephone'] = $this->config->get('config_telephone');
		}

		if (isset($this->request->post['config_fax'])) {
			$data['config_fax'] = $this->request->post['config_fax'];
		} else {
			$data['config_fax'] = $this->config->get('config_fax');
		}
		
		if (isset($this->request->post['config_invoice_start'])) {
			$data['config_invoice_start'] = $this->request->post['config_invoice_start'];
		} else {
			$data['config_invoice_start'] = $this->config->get('config_invoice_start');
		}
		
		if (isset($this->request->post['config_order_start'])) {
			$data['config_order_start'] = $this->request->post['config_order_start'];
		} else {
			$data['config_order_start'] = $this->config->get('config_order_start');
		}
		
		if (isset($this->request->post['config_purchase_start'])) {
			$data['config_purchase_start'] = $this->request->post['config_purchase_start'];
		} else {
			$data['config_purchase_start'] = $this->config->get('config_purchase_start');
		}
		
		if (isset($this->request->post['config_vouchar_start'])) {
			$data['config_vouchar_start'] = $this->request->post['config_vouchar_start'];
		} else {
			$data['config_vouchar_start'] = $this->config->get('config_vouchar_start');
		}

		if (isset($this->request->post['config_date_format'])) {
			$data['config_date_format'] = $this->request->post['config_date_format'];
		} else {
			$data['config_date_format'] = $this->config->get('config_date_format');
		}
		
		if (isset($this->request->post['config_date_format'])) {
			$data['config_date_format'] = $this->request->post['config_date_format'];
		} else {
			$data['config_date_format'] = $this->config->get('config_date_format');
		}

		if (isset($this->request->post['config_disable_registration'])) {
			$data['config_disable_registration'] = $this->request->post['config_disable_registration'];
		} else {
			$data['config_disable_registration'] = $this->config->get('config_disable_registration');
		}
		
		if (isset($this->request->post['config_password'])) {
			$data['config_password'] = $this->request->post['config_password'];
		} else {
			$data['config_password'] = $this->config->get('config_password');
		}
		
		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		if (isset($this->request->post['config_admin_language'])) {
			$data['config_admin_language'] = $this->request->post['config_admin_language'];
		} else {
			$data['config_admin_language'] = $this->config->get('config_admin_language');
		}
		
		if (isset($this->request->post['config_limit_admin'])) {
			$data['config_limit_admin'] = $this->request->post['config_limit_admin'];
		} else {
			$data['config_limit_admin'] = $this->config->get('config_limit_admin');
		}

		if (isset($this->request->post['config_language'])) {
			$data['config_language'] = $this->request->post['config_language'];
		} else {
			$data['config_language'] = $this->config->get('config_language');
		}

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['config_admin_language'])) {
			$data['config_admin_language'] = $this->request->post['config_admin_language'];
		} else {
			$data['config_admin_language'] = $this->config->get('config_admin_language');
		}

		if (isset($this->request->post['config_limit_admin'])) {
			$data['config_limit_admin'] = $this->request->post['config_limit_admin'];
		} else {
			$data['config_limit_admin'] = $this->config->get('config_limit_admin');
		}

		if (isset($this->request->post['config_review_status'])) {
			$data['config_review_status'] = $this->request->post['config_review_status'];
		} else {
			$data['config_review_status'] = $this->config->get('config_review_status');
		}

		if (isset($this->request->post['config_review_guest'])) {
			$data['config_review_guest'] = $this->request->post['config_review_guest'];
		} else {
			$data['config_review_guest'] = $this->config->get('config_review_guest');
		}

		if (isset($this->request->post['config_review_mail'])) {
			$data['config_review_mail'] = $this->request->post['config_review_mail'];
		} else {
			$data['config_review_mail'] = $this->config->get('config_review_mail');
		}

		if (isset($this->request->post['config_login_attempts'])) {
			$data['config_login_attempts'] = $this->request->post['config_login_attempts'];
		} elseif ($this->config->has('config_login_attempts')) {
			$data['config_login_attempts'] = $this->config->get('config_login_attempts');
		} else {
			$data['config_login_attempts'] = 5;
		}

		if (isset($this->request->post['config_account_id'])) {
			$data['config_account_id'] = $this->request->post['config_account_id'];
		} else {
			$data['config_account_id'] = $this->config->get('config_account_id');
		}

		if (isset($this->request->post['config_money_conversion'])) {
			$data['config_money_conversion'] = $this->request->post['config_money_conversion'];
		} elseif ($this->config->get('config_money_conversion')) {
			$data['config_money_conversion'] = $this->config->get('config_money_conversion');
		} else {
			$data['config_money_conversion'] = '';
		}
		
		if (isset($this->request->post['config_subadmin_money_conversion'])) {
			$data['config_subadmin_money_conversion'] = $this->request->post['config_subadmin_money_conversion'];
		} elseif ($this->config->get('config_subadmin_money_conversion')) {
			$data['config_subadmin_money_conversion'] = $this->config->get('config_subadmin_money_conversion');
		} else {
			$data['config_subadmin_money_conversion'] = '';
		}
		
		if (isset($this->request->post['config_trainer_no'])) {
			$data['config_trainer_no'] = $this->request->post['config_trainer_no'];
		} elseif ($this->config->get('config_trainer_no')) {
			$data['config_trainer_no'] = $this->config->get('config_trainer_no');
		} else {
			$data['config_trainer_no'] = '';
		}
		
		if (isset($this->request->post['config_team_leader_no'])) {
			$data['config_team_leader_no'] = $this->request->post['config_team_leader_no'];
		} elseif ($this->config->get('config_team_leader_no')) {
			$data['config_team_leader_no'] = $this->config->get('config_team_leader_no');
		} else {
			$data['config_team_leader_no'] = '';
		}
		
		if (isset($this->request->post['config_class_join_point'])) {
			$data['config_class_join_point'] = $this->request->post['config_class_join_point'];
		} elseif ($this->config->get('config_class_join_point')) {
			$data['config_class_join_point'] = $this->config->get('config_class_join_point');
		} else {
			$data['config_class_join_point'] = '';
		}
		
		if (isset($this->request->post['config_cashback_point'])) {
			$data['config_cashback_point'] = $this->request->post['config_cashback_point'];
		} elseif ($this->config->get('config_cashback_point')) {
			$data['config_cashback_point'] = $this->config->get('config_cashback_point');
		} else {
			$data['config_cashback_point'] = '';
		}
		
		if (isset($this->request->post['config_video_point'])) {
			$data['config_video_point'] = $this->request->post['config_video_point'];
		} elseif ($this->config->get('config_video_point')) {
			$data['config_video_point'] = $this->config->get('config_video_point');
		} else {
			$data['config_video_point'] = '';
		}
		
		if (isset($this->request->post['config_photo_point'])) {
			$data['config_photo_point'] = $this->request->post['config_photo_point'];
		} elseif ($this->config->get('config_photo_point')) {
			$data['config_photo_point'] = $this->config->get('config_photo_point');
		} else {
			$data['config_photo_point'] = '';
		}
		
		if (isset($this->request->post['config_refer_activated_point'])) {
			$data['config_refer_activated_point'] = $this->request->post['config_refer_activated_point'];
		} elseif ($this->config->get('config_refer_activated_point')) {
			$data['config_refer_activated_point'] = $this->config->get('config_refer_activated_point');
		} else {
			$data['config_refer_activated_point'] = '';
		}
		
		if (isset($this->request->post['config_refer_point'])) {
			$data['config_refer_point'] = $this->request->post['config_refer_point'];
		} else {
			$data['config_refer_point'] = $this->config->get('config_refer_point');
		}
		
		if (isset($this->request->post['config_student_pending_point'])) {
			$data['config_student_pending_point'] = $this->request->post['config_student_pending_point'];
		} elseif ($this->config->get('config_student_pending_point')) {
			$data['config_student_pending_point'] = $this->config->get('config_student_pending_point');
		} else {
			$data['config_student_pending_point'] = '';
		}
		
		if (isset($this->request->post['config_student_minimum_withdrawal_point'])) {
			$data['config_student_minimum_withdrawal_point'] = $this->request->post['config_student_minimum_withdrawal_point'];
		} else {
			$data['config_student_minimum_withdrawal_point'] = $this->config->get('config_student_minimum_withdrawal_point');
		}
		
		if (isset($this->request->post['config_subadmin_minimum_withdrawal_point'])) {
			$data['config_subadmin_minimum_withdrawal_point'] = $this->request->post['config_subadmin_minimum_withdrawal_point'];
		} else {
			$data['config_subadmin_minimum_withdrawal_point'] = $this->config->get('config_subadmin_minimum_withdrawal_point');
		}

		$this->load->model('tool/image');
		
		if (isset($this->request->post['config_logo'])) {
			$data['config_logo'] = $this->request->post['config_logo'];
		} else {
			$data['config_logo'] = $this->config->get('config_logo');
		}

		if (isset($this->request->post['config_logo']) && is_file(DIR_IMAGE . $this->request->post['config_logo'])) {
			$data['logo'] = $this->model_tool_image->resize($this->request->post['config_logo'], 100, 100);
		} elseif ($this->config->get('config_logo') && is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $this->model_tool_image->resize($this->config->get('config_logo'), 100, 100);
		} else {
			$data['logo'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		if (isset($this->request->post['config_icon'])) {
			$data['config_icon'] = $this->request->post['config_icon'];
		} else {
			$data['config_icon'] = $this->config->get('config_icon');
		}

		if (isset($this->request->post['config_icon']) && is_file(DIR_IMAGE . $this->request->post['config_icon'])) {
			$data['icon'] = $this->model_tool_image->resize($this->request->post['config_logo'], 100, 100);
		} elseif ($this->config->get('config_icon') && is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$data['icon'] = $this->model_tool_image->resize($this->config->get('config_icon'), 100, 100);
		} else {
			$data['icon'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		if (isset($this->request->post['config_mail_protocol'])) {
			$data['config_mail_protocol'] = $this->request->post['config_mail_protocol'];
		} else {
			$data['config_mail_protocol'] = $this->config->get('config_mail_protocol');
		}

		if (isset($this->request->post['config_mail_parameter'])) {
			$data['config_mail_parameter'] = $this->request->post['config_mail_parameter'];
		} else {
			$data['config_mail_parameter'] = $this->config->get('config_mail_parameter');
		}
		
		if (isset($this->request->post['config_mail_smtp_hostname'])) {
			$data['config_mail_smtp_hostname'] = $this->request->post['config_mail_smtp_hostname'];
		} else {
			$data['config_mail_smtp_hostname'] = $this->config->get('config_mail_smtp_hostname');
		}
		
		if (isset($this->request->post['config_mail_smtp_username'])) {
			$data['config_mail_smtp_username'] = $this->request->post['config_mail_smtp_username'];
		} else {
			$data['config_mail_smtp_username'] = $this->config->get('config_mail_smtp_username');
		}	
					
		if (isset($this->request->post['config_mail_smtp_password'])) {
			$data['config_mail_smtp_password'] = $this->request->post['config_mail_smtp_password'];
		} else {
			$data['config_mail_smtp_password'] = $this->config->get('config_mail_smtp_password');
		}	
		
		if (isset($this->request->post['config_mail_smtp_port'])) {
			$data['config_mail_smtp_port'] = $this->request->post['config_mail_smtp_port'];
		} elseif ($this->config->has('config_mail_smtp_port')) {
			$data['config_mail_smtp_port'] = $this->config->get('config_mail_smtp_port');
		} else {
			$data['config_mail_smtp_port'] = 25;
		}	
		
		if (isset($this->request->post['config_mail_smtp_timeout'])) {
			$data['config_mail_smtp_timeout'] = $this->request->post['config_mail_smtp_timeout'];
		} elseif ($this->config->has('config_mail_smtp_timeout')) {
			$data['config_mail_smtp_timeout'] = $this->config->get('config_mail_smtp_timeout');		
		} else {
			$data['config_mail_smtp_timeout'] = 5;
		}	

		if (isset($this->request->post['config_mail_alert'])) {
			$data['config_mail_alert'] = $this->request->post['config_mail_alert'];
		} else {
			$data['config_mail_alert'] = $this->config->get('config_mail_alert');
		}

		if (isset($this->request->post['config_robots'])) {
			$data['config_robots'] = $this->request->post['config_robots'];
		} else {
			$data['config_robots'] = $this->config->get('config_robots');
		}

		if (isset($this->request->post['config_seo_url'])) {
			$data['config_seo_url'] = $this->request->post['config_seo_url'];
		} else {
			$data['config_seo_url'] = $this->config->get('config_seo_url');
		}

		if (isset($this->request->post['config_file_max_size'])) {
			$data['config_file_max_size'] = $this->request->post['config_file_max_size'];
		} elseif ($this->config->get('config_file_max_size')) {
			$data['config_file_max_size'] = $this->config->get('config_file_max_size');
		} else {
			$data['config_file_max_size'] = 300000;
		}

		if (isset($this->request->post['config_file_ext_allowed'])) {
			$data['config_file_ext_allowed'] = $this->request->post['config_file_ext_allowed'];
		} else {
			$data['config_file_ext_allowed'] = $this->config->get('config_file_ext_allowed');
		}

		if (isset($this->request->post['config_file_mime_allowed'])) {
			$data['config_file_mime_allowed'] = $this->request->post['config_file_mime_allowed'];
		} else {
			$data['config_file_mime_allowed'] = $this->config->get('config_file_mime_allowed');
		}

		if (isset($this->request->post['config_maintenance'])) {
			$data['config_maintenance'] = $this->request->post['config_maintenance'];
		} else {
			$data['config_maintenance'] = $this->config->get('config_maintenance');
		}

		

		if (isset($this->request->post['config_encryption'])) {
			$data['config_encryption'] = $this->request->post['config_encryption'];
		} else {
			$data['config_encryption'] = $this->config->get('config_encryption');
		}

		if (isset($this->request->post['config_compression'])) {
			$data['config_compression'] = $this->request->post['config_compression'];
		} else {
			$data['config_compression'] = $this->config->get('config_compression');
		}

		if (isset($this->request->post['config_error_display'])) {
			$data['config_error_display'] = $this->request->post['config_error_display'];
		} else {
			$data['config_error_display'] = $this->config->get('config_error_display');
		}

		if (isset($this->request->post['config_error_log'])) {
			$data['config_error_log'] = $this->request->post['config_error_log'];
		} else {
			$data['config_error_log'] = $this->config->get('config_error_log');
		}

		if (isset($this->request->post['config_error_filename'])) {
			$data['config_error_filename'] = $this->request->post['config_error_filename'];
		} else {
			$data['config_error_filename'] = $this->config->get('config_error_filename');
		}
		
		if (isset($this->request->post['config_template'])) {
			$data['config_template'] = $this->request->post['config_template'];
		} else {
			$data['config_template'] = $this->config->get('config_template');
		}
		
		if (isset($this->request->post['config_theme_css'])) {
			$data['config_theme_css'] = $this->request->post['config_theme_css'];
		} elseif ($this->config->get('config_theme_css')) {
			$data['config_theme_css'] = $this->config->get('config_theme_css');
		} else {
			$data['config_theme_css'] = 'theme-color1.css';
		}
		
		if (isset($this->request->post['config_upload_file'])) {
			$data['config_upload_file'] = $this->request->post['config_upload_file'];
		} else {
			$data['config_upload_file'] = $this->config->get('config_upload_file');
		}
		
		if (isset($this->request->post['config_id_activation_point'])) {
			$data['config_id_activation_point'] = $this->request->post['config_id_activation_point'];
		} elseif ($this->config->get('config_id_activation_point')) {
			$data['config_id_activation_point'] = $this->config->get('config_id_activation_point');
		} else {
			$data['config_id_activation_point'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('setting/setting.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'setting/setting')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['config_name']) {
			$this->error['name'] = $this->language->get('error_name');
		}
		
		if (!$this->request->post['config_address']) {
			$this->error['address'] = $this->language->get('error_address');
		}

		if ((utf8_strlen($this->request->post['config_email']) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->request->post['config_email'])) {
			$this->error['email'] = $this->language->get('error_email');
		}
		
		if ((utf8_strlen($this->request->post['config_telephone']) < 3) || (utf8_strlen($this->request->post['config_telephone']) > 32)) {
			$this->error['telephone'] = $this->language->get('error_telephone');
		}
		
		if ($this->request->post['config_login_attempts'] < 1) {
			$this->error['login_attempts'] = $this->language->get('error_login_attempts');
		}

		if (!$this->request->post['config_error_filename']) {
			$this->error['error_filename'] = $this->language->get('error_error_filename');
		} else {
			if (preg_match('/\.\.[\/\\\]?/', $this->request->post['config_error_filename'])) {
				$this->error['error_filename'] = $this->language->get('error_malformed_filename');
			}
		}

		if (!$this->request->post['config_limit_admin']) {
			$this->error['limit_admin'] = $this->language->get('error_limit');
		}

		if ((utf8_strlen($this->request->post['config_encryption']) < 3) || (utf8_strlen($this->request->post['config_encryption']) > 32)) {
			$this->error['encryption'] = $this->language->get('error_encryption');
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}
	
	public function template() {
		if ($this->request->server['HTTPS']) {
			$server = HTTPS_CATALOG;
		} else {
			$server = HTTP_CATALOG;
		}

		if (is_file(DIR_IMAGE . 'templates/' . basename($this->request->get['template']) . '.png')) {
			$this->response->setOutput($server . 'image/templates/' . basename($this->request->get['template']) . '.png');
		} else {
			$this->response->setOutput($server . 'image/no_image.png');
		}
	}
}