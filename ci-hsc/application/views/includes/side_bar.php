
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
            <li><a href='#'><i class="fa fa-user fa-fw"></i> <?php echo $this->session->userdata('full_name'); ?></a></li>
            <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>

            <!-- DAILY SALES ---------------------------------------------------------------------------------->
<<<<<<< HEAD
            <li class="active">
=======
            <li> <!-- The Active class -->
>>>>>>> 5a68942af3d2bf761225edead45e27f7116813d6
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Daily Sales<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">

                    <!-- DAILY SALES -->
                    <li class="active">
                        <a  href="<?php echo base_url('hsc/daily_sales')?>"><span class="glyphicon glyphicon-import"></span> Daily Sales <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a href="<?php echo base_url('hsc/daily_sales')?>"><span class="glyphicon glyphicon-plus"></span> Add Daily Sales</a></li>
                            <!--          <li><a href="view_sales.php"><span class="glyphicon glyphicon-th-list"></span> View Daily Sales</a></li> -->
                        </ul>
                    </li>

                    <!-- DAILY EXPENSES -->
                    <li>
                        <a href="daily_expenses.php"><span class="glyphicon glyphicon-export"></span> Daily Expenses <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a href="daily_expenses.php"><span class="glyphicon glyphicon-plus"></span> Add Daily Expenses</a></li>
                            <!--      <li><a href="view_expenses.php"><span class="glyphicon glyphicon-th-list"></span> View Daily Expenses</a></li> -->
                        </ul>
                    </li>

                    <!-- MANUAL INVOICES -->
                    <li>
                        <a href="daily_manual_invoices.php"><span class="glyphicon glyphicon-pencil"></span> Manual Invoices <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a href="daily_manual_invoices.php"><span class="glyphicon glyphicon-plus"></span> Add Manual Invoice</a></li>
                            <li><a href="view_manual_invoices.php"><span class="glyphicon glyphicon-th-list"></span> Enter Manual Invoices</a></li>
                        </ul>
                    </li>

                    <!-- RETURNS -->
                    <li>
                        <a href="daily_returns.php"><span class="glyphicon glyphicon glyphicon-log-in"></span> Returns <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a href="daily_returns.php"><span class="glyphicon glyphicon-plus"></span> Add a Return </a></li>
                            <!--   <li><a href="view_returns.php"><span class="glyphicon glyphicon-th-list"></span> View Returns</a></li> -->
                        </ul>
                    </li>

                    <!-- SALES VOUCHER -->
                    <li>
                        <a href="sales_vouchers.php"><span class="glyphicon glyphicon-indent-left"></span> Sales Vouchers <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a href="sales_vouchers.php"><span class="glyphicon glyphicon-plus"></span> Add Sales Vouchers </a></li>
                            <!--   <li><a href="view_sales_vouchers.php"><span class="glyphicon glyphicon-th-list"></span> View Sales Vouchers</a></li> -->
                        </ul>
                    </li>

                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-users fa-fw"></i> Staff<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-th-list"></span> Staff Management <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a href="add_new_staff.php"><span class="glyphicon glyphicon-plus"></span> Add New Staff </a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="glyphicon glyphicon-list-alt fa-fw"></i> Reports <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-import"></span> Daily Reports <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a href="cash_collection_report.php?date=<?php echo date('Y-m-d'); ?>"><span class="glyphicon glyphicon-briefcase"></span> Cash Collection Report</a></li>
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
