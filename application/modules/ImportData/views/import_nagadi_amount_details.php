<form action="<?php echo base_url()?>ImportData/SaveNagadiAmountDetails" method="post" class="form" enctype="multipart/form-data">
    <div class="form-group">
      <div class="col-md-12">
        <div class="form-group">
          <label>फाइल चयन गर्नुहोस्<span style="color:red">*</span></label>
          <input type="file" class="form-control" name="userfile" required="required">
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-primary btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" name="Submit" type="submit" value="Submit">सम्पादन गर्नुहोस्</button>
      <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" data-dismiss="modal">रद्द गर्नुहोस्</button>
    </div>
</form>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/customjs.js"></script>