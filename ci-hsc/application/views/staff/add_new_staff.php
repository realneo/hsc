<div class="row">
    <div class="col-lg-4">
        <form action="<?php echo base_url().'staff/add_new_staff'?>" method='post'>
            <div class="form-group col-lg-6">
                <label>First Name</label>
                <input class="form-control" type="text" name="first_name" value=""/>
            </div>

            <div class="form-group col-lg-6">
                <label>Last Name</label>
                <input class="form-control" type="text" name="last_name" value=""/>
            </div>
            <div class="form-group col-lg-6">
                <label>Gender</label><?php// var_dump($gender);?>
                <select class='form-control' name='gender_type'>
                    <?php

                    foreach($gender as $row){
                        $gender = $row;

                        echo "<option value='$gender'>{$gender}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group col-lg-12">
                <label>Authorisation Type</label>
                <select class='form-control' name='auth_type'>
                    <?php

                    foreach($auth_type as $row){
                        $auth_type_id = $row['id'];
                        $auth_type_name = $row['name'];

                        echo "<option value='$auth_type_id'>{$auth_type_name}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group col-lg-12">
                <label>Email</label>
                <input class="form-control" type="email" name="email" value=""/>
            </div>

            <div class="form-group col-lg-12">
                <label>password</label>
                <input class="form-control" type="password" name="password" value=""/>
            </div>

            <div class="form-group col-lg-12">
                <button class="form-control btn btn-primary">Add New Staff</button>
            </div>
        </form>
    </div>
</div>