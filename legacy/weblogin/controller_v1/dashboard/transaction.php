<?php
class ControllerDashboardTransaction extends Controller {
	public function index() {
		$this->load->model('module/transaction');
		$results = $this->model_module_transaction->getItems();
		$data['heading_title'] = 'Transaction List';
		$data['text_view'] = 'List View';
		$data['token'] = $this->session->data['token'];
		$data['link'] = $this->url->link('module/transaction', 'token=' . $this->session->data['token'], 'SSL');
		$data['count'] = $results['recordsTotal'];
		return $this->load->view('dashboard/transaction.tpl', $data);
	}
}