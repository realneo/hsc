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
		$db->query("INSERT INTO `log` (`id`, `date`, `user_id`, `branch_id`, `log`) VALUES (NULL, '$today_date', '$user_id', '$branch_id', '$log')");
	}
?>