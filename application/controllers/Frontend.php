<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Frontend extends Frontend_Controller {
    public function __construct ()
	{
		parent::__construct();
		//$this->load->model('settings_m');
		//$this->load->model('course_m');
	}
	
	public function index()
	{
		$query = $this->db->query("SELECT * FROM bh_course WHERE course_delete_status = 0 AND course_status= 1 ORDER BY priority ASC");
		$data['courses']=$query->result_array();
		$data['is_home'] = true;
	    $this->load->view('front/index', $data); 
	}
}