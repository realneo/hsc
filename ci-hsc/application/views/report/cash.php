<div class="row">
    <!-- SELECT REPORT DATE -------------------------------------------------------------------------------->
    <div class="col-lg-2 no-print">
        <form action='<?php echo base_url('reports/change_report_date');?>' method='post'>
            <div class="input-group">
                <input class="form-control" id="datepicker2" type="text" name="date" value="<?php echo date('Y-m-d'); ?>" />
		      	<span class="input-group-btn">
		        	<button class="btn btn-primary" type="submit">Go!</button>
		      	</span>
            </div>
        </form>
    </div>
</div>

<?php var_dump($this->session->userdata('report_date'));?>

<div class="row">
    <!-- DISPLAY CASH COLLECTION REPORT -------------------------------------------------------------------->

    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                HSC - <?php echo $this->session->userdata("branch_name"); ?> Branch
            </div>
            <div class="panel-body">
                <p><span class='small'>Report For :</span> <?php echo custom_date_format($this->session->userdata('report_date')); ?> </p>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <th>Details</th>
                        <th>Amount</th>
                        <th>Amount</th>
                        </thead>
                        <tbody>
                        <tr><th colspan="3">INCOME</th></tr>
                        <tr>
                            <td> Total Sale In System </td>
                            <td class='text-right'>
                                <?php
                                    $total_sale=$total_sales_according_to_date;
                                    echo $total_sale;
                                ?> </td>
                            <td></td>
                        </tr>
                        <?php if($this->session->userdata("branch_id") == 1){?>
                        <tr>
                            <td> Binding </td>
                            <td class='text-right'>
                                <?php
                                $binding_amount= $total_binding_according_to_date;
                                echo $binding_amount; ?> </td>
                            <td></td>
                        </tr>
                        <?php
                            $total_income = str_replace( ',', '', $total_sale ) + str_replace( ',', '', $binding_amount );
                        }else{
                            $total_income = $total_sale;
                        } ?>
                        <tr>
                            <td colspan="2"></td>
                            <td class='text-right'>
                                <?php

                                echo number_format($total_income);

                                ?>
                            </td>
                        </tr>
                        <tr><th colspan="3">PAYMENTS</th></tr>
                        <?php
                        var_dump($total_expenses_activity,$total_expenses_according_to_date);
                        foreach($total_expenses_activity as $activity){
                            $purpose=$activity['purpose'];
                            $amount=$activity['amount'];
                            ?>


									 <tr>
										<td> <?php echo $purpose; ?> </td>
										<td class='text-right'><?php echo number_format($amount); ?> </td>
										<td></td>
									</tr>

						<?php }
                        $totals_expenses = $total_expenses_according_to_date;


                        ?>

                        <tr>
                            <td colspan="2"></td>
                            <td class='text-right'><?php echo $totals_expenses; ?></td>
                        </tr>
                        <tr><th colspan="3">ADJUSTMENTS</th></tr>
                        <tr>
                            <td> Manual Not Entered </td>
                            <td class='text-right'>
                                <?php
                                    $total_entered_manual_invoices=$this->report->get_total_manual_invoice(0);
                                    echo $total_entered_manual_invoices;
                                 ?>
                            </td>
                            <td></td>
                        </tr>

                        <tr>
                            <td> Manual Entered </td>
                            <td class='text-right'>
                                <?php
                                    $total_not_manual_invoices=$this->report->get_total_manual_invoice(1);
                                    echo $total_not_manual_invoices;
                                ?>
                            </td>
                            <td></td>
                        </tr>
                        <?php



                        ?>
                        <tr>
                            <td> Returns </td>
                            <td class='text-right'>
                                <?php
                                    $total_returns = $total_returns_according_to_date;
                                    echo $total_returns;
                                ?>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td class='text-right'>
                                <?php

                                $total_adjustments =
                                    str_replace( ',', '', $total_entered_manual_invoices ) +
                                        str_replace( ',', '', $total_not_manual_invoices) +
                                        str_replace( ',', '', $total_returns);

                                echo number_format($total_adjustments);
                                die();
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td> <h4>CASH IN HAND</h4> </td>
                            <td></td>
                            <td class='text-right'>
                                <?php
                                // CASH IN HAND
                                // Formula: Income - Payments - Adjustments

                                $total_sale = str_replace( ',', '', $total_sale);
                                $total_expenses = str_replace( ',', '', $total_expenses);
                                $total_adjustments = str_replace( ',', '', $total_adjustments);

                                $cash_in_hand = $total_sale + $binding_amount - $total_expenses - $total_adjustments;

                                $cash_in_hand = number_format($cash_in_hand);
                                echo "<h4> $cash_in_hand </h4>";
                                ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
