<?php
	// Connect to the database

    $db = new mysqli('localhost', 'root', 'root', 'hsc_db');
    
    if($db->connect_errno){
        die('Failed to Connect to the Database');
    }

?>