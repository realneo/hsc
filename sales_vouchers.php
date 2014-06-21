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
                        <input class="form-control" id="datepicker2" type="text" name="date" />
                    </div>
                                        
                    <div class="form-group col-lg-5">
                        <label>Sales</label>
                        <select class="form-control" name="sales_id">
                            <?php
                                $branch_id = $_SESSION['branch_id'];
                                $result = $db->query("SELECT * FROM `sales` WHERE `branch_id` = '$branch_id' ORDER BY `name` ASC");

                                while($row = $result->fetch_assoc()){
                                    $sales_id = $row['id'];
                                    $sales_name = $row['name'];
                                    echo "<option value='{$sales_id}'>{$sales_name}</option>";
                                }
                            ?>
                        </select>
                    </div>
                                        
                    <div class="form-group col-lg-3">
                        <label>Sales Voucher</label>
                        <input class="form-control" name="sales_voucher" type="number" placeholder="Enter Amount" />
                    </div>
                                        
                    <div class="form-group col-lg-4">
                        <label>Cashier</label>
                        <select class="form-control" name="cashier_id">
                            <?php
                                $result = $db->query("SELECT * FROM `cashier` ORDER BY `name` ASC");

                                while($row = $result->fetch_assoc()){
                                    $cashier_id = $row['id'];
                                    $cashier_name = $row['name'];
                                    echo "<option value='{$cashier_id}'>{$cashier_name}</option>";
                                }
                            ?>
                        </select>
                    </div>
                                        
                    <div class="form-group col-lg-4">
                        <label>Cashier Password</label>
                        <input class="form-control" name="cashier_password" type="password" />
                    </div>
                                        
                    <div class="form-group">
                        <button class="form-control btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>	
    </div>

	<!-- VIEW RECENT SALES VOUCHERS -------------------------------------------------------------------------->
	
	<div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">Recent Total Sale</div>
            <div class="panel-body">
				<div class="table-responsive">
                    <table class="table table-striped  table-hover">
						<thead>
							<th>Date</th>
							<th>Sales</th>
							<th>Sales Voucher</th>
						</thead>
						<tbody>
							<?php
								$branch_id = $_SESSION['branch_id'];
								$results = $db -> query("SELECT * FROM `sales_voucher` WHERE `branch_id` = '$branch_id' ORDER BY `id` DESC LIMIT 5");
								while($row = $results->fetch_assoc()){
                        			$date = custom_date_format($row['date']);
									$sales_id = $row['sales_id'];
									$sales_voucher = number_format($row['sales_voucher']);
		                                
									$result = $db->query("SELECT * FROM `sales` WHERE `id` = '$sales_id'");

		                            while($row = $result->fetch_assoc()){
		                                $sales_name = $row['name'];
		                            }
                        			echo "<tr>
											<td>{$date}</td>
											<td>{$sales_name}</td>
											<td class='text-right'>{$sales_voucher}</td>
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