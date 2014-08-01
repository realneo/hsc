<?php
/**
 * Created Using Fadsel Engine.
 * User: Fahad
 * Date: 7/16/14
 * Time: 9:22 AM
 */

class Reports extends CI_Controller{
    //great for initializing default variables
    protected  $data = array();
    function __construct()
    {
        parent::__construct();

		if(!$this->session->userdata('user_id')){
			$this->session->set_flashdata('alert_type','danger');
	       	$this->session->set_flashdata('alert_msg', 'You have to login first');
	
			redirect('login');
            die();
		}
		
        $this->load->model('usuals');
        $this->load->model('expenses');
        $this->load->model('invoices');
        $this->load->model('returns');
        $this->load->model('vouchers');
        $this->load->model('report');
        $this->load->model('audited_sales');
        $this->load->model('staffs');


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



        $this->data['logs']=$this->usuals->get_recent_activities();
        $this->data['branches']=$this->usuals->get_branches();
        $this->data['recent_total']=$this->usuals->get_recent_total_sales();


        $this->data['recent_expenses']=$this->expenses->get_recent_expenses();
        $this->data['recent_invoices']=$this->invoices->get_recent_invoices();

        $this->data['recent_returns']=$this->returns->get_recent_returns();
        $this->data['recent_vouchers']=$this->vouchers->get_recent_vouchers();
        $this->data['users']=$this->vouchers->get_users();


        /*
         * USED DATA
         */
//        $this->data['total_sales_according_to_date']=$this->report->get_total_sales();
//        $this->data['total_binding_according_to_date']=$this->report->get_total_binding();

//        $this->data['total_expenses_according_to_date']=$this->report->get_total_expenses();

        $this->data['total_expenses_activity']=$this->report->get_expense_activity();



//        $this->data['total_returns_according_to_date']=$this->report->get_total_returns();







    }



    public function index()
    {

        /*
         * Specific Data for one page goes here
         */
        $data['title']=$this->session->userdata('branch_name')." Cash Collection Report";
        $data['active']="report";
        $data['active_tab']="cash";

        //add this kwa kila mwisho wa data zote
        $data = $this->data + $data;
        $this->load->view('includes/header',$data);
        $this->load->view('includes/top_nav');
        $this->load->view('includes/side_bar');
        $this->load->view('includes/title');

        $this->load->view('report/cash');
        $this->load->view('includes/footer');
    }

    function cash(){
        $this->index();

    }

    function report_redirect(){
        redirect(base_url('reports'));
        die();
    }

    function sales_redirect(){
        redirect(base_url('reports/sales_report'));
        die();
    }

    function change_report_date(){
        $date=$this->input->post('date');
        $this->session->set_userdata('report_date',$date);
        $this->report_redirect();
    }

    function change_sales_date(){
        $date=$this->input->post('date');
        $this->session->set_userdata('report_date',$date);
        $this->sales_redirect();
    }

    function sales_report(){
        /*
         * Specific Data for one page goes here
         */
        $data['title']="Sales Report";
        $data['active']="report";
        $data['active_tab']="cash";

        //add this kwa kila mwisho wa data zote
        $data = $this->data + $data;
        $this->load->view('includes/header',$data);
        $this->load->view('includes/top_nav');
        $this->load->view('includes/side_bar');
        $this->load->view('includes/title');

        $this->load->view('report/cash_in_hand');
        $this->load->view('includes/footer');

    }

    function edit_audited_amount(){
// Get information from the form

        $amount = $this->input->post('amount');
        $id = $this->input->post('id');
        $branch_id = $this->input->post('branch_id');
//        var_dump($_POST);

        $user_id = $this->session->userdata('user_id');
        $full_name = $this->session->userdata('full_name');


        // Remove "," from the total_sale
        $amount = str_replace( ',', '', $amount);


        // Check if all fields are filled;


        if(!$amount){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg','You have to insert the <strong>Amount</strong>, if there isnt any insert 0.00');

            $this->sales_report_redrect();
        }

        // Update into Expenses database
        /*
         * It must be added when the daily sale is added!!!
         * CHECK FOR THIS LATER
         */

        $query = $this->audited_sales->update_audited_sale($amount,$id,$branch_id);
        $amount=make_me_bold(number_format($amount));
        if($query){
            if($this->session->userdata('affected_rows')<=0){
                $this->session->set_flashdata('alert_type','warning');
                $this->session->set_flashdata('alert_msg','Audited Total Sale for '.make_me_bold($this->usuals->get_branch_name($branch_id)).' can only be added when its <b>Daily sale</b> is available, try adding <b>Daily Sale</b> first!');

                $this->sales_report_redrect();
            }

            $this->session->set_flashdata('alert_type','success');
            $this->session->set_flashdata('alert_msg',"Success {$full_name}! ,Tsh {$amount} Audited Sale was added to the daily sale of ".$this->usuals->get_branch_name($branch_id));

            // Write into Log
            $log = "Daily Audited : Tsh $amount, was added to the daily sale of ".make_me_bold($this->usuals->get_branch_name($branch_id));
            $msg=$log;
            $this->usuals->log_write($user_id,$branch_id,$msg);
            $this->sales_report_redrect();
        }else{
            $this->session->set_flashdata('alert_type','danger');
            $this->session->set_flashdata('alert_msg','There was a problem with the system please try again!');

            $this->sales_report_redrect();

        }


    }

