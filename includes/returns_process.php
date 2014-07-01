<?php
    session_start();
    require 'db_conn.php';
	require 'global_functions.php';
    
    // Get information from the form
    
    $date = $_POST['date'];
    $action = $_POST['action'];
    $receipt_number = $_POST['receipt_number'];
    $branch_id = $_SESSION['branch_id'];
	$full_name = $_SESSION['full_name'];
	$user_id = $_SESSION['user_id'];
	$amount = $_POST['amount'];

	// Remove "," from the numbers
	$amount = str_replace( ',', '', $amount);

    // Check if all fields are filled;
    
    if(!$date){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to select a <strong>date</strong>';
    
        header("Location: ../daily_returns.php");
        break;
    }
    
    if(!$action){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to fill in <strong>Action</strong> field';
    
        header("Location: ../daily_returns.php");
        break;
    }
	if(!$receipt_number){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to fill in <strong>Receipt Number</strong> field';
    
        header("Location: ../daily_returns.php");
        break;
    }
	
	if(!$amount){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to fill in the <strong>Amount</strong> field';
    
        header("Location: ../daily_returns.php");
        break;
    }
    
    if(true){
     	// Insert the Return in the Database
     	$insert_results = $db->query("INSERT INTO `returns` (`id`, `date`, `action`, `receipt_number`, `user_id`, `branch_id`, `amount`) VALUES (NULL, '$date', '$action', '$receipt_number', '$user_id', '$branch_id', '$amount');");
		
		if($insert_results){
			$_SESSION['alert_type'] = 'success';
        	$_SESSION['alert_msg'] = "Thank you {$full_name}!";
            

			$today = date("Y-m-d");
			$log = "Returned $action on $date";
			log_write($user_id, $branch_id, $log);
			
            header('Location:../daily_returns.php');
        
            break;
        }else{
            $_SESSION['alert_type'] = 'danger';
            $_SESSION['alert_msg'] = "There was a problem with the system please try again!";
        
            header('Location:../daily_returns.php');
        
            break;
        }


    }else{
        $_SESSION['alert_type'] = 'danger';
        $_SESSION['alert_msg'] = "There was a problem. Please Try again";
        
        header('Location:../daily_returns.php');
        
        break;
    }
?>
