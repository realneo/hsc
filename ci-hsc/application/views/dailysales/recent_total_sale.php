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
                    foreach($recent_total as $row){
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