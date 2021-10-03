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
                      <?php echo form_open('Groups/EditGroupPerm/'.$this->uri->segment(3), array('name'=>'EditGroupPerm', 'id'=>'EditGroupPerm', 'method'=>'post', 'class'=>'form-horizontal'));?>
                          <span class="tools pull-right">
                            <a href="javascript:;" id="savegroupperm_button" class="btn btn-sm btn-info " style="color:#fff"><i class="fa fa-save"></i> Save</a>
                            <a href="javascript:;" id="cancelgroup_button" class="btn btn btn-sm btn-danger" style="color: #fff"><i class="fa fa-remove"></i> Cancel</a>
                          </span>
                    </header>
                    <div class="card-body">
                      <div class="adv-table">
                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                          <tbody>
                          <?php 
                            $group_id = $this->uri->segment(3);
                            $grouppermissions = '';
                            $checkCount = 0;
                            $moduleCount = 0;
                            if (count($parentmodules->result()) > 0) {                        
                            $grouppermissions .= '<table cellpadding="5" cellspacing="0" border="0" width="100%" class="table table-striped table-hover">
                                <tbody>
                                <tr>
                                    <td colspan="100%" align="right"><a href="javascript:void(0);" data-id="group-select-all" data-type="all">All</a>&nbsp;<a href="javascript:void(0);" data-id="group-select-all" data-type="none">None</a></td>
                                </tr>';
                            $qrymodules = $this->Groupsmodel->listmodule();
                            if (count($qrymodules->result()) > 0) {
                                foreach ($qrymodules->result() as $module_row):
                                    $grouppermissions .= '<tr>';
                                    $grouppermissions .= '<td>'. $module_row->menu_name . '</td>';
                                    $qryuseraction = $this->Groupsmodel->listuseraction();
                                    if(count($qryuseraction->result()) > 0 ){                 
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
                          }
                          $grouppermissions .="</table>";
                          echo $grouppermissions;
                          ?>

                          <?php $groupid = (isset($query->groupid) && $query->groupid!='')?$query->groupid:''?>
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
        $('#Submit').click();
    });

    $('#cancel_button').on('click', function () {
        window.location.assign('<?php echo base_url()?>Groups/ListAll');
    });
    $('#savegroup_button').on('click',function(){
        if($("#FirstName").val() != ''){
        $('#AddGroup').submit();
        }else{
            alert("Role name should not be empty");
            $("#FirstName").focus();
        }
    });
    $('#savegroupperm_button').on('click',function(){
        $('#EditGroupPerm').submit();
    });
    $('#saveperm_button').on('click',function(){
        $('#EditUserPerm').submit();
    });
    $('#cancelgroup_button').on('click', function () {
        window.location.assign('<?php echo base_url()?>Groups/');
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
