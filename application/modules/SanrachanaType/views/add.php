<div class="valid_errors"></div>
<form action="<?php echo base_url()?>SanrachanaType/Save" method="post" class="form save_post">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
  <input type="hidden" name="id" value="<?php echo !empty($row)?$row['id']:''?>">
  <div class="form-group">

    <div class="col-md-12">
      <div class="form-group">
       <label><b>आर्थिक वर्ष</b></label>
         <input type="text" class="form-control" placeholder=""  name="fiscal_year" value="<?php echo !empty(current_fiscal_year())?current_fiscal_year():''?>" required="required" readonly>
      </div>
    </div>


    <div class="col-md-12">
      <div class="form-group">
       <label><b>प्रकार</b></label>
         <input type="text" class="form-control" placeholder=""  name="architect_type" value="<?php echo !empty($row)?$row['architect_type']:''?>" required="required">
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary btn-xs save_btn" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" name="Submit" type="submit" value="Submit">सेभ गर्नुहोस्</button>
    <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" data-dismiss="modal">रद्द गर्नुहोस्</button>
  </div>
</form>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/customjs.js"></script>