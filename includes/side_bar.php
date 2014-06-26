<div class="navbar-default navbar-static-side" role="navigation">
	<div class="sidebar-collapse">
    	<ul class="nav" id="side-menu">
        	<li class="sidebar-search">
            	<div class="input-group custom-search-form">
                	<input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                    	<button class="btn btn-default" type="button">
                        	<i class="fa fa-search"></i>
                        </button>
                   	</span>
				</div>
                <!-- /input-group -->
          	</li>
			<li><a href='#'><?php echo $fullname; ?></a></li>
         	<li><a href="home.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>
			<li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Daily Sales<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
					<li>
                        <a href="daily_sales.php"><span class="glyphicon glyphicon-import"></span> Daily Sales <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a href="daily_sales.php"><span class="glyphicon glyphicon-plus"></span> Add Daily Sales</a></li>
                            <li><a href="view_sales.php"><span class="glyphicon glyphicon-th-list"></span> View Daily Sales</a></li>
                        </ul>
                    </li>
					<li>
                        <a href="daily_expenses.php"><span class="glyphicon glyphicon-export"></span> Daily Expenses <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a href="daily_expenses.php"><span class="glyphicon glyphicon-plus"></span> Add Daily Expenses</a></li>
                            <li><a href="view_expenses.php"><span class="glyphicon glyphicon-th-list"></span> View Daily Expenses</a></li>
                        </ul>
                    </li>
					<li>
                        <a href="daily_manual_invoices.php"><span class="glyphicon glyphicon-pencil"></span> Manual Invoices <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a href="daily_manual_invoices.php"><span class="glyphicon glyphicon-plus"></span> Add Manual Invoice</a></li>
                            <li><a href="view_manual_invoices.php"><span class="glyphicon glyphicon-th-list"></span> View Manual Invoices</a></li>
                        </ul>
                    </li>
					<li>
                        <a href="sales_vouchers.php"><span class="glyphicon glyphicon-indent-left"></span> Sales Vouchers <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a href="sales_vouchers.php"><span class="glyphicon glyphicon-plus"></span> Add Sales Vouchers </a></li>
                            <li><a href="view_sales_vouchers.php"><span class="glyphicon glyphicon-th-list"></span> View Sales Vouchers</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
		</ul>
		<!-- /#side-menu -->
	</div>
	<!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>
