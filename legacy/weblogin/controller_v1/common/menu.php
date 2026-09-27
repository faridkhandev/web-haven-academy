<?php
class ControllerCommonMenu extends Controller {
	public function index() {
		$this->load->language('common/menu');
		$data['text_dashboard'] = $this->language->get('text_dashboard');
		$data['text_item_management'] = $this->language->get('text_item_management');
		$data['text_item_list'] = $this->language->get('text_item_list');
		$data['text_booking'] = $this->language->get('text_booking');
		$data['text_monthly_bill'] = $this->language->get('text_monthly_bill');
		$data['text_boarding'] = $this->language->get('text_boarding');
		$data['text_check_in'] = $this->language->get('text_check_in');
		$data['text_check_out'] = $this->language->get('text_check_out');
		$data['text_invoice'] = $this->language->get('text_invoice');
		$data['text_custom_field'] = $this->language->get('text_custom_field');
		$data['text_custom_field_group'] = $this->language->get('text_custom_field_group');
		
		$data['text_service_management'] = $this->language->get('text_service_management');

		$data['text_service'] = $this->language->get('text_service');
		$data['text_package'] = $this->language->get('text_package');
		$data['text_package_category'] = $this->language->get('text_package_category');
		$data['text_voucher'] = $this->language->get('text_voucher');
		$data['text_pickup'] = $this->language->get('text_pickup');
		$data['text_dropoff'] = $this->language->get('text_dropoff');
		$data['text_service_booking'] = $this->language->get('text_service_booking');
	
		$data['text_customer'] = $this->language->get('text_customer');
		
		$data['text_user_management'] = $this->language->get('text_user_management');
		$data['text_user'] = $this->language->get('text_user');
		$data['text_user_profile'] = $this->language->get('text_user_profile');
		$data['text_user_groups'] = $this->language->get('text_user_groups');
		
		$data['text_settings'] = $this->language->get('text_settings');
		$data['text_language'] = $this->language->get('text_language');
		$data['text_backup'] = $this->language->get('text_backup');
		$data['text_error_log'] = $this->language->get('text_error_log');
		$data['text_contact'] = $this->language->get('text_contact');
		
		$data['text_expense'] = $this->language->get('text_expense');
		$data['text_expense_head'] = $this->language->get('text_expense_head');
		
		$data['text_reports'] = $this->language->get('text_reports');
		$data['text_boarding_details'] = $this->language->get('text_boarding_details');
		$data['text_advance_booking'] = $this->language->get('text_advance_booking');
		$data['text_online_booking'] = $this->language->get('text_online_booking');
		$data['text_accountant'] = $this->language->get('text_accountant');
		$data['text_vaccination'] = $this->language->get('text_vaccination');
		$data['text_consolidated_invoice'] = $this->language->get('text_consolidated_invoice');

		

		$data['home'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['student'] = $this->url->link('student/student', 'token=' . $this->session->data['token'], 'SSL');
		$data['instudent'] = $this->url->link('student/student/inactive', 'token=' . $this->session->data['token'], 'SSL');
		$data['student_report'] = $this->url->link('student/student_report', 'token=' . $this->session->data['token'], 'SSL');
		$data['spassbook'] = $this->url->link('student/passbook', 'token=' . $this->session->data['token'], 'SSL');
		$data['swithdrawal'] = $this->url->link('student/withdrawal', 'token=' . $this->session->data['token'], 'SSL');
		$data['spayment'] = $this->url->link('student/payment', 'token=' . $this->session->data['token'], 'SSL');
		$data['project'] = $this->url->link('student/project', 'token=' . $this->session->data['token'], 'SSL');
		
		
		
		$data['mystudent'] = $this->url->link('module/mystudent', 'token=' . $this->session->data['token'], 'SSL');
		$data['course'] = $this->url->link('module/course', 'token=' . $this->session->data['token'], 'SSL');
		$data['session'] = $this->url->link('module/session', 'token=' . $this->session->data['token'], 'SSL');
		$data['passbook'] = $this->url->link('module/passbook', 'token=' . $this->session->data['token'], 'SSL');
		$data['withdrawal'] = $this->url->link('module/withdrawal', 'token=' . $this->session->data['token'], 'SSL');
		$data['payment'] = $this->url->link('module/payment', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['permission'] = $this->url->link('user/access', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['user'] = $this->url->link('user/user', 'token=' . $this->session->data['token'], 'SSL');
		$data['superuser'] = $this->url->link('user/superuser', 'token=' . $this->session->data['token'], 'SSL');
		$data['trainer'] = $this->url->link('user/trainer', 'token=' . $this->session->data['token'], 'SSL');
		$data['team_leader'] = $this->url->link('user/team_leader', 'token=' . $this->session->data['token'], 'SSL');
		$data['senior_team_leader'] = $this->url->link('user/senior_team_leader', 'token=' . $this->session->data['token'], 'SSL');
		$data['teacher'] = $this->url->link('user/teacher', 'token=' . $this->session->data['token'], 'SSL');
		$data['counsellor'] = $this->url->link('user/counsellor', 'token=' . $this->session->data['token'], 'SSL');
		$data['mytrainer'] = $this->url->link('user/mytrainer', 'token=' . $this->session->data['token'], 'SSL');
		$data['myleader'] = $this->url->link('user/myleader', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['user_profile'] = $this->url->link('user/user_profile', 'token=' . $this->session->data['token'], 'SSL');
		$data['user_group'] = $this->url->link('user/user_permission', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['user_passbook'] = $this->url->link('user/passbook', 'token=' . $this->session->data['token'], 'SSL');
		$data['user_withdrawal'] = $this->url->link('user/withdrawal', 'token=' . $this->session->data['token'], 'SSL');
		$data['user_payment'] = $this->url->link('user/payment', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['setting'] = $this->url->link('setting/setting', 'token=' . $this->session->data['token'], 'SSL');
		$data['backup'] = $this->url->link('tool/backup', 'token=' . $this->session->data['token'], 'SSL');
		$data['logs'] = $this->url->link('tool/error_log', 'token=' . $this->session->data['token'],'SSL');
		$data['reset'] = $this->url->link('tool/reset', 'token=' . $this->session->data['token'],'SSL');
		
		$data['student_refer'] = $this->url->link('report/student_refer', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['group_id'] = $this->user->getGroupId();
		return $this->load->view('common/menu.tpl', $data);
	}
}