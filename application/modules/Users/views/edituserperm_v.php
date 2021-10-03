 <!--dynamic table-->
    <link href="<?php echo base_url()?>assets/assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
    <link href="<?php echo base_url()?>assets/assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/assets/data-tables/DT_bootstrap.css" />

    <style>
      ::-webkit-input-placeholder { /* Edge */
        color: red;
      }

      :-ms-input-placeholder { /* Internet Explorer */
        color: red;
      }

      ::placeholder {
        color: red;
      }
      .error li {
        color:red;
      }
    </style>
<!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
                  <li class="breadcrumb-item"><a href="javascript:;">भूमिका</a></li>
              </ol>
            </nav>
              <!-- page start-->
              <div class="row">
                <div class="col-sm-12">
                  <?php $success_message = $this->session->flashdata("MSG_SUCCESS");
                      if(!empty($success_message)) { ?>
                      <div class="alert alert-success">
                          <button class="close" data-close="alert"></button>
                          <span> <?php echo $success_message;?> </span>
                      </div>
                    <?php } ?>
              
                  <section class="card" style="margin-bottom: -25px;">
                    <header class="card-header">
                      <?php echo form_open('Users/EditUserPerm/'.$this->uri->segment(3), array('name'=>'EditUserPerm', 'id'=>'EditUserPerm', 'method'=>'post', 'class'=>'form-horizontal'));?>
                          <span class="tools pull-right">
                            <a href="javascript:;" id="saveperm_button" class="btn btn-info btn-sm " style="color:#FFF"><i class="fa fa-save"></i> Save</a>
                            <a href="<?php echo base_url()?>Users" id="cancel_button" class="btn btn-sm btn-danger " style="color:#FFF"><i class="fa fa-remove"></i> Cancel</a>
                          </span>
                    </header>
                    <div class="card-body">
                      <div class="adv-table">
                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                          <tbody>
                          <?php 
                            $user_id = $this->uri->segment(3);
                            $userpermissions = '';
                            $checkCount = 0;
                            $moduleCount = 0;
                            if (count($parentmodules->result()) > 0) {
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
                            if (count($qrymodules->result()) > 0) {
                                $countval = 1;
                                $userpermissions .= '<tr>';
                                foreach ($qrymodules->result() as $module_row):
                                    $userpermissions .= '
                                                <td>'. $module_row->menu_name . '</td>';
                                    $qryuseraction = $this->Usersmodel->listuseraction();
                                    if(count($qryuseraction->result()) > 0 ){                 
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

                     <?php $groupid = (isset($query->userid) && $query->userid!='')?$query->userid:''?>
                <?php echo form_input(array('type'=>'hidden','name'=>'ID', 'id'=>'ID','value'=>$groupid, 'class'=>'form-control', 'required'=>'required'));?>
                <?php echo form_input(array('type'=>'hidden','name'=>'Submit', 'id'=>'Submit','value'=>'Submit', 'class'=>'form-control', 'required'=>'required'));?>
                <?php echo form_close();?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </section>
                </div>
              </div>
              <!-- page end-->
          </section>
      </section>
    <script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/assets/data-tables/DT_bootstrap.js"></script>
  
  <script type="text/javascript">
    $('#save_button').on('click', function () {
        var changepassword = $('.changepassword').val();
        if(changepassword == 'Yes'){
            var password = $('#Password').val();
            var confirmpassword = $('#CPassword').val();
            if(password == confirmpassword){
                $('#Submit').click();
            }else{
                alert('Password and Confirm Password do not match. Please try again');
            }
        }else{
            $('#Submit').click();
        }
    });

    $('#cancel_button').on('click', function () {
        window.location.assign('<?php echo base_url()?>Users/ListAll');
    });
    $('#savegroup_button').on('click',function(){
        $('#AddGroup').submit();
    });
    $('#savegroupperm_button').on('click',function(){
        $('#EditGroupPerm').submit();
    });
    $('#saveperm_button').on('click',function(){
        $('#EditUserPerm').submit();
    });
    $('#cancelgroup_button').on('click', function () {
        window.location.assign('<?php echo base_url()?>Users/ListGroup');
    });
    $('.password , .cpassword').on('keyup',function(){
        $('.save_button').attr('disabled', 'disabled');
        var password = $('.password').val();
        var cpassword = $('.cpassword').val();
        if(password === cpassword)
        {
            $('.save_button').removeAttr('disabled');
        }
    });

    /* Ajax User Information */
    $('#Employee').on('change',function(){
        var employee = $(this).val();
        $.ajax({
            url: '<?php echo base_url()?>Users/GetEmployeeData',
            type: 'GET',
            data: {employee: employee},
            success : function(msg)
            {
                msgs = $.parseJSON(msg);
                var name = msgs.fullname;
                $('#Name').val(name);
                $('#Email').val(msgs.email);
            }
        });
        
    });

    $('.changepassword').on('click',function(){
        var checked = $('.changepassword:checked').val();
        console.log(checked);
        if(checked == 'No'){
            $('.changepasswordform').addClass('hidden');
        }
        else
        {
            $('.changepasswordform').removeClass('hidden');
        }
    });
     $('[data-id^="group-select-"]').on('click',function(){
        var type = $(this).data('type');
        var id = $(this).data('id');
        if(type=='all'){
            $('.'+id).prop('checked','checked');
        } else if(type=='none'){
            $('.'+id).prop('checked','');
        }
    });
    
    $('[data-id^="module-select-"]').on('click',function(){
        var type = $(this).data('type');
        var id = $(this).data('id');
        if(type=='all'){
            $('.'+id).prop('checked','checked');
        } else if(type=='none'){
            $('.'+id).prop('checked','');
        }
    });
</script>