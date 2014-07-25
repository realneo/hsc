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
        $this->load->model('usuals');
        $this->load->model('expenses');
        $this->load->model('invoices');
        $this->load->model('returns');
        $this->load->model('vouchers');
        $this->load->model('report');
        $this->load->model('audited_sales');
        $this->load->model('staffs');


        /*
         * Set the Defaults
         */

        if(!$this->session->userdata("full_name")){
            $this->session->set_userdata("full_name","Fahad K");
        }

        if(!$this->session->userdata("user_id")){
            $this->session->set_userdata("user_id",2);
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
        $data['title']="Cash in Hand Collection Report";
        $data['active']="report";
        $data['active_tab']="sales_report";

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


        if($amount==0.00 OR !$amount){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg','You have to insert the <strong>Amount</strong>');

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
        $data['title']=$this->session->userdata('branch_name')." User Report";
        $data['active']="report";
        $data['active_tab']="user_report";
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

    function returns_report(){
        /*
         * Specific Data for one page goes here
         */
        $data['title']=$this->session->userdata('branch_name')." Returns report";
        $data['active']="report";
        $data['active_tab']="returns_report";
        $data['staffs']=$this->staffs->get_users();

        //add this kwa kila mwisho wa data zote
        $data = $this->data + $data;
        $this->load->view('includes/header',$data);
        $this->load->view('includes/top_nav');
        $this->load->view('includes/side_bar');
        $this->load->view('includes/title');

        $this->load->view('report/returns');
        $this->load->view('includes/footer');

    }


    function cheque_report(){
        /*
         * Specific Data for one page goes here
         */
        $data['title']=$this->session->userdata('branch_name')." Cheque report";
        $data['active']="report";
        $data['active_tab']="cheque_report";
        $data['staffs']=$this->staffs->get_users();

        //add this kwa kila mwisho wa data zote
        $data = $this->data + $data;
        $this->load->view('includes/header',$data);
        $this->load->view('includes/top_nav');
        $this->load->view('includes/side_bar');
        $this->load->view('includes/title');

        $this->load->view('report/cheque');
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


        if($variance=='' OR !$variance){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg','The variance is not ready yet');

            $this->sales_report_redrect();
        }

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
}