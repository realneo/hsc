<p class="lead"><?php echo $word_orignal;?></p>
<p class="lead"><?php echo $word_pass;?></p>
<form action="<?php echo base_url('welcome'); ?>" class="form-horizontal" method="post">
    <input type="text" name="password"/>
    <input type="submit"/>
</form>