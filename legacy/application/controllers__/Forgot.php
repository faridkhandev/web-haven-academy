<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Forgot extends Frontend_Controller {
	public function __construct (){
		parent::__construct();
		/* $this->load->model('settings_m');
		$this->load->model('hotel_m');
		$this->load->model('service_m');
		$this->load->model('block_m'); */
	}

	public function index(){
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
			if($this->form_validation->run() == TRUE) {
				$email = $this->input->post('email');  
                $clean = $this->security->xss_clean($email);
				$query = $this->db->query("SELECT * FROM bh_student WHERE student_email='".$clean	."'");
				$row = $query->row_array();
				if (isset($row)){
					if($row['student_status'] != 1){ //if status is not approved
						$data['error'] = 'Your account is not in approved status.';
					}elseif($row['student_delete_status'] == 1){ //if student already deleted
						$data['error'] = 'Your account is already deleted. You can not use this.';
					}else{
						$token = $this->insertToken($row['id']);                        
						$qstring = $this->base64url_encode($token);                  
						$url = site_url() . 'forgot/resetpassword/token/' . $qstring;
						$link = '<a href="' . $url . '">' . $url . '</a>'; 
						
						$message = '';                     
						$message .= '<strong>A password reset has been requested for this email account</strong><br>';
						$message .= '<strong>Please click:</strong> ' . $link; 
							
						/* Send Mail */
						$this->load->library('email');
						$this->email->from('noreplay@kosdigital.in', 'KOS Digital');
						$this->email->to($row['student_email']);
						//$this->email->cc('another@another-example.com');
						//$this->email->bcc('them@their-example.com');
						$this->email->subject('KOS Digital:Forgot Password');
						$this->email->message($message);
						$headers = "From:" . $from;
						$headers = "MIME-Version: 1.0" . "\r\n"; 
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 				 
						// Additional headers 
						$headers .= 'From: '.'KOS Digital'.'<noreplay@kosdigital.in>' . "\r\n";
						if(mail($row['student_email'],'KOS Digital:Forgot Password Link',$message, $headers)){
							$data['success'] = 'Please check your email for reset password.';
						}else{
							$data['error'] = 'Some error occur on sending email, Try again.';
						}
					}
				}else{
					$data['error'] = 'We can\'t find your email address.';
				}
			}
		}	
		//print_r($data);exit;
		$data['page']='forgot';
	    $this->load->view('front/forgot', $data);
	}
	
	public function resetpassword(){
		$token = $this->base64url_decode($this->uri->segment(4));              
        $cleanToken = $this->security->xss_clean($token);
		$std_info = $this->isTokenValid($cleanToken); //either false or array();
		if(!$std_info){
			$this->session->set_flashdata('flash_message', 'Token is invalid or expired');
			redirect(site_url('forgot'));
		}
		
		$data = array(
			'student_name'=> $std_info->student_name, 
			'student_email'=>$std_info->student_email,
			'token'=>$this->base64url_encode($token)
		);
		
		$this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
		
		if ($this->form_validation->run() == FALSE) {   
			$this->load->view('front/resetpassword', $data);
		}else{
			
			$post = $this->input->post(NULL, TRUE);                
            $cleanPost = $this->security->xss_clean($post);    
				
			$cleanPost['password'] = md5($cleanPost['password']);
            $cleanPost['id'] = $std_info->id;
			if($this->updatePassword($cleanPost)){
				$data['success'] = 'Your password has been updated. You may now login.';
			}else{
				$data['error'] = 'There was a problem updating your password, try again.';
			}
		}
		$data['page']='resetpassword';
	    $this->load->view('front/resetpassword', $data);
	}
	
	public function updatePassword($post)
    {   
		$this->db->where('id', $post['id']);
        $this->db->update('bh_student', array('student_password' => $post['password'])); 
        $success = $this->db->affected_rows(); 
        if(!$success){
            return false;
        }        
        return true;
    } 
	
	public function insertToken($student_id)
    {   
        $token = substr(sha1(rand()), 0, 30); 
        $date = date('Y-m-d');
        
        $string = array(
                'token'=> $token,
                'student_id'=>$student_id,
                'created'=>$date
            );
        $query = $this->db->insert_string('bh_tokens',$string);
        $this->db->query($query);
        return $token . $student_id;
        
    }
	
	public function isTokenValid($token)
    {
		$tkn = substr($token,0,30);
		$uid = substr($token,30);      
       
        $q = $this->db->get_where('bh_tokens', array(
            'token' => $tkn, 
            'student_id' => $uid), 1);                         
               
        if($this->db->affected_rows() > 0){
            $row = $q->row(); 
            $created = $row->created;
            $createdTS = strtotime($created);
            $today = date('Y-m-d'); 
            $todayTS = strtotime($today);
            
            if($createdTS != $todayTS){
                return false;
            }
            
            $user_info = $this->getStudentInfo($row->student_id);
            return $user_info;
            
        }else{
            return false;
        }
        
    }    
	
	public function getStudentInfo($id){
        $q = $this->db->get_where('bh_student', array('id' => $id), 1);  
        if($this->db->affected_rows() > 0){
            $row = $q->row();
            return $row;
        }else{
            return false;
        }
    }
	
	public function base64url_encode($data) { 
		return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
    } 

    public function base64url_decode($data) { 
		return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
    }    
}