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
		
		// Quick Student List-এর লিংক এবং টোকেন
		$data['quick_student_active'] = $this->url->link('student/quick_student', 'status=active&token=' . $this->session->data['token'], 'SSL');
		$data['quick_student_inactive'] = $this->url->link('student/quick_student', 'status=inactive&token=' . $this->session->data['token'], 'SSL');
		$data['token'] = $this->session->data['token'];

		$data['student'] = $this->url->link('student/student', 'token=' . $this->session->data['token'], 'SSL');
		$data['pointwithdrawal'] = $this->url->link('student/pointwithdrawal', 'token=' . $this->session->data['token'], 'SSL');
		$data['block'] = $this->url->link('student/block', 'token=' . $this->session->data['token'], 'SSL');
		$data['instudent'] = $this->url->link('student/student/inactive', 'token=' . $this->session->data['token'], 'SSL');
		$data['whatsapp'] = $this->url->link('student/student/whatsapp', 'token=' . $this->session->data['token'], 'SSL');
		$data['mappingremove'] = $this->url->link('student/mappingremove', 'token=' . $this->session->data['token'], 'SSL');
		$data['student_report'] = $this->url->link('student/student_report', 'token=' . $this->session->data['token'], 'SSL');
		$data['spassbook'] = $this->url->link('student/passbook', 'token=' . $this->session->data['token'], 'SSL');
		$data['swithdrawal'] = $this->url->link('student/withdrawal', 'token=' . $this->session->data['token'], 'SSL');
		$data['spayment'] = $this->url->link('student/payment', 'token=' . $this->session->data['token'], 'SSL');
		$data['project'] = $this->url->link('student/project', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['stlinactivestudent'] = $this->url->link('module/inactivestudentcount', 'token=' . $this->session->data['token'], 'SSL');
		$data['mystudent'] = $this->url->link('module/mystudent', 'token=' . $this->session->data['token'], 'SSL');
		$data['stlstudent'] = $this->url->link('module/stlstudent', 'token=' . $this->session->data['token'], 'SSL');
		$data['counsellorstudent'] = $this->url->link('module/counsellorstudent', 'token=' . $this->session->data['token'], 'SSL');
		$data['seatbooking'] = $this->url->link('module/seatbooking', 'token=' . $this->session->data['token'], 'SSL');
		$data['tseatbooking'] = $this->url->link('module/tseatbooking', 'token=' . $this->session->data['token'], 'SSL');
		$data['tlseatbooking'] = $this->url->link('module/tlseatbooking', 'token=' . $this->session->data['token'], 'SSL');
		$data['counsellorreport'] = $this->url->link('module/counsellorreport', 'token=' . $this->session->data['token'], 'SSL');
		$data['trainerreport'] = $this->url->link('module/trainerreport', 'token=' . $this->session->data['token'], 'SSL');
		$data['teamleaderreport'] = $this->url->link('module/teamleaderreport', 'token=' . $this->session->data['token'], 'SSL');
		$data['stlreport'] = $this->url->link('module/stlreport', 'token=' . $this->session->data['token'], 'SSL');
		$data['allreport'] = $this->url->link('module/report', 'token=' . $this->session->data['token'], 'SSL');
		$data['course'] = $this->url->link('module/course', 'token=' . $this->session->data['token'], 'SSL');
		$data['session'] = $this->url->link('module/session', 'token=' . $this->session->data['token'], 'SSL');
		$data['sessionstudent'] = $this->url->link('module/sessionstudent', 'token=' . $this->session->data['token'], 'SSL');
		$data['passbook'] = $this->url->link('module/passbook', 'token=' . $this->session->data['token'], 'SSL');
		$data['withdrawal'] = $this->url->link('module/withdrawal', 'token=' . $this->session->data['token'], 'SSL');
		$data['payment'] = $this->url->link('module/payment', 'token=' . $this->session->data['token'], 'SSL');
		$data['controllerstudent'] = $this->url->link('module/controllerstudent', 'token=' . $this->session->data['token'], 'SSL');
		$data['assignstudent'] = $this->url->link('module/assignstudent', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['attendance'] = $this->url->link('module/attendance', 'token=' . $this->session->data['token'], 'SSL');
		$data['allattendance'] = $this->url->link('module/allattendance', 'token=' . $this->session->data['token'], 'SSL');
		$data['facebook'] = $this->url->link('module/facebook', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['permission'] = $this->url->link('user/access', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['user'] = $this->url->link('user/user', 'token=' . $this->session->data['token'], 'SSL');
		$data['superuser'] = $this->url->link('user/superuser', 'token=' . $this->session->data['token'], 'SSL');
		$data['trainer'] = $this->url->link('user/trainer', 'token=' . $this->session->data['token'], 'SSL');
		$data['team_leader'] = $this->url->link('user/team_leader', 'token=' . $this->session->data['token'], 'SSL');
		$data['senior_team_leader'] = $this->url->link('user/senior_team_leader', 'token=' . $this->session->data['token'], 'SSL');
		$data['teacher'] = $this->url->link('user/teacher', 'token=' . $this->session->data['token'], 'SSL');
		$data['counsellor'] = $this->url->link('user/counsellor', 'token=' . $this->session->data['token'], 'SSL');
		$data['controller'] = $this->url->link('user/controller', 'token=' . $this->session->data['token'], 'SSL');
		$data['pointbuysell'] = $this->url->link('user/pointbuysell', 'token=' . $this->session->data['token'], 'SSL');
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
		
		$data['notification'] = $this->url->link('welcome/notification', 'token=' . $this->session->data['token'],'SSL');
		$data['weeklyactivity'] = $this->url->link('welcome/weeklyactivity', 'token=' . $this->session->data['token'],'SSL');
		$data['helpline'] = $this->url->link('welcome/helpline', 'token=' . $this->session->data['token'],'SSL');
		$data['townhall'] = $this->url->link('welcome/townhall', 'token=' . $this->session->data['token'],'SSL');
		$data['photo'] = $this->url->link('welcome/photo', 'token=' . $this->session->data['token'],'SSL');
		$data['motivational'] = $this->url->link('welcome/motivational', 'token=' . $this->session->data['token'],'SSL');
		$data['weeklybest'] = $this->url->link('welcome/weeklybest', 'token=' . $this->session->data['token'],'SSL');
		$data['dailybest'] = $this->url->link('welcome/dailybest', 'token=' . $this->session->data['token'],'SSL');
		
		$data['pointbuysellwallet'] = $this->url->link('pointbuysell/wallet', 'token=' . $this->session->data['token'],'SSL');
		$data['conversion'] = $this->url->link('pointbuysell/conversion', 'token=' . $this->session->data['token'],'SSL');
		$data['buyrequest'] = $this->url->link('pointbuysell/buyrequest', 'token=' . $this->session->data['token'],'SSL');
		$data['sellpoint'] = $this->url->link('pointbuysell/sellpoint', 'token=' . $this->session->data['token'],'SSL');
		$data['statuschange'] = $this->url->link('pointbuysell/statuschange', 'token=' . $this->session->data['token'],'SSL');
		
		$data['student_refer'] = $this->url->link('report/student_refer', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['group_id'] = $this->user->getGroupId();
		$data['user_id'] = $this->user->getId();
		return $this->load->view('common/menu.tpl', $data);
	}
}
