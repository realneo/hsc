
    <?php foreach($notifications as $not){?>
        <div class="row">
        <div class="well">
        <div class="col-lg-1"><p class="lead"><?php echo $not['date'];?></p></div>
        <div class="col-lg-11"><p><?php echo $not['log'];?></p></div>
    </div>
        </div>
    <?php }
    echo $pages;
    ?>
