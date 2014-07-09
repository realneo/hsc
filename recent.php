<!-- RECENT ACTIVITIES --------------------->
<div class="col-lg-4">
    <div class="panel panel-default">
        <div class="panel-heading">Recent Activities</div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped  table-hover">
                    <tbody>
                    <?php
                    $results = $db -> query("SELECT * FROM `log` WHERE `branch_id` = '$branch_id' ORDER BY `id` DESC LIMIT 5");
                    $count = 0;
                    while($row = $results->fetch_assoc()){
                        $count++;
                        $log = $row['log'];
                        $log_date = $row['date'];

                        echo "<tr><td>{$count}</td><td><strong>{$log_date}</strong><br />{$log}</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>