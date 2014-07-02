<?php
    session_start();
    require 'db_conn.php';
    
    // Get information from the form
    
    $date = $_POST['date'];
    $total_sale = $_POST['total_sale'];
    $branch_id = $_SESSION['branch_id'];
	$user_id = $_SESSION['user_id'];
	$full_name = $_SESSION['full_name'];
    
	// Remove "," from the total_sale
	$total_sale = str_replace( ',', '', $total_sale);
	
    // Check if all fields are filled;
    
    if(!$date){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to select a <strong>date</strong>';
    
        header("Location: ../daily_sales.php");
        break;
    }
    
    if(!$total_sale){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to insert your <strong>Total Sale</strong>';
    
        header("Location: ../daily_sales.php");
        break;
    }
    
    // Check if the date has already been inserted

	$q = $db->query("SELECT * FROM `total_sale` WHERE `date` = '$date'");

	if($q->num_rows > 0){
		$_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have already entered todays <strong>Total Sale</strong>. You can Edit using the Edit Link';
    
        header("Location: ../daily_sales.php");
        break;
	}
    if($total_sale){
        
        // Insert the Total Sale in the Database
        $insert_results = $db->query("INSERT INTO `total_sale` (`id`, `date`, `branch_id`, `user_id`, `total_sale`, `audited_total_sale`) VALUES (NULL, '$date', '$branch_id', '$user_id', '$total_sale', '0')");
        
        if($insert_results){
            
            $_SESSION['alert_type'] = 'success';
            $_SESSION['alert_msg'] = "Thank you {$full_name}!";
            
			$today = date("Y-m-d");
			$db->query("INSERT INTO `log` (`id`, `date`, `branch_id`, `log`) VALUES (NULL, '$today', '$branch_id', 'Daily Sale : $total_sale for $date by $full_name')");

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
        $_SESSION['alert_msg'] = "The Password of the cashier is not correct, Please Retry!";
        
        header('Location:../daily_sales.php');
        
        break;
    }
?>
