<?php
class ControllerCommonDashboard extends Controller {
	public function index() {
		$this->load->language('common/dashboard');
		$this->load->model('pointbuysell/wallet');
		$this->load->model('common/dashboard');
		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title'] = $this->language->get('heading_title');
		$data['group_id'] = $this->user->getGroupId();
		$data['dashboard'] = $this->model_common_dashboard->getStats($this->user->getGroupId(), $this->user->getId());
		$data['dashboard_title'] = $data['dashboard']['title'];
		$data['dashboard_cards'] = $data['dashboard']['cards'];

		foreach ($data['dashboard_cards'] as $key => $card) {
			$data['dashboard_cards'][$key]['link'] = $this->url->link($card['link'], 'token=' . $this->session->data['token'], 'SSL');
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);
		
		$data['buy'] = $this->model_pointbuysell_wallet->pointBuySummeryByUser($this->user->getId());
		$data['sell'] = $this->model_pointbuysell_wallet->pointSellSummeryByUser($this->user->getId());
		
		$data['investment'] = $this->load->controller('dashboard/investment');
		$data['investmentlist'] = $this->load->controller('dashboard/investmentlist');
		$data['transaction'] = $this->load->controller('dashboard/transaction');
		$data['transactionlist'] = $this->load->controller('dashboard/transactionlist');
		$data['location'] = $this->load->controller('dashboard/location');
		$data['subadmin'] = $this->load->controller('dashboard/subadmin');

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('common/dashboard.tpl', $data));
	}
}