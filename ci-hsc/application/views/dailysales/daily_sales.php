<div class="row">
    <div class='col-lg-4'>

        <div class='well well-sm'>
            <p>Total Sales For Today <br /> <span class='small'><?php $date = date("Y-m-d"); echo custom_date_format($date)?><p>
			<form action="<?php echo base_url('admin/daily_sales_edit');?>" method='post'>
                <div class="input-group">
                    <span class="input-group-addon">Tshs</span>
                    <input class='form-control' type='number' name='total_sale' placeholder="<?php echo $today_sales; ?>"/>
                    <span class="input-group-btn"><button class="btn btn-primary" type="submit">Save</button></span>
                </div>
            </form>
        </div>

    </div>
</div>
