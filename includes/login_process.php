<?php
	ob_start();
    session_start();

    // Connect to the Database
    require 'db_conn.php';

	// Load Global Functions
	include 'global_functions.php';

    // Getting the informtion from the form

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the username & password were filled

    if (!$email){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to fill in the Email field before proceeding';
        
        header('Location: ../login.php');
      
    }

	if (!$password){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to fill in the Password field before proceeding';
        
        header('Location: ../login.php');
        
    }

    // Check from database
    
    $result = $db->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'");
    
	// If email and password exist in the database and the login information is true
    if($result->num_rows === 1){
        foreach($result as $row){
            $user_id = $row['id'];
			$auth_type = $row['auth_type'];
			$branch_id = $row['branch_id'];
        }

		// Getting user First Name and Last Name from the user_profile table
		
		$results = $db->query("SELECT * FROM user_profile WHERE user_id = '$user_id'");
		
		while($rows = $results->fetch_assoc()){
			$first_name = $rows['first_name'];
			$last_name = $rows['last_name'];
			
			$full_name = $first_name . ' ' . $last_name;
		}
		
		// Checking User Authorization Type
		/*
			Authorization Type ($auth_type)
			1 - Administrator
			2 - Management
			3 - Manager
			4 - Cashier
			5 - Sales
			6 - Security
			7 - Normal
		*/
		
		if($auth_type == 1 || $auth_type == 2){
			
			// If the user is Administrator or Management there should not be a branch specific
			$_SESSION['user_id'] = $user_id;
			$_SESSION['auth_type'] = $auth_type;
			$_SESSION['full_name'] = $full_name;
			$_SESSION['alert_type'] = 'success';
	        $_SESSION['alert_msg'] = "Welcome {$full_name}!";
			$_SESSION['branch_id'] = $branch_id;
			
			log_write($user_id, $branch_id, $full_name.' logged in.');
			
			header('Location:../home.php');
			
		}else{
			// If the user is a Cashier
			$_SESSION['user_id'] = $user_id;
			$_SESSION['auth_type'] = $auth_type;
			$_SESSION['full_name'] = $full_name;
			$_SESSION['alert_type'] = 'success';
	        $_SESSION['alert_msg'] = "Welcome {$full_name}!";
			$_SESSION['branch_id'] = $branch_id;
			
			log_write($user_id, $branch_id, $full_name.' logged in.');
			
			header('Location:../select_branch.php');

		}


    }else{
        $_SESSION['alert_type'] = 'danger';
        $_SESSION['alert_msg'] = "The Password of the {$email} is not correct, Please Retry!";
        header('Location:../login.php');

    }
