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
 	
	<!-- DISPLAY TODAY TOTAL SALES -------------------------------------------------------------------->
	
	<div class="row">

	<div class='col-lg-4'>
		
		<div class='well well-sm'>
			<p>Total Sales For Today <br /> <span class='small'><?php $date = date("Y-m-d"); echo custom_date_format($date)?><p>
				<h3><span class='small'>Tshs</span> <?php echo get_today_sales(); ?> <a class='btn' href='daily_sales_edit.php?date=<?php echo date("Y-m-d"); ?>'>Edit</a></h3>
		</div>
	</div>

    <?php include('total_binding.php');?>

	<!-- INSERT TOTAL SALE REPORT -------------------------------------------------------------------------->
    <div class='col-lg-4'>
        <div class="panel panel-default">
            <div class="panel-heading">Add Daily Sale</div>
            <div class="panel-body">
                <form role="form" action="includes/total_sale_process.php" method="post">
                
                    <div class="form-group col-lg-6">
                        <label>Select Date</label>
                        <input class="form-control" id="datepicker2" type="text" name="date" value="<?php echo date('Y-m-d'); ?>" />
                    </div>

                    <div class="form-group col-lg-6">
                        <label>Total Sale</label>
                        <input class="form-control" name="total_sale" type="number" placeholder="Amount" />
                    </div>

                    <div class="form-group">
                        <button class="form-control btn btn-primary">Add Daily Sale</button>
                    </div>
                </form>
            </div>
        </div>

	</div>
    </div><!--ROW-->
    <div class="row">


	<?php if ($branch_id==1){?>
    <!-- BINDING IF ITS UHURU BRANCH -------------------------------------------------------------------------->
		
		<div class="col-lg-4">
	        <div class="panel panel-default">
	            <div class="panel-heading">Binding</div>
	            <div class="panel-body">
	                <form role="form" action="includes/add_binding_process.php" method="post">

	                    <div class="form-group col-lg-6">
	                        <label>Select Date</label>
	                        <input class="form-control" id="datepicker" type="text" name="date" value="<?php echo date('Y-m-d'); ?>" />
	                    </div>

	                    <div class="form-group col-lg-6">
	                        <label>Binding Amount</label>
	                        <input class="form-control" name="amount" type="number" placeholder="Amount" />
	                    </div>

	                    <div class="form-group">
	                        <button class="form-control btn btn-primary">Add Binding Amount</button>
	                    </div>
	                </form>
	            </div>
	        </div>
		</div>
    <?php } ?>
	
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
								$results = $db -> query("SELECT * FROM `total_sale` WHERE `branch_id` = '$branch_id' ORDER BY `date` DESC LIMIT 5");
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
<?php include('recent.php');?>
    </div>
	
</div>

<?php include 'includes/footer.php';?>