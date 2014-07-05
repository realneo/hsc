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
        <h4 class="page-header"><?php echo $_SESSION['branch_name']; ?> Manual Invoices</h4>
    </div>
 	
	<!-- TOTAL MANUAL INVOICES -------------------------------------------------------------------------->
	
	<div class="col-lg-5">
        <div class="panel panel-default">
            <div class="panel-body"><h4><span class='lead'><small>Total Manual Invoices :</small> </span>Tshs <?php echo getTotalManualInvoices(0);?></h4></div>
        </div>
	</div>
	
	
	<!-- VIEW RECENT MANUAL INVOICES -------------------------------------------------------------------------->
	<div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Recent Added Manual Invoices</div>
            <div class="panel-body">
				<div class="table-responsive">
                    <table class="table table-striped  table-hover">
						<thead>
							<th class='col-lg-2'>Date</th>
							<th class='col-lg-2'>Amount</th>
							<th class='col-lg-2'>Status</th>
							<th class='col-lg-2'>Date Entered</th>
							<th class='col-lg-2'>Action</th>
						</thead>
						<tbody>
							<?php
								$branch_id = $_SESSION['branch_id'];
								$results = $db -> query("SELECT * FROM `manual_invoices` WHERE `branch_id` = '$branch_id' AND `entered` = 0");
								while($row = $results->fetch_assoc()){
									$id = $row['id'];
                        			$date = custom_date_format($row['date']);
									$amount = number_format($row['amount']);
									$entered_db = $row['entered'];
									$date_entered_db = $row['date_entered'];
									
									// Removing the 0000-00-00 from the list
									if($date_entered_db == '0000-00-00'){
										$date_entered = '';
									}else{
										$date_entered = custom_date_format($date_entered_db);
									}
									
									// Check if the Manual Invoice is Entered or Not
									if($entered_db == 1){
										$entered = "<span class='text-success'>Entered</span>";
									}else{
										$entered = '<span class="text-danger">Not Entered</span>';
									}
                        			echo "<tr>
											<td>{$date}</td>
											<td class='text-right'>{$amount}</td>
											<td>{$entered}</td>
											<td>{$date_entered}</td>
											<td>
												<form action='includes/enter_manual_process.php' method='post'>
													<div class='input-group'>
											      		<input class='form-control' type='text' name='amount' value='' />
														<input type='hidden' name='id' value='$id' />
											      		<span class='input-group-btn'>
											        		<button class='btn btn-primary' type='submit'>Enter</button>
											      		</span>
											    	</div>
												</form>
											</td>
										</tr>";
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