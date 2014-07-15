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
                    $msg="Failed to add Daily Sale : $total_sale Tsh for $date by $full_name,since we can only add 1 total sale per day.";
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
                'You have to insert your <strong>Total Sale</strong>');
            $this->edit_daily_binding();
            //redirect(base_url('admin/edit_daily_binding'));
            die();
        }
        else{if($total_sale){

            // Update the Total Sale in the Database
            $updated_results = $this->admin_->edit_daily_binding($total_sale,$branch_id);



            if($updated_results){

                $this->session->set_flashdata('alert_type','success');
                //$check=$this->db->affected_rows;//not good
                $check=$this->session->userdata('affected_rows');
                $date = date("Y-m-d");
                //var_dump($check);
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
            $log = "Daily Expense : $amount Tsh , used for ".make_me_bold($purpose)." on $date";
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
                $this->session->set_flashdata('alert_msg',make_me_bold($amount)."Tsh for '".make_me_bold($purpose)."' was deleted successfully, Thank you {$full_name}!");
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
                $this->session->set_flashdata('alert_msg',make_me_bold($amount)."Tsh was deleted successfully, Thank you {$full_name}!");
                $msg="Deleted Invoice : ".make_me_bold($amount)." Tsh for ".make_me_bold($purpose)." by $full_name";
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

    function enter_manual(){
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
            $_SESSION['alert_type'] = 'warning';
            $_SESSION['alert_msg'] = 'You have to insert an <strong>amount</strong>';

            $this->enter_manual_redirect();
            die();
        }

        // Get the Total Manual Invoice of that date

        $manuals = $db->query("SELECT * FROM `manual_invoices` WHERE `id` = '$id'");

        while($manual = $manuals->fetch_assoc()){
            $db_amount = $manual['amount'];
        }

        // If the amount is greater
        if(($amount + $db_amount)>0){
            $_SESSION['alert_type'] = 'warning';
            $_SESSION['alert_msg'] = 'The amount entered is <strong>GREATER</strong> than the one in the database';

            $this->enter_manual_redirect();
            die();
        }


        // If the amount is equal
        if(($db_amount + $amount) === 0){

            $clear_update = $db->query("UPDATE `manual_invoices` SET `amount` = '$amount', `date_entered` = '$today', `entered` = '1' WHERE `id` ='$id'");

            if($clear_update){
                $_SESSION['alert_type'] = 'success';
                $_SESSION['alert_msg'] = "Successfully Entered Manual Invoice : <strong>{$amount}</strong>.";


                $log = "Entered Manual Invoice: $amount by $full_name";
                log_write($user_id, $branch_id, $log);

                $this->enter_manual_redirect();
                die();

            }else{
                $_SESSION['alert_type'] = 'danger';
                $_SESSION['alert_msg'] = "There was a problem with the system please try again!";

                $this->enter_manual_redirect();
                die();

            }

        }else{
            $difference = 0;
            $difference = $amount + $db_amount;
            $amount_update = $db->query("UPDATE `manual_invoices` SET `amount` = '$difference' WHERE `id` ='$id'");

            if($amount_update){
                $_SESSION['alert_type'] = 'success';
                $_SESSION['alert_msg'] = "Successfully Entered Manual Invoice : <strong>{$amount}</strong>.";

                $today = date("Y-m-d");

                $log = "Entered Manual Invoice: $amount by $full_name";
                log_write($user_id, $branch_id, $log);

                $this->enter_manual_redirect();
                die();

            }else{
                $_SESSION['alert_type'] = 'danger';
                $_SESSION['alert_msg'] = "There was a problem with the system please try again!";

                $this->enter_manual_redirect();
                die();

            }

        }

    }

    function enter_manual_redirect(){
        $this->session->set_flashdata('view_invoices',true);
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
        $amount = $this->input->post('amount')*-1;
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


        // Insert new Manual Invocie in the Database
        $insert_results = $this->invoices->add_manual_invoice($amount);

        if($insert_results){
            $this->session->set_flashdata('alert_type','success');
            $this->session->set_flashdata('alert_msg',"Successfully Added Manual Invoice for {$date} : <strong>Tsh {$amount}</strong>.");

            $today = date("Y-m-d");
            $log = "Manual Invoice: $amount by $full_name";
            $this->usuals->log_write($user_id, $branch_id, $log);

            $this->manual_invoice_redirect();
            die();
        }else{
            $_SESSION['alert_type'] = 'danger';
            $_SESSION['alert_msg'] = "There was a problem with the system please try again!";

            $this->manual_invoice_redirect();
            die();
        }

    }
}