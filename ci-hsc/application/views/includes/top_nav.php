<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?php echo  base_url();?>"><?php echo app_title()." ".app_version();?></a>
</div>
<!-- /.navbar-header -->

<ul class="nav navbar-top-links navbar-right">

    <li><p class="text-muted">
            <?php if($this->session->userdata('branch_name')) echo $this->session->userdata('branch_name');else "General" ;?></p></li>


    <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
<!--        <i class="fa fa-exchange fa-fw"></i>-->
        <i class="fa fa-refresh fa-spin"></i>
        <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-left dropdown-submenu">
        <?php
            $this->session->set_flashdata("whereami",$whereami= $this->router->fetch_class()."/".$this->router->fetch_method());
        foreach($branches as $branch){?>
        <li>
            <a href="<?php echo base_url('hsc/change_branch').'/'.$branch['id'];?>">
                <div>
                    <p class="reset-fahad"> <?php echo $branch['name'];echo ($branch['id']<=7)?" Branch":"";?></p>
                </div>
            </a>
        </li>
        <hr class="divider-ci"/>
        <?php } ?>
        <li>

            <a class="text-center" href="#">
                <strong>Stay at <?php if($this->session->userdata('branch_name')) echo $this->session->userdata('branch_name');else "General" ?></strong>

                <i class="fa fa-angle-double-right"></i>
            </a>
        </li>


    </ul>
    <!-- /.dropdown-messages -->
    </li>

<!-- /.dropdown -->

<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-alerts" id="noti">
       <?php

        if(empty($logs)){?>
            <span id="not_inner">You dont have any notifications for <?php echo make_me_bold($this->session->userdata("branch_name"));?></span>
            <div id="not_up">

                <img class="img-responsive" src="<?php echo base_url('assets/img/hsc-circle.png');?>" alt=""/>
            </div>
        <?php }

        foreach($logs as $log){?>
        <li>
            <a href="#">
                <div style="margin-bottom: 6px;">
                    <i class="fa fa-bell-o fa-fw"></i> <?php echo $log['log']?>
                    <span class="pull-right text-muted small" ><?php echo $log['date'];?></span>
                </div>
            </a>
        </li>
            <li class="divider"></li>
        <?php } ?>

        <li>
            <a class="text-center" href="<?php echo base_url('hsc/notifications/');?>">
                <?php if(!empty($logs)){?>
                <strong>See All Notifications for <?php echo $this->session->userdata("branch_name");?></strong>
                <?php }else {?>
                    <strong>Notifications for <?php echo $this->session->userdata("branch_name");?> are not available</strong>
                <?php }?>
                <i class="fa fa-angle-right"></i>
            </a>
        </li>
    </ul>
    <!-- /.dropdown-alerts -->
</li>
<!-- /.dropdown -->
<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-user">
        <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $this->session->userdata('full_name');?></a>
        </li>
        <li><a href="<?php echo base_url('welcome')?>"><i class="fa fa-gear fa-fw"></i> Settings</a>
        </li>
        <li><a href="#" onClick="javascript:window.print()"><i class="fa fa-print fa-fw"></i> Print</a>
        </li>
        <li class="divider"></li>
        <li><a href="<?php echo base_url(); ?>login/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
        </li>
    </ul>
    <!-- /.dropdown-user -->
</li>
<!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->

