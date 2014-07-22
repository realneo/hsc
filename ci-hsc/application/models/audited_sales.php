<?php
/**
 * Created Using Fadsel Engine.
 * User: Fahad
 * Date: 7/22/14
 * Time: 12:56 PM
 */

class Audited_sales extends CI_Model{
    /*
     * testing purpose , for AJAX but FAILED :(
     */
    function add_audited_sales(){
        return false;
    }

    function update_audited_sale($amount,$id){
        $branch_id = $this->session->userdata('branch_id');
        $results = $this->db->query("UPDATE `total_sale` SET `audited_total_sale` = '$amount' WHERE `id` ='$id'");
        return $results;
    }


}