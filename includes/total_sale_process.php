<?php
    session_start();
    require 'db_conn.php';
    
    // Get information from the form
    
    $date = $_POST['date'];
    $total_sale = $_POST['total_sale'];
    $cashier_id = $_POST['cashier_id'];
    $cashier_password = $_POST['cashier_password'];
    $branch_id = $_SESSION['branch_id'];
    
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
    
    if(!$cashier_password){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to insert your <strong>Password</strong>';
    
        header("Location: ../daily_sales.php");
        break;
    }
    
    // Check if Cashier's password match
    
    $results = $db->query("SELECT * FROM `cashier` WHERE `id` = '$cashier_id' AND `password` = '$cashier_password'");
    
    
    if($results->num_rows === 1){
        
        // Insert the Total Sale in the Database
        $insert_results = $db->query("INSERT INTO `total_sale` (`id`, `date`, `branch_id`, `cashier_id`, `total_sale`, `audited_total_sale`) VALUES (NULL, '$date', '$branch_id', '$cashier_id', '$total_sale', '0')");
        
        if($insert_results){
            foreach($results as $result){
                $cashier_name = $result['name'];
            }
            $_SESSION['cashier_name'] = $cashier_name;
            $_SESSION['alert_type'] = 'success';
            $_SESSION['alert_msg'] = "Thank you {$cashier_name}!";
            
			$today = date("Y-m-d");
			$db->query("INSERT INTO `log` (`id`, `date`, `branch_id`, `log`) VALUES (NULL, '$today', '$branch_id', '$cashier_name - Total Sale : $total_sale on $date')");

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
