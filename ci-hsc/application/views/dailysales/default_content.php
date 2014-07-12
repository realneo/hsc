<div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header"><?php echo (isset($title) && $title)? $title:'Daily Sales';?>  <span class='small'><?php $date = date("Y-m-d"); echo custom_date_format($date)?></span></h4>

                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- /.row -->
        <div class="row">


                <div class='col-lg-3'>
                    <div class='well well-sm'>
                        <p>Total Sales For Today <p>
                        <h3 ><span class='small'>Tshs</span> <?php echo make_me_bold($today_sales); ?>
                            <a class='btn' href='<?php echo base_url('admin/edit_daily_sales'); ?>'>Edit</a></h3>
                    </div>
                </div>


                <?php $this->load->view('includes/total_binding');?>

                <!-- DISPLAY TODAY TOTAL EXPENSES --------------------------->

                <div class='col-lg-3'>
                    <div class='well well-sm'>
                        <p>Total Expenses For Today<p>
                        <h3><span class='small'>Tshs</span> <?php echo make_me_bold($today_expenses); ?></h3>
                    </div>
                </div>

                <!-- TOTAL MANUAL INVOICES ------------------------------->

                <div class="col-lg-3">
                    <div class="well well-sm">
                        <p>Total Manual Invoices<p>
                        <h3><span class='small'>Tshs</span> <?php echo make_me_bold($manual_invoice);?></h3>
                    </div>
                </div>
             </div>
        </div><!--            content-->
