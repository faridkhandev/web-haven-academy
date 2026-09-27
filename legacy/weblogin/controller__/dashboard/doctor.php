<?php
class ControllerDashboardDoctor extends Controller {
	public function index() {
		$this->load->model('module/doctor');
		$results = $this->model_module_doctor->getItems();
		$data['heading_title'] = 'Doctor List';
		$data['text_view'] = 'List View';
		$data['token'] = $this->session->data['token'];
		$data['link'] = $this->url->link('module/doctor', 'token=' . $this->session->data['token'], 'SSL');
		$data['count'] = $results['recordsTotal'];
		return $this->load->view('dashboard/doctor.tpl', $data);
	}
}