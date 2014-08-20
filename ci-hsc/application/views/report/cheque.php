<div class="row">
    <!-- RECENT RETURNS -------------------------------------------------------------------------->

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Cheques
                <!-- Button trigger modal -->
                <button style="margin-top: -5px;" class="btn btn-default btn-sm pull-right <?php if($this->session->userdata('auth_type')!=40 or $this->session->userdata('auth_type')!=30){?> disabled <?php }?>" data-toggle="modal" data-target="#myModal">
                    Add Cheque
                </button>

            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped  table-hover">
                        <thead>
                        <th>Date</th>
                        <th>Cheque Number</th>
                        <th>Name Of Customer</th>
                        <th>Branch</th>
                        <th>Amount</th>
                        <th>Status</th>
                        </thead>
                        <tbody>
                        <?php
                        // Get the Top 10 List of recent Sales Vouchers


                        foreach($cheques as $row){

                            $date = custom_date_format($row['date_added']);
                            $chq_number = $row['chq_number'];
                            $name_of_customer = $row['name_of_customer'];
                            $balance = $row['amount']-$this->report->get_cheque_log_total($row['id']);
                            $balance = number_format($balance);

                            $amount = number_format($row['amount']);
                            $branch_id=$row['branch_id'];
                            $branch_name=$this->usuals->get_branch_name($branch_id);
                            $status  = $row['pre_status'];
                            switch($status){
                                case 'cleared':
                                    $color='text-success';
                                    $button='';
                                    $status = "";
                                    $button2="
                                    <a data-toggle='tooltip'
                                    data-placement='top' title='Already Used' rel='info'
                                    href='javascript:void(0);'>
                                    <span class='fa fa-check text-success'></span>
                                    </a><span class='small text-muted'>Already Used</span>
                                    ";
                                    if($row['post_status']=='used'){
                                        $button = 'used';
                                    }else{
                                        $button = 'clearit';
                                    }

                                    break;
                                case 'not_cleared': $color='text-danger' ;
                                    $url=base_url('reports/cheque_report_check')."/".$row['id'];

                                    $button="
                                    <a href='$url' data-toggle='tooltip'
                                    data-placement='left' title='Clear it' rel='info'>
                                    <span class='fa fa-check text-danger'></span></a> <span class='small text-muted'>Not Cleared</span>
                                    ";

                                    break;
                                default: $color='text-success';
                                $button='';
                                break;
                            }


                            echo
                            "
										<tr>
											<td>{$date}</td>
											<td>{$chq_number}</td>
											<td>{$name_of_customer}</td>
											<td>{$branch_name}</td>
											<td>{$amount} <span class='text-muted '>({$balance}/= left)</span></td>
											<td class='col-lg-3'>"?><?php
                            if($button=='clearit'){
                                if($this->session->userdata('auth_type')==40){
                            ?>

                            <form class="form-horizontal col-lg-12" action='<?php echo base_url()."reports/use_cheque";?>' method='post'>
                                <div class='input-group' style="margin-left: -16px;">
                                    <input class='form-control money' placeholder="Cleared Cheque" type='text' name='amount' value='' />
                                    <input type='hidden' name='id' value='<?php echo $row['id'];?>' />
                                    <input type='hidden' name='date_issued' value='<?php echo $row['date_added'];?>' />
                                    <input type='hidden' name='date_posted' value='<?php echo date('Y-m-d');?>' />
                                    <span class='input-group-btn'>
										<button  style="height: 34px;" class='btn btn-primary' type='submit'><span class='fa fa-check'></span> <a data-toggle='tooltip' data-placement='left' title='Now it can be used' rel='info'></a>Use</button>
											      		</span>


                                </div>
                            </form><?php $button='';} else{
                                    //NOT STOCK_CONTROLLER
                                    $button="
                                    <a href='javascript:void(0);' data-toggle='tooltip'
                                    data-placement='left' title='Now it can be used by the cashier' rel='info'>
                                    <span class='fa fa-check text-success'></span></a>
                                    <span class='small text-muted'>Already Cleared </span>
                                    ";
                                }} else{
                                if(isset($button2)){
                                    if($status=='not_cleared'){
                                        //Button should stay the way it is
                                }else{
                                        $button = $button2;
                                    }
                                }else{
                                    $button2='';
                                }


                            }echo "{$button}</td>
										</tr>"?>

                        <?php
									;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer"></div>
        </div>
    </div>
</div>
<div class="row">
    <span class="push-it col-lg-12"><?php echo $pages;?></span>
</div>



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Cheque for <?php echo $this->session->userdata('branch_name');?></h4>
            </div>
            <form action="<?php echo base_url('reports/add_cheque')?>" class="form-horizontalo" method="post">
            <div class="modal-body">

                    <div class="form-group">
                        <label>Name Of Customer</label>
                        <input class="form-control" name="name_of_customer" placeholder="Enter Full Name">
                    </div>

                    <div class="form-group">
                        <label>Cheque Number</label>
                        <input class="form-control" name="chq_number" placeholder="Enter Cheque Number without spaces">
                    </div>

                    <div class="form-group">
                        <label>Amount</label>
                        <input class="form-control money" name="amount">
                    </div>

                    <div class="form-group">
                        <label>Date of Cheque</label>
                        <input class="form-control" name="date_issued" id="datepicker">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <input class="btn btn-primary" name="submit" type="submit" value="Add Cheque">
            </div>
            </form>
        </div>
    </div>
</div>