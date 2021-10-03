 <?php echo form_open('Groups/UpdateGroup', array('name'=>'AddGroup', 'id'=>'AddGroup', 'method'=>'post', 'class'=>'form-horizontal'));?>
    <div class="form-group">
      <div class="col-md-12">
        <div class="form-group">
             <?php $groupid = (isset($query->groupid) && $query->groupid!='')?$query->groupid:''?>
            <?php echo form_input(array('type'=>'hidden','name'=>'ID', 'id'=>'ID','value'=>$groupid, 'class'=>'form-control', 'required'=>'required'));?>
          <label>भूमिका प्रकार<span style="color:red">*</span></label>
           <?php $group = (isset($query->group_name) && $query->group_name!='')?$query->group_name:''?>
            <?php echo form_input(array('name'=>'groupname', 'id'=>'FirstName', 'class'=>'form-control ','value'=>$group));?>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-primary btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" name="Submit" type="submit" value="Submit">सम्पादन गर्नुहोस्</button>
      <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" data-dismiss="modal">रद्द गर्नुहोस्</button>
    </div>
  <?php echo form_close();?>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/customjs.js"></script>