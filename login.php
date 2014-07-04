<?php
    session_start();
    include('includes/db_conn.php');
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
					<img src='images/logo.png' alt='Home Shopping Center' width='350'/>
                    <div class="panel-heading">
                        <h3 class="panel-title">HSC | Staff Login</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action='includes/login_process.php' method='post'>
                            <fieldset>
								<div class="form-group">
                                    <h5><small>Email</small></h5>
                                    <input class="form-control" placeholder="Email" name="email" type="email" value="">
                                </div>
                                <div class="form-group">
                                    <h5><small>Password</small></h5>
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-primary btn-block" type='submit'>Login</button>
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
