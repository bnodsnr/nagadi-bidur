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
                <?php echo form_open_multipart('AssignLeaves/Edit/'.$this->uri->Segment(3), array('name'=>'EditCompany', 'id'=>'Edit Company', 'method'=>'post', 'class'=>'form-horizontal'));?>
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="actions">
                            <?php echo form_hidden('id', $this->uri->Segment(3));?>
                            <?php echo form_submit('Save','Save',array('class'=>'btn green'));?>
                            <?php echo anchor('AssignLeaves/ListAll', 'Cancel', array('class'=>'btn red'));?>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <table class="table table-striped table-hover table-checkable" id="leaveedit">
                                <thead>
                                    <tr>
                                        <td colspan="2" style="text-align:left !important; margin-left:5px !important">Employee</td>
                                        <td><?php 
                                        $datalist='';
                                        $count ='1';
                                        $ids =array();
                                        $leaveid = array();
                                        foreach($query->result() as $row){
                                        if($count==1){
                                            echo $row->fullname;
                                      ?>
                                    </td>
                                    </tr>
                                    <tr role="row" class="heading">
                                        <td width="2%"><input type="checkbox" name="all" id="checkall" ></td>
                                        <td width="50%">Leave Type</td>
                                        <td>Days</td> 
                                    </tr>
                                </thead>
                                <?php   
                                    }
                                    $count++;

                                ?>
                                <tbody>
                            <?php 
                                        $checked = ($row->dIsActive=="Active")?"checked":"";
                                        $value   = ($checked=="checked")?"Active":"InActive";
                                        $datalist .= '<tr>
                                                        <input type="hidden" name="LeaveID[]" value="'.$row->aID.'"/>
                                                        <td><input type="checkbox" name="IsActive[]" class="IsActive" value="InActive" '. $checked.' />
                                                        <input type="hidden" name="Active[]" class="Active" value="'.$value.'"/></td>
                                                        <td>'.$row->LeaveType.'</td>
                                                        <td><input type="text" class="form-control" name="LeaveDays[]" value="'. $row->LeaveDays .'"></td>                                  
                                                      </tr>';
                                        array_push($ids,$row->aID);
                                }
                                foreach($leaves->result() as $leave){
                                    array_push($leaveid, $leave->ID);
                                }
                                $newids = array_diff($leaveid, $ids);
                                foreach($newids as $newid){
                                    $data = $this->assignleavesmodel->ListWhere($newid)->row();
                                    $datalist .= '<tr>
                                                        <input type="hidden" name="LeaveID[]" value="'.$data->ID.'"/>
                                                        <td><input type="checkbox" name="IsActive[]" class="IsActive" value="InActive" />
                                                        <input type="hidden" name="Active[]" class="Active" value="InActive"/></td>
                                                        <td>'.$data->LeaveType.'</td>
                                                        <td><input type="text" class="form-control" name="LeaveDays[]" value="'. $data->LeaveDays .'"></td>                                  
                                                      </tr>';
                                }
                                echo $datalist;
                            ?>
                                </tbody>
                            </table>
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