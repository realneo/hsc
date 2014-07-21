<div class="row">
    <div class="col-lg-12"><?php if(empty($users)){?>
            <p class="text-muted">Sorry we can not retrieve salesman for <?php echo make_me_bold($this->session->userdata('branch_name'));?>, Since they are not registered in the system yet or perhaps the systen is busy, Try again later.</p>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">Add Sales Voucher</div>
            <div class="panel-body">
                <form role="form" action="<?php echo base_url().'admin/add_sales_voucher'?>" method="post">

                    <div class="form-group col-lg-3">
                        <label>Select Date</label>
                        <input class="form-control" id="datepicker2" type="text" name="date" value="<?php echo date('Y-m-d'); ?>" />
                    </div>

                    <div class="form-group col-lg-6">


                        <label>Sales</label>
                        <select class="form-control" name="sales_id">
                            <?php



                            foreach($users as $row){
                                $sales_id = $row['id'];

                                $results = $this->vouchers->get_user_profile($sales_id);

                                foreach($results as $row_){
                                    $sales_name = $row_['first_name']. ' ' . $row_['last_name'];
                                    $sales_name = make_me_bold($sales_name) ;
                                }
                                echo "<option value='{$sales_id}'>{$sales_name}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-lg-3">
                        <label>Sales Voucher</label>
                        <input class="form-control money" name="sales_voucher" type="text" placeholder="Enter Amount" />
                    </div>

                    <div class="form-group">
                        <button class="form-control btn btn-primary">Add Sales Voucher</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- TODAY SALES VOUCHERS -------------------------------------------------------------------------->

    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">Recent Sales Voucher </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped  table-hover">
                        <thead>
                        <th>Sales Name</th>
                        <th>Sales Voucher</th>
                        </thead>
                        <tbody>
                        <?php
                        // Get the Top 10 List of recent Sales Vouchers

                        foreach($recent_vouchers as $row){
                            $sales_id = $row['sales_id'];
                            $amount = number_format($row['amount']);

                            // Get Full name of the Sales Person
                            $results = $this->vouchers->get_user_profile($sales_id);
                            foreach($results as $row_){
                                $sales_name = $row_['first_name']. ' ' . $row_['last_name'];
                                $sales_name = make_me_bold($sales_name) ;
                            }
                            echo
                            "
										<tr>
											<td>{$sales_name}</td>
											<td>{$amount}</td>
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