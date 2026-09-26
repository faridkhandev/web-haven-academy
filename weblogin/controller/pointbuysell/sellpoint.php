<?php
class ControllerPointbuysellSellpoint extends Controller {
	private $error = array();
	
	public function __construct($params) {
		parent::__construct($params);
		$this->load->model('student/student');
		$this->load->model('student/passbook');
		$this->load->model('pointbuysell/wallet');
		$this->load->model('user/user');
		$this->load->language('student/student');
	}
	
	public function index() {
		$this->document->setTitle($this->language->get('heading_title'));
		$this->document->setTitle($this->language->get('heading_title'));
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && (strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($this->getInactiveItems()));
		} else {
			$this->getInactiveList();
		}
	}

	private function getInactiveItems() {
		if (isset($this->request->post['filter_search'])) {
			$filter_search = $this->request->post['filter_search'];
		} else {
			$filter_search = null;
		}
		
		if (isset($this->request->post['filter_name'])) {
			$filter_name = $this->request->post['filter_name'];
		} else {
			$filter_name = null;
		}
		
		if (isset($this->request->post['filter_phone'])) {
			$filter_phone = $this->request->post['filter_phone'];
		} else {
			$filter_phone = null;
		}
		
		if (isset($this->request->post['filter_email'])) {
			$filter_email = $this->request->post['filter_email'];
		} else {
			$filter_email = null;
		}
		
		if (isset($this->request->post['filter_gender'])) {
			$filter_gender = $this->request->post['filter_gender'];
		} else {
			$filter_gender = null;
		}
		
		if (isset($this->request->post['filter_student_no'])) {
			$filter_student_no = $this->request->post['filter_student_no'];
		} else {
			$filter_student_no = null;
		}
		
		if (isset($this->request->post['filter_user_no'])) {
			$filter_user_no = $this->request->post['filter_user_no'];
		} else {
			$filter_user_no = null;
		}
		
		if (isset($this->request->post['filter_refer_no'])) {
			$filter_refer_no = $this->request->post['filter_refer_no'];
		} else {
			$filter_refer_no = null;
		}
		
		if (isset($this->request->post['filter_language'])) {
			$filter_language = $this->request->post['filter_language'];
		} else {
			$filter_language = null;
		}
		
		if (isset($this->request->post['filter_date_added'])) {
			$filter_created_start_date = $this->request->post['filter_date_added'];
		} else {
			$filter_created_start_date = null;
		}
		
		if (isset($this->request->post['filter_date_ended'])) {
			$filter_created_end_date = $this->request->post['filter_date_ended'];
		} else {
			$filter_created_end_date = null;
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
			'filter_name'              => $filter_name,
			'filter_phone'              => $filter_phone,
			'filter_email'              => $filter_email,
			'filter_gender'              => $filter_gender,
			'filter_student_no'              => $filter_student_no,
			'filter_user_no'              => $filter_user_no,
			'filter_refer_no'              => $filter_refer_no,
			'filter_created_start_date'              => $filter_created_start_date,
			'filter_created_end_date'              => $filter_created_end_date,
			'filter_language'              => $filter_language,
			'filter_status'            => 1,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];

		$items = array();
		$results = $this->model_student_student->getInactiveItems($filter_data);
		foreach($results['result'] as $key => $result) {
			$items[] = array(
				'id' => $result['id'],
				'student_no' => $result['student_no'],
				'student_name'   => $result['student_name'],
				'student_phone'   => $result['student_phone'],
				'student_whatsapp'   => $result['student_whatsapp'],
				'student_telegram'   => $result['student_telegram'],
				'student_gender'   => $result['student_gender'],
				'student_city'   => $result['student_city'],
				'student_country'   => $result['student_country'],
				'student_language'   => $result['student_language'],
				'student_email'   => $result['student_email'],
				'counsellor_name'   => $result['firstname'].' '.$result['lastname'].'-'.$result['user_no'],
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

		return $json;
	}

	protected function getInactiveList() {
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => 'Inactive Student',
			'href' => $this->url->link('pointbuysell/sellpoint', 'token=' . $this->session->data['token'] . $url, 'SSL')
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
		
		$data['page_length'] = $this->config->get('config_limit_admin');
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('pointbuysell/sellpoint.tpl', $data));
	}
	
	public function addpoint(){
		$json = array();
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && (strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
			if(empty($_POST['student_id'])){
				$json['error'] = 'Not a valid request. Try again';
			}
			
			if(empty($_POST['point'])){
				$json['error'] = 'Please add point';
			}
			
			global $db;
			$sell = $this->model_pointbuysell_wallet->pointSellSummeryByUser($this->user->getId());
			//echo $sell['balance'];exit;
			if (!isset($json['error'])) {
				if(!is_numeric($_POST['point'])){
					$json['error'] = 'Your need to put number for point.';
				}elseif($_POST['point']>$sell['balance']){
					$json['error'] = 'Your sell point is not sufficient to send point.';
				}
				$activation_point = $this->config->get('config_id_activation_point');
				$query = $db->query("SELECT balance_point as total FROM bh_student_passbook WHERE student_id='".$_POST['student_id']."' ORDER BY id DESC LIMIT 1");
				$current_point = $query->row;
				$require_points = $activation_point-$current_point['total'];
				
				if($_POST['point']>$require_points){
					$json['error'] = 'The student only need '.$require_points.' points. You can not send more than that.';
				}
				
				if(empty($json)){
					$passbook_id = $this->model_student_student->managePoint(array('student_id'=>$_POST['student_id'], 'reason'=>$_POST['reason'], 'description'=>'Point send for account activation', 'credit_point'=>$_POST['point'], 'debit_point'=>0, 'type'=>'Credit'));
					$db->query("INSERT INTO point_sell SET user_id = '".$this->user->getId()."', student_id='".$_POST['student_id']."', point='".(int)$_POST['point']."', type = 2, created_at='".date('Y-m-d H:i:s')."'");
					
					if($passbook_id){
						$json['success'] = 'Point successfully added into student passbook.';
					}else{
						$json['error'] = 'Point did not add into passbook due to system error. Try again';
					}
				}
			}
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}