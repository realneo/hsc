
<div class="row ">
    <div class="col-lg-12">
        <div class="row">
    <?php
        //col-md-offset-2 col-md-8 col-lg-offset-3
        foreach($staffs as $key=>$staff){?>

            <div class="col-lg-6">
                <div class="well profile emphasis ">
                    <div class="col-sm-12">
                        <div class="col-xs-12 col-sm-8">
                            <h2><?php echo $this->staffs->get_profle($staff['id'])[0]['first_name']." ".$this->staffs->get_profle($staff['id'])[0]['last_name'];?></h2>
                            <p>
                                <?php
                                echo make_me_bold($this->staffs->get_auth_type_name($staff['auth_type']));
                                if($staff['branch_id']!=0){
                                    echo " currently assigned at ".make_me_bold($this->usuals->get_branch_name($staff['branch_id']));
                                }


                                ?></p>
                            <div class="divider"></div>
                                <div class="row">

                                </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 text-center  ">
                            <figure>
                                <img src="<?php
                                switch($this->staffs->get_profle($staff['id'])[0]['gender']){
                                    case 'male': echo base_url('assets/img/default-user-icon-profile.png'); break;
                                    case 'female': echo base_url('assets/img/default-user-icon-profile-pink.png'); break;

                                    default : echo base_url('assets/img/default-user-icon-profile.png'); break;
                                }?>
                                " alt="" class="img-circle img-responsive">
                                <figcaption class="ratings">
                                    <p class="small">
                                        <?php echo $staff['email'];?>
                                    </p><p class="small">
                                        <a href="#">
                                            <span class="fa fa-star"></span>
                                        </a>
                                        <a href="#">
                                            <span class="fa fa-star"></span>
                                        </a>
                                        <a href="#">
                                            <span class="fa fa-star"></span>
                                        </a>
                                        <a href="#">
                                            <span class="fa fa-star"></span>
                                        </a>
                                        <a href="#">
                                            <span class="fa fa-star-o"></span>
                                        </a>
                                    </p>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <div class="col-xs-12 text-center">

                        <div class="col-xs-12 col-sm-4 text-center pull-right">

                            <div class="btn-group dropup">
                                <button type="button" class="btn btn-primary"><span class="fa fa-gear"></span> Options </button>
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu text-left" role="menu">
                                    <li><a href="#"><span class="fa fa-envelope pull-right"></span> Send an email </a></li>
                                    <li><a href="#"><span class="fa fa-list pull-right"></span> Change Display Picture  </a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><span class="fa fa-warning pull-right"></span>Report this user for spam</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#" class="btn disabled" role="button"> Send Warning </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php if($key%2==1){?>
            </div><div class="row">
        <?php } ?>
    <?php } ?>
</div></div>

