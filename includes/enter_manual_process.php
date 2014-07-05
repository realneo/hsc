<?php
	ob_start();
    session_start();
    require 'db_conn.php';

	require 'global_functions.php'; 
    
    // Get information from the form
    $id = $_POST['id'];
    $amount = $_POST['amount'];
    $branch_name = $_SESSION['branch_name'];
	$branch_id = $_SESSION['branch_id'];
	$full_name = $_SESSION['full_name'];
	$user_id = $_SESSION['user_id'];
    $today = date("Y-m-d");
    // Check if all fields are filled;
	
	if(!$amount){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to insert an <strong>amount</strong>';
    
        header("Location: ../view_manual_invoices.php");
        break;
    }
  
	// Get the Total Manual Invoice of that date
	
	$manuals = $db->query("SELECT * FROM `manual_invoices` WHERE `id` = '$id'");
	
	while($manual = $manuals->fetch_assoc()){
		$db_amount = $manual['amount'];
	}
	
	// If the amount is greater
	if(($amount + $db_amount)>0){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'The amount entered is <strong>GREATER</strong> than the one in the database';
    
        header("Location: ../view_manual_invoices.php");
        break;
    }
	
	
	// If the amount is equal 
	if(($db_amount + $amount) === 0){
	
		$clear_update = $db->query("UPDATE `manual_invoices` SET `amount` = '$amount', `date_entered` = '$today', `entered` = '1' WHERE `id` ='$id'");
		
		if($clear_update){
			$_SESSION['alert_type'] = 'success';
	        $_SESSION['alert_msg'] = "Successfully Entered Manual Invoice : <strong>{$amount}</strong>.";

			
			$log = "Entered Manual Invoice: $amount by $full_name";
			log_write($user_id, $branch_id, $log);

	        header('Location:../view_manual_invoices.php');

		}else{
			$_SESSION['alert_type'] = 'danger';
		    $_SESSION['alert_msg'] = "There was a problem with the system please try again!";			
			
			header('Location:../view_manual_invoices.php');

		}
		
	}else{
		$difference = 0;
		$difference = $amount + $db_amount;
		$amount_update = $db->query("UPDATE `manual_invoices` SET `amount` = '$difference' WHERE `id` ='$id'");
		
		if($amount_update){
			$_SESSION['alert_type'] = 'success';
	        $_SESSION['alert_msg'] = "Successfully Entered Manual Invoice : <strong>{$amount}</strong>.";

			$today = date("Y-m-d");
			
			$log = "Entered Manual Invoice: $amount by $full_name";
			log_write($user_id, $branch_id, $log);

	        header('Location:../view_manual_invoices.php');

		}else{
			$_SESSION['alert_type'] = 'danger';
		    $_SESSION['alert_msg'] = "There was a problem with the system please try again!";			
			
			header('Location:../view_manual_invoices.php');

		}
		
	}
       
?>
