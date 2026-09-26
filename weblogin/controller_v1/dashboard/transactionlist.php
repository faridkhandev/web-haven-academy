<?php
class ControllerDashboardTransactionlist extends Controller {
	public function index() {
		$this->load->model('module/transaction');
		$data['heading_title'] = 'Transaction List';
		$data['text_view'] = 'List View';
		$data['token'] = $this->session->data['token'];
		$data['link'] = $this->url->link('module/transaction', 'token=' . $this->session->data['token'], 'SSL');
		
	    /* 
	    $results = $this->model_dashboard_invoice->getInvoices($filter_data);

		foreach ($results as $result) {
			$data['invoices'][] = array(
				'invoice_no'   => $result['invoice_no'],
				'customername'   => $result['firstname'].' '.$result['lastname'],
				'email'   => $result['email'],
				'name'   => $result['name'],
				'microchip_number'   => $result['microchip_number'],
				'checkin_date'   => $result['checkin_date'].' '.$result['checkin_time'],
				'checkout_date'   => $result['checkout_date'].' '.$result['checkout_time'],
				'payment_mode'     => (($result['payment_mode']==1)?'Bank':(($result['payment_mode']==2)?'Card':(($result['payment_mode']==3)?'Cash':(($result['payment_mode']==4)?'Cheque':'Other')))),
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'total'      => $grand_total,
				'view'       => $this->url->link('boarding/entry/info', 'token=' . $this->session->data['token'] . '&boarding_id=' . $result['boarding_id'], 'SSL'),
				'pdf'       => $this->url->link('boarding/entry/invoice', 'token=' . $this->session->data['token'] . '&boarding_id=' . $result['boarding_id'], 'SSL'),
			);
		}*/
		return $this->load->view('dashboard/transactionlist.tpl', $data);
	}
}