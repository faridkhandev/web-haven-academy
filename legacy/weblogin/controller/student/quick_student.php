<?php
class ControllerStudentQuickStudent extends Controller {
	public function index() {
		// অ্যাডমিন লগইন আছে কি না তা নিশ্চিত করা
		if (!$this->user->isLogged()) {
			return $this->response->redirect($this->url->link('common/login', '', 'SSL'));
		}

		$this->document->setTitle('Quick Student List');

		$status = isset($this->request->get['status']) ? $this->request->get['status'] : 'active';
		$data['status'] = $status;
		$data['token'] = $this->session->data['token'];

		// হেডার ও ফুটার লোড
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		// ডাটাবেস টেবিল নাম (bh_student বা student যা আপনার সিস্টেমে আছে)
		$table_name = DB_PREFIX . "student";

		// ডাটাবেস কোয়েরি
		$sql = "SELECT student_id, student_no, student_name, student_phone, student_whatsapp, student_email, date_added 
		        FROM " . $table_name . " WHERE 1=1";

		if ($status == 'active') {
			$sql .= " AND status = '1'";
		} else {
			$sql .= " AND status = '0'";
		}

		$sql .= " ORDER BY student_id DESC LIMIT 500";

		$query = $this->db->query($sql);
		$data['students'] = $query->rows;

		$this->response->setOutput($this->load->view('student/quick_student.tpl', $data));
	}
}
