<?php
	//require 'db_conn.php';
	
	// Default Variables
	$today_date = date("Y-m-d");
	
	// Get the Total Amount of Manual Invoices
	function getTotalManualInvoices($entered){
		$results = $GLOBALS['db'] -> query("SELECT * FROM `manual_invoices` WHERE `entered` = '$entered' ORDER BY `id` DESC");
		
		$count = 0;
		while($row = $results->fetch_assoc()){
			$row['amount'];
			$count += $row['amount']. "<br />";
		}
		
		return number_format($count);
	}
	
	// Date Format: Example Fri - 4th June 2014 
	
	function custom_date_format($date){
		
		$format_date = strtotime( $date );
		$date = date( 'D - jS M o', $format_date );
		
		return $date;
	}
	
	// Log Writing Function
	
	function log_write($db, $user_id, $branch_id, $log){
		$today_date = $GLOBALS['today_date'];
		$db->query("INSERT INTO `log` (`id`, `date`, `user_id`, `branch_id`, `log`) VALUES (NULL, '$today_date', '$user_id', '$branch_id', '$log')");
	}
	
	// Check Authorization Type Of the User
	/*
		Authorization Type ($auth_type)
		1 - Administrator
		2 - Management
		3 - Manager
		4 - Cashier
		5 - Normal
	*/
	function check_auth($auth_type){
		if($auth_type == 1){
			return "administrator";
		}
		if($auth_type == 2){
			return "management";
		}
		if($auth_type == 3){
			return "manager";
		}
		if($auth_type == 4){
			return "cashier";
		}
		if($auth_type == 5){
			return "normal";
		}
		
	}
?>