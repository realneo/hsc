<?php
	//require 'db_conn.php';
	
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
	
?>