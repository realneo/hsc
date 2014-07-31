<!DOCTYPE html>
<html>
	<head>

	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	    <title>HSC | Login</title>

	    <!-- Core CSS - Include with every page -->
	    <link href="<?php echo base_url('assets');?>/css/bootstrap.min.css" rel="stylesheet">
	    <link href="<?php echo base_url('assets');?>/font-awesome/css/font-awesome.css" rel="stylesheet">

	    <!-- SB Admin CSS - Include with every page -->
	    <link href="<?php echo base_url('assets');?>/css/sb-admin.css" rel="stylesheet">

	</head>


<body>

    <div class="container">
        <!-- Notification -->
        <div class="row">
            <?php
		    if(!$this->session->flashdata('alert_type') || !$this->session->flashdata('alert_msg')){
		        // Display nothing
		    }else{?>
		        <!-- Notification -->
		        <div class="row">

		            <?php
		            $alert_type = $this->session->flashdata('alert_type');
		            $alert_msg = $this->session->flashdata('alert_msg');?>
		            <div class='alert alert-<?php echo $alert_type;?> alert-dismissible'>
		                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
		                    &times;</button>
		                <p><?php echo $alert_msg?></p></div>
		        </div>
		    <?php
		    }
		    ?>
			
        </div>
		
		<!-- Login Form ---------------------------------------------------------------------------------->
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
					<img src='<?php echo base_url(); ?>/assets/img/HSC-circle-logo.jpg' alt='Home Shopping Center' width='350' style="padding: 12px"/>
                    <div class="panel-heading">
                        <h3 class="panel-title">HSC | Staff Login</h3>
                    </div>
                    <div class="panel-body">
						<?php echo form_open('login/login_process'); ?>
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
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>