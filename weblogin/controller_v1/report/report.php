<?php
// reference the Dompdf namespace
use Dompdf\Dompdf;
class ControllerReportReport extends Controller {
	private $error = array();
	
	public function __construct($params) {
		parent::__construct($params);
		$this->load->model('report/report');
		$this->load->language('report/report');
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
	
	public function view() {
		$this->document->setTitle($this->language->get('heading_title'));
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && (strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($this->getDetailItems()));
		} else {
			$this->getDetailList();
		}
	}
	
	private function getDetailItems() {
		$report_info = $this->model_report_report->get($this->request->get['id']);
		$data_filter = json_decode($report_info['report_filter'], true);
		foreach($data_filter as $key => $input){
			if (isset($this->request->post[$input['name']])) {
				$filter[$input['name']] = $this->request->post[$input['name']];
			} else {
				$filter[$input['name']] = NULL;
			}
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
			'filter_report_id'	        => $this->request->get['id'],
			'filter'	        => $filter,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];

		$items = array();

		$results = $this->model_report_report->getSingleItems($filter_data);

		$json = array(
			'draw'				=>	(int)$this->request->post['draw'],
			'recordsTotal'		=>	$results['recordsTotal'],
			'recordsFiltered'	=>	$results['recordsFiltered'],
			'data'				=>	$results['result'],
		);

		return $json;
	}
	
	private function getItems() {
		if (isset($this->request->post['filter_name'])) {
			$filter_name = $this->request->post['filter_name'];
		} else {
			$filter_name = NULL;
		}
		
		if (isset($this->request->post['filter_status'])) {
			$filter_status = $this->request->post['filter_status'];
		} else {
			$filter_status = NULL;
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
			'filter_status'	  		=> $filter_status,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];

		$items = array();

		$results = $this->model_report_report->getItems($filter_data);
		
		foreach($results['result'] as $key => $result) {
			$items[] = array(
				'id' => $result['id'],
				'name'       => $result['name'],
				'status'     => $result['status'],
				'sort_order'     => $result['sort_order'],
				'date_added'			=>	date($this->config->get('config_date_format'), strtotime($result['date_added'])),
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
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('report/report', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['delete'] = $this->url->link('report/report/delete', 'token=' . $this->session->data['token'], 'SSL');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_category_name'] = $this->language->get('column_category_name');
		$data['column_category_status'] = $this->language->get('column_category_status');
		$data['column_category_added'] = $this->language->get('column_category_added');
		$data['column_category_sort'] = $this->language->get('column_category_sort');
		$data['column_category_action'] = $this->language->get('column_category_action');
		
		$data['entry_category_name'] = $this->language->get('entry_category_name');
		$data['entry_category_description'] = $this->language->get('entry_category_description');
		$data['entry_category_status'] = $this->language->get('entry_category_status');
		
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
		$data['view'] = $this->url->link('report/report/view', '&token=' . $this->session->data['token'], TRUE);
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('report/report_list.tpl', $data));
	}
	
	protected function getDetailList() {
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('report/report', 'token=' . $this->session->data['token'], 'SSL')
		);
		
		$report_info = $this->model_report_report->get($this->request->get['id']);
		
		$data['breadcrumbs'][] = array(
			'text' => $report_info['name'],
			'href' => $this->url->link('report/report/view', 'token=' . $this->session->data['token'].'&id='.$this->request->get['id'], 'SSL')
		);

		$data['heading_title'] = $report_info['name'];

		$data['text_list'] = $report_info['name'].' List';
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column'] = json_decode($report_info['report_column'], true);
		$total_column = count(json_decode($report_info['report_column'], true));
		$data['export_column'] = [];
		for($i=0;$i<$total_column;$i++){
			$data['export_column'][]=$i;
		}
		$data['fields'] = json_decode($report_info['report_fields'], true);
		$data['filter'] = json_decode($report_info['report_filter'], true);
		$data['id'] = $this->request->get['id'];
		
		$data['entry_category_name'] = $this->language->get('entry_category_name');
		$data['entry_category_description'] = $this->language->get('entry_category_description');
		$data['entry_category_status'] = $this->language->get('entry_category_status');
		
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
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('report/report_detail_list.tpl', $data));
	}
}