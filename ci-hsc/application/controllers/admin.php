<?php
/**
 * Created Using Fadsel Engine.
 * User: Fahad
 * Date: 7/12/14
 * Time: 10:13 AM
 */

class Admin extends CI_Controller{
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

    }

    function add_daily_sales(){

        $this->session->set_flashdata('show','add_sales');
        redirect(base_url('hsc/daily_sales'));

        $this->admin->add_daily_sales();
    }
    /*
     * Adds Sales , check log msg
     */
    function daily_sales_add(){
        // Get information from the form
        $date = $this->input->post('date');
        $total_sale = $this->input->post('total_sale');
        $branch_id = $this->session->userdata('branch_id');
        $user_id = $this->session->userdata('user_id');
        $full_name = $this->session->userdata('full_name');

        // Remove "," from the total_sale
        $total_sale = str_replace( ',', '', $total_sale);

        // Check if all fields are filled

        if(!$total_sale){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg',
                'You have to insert your <strong>Total Sale</strong>');
            $this->add_daily_sales();

            die();
        }
        else{if($total_sale){

            // INSERT the Total Sale in the Database
            $inserted_results = $this->admin_->add_daily_sales($user_id,$branch_id,$date,$total_sale);



            if($inserted_results){

                $this->session->set_flashdata('alert_type','success');
                //$check=$this->db->affected_rows;//not good
                $check=$this->session->userdata('affected_rows');

                $date = date("Y-m-d");
                //var_dump($check);die();
                if($check>=1){
                    $this->session->set_flashdata('alert_msg',"Thank you ".make_me_bold($full_name)."!"); ;
                    $msg="Daily Sale : $total_sale for $date by $full_name";
                }else{
                    $this->session->set_flashdata('alert_msg',"Sorry ".make_me_bold($full_name).", we have the daily sales for ".make_me_bold($date).", Try edtting.");
                    $msg="Failed to add Daily Sale : Tsh $total_sale  for $date by $full_name,since we can only add 1 total sale per day.";
                    $this->session->set_flashdata('alert_type','warning');
                }
                $this->usuals->log_write($user_id,$branch_id,$msg);
                //var_dump($this->session->flashdata('alert_msg'));
                //die();
                $this->add_daily_sales();

                die();
            }else{
                $this->session->set_flashdata('alert_type','danger');
                $this->session->set_flashdata('alert_msg',"There was a problem with the system please try again!");

                $this->add_daily_sales();

                die();
            }


        }else{
            $this->session->set_flashdata('alert_type','danger');
            $this->session->set_flashdata('alert_msg',"There was a major problem with the system! , Try Contacting the administrator");

            $this->add_daily_sales();

            die();
        }


        }


    }

    function edit_daily_sales(){
        $this->session->set_flashdata('show','edit_sales');
        redirect(base_url('hsc/daily_sales'));
    }

    function daily_sales_edit(){
        // Get information from the form
        //$date = $this->input->post('date');
        $total_sale = $this->input->post('total_sale');
        $branch_id = $this->session->userdata('branch_id');
        $user_id = $this->session->userdata('user_id');
        $full_name = $this->session->userdata('full_name');

        // Remove "," from the total_sale
        $total_sale = str_replace( ',', '', $total_sale);

        // Check if all fields are filled

        if(!$total_sale){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg',
                'You have to insert your <strong>Total Sale</strong>');
            $this->edit_daily_sales();
            die();
        }
        else{if($total_sale){

            // Update the Total Sale in the Database
            $updated_results = $this->admin_->edit_daily_sales($total_sale,$branch_id);



            if($updated_results){

                $this->session->set_flashdata('alert_type','success');
                //$check=$this->db->affected_rows;//not good
                $check=$this->session->userdata('affected_rows');
                $date = date("Y-m-d");
                var_dump($check);
                if($check>=1){
                    $this->session->set_flashdata('alert_msg',"Thank you ".make_me_bold($full_name)."!"); ;
                    $msg="Edited Daily Sale : $total_sale for $date by $full_name";
                }else{
                    $this->session->set_flashdata('alert_msg',"Sorry ".make_me_bold($full_name).", we dont have total sales inserted for ".make_me_bold($date)." yet!");
                    $msg="Failed to edit Daily Sale : $total_sale for $date by $full_name,it was not available";
                    $this->session->set_flashdata('alert_type','warning');
                }
                $this->usuals->log_write($user_id,$branch_id,$msg);
                //var_dump($this->session->flashdata('alert_msg'));
                //die();
                $this->edit_daily_sales();

                die();
            }else{
                $this->session->set_flashdata('alert_type','danger');
                $this->session->set_flashdata('alert_msg',"There was a problem with the system please try again!");

                $this->edit_daily_sales();

                die();
            }


        }else{
            $this->session->set_flashdata('alert_type','danger');
            $this->session->set_flashdata('alert_msg',"There was a major problem with the system! , Try Contacting the administrator");

            $this->edit_daily_sales();

            die();
        }


        }

    }

    function edit_daily_binding(){
        $this->session->set_flashdata('show','edit_binding');
        redirect(base_url('hsc/daily_sales'));
    }

    function daily_binding_edit(){
        // Get information from the form
        //$date = $this->input->post('date');
        $total_sale = $this->input->post('total_sale');
        $branch_id = $this->session->userdata('branch_id');
        $user_id = $this->session->userdata('user_id');
        $full_name = $this->session->userdata('full_name');

        // Remove "," from the total_sale
        $total_sale = str_replace( ',', '', $total_sale);

        // Check if all fields are filled

        if(!$total_sale){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg',
                'You have to insert your <strong>Total Binding</strong>');
            $this->edit_daily_binding();
            //redirect(base_url('admin/edit_daily_binding'));
            die();
        }
        else{if($total_sale){

            // Update the Total Binding in the Database
            $updated_results = $this->admin_->edit_daily_binding($total_sale,$branch_id);



            if($updated_results){

                $this->session->set_flashdata('alert_type','success');
                //$check=$this->db->affected_rows;//not good
                $check=$this->session->userdata('affected_rows');
                $date = date("Y-m-d");
                //var_dump($check);
                if($check>=1){
                    $this->session->set_flashdata('alert_msg',"Thank you ".make_me_bold($full_name)."!"); ;
                    $msg="Edited Daily Binding : $total_sale for $date by $full_name";
                }else{
                    $this->session->set_flashdata('alert_msg',"Sorry ".make_me_bold($full_name).", we dont have Binding inserted for ".make_me_bold($date)." yet!");
                    $msg="Failed to edit Daily Binding : $total_sale for $date by $full_name,it was not available";
                    $this->session->set_flashdata('alert_type','warning');
                }
                $this->usuals->log_write($user_id,$branch_id,$msg);
                //var_dump($this->session->flashdata('alert_msg'));
                //die();
                $this->edit_daily_binding();

                die();
            }else{
                $this->session->set_flashdata('alert_type','danger');
                $this->session->set_flashdata('alert_msg',"There was a problem with the system please try again!");

                $this->edit_daily_binding();

                die();
            }


        }else{
            $this->session->set_flashdata('alert_type','danger');
            $this->session->set_flashdata('alert_msg',"There was a major problem with the system! , Try Contacting the administrator");

            $this->edit_daily_binding();

            die();
        }


        }

    }

    function daily_expense_redirect(){
        redirect(base_url().'hsc/daily_expenses');
        die();
    }

    function daily_expense_add(){
        // Get information from the form

        $date = $this->input->post('date');
        $purpose = $this->input->post('purpose');
        $received_by = $this->input->post('received_by');
        $amount = $this->input->post('amount');
        $branch_id = $this->session->userdata('branch_id');
        $user_id = $this->session->userdata('user_id');
        $full_name = $this->session->userdata('full_name');


        // Remove "," from the total_sale
        $amount = str_replace( ',', '', $amount);

        // Check if all fields are filled;

        if(!$date){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg','You have to select a <strong>Date</strong>');
            $this->daily_expense_redirect();
        }

        if(!$purpose){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg','You have to insert the <strong>Purpose</strong> of the Expense');

            $this->daily_expense_redirect();
        }

        if(!$amount){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg','You have to insert the <strong>Amount</strong>');

            $this->daily_expense_redirect();
        }

        // Insert into Expenses database

        $query = $this->admin_->add_expense($date, $purpose, $received_by, $amount, $branch_id, $user_id);


        if($query){
            $this->session->set_flashdata('alert_type','success');
            $this->session->set_flashdata('alert_msg',"Thank you {$full_name}!");

            // Write into Log
            $log = "Daily Expense : Tsh $amount, used for ".make_me_bold($purpose)." on $date";
            $msg=$log;
            $this->usuals->log_write($user_id,$branch_id,$msg);
            $this->daily_expense_redirect();
        }else{
            $this->session->set_flashdata('alert_type','danger');
            $this->session->set_flashdata('alert_msg','There was a problem with the system please try again!');

            $this->daily_expense_redirect();

        }


    }

    function daily_expense_delete($id_){
        // Get information from the form

        $flash=$this->session->flashdata('post_data_'.$id_);
        $id = $id_;//$this->input->post('id');
        $purpose = $flash['purpose'];
        $amount = $flash['amount'];
        $full_name = $this->session->userdata('full_name');
        $branch_id = $this->session->userdata('branch_id');
        $user_id=$this->session->userdata('user_id');

        if($this->session->flashdata('post_data_'.$id)['id']==$id){

            // Delete the Daily Expense
            $this->expenses->daily_expense_delete($id);
            $check=$this->session->userdata('affected_rows');

            if($check>=1){

                $this->session->set_flashdata('alert_type','success');
                $this->session->set_flashdata('alert_msg','Tsh '.make_me_bold($amount)." for '".make_me_bold($purpose)."' was deleted successfully, Thank you {$full_name}!");
                $msg="Deleted Expense : ".make_me_bold($amount)." Tsh for ".make_me_bold($purpose)." by $full_name";
                $this->usuals->log_write($user_id,$branch_id,$msg);
                $this->daily_expense_redirect();
                die();
            }else{
                $this->session->set_flashdata('alert_type','warning');
                $this->session->set_flashdata('alert_msg','Nothing was deleted , Contact Administrator.');


                $this->daily_expense_redirect();
                die();
            }

        }else{
            $this->session->set_flashdata('alert_type','danger');
            $this->session->set_flashdata('alert_msg',"Try to delete from the system");

            $this->daily_expense_redirect();
            die();
        }


    }

    function manual_invoice_delete($id_){
        // Get information from the form

        $flash=$this->session->flashdata('post_data_'.$id_);
        $id = $id_;//$this->input->post('id');
        $purpose = $flash['purpose'];
        $amount = $flash['amount'];
        $full_name = $this->session->userdata('full_name');
        $branch_id = $this->session->userdata('branch_id');
        $user_id=$this->session->userdata('user_id');

        if($this->session->flashdata('post_data_'.$id)['id']==$id){

            // Delete the Daily Expense
            $this->invoices->manual_invoice_delete($id);
            $check=$this->session->userdata('affected_rows');

            if($check>=1){

                $this->session->set_flashdata('alert_type','success');
                $this->session->set_flashdata('alert_msg','Tsh '.make_me_bold($amount)." was deleted successfully, Thank you {$full_name}!");
                $msg="Deleted Invoice : Tsh ".make_me_bold($amount)." for ".make_me_bold($purpose)." by $full_name";
                $this->usuals->log_write($user_id,$branch_id,$msg);
                $this->manual_invoice_redirect();
                die();
            }else{
                $this->session->set_flashdata('alert_type','warning');
                $this->session->set_flashdata('alert_msg','Nothing was deleted , Contact Administrator.');


                $this->manual_invoice_redirect();
                die();
            }

        }else{
            $this->session->set_flashdata('alert_type','danger');
            $this->session->set_flashdata('alert_msg',"Try to delete from the system");

            $this->manual_invoice_redirect();
            die();
        }


    }

    function manual_enter(){
        // Get information from the form
        $id = $this->input->post('id');
        $amount = $this->input->post('amount');
        $branch_id = $this->session->userdata('branch_id');
        $branch_name = $this->session->userdata('branch_name');
        $user_id = $this->session->userdata('user_id');
        $full_name = $this->session->userdata('full_name');

        $today = date("Y-m-d");
        // Check if all fields are filled;


        if(!$amount){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg','You have to insert an <strong>amount</strong>');

            $this->enter_manual_redirect();
            die();
        }

        // Get the Total Manual Invoice of that date

        $manuals = $this->invoices->get_total_manual_invoice($id);
        $db_amount = $manuals[0]['amount'];
        // If the amount is greater
        if(($db_amount-$amount)<0){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg','The amount entered is <strong>GREATER</strong> than the one in the database');

            $this->enter_manual_redirect();
            die();
        }


        // If the amount is equal
        if(($db_amount-$amount) === 0){

            $clear_update = $this->invoices->complete_invoice($id,$amount);

            if($clear_update){
                $this->session->set_flashdata('alert_type','success');
                $this->session->set_flashdata('alert_msg','Successfully Entered Manual Invoice : <strong>Tsh '.$amount.'</strong>.');

                $log = "Entered Manual Invoice: Tsh $amount by $full_name";
                $this->usuals->log_write($user_id, $branch_id, $log);

                $this->enter_manual_redirect();
                die();

            }else{
                $this->session->set_flashdata('alert_type','danger');
                $this->session->set_flashdata('alert_msg','There was a problem with the system please try again!');

                $this->enter_manual_redirect();
                die();

            }

        }else{
            $difference = 0;
            $difference = $db_amount-$amount;
            $amount_update = $this->invoices->update_invoice($id,$difference,$amount);

            if($amount_update){
                $this->session->set_flashdata('alert_type','success');
                $this->session->set_flashdata('alert_msg','Successfully Entered Manual Invoice : <strong>Tsh '.$amount.'</strong>.');
                $today = date("Y-m-d");

                $log = "Entered Manual Invoice: Tsh $amount by $full_name";
                $this->usuals->log_write($user_id, $branch_id, $log);

                $this->enter_manual_redirect();
                die();

            }else{
                $this->session->set_flashdata('alert_type','danger');
                $this->session->set_flashdata('alert_msg','There was a problem with the system please try again!');

                $this->enter_manual_redirect();
                die();

            }

        }

    }

    function enter_manual_redirect(){
        $this->session->set_userdata('view_invoices',true);
        redirect(base_url().'hsc/daily_manual_invoices');
        die();
    }
    function view_manual_redirect(){
        $this->session->set_userdata('view_invoices',false);
        redirect(base_url().'hsc/daily_manual_invoices');
        die();
    }

    function manual_invoice_redirect(){
        redirect(base_url().'hsc/daily_manual_invoices');
        die();
    }

    function manual_invoice_add(){
        // Get information from the form

        $date = $this->input->post('date');
        $amount = $this->input->post('amount');
        $branch_name = $this->session->userdata('branch_name');
        $branch_id = $this->session->userdata('branch_id');
        $full_name = $this->session->userdata('full_name');
        $user_id = $this->session->userdata('user_id');

        // Check if all fields are filled;

        if(!$date){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg',
                'You have to select a <strong>date</strong>');
            $this->manual_invoice_redirect();
            die();
        }

        if(!$amount){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg',
                'You have to insert an <strong>amount</strong>');
            $this->manual_invoice_redirect();
            die();
        }


        if($this->invoices->check_manual_invoices($date)>=1){
            $date=custom_date_format($date);
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg',"We already have manual invoice for {$date}!, Please try entering it");

            $this->manual_invoice_redirect();
            die();

        }
        else{
            // Insert new Manual Invocie in the Database
            $insert_results = $this->invoices->add_manual_invoice($amount,$date);

        }


        if($insert_results){
            $this->session->set_flashdata('alert_type','success');
            $this->session->set_flashdata('alert_msg',"Successfully Added Manual Invoice for {$date} : <strong> Tsh".$amount."</strong>.");

            $today = date("Y-m-d");
            $log = "Manual Invoice: Tsh $amount by $full_name";
            $this->usuals->log_write($user_id, $branch_id, $log);

            $this->manual_invoice_redirect();
            die();
        }else{
            $this->session->set_flashdata('alert_type','danger');
            $this->session->set_flashdata('alert_msg',"There was a problem with the system please try again!");

            $this->manual_invoice_redirect();
            die();
        }

    }

    function returns_redirect(){
        redirect(base_url().'hsc/daily_returns');
        die();
    }

    function add_return(){
        $this->returns->get_recent_returns();
        // Get information from the form

        $date =$this->input->post('date');
        $action = $this->input->post('action');
        $amount = $this->input->post('amount');
        $receipt_number = $this->input->post('receipt_number');
        $branch_id = $this->session->userdata('branch_id');
        $full_name = $this->session->userdata('full_name');
        $user_id = $this->session->userdata('user_id');


        // Remove "," from the numbers
        $amount = str_replace( ',', '', $amount);

        // Check if all fields are filled;

        if(!$date){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg',
                'You have to select a <strong>date</strong>');


            redirect(base_url().'hsc/daily_returns');
            die();
        }

        if(!$action){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg',
                'You have to fill in <strong>Action</strong> field, it is required!');

            redirect(base_url().'hsc/daily_returns');
            die();
        }
        if(!$receipt_number OR !is_numeric($receipt_number)){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg',
                'You have to fill in <strong>Receipt Number</strong> field');
            if(!is_numeric($amount)){
                $this->session->set_flashdata('alert_msg',
                    'Sorry the <b>Receipt Number</b> field has to be a number');
            }

            redirect(base_url().'hsc/daily_returns');
            die();
        }

        if(!$amount OR !is_numeric($amount)){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg',
                'You have to fill in the <strong>Amount</strong> field');
            if(!is_numeric($amount)){
                $this->session->set_flashdata('alert_msg',
                    'Sorry the <b>Amount</b> field has to be a number');
            }


            redirect(base_url().'hsc/daily_returns');
            die();
        }

        if(true){
            // Insert the Return in the Database
            $insert_results = $this->returns->insert_return($date, $action, $receipt_number, $user_id, $branch_id, $amount);

            if($insert_results){
                $this->session->set_flashdata('alert_type','success');
                $this->session->set_flashdata('alert_msg',"Successfully Added return for {$date} : <strong>Tsh ".$amount."</strong>.,Thank you {$full_name}!");

                $today = date("Y-m-d");
                $log = "Returned $action on $date";
                $this->usuals->log_write($user_id, $branch_id, $log);

                redirect(base_url().'hsc/daily_returns');
                die();
            }else{

                $this->session->set_flashdata('alert_type','danger');
                $this->session->set_flashdata('alert_msg',"There was a problem with the system please try again!");

                redirect(base_url().'hsc/daily_returns');
                die();
            }


        }else{
            $this->session->set_flashdata('alert_type','danger');
            $this->session->set_flashdata('alert_msg',"There was a major problem with the system please try again!");

            redirect(base_url().'hsc/daily_returns');
            die();
        }

    }

    function delete_return($id_){
        // Get information from the form
        $flash=$this->session->flashdata('post_data_'.$id_);
        $date = $flash['date'];
        $action = $flash['action'];
        $amount = $flash['amount'];
        $id = $flash['id'];
        $receipt_number = $flash['receipt_number'];

        $full_name = $this->session->userdata('full_name');
        $branch_id = $this->session->userdata('branch_id');
        $user_id=$this->session->userdata('user_id');

        if($this->session->flashdata('post_data_'.$id)['id']==$id){

            // Delete the Daily Expense
            $this->returns->delete_return($id);
            $check=$this->session->userdata('affected_rows');

            if($check>=1){

                $this->session->set_flashdata('alert_type','success');
                $this->session->set_flashdata('alert_msg','Tsh '.make_me_bold($amount)." with receipt number of ".$receipt_number." was deleted successfully, Thank you {$full_name}!");
                $msg="Deleted Return : Tsh ".make_me_bold($amount)." for ".make_me_bold($action)." by $full_name";
                $this->usuals->log_write($user_id,$branch_id,$msg);
                $this->returns_redirect();
                die();
            }else{
                $this->session->set_flashdata('alert_type','warning');
                $this->session->set_flashdata('alert_msg','Nothing was deleted , Contact Administrator.');


                $this->returns_redirect();
                die();
            }

        }else{
            $this->session->set_flashdata('alert_type','danger');
            $this->session->set_flashdata('alert_msg',"Try to delete from the system");

            $this->returns_redirect();
            die();
        }


    }

    function vouchers_redirect(){
        redirect(base_url().'hsc/sales_vouchers');
        die();
    }

    function add_sales_voucher(){
        // Get information from the form

        $date = $this->input->post('date');
        $sales_id = $this->input->post('sales_id');
        $sales_voucher = $this->input->post('sales_voucher');
        $branch_id = $this->session->userdata('branch_id');
        $full_name =$this->session->userdata('full_name');
        $user_id = $this->session->userdata('user_id');

        /*
         * Make it LEAD
         */
        $full_name = make_me_bold(make_caps($full_name));

        // Getting Sales Name
        $query = $this->vouchers->get_user_profile($sales_id);

        foreach($query as $row){
            $sales_name = $row['first_name'] . ' ' . $row['last_name'];
            $sales_name = make_me_bold(make_caps($sales_name));

        }


        // Remove "," from the numbers
        $sales_voucher = str_replace( ',', '', $sales_voucher);

        // Check if all fields are filled;

        if(!$date){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg','You have to select a <strong>Date</strong>');

            $this->vouchers_redirect();
            die();
        }

        if(!$sales_id){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg',"Sorry, No salesman available!");


            $this->vouchers_redirect();
            die();
        }

        if(!$sales_voucher){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg',"You have to insert your <strong>Sales Voucher</strong>{$sales_name}!");


            $this->vouchers_redirect();
            die();
        }



        if(true){
            // Insert the Total Sale in the Database
            $insert_results = $this->vouchers->insert_voucher($date, $branch_id, $sales_id, $user_id, $sales_voucher);

            if($insert_results){
                $this->session->set_flashdata('alert_type','success');
                $this->session->set_flashdata('alert_msg',"<i class='fa fa-thumbs-up'></i> Send our regards to {$sales_name}, Great Job! Thank you {$full_name} ");

                $today = date("Y-m-d");
                $log = "$sales_name sold Tsh $sales_voucher on $date";
                $this->usuals->log_write($user_id, $branch_id, $log);

                $this->vouchers_redirect();
                die();
            }else{
                $this->session->set_flashdata('alert_type', 'danger');
                $this->session->set_flashdata('alert_msg',"There was a problem with the system please try again!");

                $this->vouchers_redirect();
                die();
            }


        }else{
            $this->session->set_flashdata('alert_type', 'danger');
            $this->session->set_flashdata('alert_msg',"There was a major problem, Please Retry!");

            $this->vouchers_redirect();
            die();
        }
    }
}