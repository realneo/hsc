<?php
    
	// Connect to the database
    $db = new mysqli('localhost', 'hsctz_neo', 'jQueryMaster7', 'hsctz_private');
    
    if($db->connect_errno){
        die('Failed to Connect to the Database');
    }
?>