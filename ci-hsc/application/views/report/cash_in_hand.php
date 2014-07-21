
<div class="row">
    <!-- SELECT REPORT DATE -------------------------------------------------------------------------------->
    <div class="row">
        <div class="col-lg-12"><div class="col-lg-3 no-print" style="margin-bottom: 10px;">
        <form action='<?php echo base_url('reports/change_sales_date');?>' method='post'>
            <div class="input-group">
                <input class="form-control" id="datepicker2" type="text" name="date" value="<?php echo $this->session->userdata('report_date')?$this->session->userdata('report_date'):date('Y-m-d'); ?>" />
		      	<span class="input-group-btn">
		        	<button class="btn btn-primary" type="submit">Go!</button>
		      	</span>
            </div>
        </form>
    </div>
    </div>
    </div>
    <!-- DISPLAY CASH COLLECTION REPORT -------------------------------------------------------------------->

    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                HSC - All Branches
            </div>
            <div class="panel-body">
                <p><span class='small'>Report For :</span> <?php echo custom_date_format($this->session->userdata('report_date')); ?> </p>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <th>Branch</th>
                        <th>Total sales</th>
                        <th>Cash In Hand</th>
                        <th>Payments</th>
                        <th>Adjustments</th>
                        <th>Variance</th>
                        </thead>
                        <tbody>
<!--                        <tr><th colspan="3">INCOME</th></tr>-->

<?php
$temp_id=$this->session->userdata('branch_id');
foreach($branches as $branch){
    ?>

    <tr>
                        <td><?php echo $branch['name']?></td>
                        <td><?php
                            $this->session->set_userdata('branch_id',$branch['id']);
                            echo $total_sales_per_branch=$this->report->get_total_sales();?></td>
<td><?php
    $this->session->set_userdata('branch_id',$branch['id']);
    $cash_in_hand = $this->load->view('report/cash','',TRUE);
    echo $cash_in_hand = $this->session->userdata('cash_in_hand');

    ?></td>
        <td>
            <ul class="list-group" style="margin-bottom: -9px;padding: 3px;margin-top: -7px;">
                <li class="list-group-item active list-group-item-heading text-right">
                    <?php $totals_expenses = $this->report->get_total_expenses();
                    echo "Tsh ".make_me_bold($totals_expenses);?></li>

    <?php
    //var_dump($total_expenses_activity,$total_expenses_according_to_date);
    foreach($this->report->get_expense_activity() as $activity){
        $purpose=$activity['purpose'];
        $amount=$activity['amount'];
        ?>



            <li class="list-group-item text-right"> <?php echo $purpose; ?> <span class=''><?php echo "Tsh ".make_me_bold(number_format($amount)); ?> </span></li>



    <?php }

    //echo number_format($totals_expenses);
    //var_dump($totals_expenses);
    ?>
            </ul></td>
                        <td><?php
                            $cash_in_hand = $this->load->view('report/cash','',TRUE);
                            echo $total_adjustments_per_branch=$this->session->userdata('total_adjustments');?></td>
                        <td><?php
                            $variance = number_format(floatval(str_replace( ',', '', $this->session->userdata('cash_in_hand'))) - floatval(str_replace( ',', '', $this->report->get_total_sales())));
                            echo $variance;

                            ?></td>
    </tr>
<!--    <tr><th colspan="8">INCOME</th></tr>-->
                        <?php

/*
 * NOW CALCULATE TOTALS of individuals
 */
    $total_adjustments_per_branch;
    $variance;
    $totals_expenses;
    $cash_in_hand;
    $total_sales_per_branch;

} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php //return it back to normal
$this->session->set_userdata('branch_id',$temp_id);
?>
