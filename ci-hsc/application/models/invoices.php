<?php
/**
 * Created Using Fadsel Engine.
 * User: Fahad
 * Date: 7/14/14
 * Time: 10:38 AM
 */
class Invoices extends CI_Model{

    /*
     * Get recent invoices , according to show session
     */

    function get_recent_invoices__($num=1,$start=0){

        /*
         * Dont just redirect it ,
         * return it so that it wont come back again
         * 3 for all, 0 not entered,1 entered 2 started
         */
        $entered = $this->session->userdata('show');
        if($entered==3){
            return $this->get_recent_invoices($num,$start);

        }else{
            $branch_id = $this->session->userdata('branch_id');
            $results = $this->db->query("SELECT * FROM `manual_invoices` WHERE `branch_id` = '$branch_id' AND `entered` = '$entered' ORDER BY `id` DESC LIMIT $start,$num");
            return $results->result_array();
        }
    }

    /*
     * Get recent invoices count , according to show session
     */

    function get_recent_invoices__count(){


        $entered = $this->session->userdata('show');
        $branch_id=$this->session->userdata('branch_id');
        /*
         * Check to see , if All is selected , then count them all
         */
            if($entered==3){
                return $this->db-> query("SELECT id FROM `manual_invoices` where `branch_id`= '$branch_id' ")->num_rows;
            }

            $results = $this->db-> query("SELECT id FROM `manual_invoices` where `branch_id`= '$branch_id' AND `entered` = '$entered'");
        //var_dump($results);die();
            return $results->num_rows;

    }

    /*
     * Get recent invoices
     */

    function get_recent_invoices($num=1,$start=0){
        $branch_id = $this->session->userdata('branch_id');
        $results = $this->db->query("SELECT distinct `date`,id,branch_id,amount,balance,entered,date_entered FROM `manual_invoices` WHERE `branch_id` = '$branch_id' ORDER BY `id` DESC  limit $start,$num");
        return $results->result_array();
    }

    function check_manual_invoices($date){
        $branch_id = $this->session->userdata('branch_id');
        $results = $this->db->query("SELECT * FROM `manual_invoices` WHERE `branch_id` = '$branch_id' AND `date`='$date'");
        return $results->num_rows;
    }

    function get_total_manual_invoice($id){
        $results = $this->db->query("SELECT * FROM `manual_invoices` WHERE `id` = '$id'");
        return $results->result_array();
    }

    /*
     * Put 2 for Starting to enter
     * Date ISSUED is for updating progress
     */
    function update_invoice($id,$difference,$amount,$date_issued){
        $results = $this->db->query("UPDATE `manual_invoices` SET `balance` = '$difference', `date_entered` = '$date_issued',`entered` ='2' WHERE `id` ='$id'");
        $this->insert_invoice_progress($id,$amount,$date_issued);
        return $results;
    }

    function insert_invoice_progress($id,$amount,$date_issued){
        $branch_id = $this->session->userdata('branch_id');
        $this->db->query("INSERT INTO `manual_invoices_progress` (`id` ,`date` ,`manual_invoice_id` ,`amount_entered`,`branch_id`,`date_issued`)VALUES (NULL , CURDATE() ,  '$id',  '$amount','$branch_id'
,'$date_issued');");



    }

    function complete_invoice($id,$amount,$date_issued,$amount_user_wrote){
        $branch_id = $this->session->userdata('branch_id');
        $results = $this->db->query("UPDATE `manual_invoices` SET `amount` = '$amount',`balance`= 0, `date_entered` = '$date_issued', `entered` = '1' WHERE `id` ='$id'");

        $this->insert_invoice_progress($id,$amount_user_wrote,$date_issued);



//        $results = $this->db->query("INSERT INTO `manual_invoices` (`id` ,`branch_id` ,`date` ,`amount` ,`balance` ,`entered` ,`date_entered`
//)VALUES (NULL ,  '$branch_id',  '$date_issued',  '$amount',  '0',  '1', CURDATE()
//);");

        return $results;
    }



    function add_manual_invoice($amount,$date){
        $branch_id = $this->session->userdata('branch_id');
        $results = $this->db->query("INSERT INTO `manual_invoices` (`id`,`date`, `branch_id`, `amount`, `entered`,`balance`, `date_entered`) VALUES (NULL, '$date','$branch_id',  '$amount', '0','$amount', NULL )");
        return $results;
    }

    function manual_invoice_delete($id){
        $query="DELETE FROM `manual_invoices` WHERE `id` = '$id' AND `date_entered`= CURDATE()";
        $results=$this->db->query($query);
        $this->session->set_userdata('affected_rows',$this->db->affected_rows());
        return $results;
    }



}