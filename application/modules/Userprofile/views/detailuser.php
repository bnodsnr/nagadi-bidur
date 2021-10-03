<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> <?php echo $pagetitle;?></h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <?php echo form_open('Users/', array('name'=>'', 'id'=>'', 'method'=>'post', 'class'=>'form-horizontal'));?>
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="actions">
                            <a href="javascript:;" id="save_button" class="btn green save_button input-circle"><i class="fa fa-save"></i> Edit</a>
                            <a href="javascript:;" id="cancel_button" class="btn red input-circle"><i class="fa fa-remove"></i> Cancel</a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="UserRole" class="control-label col-md-4">Name</label>
                                    <div class="col-md-6 control-label">
                                        Sophiya			
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Username" class="control-label col-md-4">Username</label>
                                    <div class="col-md-6 control-label">
                                        Sophiya
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Group" class="control-label col-md-4">Group</label>
                                    <div class="col-md-6 control-label">
                                        dfghjk
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Email" class="control-label col-md-4">Email</label>
                                    <div class="col-md-6 control-label">
                                        xcvbnm,.
                                    </div>
                                </div><div class="form-group">
                                    <label for="Phone" class="control-label col-md-4">Phone</label>
                                    <div class="col-md-6 control-label">
                                        dfghjkl;
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