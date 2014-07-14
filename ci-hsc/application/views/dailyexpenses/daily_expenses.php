<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header">Daily Expenses</h4></div>
</div>
<!-- ADD EXPENSES FORM ------------------------------------------------------------------------------>
<div class="row">
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">Add Expenses</div>
        <div class="panel-body">
            <form role="form" action="<?php echo base_url('admin/expense_add');?>" method="post">

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