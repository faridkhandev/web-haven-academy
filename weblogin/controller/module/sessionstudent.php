<?php
class ControllerModuleSessionstudent extends Controller {
	private $error = array();
	
	public function __construct($params) {
		parent::__construct($params);
		$this->load->model('module/course');
		$this->load->model('module/session');
		$this->load->model('student/student');
		$this->load->model('module/sessionstudent');
		$this->load->model('user/user');
		$this->load->language('module/session');
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
	
	private function getItems() {
		if (isset($this->request->post['filter_start_date'])) {
			$filter_start_date = $this->request->post['filter_start_date'];
		} else {
			$filter_start_date = null;
		}
		
		if (isset($this->request->post['filter_end_date'])) {
			$filter_end_date = $this->request->post['filter_end_date'];
		} else {
			$filter_end_date = null;
		}
		
		if (isset($this->request->post['filter_course'])) {
			$filter_course = $this->request->post['filter_course'];
		} else {
			$filter_course = null;
		}

		if (isset($this->request->post['filter_session_no'])) {
			$filter_session_no = $this->request->post['filter_session_no'];
		} else {
			$filter_session_no = null;
		}
		
		if($this->user->getGroupId() == 14){
			$filter_teacher = $this->user->getId();
		}else{
			if (isset($this->request->post['filter_teacher'])) {
				$filter_teacher = $this->request->post['filter_teacher'];
			} else {
				$filter_teacher = null;
			}
		}
		if (isset($this->request->post['filter_student'])) {
			$filter_student = $this->request->post['filter_student'];
		} else {
			$filter_student = null;
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
			'filter_start_date'              => $filter_start_date,
			'filter_end_date'              => $filter_end_date,
			'filter_course'              => $filter_course,
			'filter_session_no'            => $filter_session_no,
			'filter_student'            => $filter_student,
			'filter_teacher'            => $filter_teacher,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];

		$items = array();
		$results = $this->model_module_sessionstudent->getItems($filter_data);
		foreach($results['result'] as $key => $result) {
			if($result['course_id'] == 2 && $result['session_no'] == 12){
				$session_point = 360;
			}elseif($result['course_id'] == 4 && $result['session_no'] == 16){
				$session_point = 800;
			}else{
				$session_point = $result['session_point'];
			}
			$items[] = array(
				'id' => $result['id'],
				'point_status_value'   => $result['point_status'],
				'point_status'   => ($result['point_status']==1)?'Approve':(($result['work_status'] == 0)?'Wrong Work':'Pending'),
				'student_name'   => $result['student_name'],
				'student_no'   => $result['student_no'],
				'student_id'   => $result['student_id'],
				'session_no'   => $result['session_no'],
				'session_point'   => $session_point,
				'session_id'   => $result['session_id'],
				'work_status'   => $result['work_status'],
				'course_id'   => $result['course_id'],
				'course_name'   => $result['course_name'],
				'username'   => $result['username'],
				'fullname'   => $result['fullname'].'('.$result['username'].')',
				'point'   => $result['point'],
				'work_link'   => ($result['work_link']!= '')?'<a target="_blank" href="'.$result['work_link'].'" class="btn">View</a>':'',
				'date_added'			=>	date($this->config->get('config_date_format'), strtotime($result['date_added'])),
				'action'				=>	$result['id']
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

	protected function getList() {
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => 'Student Wise Task Submit List',
			'href' => $this->url->link('module/sessionstudent', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['heading_title'] = 'Student Task List';
		$data['token'] = $this->session->data['token'];
		
		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_username'] = $this->language->get('column_username');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');

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
		
		$data['page_length'] = $this->config->get('config_limit_admin');
		$data['view'] = $this->url->link('module/session/view', '&token=' . $this->session->data['token'], TRUE);
		
		$teachers = $this->model_user_user->getSubItems(array('filter_group_id'=>14));
		$data['teachers'] = $teachers['result'];
		
		$courses = $this->model_module_course->getItems();
		$data['courses'] = $courses['result'];
		
		$data['user_id'] = $this->user->getId();
		$data['user_group_id'] = $this->user->getGroupId();
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/session_student_list_admin.tpl', $data));
	}
	
	private function getSessionStudentItems() {
		$data['user_id'] = $this->user->getId();
		$data['user_group_id'] = $this->user->getGroupId();
		if (isset($this->request->post['filter_student'])) {
			$filter_student = $this->request->post['filter_student'];
		} else {
			$filter_student = null;
		}
		
		if (isset($this->request->post['session_id'])) {
			$filter_session_id = $this->request->post['session_id'];
		} else {
			$filter_session_id = null;
		}

		if($user_group_id == 14){
			$filter_teacher_id = $this->user->getId();
		}elseif (isset($this->request->post['filter_teacher'])) {
			$filter_teacher_id = $this->request->post['filter_teacher'];
		} else {
			$filter_teacher_id = null;
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
			'filter_student'              => $filter_student,
			'filter_session_id'              => $filter_session_id,
			'filter_teacher_id'            => $filter_teacher_id,
			'order'   				=> $order,
			'start'   				=> $start,
			'length'   				=> $length
		];

		$items = array();
		$results = $this->model_module_sessionstudent->getSessionItems($filter_data);
		foreach($results['result'] as $key => $result) {
			$items[] = array(
				'id' => $result['id'],
				'point_status'   => $result['point_status'],
				'student_name'   => $result['student_name'],
				'student_no'   => $result['student_no'],
				'student_id'   => $result['student_id'],
				'session_no'   => $result['session_no'],
				'session_point'   => $result['session_point'],
				'session_id'   => $result['session_id'],
				'course_id'   => $result['course_id'],
				'course_name'   => $result['course_name'],
				'point'   => $result['point'],
				'work_link'   => ($result['work_link']!= '')?'<a target="_blank" href="'.$result['work_link'].'" class="btn">View</a>':'',
				'date_added'			=>	date($this->config->get('config_date_format'), strtotime($result['date_added'])),
				'action'				=>	$result['id']
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

	protected function getSessionStudentList() {
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/session', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['add'] = $this->url->link('module/session/add', 'token=' . $this->session->data['token'], 'SSL');
		$data['delete'] = $this->url->link('module/session/delete', 'token=' . $this->session->data['token'], 'SSL');

		$data['heading_title'] = $this->language->get('heading_title');
		$data['token'] = $this->session->data['token'];
		
		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_username'] = $this->language->get('column_username');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');

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
		
		$data['page_length'] = $this->config->get('config_limit_admin');
		$data['edit'] = $this->url->link('module/session/edit', '&token=' . $this->session->data['token'], TRUE);
		$data['view'] = $this->url->link('module/session/view', '&token=' . $this->session->data['token'], TRUE);
		
		$teachers = $this->model_user_user->getSubItems(array('filter_group_id'=>14));
		$data['teachers'] = $teachers['result'];
		
		$courses = $this->model_module_course->getItems();
		$data['courses'] = $courses['result'];
		
		$data['user_id'] = $this->user->getId();
		$data['user_group_id'] = $this->user->getGroupId();
		$data['session_id'] = $this->request->get['session_id'];
		
		$data['session_info'] = $this->model_module_sessionstudent->get($this->request->get['session_id']);
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/session_student_list.tpl', $data));
	}
}