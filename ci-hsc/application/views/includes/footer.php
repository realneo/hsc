
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
</script>



<!-- Page-Level Plugin Scripts - Blank -->

<!-- Page-Level Plugin Scripts - Morris -->
<script src="<?php echo base_url('assets');?>/js/plugins/morris/raphael-2.1.0.min.js"></script>
<script src="<?php echo base_url('assets');?>/js/plugins/morris/morris.js"></script>

<!-- SB Admin Scripts - Include with every page -->
<script src="<?php echo base_url('assets');?>/js/sb-admin.js"></script>


</body>

</html>