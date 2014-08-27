<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    //great for initializing default variables
    protected  $data = array();
    function __construct()
    {
        parent::__construct();

        if(!$this->session->userdata('user_id')){
            $this->session->set_flashdata('alert_type','danger');
            $this->session->set_flashdata('alert_msg', 'You have to login first');

            redirect('login');
        }

        $this->load->model('usuals');
        $this->load->model('expenses');
        $this->load->model('invoices');
        $this->load->model('returns');
        $this->load->model('vouchers');
        $this->load->model('staffs');


        /*
         * We only need to change the name, but always check the id
         */

        $name=$this->usuals->get_branch_name($this->session->userdata('branch_id'));
        $this->session->set_userdata("branch_name",$name);

        /*
         * GLOBAL DATAs needed
         */
        $this->data['logs']=$this->usuals->get_recent_activities();
        $this->data['branches']=$this->usuals->get_branches();
    }
        public function index()
	{



        /*
         * Specific Data for one page goes here
         */
        $data['title']="Settings";
        $data['active']="dashboard";
        $data['active_tab']="";

        //add this kwa kila mwisho wa data zote
        $data = $this->data + $data;
        $this->load->view('includes/header',$data);
        $this->load->view('includes/top_nav');
        $this->load->view('includes/side_bar');
        $this->load->view('includes/title');
        $this->load->view('password');

        $this->load->view('includes/footer');
	}

    function  settings_redirect(){
        redirect(base_url('welcome'));
        die();
    }
    function change_pass(){
        $user_id = $this->session->userdata('user_id');
        $word1=$this->input->post('password');
        $word2=$this->input->post('password1');
        $full_name = $this->session->userdata('full_name');

        if(!$word1 OR !$word2){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg','You did not provide the password yet!');
            $this->settings_redirect();
        }

        if($word2!=$word1){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg','The Passwords don\'t match');
            $this->settings_redirect();
        }
        $data['word_orignal'] =$word1;//Use it later
        $data['word_pass'] =tokenize_sha1($word1);

        $query = $this->staffs->change_password($user_id,$data['word_pass']);
        if($query){
            $this->session->set_flashdata('alert_type','success');
            $this->session->set_flashdata('alert_msg',"You have changed your password,$full_name!");
            $this->settings_redirect();
        }else{
            $this->session->set_flashdata('alert_type','danger');
            $this->session->set_flashdata('alert_msg',"Nothing happened! Your password is still the same, Please try again later");
            $this->settings_redirect();
        }

    }

    function display_url(){
        $user_id = $this->session->userdata('user_id');
        $pic_url = $this->input->post('pic_url');
        $full_name = $this->session->userdata('full_name');

        if(!$pic_url){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg','You did not provide the URL yet!');
            $this->settings_redirect();
        }




        $query = $this->staffs->change_display($user_id,$pic_url);
        if($query){
            $this->session->set_flashdata('alert_type','success');
            $this->session->set_flashdata('alert_msg',"You have changed your display picture,$full_name!");
            $this->settings_redirect();
        }else{
            $this->session->set_flashdata('alert_type','danger');
            $this->session->set_flashdata('alert_msg',"Nothing happened! Your display picture is still the same, Please try again later");
            $this->settings_redirect();
        }


    }

    function edit_branch($id){
        $this->session->set_userdata('edit_branch',$id);
        $this->session->set_flashdata('alert_type','success');
        $this->session->set_flashdata('alert_msg',"Branch Opened at the bottom for changes, scroll below <b>Manage Branches Tab</b>");
        $this->settings_redirect();
    }

    function change_branch_details(){
        var_dump($_POST);
        //close it if ou finish
//        $this->session->unset_userdata('edit_branch');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */