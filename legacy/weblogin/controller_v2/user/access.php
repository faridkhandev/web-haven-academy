<?php
class ControllerUserAccess extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('user/access');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('user/access');
		$this->getList();
	}

	public function edit() {
		$this->load->language('user/access');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('user/access');
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			$this->model_user_access->saveData($this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('user/access', 'token=' . $this->session->data['token'], 'SSL'));
		}
		$this->getList();
	}

	protected function getList() {
		$data['user_group_id'] = $this->user->getGroupId();
		$this->load->model('user/user_group');
		/* $data['customer_group_id'] = $customer_group_id = $this->request->get['customer_group_id'];

		

		$customer_group_info = $this->model_user_customer_group->getCustomerGroup($this->request->get['customer_group_id']); */

		

		$data['breadcrumbs'] = array();



		$data['breadcrumbs'][] = array(

			'text' => $this->language->get('text_home'),

			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')

		);



		$data['breadcrumbs'][] = array(

			'text' =>'Access List',

			'href' => $this->url->link('user/access', 'token=' . $this->session->data['token'], 'SSL')

		);

		$data['action'] = $this->url->link('user/access/edit', 'token=' . $this->session->data['token'], 'SSL');

		

		$data['heading_title'] = 'Access List';

		

		$data['text_list'] = $this->language->get('text_list');



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
		$data['groups'] = $this->model_user_user_group->getUserGroups();
		$data['controllers'] = array();
		$results = $this->model_user_access->getAllController();
		foreach($results as $result){
			$taskresults = $this->model_user_access->getControllerTaskByControllerId($result['id']);
			$tasks = array();
			foreach ($taskresults as $taskresult) {
				$tasks[] = array(
					'ctid'          => $taskresult['ctid'],
					'controller_id' => $taskresult['controller_id'],
					'task_name'     => $taskresult['task_name'],
					'function_name' => $taskresult['function_name']
				);
			}

			$data['controllers'][] = array(
			'controller_id' => $result['id'],
			'name' 			=> $result['name'],
			'path'          => $result['path'],
			'classname'     => $result['classname'],
			'tasklist'      => $tasks
			);
		}
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('user/access.tpl', $data));
	}
}