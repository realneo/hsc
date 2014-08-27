<?php

class Usuals extends CI_Model{
   function __construct(){
       // Use these baadaye Default Variables
       /*
        *   $today_date = date("Y-m-d");
            $branch_id = $this->session->userdata('branch_id');
        */

   }
/*
 * Get Branch name
 */
    function  get_branch_name($id){
        if($id==0){
            return "All";
        }
        $query="SELECT name from branch where `id`=$id";
        $results=$this->db->query($query)->result_array();
        return $results[0]['name'];

    }

    /*
     * Gets all the branches
     */
    function get_branches(){
        $this->get_active_branches();
    }

    function get_all_branches(){
        $query="SELECT name,id,status from branch";
        $results=$this->db->query($query);
        return $results->result_array();

    }


    function get_active_branches(){
        $query="SELECT name,id,status from branch where `status`=='active'";
        $results=$this->db->query($query);
        return $results->result_array();

    }

    function branch_status(){
        $table="branch";
        $field="status";
        $query = "SHOW COLUMNS FROM `$table` LIKE '$field' ";
        //$result = mysqli_query($connection, $query );
        //$row = mysqli_fetch_array($result , MYSQL_NUM );
        $row=$this->db->query($query)->result_array();
        #extract the values
        #the values are enclosed in single quotes
        #and separated by commas
        $regex = "/'(.*?)'/";//"/'(.*?)'/";
        preg_match_all( $regex , $row[0]['Type'], $enum_array );
        $enum_fields = $enum_array[1];//uki vardump utaelewa kwanini nimeweka hivi
        return( $enum_fields );

    }

// Get the Total Amount of Manual Invoices
    function getTotalManualInvoices($entered){
        $branch_id =$this->session->userdata('branch_id');
        $results = $this->db->query("SELECT * FROM manual_invoices WHERE `entered` = '$entered' AND `branch_id` = '$branch_id'");

        $count = 0;
        foreach($results->result_array() as $row){

            $row['amount'];
            $count += $row['amount'];
            //var_dump($count);
        }

        return number_format($count);
    }


    // Log Writing Function

    function log_write($user_id, $branch_id, $log){
        //$today_date = $GLOBALS['today_date'];
        $this->db->query("INSERT INTO `log` (`id`, `date`, `user_id`, `branch_id`, `log`) VALUES (NULL, CURRENT_TIMESTAMP, '$user_id', '$branch_id', '$log');");

    }

    /*
     * Get recent Total sales
     */

    function get_recent_total_sales(){
        $branch_id = $this->session->userdata('branch_id');

        $results0 = $this->db->query("SELECT * FROM total_sale WHERE branch_id = '$branch_id' ORDER BY 'date' DESC LIMIT 5");

        $results = $this->db->query("SELECT * FROM total_sale WHERE branch_id = '$branch_id' order by 'date' desc LIMIT 30");

        $this->session->set_userdata('num_of_sales',$results->num_rows());

        return $results->result_array();
    }

    /*
     * Gets all activities
     */
    function get_all_activities($num=1,$start=0){
        $branch_id=$this->session->userdata('branch_id');
        $results = $this->db-> query("SELECT log,id,`date`,

        DATE_FORMAT(`date`,'%H:%i:%s')  timeonly FROM `log` WHERE `branch_id` = '$branch_id' order by `date` desc LIMIT $start,$num");

        return $results->result_array();

    }

    /*
     * Gets specific activities | NOT USED YET
     */
    function get_specific_activities($days=0,$limit=5){
        $branch_id=$this->session->userdata('branch_id');
        $results = $this->db-> query("SELECT * FROM `log` WHERE `branch_id` = '$branch_id' AND `date`= CURDATE() - INTERVAL $days DAY LIMIT $limit");

        return $results->result_array();

    }


    /*
     * Gets recent activities
     */

    function get_recent_activities(){
        $branch_id=$this->session->userdata('branch_id');
        $results = $this->db-> query("SELECT log,DATE_FORMAT(`date`,'%H:%i:%s')  date  FROM `log` WHERE `branch_id` = '$branch_id' ORDER BY `id` DESC LIMIT 5");

        return $results->result_array();

    }


    /*
     * Gets specific branch  activities count
     */

    function get_notifications_count(){
        $branch_id=$this->session->userdata('branch_id');
        $results = $this->db-> query("SELECT id FROM `log` where `branch_id`=$branch_id");
        return $results->num_rows;
    }


// Check Authorization Type Of the User
    /*
        Authorization Type ($auth_type)
        1 - Administrator
        2 - Management
        3 - Manager
        4 - Cashier
        5 - Sales
        6 - Security
        7 - Normal
    */
    function check_auth($auth_type){
        if($auth_type == 1){
            return "administrator";
        }
        if($auth_type == 2){
            return "management";
        }
        if($auth_type == 3){
            return "manager";
        }
        if($auth_type == 4){
            return "cashier";
        }
        if($auth_type == 5){
            return "sales";
        }
    }



// Getting Total Daily Sales of TODAY

    function get_today_sales(){
        $today_date = $this->session->userdata('today_date');
        $branch_id = $this->session->userdata('branch_id');
        $results = $this->db->query("SELECT SUM(total_sale) total_sale FROM total_sale WHERE `date` = CURDATE() AND branch_id = '$branch_id'");
        $total_amount = $results->result_array()[0]['total_sale'];
        /*
         * String to Double : floatval/doubleval alias :D
         */
        return number_format(floatval($total_amount));
    }

// Getting Total Daily Binding of TODAY

    function get_today_binding(){
        //$today_date = $this->session->userdata('today_date');
        $branch_id = $this->session->userdata('branch_id');
        $results = $this->db->query("SELECT SUM(amount) total_amount FROM binding WHERE `date` = CURDATE() AND branch_id = '$branch_id'");
        $amount = $results->result_array()[0]['total_amount'];
        return number_format(floatval($amount));
    }


}