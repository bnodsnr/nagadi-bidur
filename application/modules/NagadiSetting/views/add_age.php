<form action="<?php echo base_url()?>DeteriorationStructure/saveAge" method="post" class="form save_post">
  <div class="form-group">
    <div class="col-md-12">
      <div class="form-group">
        <label>देखि<span style="color:red">*</span></label>
        <input type="text" class="form-control " placeholder="" name="from_range" required="required" value="">
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-12">
      <div class="form-group">
        <label>सम्म<span style="color:red">*</span></label>
        <input type="text" class="form-control " placeholder="" name="to_range" required="required" value="">
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" name="Submit" type="submit" value="Submit">सम्पादन गर्नुहोस्</button>
    <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" data-dismiss="modal">रद्द गर्नुहोस्</button>
  </div>
</form>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/customjs.js"></script>