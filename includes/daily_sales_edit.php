<?php
    session_start();
    require 'db_conn.php';
    
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
        break;
    }
    
    if($total_sale){
        
        // Insert the Total Sale in the Database
        $insert_results = $db->query("UPDATE `total_sale` SET `total_sale` = '$total_sale' WHERE `date` = '$date' AND `branch_id` = '$branch_id'");
        
        if($insert_results){
            
            $_SESSION['alert_type'] = 'success';
            $_SESSION['alert_msg'] = "Thank you {$full_name}!";
            
			$today = date("Y-m-d");
			$db->query("INSERT INTO `log` (`id`, `date`, `branch_id`, `log`) VALUES (NULL, '$today', '$branch_id', 'Edited Daily Sale : $total_sale for $date by $full_name')");

            header('Location:../daily_sales_edit.php');
        
            break;
        }else{
            $_SESSION['alert_type'] = 'danger';
            $_SESSION['alert_msg'] = "There was a problem with the system please try again!";
        
            header('Location:../daily_sales_edit.php');
        
            break;
        }


    }else{
        $_SESSION['alert_type'] = 'danger';
        $_SESSION['alert_msg'] = "There was a major problem, Please Retry!";
        
        header('Location:../daily_sales_edit.php');
        
        break;
    }
?>
