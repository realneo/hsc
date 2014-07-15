<?php
/**
 * Created Using Fadsel Engine.
 * User: Fahad
 * Date: 7/15/14
 * Time: 3:01 PM
 */
class Staff extends CI_Controller{

    //great for initializing default variables
    protected  $data = array();
    function __construct(){
        parent::__construct();
        $this->load->model('admin_');
        $this->load->model('usuals');
        $this->load->model('expenses');
        $this->load->model('invoices');
        $this->load->model('returns');
        $this->load->model('vouchers');
        $this->load->model('staffs');

        /*
         * Set the Defaults
         */

        if(!$this->session->userdata("full_name")){
            $this->session->set_userdata("full_name","Fahad K");
        }

        elseif (!$this->session->userdata("branch_id")){
            $this->session->set_userdata("branch_id",1);
        }

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
        $this->data['users']=$this->vouchers->get_users();
        $this->data['auth_type']=$this->staffs->get_auth_type();

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

    }
}