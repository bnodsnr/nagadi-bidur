  <form action="<?php echo base_url()?>PresentOld/Save" method="post" class="form save_post">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
    <input type="hidden" name="id" value="<?php if(!empty($row)){echo $row['id'];}?>">
    <div class="form-group">
      <div class="col-md-12">
        <div class="form-group">
          <label>साबिक गा.पा/न.पा<span style="color:red">*</span></label>
          <!--<input type="text" class="form-control " placeholder="" name="old_name" required="required" value="<?php //if(!empty($row['id'])){ echo $row['old_name'];} ?>">-->
          <select name = "old_name" class="form-control" required>
              <option value ="">छान्नुहोस्</option>
              <?php if(!empty($old_ward)) :foreach($old_ward as $ow):?><option value="<?php echo $ow['old_name']?>" 
              <?php if(!empty($row)) { 
                  if($row['old_name'] == $ow['old_name']){
                      echo 'selected';
                  }
              }
              
              ?>><?php echo $ow['old_name']?></option><?php  endforeach;endif;?>
          </select>
        </div>

        <div class="form-group">
          <label>साबिक वडा नं<span style="color:red">*</span></label>
          <input type="number" class="form-control " placeholder="" name="old_ward" required="required" value="<?php if(!empty($row['id'])){ echo $row['old_ward'];} ?>">
        </div>

        <div class="form-group">
          <label>हाल गा.पा/न.पा<span style="color:red">*</span></label>
          <input type="text" class="form-control " placeholder="" name="present_name" required="required" value="<?php if(!empty($row['id'])){ echo $row['present_name'];} else{echo 'विदुर';} ?>" readonly>
        </div>

        <div class="form-group">
          <label>हाल वडा नं<span style="color:red">*</span></label>
          <input type="number" class="form-control " placeholder="" name="present_ward" required="required" value="<?php if(!empty($row['id'])){ echo $row['present_ward'];} ?>">
        </div>

      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-primary btn-xs save_btn" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" name="Submit" type="submit" value="Submit">सम्पादन गर्नुहोस्</button>
      <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" data-dismiss="modal">रद्द गर्नुहोस्</button>
    </div>
</form>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/customjs.js"></script>