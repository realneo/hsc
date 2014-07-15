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
                   <button type="submit" class="form-control btn btn-primary">Add Manual Invoice</button>
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
                        <?php

                        if($this->session->flashdata('view_invoices')){?>
                        <th>Action</th>
                        <?php } ?>
                        </thead>
                        <tbody>
                        <?php


                        foreach($recent_invoices  as $row){
                            $temp_data=array(
                                'date'=>$row['date'],
                                'entered'=>$row['entered'],
                                'id'=>$row['id'],
                                'amount'=>$row['amount'],
                                'date_entered'=>$row['date_entered']
                            );
                            $this->session->set_flashdata('post_data_'.$row['id'],$temp_data);
                            $php=base_url('admin/manual_invoice_delete').'/'.$row['id'];
                            $button = "<a href='".$php."' class=''  onclick=return&#32;confirm('Are&#32;you&#32;sure&#32;you&#32;want&#32;to&#32;Delete&#32;this&#32;Item?');> <i class='fa fa-trash-o fa-lg fa-black'></i></a>";
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
											<td>{$date_entered}{$button}</td>";
                                            if($this->session->flashdata('view_invoices')){?>
                                <td class="col-lg-3">
                                    <form class="form-horizontal" action='<?php echo base_url()."admin/manual_enter";?>' method='post'>
                                        <div class='input-group'>
                                            <input class='form-control' type='text' name='amount' value='' />
                                            <input type='hidden' name='id' value='<?php echo $row['id'];?>' />
											      		<span class='input-group-btn'>
											        		<button class='btn btn-primary' type='submit'>Enter</button>
											      		</span>
                                        </div>
                                    </form>
                                </td>
                                            <?php } ?>
										</tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>