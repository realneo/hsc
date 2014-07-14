<div class="row">


<!-- ADD MANUAL INVOICE FORM ------------------------------------------------------------------------------>

<div class="col-lg-6">
    <div class="panel panel-default">
        <div class="panel-heading">Add Manual Invoice</div>
        <div class="panel-body">
            <form role="form" action="<?php echo base_url().'admin/manual_invoice_add'?>" method="post">

                <div class="form-group col-lg-6">
                    <label>Select Date</label>
                    <input class="form-control" id="datepicker" type="text" name="date" value="<?php echo date('Y-m-d'); ?>"/>
                </div>

                <div class="form-group col-lg-6">
                    <label>Amount</label>
                    <input class="form-control" name="amount" type="number" />
                </div>

                <div class="form-group">
                    <button class="form-control btn btn-primary">Add Manual Invoice</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- TOTAL MANUAL INVOICES -------------------------------------------------------------------------->

<div class="col-lg-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Manual Invoices for <?php echo $this->session->userdata('branch_name');?></div>
        </div>
        <div class="panel-body"><h4><span class='lead'>Total Manual Invoices : </span>Tshs <?php echo make_me_bold($manual_invoice);?></h4></div>
    </div>
</div>
</div>
<div class="row">
    <!-- VIEW RECENT MANUAL INVOICES -------------------------------------------------------------------------->
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Recent Added Manual Invoices</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped  table-hover">
                        <thead>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Entered</th>
                        <th>Date Entered</th>
                        </thead>
                        <tbody>
                        <?php

                        foreach($recent_invoices  as $row){
                            $date = custom_date_format($row['date']);
                            $amount = number_format($row['amount']);
                            $entered_db = $row['entered'];
                            $date_entered_db = $row['date_entered'];

                            // Removing the 0000-00-00 from the list
                            if($date_entered_db == '0000-00-00'){
                                $date_entered = '';
                            }else{
                                $date_entered = custom_date_format($date_entered_db);
                            }

                            // Check if the Manual Invoice is Entered or Not
                            if($entered_db == 1){
                                $entered = "<span class='text-success'>Entered</span>";
                            }else{
                                $entered = '<span class="text-danger">Not Entered</span>';
                            }
                            echo "<tr>
											<td>{$date}</td>
											<td>{$amount}</td>
											<td>{$entered}</td>
											<th>{$date_entered}</td>
										</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>