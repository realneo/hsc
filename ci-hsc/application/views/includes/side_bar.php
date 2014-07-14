
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
            <li class="<?php echo ($active == "dashboard" ? "active" : "");?>"><a href="<?php echo base_url();?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>

            <!-- DAILY SALES ---------------------------------------------------------------------------------->

            <li class="<?php echo ($active == "daily_sales" ? "active" : "");?>"> <!-- The Active class -->

                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Daily Sales<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">

                    <!-- DAILY SALES -->
                    <li class="<?php echo ($active_tab == "daily_sales" ? "active" : "");?>">
                        <a  href="<?php echo base_url('hsc/daily_sales')?>"><span class="glyphicon glyphicon-import"></span> Daily Sales <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a href="<?php echo base_url('admin/add_daily_sales');?>"><span class="glyphicon glyphicon-plus"></span> Add Daily Sales</a></li>
                            <li><a href="<?php echo base_url('admin/edit_daily_sales');?>"><span class="glyphicon glyphicon-edit"></span> Edit Daily Sales</a></li>
                            <!--          <li><a href="view_sales.php"><span class="glyphicon glyphicon-th-list"></span> View Daily Sales</a></li> -->
                        </ul>
                    </li>

                    <!-- DAILY EXPENSES -->
                    <li class="<?php echo ($active_tab == "daily_expenses" ? "active" : "");?>">
                        <a href="<?php echo base_url('hsc/daily_expenses')?>"><span class="glyphicon glyphicon-export"></span> Daily Expenses <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li class="<?php echo ($active_tab == "daily_expenses" ? "active" : "");?>"><a href="<?php echo base_url('hsc/daily_expenses')?>"><span class="glyphicon glyphicon-plus"></span> Add Daily Expenses</a></li>

                        </ul>
                    </li>

                    <!-- MANUAL INVOICES -->
                    <li class="<?php echo ($active_tab == "manual_invoices" ? "active" : "");?>">
                        <a href="<?php echo base_url('hsc/daily_manual_invoices');?>"><span class="glyphicon glyphicon-pencil"></span> Manual Invoices <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li class="<?php echo ($active_tab == "manual_invoices" ? "active" : "");?>"><a href="<?php echo base_url('hsc/daily_manual_invoices');?>"><span class="glyphicon glyphicon-plus"></span> Add Manual Invoice</a></li>
                            <li class="<?php echo ($active_tab == "view_manual_invoices" ? "active" : "");?>"><a href="<?php echo base_url('hsc/view_manual_invoices');?>"><span class="glyphicon glyphicon-th-list"></span> Enter Manual Invoices</a></li>
                        </ul>
                    </li>

                    <!-- RETURNS -->
                    <li class="<?php echo ($active_tab == "returns" ? "active" : "");?>">
                        <a href="<?php echo base_url('hsc/daily_returns');?>"><span class="glyphicon glyphicon glyphicon-log-in"></span> Returns <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li class="<?php echo ($active_tab == "add_return" ? "active" : "");?>"><a href="<?php echo base_url('hsc/daily_returns');?>"><span class="glyphicon glyphicon-plus"></span> Add a Return </a></li>
                            <!--   <li><a href="view_returns.php"><span class="glyphicon glyphicon-th-list"></span> View Returns</a></li> -->
                        </ul>
                    </li>

                    <!-- SALES VOUCHER -->
                    <li  class="<?php echo ($active_tab == "sales_vouchers" ? "active" : "");?>">
                        <a href="<?php echo base_url('hsc/sales_vouchers');?>"><span class="glyphicon glyphicon-indent-left"></span> Sales Vouchers <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li class="<?php echo ($active_tab == "sales_vouchers" ? "active" : "");?>"><a href="<?php echo base_url('hsc/sales_vouchers');?>"><span class="glyphicon glyphicon-plus"></span> Add Sales Vouchers </a></li>
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
<div id="page-wrapper">
    <?php
    if(!$this->session->flashdata('alert_type') || !$this->session->flashdata('alert_msg')){
        // Display nothing
    }else{?>
        <!-- Notification -->
        <div class="row">

            <?php
            $alert_type = $this->session->flashdata('alert_type');
            $alert_msg = $this->session->flashdata('alert_msg');?>
            <div class='alert alert-<?php echo $alert_type;?> alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
                    &times;</button>
                <p><?php echo $alert_msg?></p></div>
        </div>
    <?php
    }
    ?>
