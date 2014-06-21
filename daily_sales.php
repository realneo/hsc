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
 	
	<!-- INSERT TOTAL SALE REPORT -------------------------------------------------------------------------->
    
    <div class="col-lg-9">
        <div class="panel panel-default">
            <div class="panel-heading">Add Daily Sale</div>
            <div class="panel-body">
                <form role="form" action="includes/total_sale_process.php" method="post">
                
                    <div class="form-group col-lg-3">
                        <label>Select Date</label>
                        <input class="form-control" id="datepicker" type="text" name="date" />
                    </div>

                    <div class="form-group col-lg-3">
                        <label>Total Sale</label>
                        <input class="form-control" name="total_sale" type="number" placeholder="Enter Amount"/>
                    </div>

                    <div class="form-group col-lg-3">
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

                    <div class="form-group col-lg-3">
                        <label>Cashier Password</label>
                        <input class="form-control" name="cashier_password" type="password" />
                    </div>

                    <div class="form-group">
                        <button class="form-control btn btn-primary">Add Daily Sale</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

	<!-- VIEW RECENT DAILY SALES -------------------------------------------------------------------------->
	<div class="col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading">Recent Total Sale</div>
            <div class="panel-body">
				<div class="table-responsive">
                    <table class="table table-striped  table-hover">
						<thead>
							<th>Date</th>
							<th>Total Sale</th>
						</thead>
						<tbody>
							<?php
								$branch_id = $_SESSION['branch_id'];
								$results = $db -> query("SELECT * FROM `total_sale` WHERE `branch_id` = '$branch_id' ORDER BY `id` DESC LIMIT 5");
								while($row = $results->fetch_assoc()){
                        			$date = custom_date_format($row['date']);
									$total_sale = number_format($row['total_sale']);
									
                        			echo "<tr>
											<td>{$date}</td>
											<td class='text-right'>{$total_sale}</td>
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