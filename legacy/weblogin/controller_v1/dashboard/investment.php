<?php
class ControllerDashboardInvestment extends Controller {
	public function index() {
		$this->load->model('module/investment');
		$results = $this->model_module_investment->getItems();
		$data['heading_title'] = 'Investment List';
		$data['text_view'] = 'List View';
		$data['token'] = $this->session->data['token'];
		$data['link'] = $this->url->link('module/investment', 'token=' . $this->session->data['token'], 'SSL');
		$data['count'] = $results['recordsTotal'];
		return $this->load->view('dashboard/investment.tpl', $data);
	}
}