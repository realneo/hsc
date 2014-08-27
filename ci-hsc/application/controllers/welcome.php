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
        $this->data['branches']=$this->usuals->get_all_branches();
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

        $name_of_branch = $this->usuals->get_branch_name($id);
        $name_of_branch = make_me_bold($name_of_branch);

        $this->session->set_flashdata('alert_type','success');
        $this->session->set_flashdata('alert_msg',"<i class='glyphicon glyphicon-thumbs-up'></i> {$name_of_branch} Branch is now <b>Opened</b> for the changes you 've requested , scroll below <b>Manage Branches Panel</b> and make sure you save your changes");
        $this->settings_redirect();
    }

    function change_branch_details(){
//        var_dump($_POST);
        //Kill the session
        $this->session->unset_userdata('edit_branch');
        $id = $this->input->post('id');
        $data_to_post = array(
            'name'      => $this->input->post('name'),
            'status'    => $this->input->post('status')
        );

        $q = $this->usuals->update_branch_details($id,$data_to_post);
        $name_of_branch = $this->usuals->get_branch_name($id);
        $name_of_branch = make_me_bold($name_of_branch);
        if($q){
            $this->session->set_flashdata('alert_type','success');
            $this->session->set_flashdata('alert_msg',"<i class='glyphicon glyphicon-thumbs-up'></i> You have successfully changed details concerning {$name_of_branch} branch!, {$name_of_branch} is now closed for editing , you can open it the <strong>actions tab</strong> anytime");
            $this->settings_redirect();
        }else{
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg',"<i class='glyphicon glyphicon-thumbs-down'></i> Nothing happened, {$name_of_branch} branch is still the same");
            $this->settings_redirect();
        }
    }

    function add_branch(){
        $name = $this->input->post('name');

        /*
         * Format title
         */

        $name = make_caps($name);

        $full_name = $this->input->post('fullname');
        $data_to_post = array(
            'name'=> $name,
        );

        $query  = $this->usuals->add_branch($data_to_post);
        if($query){
            $this->session->set_flashdata('alert_type','success');
            $this->session->set_flashdata('alert_msg',"You have successfully added {$name} branch, $full_name!");
            $this->settings_redirect();
        }else{
            $this->session->set_flashdata('alert_type','danger');
            $this->session->set_flashdata('alert_msg',"Nothing happened! {$name} was not added :( try it later perhaps :)");
            $this->settings_redirect();
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */