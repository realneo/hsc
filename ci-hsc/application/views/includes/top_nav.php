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
<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-exchange fa-fw"></i>  <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-left dropdown-submenu">
        <?php foreach($branches as $branch){?>
        <li>
            <a href="<?php echo base_url('hsc/change_branch').'/'.$branch['id'];?>">
                <div>
                    <strong><?php echo $branch['name']?></strong>
                </div>
            </a>
        </li>
        <li class="divider"></li>
        <?php } ?>
        <li>
            <a class="text-center" href="#">
                <strong>Stay at <?php if($this->session->userdata('branch_name')) echo $this->session->userdata('branch_name');else "General" ?></strong>
                <i class="fa fa-angle-right"></i>
            </a>
        </li>
</li>

    </ul>
    <!-- /.dropdown-messages -->

<!-- /.dropdown -->

<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-alerts" id="noti">
       <?php

        if(empty($logs)){echo "bila";}


        ;foreach($logs as $log){?>
        <li>
            <a href="#">
                <div>
                    <i class="fa fa-bell-o fa-fw"></i> <?php echo $log['log']?>
                    <span class="pull-right text-muted small"><?php echo $log['date'];?></span>
                </div>
            </a>
        </li>
            <li class="divider"></li>
        <?php } ?>

        <li>
            <a class="text-center" href="#">
                <strong>See All Alerts for <?php echo $this->session->userdata("branch_name");?></strong>
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
        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
        </li>
        <li class="divider"></li>
        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
        </li>
    </ul>
    <!-- /.dropdown-user -->
</li>
<!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->
