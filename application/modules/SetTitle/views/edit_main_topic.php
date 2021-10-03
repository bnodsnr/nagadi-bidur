<form action="<?php echo base_url()?>SetTitle/updateMainTopic" method="post" class="form save_post">
     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
  <div class="form-group">
    <div class="col-md-12">
      <div class="form-group">
        <input type="hidden" class="form-control" placeholder=""  name="id" required="required" value="<?php echo !empty($row['id']) ? $row['id']:''?>">
        <label>आर्थिक वर्ष<span style="color:red">*</span></label>
        <select class="form-control set_fiscal_year_frm" name="fiscal_year" id = "set_fiscal_year_frm">
          <option value="">आर्थिक वर्ष चयन गर्नुहोस्</option>
          <?php
          if(!empty($fiscal_year)) : 
            foreach ($fiscal_year as $key => $value) : ?>
              <option value="<?php echo $value['year']?>" <?php if($value['year'] =$row['fiscal_year']){ echo 'selected';}?>><?php echo $value['year']?></option>
            <?php endforeach;endif?>
          </select>
      </div>

      <div class="form-group">
        <label>मुख्य शिर्षक नं<span style="color:red">*</span></label>
        <input type="number" class="form-control" placeholder=""  name="topic_no" required="required" value="<?php echo !empty($row['topic_no']) ? $row['topic_no']:''?>">
      </div>

      <div class="form-group">
        <label>मुख्य शिर्षक <span style="color:red">*</span></label>
        <input type="text" class="form-control" placeholder=""  name="topic_name" required="required" value="<?php echo !empty($row['topic_name']) ? $row['topic_name']:''?>">
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary btn-xs save_btn" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" name="Submit" type="submit" value="Submit">सम्पादन गर्नुहोस्</button>
    <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" data-dismiss="modal">रद्द गर्नुहोस्</button>
  </div>
</form>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/customjs.js"></script>