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

    <!-- SB Admin CSS - Include with every page -->
    <link href="<?php echo base_url('assets');?>/css/sb-admin.css" rel="stylesheet">
    <link href="<?php echo base_url('assets');?>/css/kostom.css" rel="stylesheet">

</head>

<body>

<div id="wrapper">
    <?php
    if(!$this->session->flashdata('alert_type') || !$this->session->flashdata('alert_msg')){
        // Display nothing
    }else{?>
        <!-- Notification -->
        <div class="row">

<?php
        $alert_type = $this->session->flashdata('alert_type');
        $alert_msg = $this->session->flashdata('alert_msg');?>
       <div class='alert alert-{$alert_type} alert-dismissible'>
         <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>
             &times;</button>
       <p class="lead"><?php echo $alert_msg?></p></div>
       </div>
            <?php
            }
            ?>

