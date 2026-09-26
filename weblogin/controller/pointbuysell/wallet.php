<?php
class ControllerPointbuysellWallet extends Controller {
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
		$this->getList();
	}
	
	public function buy() {
		
		if (isset($this->request->post['filter_type'])) {
			$filter_type = $this->request->post['filter_type'];
		} else {
			$filter_type = null;
		}
		
		if (isset($this->request->post['filter_user_id'])) {
			$filter_user_id = $this->request->post['filter_user_id'];
		} else {
			$filter_user_id = null;
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
			'filter_type'              => $filter_type,
			'filter_student_no'              => $filter_student_no,
			'filter_user_id'              => $filter_user_id,
			'filter_date_added'             => $filter_date_added,
			'filter_date_ended'            => $filter_date_ended,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];

		$items = array();
		$results = $this->model_pointbuysell_wallet->getBuyItems($filter_data);
		foreach($results['result'] as $key => $result) {
			if(is_null($result['student_name'])){
				$detail='From Admin';
			}else{
				$detail=$result['student_name'].'-'.$result['student_no'];
			}
			$items[] = array(
				'user_id' => $result['user_id'],
				'type'   => ($result['type']==1)?'Credit':'Debit',
				'point'   => $result['point'],
				'detail'   => $detail,
				'created_at'			=>	date($this->config->get('config_date_format'), strtotime($result['created_at'])),
				'action'				=>	$result['id']
			);
		}

		$json = array(
			'draw'				=>	(int)$this->request->post['draw'],
			'recordsTotal'		=>	$results['recordsTotal'],
			'recordsFiltered'	=>	$results['recordsFiltered'],
			'data'				=>	$items,
		);

		echo json_encode($json);
	}
	
	public function sell() {
		
		if (isset($this->request->post['filter_type'])) {
			$filter_type = $this->request->post['filter_type'];
		} else {
			$filter_type = null;
		}
		
		if (isset($this->request->post['filter_user_id'])) {
			$filter_user_id = $this->request->post['filter_user_id'];
		} else {
			$filter_user_id = null;
		}
		
		if (isset($this->request->post['filter_student_no'])) {
			$filter_student_no = $this->request->post['filter_student_no'];
		} else {
			$filter_student_no = null;
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
			'filter_type'              => $filter_type,
			'filter_user_id'              => $filter_user_id,
			'filter_student_no'             => $filter_student_no,
			'filter_date_added'             => $filter_date_added,
			'filter_date_ended'            => $filter_date_ended,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];

		$items = array();
		$results = $this->model_pointbuysell_wallet->getSellItems($filter_data);
		foreach($results['result'] as $key => $result) {
			if(is_null($result['student_name'])){
				$detail='From Admin';
			}else{
				$detail=$result['student_name'].'-'.$result['student_no'];
			}
			$items[] = array(
				'user_id' => $result['user_id'],
				'type'   => ($result['type']==1)?'Credit':'Debit',
				'point'   => $result['point'],
				'detail'   => $detail,
				'created_at'			=>	date($this->config->get('config_date_format'), strtotime($result['created_at'])),
				'action'				=>	$result['id']
			);
		}

		$json = array(
			'draw'				=>	(int)$this->request->post['draw'],
			'recordsTotal'		=>	$results['recordsTotal'],
			'recordsFiltered'	=>	$results['recordsFiltered'],
			'data'				=>	$items,
		);

		echo json_encode($json);
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
		
		$data['current_user_id'] = $this->user->getId();
		$data['buy'] = $this->model_pointbuysell_wallet->pointBuySummeryByUser($this->user->getId());
		$data['sell'] = $this->model_pointbuysell_wallet->pointSellSummeryByUser($this->user->getId());
		
		$data['page_length'] = $this->config->get('config_limit_admin');
		$data['student'] = $this->url->link('student/student', '&token=' . $this->session->data['token'], TRUE);
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('pointbuysell/pointbuysell_list.tpl', $data));
	}
}