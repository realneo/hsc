
<div class="row">
    <!-- SELECT REPORT DATE -------------------------------------------------------------------------------->
    <div class="row no-print">
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
                HSC - All Branches <span class="no-print pull-right text-muted small hidden-sm hidden-xs">For Printing choose <b><i class="fa fa-book"></i> view</b> at total sales</span>
            </div>
            <div class="panel-body">
                <p><span class='small'>Report For :</span> <?php echo custom_date_format($this->session->userdata('report_date')); ?> </p>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <th>Branch</th>
                        <th>Total Sales <span class="text-muted small x-small">(audited)</span><span class="pull-right no-print"><a data-toggle="tooltip" data-placement="bottom" title="Edit Audited Sale" rel="info" href="<?php echo base_url().'reports/audited_edit'?>"><i class="fa fa-edit"></i></a> -  <a
                                    data-toggle="tooltip" data-placement="top" title="View Audited Sale" rel="info" href="<?php echo base_url().'reports/audited_view'?>"><span><i class="fa fa-book"></i></span></a></span></th>
                        <th>Cash In Hand</th>
                        <th>Payments</th>
                        <th>Adjustments</th>
                        <th>Variance</th>
                        </thead>
                        <tbody>
<!--                        <tr><th colspan="3">INCOME</th></tr>-->

<?php
$temp_id=$this->session->userdata('branch_id');
foreach($branches as $key=>$branch){
    ?>

    <tr>
                        <td><?php echo $branch['name']?></td>
                        <td class="col-lg-3">

                            <?php
                            $this->session->set_userdata('branch_id',$branch['id']);
                            $audited_sales=$this->report->get_audited_total_sale();
                            if($this->report->get_audited_total_sale()){
                                $audited_sales=$audited_sales[0];$audited_sales['total_sale']=number_format($audited_sales['total_sale']);
//                                $audited_sales=$audited_sales[0];$total_sales_per_branch=number_format($audited_sales['total_sale']);
                            }else{
                                $audited_sales['total_sale'] = 0;
                                $audited_sales['user_id'] = '';
                                $audited_sales['branch_id'] = '';

                            }


                            ?>
<!--                            <a href="#" data-pk="1" data-url="--><?php //echo base_url('reports/add_audited_amount');?><!--" rel='edit_amount' id="audited_total_sale" data-type="text" data-placement="right" data-pk="--><?php //echo $audited_sales['id']?><!--" data-title="Enter Amount" class="editable editable-click" data-original-title="" title="">--><?php //echo $total_sales_per_branch;?><!--</a>-->
                            <?php if($this->session->userdata('edit_audited'))
                            {?>
                                <form class="form-horizontal no-print" action='<?php echo base_url()."reports/edit_audited_amount";?>' method='post'>
                                <div class='input-group'>
                                    <input class='form-control' type='text' name='amount' value='<?php echo ($audited_sales['total_sale']!=0)?$audited_sales['total_sale']:'';?>' />
                                    <input type='hidden' name='id' value='<?php echo $audited_sales['id'];?>' />
                                    <input type='hidden' name='branch_id' value='<?php echo $branch['id'];?>' />
											      		<span class='input-group-btn'>
											        		<button class='btn btn-primary' type='submit'>Enter</button>
											      		</span>
                                </div>
                                </form>
                                <span class="text-muted x-small" style="margin: 0px;padding: 0px;line-height: 0px;"><?php
                                    if(!@$audited_sales['id'])
                                    {
                                        echo '*Before entering, Try adding <b>Daily Sale</b> First!';
                                    }else{
                                        echo '*You can include commas & dots,This part only';
                                    }
                                    ?></span>

                            <?php


                            }else{
                             echo $audited_sales['total_sale'];
                            } ?>
                        </td>
<td>
    <script type="text/javascript">
//        console.log('BAB');
<!--        console.log('--><?php //echo $_POST['id'];?><!--');-->

    </script>
    <?php
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
                            $this->load->view('report/cash','',TRUE);
                            $cash_in_hand = $this->session->userdata('cash_in_hand');
                            echo $total_adjustments_per_branch=$this->session->userdata('total_adjustments');?></td>
                        <td>
                            <?php
                            if($this->report->get_audited_total_sale()){

                                $audited_sales['total_sale']=$this->report->get_audited_total_sale()[0]['total_sale'];
                            }else{
                                $audited_sales['total_sale'] = 0;
                            }

                            $variance = number_format(
                                floatval(str_replace( ',', '', $audited_sales['total_sale'])) -
                                    (
                                    floatval(str_replace( ',', '',$cash_in_hand )) +
                                    floatval(str_replace( ',', '', $totals_expenses)) +
                                    floatval(str_replace( ',', '',$total_adjustments_per_branch))
                                    )
                            );
                            echo $variance;
                            /*var_dump(
                                floatval(str_replace( ',', '',$audited_sales['total_sale']))-(floatval(str_replace( ',', '',$cash_in_hand))+
                                floatval(str_replace( ',', '',$totals_expenses))+
                                floatval(str_replace( ',', '',$total_adjustments_per_branch)))
                                );*/
                            ?>
                            <form class="pull-right" id="produce_variance-<?php echo $key;?>" action="<?php echo base_url('reports/produce_variance');?>" method="post">
                                <input type="hidden" name="variance" value="<?php echo $variance;?>"/>
                                <input type="hidden" name="report_date" value="<?php echo $this->session->userdata('report_date');?>"/>
                                <input type="hidden" name="user_id" value="<?php echo $audited_sales['user_id'];?>"/>
                                <input type="hidden" name="branch_id" value="<?php echo $audited_sales['branch_id'];?>"/>
                                <a data-toggle="tooltip" data-placement="right" title="Produce variance" rel="info" href="javascript:void(0);" onclick="document.getElementById('produce_variance-<?php echo $key;?>').submit()"><span class="fa fa-mail-forward"></span></a>
                            </form>
                        </td>
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


