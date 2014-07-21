<div class="row">
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">Add a Return</div>
        <div class="panel-body">
            <form role="form" action="<?php echo base_url().'admin/add_return';?>" method="post">

                <div class="form-group col-lg-3">
                    <label>Select Date</label>
                    <input class="form-control" id="datepicker2" type="text" name="date" value="<?php echo date('Y-m-d'); ?>" />
                </div>

                <div class="form-group col-lg-5">
                    <label>Action or Goods</label>
                    <input class="form-control" name="action" type="text" placeholder="What was returned?" />
                </div>

                <div class="form-group col-lg-2">
                    <label>Receipt Number</label>
                    <input class="form-control" name="receipt_number" type="text" placeholder="" />
                </div>

                <div class="form-group col-lg-2">
                    <label>Amount</label>
                    <input class="form-control money" name="amount" type="text" placeholder="Enter Amount" />
                </div>

                <div class="form-group">
                    <button class="form-control btn btn-primary">Add A Return</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<div class="row">
    <!-- RECENT RETURNS -------------------------------------------------------------------------->

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Recent Returns </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped  table-hover">
                        <thead>
                        <th>Date</th>
                        <th>Action or Goods</th>
                        <th>Receipt Number</th>
                        <th>Amount</th>
                        </thead>
                        <tbody>
                        <?php
                        // Get the Top 10 List of recent Sales Vouchers


                        foreach($recent_returns as $row){
                            $date = custom_date_format($row['date']);
                            $action = $row['action'];
                            $receipt_number = $row['receipt_number'];
                            $amount = number_format($row['amount']);
                            $id=$row['id'];
                            $temp_data=array(
                                'date'=>$date,
                                'action'=>$action,
                                'id'=>$id,
                                'amount'=>$amount,
                                'receipt_number'=>$receipt_number
                            );
                            $this->session->set_flashdata('post_data_'.$id,$temp_data);
                            $php=base_url('admin/delete_return').'/'.$id;
                            $button = "<a href='".$php."' class=''  onclick=return&#32;confirm('Are&#32;you&#32;sure&#32;you&#32;want&#32;to&#32;Delete&#32;this&#32;Item?');> <i class='fa fa-trash-o fa-lg fa-black'></i></a>";

                            echo
                            "
										<tr>
											<td>{$date}</td>
											<td>{$action}</td>
											<td>{$receipt_number}</td>
											<td>{$button} {$amount}</td>
										</tr>
									";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>