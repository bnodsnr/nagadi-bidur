<div class="valid_errors"></div>

<form action="<?php echo base_url()?>SampatiKarRasid/save" method="post" class="form save_post">

  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

  <div class="form-group">

    <div class="col-md-12">

      <div class="form-group">

        <label><b>रशिद नं </b></label>

       <input type="text" class="form-control" name="bill_no" value="<?php echo !empty($billdetails)? $billdetails['bill_no']:''?>" readonly>

       <input type="hidden" class="form-control" name="id" value="<?php echo !empty($billdetails)? $billdetails['id']:''?>" readonly>
        <input type="text" class="form-control" name="file_no" value="<?php echo !empty($billdetails)? $billdetails['nb_file_no']:''?>" readonly>
      </div>

      <div class="form-group">

        <label><b>रद्द गर्न कारण</b></label>

        <textarea class="form-control" name="reason"></textarea>

      </div>

    </div>

  </div>

  <div class="modal-footer">

    <button class="btn btn-primary btn-xs save_btn" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" name="Submit" type="submit" value="Submit">Save</button>

    <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" data-dismiss="modal">Close</button>

  </div>

</form>

<script type="text/javascript" src="<?php echo base_url()?>assets/js/customjs.js"></script>