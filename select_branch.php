<?php
	ob_start();
    session_start();
    include('includes/db_conn.php');

	require 'includes/logged_user_check.php';
	require 'includes/global_functions.php'; 
	
	$auth_type = $_SESSION['auth_type'];
	$fullname = $_SESSION['full_name'];
	
	// Check if user is a cashier
	if(check_auth($auth_type) != 'cashier'){
		$_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_msg'] = "$fullname, Only Accountants can Select Branch!";
		header("Location:home.php");
	}
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>HSC | Branch Sales</title>

    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body>

    <div class="container">
        <!-- Notification -->
        <div class="row">
            <?php
                if(!$_SESSION['alert_type'] || !$_SESSION['alert_msg']){
                    // Display nothing
                }else{

                    $alert_type = $_SESSION['alert_type'];
                    $alert_msg = $_SESSION['alert_msg'];
                    echo "
                        <div class='alert alert-{$alert_type} alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            {$alert_msg}
                        </div>
                    ";
                }
            ?>
        </div>
		
		<!-- Login Form ---------------------------------------------------------------------------------->
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">HSC | Cashiers</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action='includes/select_branch_process.php' method='post'>
                            <fieldset>
                                <div class="form-group">
                                    <h5><small>Select Branch</small></h5>
									<select name='branch_id' class="form-control">
										<option value='0'> Choose a Branch </option>
										<?php
											 $result = $db->query("SELECT * FROM `branch` ORDER BY `name` ASC");

				                                while($row = $result->fetch_assoc()){
				                                    $branch_id = $row['id'];
				                                    $branch_name = $row['name'];
				                                    echo "<option value='{$branch_id}'>{$branch_name} Branch</option>";
				                               	}
										?>
									</select>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-primary btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>

</body>

</html>

<?php
    $_SESSION['alert_type'] = '';
    $_SESSION['alert_msg'] = '';
?>
