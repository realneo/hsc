<?php
	ob_start();
    session_start();
    require 'db_conn.php';
    
    // Get information from the form
    
    $date = $_POST['date'];
    $purpose = $_POST['purpose'];
    $received_by = $_POST['received_by'];
    $amount = $_POST['amount'];
    $branch_id = $_SESSION['branch_id'];
	$cashier_id = $_SESSION['cashier_id'];
	$cashier_name = $_SESSION['cashier_name']; 
    
	// Remove "," from the total_sale
	$amount = str_replace( ',', '', $amount);
	
    // Check if all fields are filled;
    
    if(!$date){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to select a <strong>Date</strong>';
    
        header("Location: ../daily_expenses.php");
        break;
    }
    
    if(!$purpose){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to insert the <strong>Purpose</strong> of the Expense';
    
        header("Location: ../daily_expenses.php");
        break;
    }
    
    if(!$amount){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to insert the <strong>Amount</strong>';
    
        header("Location: ../daily_expenses.php");
        break;
    }
    
    // Insert into Expenses database
    
    $query = $db->query("INSERT INTO `expenses` (`id`, `date`, `purpose`, `received_by`, `amount`, `branch_id`, `cashier_id`) VALUES (NULL, '$date', '$purpose', '$received_by', '$amount', '$branch_id', '$cashier_id')");
    
    
    if($query){
    	$_SESSION['cashier_name'] = $cashier_name;
        $_SESSION['alert_type'] = 'success';
        $_SESSION['alert_msg'] = "Thank you {$cashier_name}!";
        
		// Write into Log
		$today = date("Y-m-d");
		$db->query("INSERT INTO `log` (`id`, `date`, `branch_id`, `log`) VALUES (NULL, '$today', '$branch_id', '$cashier_name - Expense : $amount for $purpose')");

       	header('Location:../daily_expenses.php');
        
        break;
   	}else{
    	$_SESSION['alert_type'] = 'danger';
        $_SESSION['alert_msg'] = "There was a problem with the system please try again!";
        
        header('Location:../daily_expenses.php');
        
        break;

    }
?>
