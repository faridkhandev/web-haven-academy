<?php
class ControllerWelcomeDailybest extends Controller {
	private $error = array();
	
	public function __construct($params) {
		parent::__construct($params);
		$this->load->model('welcome/dailybest');
		$this->load->model('tool/image');
		$this->load->language('welcome/dailybest');
	}
	
	public function index() {
		$this->document->setTitle($this->language->get('heading_title'));
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$data = $this->request->post;
			$this->model_welcome_dailybest->save($data);

			$this->session->data['success'] = 'Data saved successfully.';
			$this->response->redirect($this->url->link('welcome/dailybest', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->getForm();
	}
	
	protected function getForm() {
		$data['user_group_id'] = $this->user->getGroupId();
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_username'] = $this->language->get('entry_username');
		$data['entry_user_group'] = $this->language->get('entry_user_group');
		$data['entry_password'] = $this->language->get('entry_password');
		$data['entry_confirm'] = $this->language->get('entry_confirm');
		$data['entry_firstname'] = $this->language->get('entry_firstname');
		$data['entry_lastname'] = $this->language->get('entry_lastname');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

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
			'href' => $this->url->link('welcome/dailybest', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('welcome/dailybest', 'token=' . $this->session->data['token'], 'SSL');

		$info = $this->model_welcome_dailybest->get();

		foreach($info as $person){
			if (is_file(DIR_IMAGE . $person['entity_image'])) {
				$image = $this->model_tool_image->resize($person['entity_image'], 100, 100);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 100, 100);
			}
			
			$data['dailybest'][] = array('id'=>$person['id'], 'type'=>$person['type'], 'entity_name'=>$person['entity_name'], 'entity_no'=>$person['entity_no'], 'entity_description'=>$person['entity_description'], 'thumb'=>$image, 'entity_image'=>$person['entity_image']);
		}
		
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('welcome/dailybest_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'welcome/dailybest')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}