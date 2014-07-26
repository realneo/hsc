<?php
/**
 * Created Using Fadsel Engine.
 * User: Fahad
 * Date: 7/14/14
 * Time: 10:38 AM
 */
class Returns extends CI_Model{

    /*
     * Get recent returns
     */

    function get_recent_returns(){
        $branch_id = $this->session->userdata('branch_id');
        $results = $this->db->query("SELECT * FROM `returns` WHERE `branch_id` = '$branch_id' ORDER BY `id` DESC LIMIT 20");
        return $results->result_array();
    }




    /*
     * Get all according to branch returns
     */

    function get_all_returns($branch_id){
//        $branch_id = $this->session->userdata('branch_id');
        $results = $this->db->query("SELECT * FROM `returns` WHERE `branch_id` = '$branch_id' ORDER BY `id` DESC");
        return $results->result_array();
    }

    /*
     * For displaying purposes at the returns report
     * 3 Status : Checked,Unchecked, and FALSE
     */

    function get_returns_from_all_branches(){
//        $branch_id = $this->session->userdata('branch_id');
        $show=$this->session->userdata('status');
        if($show){
            $results = $this->db->query("SELECT * FROM `returns` where `status`='$show' ORDER BY `id` DESC ");
        }else{
            $results = $this->db->query("SELECT * FROM `returns` ORDER BY `id` DESC ");
        }

        return $results->result_array();
    }




    function insert_return($date, $action, $receipt_number, $user_id, $branch_id, $amount){

       $result=$this->db->query("INSERT INTO `returns` (`id`, `date`, `action`, `receipt_number`, `user_id`, `branch_id`, `amount`) VALUES (NULL, '$date', '$action', '$receipt_number', '$user_id', '$branch_id', '$amount');");
        return $result;
    }

    function delete_return($id){
        $query="DELETE FROM `returns` WHERE `id` = '$id' AND `date`= CURDATE()";
        $results=$this->db->query($query);
        $this->session->set_userdata('affected_rows',$this->db->affected_rows());
        return $results;
    }
}