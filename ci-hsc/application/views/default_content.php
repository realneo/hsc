
<div class="row">


        <div class='col-lg-3'>
            <div class='well well-sm'>
                <p>Total Sales For Today <p>
                <h3 ><span class='small'>Tshs</span> <?php echo make_me_bold($today_sales); ?><?php if($this->session->userdata('auth_type')!=21){?> <a class='btn' href='<?php echo base_url('admin/edit_daily_sales'); ?>'>Edit</a><?php } ?></h3>
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

<?php
        $data['dont_show']=true;
        $data['title']="Chart for comparison on Total Sales and Audited";
        $this->load->view('includes/title',$data);

?>
<div class="row">
    <div id="myfirstchart" style="height: 250px;"></div>

</div>




