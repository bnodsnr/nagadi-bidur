<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <?php echo $breadcrumb;?>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> <?php echo $pagetitle;?></h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <?php echo form_open('Users/EditUser', array('name'=>'EditUser', 'id'=>'EditUser', 'method'=>'post', 'class'=>'form-horizontal'));?>
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="actions">
                            <a href="javascript:;" id="save_button" class="btn green save_button"><i class="fa fa-save"></i> Save</a>
                            <a href="javascript:;" id="cancel_button" class="btn red"><i class="fa fa-remove"></i> Cancel</a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="UserRole" class="control-label col-md-3">Role</label>
                                    <div class="col-md-9">
                                        <?php echo form_dropdown('role', $group,$query->user_group,array('id'=>'UserRole', 'class'=>'form-control ', 'required'=>'required'));?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Name" class="control-label col-md-3">Name</label>
                                    <div class="col-md-9">
                                    <?php $name = (isset($query->name) && $query->name!='')?$query->name:''?>
                                        <?php echo form_input(array('name'=>'name', 'id'=>'Name', 'class'=>'form-control ', 'value'=>$name));?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Name" class="control-label col-md-3">Name</label>
                                    <div class="col-md-9">
                                    <?php $name = (isset($query->name) && $query->name!='')?$query->name:''?>
                                        <?php echo form_input(array('name'=>'name', 'id'=>'Name', 'class'=>'form-control ', 'value'=>$name));?>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Email" class="control-label col-md-3">Email</label>
                                    <div class="col-md-9">
                                        <?php $email = (isset($query->email) && $query->email!='')?$query->email:''?>
                                        <?php echo form_input(array('name'=>'email', 'type'=>'email', 'id'=>'Email', 'class'=>'form-control ', 'required'=>'required','value'=>$email));?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Username" class="control-label col-md-3">Username</label>
                                    <div class="col-md-9">
                                    <?php $username = (isset($query->user_name) && $query->user_name!='')?$query->user_name:''?>
                                    <?php
                                    if($username != ''){
                                        echo form_input(array('name'=>'username', 'id'=>'Username', 'class'=>'form-control ', 'required'=>'required','readonly'=>'readonly','value'=>$username));
                                    }else{
                                        echo form_input(array('name'=>'username', 'id'=>'Username', 'class'=>'form-control ', 'required'=>'required','value'=>$username));
                                    }
                                    ?>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Username" class="control-label col-md-3">Username</label>
                                    <div class="col-md-9">
                                    <?php $username = (isset($query->user_name) && $query->user_name!='')?$query->user_name:''?>
                                    <?php
                                    if($username != ''){
                                        echo form_input(array('name'=>'username', 'id'=>'Username', 'class'=>'form-control ', 'required'=>'required','readonly'=>'readonly','value'=>$username));
                                    }else{
                                        echo form_input(array('name'=>'username', 'id'=>'Username', 'class'=>'form-control ', 'required'=>'required','value'=>$username));
                                    }
                                    ?>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="changepassword" class="control-label col-md-3">Change Password?</label>
                                    <div class="col-md-9">
                                    <?php echo form_input(array('type'=>'radio','name'=>'changepassword', 'id'=>'changepassword', 'class'=>'changepassword', 'required'=>'required','value'=>'Yes'))?>Yes
                                    <?php echo form_input(array('type'=>'radio','name'=>'changepassword', 'id'=>'changepassword', 'class'=>'changepassword', 'required'=>'required','value'=>'No','checked'=>'checked'))?>No
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row changepasswordform hidden">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Password" class="control-label col-md-3">Password</label>
                                    <div class="col-md-9">
                                        <?php echo form_password(array('name'=>'password', 'id'=>'Password', 'class'=>'form-control password '));?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="CPassword" class="control-label col-md-3">Confirm Password</label>
                                    <div class="col-md-9">
                                        <?php echo form_password(array('name'=>'cpassword', 'id'=>'CPassword', 'class'=>'form-control cpassword '));?>
                                        <?php echo form_input(array('type'=>'submit','name'=>'Submit', 'id'=>'Submit','value'=>'Submit', 'class'=>'form-control hidden', 'required'=>'required'));?>
                                        <?php echo form_input(array('type'=>'hidden','name'=>'UserID', 'id'=>'UserID','value'=>$this->uri->segment(3), 'class'=>'form-control ', 'required'=>'required'));?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->