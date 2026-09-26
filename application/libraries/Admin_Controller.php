<?php
class Admin_Controller extends MY_Controller {
	public $data = array();
    function __construct(){
		parent::__construct();
		$this->data['meta_title'] = 'My awesome CMS';
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('user_m');
		
		// Login check
		$exception_uris = array(
			'webadmin/user/login', 
			'webadmin/user/logout',
			'webadmin/user/validate_credentials',
			'webadmin/user/lost_password'
		);
	
		$check_url=in_array(uri_string(), $exception_uris,true);
		/* if($check_url==false){
	
			if ($this->user_m->loggedin()=="logout") {
					redirect('webadmin/user/login');
			}
		} */
	
	}
}