<?php session_start(); ?>
<?php require 'includes/logged_user_check.php'; ?>
<?php require 'includes/db_conn.php'; ?>

<?php require 'includes/global_functions.php'?>

<?php include 'includes/top_header.php'; ?>

<?php include 'includes/top_nav.php';?>        
<?php include 'includes/side_bar.php'; ?>

<?php include 'includes/header.php'; ?>
             
        

<div class="row">
    
    <!-- PAGE HEADING ------------------------------------------------------------------------------------>
    
    <div class="col-lg-12">
        <h4 class="page-header"><?php echo $_SESSION['branch_name']; ?> Daily Expenses</h4>
    </div>
 	
	<!-- ADD EXPENSES FORM ------------------------------------------------------------------------------>
    
	<div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Add Expenses</div>
            <div class="panel-body">
                <form role="form" action="includes/add_expense_process.php" method="post">
                
                    <div class="form-group col-lg-2">
                        <label>Select Date</label>
                        <input class="form-control" id="datepicker" type="text" name="date" value="<?php echo date('Y-m-d'); ?>" />
                    </div>

                    <div class="form-group col-lg-6">
                        <label>Purpose</label>
                        <input class="form-control" name="purpose" type="text" />
                    </div>
					
					<div class="form-group col-lg-2">
                        <label>Received By</label>
                        <input class="form-control" name="received_by" type="text" />
                    </div>

					<div class="form-group col-lg-2">
                        <label>Amount</label>
                        <input class="form-control" name="amount" type="number" placeholder='Enter Amount' />
                    </div>

                    <div class="form-group">
                        <button class="form-control btn btn-primary">Add Expense</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

	<!-- DISPLAY TODAY TOTAL EXPENSES -------------------------------------------------------------------->
	
	<div class='col-lg-3'>
		<div class='well well-sm'>
			<p>Total Expenses For Today <br /> <span class='small'><?php $date = date("Y-m-d"); echo custom_date_format($date)?><p>
				<h3><span class='small'>Tshs</span> <?php echo get_today_expenses(); ?></h3>
		</div>
	</div>
	
	<!-- VIEW RECENT EXPENSES -------------------------------------------------------------------------->
	<div class="col-lg-9">
        <div class="panel panel-default">
            <div class="panel-heading">Recent Expenses</div>
            <div class="panel-body">
				<div class="table-responsive">
                    <table class="table table-striped  table-hover">
						<thead>
							<th>Date</th>
							<th>Purpose</th>
							<th>Received By</th>
							<th>Amount</th>
							<th>Action</td>
						</thead>
						<tbody>
							<?php
								$branch_id = $_SESSION['branch_id'];
								$results = $db -> query("SELECT * FROM `expenses` WHERE `branch_id` = '$branch_id' ORDER BY `id` DESC LIMIT 5");

								$today_date = custom_date_format(date("Y-m-d"));
								
								while($row = $results->fetch_assoc()){
									$id = $row['id'];
                        			$date = custom_date_format($row['date']);
									$purpose = $row['purpose'];
									$received_by = $row['received_by'];
									$amount = number_format($row['amount']);
									$button = "<a href='includes/delete_expense_process.php?id=$id&amount=$amount&purpose=$purpose' class='btn btn-danger form-control' onclick= return&#32;confirm('Are&#32;you&#32;sure&#32;you&#32;want&#32;to&#32;Delete&#32;this&#32;Item?');>Delete</a>";
									if($date == $today_date){
										echo "<tr>
												<td>{$date}</td>
												<td>{$purpose}</td>
												<td>{$received_by}</td>
												<td class='text-right'>{$amount}</td>
												<td>{$button}</td>
											</tr>";
									}else{
										echo "<tr>
											<td>{$date}</td>
											<td>{$purpose}</td>
											<td>{$received_by}</td>
											<td class='text-right'>{$amount}</td>
											<td></td>
										</tr>";
									}
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