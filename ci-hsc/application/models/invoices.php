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


}