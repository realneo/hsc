<?php
/**
 * Created Using Fadsel Engine.
 * User: Fahad
 * Date: 7/15/14
 * Time: 12:57 PM
 */

class Vouchers extends CI_Model {
    function get_recent_vouchers(){
        $branch_id = $this->session->userdata('branch_id');
        $results=$this->db->query("SELECT * FROM `users` WHERE `branch_id` = '$branch_id' AND `auth_type` = 5 ORDER BY `email` ASC");
        return $results->result_array();
    }
}