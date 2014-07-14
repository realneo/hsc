<div class="row">


<!-- ADD MANUAL INVOICE FORM ------------------------------------------------------------------------------>

<div class="col-lg-5">
    <div class="panel panel-default">
        <div class="panel-heading">Add Manual Invoice</div>
        <div class="panel-body">
            <form role="form" action="<?php echo base_url().'add_manual_invoice'?>" method="post">

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

<div class="col-lg-5">
    <div class="panel panel-default">
        <div class="panel-body"><h4><span class='lead'>Total Manual Invoices : </span>Tshs <?php echo make_me_bold($manual_invoice);?></h4></div>
    </div>
</div>
</div>