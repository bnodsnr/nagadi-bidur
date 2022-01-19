<div class="valid_errors"></div>
<form action="<?php echo base_url()?>RajasowTitle/UpdateTopicNo" method="post" class="form save_post">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
  <div class="form-group">
    <div class="col-md-12">
       <input type="hidden" class="form-control" placeholder=""  name="id" value="<?php echo $row['id']?>">
      <div class="form-group">
      <div class="form-group">
       <label>शिर्षक नम्बर<span style="color:red">*</span></label>
       <select class="form-control" name="topic_no">
           <?php if(!empty($titles)) : foreach($titles as $title): ?>
           <option value="<?php echo $title['topic_id']?>" <?php if($title['topic_id'] == $row['topic_no']){ echo 'selected';}?>><?php echo $title['topic_name']?>(<?php echo $this->mylibrary->convertedcit($title['topic_id'])?>)</option>
           <?php endforeach;endif;?>
       </select>
      </div>

      <div class="form-group">
        <label> शिर्षक<span style="color:red">*</span></label>
        <input type="text" class="form-control" placeholder=""  name="" value="<?php echo $row['topic_title']?>" required="required" readonly>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary btn-xs save_btn" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" name="Submit" type="submit" value="Submit">सम्पादन गर्नुहोस्</button>
    <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" data-dismiss="modal">रद्द गर्नुहोस्</button>
  </div>
</form>