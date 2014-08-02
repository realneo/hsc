<?php
$online = check_if_online();
?>

<?php

$staff=$this->staffs->get_profile($this->session->userdata('user_id'))[0];
$current_user = $this->staffs->get_user($staff['user_id'])[0];

      // var_dump($staff);
?>
        <div class="row">
            <div class="col-sm-3 col-md-3 user-details" style="margin-bottom: 40px;">
                <div class="user-image">
                    <img src="<?php
                    switch($staff['gender']){
                        case 'male':
                            //echo "http://www.gravatar.com/avatar/".md5( strtolower( trim(  $staff['email'] ) ) )."?s=200&d=mm&";//d=".base_url('assets/img/default-user-icon-profile.png');
                            if($staff['img_url'] AND $online==true){
                                echo $staff['img_url'];
                                //echo "http://www.gravatar.com/avatar/".md5( strtolower( trim(  $staff['email'] ) ) )."?s=200";
                            }else{
                                echo base_url('assets/img/default-user-icon-profile.png');
                            }
                            break;
                        case 'female':

                            if($staff['img_url'] AND $online==true){
                                echo $staff['img_url'];
                                //echo "http://www.gravatar.com/avatar/".md5( strtolower( trim(  $staff['email'] ) ) )."?s=200";
                            }else{
                                echo base_url('assets/img/default-user-icon-profile-pink.png');
                            }

                            // echo "http://www.gravatar.com/avatar/".md5( strtolower( trim(  $staff['email'] ) ) )."?s=200&d=retro";//;&d=".base_url('assets/img/default-user-icon-profile-pink.png');
                            break;

                        default : echo base_url('assets/img/default-user-icon-profile.png'); break;
                    }?>
                                " alt="" class="img-circle img-responsive">
                </div>
                <div class="user-info-block">
                    <div class="user-heading">
                        <h3><?php echo $this->session->userdata('full_name');?></h3>
                        <span class="help-block">
                            <?php
//                            var_dump($current_user);
                            if($current_user['branch_id']!=0){
                                echo " Currently you are assigned at ".make_me_bold($this->usuals->get_branch_name($current_user['branch_id']));
                            }
                            ?></span>
                    </div>


                </div>

    </div>

            <div class="col-sm-3 col-md-3 user-details">

                <form class="form-horizontal" action="<?php echo base_url('welcome/change_pass'); ?>" method="post">
                        <div class="row">
                            <div class="col-md-12 col-lg-offset-2 ">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Change Password</h3>
                                    </div>
                                    <div class="panel-body pad-20">
                                        <form accept-charset="UTF-8" role="form">
                                            <fieldset>
                                                <div class="form-group">
                                                    <input class="form-control " placeholder="Password" name="password1" type="password">
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="Confirm Password" name="password" type="password" value="">
                                                </div>
                                                <div class="form-group"><input class="btn btn-lg btn-success btn-block" type="submit" value="Change Password"></div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                </form>
            </div>
</div>

<!--<p class="lead">--><?php //echo $word_orignal;?><!--</p>-->
<!--<p class="lead">--><?php //echo $word_pass;?><!--</p>-->
