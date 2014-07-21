<div class="row">

    <?php if(!$this->session->userdata('view_invoices')){?>
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
                    <input class="form-control money" name="amount" type="text" />
                </div>

                <div class="form-group">
                   <button type="submit" class="form-control btn btn-primary">Add Manual Invoice</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <?php } ?>
<!-- TOTAL MANUAL INVOICES -------------------------------------------------------------------------->

<div class="<?php if($this->session->userdata('view_invoices')){?>col-lg-7<?php } else{ ?>col-lg-6<?php }?>">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Manual Invoices for <?php echo $this->session->userdata('branch_name');?></div>
        </div>
        <div class="panel-body"><h4><span class='lead'>Total Manual Invoices : </span>Tshs <?php echo make_me_bold($manual_invoice);?></h4></div>

        <div class="panel-footer">
            <?php if($this->session->userdata('view_invoices')){?>
                <b>Note :</b> You can only enter manual the field that is not entered, You cannot <b>delete</b> the invoice that you have started to enter.
            <?php } else {?>
             <b>Note :</b> You can only <b> add one </b> manual invoice per day for <?php echo make_me_bold($this->session->userdata('branch_name'));?>
            <?php } ?>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12 ">
            <div class="btn-group show-invoices">

                <a href="<?php echo base_url('hsc/determine_invoice/3');?>">
                        <button class="btn btn-default <?php echo ($this->session->userdata('show')==3)?'active':'';?>" name="options1" id="option1" > All</button>
                    </a>
                <a href="<?php echo base_url('hsc/determine_invoice/1');?>">
                        <button class="btn btn-default <?php echo $this->session->userdata('show')==1?'active':'';?> " name="options2" id="option2" > Entered</button>
                    </a>
                <a href="<?php echo base_url('hsc/determine_invoice/0');?>">
                        <button class="btn btn-default <?php echo $this->session->userdata('show')==0?'active':'';?>" name="options3" id="option3" > Not Entered</button>
                    </a>
                <a href="<?php echo base_url('hsc/determine_invoice/2');?>">
                        <button class="btn btn-default <?php echo $this->session->userdata('show')==2?'active':'';?>" name="options4" id="option4" > Started Entering</button>
                    </a>

            </div>
        </div>
    </div>

</div>
</div>


<div class="row">

<div class="row">

    </div>
    <!-- VIEW RECENT MANUAL INVOICES -------------------------------------------------------------------------->
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
               Recent Added Manual Invoices
                </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped  table-hover">
                        <thead>
                        <th>Date Issued</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date Entered</th>
                        <?php

                        if($this->session->userdata('view_invoices')){?>
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
                                'amount'=>$row['balance'],
                                'date_entered'=>$row['date_entered']
                            );
                            $this->session->set_flashdata('post_data_'.$row['id'],$temp_data);
                            $php=base_url('admin/manual_invoice_delete').'/'.$row['id'];



                            $amount = number_format($row['balance']);
                            $orignal_amount=$row['amount'];
                            $entered_db = $row['entered'];
                            $date_entered_db = $row['date_entered'];
                            $button ='';
                            if($date_entered_db == date('Y-m-d')){
                                $date_entered = custom_date_format($date_entered_db);//'Not Available untill entered';
                                if($entered_db == 0){
                                    $button = "<a href='".$php."' class=''  onclick=return&#32;confirm('Are&#32;you&#32;sure&#32;you&#32;want&#32;to&#32;Delete&#32;this&#32;Item?');> <i class='fa fa-trash-o fa-lg text-danger'></i></a>";
                                }

                            }else{
                                $date_entered = custom_date_format($date_entered_db);

                            }
                            $date = custom_date_format($row['date']);

                            // Check if the Manual Invoice is Entered or Not
                            if($entered_db == 1){
                                $entered = "<span class='text-success'>Entered</span>";
                            }
                            elseif($entered_db == 2){
                                $entered = "<span class='text-warning'>Started Entering ...</span>";

                            }elseif($entered_db == 0){
                                $entered = '<span class="text-danger">Not Entered</span>';
                            }
                            echo "<tr>
											<td>{$date}</td>
											<td>{$orignal_amount}/= <span class='text-muted'>(Tsh $amount left)</span></td>
											<td>{$entered}</td>
											<td>{$button} {$date_entered}</td>";
                                            if($this->session->userdata('view_invoices')){?>
                                <td class="col-lg-3">

                                    <?php if($entered_db!=1){?><form class="form-horizontal" action='<?php echo base_url()."admin/manual_enter";?>' method='post'>
                                        <div class='input-group'>
                                            <input class='form-control money' type='text' name='amount' value='' />
                                            <input type='hidden' name='id' value='<?php echo $row['id'];?>' />
                                            <input type='hidden' name='date_issued' value='<?php echo $row['date'];?>' />
											      		<span class='input-group-btn'>
											        		<button class='btn btn-primary' type='submit'>Enter</button>
											      		</span>
                                        </div>
                                    </form>
                                                    <?php } else{echo make_me_bold("<span class='text-success text-right'><i class='fa fa-check'></i> Already entered</span>");} ?>
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

            <?php
            if(empty($recent_invoices)){?>
            <div class="panel-footer">No invoices are available in this category</div>
            <?php } ?>
        </div>
        <div class="row">
            <div class="col-lg-12 invoices-pg">
                <?php echo $pages;?>
            </div>
        </div>
    </div>

</div>