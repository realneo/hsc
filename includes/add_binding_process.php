<?php
    session_start();
    require 'db_conn.php';
    
    // Get information from the form
    
    $date = $_POST['date'];
    $amount = $_POST['amount'];
    $branch_id = $_SESSION['branch_id'];
	$user_id = $_SESSION['user_id'];
	$full_name = $_SESSION['full_name'];
    
	// Remove "," from the total_sale
	$amount = str_replace( ',', '', $amount);
	
    // Check if all fields are filled;
    
    if(!$date){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to select a <strong>date</strong>';
    
        header("Location: ../daily_sales.php");
        break;
    }
    
    if(!$amount){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to insert your <strong>Binding Amount</strong>';
    
        header("Location: ../daily_sales.php");
        break;
    }
    
    // Check if the date has already been inserted

	$q = $db->query("SELECT * FROM `binding` WHERE `date` = '$date' AND `branch_id` = '$branch_id'");

	if($q->num_rows > 0){
		$_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have already entered todays <strong>Binding Amount</strong>. You can Edit using the Edit Link';
    
        header("Location: ../daily_sales.php");
        break;
	}
    if($amount){
        
        // Insert the Binding Amount in the Database
        $insert_results = $db->query("INSERT INTO `binding` (`id`, `date`, `branch_id`, `user_id`, `amount`) VALUES (NULL, '$date', '$branch_id', '$user_id', '$amount')");
        
        if($insert_results){
            
            $_SESSION['alert_type'] = 'success';
            $_SESSION['alert_msg'] = "Thank you {$full_name}!";
            
			$today = date("Y-m-d");
			$db->query("INSERT INTO `log` (`id`, `date`, `branch_id`, `log`) VALUES (NULL, '$today', '$branch_id', 'Binding Amount : $amount for $date by $full_name')");

            header('Location:../daily_sales.php');
        
            break;
        }else{
            $_SESSION['alert_type'] = 'danger';
            $_SESSION['alert_msg'] = "There was a problem with the system please try again!";
        
            header('Location:../daily_sales.php');
        
            break;
        }


    }else{
        $_SESSION['alert_type'] = 'danger';
        $_SESSION['alert_msg'] = "There was a major problem, Please Retry!";
        
        header('Location:../daily_sales.php');
        
        break;
    }
?>
