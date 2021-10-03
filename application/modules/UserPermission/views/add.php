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
                <?php echo form_open('UserPermission/Add', array('name'=>'AddEmpSchedule', 'id'=>'AddEmpSchedule', 'method'=>'post', 'class'=>'form-horizontal'));?>
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="actions">
                            <?php echo form_submit('Save','Save',array('class'=>'btn green'));?>
                            <?php echo anchor('UserPermission/ListAll', 'Cancel', array('class'=>'btn red'));?>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ApplicableWeekends" class="control-label col-md-5 row">Employees <span class="font-red"> * </span></label>
                                    <div class="col-md-7">
                                        <?php
                                        echo form_dropdown('employeeList[]', $employeedropdown, $employeedropdown, array('class'=>'bs-select form-control', 'required'=>'required', 'data-live-search'=>'true','title'=>'Select Employee(s)','multiple'=>'multiple'));?>
                                    </div>
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
