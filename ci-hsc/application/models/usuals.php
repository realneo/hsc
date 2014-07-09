<?php
/**
 * Created Using Fadsel Engine.
 * User: Fahad
 * Date: 7/9/14
 * Time: 1:51 PM
 */
class Usuals extends CI_Model{
   function __construct(){
       // Use these baadaye Default Variables
       /*
        *   $today_date = date("Y-m-d");
            $branch_id = $this->session->userdata('branch_id');
        */

   }

// Get the Total Amount of Manual Invoices
    function getTotalManualInvoices($entered){
        $branch_id =$this->session->userdata('branch_id');
        $results = $this->db->query("SELECT * FROM manual_invoices WHERE `entered` = '$entered' AND `branch_id` = '$branch_id'");

        $count = 0;
        foreach($results->result_array() as $row){

            $row['amount'];
            $count += $row['amount'];
            //var_dump($count);
        }

        return number_format($count);
    }


// Log Writing Function

    function log_write($user_id, $branch_id, $log){
        $today_date = $GLOBALS['today_date'];
        $this->db->query("INSERT INTO `log` (`id`, `date`, `user_id`, `branch_id`, `log`) VALUES (NULL, '$today_date', '$user_id', '$branch_id', '$log')");
    }

// Check Authorization Type Of the User
    /*
        Authorization Type ($auth_type)
        1 - Administrator
        2 - Management
        3 - Manager
        4 - Cashier
        5 - Sales
        6 - Security
        7 - Normal
    */
    function check_auth($auth_type){
        if($auth_type == 1){
            return "administrator";
        }
        if($auth_type == 2){
            return "management";
        }
        if($auth_type == 3){
            return "manager";
        }
        if($auth_type == 4){
            return "cashier";
        }
        if($auth_type == 5){
            return "sales";
        }
    }

// Getting Total Expenses of TODAY

    function get_today_expenses(){
        $today_date = $this->session->userdata('today_date');
        $branch_id = $this->session->userdata('branch_id');

        $results = $this->db->query("SELECT * FROM expenses WHERE `date` = '$today_date' AND branch_id = '$branch_id'");

        $total_amount = 0;
        foreach($results->result_array() as $row){
            $amount = $row['amount'];

            $total_amount += $amount;
        }
        return number_format($total_amount);
    }

// Getting Total Daily Sales of TODAY

    function get_today_sales(){
        $today_date = $this->session->userdata('today_date');
        $branch_id = $this->session->userdata('branch_id');
        $results = $this->db->query("SELECT * FROM total_sale WHERE `date` = '$today_date' AND branch_id = '$branch_id'");
        $total_amount = 0;
        foreach($results->result_array() as $row){
            $amount = $row['total_sale'];

            $total_amount += $amount;
        }
        return number_format($total_amount);
    }

// Getting Total Daily Binding of TODAY

    function get_today_binding(){
        $today_date = $this->session->userdata('today_date');
        $branch_id = $this->session->userdata('branch_id');
        $results = $this->db->query("SELECT * FROM binding WHERE `date` = '$today_date' AND branch_id = '$branch_id'");

        $total_amount = 0;
        foreach($results->result_array() as $row){
            $amount = $row['amount'];

            $total_amount += $amount;
        }
        return number_format($total_amount);
    }
}