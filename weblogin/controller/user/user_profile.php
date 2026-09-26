<?php
class ControllerUserUserProfile extends Controller {
	private $error = array();
	public function index() {
		$this->load->language('user/user');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('user/user');
		$this->getForm();
	}
	
	public function getForm(){
		$data['user_group_id'] = $this->user->getGroupId();
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['text_remove'] = $this->language->get('text_remove');

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
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['username'])) {
			$data['error_username'] = $this->error['username'];
		} else {
			$data['error_username'] = '';
		}

		if (isset($this->error['firstname'])) {
			$data['error_firstname'] = $this->error['firstname'];
		} else {
			$data['error_firstname'] = '';
		}

		if (isset($this->error['lastname'])) {
			$data['error_lastname'] = $this->error['lastname'];
		} else {
			$data['error_lastname'] = '';
		}
		
		if (isset($this->error['phone'])) {
			$data['error_phone'] = $this->error['phone'];
		} else {
			$data['error_phone'] = '';
		}
		
		if (isset($this->error['whatsapp'])) {
			$data['error_whatsapp'] = $this->error['whatsapp'];
		} else {
			$data['error_whatsapp'] = '';
		}
		$url = '';



		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => 'User Edit',
			'href' => $this->url->link('user/user_profile', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['action'] = $this->url->link('user/user_profile/edit', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['cancel'] = $this->url->link('user/user', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$user_info = $this->model_user_user->getUser($this->user->getId());
		
		if (isset($this->request->post['username'])) {
			$data['username'] = $this->request->post['username'];
		} elseif (!empty($user_info)) {
			$data['username'] = $user_info['username'];
		} else {
			$data['username'] = '';
		}

		if (isset($this->request->post['firstname'])) {
			$data['firstname'] = $this->request->post['firstname'];
		} elseif (!empty($user_info)) {
			$data['firstname'] = $user_info['firstname'];
		} else {
			$data['firstname'] = '';
		}

		if (isset($this->request->post['lastname'])) {
			$data['lastname'] = $this->request->post['lastname'];
		} elseif (!empty($user_info)) {
			$data['lastname'] = $user_info['lastname'];
		} else {
			$data['lastname'] = '';
		}

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} elseif (!empty($user_info)) {
			$data['email'] = $user_info['email'];
		} else {
			$data['email'] = '';
		}

		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($user_info)) {
			$data['image'] = $user_info['image'];
		} else {
			$data['image'] = '';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($user_info) && $user_info['image'] && is_file(DIR_IMAGE . $user_info['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($user_info['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		if (isset($this->request->post['phone'])) {
			$data['phone'] = $this->request->post['phone'];
		} elseif (!empty($user_info)) {
			$data['phone'] = $user_info['phone'];
		} else {
			$data['phone'] = '';
		}
		
		if (isset($this->request->post['whatsapp'])) {
			$data['whatsapp'] = $this->request->post['whatsapp'];
		} elseif (!empty($user_info)) {
			$data['whatsapp'] = $user_info['whatsapp'];
		} else {
			$data['whatsapp'] = '';
		}
		
		if (isset($this->request->post['gender'])) {
			$data['gender'] = $this->request->post['gender'];
		} elseif (!empty($user_info)) {
			$data['gender'] = $user_info['gender'];
		} else {
			$data['gender'] = '';
		}
		
		if (isset($this->request->post['city'])) {
			$data['city'] = $this->request->post['city'];
		} elseif (!empty($user_info)) {
			$data['city'] = $user_info['city'];
		} else {
			$data['city'] = '';
		}
		
		if (isset($this->request->post['country'])) {
			$data['country'] = $this->request->post['country'];
		} elseif (!empty($user_info)) {
			$data['country'] = $user_info['country'];
		} else {
			$data['country'] = '';
		}
		
		if (isset($this->request->post['language'])) {
			$data['language'] = $this->request->post['language'];
		} elseif (!empty($user_info)) {
			$data['language'] = $user_info['language'];
		} else {
			$data['language'] = '';
		}
		
		/* if($student['student_country']=="India"){
			$payment = array('Gpay', 'Phone Pay', 'Paytm', 'Binance');
		}elseif($student['country']=="Bangladesh"){
			$payment = array('Bkash', 'Nagad', 'Binance');
		}elseif($student['country']=="Nepal"){
			$payment = array('eSewa', 'Binance');
		} */
		
		if (isset($this->request->post['payment_medium'])) {
			$data['payment_medium'] = $this->request->post['payment_medium'];
		} elseif (!empty($user_info)) {
			$data['payment_medium'] = $this->model_user_user->getUserPaymentMedium($this->user->getId());
		} else {
			$data['payment_medium'] = array();
		}
		
		$data['user_id'] = $this->user->getId();
		$data['user_group_id'] = $this->user->getGroupId();
	
		$data['text_form'] = !($this->user->getId()) ? $this->language->get('text_add') : $this->language->get('text_edit').'(<div class="miltiInfo"><span>Id:'.$user_info['user_no'].'</span>||<span>Username:'.$user_info['username'].'</span>||<span>Name:'.$user_info['firstname'].' '.$user_info['lastname'].'</span></div>)';
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('user/user_profile_form.tpl', $data));

	}

	

	public function edit() {
		$this->load->language('user/user');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('user/user');
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_user_user->editUserProfile($this->user->getId(), $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
			$this->response->redirect($this->url->link('user/user_profile', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		$this->getForm();
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'user/user_profile')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen(trim($this->request->post['firstname'])) < 1) || (utf8_strlen(trim($this->request->post['firstname'])) > 32)) {
			$this->error['firstname'] = $this->language->get('error_firstname');
		}

		if ((utf8_strlen(trim($this->request->post['lastname'])) < 1) || (utf8_strlen(trim($this->request->post['lastname'])) > 32)) {
			$this->error['lastname'] = $this->language->get('error_lastname');
		}
		
		
		if ((utf8_strlen(trim($this->request->post['whatsapp'])) < 1) || (utf8_strlen(trim($this->request->post['whatsapp'])) > 32)) {
			$this->error['whatsapp'] = 'Invalid Whatsapp No.';
		}
		
		if ((utf8_strlen(trim($this->request->post['phone'])) < 1) || (utf8_strlen(trim($this->request->post['phone'])) > 32)) {
			$this->error['phone'] = 'Invalid Phone No.';
		}
		
		return !$this->error;
	}
}