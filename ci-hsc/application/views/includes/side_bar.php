
<div class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
<!--            <li class="sidebar-search">-->
<!--                <div class="input-group custom-search-form">-->
<!--                    <input type="text" class="form-control" placeholder="Search...">-->
<!--                    <span class="input-group-btn">-->
<!--                    	<button class="btn btn-default" type="button">-->
<!--                            <i class="fa fa-search"></i>-->
<!--                        </button>-->
<!--                   	</span>-->
<!--                </div>-->
<!--                <!-- /input-group -->
<!--            </li>-->

            <li class="hidden-xs">
<!--                display picture-->
                <?php
                $online = check_if_online();
                //foul!
                $staff=$this->staffs->get_profile($this->session->userdata('user_id'))[0];
                $current_user = $this->staffs->get_user($staff['user_id'])[0];



                ?>
                <div class="user-image " style="padding: 8px;">
                    <img style="border:5px solid rgba(0, 0, 0, 0.17);" src="<?php
                    switch($staff['gender']){
                        case 'male':
                            //echo "http://www.gravatar.com/avatar/".md5( strtolower( trim(  $staff['email'] ) ) )."?s=200&d=mm&";//d=".base_url('assets/img/default-user-icon-profile.png');
                            if($staff['img_url'] AND $online==true){
                                echo $staff['img_url'];
                                //echo "http://www.gravatar.com/avatar/".md5( strtolower( trim(  $staff['email'] ) ) )."?s=200";
                            }else{
                                echo base_url('assets/img/default-user-icon-profile.png');
                            }
                            break;
                        case 'female':

                            if($staff['img_url'] AND $online==true){
                                echo $staff['img_url'];
                                //echo "http://www.gravatar.com/avatar/".md5( strtolower( trim(  $staff['email'] ) ) )."?s=200";
                            }else{
                                echo base_url('assets/img/default-user-icon-profile-pink.png');
                            }

                            // echo "http://www.gravatar.com/avatar/".md5( strtolower( trim(  $staff['email'] ) ) )."?s=200&d=retro";//;&d=".base_url('assets/img/default-user-icon-profile-pink.png');
                            break;

                        default : echo base_url('assets/img/default-user-icon-profile.png'); break;
                    }?>
                                " alt="" class="thumb1 thumb2 img-circle img-responsive">
                </div>
            </li>



            <li><a href='#'><i class="fa fa-user fa-fw"></i> <?php echo $this->session->userdata('full_name'); ?></a></li>
            <li class="<?php echo ($active == "dashboard" ? "active" : "");?>"><a href="<?php echo base_url();?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>

            <!-- DAILY SALES ---------------------------------------------------------------------------------->

            <?php if($this->session->userdata('auth_type')!=21 AND $this->session->userdata('auth_type')!= 29 and $this->session->userdata('auth_type')!= 23){//29:stock controller 21:Accountant?>
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
                            <li class="<?php echo ($active_tab == "manual_invoices" ? "active" : "");?>"><a href="<?php echo base_url('admin/view_manual_redirect');?>"><span class="glyphicon glyphicon-plus"></span> Add Manual Invoice</a></li>
                            <li class="<?php echo ($active_tab == "view_manual_invoices" ? "active" : "");?>"><a href="<?php echo base_url('admin/enter_manual_redirect');?>"><span class="glyphicon glyphicon-th-list"></span> Enter Manual Invoices</a></li>
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
            <?php }?>

            <?php

            if($this->session->userdata('auth_type')!=29 AND $this->session->userdata('auth_type')!=21){//29:Stock_controller 21:Accountant
                if($this->session->userdata('auth_type')<=30){//23 - Operations){?>
            <li class="<?php echo ($active == "staff" ? "active" : "");?>">
                <a href="<?php echo base_url('staff');?>"><i class="fa fa-users fa-fw"></i> Staff<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?php echo ($active_tab == "add_staff" ? "active" : "");?>">
                        <a href="<?php echo base_url('staff');?>"><span class="glyphicon glyphicon-th-list"></span> Staff Management <span class="fa arrow"></span></a>

                        <ul class="nav nav-third-level">
                            <?php if($this->session->userdata('auth_type')==23 or $this->session->userdata('auth_type')==21 or $this->session->userdata('auth_type')==30 or $this->session->userdata('auth_type')<=20){//23 - Operations 30: -manager >20 management){?>
                                <li><a href="<?php echo base_url('staff/manage_staff');?>"><span class="fa fa-cogs"></span> Change Staff</a></li>
                            <?php } ?>
                            <li ><a href="<?php echo base_url('staff');?>"><span class="glyphicon glyphicon-plus"></span> Add New Staff </a></li>

                        </ul>
                    </li>
                </ul>
            </li>
            <?php }} ?>

            <li class="<?php echo ($active == "report" ? "active" : "");?>">
                <a href="#"><i class="glyphicon glyphicon-list-alt fa-fw"></i> Reports <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">

                    <li class="<?php echo ($active_tab == "cash" ? "active" : "");?>">
                        <a href="#"><span class=" fa fa-archive"></span> Daily Reports <span class="fa arrow"></span></a>

                        <ul class="nav nav-third-level">
                            <li><a href="<?php echo base_url('reports/cash');?>"><span class="fa fa-suitcase"></span> Cash Collection Report</a></li>
                        </ul>

                        <?php
                        if($this->session->userdata('auth_type')!=30){//30:Manager
                        if($this->session->userdata('auth_type')!=40){//40:Cashier

                            if($this->session->userdata('auth_type')!=29){//29:Stock_controller?>
                        <ul class="nav nav-third-level">
                                <li><a href="<?php echo base_url('reports/sales_report');?>"><span class="fa fa-suitcase"></span> Sales Report</a></li>
                        </ul>
                            <?php }?>
                        <?php
                        if($this->session->userdata('auth_type')!=21 and $this->session->userdata('auth_type')!= 23){//21:Accountant 23:Operations?>
                        <ul class="nav nav-third-level">
                            <li><a href="<?php echo base_url('reports/returns_report');?>"><span class="fa fa-mail-reply"></span> Returns Report</a></li>
                        </ul>
                        <?php  } // Accountant
                            }//cashier
                        }//manager
                            if($this->session->userdata('auth_type')!=29){//29:Stock_controller?>
                        <ul class="nav nav-third-level">
                            <li><a href="<?php echo base_url('reports/cheque_report');?>"><span class="fa fa-suitcase"></span> Cheque Report</a></li>
                        </ul>
                        <?php }  ?>


                    </li>

                    <li class = "<?php echo ($active_tab == "other_report" ? "active" : "");?>">
                        <a href="#"><span class="glyphicon glyphicon-import"></span> Other Reports <span class="fa arrow"></span></a>

                            <ul class="nav nav-third-level">
                            <li><a href="<?php echo base_url('reports/payment');?>"><span class="fa fa-truck"></span> Payment Report</a></li>

                            </ul>
                        <?php  if($this->session->userdata('auth_type')!=29){//29:Stock_controller?>
                        <?php  if($this->session->userdata('auth_type')!=23){//23:Operations?>
                        <ul class="nav nav-third-level">
                            <li><a href="<?php echo base_url('hsc/daily_manual_invoices');?>"><span class="fa fa-paperclip "></span> Manual Invoices Report</a></li>

                        </ul>

                        <ul class="nav nav-third-level">
                            <li><a href="<?php echo base_url('reports/binding');?>"><span class="fa fa-suitcase"></span> Binding Report</a></li>
                        </ul>
                            <?php }//operations ?>
                        <ul class="nav nav-third-level">

                            <li><a href="<?php echo base_url('reports/user_report');?>"><span class="fa fa-users"></span> Users Report</a></li>
                        </ul>
                        <?php } ?>
                    </li>



                </ul>
            </li>
            <li class="last-logo"><img src="<?php echo base_url('assets/img/hsc-circle.png');?>" class="img-responsive" alt=""/></li>
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
