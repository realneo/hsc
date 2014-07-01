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
        <h4 class="page-header"><?php echo $_SESSION['branch_name']; ?> Returns</h4>
    </div>
 	
	<!-- RETURN FORM ----------------------------------------------------------------------------- -->
    
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Add a Return</div>
            <div class="panel-body">
                <form role="form" action="includes/returns_process.php" method="post">
	
                    <div class="form-group col-lg-3">
                        <label>Select Date</label>
                        <input class="form-control" id="datepicker2" type="text" name="date" value="<?php echo date('Y-m-d'); ?>" />
                    </div>
                                        
                    <div class="form-group col-lg-5">
                        <label>Action</label>
                        <input class="form-control" name="action" type="text" placeholder="" />
                    </div>
                                        
                    <div class="form-group col-lg-2">
                        <label>Receipt Number</label>
                        <input class="form-control" name="receipt_number" type="text" placeholder="" />
                    </div>

					<div class="form-group col-lg-2">
                        <label>Amount</label>
                        <input class="form-control" name="amount" type="number" placeholder="Enter Amount" />
                    </div>
                                        
                    <div class="form-group">
                        <button class="form-control btn btn-primary">Add A Return</button>
                    </div>
                </form>
            </div>
        </div>	
    </div>

	<!-- RECENT RETURNS -------------------------------------------------------------------------->
	
	<div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Recent Returns </div>
            <div class="panel-body">
				<div class="table-responsive">
                    <table class="table table-striped  table-hover">
						<thead>
							<th>Date</th>
							<th>Action</th>
							<th>Receipt Number</th>
							<th>Amount</th>
						</thead>
						<tbody>
							<?php
								// Get the Top 10 List of recent Sales Vouchers
								$result = $db->query("SELECT * FROM `returns` WHERE `branch_id` = '$branch_id' ORDER BY `id` DESC LIMIT 5");
								while($row = $result->fetch_assoc()){
									$date = custom_date_format($row['date']);
									$action = $row['action'];
									$receipt_number = $row['receipt_number'];
									$amount = number_format($row['amount']);
									
									echo 
									"
										<tr>
											<td>{$date}</td>
											<td>{$action}</td>
											<td>{$receipt_number}</td>
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