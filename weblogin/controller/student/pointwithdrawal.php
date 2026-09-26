<?php
class ControllerStudentPointwithdrawal extends Controller {
	private $error = array();
	
	public function __construct($params) {
		parent::__construct($params);
		$this->load->model('tool/image');
		$this->load->model('student/pointwithdrawal');
		$this->load->model('student/payment');
		$this->load->model('student/passbook');
		$this->load->model('student/student');
		$this->load->model('user/user');
		$this->load->language('student/withdrawal');
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
		
		if (isset($this->request->post['filter_student_no'])) {
			$filter_student_no = $this->request->post['filter_student_no'];
		} else {
			$filter_student_no = null;
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
			'filter_student_no'              => $filter_student_no,
			'filter_buysell_no'              => $filter_buysell_no,
			'filter_status'              => $filter_status,
			'filter_date_added'              => $filter_date_added,
			'filter_date_ended'              => $filter_date_ended,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];

		$items = array();
		$results = $this->model_student_pointwithdrawal->getItems($filter_data);
		
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
			$complain_by = '';
			if($result['complain_by_user']==2){
				$complain_by = 'Buyer Id';
			}
			if($result['complain_by_student']==2){
				$complain_by = 'Student';
			}
			if($result['complain_by_user']==2 && $result['complain_by_student']==2){
				$complain_by = 'Both';
			}
			$items[] = array(
				'id' => $result['id'],
				'student_id' => $result['student_id'],
				'student_no' => $result['student_no'],
				'user_no' => $result['user_no'].'-'.$result['name'],
				'student_name' => $result['student_name'],
				'point' => $result['point'],
				'status' => $result['status'],
				'complain_by_student' => $result['complain_by_student'],
				'complain_by_user' => $result['complain_by_user'],
				'complain_by' => $complain_by,
				'screenshot' => $result['screenshot'],
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
			'text' => 'Point Withdrawal',
			'href' => $this->url->link('student/pointwithdrawal', 'token=' . $this->session->data['token'] . $url, 'SSL')
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
		
		if (isset($this->request->get['student_no'])) {
			$data['student_no'] = $this->request->get['student_no'];
		} else {
			$data['student_no'] = '';
		}
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		$data['user_id'] = $this->user->getId();
		$data['user_group_id'] = $this->user->getGroupId();
		$data['cancel'] = $this->url->link('student/student', 'token=' . $this->session->data['token'], 'SSL');
		$data['page_length'] = $this->config->get('config_limit_admin');
		
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('student/buy_point_request_list.tpl', $data));
	}
	
	public function payment(){
		$json = array();
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && (strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
			print_r($_POST); exit;
			if(empty($_POST['id'])){
				$json['error'] = 'Error Code:10002. Some error occur, Try again.';
			}
			
			if(empty($_POST['status'])){
				$json['error'] = 'Please select withdrawal status.';
			}
			
			if (!isset($json['error'])) {
				
				
				$info = $this->model_student_pointwithdrawal->get($_POST['id']);
				
				$request = $this->model_student_student->get($_POST['id']);
				
				if($_POST['status']=='Paid'){
					global $db;
					$db->query("INSERT INTO point_buy SET user_id = '" . $info['user_id'] . "', student_id = '" . $info['student_id'] . "', point = '" . $info['point'] . "', created_at = '".date('Y-m-d H:i:s')."', type = '1', reason = 'Admin Take This Action'");
					
					$db->query("UPDATE point_hold SET status = 'Paid', approve_at = '".date('Y-m-d H:i:s')."' WHERE id='".$_POST['id']."'");
				}
				
				if($_POST['status']=='Cancel'){
					global $db;
					$this->model_student_student->managePoint(array('student_id'=>$info['student_id'], 'reason'=>'Admin Send Back Sell Point '.$info['point'], 'description'=>'Due to issue with point buy seller ID admin send back your sell point', 'credit_point'=>$info['point'], 'debit_point'=>0, 'type'=>'Credit'));
					
					$db->query("UPDATE point_hold SET status = 'Cancel', cancelled_at = '".date('Y-m-d H:i:s')."' WHERE id='".$_POST['id']."'");
				}
				
				$json['success'] = 'Your request successfully process.';
			}
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}