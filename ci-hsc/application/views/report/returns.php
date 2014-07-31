<div class="row">
    <div class="col-lg-12 ">

        <div class="pull-right btn-group show-invoices">

            <a href="<?php echo base_url('reports/return_change_status/0');?>">
                <button class="btn btn-default <?php echo $this->session->userdata('status')== '0' ? 'active':'';?>" name="options1" id="option1" > All</button>
            </a>
            <a href="<?php echo base_url('reports/return_change_status/1');?>">
                <button class="btn btn-default <?php echo $this->session->userdata('status')=='checked' ? 'active':'';?> " name="options2" id="option2" > Checked</button>
            </a>
            <a href="<?php echo base_url('reports/return_change_status/2');?>">
                <button class="btn btn-default <?php echo $this->session->userdata('status')=='unchecked' ? 'active':'';?>" name="options3" id="option3" > Unchecked</button>
            </a>


        </div>
        <span class="col-lg-4 text-muted" style="margin-top: 7px;">
        <?php

            switch($unchecked_no){
                case 0 : echo "You have no unchecked returns , Great Job!"; break;
                case 1 :
                case 2 :
                case 4 :
                case 5 : echo make_me_bold($unchecked_no)." left , Almost there!"; break;
                default : echo "You have ".make_me_bold($unchecked_no)." unchecked returns left"; break;

            }
            ?>
        </span>
    </div>
</div>
<div class="row">
    <!-- RECENT RETURNS ------------------------------------------>

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Returns From all Branches</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped  table-hover">
                        <thead>
                        <th>Date</th>
                        <th>Receipt Number</th>
                        <th>Item Code</th>
                        <th>Quantity</th>
                        <th>Branch</th>
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
                            $branch_name = $this->usuals->get_branch_name($row['branch_id']);

                            switch($status){
                                case 'checked': $color='text-success';
                                    $button='';
                                    $status = "";
                                    $button="
                                    <a data-toggle='tooltip'
                                    data-placement='right' title='Already Checked' rel='info'
                                    href='javascript:void(0);'>
                                    <span class='fa fa-check text-success'></span>
                                    </a>";
                                    break;
                                case 'unchecked': $color='text-danger' ;
                                    $url=base_url('reports/approve_return')."/".$row['id'];

                                    $button="
                                    <a href='$url' data-toggle='tooltip'
                                    data-placement='left' title='Click to Check it' rel='info'>
                                    <span class='fa fa-repeat text-danger'></span>
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
											<td>{$branch_name}</td>
											<td>{$amount}</td>
											<td>{$action}</td>
											<td class='{$color}'>{$button}<span class='small text-muted'>{$status}</span></td>


										</tr>
									";
                        }

                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">Here you can view all the returns from all the branches</div>
            <div class="col-lg-12" style="margin-left: 14px;
margin-top: 8px;">
                <?php echo $pages;?>
            </div>
        </div>


    </div>
</div>



