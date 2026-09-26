<?php
class ControllerModuleTeacherAttendance extends Controller {
	private $error = array();

	public function index() {
		$this->document->setTitle('Teacher Attendance Summary');
		$this->document->addStyle('view/stylesheet/teacher_attendance.css');

		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => 'Home',
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);
		$data['breadcrumbs'][] = array(
			'text' => 'Teacher Attendance',
			'href' => $this->url->link('module/teacher_attendance', 'token=' . $this->session->data['token'], true)
		);

		$data['heading_title'] = 'Teacher Attendance Summary';
		$data['token'] = $this->session->data['token'];
		$data['reset'] = $this->url->link('module/teacher_attendance', 'token=' . $this->session->data['token'], true);
		
		$data['clear_data'] = $this->url->link('module/teacher_attendance/clearData', 'token=' . $this->session->data['token'], true);

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->session->data['error_warning'])) {
			$data['error_warning'] = $this->session->data['error_warning'];
			unset($this->session->data['error_warning']);
		} else {
			$data['error_warning'] = '';
		}

		$filter_name = isset($this->request->get['filter_name']) ? trim($this->request->get['filter_name']) : '';
		$data['filter_name'] = $filter_name;

		// লিংক ও সেশন আলাদা কাউন্ট করার কোয়েরি
		$sql = "SELECT teacher_name, 
				COUNT(id) as total_links, 
				SUM(CASE 
					WHEN session_no IS NOT NULL AND TRIM(session_no) != '' 
					THEN (LENGTH(session_no) - LENGTH(REPLACE(session_no, ',', '')) + 1) 
					ELSE 1 
				END) as total_sessions, 
				MAX(submitted_at) as last_submitted 
				FROM bh_teacher_attendance";
				
		if (!empty($filter_name)) {
			$sql .= " WHERE teacher_name LIKE '%" . $this->db->escape($filter_name) . "%'";
		}
		$sql .= " GROUP BY teacher_name ORDER BY total_sessions DESC";

		$query = $this->db->query($sql);

		$data['teachers'] = array();

		if (!empty($query->rows)) {
			foreach ($query->rows as $row) {
				$data['teachers'][] = array(
					'teacher_name'   => $row['teacher_name'],
					'total_links'    => $row['total_links'],
					'total_sessions' => $row['total_sessions'],
					'last_submitted' => !empty($row['last_submitted']) ? date('Y-m-d h:i A', strtotime($row['last_submitted'])) : '',
					'view_link'      => $this->url->link('module/teacher_attendance/details', 'token=' . $this->session->data['token'] . '&teacher_name=' . urlencode($row['teacher_name']), true)
				);
			}
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/teacher_attendance.tpl', $data));
	}

	public function details() {
		$teacher_name = isset($this->request->get['teacher_name']) ? trim($this->request->get['teacher_name']) : '';

		$this->document->setTitle('Attendance Details - ' . $teacher_name);
		$this->document->addStyle('view/stylesheet/teacher_attendance.css');

		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => 'Home',
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);
		$data['breadcrumbs'][] = array(
			'text' => 'Teacher Attendance',
			'href' => $this->url->link('module/teacher_attendance', 'token=' . $this->session->data['token'], true)
		);
		$data['breadcrumbs'][] = array(
			'text' => $teacher_name,
			'href' => '#'
		);

		$data['heading_title'] = 'Attendance Logs: ' . $teacher_name;
		$data['token'] = $this->session->data['token'];
		$data['back'] = $this->url->link('module/teacher_attendance', 'token=' . $this->session->data['token'], true);

		$data['clear_teacher_data'] = $this->url->link('module/teacher_attendance/clearTeacherData', 'token=' . $this->session->data['token'] . '&teacher_name=' . urlencode($teacher_name), true);

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$query = $this->db->query("SELECT * FROM bh_teacher_attendance WHERE teacher_name = '" . $this->db->escape($teacher_name) . "' ORDER BY submitted_at DESC");
		
		$data['records'] = array();
		if (!empty($query->rows)) {
			foreach ($query->rows as $row) {
				$data['records'][] = array(
					'id'           => $row['id'],
					'session_no'   => isset($row['session_no']) ? $row['session_no'] : '',
					'meeting_link' => isset($row['meeting_link']) ? $row['meeting_link'] : '',
					'submitted_at' => !empty($row['submitted_at']) ? date('Y-m-d h:i:s A', strtotime($row['submitted_at'])) : '',
					'delete'       => $this->url->link('module/teacher_attendance/deleteSingle', 'token=' . $this->session->data['token'] . '&id=' . $row['id'] . '&teacher_name=' . urlencode($teacher_name), true)
				);
			}
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/teacher_attendance_details.tpl', $data));
	}

	public function clearData() {
		$this->db->query("TRUNCATE TABLE bh_teacher_attendance");
		$this->session->data['success'] = 'All teacher attendance data has been cleared successfully!';
		$this->response->redirect($this->url->link('module/teacher_attendance', 'token=' . $this->session->data['token'], true));
	}

	public function clearTeacherData() {
		$teacher_name = isset($this->request->get['teacher_name']) ? trim($this->request->get['teacher_name']) : '';

		if (!empty($teacher_name)) {
			$this->db->query("DELETE FROM bh_teacher_attendance WHERE teacher_name = '" . $this->db->escape($teacher_name) . "'");
			$this->session->data['success'] = 'All attendance records for ' . $teacher_name . ' have been deleted!';
		}

		$this->response->redirect($this->url->link('module/teacher_attendance', 'token=' . $this->session->data['token'], true));
	}

	public function deleteSingle() {
		$id = isset($this->request->get['id']) ? (int)$this->request->get['id'] : 0;
		$teacher_name = isset($this->request->get['teacher_name']) ? trim($this->request->get['teacher_name']) : '';

		if ($id > 0) {
			$this->db->query("DELETE FROM bh_teacher_attendance WHERE id = '" . (int)$id . "'");
			$this->session->data['success'] = 'Session record deleted successfully!';
		}

		$this->response->redirect($this->url->link('module/teacher_attendance/details', 'token=' . $this->session->data['token'] . '&teacher_name=' . urlencode($teacher_name), true));
	}
}