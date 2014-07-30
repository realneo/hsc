<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function index(){
		$this->load->helper('form');
		$this->load->view('login/login');
	}
	
	public function login_process(){
		
		$this->load->library('form_validation');
		$this->load->library('encrypt');
		
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		// Getting the data from the form
		$email = $this->input->post('email', TRUE);


        $password = $this->input->post('password', TRUE);
        $password = hsc_encrypt($password); //hashing + encryption works great
        var_dump($password);


//        var_dump($this->encrypt->decode($encrypted_string));


		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('alert_type','danger');
	        $this->session->set_flashdata('alert_msg', 'Either the username or password is <strong>not filled</strong>');
			redirect('login');
            die();
		}else{
			$this->load->model('staffs');
			if($this->staffs->verify_user($email, $password) == TRUE){
				$this->session->set_flashdata('alert_type','success');
		        $this->session->set_flashdata('alert_msg', 'Successfully <strong>Logged In</strong>');
		
				// Getting the User Information
				$user_info = $this->staffs->get_user_info($email);
				
				foreach($user_info as $user){
					$this->session->set_userdata('user_id', $user['id']);
					$this->session->set_userdata('branch_id', $user['branch_id']);
				}
				
				// Getting User Profile Information
				$user_profile = $this->staffs->get_profile($this->session->userdata('user_id'));
				
				foreach($user_profile as $profile){
					$first_name = $profile['first_name'];
					$last_name = $profile['last_name'];
					$full_name = $first_name . ' ' . $last_name;
					
					$this->session->set_userdata('full_name', $full_name);
				}
				
				redirect('hsc');
                die();
			}else{
				$this->session->set_flashdata('alert_type','danger');
		        $this->session->set_flashdata('alert_msg', 'The Credentials are <strong>Incorrect</strong>');
				redirect('login');
                die();
			}
		}	
	}
	
	public function logout(){
		$this->session->sess_destroy();
		
		redirect('login');
        die();
	}

	
}