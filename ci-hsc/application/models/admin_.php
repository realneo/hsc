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
     * Get Branch name
     */
    function edit_daily_sales(){
        return $this->db->query("UPDATE `total_sale` SET `total_sale` = '$total_sale' WHERE `date` = '$date' AND `branch_id` = '$branch_id'");
    }
    function  get_branch_name($id){
        $query="SELECT name from branch where `id`=$id";
        $results=$this->db->query($query)->result_array();
        return $results[0]['name'];

    }


}