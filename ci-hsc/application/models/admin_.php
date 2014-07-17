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
        /*
         * Check to see if any record exist for today
         */
        $run_this="SELECT * FROM `total_sale` WHERE `date` = '$date' AND `branch_id` = '$branch_id'";
        $r2=$this->db->query($run_this)->num_rows();
        if($r2>=1){
            $this->session->set_userdata('affected_rows',0);
            return true;
            //var_dump($r2->num_rows());
            //die();
        }else{
            $query="INSERT INTO `total_sale` (`id`, `date`, `branch_id`, `user_id`, `total_sale`, `audited_total_sale`) VALUES (NULL, '$date', '$branch_id', '$user_id', '$total_sale', '0')";

            $r=$this->db->query($query);
            $this->session->set_userdata('affected_rows',$this->db->affected_rows());
            return $r;
        }




    }

    /*
     * Add daily Binding
     */
    function add_daily_binding($user_id,$branch_id,$date,$total_sale){
        /*
         * Check to see if any record exist for today
         */
        $run_this="SELECT * FROM `binding` WHERE `date` = '$date' AND `branch_id` = '$branch_id'";
        $r2=$this->db->query($run_this)->num_rows();
        if($r2>=1){
            $this->session->set_userdata('affected_rows',0);
            return true;
            //var_dump($r2->num_rows());
            //die();
        }else{
            $query="INSERT INTO `binding` (`id`, `date`, `branch_id`, `user_id`, `amount`) VALUES (NULL, '$date', '$branch_id', '$user_id', '$total_sale')";

            $r=$this->db->query($query);
            $this->session->set_userdata('affected_rows',$this->db->affected_rows());
            return $r;
        }




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

    function  add_expense($date, $purpose, $received_by, $amount, $branch_id, $user_id){
        $results = $this->db->query("INSERT INTO `expenses` (`id`, `date`, `purpose`, `received_by`, `amount`, `branch_id`, `user_id`) VALUES (NULL, '$date', '$purpose', '$received_by', '$amount', '$branch_id', '$user_id')");
        return $results;
    }


}