
<div class="row">


        <div class='col-lg-3'>
            <div class='well well-sm'>
                <p>Total Sales For Today </p>
                <h3 ><span class='small'>Tshs</span> <?php echo make_me_bold($today_sales); ?><?php
                    if($this->session->userdata('auth_type')!=21 AND $this->session->userdata('auth_type')!=29){//29:stock controller?> <a class='btn' href='<?php echo base_url('admin/edit_daily_sales'); ?>'>Edit</a><?php } ?></h3>
            </div>
        </div>

    <div class="col-lg-3">
        <div class="well well-sm">
            <p>Cash In hand</p>
            <h3><span class='small'>Tshs</span>
                <?php
                $this->session->userdata('branch_id');
                $this->session->set_userdata('report_date',date('Y-m-d'));
                $cash_in_hand = $this->load->view('report/cash','',TRUE);
                $cash_in_hand = $this->session->userdata('cash_in_hand');
                echo make_me_bold($cash_in_hand);
                ?></h3>
        </div>
    </div>


        <?php $this->load->view('includes/total_binding');?>

        <!-- DISPLAY TODAY TOTAL EXPENSES --------------------------->

        <div class='col-lg-3'>
            <div class='well well-sm'>
                <p>Total Expenses For Today</p>
                <h3><span class='small'>Tshs</span> <?php echo make_me_bold($today_expenses); ?></h3>
            </div>
        </div>

        <!-- TOTAL MANUAL INVOICES ------------------------------->

        <div class="col-lg-3">
            <div class="well well-sm">
                <p>Total Manual Invoices</p>
                <h3><span class='small'>Tshs</span> <?php echo make_me_bold($manual_invoice);?></h3>
            </div>
        </div>



</div>

<?php
        $data['dont_show']=true;
        $data['title']='Chart for comparison on Total Sales and Audited '."<span class='text-muted '>(for the past {$this->session->userdata('num_of_sales')} days)</span>";

        $this->load->view('includes/title',$data);

?>
<div class="row">
    <div id="myfirstchart" style="height: 250px;"></div>

</div>




