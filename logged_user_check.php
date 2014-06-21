<?php
    if(!$_SESSION['branch_id']){
        $_SESSION['alert_type'] = 'error';
        $_SESSION['alert_msg'] = 'Login first before visiting any pages';
        
        header('Location: login.php');
    }else{
        $_SESSION['branch_name'];
    }
?>