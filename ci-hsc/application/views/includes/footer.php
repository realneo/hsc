
</div><!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<!-- Core Scripts - Include with every page -->
<script src="<?php echo base_url('assets');?>/js/jquery-1.10.2.js"></script>
<script src="<?php echo base_url('assets');?>/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('assets');?>/js/plugins/metisMenu/jquery.metisMenu.js"></script>


<script src="<?php echo base_url('assets');?>/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url('assets');?>/js/jquery.price_format.2.0.min.js"></script>
<script src="<?php echo base_url('assets');?>/js/bootstrap-editable.min.js"></script>

<script>
    // Date Picker Limit FUTURE dates
    $(function() {
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
        $( "#datepicker" ).datepicker({
            format:"yyyy-mm-dd",
            maxDate: '0',
            endDate: '+0d',
            onRender: function(date) {
                return date.valueOf() > now.valueOf() ? 'disabled' : '';
            }

        });
        $( "#datepicker2" ).datepicker({
            format:"yyyy-mm-dd",
            maxDate: '0',
            endDate: '+0d',
            onRender: function(date) {
                return date.valueOf() > now.valueOf() ? 'disabled' : '';
            }

        });
    });

</script>

<script type="text/javascript">
    $('.money').priceFormat({
        clearPrefix: true,
        prefix: '',
        centsSeparator: '.',
        thousandsSeparator: ','
    });</script>

<script type="text/javascript">
    $.fn.editable.defaults.mode = 'popup';//'inline';
    $(document).ready(function() {
        $('a[rel=edit_amount]').editable({
            url: '<?php echo base_url('reports/add_audited_amount')?>'
        });
    });
    $('a[rel=info]').tooltip();
</script>


<!-- Page-Level Plugin Scripts - Blank -->

<!-- Page-Level Plugin Scripts - Morris -->
<script src="<?php echo base_url('assets');?>/js/plugins/morris/raphael-2.1.0.min.js"></script>
<script src="<?php echo base_url('assets');?>/js/plugins/morris/morris.js"></script>


<!--Just for the graphs-->
<script type="text/javascript">
    new Morris.Line({
        // ID of the element in which to draw the chart.
        element: 'myfirstchart',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [
            <?php
            foreach($recent_total as $key=>$row){
                        $date = custom_date_format($row['date']);
                        $total_sale = number_format($row['total_sale']);
                        if($key==0){
                            echo "{ date: '{$row['date']}',audited : {$row['audited_total_sale']}, amount: {$row['total_sale']} }";
                        }else{
                            echo ",{ date: '{$row['date']}',audited : {$row['audited_total_sale']}, amount: {$row['total_sale']}}";
                        }

                    }
            ?>
//            { date: '2008', amount: 20 },
//            { date: '2009', amount: 10 },
//            { date: '2010', amount: 5 },
//            { date: '2011', amount: 5 },
//            { date: '2012', amount: 20 }
        ],
        // The name of the data record attribute that contains x-values.
        xkey: 'date',
        // A list of names of data record attributes that contain y-values.
        ykeys: ['audited','amount'],
        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        labels: ['Audited Total Sale','Total Sale'],
        lineColors: ['#7cb47c','#D58665'],
        pointSize: 4,
        hideHover: 'auto',
        xLabels : ['day']

    });
</script>



<!-- SB Admin Scripts - Include with every page -->
<script src="<?php echo base_url('assets');?>/js/sb-admin.js"></script>


</body>

</html>