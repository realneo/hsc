<?php
/**
 * Created Using Fadsel Engine.
 * User: Fahad
 * Date: 7/9/14
 * Time: 1:51 PM
 */
class Admin_ extends CI_Model{
    function __construct(){
        // Use these baadaye Default Variables

    }


    /*
     * Number of affected rows is soo important!
     */
    function edit_daily_sales($total_sale,$branch_id){

        $query = "UPDATE `total_sale` SET `total_sale` = '$total_sale'
        WHERE `date` = CURDATE() AND `branch_id` = '$branch_id'";
        $r=$this->db->query($query);
        $this->session->set_userdata('affected_rows',$this->db->affected_rows());

        return $r;
    }

    /*
     * Add daily sales
     */
    function add_daily_sales($user_id,$branch_id,$date,$total_sale){
        $query="INSERT INTO `total_sale` (`id`, `date`, `branch_id`, `user_id`, `total_sale`, `audited_total_sale`) VALUES (NULL, '$date', '$branch_id', '$user_id', '$total_sale', '0')";

        $r=$this->db->query($query);
        $this->session->set_userdata('affected_rows',$this->db->affected_rows());

        return $r;
    }


    function edit_daily_binding($total_sale,$branch_id){

        $query = "UPDATE `binding` SET `amount` = '$total_sale'
        WHERE `date` = CURDATE() AND `branch_id` = '$branch_id'";
        $r=$this->db->query($query);
        $this->session->set_userdata('affected_rows',$this->db->affected_rows());

        return $r;
    }

    /*
     * Get Branch name
     */
    function  get_branch_name($id){
        $query="SELECT name from branch where `id`=$id";
        $results=$this->db->query($query)->result_array();
        return $results[0]['name'];

    }


}