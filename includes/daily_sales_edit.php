<?php
    session_start();
    require 'db_conn.php';
    require 'global_functions.php';//we need make_me_bold its in there

    // Get information from the form
    $date = $_GET['date'];
    $total_sale = $_GET['total_sale'];
    $branch_id = $_SESSION['branch_id'];
	$user_id = $_SESSION['user_id'];
	$full_name = $_SESSION['full_name'];
    
	// Remove "," from the total_sale
	$total_sale = str_replace( ',', '', $total_sale);
	
    // Check if all fields are filled
    
    if(!$total_sale){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to insert your <strong>Total Sale</strong>';
    
        header("Location: ../daily_sales_edit.php");
        die();
    }
    
    if($total_sale){
        
        // Insert the Total Sale in the Database
        $insert_results = $db->query("UPDATE `total_sale` SET `total_sale` = '$total_sale' WHERE `date` = '$date' AND `branch_id` = '$branch_id'");
        
        if($insert_results){
            
            $_SESSION['alert_type'] = 'success';
            $check=$db->affected_rows;
            $today = date("Y-m-d");
            if($check>=1){
                $_SESSION['alert_msg'] = "Thank you ".make_me_bold($full_name)."!";
                $msg="Edited Daily Sale : $total_sale for $date by $full_name";
            }else{
                $_SESSION['alert_msg'] = "Sorry ".make_me_bold($full_name).", we dont have total sales inserted for ".make_me_bold($date)." yet!";
                $msg="Failed to edit Daily Sale : $total_sale for $date by $full_name,it was not available";
                $_SESSION['alert_type'] = 'warning';
            }
            log_write($user_id,$branch_id,$msg);

            header('Location:../daily_sales_edit.php');
        
            die();
        }else{
            $_SESSION['alert_type'] = 'danger';
            $_SESSION['alert_msg'] = "There was a problem with the system please try again!";
        
            header('Location:../daily_sales_edit.php');
        
            die();
        }


    }else{
        $_SESSION['alert_type'] = 'danger';
        $_SESSION['alert_msg'] = "There was a major problem, Please Retry!";
        
        header('Location:../daily_sales_edit.php');
        
        die();
    }
