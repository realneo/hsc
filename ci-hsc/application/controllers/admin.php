<?php
/**
 * Created Using Fadsel Engine.
 * User: Fahad
 * Date: 7/12/14
 * Time: 10:13 AM
 */

class Admin extends CI_Controller{
    //great for initializing default variables
    protected  $data = array();
    function __construct(){
        parent::__construct();
        $this->load->model('admin');

    }

    function add_daily_sales(){
        $this->admin->add_daily_sales();
    }
    function edit_daily_sales(){
        // Get information from the form
        $date = $_GET['date'];
        $total_sale = $_GET['total_sale'];
        $branch_id = $this->session->userdata('branch_id');
        $user_id = $this->session->userdata('user_id');
        $full_name = $this->session->userdata('full_name');

        // Remove "," from the total_sale
        $total_sale = str_replace( ',', '', $total_sale);

        // Check if all fields are filled

        if(!$total_sale){
            $this->session->set_flashdata('alert_type','warning');
            $this->session->set_flashdata('alert_msg',
                'You have to insert your <strong>Total Sale</strong>');
            redirect(base_url('hsc/daily_sales'));
            die();
        }
        else{if($total_sale){

            // Update the Total Sale in the Database
            $updated_results = $this->admin->edit_daily_sales();


            if($updated_results){

                $this->session->set_flashdata('alert_type','success');
                $check=$this->db->affected_rows;//not good
                $today = date("Y-m-d");
                if($check>=1){
                    $this->session->set_flashdata('alert_msg',"Thank you ".make_me_bold($full_name)."!"); ;
                    $msg="Edited Daily Sale : $total_sale for $date by $full_name";
                }else{
                    $this->session->set_flashdata('alert_msg',"Sorry ".make_me_bold($full_name).", we dont have total sales inserted for ".make_me_bold($date)." yet!");
                    $msg="Failed to edit Daily Sale : $total_sale for $date by $full_name,it was not available";
                    $this->session->set_flashdata('alert_type','warning');
                }
                $this->usuals->log_write($user_id,$branch_id,$msg);

                redirect(base_url()."daily_sales_edit");

                die();
            }else{
                $this->session->set_flashdata('alert_type','danger');
                $this->session->set_flashdata('alert_msg',"There was a problem with the system please try again!");

                redirect(base_url()."daily_sales_edit");

                die();
            }


        }else{
            $this->session->set_flashdata('alert_type','danger');
            $this->session->set_flashdata('alert_msg',"There was a major problem with the system! , Try Contacting the administrator");

            redirect(base_url()."daily_sales_edit");

            die();
        }


        }

    }
}