<?php
// reference the Dompdf namespace
use Dompdf\Dompdf;
class ControllerReportNotification extends Controller {
	private $error = array();
	
	public function __construct($params) {
		parent::__construct($params);
		$this->load->model('module/doctor');
		$this->load->model('report/notification');
		$this->load->model('localisation/zone');		
		$this->load->model('tool/image');
		$this->load->language('report/notification');
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
		if (isset($this->request->post['filter_name'])) {
			$filter_name = $this->request->post['filter_name'];
		} else {
			$filter_name = NULL;
		}
		
		if (isset($this->request->post['filter_doctor_id'])) {
			$filter_doctor_id = $this->request->post['filter_doctor_id'];
		} else {
			$filter_doctor_id = NULL;
		}
		
		if (isset($this->request->post['filter_minimum_investment_amount'])) {
			$filter_minimum_investment_amount = $this->request->post['filter_minimum_investment_amount'];
		} else {
			$filter_minimum_investment_amount = NULL;
		}
		
		if (isset($this->request->post['filter_maximum_investment_amount'])) {
			$filter_maximum_investment_amount = $this->request->post['filter_maximum_investment_amount'];
		} else {
			$filter_maximum_investment_amount = NULL;
		}
		
		if (isset($this->request->post['filter_minimum_limit_amount'])) {
			$filter_minimum_limit_amount = $this->request->post['filter_minimum_limit_amount'];
		} else {
			$filter_minimum_limit_amount = NULL;
		}
		
		if (isset($this->request->post['filter_maximum_limit_amount'])) {
			$filter_maximum_limit_amount = $this->request->post['filter_maximum_limit_amount'];
		} else {
			$filter_maximum_limit_amount = NULL;
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
			'filter_minimum_limit_amount'	  		=> $filter_minimum_limit_amount,
			'filter_maximum_limit_amount' 	=> $filter_maximum_limit_amount,
			'filter_minimum_investment_amount'   	=> $filter_minimum_investment_amount,
			'filter_maximum_investment_amount'   		=> $filter_maximum_investment_amount,
			'filter_start_date' 	=> $filter_start_date,
			'filter_end_date'   	=> $filter_end_date,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];

		$items = array();

		$results = $this->model_report_notification->getItems($filter_data);
		foreach($results['result'] as $key => $result) {
			$items[] = array(
				'notification_id' => $result['notification_id'],
				'doctor_id' => $result['doctor_id'],
				'doctor_name'       => $result['doctor_name'],
				'investment_amount'       => $result['investment_amount'],
				'limit_amount'       => $result['limit_amount'],
				'description'       => $result['description'],
				'link'       => '<a href="'.$this->url->link('module/investment', 'token=' . $this->session->data['token'].'&doctor_investment_id='.$result['doctor_investment_id'], 'SSL').'" target="_blank">View Investment</a>',
				'doctor_date_added'			=>	date($this->config->get('config_date_format'), strtotime($result['date_added'])),
				'action'				=>	$result['notification_id']
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
			'href' => $this->url->link('report/notification', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['heading_title'] = 'Doctor Investment Notification List';

		$data['text_list'] = 'Notification Report';
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
		$data['page_length'] = $this->config->get('config_limit_admin');
		$doctors = $this->model_module_doctor->getItems(array('filter_status'=>1));
		$data['doctors'] = $doctors['result'];
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('report/notification_list.tpl', $data));
	}
}	