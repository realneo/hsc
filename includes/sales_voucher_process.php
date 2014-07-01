<?php
    session_start();
    require 'db_conn.php';
	require 'global_functions.php';
    
    // Get information from the form
    
    $date = $_POST['date'];
    $sales_id = $_POST['sales_id'];
    $sales_voucher = $_POST['sales_voucher'];
    $branch_id = $_SESSION['branch_id'];
	$full_name = $_SESSION['full_name'];
	$user_id = $_SESSION['user_id'];

	// Getting Sales Name
	$query = $db->query("SELECT * FROM `user_profile` WHERE `user_id` = '$user_id'");
	
	while($row = $query->fetch_assoc()){
		$sales_name = $row['first_name'] . ' ' . $row['last_name'];
	}
	
	// Remove "," from the numbers
	$sales_voucher = str_replace( ',', '', $sales_voucher);

    // Check if all fields are filled;
    
    if(!$date){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to select a <strong>date</strong>';
    
        header("Location: ../sales_vouchers.php");
        break;
    }
    
    if(!$sales_voucher){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to insert your <strong>Sales Voucher</strong>';
    
        header("Location: ../sales_vouchers.php");
        break;
    }
    
    if(true){
     	// Insert the Total Sale in the Database
     	$insert_results = $db->query("INSERT INTO `sales_voucher` (`id`, `date`, `branch_id`, `sales_id`, `user_id`, `amount`) VALUES (NULL, '$date', '$branch_id', '$sales_id', '$user_id', '$sales_voucher')");
		
		if($insert_results){
			$_SESSION['alert_type'] = 'success';
        	$_SESSION['alert_msg'] = "Thank you {$full_name}!";
            

			$today = date("Y-m-d");
			$log = "$sales_name sold $sales_voucher on $date";
			log_write($user_id, $branch_id, $log);
			
            header('Location:../sales_vouchers.php');
        
            break;
        }else{
            $_SESSION['alert_type'] = 'danger';
            $_SESSION['alert_msg'] = "There was a problem with the system please try again!";
        
            header('Location:../sales_vouchers.php');
        
            break;
        }


    }else{
        $_SESSION['alert_type'] = 'danger';
        $_SESSION['alert_msg'] = "There was a major problem, Please Retry!";
        
        header('Location:../sales_vouchers.php');
        
        break;
    }
?>
