<?php
class ControllerModuleWithdrawal extends Controller {
	private $error = array();
	
	public function __construct($params) {
		parent::__construct($params);
		$this->load->model('module/withdrawal');
		$this->load->model('user/withdrawal');
		$this->load->model('user/user');
		$this->load->language('module/withdrawal');
	}
	
	public function index() {
		$this->document->setTitle($this->language->get('heading_title'));
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && (strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($this->getItems()));
		} else {
			$this->getList();
		}
	}
	
	private function getItems() {
		
		if (isset($this->request->post['filter_search'])) {
			$filter_search = $this->request->post['filter_search'];
		} else {
			$filter_search = null;
		}
		
		if (isset($this->request->post['filter_date_added'])) {
			$filter_date_added = $this->request->post['filter_date_added'];
		} else {
			$filter_date_added = null;
		}
		
		if (isset($this->request->post['filter_date_ended'])) {
			$filter_date_ended = $this->request->post['filter_date_ended'];
		} else {
			$filter_date_ended = null;
		}
		
		if (isset($this->request->post['order'])) {
			$order = $this->request->post['order'];
		} else {
			$order = NULL;
		}

		if (isset($this->request->post['start'])) {
			$start = $this->request->post['start'];
		} else {
			$start = 0;
		}

		if (isset($this->request->post['length'])) {
			$length = $this->request->post['length'];
		} else {
			$length = $this->config->get('config_limit_admin');
		}

		$filter_data = [
			'filter_search'              => $filter_search,
			'filter_user'              => $this->user->getId(),
			'filter_date_added'              => $filter_date_added,
			'filter_date_ended'              => $filter_date_ended,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];

		$items = array();
		$results = $this->model_module_withdrawal->getItems($filter_data);
		
		foreach($results['result'] as $key => $result) {
			if(empty($result['approve_at'])){
				$approve_at = 'N/A';
			}elseif($result['approve_at'] == '0000-00-00 00:00:00'){
				$approve_at = 'N/A';
			}else{
				$approve_at = date($this->config->get('config_date_format'), strtotime($result['approve_at']));
			}
			
			if(empty($result['cancelled_at'])){
				$cancelled_at = 'N/A';
			}elseif($result['cancelled_at'] == '0000-00-00 00:00:00'){
				$cancelled_at = 'N/A';
			}else{
				$cancelled_at = date($this->config->get('config_date_format'), strtotime($result['cancelled_at']));
			}
			
			$items[] = array(
				'id' => $result['id'],
				'withdrawal_point' => $result['withdrawal_point'],
				'payment_medium' => $result['payment_medium'],
				'approve_status' => $result['approve_status'],
				'requested_at'			=>	date($this->config->get('config_date_format'), strtotime($result['requested_at'])),
				'approve_at'			=>	$approve_at,
				'cancelled_at'			=>	$cancelled_at,
				'action'				=>	$result['id']
			);
		}

		$json = array(
			'draw'				=>	(int)$this->request->post['draw'],
			'recordsTotal'		=>	$results['recordsTotal'],
			'recordsFiltered'	=>	$results['recordsFiltered'],
			'data'				=>	$items,
		);

		return $json;
	}

	protected function getList() {
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => 'My Withdrawal',
			'href' => $this->url->link('module/withdrawal', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);


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

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}
		$data['user_id'] = $this->user->getId();
		$data['user_group_id'] = $this->user->getGroupId();
		$data['user_point'] = $this->model_user_user->getUserPoint($this->user->getId());
		$data['user_request_point'] = $this->model_user_user->getUserTotalWithdrawalRequestPoint($this->user->getId());
		$data['minimum_withdrawal_point'] = $this->config->get('config_subadmin_minimum_withdrawal_point');
		$data['subadmin_money_conversion'] = $this->config->get('config_subadmin_money_conversion');
		
		$data['user_payment_medium'] = $this->model_user_user->getUserPaymentMedium($this->user->getId());
		$data['page_length'] = $this->config->get('config_limit_admin');
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/withdrawal_list.tpl', $data));
	}
	
	public function addrequest(){
		$json = array();
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && (strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
			$user_point = $this->model_user_user->getUserPoint($this->user->getId());
			
			if(empty($_POST['withdrawal_point'])){
				$json['error'] = 'Please add point';
			}
			
			if(empty($_POST['payment_medium'])){
				$json['error'] = 'Please select payment medium';
			}
			
			if($_POST['withdrawal_point']<$this->config->get('config_subadmin_minimum_withdrawal_point')){
				$json['error'] = 'Minimum withdrawal point condition not match.';
			}
			
			if($_POST['withdrawal_point'] > $user_point){
				$json['error'] = 'Your withdrawal point request is exceeds, please check balance point.';
			}
			
			if (!isset($json['error'])) {
				$id = $this->model_user_withdrawal->add(array('user_id'=>$this->user->getId(), 'withdrawal_message'=>$_POST['withdrawal_message'], 'payment_medium'=>$_POST['payment_medium'], 'withdrawal_point'=>$_POST['withdrawal_point'], 'approve_status'=>'Pending', 'requested_at'=>date('Y-m-d H:i:s')));
				if($id){
					$json['success'] = 'Withdrawal request successfully send to admin.';
				}else{
					$json['error'] = 'Request did not send due to system error. Try again';
				}
			}
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}