    /*
     * This function failed for now , may be later
     */
    function add_audited_amount__delete_it_later(){
        //var_dump($_POST);
        print_r($_POST);
        /*
    You will get 'pk', 'name' and 'value' in $_POST array.
    */
        $pk = $_POST['pk'];
        $name = $_POST['name'];
        $value = $_POST['value'];

        /*
         Check submitted value
        */
        if(!empty($value)) {
            /*
              If value is correct you process it (for example, save to db).
              In case of success your script should not return anything, standard HTTP response '200 OK' is enough.

              for example:
              $result = mysql_query('update users set '.mysql_escape_string($name).'="'.mysql_escape_string($value).'" where user_id = "'.mysql_escape_string($pk).'"');
            */
            $this->audited_sales->add_audited_sales();
            //here, for debug reason we just return dump of $_POST, you will see result in browser console
            print_r($_POST);


        } else {
            /*
            In case of incorrect value or error you should return HTTP status != 200.
            Response body will be shown as error message in editable form.
            */

            header('HTTP 400 Bad Request', true, 400);
            echo "This field is required!";
        }

        if($this->audited_sales->add_audited_sales()){
            echo 0;

        }else{
            echo 1;

        }
    }

    function audited_edit(){
        $this->session->set_userdata('edit_audited',true);
        $this->sales_report_redrect();
    }
    function audited_view(){
        $this->session->set_userdata('edit_audited',false);
        $this->sales_report_redrect();
    }

    function sales_report_redrect(){
        redirect(base_url('reports/sales_report'));
        die();
    }

    function user_report(){
        /*
         * Specific Data for one page goes here
         */
        $data['title']="General User Report";
        $data['active']="report";
        $data['active_tab']="other_report";
        $data['staffs']=$this->staffs->get_users();

        //add this kwa kila mwisho wa data zote
        $data = $this->data + $data;
        $this->load->view('includes/header',$data);
        $this->load->view('includes/top_nav');
        $this->load->view('includes/side_bar');
        $this->load->view('includes/title');

        $this->load->view('report/user');
        $this->load->view('includes/footer');

    }

    function returns_report($start=0){
        /*
         * Specific Data for one page goes here
         */


        $data['title']= "General Returns report";
        $data['active']="report";
        $data['active_tab']="cash";

        $data['all_returns']=$this->returns->get_returns_from_all_branches(30,$start);

        $data['unchecked_no']=$this->returns->get_number_of_returns_from_all_branches();
        $data['returns_no'] = $this->returns->get_number_of_returns_from_all_branches_according_to_session();


        $data['staffs']=$this->staffs->get_users();


        /*
        NOW SETTING UP PAGINATION
        */

        $this->load->library('pagination');
        $config['base_url'] = base_url().'reports/returns_report/';
        $config['total_rows'] = $data['returns_no'];
        $config['per_page'] = 10;
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

        $this->load->view('report/returns');
        $this->load->view('includes/footer');

    }


    function cheque_report($start=0){
        /*
         * Specific Data for one page goes here
         */
        $data['title']= "General Cheque report";
        $data['active']= "report";
        $data['active_tab']= "cash";


        $data['cheques']=$this->report->get_cheque_from_all_branches($per_page=20,$start);

        $data['total_no_of_cheque']=$this->report->get_cheque_no_from_all_branches();

        /*
        NOW SETTING UP PAGINATION
        */

        $this->load->library('pagination');
        $config['base_url'] = base_url().'reports/cheque_report/';
        $config['total_rows'] = $data['total_no_of_cheque'];
        $config['per_page'] = $per_page;
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

        $this->load->view('report/cheque');
        $this->load->view('includes/footer');

    }

    function payment($start=0){
        /*
         * Specific Data for one page goes here
         */
        $data['title']=$this->session->userdata('branch_name')." Payment report";
        $data['active']="report";
        $data['active_tab']="other_report";
        $data['expenses']=$this->report->get_expenses_from_all_branches($per_page=20,$start);

        $data['total_no_of_expenses']=$this->report->get_expenses_no_from_all_branches();

        /*
        NOW SETTING UP PAGINATION
        */

        $this->load->library('pagination');
        $config['base_url'] = base_url().'reports/payment/';
        $config['total_rows'] = $data['total_no_of_expenses'];
        $config['per_page'] = $per_page;
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

        $this->load->view('report/payment');
        $this->load->view('includes/footer');

    }

