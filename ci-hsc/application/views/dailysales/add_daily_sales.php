<div class="row">
    <?php $this->load->view('dailysales/recent_total_sale');?>
    <!-- INSERT TOTAL SALE REPORT -------------------------------------------------------------------------->
    <div class='col-lg-4'>
        <div class="panel panel-default">
            <div class="panel-heading">Add Daily Sale</div>
            <div class="panel-body">
                <form role="form" action="<?php echo base_url('admin/daily_sales_add')?>" method="post">

                    <div class="form-group col-lg-6">
                        <label>Select Date</label>
                        <input class="form-control" id="datepicker2" type="text" name="date" value="<?php echo date('Y-m-d'); ?>" />
                    </div>

                    <div class="form-group col-lg-6">
                        <label>Total Sale</label>
                        <input class="form-control money" name="total_sale" type="text" placeholder="<?php echo $today_sales;?>" />
                    </div>

                    <div class="form-group">
                        <button class="form-control btn btn-primary">Add Daily Sale</button>
                    </div>
                </form>
            </div>
            <?php if(isset($today_sales) && $today_sales > 0){?>
            <div class="panel-footer">
                You can only add 1 total sale per day , Currently we are having <?php echo make_me_bold(" Tsh ".$today_sales);?> for <?php echo $this->session->userdata('branch_name');?> today
            </div>
            <?php }?>
        </div>

    </div>
    <?php if($this->session->userdata("branch_id") == 1){?>

    <!-- INSERT TOTAL Binding REPORT -------------------------------------------------------------------------->
    <div class='col-lg-4'>
        <div class="panel panel-default">
            <div class="panel-heading">Add Daily Binding</div>
            <div class="panel-body">
                <form role="form" action="<?php echo base_url('admin/daily_binding_add')?>" method="post">

                    <div class="form-group col-lg-6">
                        <label>Select Date</label>
                        <input class="form-control" id="datepicker" type="text" name="date" value="<?php echo date('Y-m-d'); ?>" />
                    </div>

                    <div class="form-group col-lg-6">
                        <label>Total Binding</label>
                        <input class="form-control" name="total_sale money" type="text" placeholder="<?php echo $today_binding;?>" />
                    </div>

                    <div class="form-group">
                        <button class="form-control btn btn-primary">Add Binding</button>
                    </div>
                </form>
            </div>
            <?php if(isset($today_binding) && $today_binding > 0){?>
            <div class="panel-footer">
                You can only add 1 total binding per day , Currently we are having <?php echo make_me_bold(" Tsh ".$today_binding);?> for <?php echo $this->session->userdata('branch_name');?> today
            </div>
            <?php }?>
        </div>

    </div>
    <?php } ?>


</div>
