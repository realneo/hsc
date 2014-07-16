
</div><!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<!-- Core Scripts - Include with every page -->
<script src="<?php echo base_url('assets');?>/js/jquery-1.10.2.js"></script>
<script src="<?php echo base_url('assets');?>/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('assets');?>/js/plugins/metisMenu/jquery.metisMenu.js"></script>


<script src="<?php echo base_url('assets');?>/js/bootstrap-datepicker.js"></script>

<script>
    // Total Sale Date Picker
    $(function() {
        $( "#datepicker" ).datepicker({dateFormat:"yy-mm-dd"});
        $( "#datepicker2" ).datepicker({dateFormat:"yy-mm-dd"});
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