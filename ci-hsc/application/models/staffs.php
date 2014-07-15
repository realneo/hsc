<?php
/**
 * Created Using Fadsel Engine.
 * User: Fahad
 * Date: 7/15/14
 * Time: 3:27 PM
 */

class Staffs extends CI_Model{
    function get_auth_type(){
        $query="SELECT * FROM `auth_type`";
        return $this->db->query($query)->result_array();
    }
}