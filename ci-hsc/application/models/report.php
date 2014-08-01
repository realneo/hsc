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

    /*
     * Total_audited
     */
    function get_audited_total_sale(){
        $date = $this->session->userdata('report_date');
        $branch_id = $this->session->userdata('branch_id');
        $results = $this->db->query("SELECT audited_total_sale as total_sale , id,user_id,branch_id,produced FROM total_sale WHERE `date` = '$date' AND branch_id = '$branch_id'");
        $total_amount = $results->result_array();
        /*
         * String to Double : floatval/doubleval alias :D
         */
        return $total_amount;
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
     * NEW FUNCTION
     * gets all data from the table
     */

    function get_manual_data_entered(){
        $date = $this->session->userdata('report_date');
        $branch_id = $this->session->userdata('branch_id');
        $results = $this->db->query("SELECT * FROM manual_invoices WHERE `date_entered` = '$date' AND branch_id = '$branch_id'");
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


    /*
     * NEW FUNCTION
     */

    function add_variance($date,$variance,$user_id_sales,$branch_id){
        /*
         * Check to see if any record exist for today
         * Check the branch_id also
         */
        $run_this="SELECT * FROM `variance` WHERE `date_produced` = '$date' AND `user_id` = '$user_id_sales' AND `branch_id`='$branch_id'";
        $r2=$this->db->query($run_this)->num_rows();
        if($r2>=1){
            $this->session->set_userdata('affected_rows',1);
            $query="UPDATE `variance` SET  `variance` =  '$variance' WHERE  `date_produced` = '$date' AND `user_id` = '$user_id_sales' AND `branch_id`='$branch_id';";
            //var_dump($r2->num_rows());
            //die();
        }else{
            $query="INSERT INTO `variance` (`id` ,`user_id` ,`variance` ,`date_produced`,`branch_id`)VALUES (
NULL ,  '$user_id_sales',  '$variance',  '$date' ,'$branch_id'
);";

        }
                    /*
                     * For updating the produced field
                     */
                        $query_update_produced = "UPDATE  `total_sale` SET  `produced` =  '1' WHERE `branch_id` ='$branch_id' AND `date`='$date';";
            $r22=$this->db->query($query_update_produced);
            $r=$this->db->query($query);
            //$this->session->set_userdata('affected_rows',$this->db->affected_rows());
            return $r;





    }


    function approved_return($id){
        $query = "UPDATE `returns` SET  `status` =  'checked' WHERE  `id` ='$id';";
        $this->session->set_userdata('affected_rows',$this->db->affected_rows());
        $result = $this->db->query($query);
        return $result;
    }



    function get_report($id){
        $results = $this->db->query("SELECT * FROM returns WHERE `id` = '$id'");
        return $results->result_array();
    }





    /*
     * GETTING CONTENT FOR BINDING
     *
     */
    function get_expenses_from_all_branches($num=30,$start=0){
        $results = $this->db->query("SELECT * FROM `expenses` ORDER BY `date` DESC limit $start,$num");
        return $results->result_array();

    }

    /*
     * Get No of Expenses Content
     */

    function get_expenses_no_from_all_branches(){
        $results = $this->db->query("SELECT * FROM `expenses`");
        return $results->num_rows();

    }


    /*
     * GETTING CONTENT FOR BINDING
     */
    function get_binding_from_all_branches($num=30,$start=0){
        $results = $this->db->query("SELECT * FROM `binding` ORDER BY `date` DESC limit $start,$num");
        return $results->result_array();

    }
    /*
     * Get Number of Binding Content
     */

    function get_binding_no_from_all_branches(){
        $results = $this->db->query("SELECT * FROM `binding`");
        return $results->num_rows();

    }


     /*
     * GETTING CONTENT FOR CHEQUE
     */
    function get_cheque_from_all_branches($num=30,$start=0){
        $results = $this->db->query("SELECT * FROM  `cheque`  ORDER BY `date_added` DESC limit $start,$num");
        return $results->result_array();

    }
    /*
     * Get Number of Cheque Content
     */

    function get_cheque_no_from_all_branches(){
        $results = $this->db->query("SELECT * FROM `cheque`");
        return $results->num_rows();

    }

    /*
     * Gets Specific Cheque
     */
    function get_cheque($id){
        $results = $this->db->query("SELECT * FROM cheque WHERE `id` = '$id'");
        return $results->result_array();
    }

    /*
     * Gets Total Specific Cheque
     */
    function get_cheque_log_total($id){
        $results = $this->db->query("SELECT sum(balance) as balance FROM cheque_log WHERE `cheque_id` = '$id'");
        return $results->result_array()[0]['balance'];
    }


    /*
     * Clearing the Cheque
     */
    function clear_cheque($id){
        $query = "UPDATE `cheque` SET  `pre_status` =  'cleared' WHERE  `id` ='$id';";
        $this->session->set_userdata('affected_rows',$this->db->affected_rows());
        $result = $this->db->query($query);
        return $result;
    }

    /*
     * Complete Cheque
     */

    function complete_cheque($id,$date_issued,$amount,$date_posted){
        $branch_id = $this->session->userdata('branch_id');
        $results = $this->db->query("UPDATE `cheque` SET `post_status` = 'used' WHERE `id` ='$id'");

        $this->insert_cheque_progress($id,$amount,$date_issued,$date_posted);



//        $results = $this->db->query("INSERT INTO `manual_invoices` (`id` ,`branch_id` ,`date` ,`amount` ,`balance` ,`entered` ,`date_entered`
//)VALUES (NULL ,  '$branch_id',  '$date_issued',  '$amount',  '0',  '1', CURDATE()
//);");

        return $results;
    }

    /*
     * For tracking Cheque progress
     */
    function insert_cheque_progress($id,$amount,$date_issued,$date_posted){
        $results = $this->db->query("INSERT INTO `cheque_log` (`id`, `cheque_id`, `date`,`date_posted`, `balance`) VALUES (NULL, '$id', '$date_issued','$date_posted', '$amount');");
        return $results;

    }







}