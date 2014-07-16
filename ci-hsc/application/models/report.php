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

    // Getting Total Expenses of TODAY

    function get_today_expenses(){
        //$today_date = $this->session->userdata('today_date');
        $branch_id = $this->session->userdata('branch_id');

        $results = $this->db->query("SELECT SUM(amount) amount FROM expenses WHERE `date` = CURDATE() AND branch_id = '$branch_id'");

        $total_amount = $results->result_array()[0]['amount'];;

        return number_format(floatval($total_amount));
    }

    function daily_expense_delete($id){
        $query="DELETE FROM `expenses` WHERE `id` = '$id' AND `date`= CURDATE()";
        $results=$this->db->query($query);
        $this->session->set_userdata('affected_rows',$this->db->affected_rows());
        return $results;
    }
}