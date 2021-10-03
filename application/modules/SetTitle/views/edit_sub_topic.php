<form action="<?php echo base_url()?>SetTitle/updateSubTopicTitle" method="post" class="form save_post">
     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
  <div class="form-group">
      <div class="col-md-12">
          <input type="hidden" class="form-control" placeholder=""  name="id" required="required" value="<?php echo !empty($row['id']) ? $row['id']:''?>">
          <div class="form-group">
             <select class="form-control main_topic" name="main_topic">
              <option></option>
               <?php if(!empty($main_topic)) :
                foreach($main_topic as $key => $val) : ?>
                  <option value ="<?php echo $val['id']?>" <?php if($val['id'] == $row['main_topic']){ echo 'selected';}?>><?php echo $val['topic_name']?></option>
                <?php endforeach; endif;?>
             </select>
          </div>

          <div class="form-group">
            <label>मुख्य शिर्षक <span style="color:red">*</span></label>
            <input type="text" class="form-control" placeholder=""  name="topic_name" required="required" value="<?php echo !empty($row['sub_topic']) ? $row['sub_topic']:''?>">
          </div>

           <div class="form-group">
            <label>शिर्षक नं  <span style="color:red">*</span></label>
            <input type="text" class="form-control" placeholder=""  name="topic_no" required="required" value="<?php echo !empty($row['topic_no']) ? $row['topic_no']:''?>">
          </div>

      </div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary btn-xs save_btn" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" name="Submit" type="submit" value="Submit">सम्पादन गर्नुहोस्</button>
    <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" data-dismiss="modal">रद्द गर्नुहोस्</button>
  </div>
</form>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/customjs.js"></script>