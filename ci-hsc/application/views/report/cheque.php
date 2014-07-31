<div class="row">
    <!-- RECENT RETURNS -------------------------------------------------------------------------->

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Cheques</div>
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
                            $amount = number_format($row['amount']);
                            $branch_id=$row['branch_id'];
                            $branch_name=$this->usuals->get_branch_name($branch_id);
                            $status  = $row['pre_status'];
                            switch($status){
                                case 'cleared': $color='text-success';
                                    $button='';
                                    $status = "";
                                    $button="
                                    <a data-toggle='tooltip'
                                    data-placement='right' title='Already Checked' rel='info'
                                    href='javascript:void(0);'>
                                    <span class='fa fa-check text-success'></span>
                                    </a>";
                                    break;
                                case 'not_cleared': $color='text-danger' ;
                                    $url=base_url('reports/cheque_report_check')."/".$row['id'];

                                    $button="
                                    <a href='$url' data-toggle='tooltip'
                                    data-placement='left' title='Clear' rel='info'>
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
											<td>{$amount}</td>
											<td>{$button}</td>
										</tr>
									";
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