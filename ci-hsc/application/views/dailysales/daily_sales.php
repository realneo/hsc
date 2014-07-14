<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header">Edit Sales </h4></div>
</div>
    <div class="row straighten-up">
        <div class='col-lg-4'>

            <div class='well well-sm'>
                <p>Total Sales For Today <br /> <span class='small'><?php $date = date("Y-m-d"); echo custom_date_format($date)?><p>
			<form action="<?php echo base_url('admin/daily_sales_edit');?>" method='post'>
                <div class="input-group">
                    <span class="input-group-addon">Tshs</span>
                    <input class='form-control' type='number' name='total_sale' placeholder="<?php echo $today_sales; ?>"/>
                    <span class="input-group-btn"><button class="btn btn-primary" type="submit">Save</button></span>
                </div>
            </form>
            </div>

        </div>
        <!-- VIEW RECENT DAILY SALES -------------------------------------------------------------------------->
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">Recent Total Sale</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped  table-hover">
                            <thead>
                            <th>Date</th>
                            <th>Total Sale</th>
                            </thead>
                            <tbody>
                            <?php
                            ;
                            while($row = $results->fetch_assoc()){
                                $date = custom_date_format($row['date']);
                                $total_sale = number_format($row['total_sale']);

                                echo "<tr>
											<td>{$date}</td>
											<td class='text-right'>{$total_sale}</td>
										</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
