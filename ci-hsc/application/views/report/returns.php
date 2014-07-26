<div class="row">
    <!-- RECENT RETURNS ------------------------------------------>

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Returns Management</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped  table-hover">
                        <thead>
                        <th>Date</th>
                        <th>Receipt Number</th>
                        <th>Item Code</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Details</th>
                        <th>Status</th>


                        </thead>
                        <tbody>
                        <?php
                        // Get the Top 10 List of recent Sales Vouchers


                        foreach($all_returns as $row){
                            $date = custom_date_format($row['date']);
                            $action = $row['action'];
                            $receipt_number = $row['receipt_number'];

                            $item_code = $row['item_returned'];
                            $qty = $row['qty'];
                            $amount = number_format($row['amount']);
                            $status = $row['status'];

                            switch($status){
                                case 'checked': $color='text-success';
                                    $button='';

                                    break;
                                case 'unchecked': $color='text-danger' ;
                                    $url=base_url('reports/approve_return')."/".$row['id'];

                                    $button="
                                    <a href='$url' data-toggle='tooltip'
                                    data-placement='right' title='Produce Variance' rel='info'
                                    href='javascript:void(0);'>
                                    <span class='fa fa-mail-forward'></span>
                                    </a>";

                                    break;
                                default: $color='text-success';
                                $button='';
                                break;
                            }

                            $id=$row['id'];


                            echo
                            "
										<tr>
											<td>{$date}</td>
											<td>{$receipt_number}</td>
											<td>{$item_code}</td>
											<td>{$qty}</td>
											<td>{$amount}</td>
											<td>{$action}</td>
											<td class='{$color}'>{$status}{$button}</td>


										</tr>
									";
                        }

                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">You can only delete today's returns, Contact administrator for more information</div>
        </div>
    </div>
</div>

