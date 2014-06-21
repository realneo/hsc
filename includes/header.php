<div id="page-wrapper">
             <!-- Notification -->
            <div class="row">
                <?php
                    if(!$_SESSION['alert_type'] || !$_SESSION['alert_msg']){
                        // Display nothing
                    }else{

                        $alert_type = $_SESSION['alert_type'];
                        $alert_msg = $_SESSION['alert_msg'];
                        echo "
                            <div class='alert alert-{$alert_type} alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                {$alert_msg}
                            </div>
                        ";
                    }
                ?>

            </div>