<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>HSC | <?php if($this->session->userdata('branch_name')) echo $this->session->userdata('branch_name')." Branch";else echo "Welcome" ?></title>

    <!-- Core CSS - Include with every page -->
    <link href="<?php echo base_url('assets');?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets');?>/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Blank -->
<!--    <link href="--><?php //echo base_url('assets');?><!--/css/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">-->
    <link href="<?php echo base_url('assets');?>/css/datepicker.css" rel="stylesheet">
    <link href="<?php echo base_url('assets');?>/css/bootstrap-editable.css" rel="stylesheet">


    <!-- Page-Level Plugin CSS - Morris -->
    <link href="<?php echo base_url('assets');?>/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">


    <!-- SB Admin CSS - Include with every page -->
    <link href="<?php echo base_url('assets');?>/css/sb-admin.css" rel="stylesheet">
    <link href="<?php echo base_url('assets');?>/css/kostom.css" rel="stylesheet">

    <link href="<?php echo base_url('assets');?>/img/hsc-circle.png" type="image/x-icon" rel="shortcut icon">

</head>

<body>

<div id="wrapper">


