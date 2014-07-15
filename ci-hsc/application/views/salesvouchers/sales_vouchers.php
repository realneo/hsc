<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Add Sales Voucher</div>
            <div class="panel-body">
                <form role="form" action="includes/sales_voucher_process.php" method="post">

                    <div class="form-group col-lg-3">
                        <label>Select Date</label>
                        <input class="form-control" id="datepicker2" type="text" name="date" value="<?php echo date('Y-m-d'); ?>" />
                    </div>

                    <div class="form-group col-lg-6">
                        <label>Sales</label>
                        <select class="form-control" name="sales_id">
                            <?php



                            foreach($recent_vouchers as $row){
                                $sales_id = $row['id'];

                                $results = $db->query("SELECT * FROM `user_profile` WHERE `user_id` = '$sales_id'");

                                while($rows = $results->fetch_assoc()){
                                    $sales_name = $rows['first_name']. ' ' . $row['last_name'];
                                }
                                echo "<option value='{$sales_id}'>{$sales_name}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-lg-3">
                        <label>Sales Voucher</label>
                        <input class="form-control" name="sales_voucher" type="number" placeholder="Enter Amount" />
                    </div>

                    <div class="form-group">
                        <button class="form-control btn btn-primary">Add Sales Voucher</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>