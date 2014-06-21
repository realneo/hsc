
            </div>
        </div>
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <script src="js/jquery-ui-1.10.4.custom.min.js"></script>
    
    <script>
        // Total Sale Date Picker
        $(function() {
            $( "#datepicker" ).datepicker({dateFormat:"yy-mm-dd"});
            $( "#datepicker2" ).datepicker({dateFormat:"yy-mm-dd"});
        });
        </script>
    <!-- Page-Level Plugin Scripts - Blank -->

    <!-- Page-Level Plugin Scripts - Morris -->
    <script src="js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="js/plugins/morris/morris.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>

    <script src="js/total_sale_chart.js"></script>

</body>

</html>

<?php
    $_SESSION['alert_type'] = '';
    $_SESSION['alert_msg'] = '';
?>