<div class="row">
    <!-- RECENT RETURNS -------------------------------------------------------------------------->

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Payments</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped  table-hover">
                        <thead>
                        <th>Date</th>
                        <th>Purpose</th>
                        <th>Received By</th>
                        <th>Amount</th>
                        <th>Branch</th>
                        </thead>
                        <tbody>
                        <?php
                        // Get the Top 10 List of recent Sales Vouchers


                        foreach($expenses as $row){
                            $date = custom_date_format($row['date']);
                            $purpose = $row['purpose'];
                            $received_by = $row['received_by'];
                            $amount = number_format($row['amount']);
                            $branch_id=$row['branch_id'];
                            $branch_name=$this->usuals->get_branch_name($branch_id);


                            echo
                            "
										<tr>
											<td>{$date}</td>
											<td>{$purpose}</td>
											<td>{$received_by}</td>
											<td>{$amount}</td>
											<td>{$branch_name}</td>
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