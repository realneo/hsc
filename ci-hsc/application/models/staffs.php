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

    function get_auth_type_name($id){
        $query="SELECT name FROM `auth_type` where `id`='$id'";
        return $this->db->query($query)->result_array()[0]['name'];
    }

    function insert_staff($date, $email, $password, $branch_id, $auth_type_id, $user_id){

        $result=$this->db->query("INSERT INTO `users` (`id`, `date`, `email`, `password`, `branch_id`, `auth_type`, `user_id`) VALUES (NULL, '$date', '$email', '$password', '$branch_id', '$auth_type_id', '$user_id')");
        mysql_insert_id() ;

        return $this->db->insert_id();
    }

    function insert_user_profile($first_name, $last_name, $staff_id){

        $this->db->query("INSERT INTO `user_profile` (`id`, `first_name`, `last_name`, `user_id`) VALUES (NULL, '$first_name', '$last_name', '$staff_id');");
        mysql_insert_id() ;

        return $this->db->insert_id();
    }

    function get_users(){
        $query="SELECT * FROM `users`";
        return $this->db->query($query)->result_array();
    }

    function get_profle($id){
        $query="SELECT * FROM `user_profile` where `user_id`='$id'";
        return $this->db->query($query)->result_array();
    }


}