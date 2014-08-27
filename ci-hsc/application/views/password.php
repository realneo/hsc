<?php
$online = check_if_online();
?>

<?php

$staff=$this->staffs->get_profile($this->session->userdata('user_id'))[0];
$current_user = $this->staffs->get_user($staff['user_id'])[0];



?>

<div class="row">

    <div class="col-sm-3 col-md-3 user-details" style="margin-bottom: 6%;">
        <div class="user-image ">
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
                                " alt="" class="thumb1 thumb2 img-circle img-responsive">
        </div>
        <div class="text-center">
            <div class="">
                <h3 style="margin-bottom: -8px;"><?php echo $this->session->userdata('full_name');?></h3>
                        <span class="help-block small">
                            <?php
                            //                            var_dump($current_user);
                            if($current_user['branch_id']!=0){
                                echo " Currently you are assigned at ".make_me_bold($this->usuals->get_branch_name($current_user['branch_id']));
                            }
                            ?></span>
            </div>


        </div>

    </div>

    <div class="col-sm-8 col-md-8 col-lg-8 line-breaker">

        <!--        Password starts here-->
        <?php $data['dont_show']=true;
        $data['title']="Password";
        $this->load->view('includes/title',$data);
        ?>
        <div class="row">


            <div class="col-sm-12 col-md-12 user-details">


                    <div class="row">
                        <div class="col-md-12" style="margin-left: 16px;">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Change Password</h3>
                                </div>
                                <div class="panel-body pad-20">
                                 <form class="form-horizontal"  accept-charset="UTF-8" action="<?php echo base_url('welcome/change_pass'); ?>" method="post">
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



            </div>
        </div>

        <?php $data['dont_show']=true;
        $data['title']="Display Picture";
        $this->load->view('includes/title',$data);
        ?>

        <div class="row">


            <div class="col-sm-12 col-md-12 user-details">
                    <div class="row">
                        <div class="col-md-12" style="margin-left: 16px;">
                            <p class="text-muted small">Try putting a *squared picture , not a rectangle</p>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Change Display</h3>
                                </div>
                                <div class="panel-body pad-20">
                                    <form class="form-horizontal" action="<?php echo base_url('welcome/display_url'); ?>" method="post">
                                        <fieldset>
                                            <div class="form-group">
                                                <input class="form-control " placeholder="Paste URL for your picture" name="pic_url" type="text">
                                            </div>
                                            <div class="form-group"><input class="btn btn-lg btn-success btn-block" type="submit" value="Change Display"></div>
                                        </fieldset>
                                    </form>

                                </div>
                                <div class="panel-footer">
                                    <p class="text-muted small">*It will be squished if you provide a rectagled one</p>
                                    <p class="divider"></p>
                                    <p class="text-muted small">Direct linking with social medias is not supported unless its gravatar</p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>

        <!--        Password starts here-->
        <?php $data['dont_show']=true;
        $data['title']="Manage Branches";
        $this->load->view('includes/title',$data);
        ?>
        <div class="row">


            <div class="col-sm-12 col-md-12 user-details">


                <div class="row">
                    <div class="col-md-12" style="margin-left: 16px;">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Branches <span class="text-muted small pull-right pull-right-top-4">Click on the actions buttons to activate permissions</span></h3>
                            </div>
                            <div class="panel-body pad-20">
                                <div class="table-responsive">
                                    <table class="table table-striped  table-hover">
                                        <thead>
                                        <tr><th>Branch</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr></thead>
                                        <tbody>
                                <?php foreach($branches  as $branch){?>


                                            <tr>
                                                <td><?php echo $branch['name']?></td>
                                                <td><?php echo $branch['status']?></td>
                                                <td>
<!--                                                    <a data-toggle="tooltip" data-placement="top" title="Rename Branch" rel="info" href=""><i class="fa fa-edit"></i></a>-->
<!--                                                    <span class="text-muted small">-->
<!--                                                        (Not Available at the moment)-->
<!--                                                    </span>-->
                                                    <a data-toggle="tooltip" data-placement="left" title="Renames Branch" rel="info" href="<?php echo base_url('welcome/edit_branch').'/'.$branch['id'];?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit"></span> </a>
                                                    <a data-toggle="tooltip" data-placement="top" title="Make it Active" rel="info"  class='btn btn-info btn-xs' href="<?php echo base_url('welcome/edit_branch').'/'.$branch['id'];?>"><span class="glyphicon glyphicon-cloud"></span> </a>
                                                    <a data-toggle="tooltip" data-placement="right" title="Deactivate" rel="info" href="<?php echo base_url('welcome/edit_branch').'/'.$branch['id'];?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> </a>


                                                </td>
                                            </tr>


                                <?php }?>
                                        </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>





            </div>
        </div>

        <?php
        if($this->session->userdata("edit_branch")){?>
        <!--        Password starts here-->
        <?php $data['dont_show']=true;
        $data['title']=$this->usuals->get_branch_name($this->session->userdata("edit_branch"));
        $this->load->view('includes/title',$data);
        ?>

            <div class="row">


                <div class="col-sm-12 col-md-12 user-details">


                    <div class="row">
                        <div class="col-md-12" style="margin-left: 16px;">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Make Changes to <?php echo make_me_bold($this->usuals->get_branch_name($this->session->userdata("edit_branch")));?><span class="text-muted small pull-right pull-right-top-4">
                                            Currently the branch is <?php echo make_me_bold($this->usuals->get_branch_status($this->session->userdata("edit_branch")));?>
                                    </span></h3>
                                </div>
                                <div class="panel-body pad-20">
                                    <form class="form-horizontal" method="post"
                                          action="<?php echo base_url('welcome/change_branch_details');?>">

                                        <fieldset class="col-lg-6">
                                            <!-- Sign In Form -->
                                            <!-- Text input-->
                                            <div class="control-group">
                                                <label class="control-label" for="name">Branch Name</label>
                                                <div class="controls">
                                                    <input required="" id="name" name="name" type="text" class="form-control" placeholder="Name of the offer" class="input-medium" required="" value="<?php echo $this->usuals->get_branch_name($this->session->userdata("edit_branch"));?>">
                                                    <input required="" name="id" type="hidden" value="<?php echo $this->session->userdata("edit_branch");?>">
                                                </div>
                                            </div>


                                                    <div class="control-group">
                                                        <label>Status</label>
                                                        <select class='form-control' name='status'>
                                                            <?php

                                                            foreach($this->usuals->branch_status() as $row){
                                                                $status = $row;
                                                                if($this->usuals->get_branch_status($this->session->userdata("edit_branch"))==$status){
                                                                    echo "<option class='btn btn-lg' value='$status' selected>{$status}</option>";
                                                                }else{
                                                                    echo "<option class='btn btn-lg' value='$status' >{$status}</option>";
                                                                }

                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                            <!-- Button -->
                                            <div class="control-group">
                                                <label class="control-label" for="signin"></label>
                                                <div class="controls">
                                                    <button type="submit" id="fahad" name="basic" class="btn btn-success">Save</button>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>


        <?php }?>

        <?php
        if($this->session->userdata("add_branch")==false){?>
        <!--        Password starts here-->
        <?php $data['dont_show']=true;
        $data['title']="All Branch";
        $this->load->view('includes/title',$data);
        ?>

            <div class="row">


                <div class="col-sm-12 col-md-12 user-details">


                    <div class="row">
                        <div class="col-md-12" style="margin-left: 16px;">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Adding branch</h3>
                                </div>
                                <div class="panel-body pad-20">
                                    <form class="form-horizontal" method="post"
                                          action="<?php echo base_url('welcome/add_branch');?>">

                                        <fieldset class="col-lg-6">
                                            <!-- Sign In Form -->
                                            <!-- Text input-->
                                            <div class="control-group">
                                                <label class="control-label" for="name">Branch Name</label>
                                                <div class="controls">
                                                    <input required="" id="name" name="name" type="text" class="form-control" placeholder="Name of the offer" class="input-medium" required="" value="Name goes here!">
                                                    <input  name="fullname" type="hidden" value="<?php echo $this->session->userdata('full_name');?>">
                                                </div>
                                            </div>
                                            <!-- Button -->
                                            <div class="control-group">
                                                <label class="control-label" for="signin"></label>
                                                <div class="controls">
                                                    <button type="submit" id="fahad" name="basic" class="btn btn-success">Save</button>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>


        <?php }?>

    </div>
</div>






<!--<p class="lead">--><?php //echo $word_orignal;?><!--</p>-->
<!--<p class="lead">--><?php //echo $word_pass;?><!--</p>-->
