<?php if($this->session->userdata("branch_id") == 1){?>
    <!-- DISPLAY TODAY BINDING ----------------------------->
    <div class="col-lg-3">
            <div class='well well-sm'>
            <p>Total Binding For Today <span class='small text-muted pull-right'>
                    <?php $date = date("Y-m-d");
                          echo custom_date_format($date);
                    ?>
                    </span></p>
                        <h3><span class='small'>Tshs</span> <?php echo make_me_bold($today_binding); ?><?php if($this->session->userdata('auth_type')!=21){?> <a class='btn' href='<?php echo base_url('admin/edit_daily_binding'); ?>'>Edit</a><?php } ?></h3>
        </div>
    </div>
<?php }?>