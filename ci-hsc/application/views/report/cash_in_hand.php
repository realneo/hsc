
<div class="row">
    <!-- SELECT REPORT DATE -------------------------------------------------------------------------------->
    <div class="col-lg-3 no-print" style="margin-bottom: 10px;">
        <form action='<?php echo base_url('reports/change_report_date');?>' method='post'>
            <div class="input-group">
                <input class="form-control" id="datepicker2" type="text" name="date" value="<?php echo $this->session->userdata('report_date')?$this->session->userdata('report_date'):date('Y-m-d'); ?>" />
		      	<span class="input-group-btn">
		        	<button class="btn btn-primary" type="submit">Go!</button>
		      	</span>
            </div>
        </form>
    </div>
    <!-- DISPLAY CASH COLLECTION REPORT -------------------------------------------------------------------->

    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                HSC - All Branches
            </div>
            <div class="panel-body">
                <p><span class='small'>Report For :</span> <?php echo custom_date_format($this->session->userdata('report_date')); ?> </p>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <th>Branch</th>
                        <th>Cash In Hand</th>
                        <th>Amount</th>
                        </thead>
                        <tbody>
<!--                        <tr><th colspan="3">INCOME</th></tr>-->

<?php foreach($branches as $branch){?>
    <tr>
                        <td><?php echo $branch['name']?></td>
                        <td>TEST</td>
                        <td>TEST</td>
    </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
