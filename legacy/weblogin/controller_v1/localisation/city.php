<?php 
ob_start();
class ControllerLocalisationCity extends Controller {
	private $error = array();
	
	public function __construct($params) {
		parent::__construct($params);
		
		$this->load->language('localisation/zone');
		$this->load->model('localisation/zone');
		$this->load->model('localisation/country');
		$this->load->model('localisation/city');
		$this->language->load('localisation/area');
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
			$this->model_localisation_city->addCity($this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('localisation/city', 'token=' . $this->session->data['token'], true));
		}
		$this->getForm();
	}

	public function edit() {
		$this->document->setTitle($this->language->get('heading_title'));
		$this->addFormScript();
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			//print_r($this->request->post);exit();
			$this->model_localisation_city->editCity($this->request->get['city_id'], $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('localisation/city', 'token=' . $this->session->data['token'], true));
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
			$filter_country = NULL;
		}
		
		if (isset($this->request->post['filter_zone'])) {
			$filter_zone = $this->request->post['filter_zone'];
		} else {
			$filter_zone = NULL;
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
			'filter_zone'	        => $filter_zone,
			'filter_status'	  		=> $filter_status,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];

		$items = array();

		$results = $this->model_localisation_city->getItems($filter_data);
		
		foreach($results['result'] as $key => $result) {
			$items[] = array(
				'city_id'  => $result['city_id'],
				'country'  => $result['country'],
				'zone'  => $result['zone'],
				'status'  => $result['status'],
				'action'	=>	$result['city_id'],
				'name'     => $result['name'] . (($result['city_id'] == $this->config->get('config_city_id')) ? $this->language->get('text_default') : null)
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
			'href' => $this->url->link('localisation/city', 'token=' . $this->session->data['token'], true)
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
		$data['add'] = $this->url->link('localisation/city/add', 'token=' . $this->session->data['token'], true);
		$data['delete'] = $this->url->link('localisation/city/delete', 'token=' . $this->session->data['token'], true);

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
		$data['edit'] = $this->url->link('localisation/city/edit', '&token=' . $this->session->data['token'], TRUE);
		$data['geo_zone'] = $this->url->link('localisation/geo_zone', 'token=' . $this->session->data['token'], 'SSL');
		$data['countries'] = $this->model_localisation_country->getCountries();
		$data['zones'] = $this->model_localisation_zone->getZones();
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('localisation/area_list.tpl', $data));
	}

	protected function getForm() {
		$data['user_group_id'] = $this->user->getGroupId();
		$data['heading_title'] = 'Add City';
		$data['text_form'] = !isset($this->request->get['city_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['token'] = $this->request->get['token'];
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_name'] = $this->language->get('entry_city_name');
		$data['entry_zone'] = $this->language->get('entry_state_name');
		$data['entry_country'] = $this->language->get('entry_country_name');
		$data['entry_latitude'] = $this->language->get('entry_latitude');
		$data['entry_longitude'] = $this->language->get('entry_longitude');
		$data['entry_city_type'] = $this->language->get('entry_city_type');
		$data['entry_primary'] = $this->language->get('entry_primary');
		$data['entry_secondary'] = $this->language->get('entry_secondary');
		$data['entry_image'] = $this->language->get('entry_city_image');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['help_city_type'] = $this->language->get('help_city_type');
		$data['help_image'] = $this->language->get('help_image');
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}
		if (isset($this->error['exist'])) {
			$data['error_exist'] = $this->error['exist'];
		} else {
			$data['error_exist'] = '';
		}
		if (isset($this->error['new'])) {
			$data['error_new'] = $this->error['new'];
		} else {
			$data['error_new'] = '';
		}
		
		if (isset($this->error['city_pincode'])) {
			$data['error_city_pincode'] = $this->error['city_pincode'];
		} else {
			$data['error_city_pincode'] = array();
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
			'text'      => 'City',
			'href'      => $this->url->link('localisation/city', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);
		if (!isset($this->request->get['city_id'])) {
			$data['action'] = $this->url->link('localisation/city/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('localisation/city/edit', 'token=' . $this->session->data['token'] . '&city_id=' . $this->request->get['city_id'] . $url, 'SSL');
		}
		$data['cancel'] = $this->url->link('localisation/city', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['city_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$area_info = $this->model_localisation_city->getCity($this->request->get['city_id']);
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($area_info)) {
			$data['status'] = $area_info['status'];
		} else {
			$data['status'] = '1';
		}
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($area_info)) {
			$data['name'] = $area_info['name'];
		} else {
			$data['name'] = '';
		}
		
		if (isset($this->request->post['latitude'])) {
			$data['latitude'] = $this->request->post['latitude'];
		} elseif (!empty($area_info)) {
			$data['latitude'] = $area_info['latitude'];
		} else {
			$data['latitude'] = '';
		}
		
		if (isset($this->request->post['longitude'])) {
			$data['longitude'] = $this->request->post['longitude'];
		} elseif (!empty($area_info)) {
			$data['longitude'] = $area_info['longitude'];
		} else {
			$data['longitude'] = '';
		}
		
		if (isset($this->request->post['country_id'])) {
			$data['country_id'] = $this->request->post['country_id'];
		} elseif (!empty($area_info)) {
			$data['country_id'] = $area_info['country_id'];
		} else {
			$data['country_id'] = '';
		}
		
		if (isset($this->request->post['zone_id'])) {
			$data['zone_id'] = $this->request->post['zone_id'];
		} elseif (!empty($area_info)) {
			$data['zone_id'] = $area_info['zone_id'];
		} else {
			$data['zone_id'] = '';
		}
		
		if (isset($this->request->post['city_type'])) {
			$data['city_type'] = $this->request->post['city_type'];
		} elseif (!empty($area_info)) {
			$data['city_type'] = $area_info['city_type'];
		} else {
			$data['city_type'] = '';
		}
		
		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($area_info)) {
			$data['image'] = $area_info['image'];
		} else {
			$data['image'] = '';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($area_info) && is_file(DIR_IMAGE . $area_info['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($area_info['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		$data['city_id'] = isset($this->request->get['city_id'])?$this->request->get['city_id']:0;
		$this->load->model('localisation/zone');
		$data['zones'] = $this->model_localisation_zone->getZones();
		$this->load->model('localisation/country');
		$data['countries'] = $this->model_localisation_country->getCountries();
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('localisation/area_form.tpl', $data));
	}
	
	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'localisation/city')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}
		return !$this->error;
	}
	
	public function country() {
		$json = array();
		$this->load->model('localisation/country');
		$country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);
		if ($country_info) {
			$this->load->model('localisation/zone');
			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code_3'        => $country_info['iso_code_3'],
				'address_format'    => $country_info['address_format'],
				'postcode_required' => $country_info['postcode_required'],
				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
				'status'            => $country_info['status']
			);
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function zone() {
		$json = array();
		$this->load->model('localisation/zone');
		$zone_info = $this->model_localisation_zone->getZone($this->request->get['zone_id']);
		if ($zone_info) {
			$this->load->model('localisation/city');
			$json = array(
				'zone_id'           => $zone_info['zone_id'],
				'name'              => $zone_info['name'],
				'city'              => $this->model_localisation_city->getCitiesByZoneId($this->request->get['zone_id']),
				'status'            => $zone_info['status']
			);
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function city() {
		$json = array();
		$this->load->model('localisation/city');
		$city_info = $this->model_localisation_city->getCity($this->request->get['city_id']);
		if ($city_info) {
			$this->load->model('localisation/geo_zone');
			$json = array(
				'city_id'           => $city_info['city_id'],
				'name'              => $city_info['name'],
				'geo'               => $this->model_localisation_geo_zone->getGeosByCityId($this->request->get['city_id']),
				'status'            => $city_info['status']
			);
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function saveservicezone() {
		$json = array();
		$this->load->model('localisation/city');
		$this->model_localisation_city->saveServiceZone($this->request->post['zoneId'], $this->request->post['zone']);
		$this->response->addHeader('Content-Type: application/json');
		$json['success'] = 'Data successfully updated';
		$this->response->setOutput(json_encode($json));
		/* $this->load->model('localisation/city');
		$city_info = $this->model_localisation_city->getCity($this->request->get['city_id']);
		if ($city_info) {
			$this->load->model('localisation/geo_zone');
			$json = array(
				'city_id'           => $city_info['city_id'],
				'name'              => $city_info['name'],
				'geo'               => $this->model_localisation_geo_zone->getGeosByCityId($this->request->get['city_id']),
				'status'            => $city_info['status']
			);
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));*/
	}
	
	public function addnewzone() {
		//print_r($this->request->post);exit();
		$json = array();
		$this->load->model('localisation/city');
		$this->model_localisation_city->addZone($this->request->get['city_id'], $this->request->post);
		$this->response->addHeader('Content-Type: application/json');
		$json['success'] = 'New Zone successfully updated';
		$this->response->setOutput(json_encode($json));
	}
	
	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'localisation/city')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('student/student');	
		foreach ($this->request->post['selected'] as $city_id) {
			$item_total = $this->model_student_student->getTotalStudents(array('filter_district'=>$city_id));
			if ($item_total) {
				$this->error['warning'] = sprintf('Total %s students added, you can not delete', $item_total);
			}
		}

		return !$this->error;
	}
}
?>