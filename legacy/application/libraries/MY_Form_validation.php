<?php
class MY_Form_validation extends CI_Form_validation {

    public function __construct() {
        parent::__construct();
    }

    public function is_unique($str, $field) {
		
        $field_ar = explode('.', $field);
        $query = $this->CI->db->get_where($field_ar[0], array($field_ar[1] => $str), 1, 0);
        if ($query->num_rows() === 0) {
            return TRUE;
        }

        return FALSE;
    }
	
	public function edit_unique($value, $params) 
	{
		

		$full_url_string = explode('/',uri_string());
		$get_id = end($full_url_string);
	
	    $fullparams=$params.".".$get_id;
		$CI =&get_instance();
		$CI->load->database();
		$CI->form_validation->set_message('edit_unique', "Sorry, that ' %s 'is already being used.");	
		list($table, $field, $current_id) = explode(".", $fullparams);
		$query = $CI->db->select()->from($table)->where($field, $value)->limit(1)->get();
	
		if ($query->row() && $query->row()->id != $current_id)
		{
			return FALSE;
		}
	}
	  
	
	
	
	public function edit_unique_email($value, $params)
	{
		//echo"sdasdas". $value;
	//	print_r($params);
		
	//die;
	
	/*	$id = $this->uri->segment(4);
		$this->db->where('email', $this->input->post('email'));
		!$id || $this->db->where('id!=', $id);
		$user = $this->profile_m->get();
		
		if (count($user)) {
			//$this->form_validation->set_message('email_check', '%s should be unique');
			return FALSE;
		}
		
		return TRUE;
		
		*/
	}
}