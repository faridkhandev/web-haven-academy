<?php
class ControllerLocalisationZone extends Controller {
	private $error = array();
	
	public function __construct($params) {
		parent::__construct($params);
		
		$this->load->language('localisation/zone');
		$this->load->model('localisation/zone');
		$this->load->model('localisation/country');
		$this->load->model('localisation/city');
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
			$this->model_localisation_zone->add($this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('localisation/zone', 'token=' . $this->session->data['token'], true));
		}
		$this->getForm();
	}

	public function edit() {
		$this->document->setTitle($this->language->get('heading_title'));
		$this->addFormScript();
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_localisation_zone->edit($this->request->get['zone_id'], $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('localisation/zone', 'token=' . $this->session->data['token'], true));
		}
		$this->getForm();
	}

	public function delete() {
		$this->document->setTitle($this->language->get('heading_title'));
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $zone_id) {
				$this->model_localisation_zone->delete($zone_id);
			}
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('localisation/zone', 'token=' . $this->session->data['token'], true));
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
			'filter_status'	  		=> $filter_status,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];

		$items = array();

		$results = $this->model_localisation_zone->getItems($filter_data);
		
		foreach($results['result'] as $key => $result) {
			$items[] = array(
				'zone_id' => $result['zone_id'],
				'country' => $result['country'],
				'name'    => $result['name'] . (($result['zone_id'] == $this->config->get('config_zone_id')) ? $this->language->get('text_default') : null),
				'code'    => $result['code'],
				'action'	=>	$result['zone_id'],
				'status'  =>	$result['status'],
				'edit'    => $this->url->link('localisation/zone/edit', 'token=' . $this->session->data['token'] . '&zone_id=' . $result['zone_id'], 'SSL')
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
			'href' => $this->url->link('localisation/zone', 'token=' . $this->session->data['token'], true)
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
		$data['add'] = $this->url->link('localisation/zone/add', 'token=' . $this->session->data['token'], true);
		$data['delete'] = $this->url->link('localisation/zone/delete', 'token=' . $this->session->data['token'], true);

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
		$data['edit'] = $this->url->link('localisation/zone/edit', '&token=' . $this->session->data['token'], TRUE);
		$data['countries'] = $this->model_localisation_country->getCountries();
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('localisation/zone_list.tpl', $data));
	}
	
	protected function getForm() {
		$data['user_group_id'] = $this->user->getGroupId();
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['zone_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_code'] = $this->language->get('entry_code');
		$data['entry_country'] = $this->language->get('entry_country');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

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
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('localisation/zone', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['zone_id'])) {
			$data['action'] = $this->url->link('localisation/zone/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('localisation/zone/edit', 'token=' . $this->session->data['token'] . '&zone_id=' . $this->request->get['zone_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('localisation/zone', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['zone_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$zone_info = $this->model_localisation_zone->getZone($this->request->get['zone_id']);
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($zone_info)) {
			$data['status'] = $zone_info['status'];
		} else {
			$data['status'] = '1';
		}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($zone_info)) {
			$data['name'] = $zone_info['name'];
		} else {
			$data['name'] = '';
		}

		if (isset($this->request->post['code'])) {
			$data['code'] = $this->request->post['code'];
		} elseif (!empty($zone_info)) {
			$data['code'] = $zone_info['code'];
		} else {
			$data['code'] = '';
		}

		if (isset($this->request->post['country_id'])) {
			$data['country_id'] = $this->request->post['country_id'];
		} elseif (!empty($zone_info)) {
			$data['country_id'] = $zone_info['country_id'];
		} else {
			$data['country_id'] = '';
		}

		$this->load->model('localisation/zone');

		$data['countries'] = $this->model_localisation_country->getCountries();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('localisation/zone_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'localisation/zone')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'localisation/zone')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('localisation/area');

		foreach ($this->request->post['selected'] as $zone_id) {
			if ($this->config->get('config_zone_id') == $zone_id) {
				$this->error['warning'] = $this->language->get('error_default');
			}

			$zone_total = $this->model_localisation_area->getTotalAreasByZoneId($zone_id);

			if ($zone_total) {
				$this->error['warning'] = sprintf($this->language->get('error_zone'), $zone_total);
			}
		}

		return !$this->error;
	}
	
	public function zone() {
		$json = array();

		$zone_info = $this->model_localisation_zone->getZone($this->request->get['zone_id']);

		if ($zone_info) {

			$json = array(
				'zone_id'        	=> $zone_info['zone_id'],
				'country_id'        => $zone_info['country_id'],
				'name'              => $zone_info['name'],
				'code'        		=> $zone_info['code'],
				'city'              => $this->model_localisation_city->getCitiesByZoneId($this->request->get['zone_id']),
				'status'            => $zone_info['status']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function doctorzone() {
		$json = array();

		$zones = $this->model_localisation_zone->getDoctorZones($this->request->get['doctor_id']);

		$json = array('zone' => $zones);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function doctorarea() {
		$json = array();

		$areas = $this->model_localisation_zone->getDoctorAreas($this->request->get['doctor_id']);

		$json = array('areas' => $areas);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}