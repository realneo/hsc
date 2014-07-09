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
	
	<div class='col-lg-4'>
		
		<div class='well well-sm'>
			<p>Total Sales For Today <br /> <span class='small'><?php $date = date("Y-m-d"); echo custom_date_format($date)?><p>
			<form action="includes/daily_sales_edit.php" method='get'>
				<div class="input-group">
					<span class="input-group-addon">Tshs</span>
					<input class='form-control' type='number' name='total_sale' placeholder="<?php echo get_today_sales(); ?>"/>
					<span class="input-group-btn"><button class="btn btn-primary" type="submit">Save</button></span>
				</div>
				<input type='hidden' name='date' value="<?php echo date('Y-m-d'); ?>" />
			</form>
		</div>

	</div>
	<!-- VIEW RECENT DAILY SALES -------------------------------------------------------------------------->
	<div class="col-lg-4">
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
								$results = $db -> query("SELECT * FROM total_sale WHERE branch_id = '$branch_id' ORDER BY 'date' DESC LIMIT 5");
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

<?php include 'includes/footer.php';?>