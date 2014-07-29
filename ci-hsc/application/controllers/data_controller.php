<?php
/**
 * Created Using Fadsel Engine.
 * User: Fahad
 * Date: 7/15/14
 * Time: 3:08 PM
 */
class Data_Controller extends CI_Controller{
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
        $this->data['manual_invoice']=$this->usuals->getTotalManualInvoices(0);
        $this->data['today_sales']=$this->usuals->get_today_sales();

        $this->data['today_binding']=$this->usuals->get_today_binding();
        $this->data['logs']=$this->usuals->get_recent_activities();
        $this->data['branches']=$this->usuals->get_branches();
        $this->data['recent_total']=$this->usuals->get_recent_total_sales();

        $this->data['today_expenses']=$this->expenses->get_today_expenses();
        $this->data['recent_expenses']=$this->expenses->get_recent_expenses();
        $this->data['recent_invoices']=$this->invoices->get_recent_invoices();

        $this->data['recent_returns']=$this->returns->get_recent_returns();
        $this->data['recent_vouchers']=$this->vouchers->get_recent_vouchers();
        $this->data['users']=$this->vouchers->get_users();

    }
}
