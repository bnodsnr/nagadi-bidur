<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">Blank Page</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Page Layouts</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> <?php echo $pagetitle;?></h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <?php echo form_open('Groups/EditGroupPerm/'.$this->uri->segment(3), array('name'=>'EditGroupPerm', 'id'=>'EditGroupPerm', 'method'=>'post', 'class'=>'form-horizontal'));?>
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="actions">
                            <a href="javascript:;" id="savegroupperm_button" class="btn green"><i class="fa fa-save"></i> Save</a>
                            <a href="javascript:;" id="cancelgroup_button" class="btn red "><i class="fa fa-remove"></i> Cancel</a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row pre-scrollable">
                    <?php 
                            $group_id = $this->uri->segment(3);
                            $grouppermissions = '';
                            $checkCount = 0;
                            $moduleCount = 0;
                            if (count($parentmodules) > 0) {                        
                            $grouppermissions .= '<table cellpadding="5" cellspacing="0" border="0" width="100%" class="table table-striped table-hover">
                                <tbody>
                                <tr>
                                    <td colspan="100%" align="right"><a href="javascript:void(0);" data-id="group-select-all" data-type="all">All</a>&nbsp;<a href="javascript:void(0);" data-id="group-select-all" data-type="none">None</a></td>
                                </tr>';
                        // foreach ($parentmodules->result() as $parent_module_row):
                            //---------------------For Parent Menu Access---------------------------------                      
                            // $grouppermissions .= '<td><strong>'. $parent_module_row->menu_name . '</strong></td>';    
                            // $permission = $this->Groupsmodel->checkgroup_permision($parent_module_row->menuid,1, $group_id);
                            // $checkbox_id = $parent_module_row->menuid ."_1";
                            // if($permission)
                            //     $checked = "checked";
                            // else
                            //     $checked = "";
                            
                            // $checkbox = form_input(array('type'=>'checkbox','name'=>'chk_permission[]', 'id'=>'chk_permission', 'value'=> $checkbox_id, $checked=>$checked, 'class'=>'group-select-all group-select-"'.$checkCount.'"'));
                            
                            // $cK = 'group-select-'.$checkCount;
                            // $grouppermissions .= '<td colspan="4">Access&nbsp;&nbsp;' . $checkbox . '</td> <td align="right"><a data-id="'.$cK.'" data-type="all" href="javascript:void(0);"><strong>All</strong></a>&nbsp;<a data-id="'.$cK.'" data-type="none" href="javascript:void(0);"><strong>None</strong></a></td>';
                            // $grouppermissions .= '</tr>';   
                            //---------------------End Parent Menu Access---------------------------------
                            
                            $qrymodules = $this->Groupsmodel->listmodule();
                            if (count($qrymodules) > 0) {
                                foreach ($qrymodules->result() as $module_row):
                                    $grouppermissions .= '<tr>';
                                    $grouppermissions .= '<td>'. $module_row->menu_name . '</td>';
                                    $qryuseraction = $this->Groupsmodel->listuseraction();
                                    if(count($qryuseraction) > 0 ){                 
                                        foreach ($qryuseraction->result() as $action_row):
                                            $permission = $this->Groupsmodel->checkgroup_permision($module_row->menuid,$action_row->user_action_id,$group_id);
                                            $checkbox_id = $module_row->menuid ."_". $action_row->user_action_id;
                                            if($permission)
                                                $checked = "checked";
                                            else
                                                $checked = "";
                                            $class = 'group-select-all group-select-'.$checkCount.' module-select-'.$moduleCount;
                                             $checkbox = form_input(array('type'=>'checkbox','name'=>'chk_permission[]', 'id'=>'chk_permission', 'value'=> $checkbox_id, $checked=>$checked,  'class'=>$class));
                                            $grouppermissions .= '<td>'.  $action_row->user_action_name. '&nbsp;&nbsp;' . $checkbox . '</td>';
                                        endforeach;
                                    }
                                    $mk = 'module-select-'.$moduleCount;
                                    $grouppermissions .= '<td align="right"><a data-id="'.$mk.'" data-type="all" href="javascript:void(0);">All</a>&nbsp;<a data-id="'.$mk.'" href="javascript:void(0);" data-type="none">None</a></td>';
                                    $moduleCount++;
                                endforeach; 
                            }
                            $checkCount++;
                            $grouppermissions .='</tbody>';
                         // endforeach ;
                        }
                        $grouppermissions .="</table>";
                        echo $grouppermissions;
                        ?>
                        </div>
                    </div>
                </div>
                <?php $groupid = (isset($query->groupid) && $query->groupid!='')?$query->groupid:''?>
                <?php echo form_input(array('type'=>'hidden','name'=>'ID', 'id'=>'ID','value'=>$groupid, 'class'=>'form-control', 'required'=>'required'));?>
                <?php echo form_input(array('type'=>'hidden','name'=>'Submit', 'id'=>'Submit','value'=>'Submit', 'class'=>'form-control', 'required'=>'required'));?>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->