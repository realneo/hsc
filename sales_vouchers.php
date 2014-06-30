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
        <h4 class="page-header"><?php echo $_SESSION['branch_name']; ?> Sales Vouchers</h4>
    </div>
 	
	<!-- SALE VOUCHER ----------------------------------------------------------------------------- -->
    
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">Add Sales Voucher</div>
            <div class="panel-body">
                <form role="form" action="includes/sales_voucher_process.php" method="post">
	
                    <div class="form-group col-lg-3">
                        <label>Select Date</label>
                        <input class="form-control" id="datepicker2" type="text" name="date" value="<?php echo date('Y-m-d'); ?>" />
                    </div>
                                        
                    <div class="form-group col-lg-6">
                        <label>Sales</label>
                        <select class="form-control" name="sales_id">
                            <?php

                               $result = $db->query("SELECT * FROM `users` WHERE `branch_id` = '$branch_id' AND `auth_type` = 5 ORDER BY `email` ASC");

                                while($row = $result->fetch_assoc()){
                                    $sales_id = $row['id'];
									
									$results = $db->query("SELECT * FROM `user_profile` WHERE `user_id` = '$sales_id'");
									
									while($rows = $results->fetch_assoc()){
										$sales_name = $rows['first_name']. ' ' . $row['last_name'];
									}
                                    echo "<option value='{$sales_id}'>{$sales_name}</option>";
                                }
                            ?>
                        </select>
                    </div>
                                        
                    <div class="form-group col-lg-3">
                        <label>Sales Voucher</label>
                        <input class="form-control" name="sales_voucher" type="number" placeholder="Enter Amount" />
                    </div>
                                        
                    <div class="form-group">
                        <button class="form-control btn btn-primary">Add Sales Voucher</button>
                    </div>
                </form>
            </div>
        </div>	
    </div>

	<!-- TODAY SALES VOUCHERS -------------------------------------------------------------------------->
	
	<div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">Recent Sales Voucher </div>
            <div class="panel-body">
				<div class="table-responsive">
                    <table class="table table-striped  table-hover">
						<thead>
							<th>Sales Name</th>
							<th>Sales Voucher</th>
						</thead>
						<tbody>
							<?php
								// Get the Top 10 List of recent Sales Vouchers
								$result = $db->query("SELECT * FROM `sales_voucher` WHERE `branch_id` = '$branch_id' ORDER BY `id` DESC LIMIT 5");
								while($row = $result->fetch_assoc()){
									$sales_id = $row['sales_id'];
									$amount = number_format($row['amount']);
									
									// Get Full name of the Sales Person
									$results = $db->query("SELECT * FROM `user_profile` WHERE `user_id` = '$sales_id'");
									while($rows = $results->fetch_assoc()){
										$sales_name = $rows['first_name']. ' ' . $rows['last_name'];
									}
									echo 
									"
										<tr>
											<td>{$sales_name}</td>
											<td>{$amount}</td>
										</tr>
									";
								}
							?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include 'includes/footer.php';?>