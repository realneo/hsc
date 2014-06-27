<?php session_start(); ?>
<?php //require 'includes/logged_user_check.php'; ?>
<?php require 'includes/db_conn.php'; ?>

<?php include 'includes/top_header.php'; ?>

<?php include 'includes/top_nav.php';?>        
<?php include 'includes/side_bar.php'; ?>

<?php include 'includes/header.php'; ?>
             
        

<div class="row">
    
    <!-- PAGE HEADING ------------------------------------------------------------------------------------>
    
    <div class="col-lg-12">
        <h4 class="page-header"><?php echo $full_name; ?> Total Sale Report</h4>
    </div>
    
	<!-- TOTAL SALE GRAPH ---------------------------------------------------------------------------------->
	<!--
	<div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Total Sale Chart
                </div>
                <div class="panel-body">
                    <div id="total_sale_chart"></div>
                </div>
            </div>
        </div>
	-->
	
	<!-- TOTAL SALE TABLE ---------------------------------------------------------------------------------->
	
	<div class="table-responsive col-lg-12">
    	<table class="table table-striped  table-bordered table-hover">
			<?php
				$branch_id = $_SESSION['branch_id'];
				$results = $db->query("SELECT * FROM `total_sale` WHERE `branch_id` = '$branch_id'");
		
				$today = date('d');
				$count = 0;
				while($row = $results->fetch_assoc()){
					$db_date = $row['date'];
				}
			?>
		</table>
	</div>
    <!-- INSERT TOTAL SALE REPORT -------------------------------------------------------------------------->
    
    <div class="col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading">Insert Total Sale Report</div>
            <div class="panel-body">
                <form role="form" action="includes/total_sale_process.php" method="post">
                
                    <div class="form-group">
                        <label>Select Date</label>
                        <input class="form-control" id="datepicker" type="text" name="date" />
                        <p class="help-block">Make sure you select the date.</p>
                    </div>

                    <div class="form-group">
                        <label>Total Sale</label>
                        <input class="form-control" name="total_sale" type="text" placeholder="Enter Amount"/>
                    </div>

                    <div class="form-group">
                        <label>Cashiers</label>
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

                    <div class="form-group">
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
    
    <!-- SALE VOUCHER ----------------------------------------------------------------------------- -->
    
    <div class="col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading">Sales Voucher</div>
            <div class="panel-body">
                <form role="form" action="includes/sales_voucher_process.php" method="post">
                    <div class="form-group">
                        <label>Select Date</label>
                        <input class="form-control" id="datepicker2" type="text" name="date" />
                        <p class="help-block">Make sure you select the date.</p>
                    </div>
                                        
                    <div class="form-group">
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
                                        
                    <div class="form-group">
                        <label>Sales Voucher</label>
                        <input class="form-control" name="sales_voucher" type="text" placeholder="Enter Amount" />
                    </div>
                                        
                    <div class="form-group">
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
                                        
                    <div class="form-group">
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

    <!-- ADD NEW SALES ---------------------------------------------------------------------------------->
    
    <div class="col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading">Add New Sales</div>
            <div class="panel-body">
                <form role="form" action="includes/add_sales_process.php" method="post">
                                        
                    <div class="form-group">
                        <label>Full Name</label>
                        <input class="form-control" name="full_name" type="text" placeholder="" />
                    </div>
                                        
                    <div class="form-group">
                        <button class="form-control btn btn-primary">Add</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    
    <!-- RECENT ACTIVITIES ---------------------------------------------------------------------------------->

    <div class="col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading">Recent Activities</div>
            <div class="panel-body">
				<div class="table-responsive">
                    <table class="table table-striped  table-hover">
						<tbody>
							<?php
								$results = $db -> query("SELECT * FROM `log` WHERE `branch_id` = '$branch_id' ORDER BY `id` DESC LIMIT 5");
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