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
            $log = "Daily Expense : $amount Tsh , was used for ".make_me_bold($purpose)." on $date";
            $msg=$log;
            $this->usuals->log_write($user_id,$branch_id,$msg);
            $this->daily_expense_redirect();
        }else{
            $this->session->set_flashdata('alert_type','danger');
            $this->session->set_flashdata('alert_msg','There was a problem with the system please try again!');

            $this->daily_expense_redirect();

        }


    }
}