<?php
	ob_start();
    session_start();
    require 'db_conn.php';

	require 'global_functions.php';
    
    // Get information from the form
    
    $date = date("Y-m-d");
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
	$auth_type_id = $_POST['auth_type'];
	$auth_type = $_SESSION['auth_type'];
	$user_id = $_SESSION['user_id'];
	$branch_id = $_SESSION['branch_id'];
	$full_name = $_SESSION['full_name'];
	
	// Check if the user is authorized to give such previllages;
	
	if($auth_type_id < $auth_type){
		$_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You cannot add a user with such <strong>Authorisations</strong>';
    
        header("Location: ../add_new_staff.php");
        break;	
	}
	
    // Check if all fields are filled;
    
    if(!$date){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to fill in the <strong>Date</strong> field.';
    
        header("Location: ../add_new_staff.php");
        break;
    }
    if(!$first_name){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to fill in <strong>First Name</strong> field.';
    
        header("Location: ../add_new_staff.php");
        break;
    }
	if(!$last_name){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to fill in <strong>Last Name</strong> field.';
    
        header("Location: ../add_new_staff.php");
        break;
    }
	if(!$email){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to fill in <strong>Email</strong> field.';
    
        header("Location: ../add_new_staff.php");
        break;
    }
	if(!$password){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to fill in <strong>Password</strong> field.';
    
        header("Location: ../add_new_staff.php");
        break;
    }
    // Insert into user table first

    $query = $db->query("INSERT INTO `users` (`id`, `date`, `email`, `password`, `branch_id`, `auth_type`, `user_id`) VALUES (NULL, '$date', '$email', '$password', '$branch_id', '$auth_type_id', '$user_id')");

	// Get ID of the new staff
	$staff_id = $db->insert_id;
	

	if($query){
		
		// Insert into user_profile table
		
		$profile_query = $db->query("INSERT INTO `user_profile` (`id`, `first_name`, `last_name`, `user_id`) VALUES (NULL, '$first_name', '$last_name', '$staff_id');");

        $_SESSION['alert_type'] = 'success';
        $_SESSION['alert_msg'] = "Thank you {$full_name}!";
        
		// Write into Log
		$log = "Added : $first_name $last_name in the Database";
		log_write($user_id, $branch_id, $log);
		
       	header('Location:../add_new_staff.php');
        
        break;
   	}else{
    	$_SESSION['alert_type'] = 'danger';
        $_SESSION['alert_msg'] = "There was a problem with the system please try again!";
        
        header('Location:../add_new_staff.php');
        
        break;

    }
?>
