<?php session_start(); ?>
<?php require 'includes/logged_user_check.php'; ?>
<?php require 'includes/db_conn.php'; ?>

<?php require 'includes/global_functions.php'; ?>

<?php include 'includes/top_header.php'; ?>

<?php include 'includes/top_nav.php';?>        
<?php include 'includes/side_bar.php'; ?>

<?php include 'includes/header.php'; ?>

<div class="row">
    
    <!-- PAGE HEADING ------------------------------------------------------------------------------------>
    
    <div class="col-lg-12">
        <h4 class="page-header"><?php echo $_SESSION['branch_name']; ?> Staff Management</h4>
    </div>

 	<!-- ADD STAFF FORM -------------------------------------------------------------------------------->
	
	<div class="col-lg-4">
		<form action='includes/add_new_staff_process.php' method='post'>
			<div class="form-group col-lg-6">
	            <label>First Name</label>
	            <input class="form-control" type="text" name="first_name" value=""/>
	        </div>

			<div class="form-group col-lg-6">
	            <label>Last Name</label>
	            <input class="form-control" type="text" name="last_name" value=""/>
	        </div>
		
			<div class="form-group col-lg-12">
	            <label>Authorisation Type</label>
	            <select class='form-control' name='auth_type'>
					<?php
						$results = $db->query("SELECT * FROM `auth_type`");
						while($row = $results->fetch_assoc()){
							$auth_type_id = $row['id'];
							$auth_type_name = $row['name'];
							
							echo "<option value='$auth_type_id'>$auth_type_name</option>";
						}
					?>
				</select>
	        </div>

			<div class="form-group col-lg-12">
	            <label>Email</label>
	            <input class="form-control" type="email" name="email" value=""/>
	        </div>

			<div class="form-group col-lg-12">
	            <label>password</label>
	            <input class="form-control" type="password" name="password" value=""/>
	        </div>

			<div class="form-group col-lg-12">
	            <button class="form-control btn btn-primary">Add New Staff</button>
        	</div>
		</form>
	</div>
	
</div>

<?php include 'includes/footer.php';?>