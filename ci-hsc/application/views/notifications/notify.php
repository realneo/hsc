<div class="" id="noti_holder">
    <?php foreach($notifications as $not){?>
        <div class="row ">
<div class="well row well-noti" >

        <div class="col-lg-1">
            <p class="lead"><span style="font-size: 0.49em;"><?php echo custom_date_format($not['date']);?></span><br>
                <?php echo make_me_bold($not['timeonly']);?></p>
            </div>
            <div class="col-lg-9"><p><?php echo $not['log'];?></p></div>

    </div>
</div>
    <?php }
    echo $pages;
    ?>
</div>