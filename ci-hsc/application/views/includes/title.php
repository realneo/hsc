<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header"><?php echo (isset($title) && $title)? $title:'Daily Sales';?>  <span class='small'><?php if(isset($dont_show) AND $dont_show) {;}else{$date = date("Y-m-d"); echo custom_date_format($date);}?></span></h4>
</div>
</div>