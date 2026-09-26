<?php
class ControllerToolReset extends Controller {
	private $error = array();
	
	public function __construct($params) {
		parent::__construct($params);
		$this->load->language('tool/reset');
		if($this->user->getGroupId() != 0) {
			$this->response->redirect($this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'));
		}
	}
	
	public function index() {
		$data['user_group_id'] = $this->user->getGroupId();
		$this->load->language('tool/reset');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_list'] = $this->language->get('text_list');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['button_clear'] = $this->language->get('button_clear');

		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];

			unset($this->session->data['error']);
		} elseif (isset($this->error['warning'])) {
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

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('tool/reset', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['clear'] = $this->url->link('tool/reset/clear', 'token=' . $this->session->data['token'], 'SSL');

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('tool/reset.tpl', $data));
	}

	public function clear() {
		$this->load->language('tool/reset');
		
		if($this->user->getGroupId() != 0) {
			$this->session->data['error'] = $this->language->get('error_permission');
		}	

		if (!$this->user->hasPermission('modify', 'tool/reset')) {
			$this->session->data['error'] = $this->language->get('error_permission');
		} else {
			$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "booking_order");//sales order
			$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "booking_order_details"); //sales order detail
			$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "invoice"); //sales order invoice
			$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "invoice_details");  //sales order invoice details
			$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "invoice_to_ledger_head");  //sales order invoice to ledger head
			$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "itinerary"); // service itinerary
			$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "ledger"); // sales order or purchase order ledger
			$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "ledger_details");  // sales order or purchase order ledger details
			$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "newsticker"); // notification newsticker
			$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product_purchase"); //old system
			$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product_purchase_receive"); //old system
			$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "purchase_order"); // product order/purchase from supplier
			$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "purchase_order_details"); // product order/purchase details from supplier
			$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "purchase_order_receive"); // product order/purchase receive
			$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product_stock"); //product stock entry
			$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product_stock_batch_history"); //product stock history(purchase/delivery) batch wise for  
			$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "voucher"); // product order from supplier	voucher
			$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "voucher_details");  // product order from supplier voucher details
			$this->session->data['success'] = $this->language->get('text_success');
		}

		$this->response->redirect($this->url->link('tool/reset', 'token=' . $this->session->data['token'], 'SSL'));
	}
}