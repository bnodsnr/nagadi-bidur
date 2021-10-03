  <form action="<?php echo base_url()?>LandAreaType/SaveAreaWiseLandType" method="post" class="form save_post">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
    <div class="form-group">
      <div class="col-md-12">
        <div class="form-group">
          <label>आर्थिक वर्ष<span style="color:red">*</span></label>
          <input type ="hidden" name = "id" value="<?php if(!empty($row['id'])){ echo $row['id'];}?>">
          <input type="text" class="form-control" placeholder=""  name="fiscal_year" value="<?php echo !empty(current_fiscal_year())?current_fiscal_year():''?>" required="required" readonly>
        </div>
        <?php if(MODULE == 2) { ?>
          <div class="form-group">
            <label>जग्गाको वर्गिकरण<span style="color:red">*</span></label>
            <input type ="hidden" name = "id" value="<?php if(!empty($row['id'])){ echo $row['id'];}?>">
            
          </div>
        <?php } ?>
        <div class="form-group">
          <label>जग्गाको क्षेत्रगत किसिम<span style="color:red">*</span></label>
          <input type="text" class="form-control " placeholder="" name="land_area_type" required="required" value="<?php if(!empty($row['id'])){ echo $row['road_name'];} ?>">
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-primary btn-xs save_btn" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" name="Submit" type="submit" value="Submit">सेभ गर्नुहोस्</button>
      <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" data-dismiss="modal">रद्द गर्नुहोस्</button>
    </div>
</form>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/customjs.js"></script>