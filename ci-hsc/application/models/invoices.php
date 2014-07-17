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

    function get_recent_invoices__($entered){

        /*
         * Dont just redirect it ,
         * return it so that it wont come back again
         */
        if($entered==2){
            return $this->get_recent_invoices();

        }else{
            $branch_id = $this->session->userdata('branch_id');
            $results = $this->db->query("SELECT * FROM `manual_invoices` WHERE `branch_id` = '$branch_id' AND `entered` = '$entered' ORDER BY `id` DESC LIMIT 20");
            return $results->result_array();
        }
    }
    /*
     * Get recent invoices
     */

    function get_recent_invoices(){
        $branch_id = $this->session->userdata('branch_id');
        $results = $this->db->query("SELECT * FROM `manual_invoices` WHERE `branch_id` = '$branch_id' ORDER BY `id` DESC");
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

    function update_invoice($id,$difference,$amount){
        $results = $this->db->query("UPDATE `manual_invoices` SET `amount` = '$difference' WHERE `id` ='$id'");
        $this->insert_invoice_progress($id,$amount);
        return $results;
    }

    function insert_invoice_progress($id,$amount){
        $branch_id = $this->session->userdata('branch_id');
        $this->db->query("INSERT INTO `manual_invoices_progress` (`id` ,`date` ,`manual_invoice_id` ,`amount_entered`,`branch_id`)VALUES (NULL , CURDATE() ,  '$id',  '$amount','$branch_id'
);");

    }

    function complete_invoice($id,$amount){
        $results = $this->db->query("UPDATE `manual_invoices` SET `amount` = '$amount', `date_entered` = CURDATE(), `entered` = '1' WHERE `id` ='$id'");
        return $results;
    }



    function add_manual_invoice($amount,$date){
        $branch_id = $this->session->userdata('branch_id');
        $results = $this->db->query("INSERT INTO `manual_invoices` (`id`,`date`, `branch_id`, `amount`, `entered`, `date_entered`) VALUES (NULL, '$date','$branch_id',  '$amount', '0', CURDATE())");
        return $results;
    }

    function manual_invoice_delete($id){
        $query="DELETE FROM `manual_invoices` WHERE `id` = '$id' AND `date`= CURDATE()";
        $results=$this->db->query($query);
        $this->session->set_userdata('affected_rows',$this->db->affected_rows());
        return $results;
    }



}