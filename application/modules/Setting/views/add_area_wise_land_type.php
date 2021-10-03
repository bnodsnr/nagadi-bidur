
  <form action="<?php echo base_url()?>Setting/SaveAreaWiseLandType" method="post" class="form">
    <div class="form-group">
      <div class="col-md-12">
        <div class="form-group">
          <label>आर्थिक वर्ष<span style="color:red">*</span></label>
          <input type ="hidden" name = "id" value="<?php if(!empty($row['id'])){ echo $row['id'];}?>">
          <select class="form-control set_fiscal_year_frm" name="fiscal_year" id = "set_fiscal_year_frm">
            <option value="">आर्थिक वर्ष चयन गर्नुहोस्</option>
            <?php
              if(!empty($fiscal_year)) : 
                foreach ($fiscal_year as $key => $value) : ?>
                  <option value="<?php echo $value['year']?>" <?php if($value['year'] ==$this->session->userdata('add_fiscal_year')){ echo 'selected';} ?>><?php echo $value['year']?></option>
            <?php endforeach;endif?>
          </select>
        </div>
        <div class="form-group">
          <label>जग्गाको क्षेत्रगत किसिम<span style="color:red">*</span></label>
          <input type="text" class="form-control " placeholder="" name="land_area_type" required="required" value="<?php if(!empty($row['id'])){ echo $row['road_name'];} ?>">
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-primary btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" name="Submit" type="submit" value="Submit">सम्पादन गर्नुहोस्</button>
      <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" data-dismiss="modal">रद्द गर्नुहोस्</button>
    </div>
</form>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/customjs.js"></script>