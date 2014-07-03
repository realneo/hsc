<?php
    session_start();
    require 'db_conn.php';
    
    // Get information from the form
    
    $id = $_GET['id'];
	$amount = $_GET['amount'];
	$purpose = $_GET['purpose'];
	$full_name = $_SESSION['full_name'];
	$branch_id = $_SESSION['branch_id'];
    
    if($id){
        
        // Delete the Daily Expense
        $delete = $db->query("DELETE FROM `expenses` WHERE `id` = '$id'");
        
        if($delete){
            
            $_SESSION['alert_type'] = 'success';
            $_SESSION['alert_msg'] = "Thank you {$full_name}!";
            
			$today = date("Y-m-d");
			$db->query("INSERT INTO `log` (`id`, `date`, `branch_id`, `log`) VALUES (NULL, '$today', '$branch_id', 'Deleted Expense : $amount for $purpose by $full_name')");

            header('Location:../daily_expenses.php');
        
            break;
        }else{
            $_SESSION['alert_type'] = 'danger';
            $_SESSION['alert_msg'] = "There was a problem with the system please try again!";
        
            header('Location:../daily_expenses.php');
        
            break;
        }

    }else{
        $_SESSION['alert_type'] = 'danger';
        $_SESSION['alert_msg'] = "There was a major problem, Please Retry!";
        
        header('Location:../daily_expenses.php');
        
        break;
    }
?>
