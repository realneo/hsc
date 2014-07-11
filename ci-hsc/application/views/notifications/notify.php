<div class="row">
    <?php foreach($notifications as $not){?>
        <div class="row ">
<div class="well row">

        <div class="col-lg-1">
            <p class="lead"><span style="font-size: 0.49em;"><?php echo custom_date_format($not['date']);?></span><br>
                <?php echo $not['timeonly'];?></p>
            </div>
            <div class="col-lg-9"><p><?php echo $not['log'];?></p></div>

    </div>
</div>
    <?php }
    echo $pages;
    ?>
</div>