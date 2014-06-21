<?php
    session_start();
    require 'db_conn.php';
    
    // Get information from the form
    
    $date = $_POST['date'];
    $sales_id = $_POST['sales_id'];
    $sales_voucher = $_POST['sales_voucher'];
    $cashier_id = $_POST['cashier_id'];
    $cashier_password = $_POST['cashier_password'];
    $branch_id = $_SESSION['branch_id'];

	// Getting the Sales Name
	$result = $db->query("SELECT * FROM `sales` WHERE `id` = '$sales_id'");

    while($row = $result->fetch_assoc()){
        $sales_name = $row['name'];
    }
    
    // Check if all fields are filled;
    
    if(!$date){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to select a <strong>date</strong>';
    
        header("Location: ../home.php");
        break;
    }
    
    if(!$sales_voucher){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to insert your <strong>Sales Voucher</strong>';
    
        header("Location: ../home.php");
        break;
    }
    
    if(!$cashier_password){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to insert your <strong>Password</strong>';
    
        header("Location: ../home.php");
        break;
    }
    
    // Check if Cashier's password match
    
    $results = $db->query("SELECT * FROM `cashier` WHERE `id` = '$cashier_id' AND `password` = '$cashier_password'");
    
    
    if($results->num_rows === 1){
        
        // Insert the Total Sale in the Database
        $insert_results = $db->query("INSERT INTO `sales_voucher` (`id`, `date`, `sales_id`, `cashier_id`, `sale_voucher`) VALUES ('', '$date', '$sales_id', '$cashier_id', '$sales_voucher')");
        
        if($insert_results){
            foreach($results as $result){
                $cashier_name = $result['name'];
            }
            $_SESSION['cashier_name'] = $cashier_name;
            $_SESSION['alert_type'] = 'success';
            $_SESSION['alert_msg'] = "Thank you {$cashier_name}!";
            

			$today = date("Y-m-d");
			$db->query("INSERT INTO `log` (`id`, `date`, `branch_id`, `log`) VALUES (NULL, '$today', '$branch_id', '$cashier_name - $sales_name sold $sales_voucher on $date')");
			
            header('Location:../home.php');
        
            break;
        }else{
            $_SESSION['alert_type'] = 'danger';
            $_SESSION['alert_msg'] = "There was a problem with the system please try again!";
        
            header('Location:../home.php');
        
            break;
        }


    }else{
        $_SESSION['alert_type'] = 'danger';
        $_SESSION['alert_msg'] = "The Password of the cashier is not correct, Please Retry!";
        
        header('Location:../home.php');
        
        break;
    }
?>
