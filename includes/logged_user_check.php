<?php
	ob_start();
	
    if(!$_SESSION['user_id']){
        $_SESSION['alert_type'] = 'error';
        $_SESSION['alert_msg'] = 'Login first before visiting any pages';
        
        header('Location: login.php');
    }
?>