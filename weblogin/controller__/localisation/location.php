<?php 
ob_start();
class ControllerLocalisationLocation extends Controller {
	private $error = array();
	
	public function __construct($params) {
		parent::__construct($params);
		
		$this->load->model('localisation/zone');
		$this->load->model('localisation/country');
		$this->load->model('localisation/city');
		$this->load->model('localisation/location');
		$this->language->load('localisation/location');
	}

	private function addFormScript() {
		$this->document->addScript('https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js');
		$this->document->addScript('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js');
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
	
	public function add() {
		$this->document->setTitle($this->language->get('heading_title'));
		$this->addFormScript();
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			//print_r($this->request->post);exit();
			$this->model_localisation_location->add($this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('localisation/location', 'token=' . $this->session->data['token'], true));
		}
		$this->getForm();
	}

	public function edit() {
		$this->document->setTitle($this->language->get('heading_title'));
		$this->addFormScript();
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			//print_r($this->request->post);exit();
			$this->model_localisation_location->edit($this->request->get['location_id'], $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('localisation/location', 'token=' . $this->session->data['token'], true));
		}
		$this->getForm();
	}
	
	public function delete() {
		$this->document->setTitle($this->language->get('heading_title'));
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $city_id) {
				$this->model_localisation_city->delete($city_id);
			}
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('localisation/city', 'token=' . $this->session->data['token'], true));
		}

		$this->getList();
	}

	private function getItems() {
		if (isset($this->request->post['filter_name'])) {
			$filter_name = $this->request->post['filter_name'];
		} else {
			$filter_name = NULL;
		}
		
		if (isset($this->request->post['filter_country'])) {
			$filter_country = $this->request->post['filter_country'];
		} else {
			$filter_country = 99;
		}
		
		if (isset($this->request->post['filter_state'])) {
			$filter_state = $this->request->post['filter_state'];
		} else {
			$filter_state = NULL;
		}
		
		if (isset($this->request->post['filter_city'])) {
			$filter_city = $this->request->post['filter_city'];
		} else {
			$filter_city = NULL;
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
			'filter_country'	    => $filter_country,
			'filter_state'	        => $filter_state,
			'filter_city'	        => $filter_city,
			'filter_status'	  		=> $filter_status,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];

		$items = array();

		$results = $this->model_localisation_location->getItems($filter_data);
		
		foreach($results['result'] as $key => $result) {
			$items[] = array(
				'location_id'  => $result['location_id'],
				'location_name'  => $result['location_name'],
				'country'  => $result['country'],
				'zone'  => $result['zone'],
				'city'  => $result['city'],
				'status'  => $result['location_status'],
				'action'	=>	$result['location_id']
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

	private function getList() {
		$data['breadcrumbs'] = [];
		$data['breadcrumbs'][] = [
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		];
		$data['breadcrumbs'][] = [
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('localisation/location', 'token=' . $this->session->data['token'], true)
		];

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['text_records_per_page'] = $this->language->get('text_records_per_page');
		$data['text_column_edit'] = $this->language->get('text_column_edit');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['button_refresh'] = $this->language->get('button_refresh');

		$data['token'] = $this->session->data['token'];
		$data['add'] = $this->url->link('localisation/location/add', 'token=' . $this->session->data['token'], true);
		$data['delete'] = $this->url->link('localisation/location/delete', 'token=' . $this->session->data['token'], true);

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else if (isset($this->session->data['warning'])) {
			$data['warning'] = $this->session->data['warning'];
			unset($this->session->data['warning']);
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
		$data['edit'] = $this->url->link('localisation/location/edit', '&token=' . $this->session->data['token'], TRUE);
		$data['zones'] = $this->model_localisation_zone->getZones(array('filter_country'=>99));
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('localisation/location_list.tpl', $data));
	}

	protected function getForm() {
		$data['user_group_id'] = $this->user->getGroupId();
		$data['heading_title'] = 'Add City Location';
		$data['text_form'] = !isset($this->request->get['location_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['token'] = $this->request->get['token'];
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		
		if (isset($this->error['location_name'])) {
			$data['error_location_name'] = $this->error['location_name'];
		} else {
			$data['error_location_name'] = '';
		}
		
		if (isset($this->error['zone_id'])) {
			$data['error_zone_id'] = $this->error['zone_id'];
		} else {
			$data['error_zone_id'] = '';
		}
		
		if (isset($this->error['city_id'])) {
			$data['error_city_id'] = $this->error['city_id'];
		} else {
			$data['error_city_id'] = '';
		}

		$url = '';
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),  		
			'separator' => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => 'Area/Location',
			'href'      => $this->url->link('localisation/location', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);
		if (!isset($this->request->get['location_id'])) {
			$data['action'] = $this->url->link('localisation/location/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('localisation/location/edit', 'token=' . $this->session->data['token'] . '&location_id=' . $this->request->get['location_id'] . $url, 'SSL');
		}
		$data['cancel'] = $this->url->link('localisation/location', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['location_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$area_info = $this->model_localisation_location->get($this->request->get['location_id']);
		}

		if (isset($this->request->post['location_status'])) {
			$data['status'] = $this->request->post['location_status'];
		} elseif (!empty($area_info)) {
			$data['status'] = $area_info['location_status'];
		} else {
			$data['status'] = '1';
		}
		if (isset($this->request->post['location_name'])) {
			$data['location_name'] = $this->request->post['location_name'];
		} elseif (!empty($area_info)) {
			$data['location_name'] = $area_info['location_name'];
		} else {
			$data['location_name'] = '';
		}
		
		if (isset($this->request->post['zone_id'])) {
			$data['zone_id'] = $this->request->post['zone_id'];
		} elseif (!empty($area_info)) {
			$data['zone_id'] = $area_info['zone_id'];
		} else {
			$data['zone_id'] = '';
		}
		
		if (isset($this->request->post['city_id'])) {
			$data['city_id'] = $this->request->post['city_id'];
		} elseif (!empty($area_info)) {
			$data['city_id'] = $area_info['city_id'];
		} else {
			$data['city_id'] = '';
		}

		$data['location_id'] = isset($this->request->get['location_id'])?$this->request->get['location_id']:0;
		$data['zones'] = $this->model_localisation_zone->getZones(array('filter_country'=>99));
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('localisation/location_form.tpl', $data));
	}
	
	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'localisation/location')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['location_name']) < 1) || (utf8_strlen($this->request->post['location_name']) > 64)) {
			$this->error['location_name'] = $this->language->get('error_name');
		}
		
		if (utf8_strlen($this->request->post['zone_id']) == 0) {
			$this->error['zone_id'] = 'Please select state';
		}
		
		if (utf8_strlen($this->request->post['city_id']) == 0) {
			$this->error['city_id'] = 'Please select city';
		}
		return !$this->error;
	}
	
	public function city() {
		$json = array();
		$this->load->model('localisation/city');
		$city_info = $this->model_localisation_city->getCity($this->request->get['city_id']);
		if ($city_info) {
			$this->load->model('localisation/location');
			$results = $this->model_localisation_location->getItems(array('filter_city'=>$this->request->get['city_id']));
			$json = array(
				'city_id'           => $city_info['city_id'],
				'name'              => $city_info['name'],
				'location'               => $results['result'],
				'status'            => $city_info['status']
			);
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'localisation/location')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		/* $this->load->model('student/student');	
		foreach ($this->request->post['selected'] as $location_id) {
			$item_total = $this->model_student_student->getTotalStudents(array('filter_district'=>$location_id));
			if ($item_total) {
				$this->error['warning'] = sprintf('Total %s students added, you can not delete', $item_total);
			}
		} */

		return !$this->error;
	}
}
?>