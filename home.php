<?php session_start(); ?>
<?php require 'includes/logged_user_check.php'; ?>
<?php require 'includes/db_conn.php'; ?>

<?php require 'includes/global_functions.php'; ?>

<?php include 'includes/top_header.php'; ?>

<?php include 'includes/top_nav.php';?>        
<?php include 'includes/side_bar.php'; ?>

<?php include 'includes/header.php'; ?>

<div class="row">
    
    <!-- PAGE HEADING -------------------------------------------------->

    <div class="col-lg-12">
        <h4 class="page-header"><?php echo $branch_name; ?> Dashboard <span class='small'><?php $date = date("Y-m-d"); echo custom_date_format($date)?></h4>
    </div>

	<div class="col-lg-12">

		
		<!-- TODAY TOTAL SALE -------------------------------------------------------------------------------->
		
		<div class='col-lg-3'>
			<div class='well well-sm'>
				<p>Total Sales For Today <p>
				<h3><span class='small'>Tshs</span> <?php echo get_today_sales(); ?> <a class='btn' href='daily_sales_edit.php?date=<?php echo date("Y-m-d"); ?>'>Edit</a></h3>
			</div>
		</div>

<?php include('total_binding.php');?>
		
		<!-- DISPLAY TODAY TOTAL EXPENSES -------------------------------------------------------------------->

		<div class='col-lg-3'>
			<div class='well well-sm'>
				<p>Total Expenses For Today<p>
				<h3><span class='small'>Tshs</span> <?php echo get_today_expenses(); ?></h3>
			</div>
		</div>
		
		<!-- TOTAL MANUAL INVOICES -------------------------------------------------------------------------->

		<div class="col-lg-3">
	        <div class="well well-sm">
				<p>Total Manual Invoices<p>
				<h3><span class='small'>Tshs</span> <?php echo getTotalManualInvoices(0);?></h3>
	        </div>
		</div>
		
	</div>
    
</div>

<?php include 'includes/footer.php';?>