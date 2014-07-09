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
        <h4 class="page-header"><?php echo $_SESSION['branch_name']; ?> Daily Sales</h4>
    </div>
 	
	<!-- DISPLAY TODAY BINDING SALES -------------------------------------------------------------------->
	
	<div class='col-lg-4'>
		
		<div class='well well-sm'>
			<p>Binding For Today <br /> <span class='small'><?php $date = date("Y-m-d"); echo custom_date_format($date)?><p>
			<form action="includes/daily_binding_edit.php" method='get'>
				<div class="input-group">
					<span class="input-group-addon">Tshs</span>
					<input class='form-control' type='number' name='amount' placeholder="<?php echo get_today_binding(); ?>"/>
					<span class="input-group-btn"><button class="btn btn-primary" type="submit">Save</button></span>
				</div>
				<input type='hidden' name='date' value="<?php echo date('Y-m-d'); ?>" />
			</form>
		</div>

	</div>
	<!-- VIEW RECENT DAILY SALES -------------------------------------------------------------------------->
	<div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">Recent Binding Sale</div>
            <div class="panel-body">
				<div class="table-responsive">
                    <table class="table table-striped  table-hover">
						<thead>
							<th>Date</th>
							<th>Binding Amount</th>
						</thead>
						<tbody>
							<?php
								$branch_id = $_SESSION['branch_id'];
								$results = $db -> query("SELECT * FROM binding WHERE branch_id = '$branch_id' ORDER BY 'date' DESC LIMIT 5");
								while($row = $results->fetch_assoc()){
                        			$date = custom_date_format($row['date']);
									$amount = number_format($row['amount']);
									
                        			echo "<tr>
											<td>{$date}</td>
											<td class='text-right'>{$amount}</td>
										</tr>";
                    			}
							?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

	<!-- RECENT ACTIVITIES ---------------------------------------------------------------------------------->

    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">Recent Activities</div>
            <div class="panel-body">
				<div class="table-responsive">
                    <table class="table table-striped  table-hover">
						<tbody>
							<?php
								$results = $db -> query("SELECT * FROM log WHERE branch_id = '$branch_id' ORDER BY id DESC LIMIT 5");
								$count = 0;	
								while($row = $results->fetch_assoc()){
									$count++;
                        			$log = $row['log'];
									$log_date = $row['date'];
									
                        			echo "<tr><td>{$count}</td><td><strong>{$log_date}</strong><br />{$log}</td></tr>";
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