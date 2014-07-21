<?php
/**
 * Created Using Fadsel Engine.
 * User: Fahad
 * Date: 7/16/14
 * Time: 9:22 AM
 */

class Report extends CI_Model{

    // Getting Total Daily Sales of TODAY

    function get_total_sales(){
        $date = $this->session->userdata('report_date');
        $branch_id = $this->session->userdata('branch_id');
        $results = $this->db->query("SELECT SUM(total_sale) total_sale FROM total_sale WHERE `date` = '$date' AND branch_id = '$branch_id'");
        $total_amount = $results->result_array()[0]['total_sale'];
        /*
         * String to Double : floatval/doubleval alias :D
         */
        return number_format(floatval($total_amount));
    }




    function get_total_binding(){
        $date = $this->session->userdata('report_date');
        $branch_id = $this->session->userdata('branch_id');
        $results = $this->db->query("SELECT SUM(amount) total_amount FROM binding WHERE `date` = '$date' AND branch_id = '$branch_id'");
        $amount = $results->result_array()[0]['total_amount'];
        return number_format(floatval($amount));
    }

    // Getting Total Expenses of given date

    function get_total_expenses(){
        $date = $this->session->userdata('report_date');
        $branch_id = $this->session->userdata('branch_id');

        $results = $this->db->query("SELECT SUM(amount) amount FROM expenses WHERE `date` = '$date' AND branch_id = '$branch_id'");

        $total_amount = $results->result_array()[0]['amount'];;

        return number_format(floatval($total_amount));
    }

    // Getting Total Expenses of given date

    function get_expense_activity(){
        $date = $this->session->userdata('report_date');
        $branch_id = $this->session->userdata('branch_id');

        $results = $this->db->query("SELECT * FROM expenses WHERE `date` = '$date' AND branch_id = '$branch_id'");



        return $results->result_array();
    }

    /*
     * Gets Total Manual Invoice
     */

    function get_total_manual_invoice($entered){
        $date = $this->session->userdata('report_date');
        $branch_id = $this->session->userdata('branch_id');

        if($entered == 1){
            $results = $this->db->query("SELECT SUM(amount) amount FROM manual_invoices WHERE `date_entered` = '$date' AND branch_id = '$branch_id' AND  `entered` = '$entered'");

        }
        if($entered == 0 OR $entered == 2){
            $results = $this->db->query("SELECT SUM(amount) amount FROM manual_invoices WHERE `date` = '$date' AND branch_id = '$branch_id' AND `entered` = '$entered'");}



        $total_amount = $results->result_array()[0]['amount'];;

        return number_format(floatval($total_amount));

    }

    /*
     * Gets Total Returns
     */

    function get_total_returns(){
        $date = $this->session->userdata('report_date');
        $branch_id = $this->session->userdata('branch_id');

        $results = $this->db->query("SELECT SUM(amount) amount FROM returns WHERE `date` = '$date' AND branch_id = '$branch_id'");

        $total_amount = $results->result_array()[0]['amount'];;

        return number_format(floatval($total_amount));

    }

    /*
     * Gets Manual Progress
     */

    function get_total_manual_progress($manual_invoice_id){
        $date = $this->session->userdata('report_date');
        $branch_id = $this->session->userdata('branch_id');

        $results = $this->db->query("SELECT SUM(amount_entered) amount FROM manual_invoices_progress WHERE `date` = '$date' AND manual_invoice_id= '$manual_invoice_id'");


        $total_amount = $results->result_array()[0]['amount'];;

        return number_format(floatval($total_amount));

    }



    /*
     * NEW FUNCTION
     * gets all data from the table
     */

    function get_manual_data(){
        $date = $this->session->userdata('report_date');
        $branch_id = $this->session->userdata('branch_id');
        $results = $this->db->query("SELECT * FROM manual_invoices WHERE `date` = '$date' AND branch_id = '$branch_id'");
        return $results->result_array();

    }

    /*
     * For getting all manually entered invoices
     */

    function get_manual_entered_invoices(){
        $date = $this->session->userdata('report_date');
        $branch_id = $this->session->userdata('branch_id');
        //$results = $this->db->query("SELECT SUM(amount_entered) amount FROM `manual_invoices_progress` WHERE `date_issued`='$date' and branch_id='$branch_id'");
        $results = $this->db->query("SELECT SUM(amount_entered) amount FROM `manual_invoices_progress` WHERE `date`='$date' and branch_id='$branch_id'");
        $total_amount=$results->result_array()[0]['amount'];
        return number_format(floatval($total_amount));

    }




}