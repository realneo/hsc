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

    function add_audited_amount(){
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
}