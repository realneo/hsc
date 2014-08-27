<?php
class Staff extends CI_Controller{

    //great for initializing default variables
    protected  $data = array();
    function __construct(){
        parent::__construct();
		
		if(!$this->session->userdata('user_id')){
			$this->session->set_flashdata('alert_type','danger');
		    $this->session->set_flashdata('alert_msg', 'You have to login first');
		
			redirect('login');
		}
		
        $this->load->model('admin_');
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
         * global DATAs here
         */

        $this->data['logs']=$this->usuals->get_recent_activities();
        $this->data['branches']=$this->usuals->get_branches();

        $this->data['branches']=$this->usuals->get_branches();

        $this->data['users']=$this->vouchers->get_users();
        $this->data['auth_type']=$this->staffs->get_auth_type();
        $this->data['gender']=$this->staffs->gender_type();
        $this->data['staffs']= $this->staffs->get_users();

    }

    function staff_redirect(){
        redirect(base_url().'staff');
    }

    function index(){
        /*
         * Specific Data for one page goes here
         */
        $data['title']="Staff Management";
        $data['active']="staff";
        $data['active_tab']="add_staff";

        //add this kwa kila mwisho wa data zote
        $data = $this->data + $data;
        $this->load->view('includes/header',$data);
        $this->load->view('includes/top_nav');
        $this->load->view('includes/side_bar');
        $this->load->view('includes/title');

        $this->load->view('staff/add_new_staff');
        $this->load->view('includes/footer');

    }

    function add_new_staff(){
// Get information from the form
        $gender = $this->input->post('gender_type');

        $date = date("Y-m-d");
        $first_name = make_caps($this->input->post('first_name'));
        $last_name = make_caps($this->input->post('last_name'));
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $auth_type_id = $this->input->post('auth_type');
        $auth_type = $this->session->userdata('auth_type');
        $user_id = $this->session->userdata('user_id');
        $branch_id = $this->session->userdata('branch_id');
        $full_name = make_caps($this->session->userdata('full_name'));



        // Check if the user is authorized to give such previllages;

        if($auth_type_id < $auth_type){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg','You cannot add a user with such <strong>Authorisations</strong>');

           $this->staff_redirect();
           die();
        }

        // Check if all fields are filled;

        if(!$date){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg','You have to fill in the <strong>Date</strong> field.');

            $this->staff_redirect();
            die();
        }
        if(!$first_name){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg','You have to fill in <strong>First Name</strong> field.');

            $this->staff_redirect();
            die();
        }
        if(!$last_name){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg','You have to fill in <strong>Last Name</strong> field.');

            $this->staff_redirect();
            die();
        }

        if(!$gender OR $gender == 'not_specified'){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg','You have to fill in <strong>gender</strong> field, currently its not specified');

            $this->staff_redirect();
            die();
        }

        if(!$email){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg','You have to fill in <strong>Email</strong> field.');

            $this->staff_redirect();
            die();
        }
        if(!$password){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg','You have to fill in <strong>Password</strong> field.');

            $this->staff_redirect();
            die();
        }
        // Insert into user table first
        $password = tokenize_sha1($password);
        $query = $this->staffs->insert_staff($date, $email, $password, $branch_id, $auth_type_id, $user_id);

        // Get ID of the new staff

        $staff_id = $query;



        if($query){

            // Insert into user_profile table
            $query_id = $query;
            $profile_query = $this->staffs->insert_user_profile($first_name, $last_name, $staff_id,$gender,$query_id);


            $this->session->set_flashdata('alert_type','success');
            $this->session->set_flashdata('alert_msg',"Thank you {$full_name}!");

            /*
             * Make Bold
            */

            $first_name = make_me_bold($first_name);
            $last_name = make_me_bold($last_name);
            // Write into Log
            $log = "Added : $first_name $last_name in the System";
            $this->usuals->log_write($user_id, $branch_id, $log);

            $this->staff_redirect();
            die();
        }else{
            $this->session->set_flashdata('alert_type','danger');
            $this->session->set_flashdata('alert_msg',"There was a problem with the system please try again!");

            $this->staff_redirect();
            die();

        }
    }

    function manage_staff(){
        /*
         * Specific Data for one page goes here
         */
        $data['title']="Staff Management";
        $data['active']="staff";
        $data['active_tab']="manage_staff";

        //add this kwa kila mwisho wa data zote
        $data = $this->data + $data;
        $this->load->view('includes/header',$data);
        $this->load->view('includes/top_nav');
        $this->load->view('includes/side_bar');
        $this->load->view('includes/title');

        $this->load->view('staff/change_branch');
        $this->load->view('includes/footer');

    }

    function change_staff_details(){
        $user_id = $this->input->post('user_id');
        $branch_id = $this->input->post('branch_id');
        $from_branch = $this->input->post('from_branch');
        $from_branch_id = $this->input->post('from_branch_id');
        $done_from_branch = $this->session->userdata('branch_name');
        $employee_name = $this->input->post('full_name');
        $full_name = $this->session->userdata('full_name');

        $q = $this->staffs->change_user_branch($user_id,$branch_id);

        /*
         * Format data
         */
        $name_of_branch = $this->usuals->get_branch_name($branch_id);
        $name_of_branch = make_me_bold($name_of_branch);
        $from_branch = make_me_bold($from_branch);
        $employee_name = make_me_bold($employee_name);

        if($q){
            // Write into Log
            $log = "Branch Change: $employee_name was moved to $name_of_branch from $from_branch , by $full_name";
            $this->usuals->log_write($user_id,$from_branch_id, $log);

            $this->session->set_flashdata('alert_type','success');
            $this->session->set_flashdata('alert_msg',"<i class='glyphicon glyphicon-thumbs-up'></i> You have successfully changed {$employee_name}'s branch, {$employee_name} is currenly assigned at {$name_of_branch}. Changes will take effect when {$employee_name} logs in again.");
            $this->manage_staff_redirect();

        }else{

            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg',"<i class='glyphicon glyphicon-thumbs-down'></i> Nothing happened, {$name_of_branch} branch is still the same");
            $this->manage_staff_redirect();

        }
    }

    function manage_staff_redirect(){
        redirect(base_url('staff/manage_staff'));
        die();
    }
}