<?php
class ControllerCommonFooter extends Controller {

	public function __construct($params) {
		parent::__construct($params);
		$this->load->language('common/footer');
	}

	public function index() {
		$data['text_footer'] = $this->language->get('text_footer');

		if ($this->user->isLogged() && isset($this->request->get['token']) && ($this->request->get['token'] == $this->session->data['token'])) {
			$data['text_version'] = sprintf($this->language->get('text_version'), VERSION);
		} else {
			$data['text_version'] = '';
		}

		if (isset($this->session->data['text_success'])) {
			$data['text_success'] = $this->session->data['text_success'];
			unset($this->session->data['text_success']);
		} else {
			$data['text_success'] = '';
		}

		if (isset($this->session->data['text_error'])) {
			$data['text_error'] = $this->session->data['text_error'];
			unset($this->session->data['text_error']);
		} else {
			$data['text_error'] = '';
		}
		$data['ripayment'] = $this->url->link('report/ripayment', 'token=' . $this->session->data['token'], true);
		$data['monthlyincome'] = $this->url->link('report/monthlyincome', 'token=' . $this->session->data['token'], true);
			
		$data['token'] = $this->session->data['token'];
		$data['modal'] = $this->load->controller('common/modal');
		$data['token'] = $this->session->data['token'];
		$data['text_application'] = $this->language->get('text_application');
		$data['text_copyright'] = $this->language->get('text_copyright');
		$data['text_version'] = $this->language->get('text_version');
		$data['developer_logo'] = HTTPS_IMAGE . 'catalog/sd.png';
		$data['text_developer_copyright'] = $this->language->get('text_developer_copyright');
		return $this->load->view('common/footer.tpl', $data);
	}
}
