<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hsc extends CI_Controller {
    //great for initializing default variables
    protected  $data = array();
    function __construct()
    {
        parent::__construct();
        $this->load->model('usuals');


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
        $this->data['today_expenses']=$this->usuals->get_today_expenses();
        $this->data['today_binding']=$this->usuals->get_today_binding();
        $this->data['logs']=$this->usuals->get_recent_activities();
        $this->data['branches']=$this->usuals->get_branches();



    }



	public function index()
	{

        /*
         * Specific Data for one page goes here
         */
        $data['title']="Dashboard";
        $data['active']="dashboard";
        $data['active_tab']="";

        //add this kwa kila mwisho wa data zote
        $data = $this->data + $data;
        $this->load->view('includes/header',$data);
        $this->load->view('includes/top_nav');
        $this->load->view('includes/side_bar');

		$this->load->view('default_content');
		$this->load->view('includes/footer');
	}
    function change_branch($id){
        $this->session->set_userdata("branch_id",$id);
        redirect(base_url());

    }
    public function daily_sales()
    {

        /*
         * Specific Data for one page goes here
         */
        $data['title']="Daily Sales";
        $data['active']="daily_sales";
        $data['active_tab']="daily_sales";

        //add this kwa kila mwisho wa data zote
        $data = $this->data + $data;
        $this->load->view('includes/header',$data);
        $this->load->view('includes/top_nav');
        $this->load->view('includes/side_bar');

        $this->load->view('dailysales/default_content');
        $this->load->view('includes/footer');
    }

    public function daily_expenses()
    {

        /*
         * Specific Data for one page goes here
         */
        $data['title']="Daily Expenses";
        $data['active']="daily_sales";
        $data['active_tab']="daily_expenses";

        //add this kwa kila mwisho wa data zote
        $data = $this->data + $data;
        $this->load->view('includes/header',$data);
        $this->load->view('includes/top_nav');
        $this->load->view('includes/side_bar');

        $this->load->view('dailysales/default_content');
        $this->load->view('includes/footer');
    }
    public function daily_manual_invoices()
    {

        /*
         * Specific Data for one page goes here
         */
        $data['title']="Manual Invoices";
        $data['active']="daily_sales";
        $data['active_tab']="manual_invoices";

        //add this kwa kila mwisho wa data zote
        $data = $this->data + $data;
        $this->load->view('includes/header',$data);
        $this->load->view('includes/top_nav');
        $this->load->view('includes/side_bar');

        $this->load->view('dailysales/default_content');
        $this->load->view('includes/footer');
    }
    public function daily_returns()
    {

        /*
         * Specific Data for one page goes here
         */
        $data['title']="Returns";
        $data['active']="daily_sales";
        $data['active_tab']="returns";

        //add this kwa kila mwisho wa data zote
        $data = $this->data + $data;
        $this->load->view('includes/header',$data);
        $this->load->view('includes/top_nav');
        $this->load->view('includes/side_bar');

        $this->load->view('dailysales/default_content');
        $this->load->view('includes/footer');
    }

    public function sales_vouchers()
    {

        /*
         * Specific Data for one page goes here
         */
        $data['active']="daily_sales";
        $data['title']="Sales Vouchers";
        $data['active_tab']="sales_vouchers";

        //add this kwa kila mwisho wa data zote
        $data = $this->data + $data;
        $this->load->view('includes/header',$data);
        $this->load->view('includes/top_nav');
        $this->load->view('includes/side_bar');

        $this->load->view('dailysales/default_content');
        $this->load->view('includes/footer');
    }
}

