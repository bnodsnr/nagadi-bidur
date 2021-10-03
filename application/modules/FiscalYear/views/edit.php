<div class="valid_errors"></div>
<form action="<?php echo base_url()?>FiscalYear/Update" method="post" class="form save_post">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
  <div class="form-group">
    <div class="col-md-12">
       <input type="hidden" class="form-control" placeholder=""  name="id" value="<?php echo $row['id']?>">
      <div class="form-group">
        <label>आर्थिक वर्ष <span style="color:red">*</span></label>
        <input type="text" class="form-control" placeholder=""  name="year" value="<?php echo $row['year']?>" required="required">
      </div>
      <div class="form-group">
       <label><b>यदि चालू हो भने?</b></label>
        <input class="form-check-input" value = "1" type="checkbox" id="gridCheck1" name="is_current" style="margin-left: 5px;" <?php if($row['is_current'] == 1){ echo 'checked';} ?>>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary btn-xs save_btn" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" name="Submit" type="submit" value="Submit">सम्पादन गर्नुहोस्</button>
    <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" data-dismiss="modal">रद्द गर्नुहोस्</button>
  </div>
</form>