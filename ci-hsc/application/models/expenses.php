<?php
/**
 * Created Using Fadsel Engine.
 * User: Fahad
 * Date: 7/14/14
 * Time: 10:38 AM
 */
class Expenses extends CI_Model{

    /*
     * Get recent expenses
     */

    function get_recent_expenses(){
        $branch_id = $this->session->userdata('branch_id');
        $results = $this->db->query("SELECT * FROM `expenses` WHERE `branch_id` = '$branch_id' ORDER BY `id` DESC LIMIT 5");
        return $results->result_array();
    }

    // Getting Total Expenses of TODAY

    function get_today_expenses(){
        //$today_date = $this->session->userdata('today_date');
        $branch_id = $this->session->userdata('branch_id');

        $results = $this->db->query("SELECT SUM(amount) amount FROM expenses WHERE `date` = CURDATE() AND branch_id = '$branch_id'");

        $total_amount = $results->result_array()[0]['amount'];;

        return number_format(floatval($total_amount));
    }

    function daliy_expense_delete($id){
        $query="DELETE FROM `expenses` WHERE `id` = '$id' AND `date`= CURDATE()";
        $results=$this->db->query($query);
        $this->session->set_userdata('affected_rows',$this->db->affected_rows());
        return $results;
    }
}