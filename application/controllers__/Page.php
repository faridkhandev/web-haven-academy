<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends Frontend_Controller {
	
	public function __construct (){
		parent::__construct();
		$this->load->model('page_m');
		$this->load->model('settings_m');			
		$this->load->model('service_m');	
		$this->load->model('block_m');	
		$this->load->model('category_m');	
	}
	
	public function view($slug)
	{
	   $array = array('name' => $name, 'title' => $title, 'status' => $status);
	   $data['page']= $this->page_m->get_by(array('slug' => $slug), TRUE);
		/* Get Config Value From */
		$meta_keys=array('site_name', 'site_slogan','site_url','site_status', 'admin_email','office_address', 'contact_number','skype_id','site_logo','facebook_url','twitter_url','google_plus_url');
		foreach($meta_keys as $meta_key){
		$data[$meta_key]=$this->settings_m->get_meta($meta_key);
		}
		/* Footer Text */
		$data['footer1'] = $this->block_m->get_by(array('short_code'=>'footer1'), TRUE);
		$data['footer2'] = $this->block_m->get_by(array('short_code'=>'footer2'), TRUE);
		$data['footer3'] = $this->block_m->get_by(array('short_code'=>'footer3'), TRUE);	
		$data['footer4'] = $this->block_m->get_by(array('short_code'=>'footer4'), TRUE);
		$data['categories'] = $this->category_m->get_by('status=1');
		$data['main_content'] ='front/single-page';
		$this->load->view('front/inc/template', $data); 

	}
}
?>