<?php
    session_start();
    require 'db_conn.php';
    
    // Get information from the form
    
    $full_name = $_POST['full_name'];
    $branch_id = $_SESSION['branch_id'];
    $branch_name = $_SESSION['branch_name'];
    
    // Check if all fields are filled;
    
    if(!$full_name){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to select a <strong>date</strong>';
    
        header("Location: ../home.php");
        break;
    }
    
   
    // Insert new sales person in the Database
    $insert_results = $db->query("INSERT INTO `sales` (`id`, `name`, `branch_id`) VALUES (NULL, '$full_name', '$branch_id')");
        
    if($insert_results){
        $_SESSION['alert_type'] = 'success';
        $_SESSION['alert_msg'] = "Successfully Added {$full_name} to {$branch_name} branch!";

		$today = date("Y-m-d");
		$db->query("INSERT INTO `log` (`id`, `date`, `branch_id`, `log`) VALUES (NULL, '$today', '$branch_id', '$cashier_name Added $full_name to this branch')");
		
        header('Location:../home.php');

        break;
    }else{
        $_SESSION['alert_type'] = 'danger';
        $_SESSION['alert_msg'] = "There was a problem with the system please try again!";

        header('Location:../home.php');

        break;
    }
?>
