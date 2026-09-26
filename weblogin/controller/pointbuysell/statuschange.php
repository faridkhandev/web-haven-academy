<?php
class ControllerPointbuysellStatuschange extends Controller {
	private $error = array();
	
	public function __construct($params) {
		parent::__construct($params);
		$this->load->model('user/user');
		$this->load->model('user/user_group');
		$this->load->model('pointbuysell/wallet');
		$this->load->language('user/pointbuysell');
	}
	
	public function index() {
		
		$this->document->setTitle('Point Buy Sell Detail List');
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			
			global $db;
			$db->query("UPDATE bh_user_extra SET buy_status = '".$_POST['buy_status']."', sell_status = '".$_POST['sell_status']."' WHERE user_id = '".$this->user->getId()."'");
			$this->session->data['success'] = 'Status successfully updated';
		} else {
			$this->getList();
		}
		$this->getList();
	}
	
	protected function getList() {
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('user/pointbuysell', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('user/pointbuysell/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('user/pointbuysell/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['heading_title'] = $this->language->get('heading_title');
		$data['token'] = $this->session->data['token'];
		
		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_username'] = $this->language->get('column_username');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}
		
		$data['current_user_id'] = $this->user->getId();
		$data['buy'] = $this->model_pointbuysell_wallet->pointBuySummeryByUser($this->user->getId());
		$data['sell'] = $this->model_pointbuysell_wallet->pointSellSummeryByUser($this->user->getId());
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		
		global $db;
		$query = $db->query("SELECT buy_status, sell_status FROM bh_user_extra WHERE user_id = '".$this->user->getId()."'");
		$data['info'] = $query->row;
		
		$data['page_length'] = $this->config->get('config_limit_admin');
		$data['student'] = $this->url->link('student/student', '&token=' . $this->session->data['token'], TRUE);
		$data['action'] = $this->url->link('pointbuysell/statuschange', '&token=' . $this->session->data['token'], TRUE);
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('pointbuysell/status.tpl', $data));
	}
}