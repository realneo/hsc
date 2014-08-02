<?php

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
        $query="SELECT * FROM `users` order by `email`";
        return $this->db->query($query)->result_array();
    }

    function get_user($id){
        $query="SELECT * FROM `users` where `id`='$id'";
        return $this->db->query($query)->result_array();
    }

    function get_profile($id){
        $query="SELECT * FROM `user_profile` where `user_id`='$id'";
        return $this->db->query($query)->result_array();
    }

    function get_total_variance($user_id){
        $results = $this->db->query("SELECT SUM(variance) total_variance FROM variance WHERE `user_id`='$user_id'");
        $total_amount = $results->result_array()[0]['total_variance'];
        /*
         * String to Double : floatval/doubleval alias :D
         */
        return number_format(floatval($total_amount));
    }

	function verify_user($email, $password){
		$query = $this->db->get_where('users', array('email' => $email, 'password' => $password));
//        var_dump($email, $password);die();
		if($this->db->affected_rows() === 1){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	function get_user_info($email){
		$query = $this->db->get_where('users', array('email' => $email));
		return $query->result_array();
	}


}