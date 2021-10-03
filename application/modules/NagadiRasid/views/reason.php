<form action="<?php echo base_url()?>NagadiRasid/DeleteBill" method="post" class="form save_post">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
  <div class="form-group">
    <div class="col-md-12">
      <div class="form-group">
        <input type="hidden" name="id" value="<?php echo $bill_details['id']?>">
        <label>रशिद नं</label>
        <input type="number" class="form-control" placeholder=""  name="bill_no" required="required" value="<?php echo !empty($bill_details['bill_no']) ? $bill_details['bill_no']:''?>" readonly>
      </div>

      <div class="form-group">
        <label>मिति </label>
        <input type="text" name="date" class="form-control" value="<?php echo convertDate(date('Y-m-d'))?>" readonly>
        
        <div class="form-group">
          <label>कारण<span style="color:red">*</span></label>
          <textarea class="form-control" name="reason"></textarea>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary btn-xs save_btn" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" name="Submit" type="submit" value="Submit">सम्पादन गर्नुहोस्</button>
    <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" data-dismiss="modal">रद्द गर्नुहोस्</button>
  </div>
</form>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/customjs.js"></script>