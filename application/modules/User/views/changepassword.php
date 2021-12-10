<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <?php //echo $breadcrumb;
            ?>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> <?php echo $pagetitle; ?></h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <?php
                $success_message = $this->session->flashdata('MSG_SUC_ADD');
                if (!empty($success_message)) : ?>
                    <div class="alert alert-success">
                        <button class="close" data-close="alert"></button>
                        <span> <?php echo $success_message; ?> </span>
                    </div>
                <?php endif; ?>
                <?php
                $err_message = $this->session->flashdata('MSG_ERROR');
                if (!empty($err_message)) : ?>
                    <div class="alert alert-danger">
                        <button class="close" data-close="alert"></button>
                        <span> <?php echo $err_message; ?> </span>
                    </div>
                <?php endif; ?>
                <?php echo form_open('User/ChangePassword', array('name' => 'AddUser', 'id' => 'AddUser', 'method' => 'post', 'class' => 'form-horizontal')); ?>
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="actions">
                            <a href="javascript:;" id="save_button" class="btn save_button green input-circle"><i class="fa fa-save"></i> Save</a>
                            <a href="<?php echo base_url('Customer'); ?>" id="cancel_button" class="btn red input-circle"><i class="fa fa-remove"></i> Cancel</a>
                        </div>
                    </div>
                    <div class="portlet-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Password" class="control-label col-md-3">Current Password</label>
                                    <div class="col-md-9">
                                        <?php echo form_password(array('name' => 'Oldpassword', 'id' => 'OldPassword', 'class' => 'form-control oldpassword input-circle', 'required' => 'required')); ?>

                                        <?php echo form_password(array('name' => 'Currpassword', 'id' => 'CurrPassword', 'class' => 'form-control currpassword hidden', 'value' => $password)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Password" class="control-label col-md-3">New Password</label>
                                    <div class="col-md-9">
                                        <?php echo form_password(array('name' => 'password', 'id' => 'Password', 'class' => 'form-control password input-circle', 'required' => 'required')); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="CPassword" class="control-label col-md-3">Confirm New Password</label>
                                    <div class="col-md-9">
                                        <?php echo form_password(array('name' => 'cpassword', 'id' => 'CPassword', 'class' => 'form-control cpassword input-circle', 'required' => 'required')); ?>
                                        <?php echo form_input(array('type' => 'submit', 'name' => 'Submit', 'id' => 'Submit', 'value' => 'Submit', 'class' => 'form-control hidden', 'required' => 'required')); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->