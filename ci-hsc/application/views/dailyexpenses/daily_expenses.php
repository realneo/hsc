<!-- ADD EXPENSES FORM ------------------------------------------------------------------------------>
<div class="row">
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">Add Expenses</div>
        <div class="panel-body">
            <form role="form" action="<?php echo base_url('admin/daily_expense_add');?>" method="post">

                <div class="form-group col-lg-2">
                    <label>Select Date</label>
                    <input class="form-control" id="datepicker" type="text" name="date" value="<?php echo date('Y-m-d'); ?>" />
                </div>

                <div class="form-group col-lg-6">
                    <label>Purpose</label>
                    <input class="form-control" name="purpose" type="text" />
                </div>

                <div class="form-group col-lg-2">
                    <label>Received By</label>
                    <input class="form-control" name="received_by" type="text" />
                </div>

                <div class="form-group col-lg-2">
                    <label>Amount</label>
                    <input class="form-control" name="amount" type="number" placeholder='Enter Amount' />
                </div>


                <div class="form-group">
                    <button class="form-control btn btn-primary">Add Expense</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>


<div class="row">
    <!-- VIEW RECENT EXPENSES -------------------------------------------------------------------------->
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Recent Expenses</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped  table-hover">
                        <thead>
                        <th>Date</th>
                        <th>Purpose</th>
                        <th>Received By</th>
                        <th>Amount</th>
                        <th>Action</th>
                        </thead>
                        <tbody>
                        <?php


                        $today_date = custom_date_format(date("Y-m-d"));

                        foreach($recent_expenses as $row){
                            $id = $row['id'];
                            $date = custom_date_format($row['date']);
                            $purpose = $row['purpose'];
                            $received_by = ucwords(strtolower($row['received_by']));
                            $amount = number_format($row['amount']);
                            $temp_data=array('date'=>$date,'purpose'=>$purpose,'id'=>$id,'amount'=>$amount);
                            $this->session->set_flashdata('post_data_'.$id,$temp_data);
                            $php=base_url('admin/daily_expense_delete').'/'.$id;
                            $button = "<a href='".$php."' class=''  onclick=return&#32;confirm('Are&#32;you&#32;sure&#32;you&#32;want&#32;to&#32;Delete&#32;this&#32;Item?');> <i class='fa fa-trash-o fa-lg fa-black'></i></a>";
                            if($date == $today_date){
                                echo "<tr>
												<td>{$date}</td>
												<td>{$purpose}</td>
												<td>{$received_by}</td>
												<td>{$amount}</td>
												<td>{$button}</td>
											</tr>";
                            }else{
                                echo "<tr>
											<td>{$date}</td>
											<td>{$purpose}</td>
											<td>{$received_by}</td>
											<td>{$amount}</td>
											<td></td>
										</tr>";
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
