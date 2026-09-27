<?php
class ControllerDashboardLocation extends Controller {
	public function index() {
		$this->load->model('localisation/location');
		$results = $this->model_localisation_location->getItems();
		$data['heading_title'] = 'Area List';
		$data['text_view'] = 'View All';
		$data['token'] = $this->session->data['token'];
		$data['link'] = $this->url->link('localisation/location', 'token=' . $this->session->data['token'], 'SSL');
		$data['count'] =$results['recordsTotal'];
		return $this->load->view('dashboard/location.tpl', $data);
	}
}