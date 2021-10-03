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
                <?php echo form_open('Users/EditUserPerm/'.$this->uri->segment(3), array('name'=>'EditUserPerm', 'id'=>'EditUserPerm', 'method'=>'post', 'class'=>'form-horizontal'));?>
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="actions">
                            <a href="javascript:;" id="saveperm_button" class="btn green "><i class="fa fa-save"></i> Save</a>
                            <a href="javascript:;" id="cancel_button" class="btn red "><i class="fa fa-remove"></i> Cancel</a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row pre-scrollable">
                    <?php 
                        $user_id = $this->uri->segment(3);
                        $userpermissions = '';
                        $checkCount = 0;
                        $moduleCount = 0;
                        if (count($parentmodules) > 0) {
                            //---------------------Start Parent Menu Access---------------------------------    
                            $userpermissions .= '<table cellpadding="5" cellspacing="0" border="0" width="100%" class="table table-striped table-hover">
                                <tbody>
                                <tr>
                                    <td colspan="100%" align="right"><a href="javascript:void(0);" data-id="group-select-all" data-type="all">All</a>&nbsp;<a href="javascript:void(0);" data-id="group-select-all" data-type="none">None</a></td>
                                </tr>';
                        foreach ($parentmodules->result() as $parent_module_rows => $parent_module_row ):
                            if($parent_module_rows>0){
                                break;
                            }
                            $userpermissions .= '<tr>';
                            $userpermissions .= '<td><strong>'. $parent_module_row->menu_name . '</strong></td>';                 
                            $userpermission = $this->Usersmodel->checkuser_perm($parent_module_row->menuid, 1, $user_id);
                            $checkbox_id = $parent_module_row->menuid ."_1";
                            if($userpermission)
                                $checked = "checked";
                            else
                                $checked = "";
                            
                            $grouppermission = $this->Usersmodel->checkgroup_permision($parent_module_row->menuid, 1, $group_id);
                            if($grouppermission)
                                $permitted = '<span class="glyphicon glyphicon-ok-sign" data-toggle="tooltip" title="Published"></span>';
                            else
                                $permitted = '<span class="glyphicon glyphicon-remove-sign" data-toggle="tooltip" title="Unpublished"></span>';
                            $class = 'group-select-all group-select-'.$checkCount.'';
                            $checkbox = form_input(array('type'=>'checkbox','name'=>'chk_permission[]', 'id'=>'chk_permission', 'value'=> $checkbox_id, $checked=>$checked, 'class'=>$class));
                            $ck = 'group-select-'.$checkCount;
                            $userpermissions .= '<td colspan="4">'. $permitted . '&nbsp;&nbsp;Access&nbsp;&nbsp;' .$checkbox .'</td><td align="right"><a data-id="'.$ck.'" data-type="all" href="javascript:void(0);"><strong>All</strong></a>&nbsp;<a data-id="'.$ck.'" data-type="none" href="javascript:void(0);"><strong>None</strong></a></td>';
                            //---------------------End Parent Menu Access---------------------------------
                            
                            $qrymodules = $this->Usersmodel->listmodule($parent_module_row->menuid);
                            if (count($qrymodules) > 0) {
                                $countval = 1;
                                $userpermissions .= '<tr>';
                                foreach ($qrymodules->result() as $module_row):
                                    $userpermissions .= '
                                                <td>'. $module_row->menu_name . '</td>';
                                    $qryuseraction = $this->Usersmodel->listuseraction();
                                    if(count($qryuseraction) > 0 ){                 
                                        foreach ($qryuseraction->result() as $action_row):
                                            $userpermission = $this->Usersmodel->checkuser_perm($module_row->menuid, $action_row->user_action_id, $user_id);
                                            $checkbox_id = $module_row->menuid ."_". $action_row->user_action_id;
                                            if($userpermission)
                                                $checked = "checked";
                                            else
                                                $checked = "";
                                            
                                            $grouppermission = $this->Usersmodel->checkgroup_permision($module_row->menuid, $action_row->user_action_id, $group_id);
                                            if($grouppermission)
                                                $permitted = '<span class="glyphicon glyphicon-ok-sign" data-toggle="tooltip" title="Published"></span>';
                                            else
                                                $permitted = '<span class="glyphicon glyphicon-remove-sign" data-toggle="tooltip" title="Unpublished"></span>';
                                            $class = 'group-select-all group-select-'.$checkCount.' module-select-'.$moduleCount;
                                            $checkbox = form_input(array('type'=>'checkbox','name'=>'chk_permission[]', 'id'=>'chk_permission', 'value'=> $checkbox_id, $checked=>$checked , 'class'=>$class));

                                            $userpermissions .= '<td>'. $permitted . '&nbsp;&nbsp;' .  $action_row->user_action_name. '&nbsp;&nbsp;' .$checkbox .'</td>';
                                        endforeach;
                                    }
                                    $mk = 'module-select-'.$moduleCount;
                                    $userpermissions .= '<td align="right"><a data-id="'.$mk.'" data-type="all" href="javascript:void(0);">All</a>&nbsp;<a data-id="'.$mk.'" data-type="none" href="javascript:void(0);">None</a></td>';
                                    $userpermissions .= '</tr>';
                                    $moduleCount++; 
                                endforeach;     
                            } 
                            $countval++;
                            $checkCount++;
                            $userpermissions .="</tbody>";
                        endforeach;
                            $userpermissions .="</table>";
                        }
                        echo $userpermissions;
                    ?>
                        </div>
                    </div>
                </div>
                <?php $groupid = (isset($query->userid) && $query->userid!='')?$query->userid:''?>
                <?php echo form_input(array('type'=>'hidden','name'=>'ID', 'id'=>'ID','value'=>$groupid, 'class'=>'form-control', 'required'=>'required'));?>
                <?php echo form_input(array('type'=>'hidden','name'=>'Submit', 'id'=>'Submit','value'=>'Submit', 'class'=>'form-control', 'required'=>'required'));?>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->