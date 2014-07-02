<?php session_start(); ?>
<?php require 'includes/logged_user_check.php'; ?>
<?php require 'includes/db_conn.php'; ?>

<?php require 'includes/global_functions.php'; ?>

<?php include 'includes/top_header.php'; ?>

<?php include 'includes/top_nav.php';?>        
<?php include 'includes/side_bar.php'; ?>

<?php include 'includes/header.php'; ?>
             
<?php
	// Getting Date
	if($_GET['date'] == 0){
		$date = date("Y-m-d");
	}else{
		$date = $_GET['date'];
	}

?>        

<div class="row">
    
    <!-- PAGE HEADING ------------------------------------------------------------------------------------>
    
    <div class="col-lg-12">
        <h4 class="page-header"><?php echo $_SESSION['branch_name']; ?> Cash Collection Report</h4>
    </div>

 	<!-- SELECT REPORT DATE -------------------------------------------------------------------------------->
	<div class="col-lg-2 no-print">
		<form action='' method='get'>
			<div class="input-group">
		      	<input class="form-control" id="datepicker2" type="text" name="date" value="<?php echo date('Y-m-d'); ?>" />
		      	<span class="input-group-btn">
		        	<button class="btn btn-primary" type="submit">Go!</button>
		      	</span>
		    </div>
		</form>
	</div>
	
	<!-- DISPLAY CASH COLLECTION REPORT -------------------------------------------------------------------->
	
	<div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading"> 
				HSC - <?php echo $_SESSION['branch_name']; ?> Branch
			</div>
            <div class="panel-body">
				<p><span class='small'>Report For :</span> <?php echo custom_date_format($date); ?> </p>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
							<th>Details</th>
							<th>Amount</th>
							<th>Amount</th>
						</thead>
						<tbody>
							<tr><th colspan="3">INCOME</th></tr>
							<?php
								$results = $db->query("SELECT * FROM `total_sale` WHERE `date` = '$date' AND `branch_id` = '$branch_id'");
								$total_sale = 0;
								while($row = $results->fetch_assoc()){
									$total_sale = $row['total_sale'];
								}
								
								$total_sale = number_format($total_sale);
							?>
							<tr>
								<td> Total Sale In System </td>
								<td></td>
								<td class='text-right'> <?php echo $total_sale; ?> </td>
							</tr>
							<tr><th colspan="3">PAYMENTS</th></tr>
							<?php
								$expenses = $db->query("SELECT * FROM `expenses` WHERE `date` = '$date' AND `branch_id` = '$branch_id'");
								$total_expenses = 0;
								while($rows = $expenses->fetch_assoc()){
									$expense_purpose = $rows['purpose'];
									$expense_amount = $rows['amount'];
									$total_expenses += $expense_amount;
									
									$expenses_amount = number_format($expense_amount);
									echo
									"
									 <tr>
										<td> $expense_purpose </td>
										<td class='text-right'> $expenses_amount </td>
										<td></td>
									</tr>
									
									";
								}
								
									$totals_expenses = number_format($total_expenses);
							?>
							<tr>
								<td colspan="2"></td>
								<td class='text-right'><?php echo $totals_expenses; ?></td>
							</tr>
							<tr><th colspan="3">ADJUSTMENTS</th></tr>
							<?php
								$manuals = $db->query("SELECT * FROM `manual_invoices` WHERE `branch_id` = '$branch_id' AND `date` = '$date' AND `entered` = 0");
								
								$total_manual = 0;
								while($ro = $manuals->fetch_assoc()){
									$manual_amount = $ro['amount'];
									$total_manual += $manual_amount ;	
								}
								
								$total_not_manual_invoices = number_format($total_manual);
							
							?>
							<tr>
								<td> Manual Not Entered </td>
								<td class='text-right'><?php echo $total_not_manual_invoices; ?></td>
								<td></td>
							</tr>
							<?php
								$manual = $db->query("SELECT * FROM `manual_invoices` WHERE `branch_id` = '$branch_id' AND `date` = '$date' AND `entered` = 1");
								
								$total_manual = 0;
								while($r = $manual->fetch_assoc()){
									$manual_amount = $r['amount'];
									$total_manual += $manual_amount ;
									
								}
								$total_entered_manual_invoices = number_format($total_manual);
							
							?>
							<tr>
								<td> Manual Entered </td>
								<td class='text-right'><?php echo $total_entered_manual_invoices; ?></td>
								<td></td>
							</tr>
							<?php
								$returns = $db->query("SELECT * FROM `returns` WHERE `branch_id` = '$branch_id' AND `date` = '$date'");
								
								$total_return = 0;
								while($rowed = $returns->fetch_assoc()){
									$return = $rowed['amount'];
									$total_return += $return ;
								}
								$total_returns = number_format($total_return);
							
							?>
							<tr>
								<td> Returns </td>
								<td class='text-right'> <?php echo $total_returns; ?></td>
								<td></td>
							</tr>
							<tr>
								<td colspan="2"></td>
								<td class='text-right'>
									<?php
									$total_adjustments = 
									str_replace( ',', '', $total_entered_manual_invoices ) +
									str_replace( ',', '', $total_not_manual_invoices) +
									str_replace( ',', '', $total_returns);
									
										echo number_format($total_adjustments);
									?>
								</td>
							</tr>
							<tr>
								<td> <h4>CASH IN HAND</h4> </td>
								<td></td>
								<td class='text-right'>
									<?php
										// CASH IN HAND
										// Formula: Income - Payments - Adjustments
										
										$total_sale = str_replace( ',', '', $total_sale);
										$total_expenses = str_replace( ',', '', $total_expenses);
										$total_adjustments = str_replace( ',', '', $total_adjustments);
										
										$cash_in_hand = $total_sale - $total_expenses - $total_adjustments;
										
										$cash_in_hand = number_format($cash_in_hand);
										echo "<h4> $cash_in_hand </h4>";
									?>
								</td>
							</tr>
						</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
	
</div>

<?php include 'includes/footer.php';?>