<?php
    session_start();

    // Connect to the Database
    include('../includes/db_conn.php');

    // Getting the informtion from the form

    $branch_id = $_POST['branch_id'];
    $branch_password = $_POST['branch_password'];

    // Check if the password was filled

    if (!$branch_password){
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = 'You have to fill in the password field before proceeding';
        
        header('Location: ../login.php');
        
        break;
    }
    // Check from database
    
    $result = $db->query("SELECT * FROM `branch` WHERE `id` = '$branch_id' AND `password` = '$branch_password'");
    
    if($result->num_rows === 1){
        while($row = $result->fetch_assoc()){
            $branch_name = $row['name'];
        }
        $_SESSION['branch_id'] = $branch_id;
        $_SESSION['branch_name'] = $branch_name;
        $_SESSION['alert_type'] = 'success';
        $_SESSION['alert_msg'] = "Welcome to {$branch_name} branch!";
        
		$today = date("Y-m-d");
		$db->query("INSERT INTO `log` (`id`, `date`, `branch_id`, `log`) VALUES (NULL, '$today', '$branch_id', 'You logged in $branch_name branch')");
        header('Location:../home.php');
        
        break;
    }else{
        $_SESSION['alert_type'] = 'danger';
        $_SESSION['alert_msg'] = "The Password of the {$branch_name} branch is not correct, Please Retry!";
        header('Location:../login.php');
        
        break;
    }
?>