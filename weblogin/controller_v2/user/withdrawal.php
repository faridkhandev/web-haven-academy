<?php
class ControllerUserWithdrawal extends Controller {
	private $error = array();
	
	public function __construct($params) {
		parent::__construct($params);
		$this->load->model('user/withdrawal');
		$this->load->model('user/payment');
		$this->load->model('user/passbook');
		$this->load->model('user/user');
		$this->load->model('tool/image');
		$this->load->language('user/withdrawal');
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
		
		if (isset($this->request->post['filter_user_no'])) {
			$filter_user_no = $this->request->post['filter_user_no'];
		} else {
			$filter_user_no = null;
		}
		
		if (isset($this->request->post['filter_user_group'])) {
			$filter_user_group = $this->request->post['filter_user_group'];
		} else {
			$filter_user_group = null;
		}
		
		if (isset($this->request->post['filter_status'])) {
			$filter_status = $this->request->post['filter_status'];
		} else {
			$filter_status = null;
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
			'filter_user_no'              => $filter_user_no,
			'filter_user_group'              => $filter_user_group,
			'filter_status'              => $filter_status,
			'filter_date_added'              => $filter_date_added,
			'filter_date_ended'              => $filter_date_ended,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];

		$items = array();
		$results = $this->model_user_withdrawal->getItems($filter_data);
		
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
				'user_id' => $result['user_id'],
				'user_no' => $result['user_no'],
				'name' => $result['firstname'].' '.$result['lastname'],
				'user_group' => $result['user_group'],
				'withdrawal_point' => $result['withdrawal_point'],
				'payment_medium' => $result['payment_medium'],
				'approve_status' => $result['approve_status'],
				'point_value' => $result['point_value'],
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
			'text' => 'Sub Admin Withdrawal',
			'href' => $this->url->link('user/withdrawal', 'token=' . $this->session->data['token'] . $url, 'SSL')
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
		
		if (isset($this->request->get['user_no'])) {
			$data['user_no'] = $this->request->get['user_no'];
		} else {
			$data['user_no'] = '';
		}
		
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		$data['user_id'] = $this->user->getId();
		$data['user_group_id'] = $this->user->getGroupId();
		
		$data['page_length'] = $this->config->get('config_limit_admin');
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('user/withdrawal_list.tpl', $data));
	}
	
	public function payment(){
		$json = array();
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && (strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
			if(empty($_POST['user_id'])){
				$json['error'] = 'Error Code:10001. Some error occur, Try again.';
			}
			
			if(empty($_POST['id'])){
				$json['error'] = 'Error Code:10002. Some error occur, Try again.';
			}
			
			if(empty($_POST['status'])){
				$json['error'] = 'Please select withdrawal status.';
			}
			
			if($_POST['status']=='Paid'){
				if(empty($_POST['amount'])){
					$json['error'] = 'Please add amount.';
				}
			}
			
			if (!isset($json['error'])) {
				$this->model_user_withdrawal->edit($_POST['id'], array('approve_status'=>$_POST['status'], 'admin_message'=>$_POST['comment']));
				
				if($_POST['status']=='Paid'){			
					$id = $this->model_user_payment->add(array('user_id'=>$_POST['user_id'], 'amount'=>$_POST['amount'], 'withdrawal_request_id'=>$_POST['id'], 'conversion_rate'=>$_POST['point_value'], 'payment_medium_id'=>$_POST['payment_medium'], 'transaction_id'=>$_POST['transaction_id'], 'screenshot_image'=>$_POST['screenshot_image'], 'comment'=>$_POST['comment'], 'requested_at'=>date('Y-m-d H:i:s')));
					
					if($id){
						$passbook_id = $this->model_user_passbook->add(array('user_id'=>$_POST['user_id'], 'reason'=>'Amount transfer aganist '.$_POST['withdrawal_point'], 'description'=>$_POST['comment'], 'credit_point'=>0, 'debit_point'=>$_POST['withdrawal_point'], 'type'=>'Debit'));
					}
				}
				$json['success'] = 'Withdrawal request successfully process.';
				/* if($id){
					$json['success'] = 'Withdrawal request successfully process.';
				}else{
					$json['error'] = 'Request did not send due to system error. Try again';
				} */
			}
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}