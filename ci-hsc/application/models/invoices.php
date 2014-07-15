<?php
/**
 * Created Using Fadsel Engine.
 * User: Fahad
 * Date: 7/14/14
 * Time: 10:38 AM
 */
class Invoices extends CI_Model{

    /*
     * Get recent invoices
     */

    function get_recent_invoices(){
        $branch_id = $this->session->userdata('branch_id');
        $results = $this->db->query("SELECT * FROM `manual_invoices` WHERE `branch_id` = '$branch_id' ORDER BY `id` DESC LIMIT 8");
        return $results->result_array();
    }

    function add_manual_invoice($amount){
        $branch_id = $this->session->userdata('branch_id');
        $results = $this->db->query("INSERT INTO `manual_invoices` (`id`, `branch_id`, `date`, `amount`, `entered`, `date_entered`) VALUES (NULL, '$branch_id', CURDATE(), '$amount', '0', '0000-00-00')");
        return $results;
    }

    function manual_invoice_delete($id){
        $query="DELETE FROM `manual_invoices` WHERE `id` = '$id' AND `date`= CURDATE()";
        $results=$this->db->query($query);
        $this->session->set_userdata('affected_rows',$this->db->affected_rows());
        return $results;
    }


}