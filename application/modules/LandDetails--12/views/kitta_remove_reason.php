<div class="valid_errors"></div>

<form action="<?php echo base_url()?>LandDetails/savekittaKut" method="post" class="form save_post">

  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

  <div class="form-group">

    <div class="col-md-12">

      <div class="form-group">
       <input type="hidden" class="form-control" name="land_id" value="<?php echo !empty($landdetail)? $landdetail['id']:''?>" readonly>
       
       <input type="hidden" class="form-control" name="file_no" value="<?php echo !empty($landdetail)? $landdetail['ld_file_no']:''?>" readonly>
       
       <input type="hidden" class="form-control" name="kitta_no" value="<?php echo !empty($landdetail)? $landdetail['k_number']:''?>" readonly>
       
      </div>

      <div class="form-group">

        <label><b> कैफियत लेख्नुहोस </b></label>

        <textarea class="form-control" name="reason"></textarea>

      </div>

    </div>

  </div>

  <div class="modal-footer">

    <button class="btn btn-primary btn-xs save_btn" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" name="Submit" type="submit" value="Submit">Save</button>

    <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" data-dismiss="modal">पछाडी जानुहोस</button>

  </div>

</form>

<script type="text/javascript" src="<?php echo base_url()?>assets/js/customjs.js"></script>