    function binding($start=0){
        /*
         * Specific Data for one page goes here
         */
        $data['title']=$this->session->userdata('branch_name')." Binding report";
        $data['active']="report";
        $data['active_tab']="other_report";

        $data['binding']=$this->report->get_binding_from_all_branches($per_page=20,$start);

        $data['total_no_of_binding']=$this->report->get_binding_no_from_all_branches();

        /*
        NOW SETTING UP PAGINATION
        */

        $this->load->library('pagination');
        $config['base_url'] = base_url().'reports/binding/';
        $config['total_rows'] = $data['total_no_of_binding'];
        $config['per_page'] = $per_page;
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

        $this->load->view('report/binding');
        $this->load->view('includes/footer');

    }



    function produce_variance(){
        // Get information from the form

        $date = $this->input->post('report_date');
        $user_id_sales = $this->input->post('user_id');
        $variance = $this->input->post('variance');
        $branch_id = $this->input->post('branch_id');

        // Remove "," from the total_sale
        $variance = str_replace( ',', '', $variance);

        $user_id = $this->session->userdata('user_id');
        $full_name = $this->session->userdata('full_name');





        // Check if all fields are filled;

        if(!$date){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg','The <strong>Date</strong> is not ready yet');
            $this->sales_report_redrect();
        }

        if(!$user_id_sales){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg','Sales Report is not ready yet , <b>Audited daily sale</b> is missing!');
            $this->sales_report_redrect();
        }


        /*
        if(!$variance){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg','The variance is not ready yet');

            $this->sales_report_redrect();
        }
        */

        // Insert into Variance database

        $query = $this->report->add_variance($date,$variance,$user_id_sales,$branch_id);

        $variance=number_format($variance);
        if($query){
            if($this->session->userdata('affected_rows')>=1){
                $this->session->set_flashdata('alert_type','success');
                $this->session->set_flashdata('alert_msg',"Thank you {$full_name}! , Sales report for this branch has been <b>updated</b>!");

                // Write into Log
                $log = "Sales Report : With variance of Tsh $variance/=, was updated for $date";
                $msg=$log;
                $this->usuals->log_write($user_id,$branch_id,$msg);
                $this->sales_report_redrect();
            }

            $this->session->set_flashdata('alert_type','success');
            $this->session->set_flashdata('alert_msg',"Thank you {$full_name}! , Sales report for this branch has been produced, you can now keep track of the variance!");

            // Write into Log
            $log = "Sales Report : With variance of Tsh $variance/=, was produce for $date";
            $msg=$log;
            $this->usuals->log_write($user_id,$branch_id,$msg);
            $this->sales_report_redrect();
        }else{
            $this->session->set_flashdata('alert_type','danger');
            $this->session->set_flashdata('alert_msg','There was a problem with the system please try again!');

            $this->sales_report_redrect();

        }


    }

    function returns_report_redirect(){
        redirect(base_url('reports/returns_report'));
        die();
    }

    function approve_return($id){
        $user_id = $this->session->userdata('user_id');
        $full_name = $this->session->userdata('full_name');

        /*
         * We Branch ID for the log
         */

        $get_id = $this->report->get_report($id);
        if($get_id){
            $branch_id= $get_id[0]['branch_id'];
            $item_returned= $get_id[0]['item_returned'];
            $item_returned= make_me_bold($item_returned);


        $query = $this->report->approved_return($id);

        if($query){
            if($this->session->userdata('affected_rows')>=1){
                $this->session->set_flashdata('alert_type','success');
                $this->session->set_flashdata('alert_msg',"Thank you {$full_name}! , {$item_returned} has been <b>Checked</b> successfully!");

                // Write into Log
                $log = "Returns Report : {$full_name} Approved returns from ".make_me_bold($this->usuals->get_branch_name($branch_id));;
                $msg=$log;
                $this->usuals->log_write($user_id,$branch_id,$msg);

                $this->returns_report_redirect();
            }


        }else{

            $this->session->set_flashdata('alert_type','danger');
            $this->session->set_flashdata('alert_msg','There was a problem with the system please try again!');

            $this->returns_report_redirect();

        }
        }else{
            $this->session->set_flashdata('alert_type','danger');
            $this->session->set_flashdata('alert_msg','Sorry , We dont have that record, it might be missing or deleted!');

            $this->returns_report_redirect();
}


    }

    function cheque_report_redirect(){
        redirect(base_url('reports/cheque_report'));
        die();
    }

