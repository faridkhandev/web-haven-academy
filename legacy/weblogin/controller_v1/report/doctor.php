<?php
// reference the Dompdf namespace
use Dompdf\Dompdf;
class ControllerReportDoctor extends Controller {
	private $error = array();
	
	public function __construct($params) {
		parent::__construct($params);
		$this->load->model('module/doctor');
		$this->load->model('module/investment');
		$this->load->model('report/doctor');
		$this->load->model('localisation/zone');		
		$this->load->model('tool/image');
		$this->load->language('module/doctor');
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
		if (isset($this->request->post['filter_doctor_id'])) {
			$filter_doctor_id = $this->request->post['filter_doctor_id'];
		}elseif(isset($this->request->get['filter_doctor_id'])){
			$filter_doctor_id = $this->request->get['filter_doctor_id'];
		}else {
			$filter_doctor_id = NULL;
		}
		
		if (isset($this->request->post['filter_investment_id'])) {
			$filter_investment_id = $this->request->post['filter_investment_id'];
		}else {
			$filter_investment_id = NULL;
		}
		
		if (isset($this->request->post['filter_name'])) {
			$filter_name = $this->request->post['filter_name'];
		} else {
			$filter_name = NULL;
		}
		
		if (isset($this->request->post['filter_area_id'])) {
			$filter_area = $this->request->post['filter_area_id'];
		} else {
			$filter_area = NULL;
		}

		if (isset($this->request->post['filter_start_date'])) {
			$filter_start_date = $this->request->post['filter_start_date'];
		} else {
			$filter_start_date = NULL;
		}

		if (isset($this->request->post['filter_end_date'])) {
			$filter_end_date = $this->request->post['filter_end_date'];
		} else {
			$filter_end_date = NULL;
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
			'filter_name'	        => $filter_name,
			'filter_doctor_id'	    => $filter_doctor_id,
			'filter_investment_id'	    => $filter_investment_id,
			'filter_state'	  		=> $filter_state,
			'filter_city'	  		=> $filter_city,
			'filter_area'	  		=> $filter_area,
			'filter_start_date' 	=> $filter_start_date,
			'filter_end_date'   	=> $filter_end_date,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];

		$items = array();

		$results = $this->model_report_doctor->getItems($filter_data);
		
		foreach($results['result'] as $key => $result) {
			$items[] = array(
				'doctor_transaction_id' => $result['doctor_transaction_id'],
				'doctor_name'       => $result['doctor_name'],
				'doctor_investment_id'       => $result['doctor_investment_id'].'&nbsp;<a href="'.$this->url->link('module/investment', 'token=' . $this->session->data['token'].'&doctor_investment_id='.$result['doctor_investment_id'], 'SSL').'" class="label label-success" target="_blank"><i class="fa fa-eye"></i></a>',
				'description'       => $result['description'],
				'amount'       => $result['amount'],
				'investment_amount'       => $result['investment_amount'],
				'limit_amount'       => $result['limit_amount'],
				'location_name'       => $result['location_name'].'-'.$result['city_name'].'-'.$result['zone_name'],
				'date_added'			=>	date($this->config->get('config_date_format'), strtotime($result['date_added'])),
				'action'				=>	$result['doctor_transaction_id']
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
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('report/doctor', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		
		$data['button_copy'] = $this->language->get('button_copy');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['button_reset_filter'] = $this->language->get('button_reset_filter');

		$data['token'] = $this->session->data['token'];

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
		$doctors = $this->model_module_doctor->getItems(array('filter_status'=>1));
		
		if(isset($this->request->get['filter_doctor_id'])){
			$filter_doctor_id = $this->request->get['filter_doctor_id'];
		}else {
			$filter_doctor_id = NULL;
		}
		
		
		$data['summmery'] = $this->model_report_doctor->calculateReturn(array('filter_doctor_id'=>$filter_doctor_id));
		$data['doctors'] = $doctors['result'];
		$data['page_length'] = $this->config->get('config_limit_admin');
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('report/doctor_list.tpl', $data));
	}
	
	public function calculation(){
		if (isset($this->request->post['filter_doctor_id'])) {
			$filter_doctor_id = $this->request->post['filter_doctor_id'];
		}else{
			$filter_doctor_id = NULL;
		}

		if (isset($this->request->post['filter_start_date'])) {
			$filter_start_date = $this->request->post['filter_start_date'];
		} else {
			$filter_start_date = NULL;
		}

		if (isset($this->request->post['filter_end_date'])) {
			$filter_end_date = $this->request->post['filter_end_date'];
		} else {
			$filter_end_date = NULL;
		}
		
		$result = $this->model_report_doctor->calculateReturn(array('filter_doctor_id'=>$filter_doctor_id,'filter_start_date'=>$filter_start_date,'filter_end_date'=>$filter_end_date));
		
		$view = array('investment'=>$result['investment'],'sales'=>$result['sales'],'percentage'=>$result['percentage']);
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($view));
	}
}	