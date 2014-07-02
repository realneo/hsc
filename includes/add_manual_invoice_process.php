<?php
	ob_start();
    session_start();
    require 'db_conn.php';

	require 'global_functions.php'; 
    
    // Get information from the form
    
    $date = $_POST['date'];
    $amount = $_POST['amount']*-1;
    $branch_name = $_SESSION['branch_name'];
	$branch_id = $_SESSION['branch_id'];
	$full_name = $_SESSION['full_name'];
    
    // Check if all fields are filled;
    
    if(!$date){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to select a <strong>date</strong>';
    
        header("Location: ../daily_manual_invoices.php");
        break;
    }
	
	if(!$amount){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to insert an <strong>amount</strong>';
    
        header("Location: ../daily_manual_invoices.php");
        break;
    }
    
   
    // Insert new Manual Invocie in the Database
    $insert_results = $db->query("INSERT INTO `manual_invoices` (`id`, `branch_id`, `date`, `amount`, `entered`, `date_entered`) VALUES (NULL, '$branch_id', '$date', '$amount', '0', '0000-00-00')");
        
    if($insert_results){
        $_SESSION['alert_type'] = 'success';
        $_SESSION['alert_msg'] = "Successfully Added Manual Invoice {$date} : <strong>{$amount}</strong>.";

		$today = date("Y-m-d");
		$log = "Manual Invoice: $amount by $full_name";
		log_write($user_id, $branch_id, $log);
		
        header('Location:../daily_manual_invoices.php');

        break;
    }else{
        $_SESSION['alert_type'] = 'danger';
        $_SESSION['alert_msg'] = "There was a problem with the system please try again!";

        header('Location:../daily_manual_invoices.php');

        break;
    }
?>
