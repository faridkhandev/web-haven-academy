<?php
class ControllerDashboardSubadmin extends Controller {
	public function index() {
		$this->load->model('user/user');
		$total_credit_point = $this->model_user_user->getUserTotalCreditPoint($this->user->getId());
		$data['heading_title'] = 'Total Point';
		$data['text_view'] = 'List View';
		$data['token'] = $this->session->data['token'];
		$data['link'] = $this->url->link('module/passbook', 'token=' . $this->session->data['token'], 'SSL');
		$data['count'] = $total_credit_point;
		return $this->load->view('dashboard/subadmin.tpl', $data);
	}
}