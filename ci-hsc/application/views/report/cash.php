
<div class="row">
    <!-- SELECT REPORT DATE -------------------------------------------------------------------------------->
    <div class="col-lg-3 no-print" style="margin-bottom: 10px;">
        <form action='<?php echo base_url('reports/change_report_date');?>' method='post'>
            <div class="input-group">
                <input class="form-control" id="datepicker2" type="text" name="date" value="<?php echo $this->session->userdata('report_date')?$this->session->userdata('report_date'):date('Y-m-d'); ?>" />
		      	<span class="input-group-btn">
		        	<button class="btn btn-primary" type="submit">Go!</button>
		      	</span>
            </div>
        </form>
    </div>
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
                                    $total_sale=$this->report->get_total_sales();
                                    echo $total_sale;
                                ?> </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td> Manual Not Entered </td>
                            <td class='text-right'>
                                <?php
                                if($this->report->get_manual_data()){


                                    $all_manual_invoices = $this->report->get_manual_data()[0];
                                    $total_not_manual_invoices = 0;
                                    //                                var_dump($all_manual_invoices);
                                    if($all_manual_invoices['entered']==1 AND $all_manual_invoices['balance']==0){
                                        $total_not_manual_invoices = $all_manual_invoices['amount'];

                                    }
                                    elseif($all_manual_invoices['entered']==0){
                                        $total_not_manual_invoices = $all_manual_invoices['amount'];
                                    }
                                    elseif($all_manual_invoices['entered']==2 AND $all_manual_invoices['balance']<$all_manual_invoices['amount']){
                                        $total_not_manual_invoices = $all_manual_invoices['amount'];
                                    }
                                }else{
                                    $total_not_manual_invoices=0;
                                }
                                echo number_format($total_not_manual_invoices);
                                $this->session->set_userdata('not_entered_for_sales',$total_not_manual_invoices);
                                /*
                                $total_not_manual_invoices=$this->report->get_total_manual_invoice(0);
                                if($total_not_manual_invoices==0){
                                    $total_not_manual_invoices=$this->report->get_total_manual_invoice(2);//STARTED ENTERING

                                }
                                echo $total_not_manual_invoices;
*/
                                //var_dump($total_not_manual_invoices);
                                ?>
                            </td>
                            <td></td>
                        </tr>
                        <?php if($this->session->userdata("branch_id") == 1 && $this->report->get_total_binding()>0){?>
                        <tr>
                            <td> Binding </td>
                            <td class='text-right'>
                                <?php
                                $binding_amount= $this->report->get_total_binding();
                                echo $binding_amount; ?> </td>
                            <td></td>
                        </tr>
                        <?php

                            $total_income = str_replace( ',', '', $total_sale ) + str_replace( ',', '', $binding_amount ) + str_replace( ',', '', $total_not_manual_invoices );
                        }else{
                            $binding_amount = 0 ;
                            $total_income = str_replace( ',', '', $total_sale ) + str_replace( ',', '', $total_not_manual_invoices );
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
                        //var_dump($total_expenses_activity,$total_expenses_according_to_date);
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
                        $totals_expenses = $this->report->get_total_expenses();


                        ?>

                        <tr>
                            <td colspan="2"></td>
                            <td class='text-right'><?php echo $totals_expenses; ?></td>
                        </tr>
                        <tr><th colspan="3">ADJUSTMENTS</th></tr>
                        <tr>
                            <td> Returns </td>
                            <td class='text-right'>
                                <?php
                                $total_returns = $this->report->get_total_returns();
                                echo $total_returns;
                                ?>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td> Manual Entered </td>
                            <td class='text-right'>
                                <?php
                                //$total_entered_manual_invoices;
//                                $total_entered_manual_invoices=0;
//                                //var_dump($manual_entered_invoices);
//
//                                foreach($manual_entered_invoices as $manual_ready){
//
//                      //              $total__ =
//                                    //var_dump($manual_ready['id']);
////                                    $total_entered_manual_invoices=floatval($manual_ready['amount_entered']);
//                                    $total_entered_manual_invoices+=floatval($manual_ready['id']);
//                                    //$this->report->get_total_manual_progress(floatval($manual_ready['id']));
//                                    //var_dump(floatval($total__));
//                                   // $total_entered_manual_invoices += $total__;
//
//                                }

                                /*
                                 * SOLVED I GUESS,
                                 *  HAPA
                                 */

                                $total_entered_manual_invoices =
                                    str_replace( ',', '', $this->report->get_manual_entered_invoices());
                                //var_dump($this->report->get_manual_data());
                                if($this->report->get_manual_data_entered()){


                                $all_manual_invoices = $this->report->get_manual_data_entered()[0];

                                    if($all_manual_invoices['entered']==2){
                                        //$total_not_manual_invoices = $all_manual_invoices['amount'];
                                        $total_entered_manual_invoices =
                                            str_replace( ',', '', $this->report->get_total_manual_invoice(2))
                                                +str_replace( ',', '', $this->report->get_manual_entered_invoices());;

                                    }
                                }

                                        //

                                //var_dump($this->report->get_manual_entered_invoices());
                                //leta za progress alaf zi plus pia

//                                $total_entered_manual_invoices = $this->report->get_manual_data();
echo number_format($total_entered_manual_invoices);


                                ?>
                            </td>
                            <td></td>
                        </tr>

                        <tr>
                            <td colspan="2"></td>
                            <td class='text-right'>
                                <?php

                                $total_adjustments =
                                    (str_replace( ',', '', $total_returns) +
                                    str_replace( ',', '', $total_entered_manual_invoices ));

                                echo number_format($total_adjustments);
                                $this->session->set_userdata('total_adjustments',$total_adjustments);

                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td> <h4>CASH IN HAND</h4> </td>
                            <td></td>
                            <td class='text-right'>
                                <?php
                                // CASH IN HAND
                                // Formula: Income - Payments + Adjustments

                                $total_expenses = str_replace( ',', '', $totals_expenses);
                                $total_adjustments = str_replace( ',', '', $total_adjustments);

                                $cash_in_hand = floatval($total_income) - floatval($total_expenses) - floatval($total_adjustments);
                                //var_dump(floatval($total_income),floatval($total_expenses),floatval($total_adjustments));

                                $cash_in_hand = number_format($cash_in_hand);


                                    //$this->session->set_userdata('cash_in_hand',0);
                                    $this->session->set_userdata('cash_in_hand',$cash_in_hand);

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
