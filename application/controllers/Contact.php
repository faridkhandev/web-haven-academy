<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Contact extends Frontend_Controller {
	public function __construct (){
		parent::__construct();
		/* $this->load->model('settings_m');
		$this->load->model('hotel_m');
		$this->load->model('service_m');
		$this->load->model('block_m'); */
	}

	public function index(){
		/* if ($this->input->server('REQUEST_METHOD') == 'POST'){
			$url = base_url();
			//==========================
			//   mail to admin start  //
			//==========================
			$store_name    		=$this->settings_m->get_meta('site_name');
			$store_owner 		=$this->settings_m->get_meta('site_name');
			$store_email 		= 'rituparnabaidya2509@gmail.com';
			$store_email_cc 	= 'abhijitpaldotin@gmail.com'; 
			$email_from 	    = $_POST['email'];
			$body               = file_get_contents($url.'email_template/contect.html');
			$body			    = str_replace("{SITE_URL}", $url, $body);
			$body			    = str_replace("{SITE_LOGO}", '<img src="'.$url.'uploads/'.$this->settings_m->get_meta('site_logo').'" border="0"/>', $body);
			$body			    = str_replace("{SITE_NAME}", $store_name, $body);
			$body			    = str_replace("{Form}", "Contact Us", $body);
			$body			    = str_replace("{Name}", $_POST['name'], $body);
			$body			    = str_replace("{Email}", $_POST['email'], $body);
			$body			    = str_replace("{Phone}", $_POST['phone'], $body);
			$body			    = str_replace("{Comments}", $_POST['message'], $body);
			$subject = 'New Contact Form Submitted From Sanjbati Website';
			$headers = "From: info@sanjbati.com\r\n";
			$headers .= "Reply-To: ". strip_tags($_POST['email']) . "\r\n";
			//$headers .= "CC: abhijitscom@gmail.com\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			//send the message, check for errors
			if (mail($store_email, $subject, $body, $headers)){				
				$data['response'] = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Thank you for sending us your query. We will get back to you asap.</div>';				
			}else{
				$data['response'] = '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> There is a problem in mail sending, please try again.</div>';
			}
		} */	

		if ($this->input->server('REQUEST_METHOD') == 'POST'){

			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email Address', 'trim|valid_email|required');
			$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
			$this->form_validation->set_rules('message', 'Message', 'trim|required');
         			
            if($this->form_validation->run() == FALSE) {
            	$data['error'] = validation_errors();
            } else {
            	$msg = '
            		<h3>Visitor Information</h3>
					Name<br>
					'.$_POST['first_name'].' '.$_POST['last_name'].'<br><br>
					Email<br>
					'.$_POST['email'].'<br><br>
					Subject<br>
					'.$_POST['subject'].'<br><br>
					Message<br>
					'.nl2br($_POST['message']).'
				';
            	$this->load->library('email');

				$this->email->from('noreplay@kosdigital.in', 'KOS Digital');
				$this->email->to('abhijitscom@gmail.com');

				$this->email->subject('KOS Digital:'.$_POST['subject']);
				$this->email->message($msg);
				$headers = "From:" . $from;
				$headers = "MIME-Version: 1.0" . "\r\n"; 
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 				 
				// Additional headers 
				$headers .= 'From: '.'KOS Digital'.'<noreplay@kosdigital.in>' . "\r\n";
				
				if(mail('kosdigital278@gmail.com','KOS Digital:'.$_POST['subject'],$msg, $headers)){
				$data['success'] = 'Your message successfully send.';
				}else{
					$data['error'] = 'Some error occur in mail send, try again.';
				}
            }

		}
		$data['page']='contact';
	    $this->load->view('front/contact', $data); 
		//$this->load->view($act, $data);
	}
}