    function cheque_report_check($id){
        $user_id = $this->session->userdata('user_id');
        $full_name = $this->session->userdata('full_name');

        /*
         * We Branch ID for the log
         */

        $get_id = $this->report->get_cheque($id);
        if($get_id){
            $branch_id= $get_id[0]['branch_id'];
            $chq_number= $get_id[0]['chq_number'];
            $chq_number= make_me_bold($chq_number);


        $query = $this->report->clear_cheque($id);

        if($query){
            if($this->session->userdata('affected_rows')>=1){
                $this->session->set_flashdata('alert_type','success');
                $this->session->set_flashdata('alert_msg',"Thank you {$full_name}! , Cheque with number {$chq_number} has been <b>Cleared</b> successfully!");

                // Write into Log
                $log = "Returns Report : {$full_name} Approved returns from ".make_me_bold($this->usuals->get_branch_name($branch_id));;
                $msg=$log;
                $this->usuals->log_write($user_id,$branch_id,$msg);

                $this->cheque_report_redirect();
            }


        }else{

            $this->session->set_flashdata('alert_type','danger');
            $this->session->set_flashdata('alert_msg','There was a problem with the system please try again!');

            $this->cheque_report_redirect();

        }
        }else{
            $this->session->set_flashdata('alert_type','danger');
            $this->session->set_flashdata('alert_msg','Sorry , We dont have that record, it might be missing or deleted!');

            $this->cheque_report_redirect();
}


    }

    function return_change_status($status){
        switch(strtolower( $status )){
            case 1:
                $this->session->set_userdata('status','checked');
                $this->returns_report_redirect();
                break;

            case 2:
                $this->session->set_userdata('status','unchecked');
                $this->returns_report_redirect();
                break;

            default:
                $this->session->set_userdata('status','');
                $this->session->set_userdata('status',0);
                $this->returns_report_redirect();
                break;

        }
    }

    function use_cheque(){
        $id = $this->input->post('id');
        $amount = $this->input->post('amount');

        $amount = str_replace( ',', '', $amount);

        $date_issued = $this->input->post('date_issued');
        $date_posted = $this->input->post('date_posted');
        $branch_id = $this->session->userdata('branch_id');
        $user_id = $this->session->userdata('user_id');
        $full_name = $this->session->userdata('full_name');

        $today = date("Y-m-d");
        // Check if all fields are filled;


        if($amount==0.00 OR !$amount){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg','You have to insert an <strong>amount</strong>');

            $this->cheque_report_redirect();

        }

        // Get the Check for that ID

        $chq = $this->report->get_cheque($id);
        $db_amount = $chq[0]['amount'];
        $db_balance_log = $this->report->get_cheque_log_total($id);
//        var_dump('log amount '.$db_amount_log,'db_balance_log'.$db_balance_log,'amount'.$amount);
//        die();
        // If the amount is greater
        if($db_amount - ($db_balance_log+$amount)<0.00){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg','The amount entered is <strong>GREATER</strong> than the one in the database');

            $this->cheque_report_redirect();

        }


        // If the amount is equal

        if(($db_amount - ($db_balance_log+$amount)) == 0.00){

            $clear_update = $this->report->complete_cheque($id,$date_issued,$amount,$date_posted);

            if($clear_update){
                $this->session->set_flashdata('alert_type','success');
                $this->session->set_flashdata('alert_msg','Successfully Used <strong>Tsh '.$amount.'</strong>.');

                $log = "Used Cheque: Tsh $amount by $full_name";
                $this->usuals->log_write($user_id, $branch_id, $log);

                $this->cheque_report_redirect();

            }else{
                $this->session->set_flashdata('alert_type','danger');
                $this->session->set_flashdata('alert_msg','There was a problem with the system please try again!');

                $this->cheque_report_redirect();

            }

        }else{
//            $difference = 0;
//            $difference = $db_amount-$amount;
            $amount_update = $this->report->insert_cheque_progress($id,$amount,$date_issued,$date_posted);

            if($amount_update){
                $this->session->set_flashdata('alert_type','success');
                $this->session->set_flashdata('alert_msg','Successfully used <strong>Tsh '.$amount.'</strong>. from a cheque, Numbered '. make_me_bold($chq[0]['chq_number']));
                $today = date("Y-m-d");

                $log = "Used Cheque ".make_me_bold($chq[0]['chq_number']).": Tsh $amount , handled by  $full_name";
                $this->usuals->log_write($user_id, $branch_id, $log);

                $this->cheque_report_redirect();

            }else{
                $this->session->set_flashdata('alert_type','danger');
                $this->session->set_flashdata('alert_msg','There was a problem with the system please try again!');

                $this->cheque_report_redirect();

            }

        }

    }
}