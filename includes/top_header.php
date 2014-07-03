<?php
	// Get all the sessions
	$user_id = $_SESSION['user_id'];
	$auth_type = $_SESSION['auth_type'];
	$full_name = $_SESSION['full_name'];
	$alert_type = $_SESSION['alert_type'];
    $alert_msg = $_SESSION['alert_msg'];
	$branch_id = $_SESSION['branch_id'];
	$branch_name = $_SESSION['branch_name'];
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>HSC | <?php echo $_SESSION['branch_name']; ?> Branch</title>

    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Blank -->
    <link href="css/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Morris -->
    <link href="css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    
    <!-- SB Admin CSS - Include with every page -->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body>
    <div id="wrapper">