<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hsc extends CI_Controller {
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


        $this->data['recent_returns']=$this->returns->get_recent_returns();

        $this->data['recent_vouchers']=$this->vouchers->get_recent_vouchers();
        $this->data['users']=$this->vouchers->get_users();



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
        $this->load->view('includes/title');

		$this->load->view('default_content');

		$this->load->view('includes/footer');
	}

    function change_branch($id){
        $this->session->set_userdata("branch_id",$id);
        redirect(base_url($this->session->flashdata('whereami')));

    }

    function daily_sales()
    {

        /*
         * Specific Data for one page goes here
         */
        $data['title']="Daily Sales";
        $data['active']="daily_sales";
        $data['active_tab'] =
            $this->session->userdata('active_tab')?$this->session->userdata('active_tab'):"daily_sales";

        //add this kwa kila mwisho wa data zote
        $data = $this->data + $data;
        $this->load->view('includes/header',$data);
        $this->load->view('includes/top_nav');
        $this->load->view('includes/side_bar');



        switch($this->session->userdata('show')){
            case 'add_sales':
                /*
                The titles were passed far behind , look for work around later :D
                */
                $data['title']="Add Sales";
                $this->load->view('includes/title');
                $this->load->view('dailysales/add_daily_sales');
                break;
            case 'edit_sales':
                $data['title']="Edit Sales";
                $this->load->view('includes/title');
                $this->load->view('dailysales/daily_sales');
                break;
            case 'edit_binding':
                $data['title']="Edit Binding";
                $this->load->view('includes/title');
                $this->load->view('dailybinding/daily_binding');
                break;
            default :
                $data['title']="General Sales";
                $this->load->view('includes/title');
                $this->load->view('dailysales/default_content');
        }
        $this->load->view('includes/footer');
    }


    function daily_expenses()
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
        $this->load->view('includes/title');

        $this->load->view('dailyexpenses/daily_expenses');
        $this->load->view('includes/footer');
    }

    function daily_manual_invoices($start=0)
    {

        /*
         * Specific Data for one page goes here
         */
        $data['title']="Manual Invoices";
        $data['active']="daily_sales";
        $data['active_tab']="manual_invoices";

        $this->data['recent_invoices']=$this->invoices->get_recent_invoices__(5,$start);//NOT ENTERED
        $data['recent_invoices_number']=$this->invoices->get_recent_invoices__count();


        /*
        NOW SETTING UP PAGINATION
        */

        $this->load->library('pagination');
        $config['base_url'] = base_url().'hsc/daily_manual_invoices/';
        $config['total_rows'] = $data['recent_invoices_number'];
        $config['per_page'] = 5;
        $data['per_page']=$config['per_page'];

        /*
        Beutifying  PAGINATION
        */

        $config['full_tag_open'] = "<div id='page-fad-paginate' > <ul class='pagination'>";
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = "<fahad class=' fa fa-arrow-right'><fahad>";
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = "<neo class='fa fa-arrow-left'><neo>";
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='cur_link_page'><a  href='#' rel='active_page'><b >";
        $config['cur_tag_close'] = '</b></a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['full_tag_close'] = '</ul></div>';
        //$config['display_pages'] = FALSE;
        $this->pagination->initialize($config);
        $data['pages']=$this->pagination->create_links();


        //add this kwa kila mwisho wa data zote
        $data = $this->data + $data;

        $this->load->view('includes/header',$data);
        $this->load->view('includes/top_nav');
        $this->load->view('includes/side_bar');
        $this->load->view('includes/title');

        $this->load->view('dailyinvoices/daily_invoices');
        $this->load->view('includes/footer');
    }

    function manual_invoice_redirect(){
        redirect(base_url('hsc/daily_manual_invoices'));
        die();
    }

    function determine_invoice($show){
        switch($show){
            case '0':
                $this->session->set_userdata('show',0);
                $this->manual_invoice_redirect();
                break;

            case '1':
                $this->session->set_userdata('show',1);
                $this->manual_invoice_redirect();
                break;

            case '3':
                $this->session->set_userdata('show',3);
                $this->manual_invoice_redirect();
                break;
            default :
                $this->session->set_userdata('show',2);
                $this->manual_invoice_redirect();
                break;

        }


    }

    function daily_returns()
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
        $this->load->view('includes/title');

        $this->load->view('dailyreturns/daily_returns');
        $this->load->view('includes/footer');
    }


    function sales_vouchers()
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
        $this->load->view('includes/title');

        $this->load->view('salesvouchers/sales_vouchers');
        $this->load->view('includes/footer');
    }

    function notifications($start=0){//},$sort=0){

        /*
        * Specific Data for one page goes here
        */

        $data['active'] =   "notification";
        $data['title']  =   "Notifications";
        $data['active_tab']="sales_vouchers";

        $data['notifications']=$this->usuals->get_all_activities(13,$start);//later weka sort
        $data['notifications_number']=$this->usuals->get_notifications_count();


        /*
        NOW SETTING UP PAGINATION
        */

        $this->load->library('pagination');
        $config['base_url'] = base_url().'hsc/notifications/';
        $config['total_rows'] = $data['notifications_number'];
        $config['per_page'] = 6;
        $data['per_page']=$config['per_page'];

        /*
        Beutifying  PAGINATION
        */

        $config['full_tag_open'] = "<div id='page-fad-paginate' > <ul class='pagination'>";
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = "<fahad class=' fa fa-arrow-right'><fahad>";
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = "<neo class='fa fa-arrow-left'><neo>";
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='cur_link_page'><a  href='#' rel='active_page'><b >";
        $config['cur_tag_close'] = '</b></a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['full_tag_close'] = '</ul></div>';
        //$config['display_pages'] = FALSE;
        $this->pagination->initialize($config);
        $data['pages']=$this->pagination->create_links();


        //add this kwa kila mwisho wa data zote
        $data = $this->data + $data;
        $this->load->view('includes/header',$data);
        $this->load->view('includes/top_nav');
        $this->load->view('includes/side_bar');
        $this->load->view('includes/title');

        $this->load->view('notifications/notify');
        $this->load->view('includes/footer');

    }


}

