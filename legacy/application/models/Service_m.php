<?php
class Service_m extends MY_Model
{
	protected $_table_name = 'services';
	protected $_order_by = 'id';
	public $rules = array(
	      'title' => array(
			'field' => 'title', 
		    'label' => 'Service Title',
		   	'rules' => 'trim|required',
		   	'errors' => array(
                 'required' => 'Enter the Service Title',
                ),
		), 
		'description' => array(
			'field' => 'description', 
			'label' => 'Description', 
			'rules' => 'trim|required',
		     'errors' => array(
                        'required' => 'Please Enter Description.',
              ),
		), 
		'display_order' => array(
			'field' => 'display_order', 
			'label' => 'Display Order', 
			'rules' => 'trim|required',
			 'errors' => array(
                        'required' => 'Please Enter Display Order.',
                ),
		),
		'status' => array(
			'field' => 'status', 
			'label' => 'Status', 
			'rules' => 'trim|required',
			 'errors' => array(
                        'required' => 'Please assign  Status',
                ),
		),
		
	);
	

	public function get_new()
	{
		$service = new stdClass();
		$service->title 	= '';
		$service->image 	= '';
		$service->description  	= '';
		$service->status 	= '';
	 	return $service;
	}

}