<?php
	ob_start();
    session_start();

    // Connect to the Database
    require 'db_conn.php';

	// Load Global Functions
	include 'global_functions.php';

    // Getting the informtion from the form

    $branch_id = $_POST['branch_id'];

    // Check if branch is selected

    if ($branch_id == 0){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to select a branch before proceeding';
        
        header('Location: ../select_branch.php');
        
        die();//break;
    }

	// Getting the Branch Name
	//removed `s
	$results = $db->query("SELECT * FROM branch WHERE id = '$branch_id'");

	while($row = $results->fetch_assoc()){
		$branch_name = $row['name'];
	}
	
	// Assign SESSIONS to the Branches
	
	$_SESSION['branch_id'] = $branch_id;
	$_SESSION['branch_name'] = $branch_name;
	
	header('Location: ../home.php');
?>