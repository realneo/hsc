<?php
    session_start();
    require 'db_conn.php';
    require 'global_functions.php';
    // Get information from the form
    
    $date = $_GET['date'];
    $amount = $_GET['amount'];
    $branch_id = $_SESSION['branch_id'];
	$user_id = $_SESSION['user_id'];
	$full_name = $_SESSION['full_name'];
    
	// Remove "," from the amount
	$amount = str_replace( ',', '', $amount);
	
    // Check if all fields are filled
    
    if(!$amount){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to insert your <strong>Binding Amount</strong>';
    
        header("Location: ../daily_binding_edit.php");
        die();
    }
    
    if($amount){
        
        // Insert the Total Sale in the Database
        $insert_results = $db->query("UPDATE binding SET `amount` = '$amount' WHERE `date` = '$date' AND `branch_id` = '$branch_id'");

        if($insert_results){
            
            $_SESSION['alert_type'] = 'success';

            ;
            $check=$db->affected_rows;
            if($check>=1){
                $_SESSION['alert_msg'] = "Thank you".make_me_bold($full_name)."!";
            }else{
                $_SESSION['alert_msg'] = "Sorry ".make_me_bold($full_name).", we dont have a binding inserted for ".make_me_bold($date)." yet!";
            }
            
			$today = date("Y-m-d");
			$db->query("INSERT INTO `log` (`id`, `date`, `branch_id`, `log`) VALUES (NULL, '$today', '$branch_id', 'Edited Bindings : $amount for $date by $full_name')");

            header('Location:../daily_binding_edit.php');
        
            die();
        }else{
            $_SESSION['alert_type'] = 'danger';
            $_SESSION['alert_msg'] = "There was a problem with the system please try again!";
        
            header('Location:../daily_binding_edit.php');
        
            die();
        }


    }else{
        $_SESSION['alert_type'] = 'danger';
        $_SESSION['alert_msg'] = "There was a major problem, Please Retry!";
        
        header('Location:../amount.php');
        
        break;
    }
?>
