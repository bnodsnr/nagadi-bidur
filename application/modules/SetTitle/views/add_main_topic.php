<form action="<?php echo base_url()?>SetTitle/saveMainTitle" method="post" class="form save_post">
     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
  <div class="form-group">
    <div class="col-md-12">
      <div class="form-group">
        <label>आर्थिक वर्ष<span style="color:red">*</span></label>
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
        <label>मुख्य शिर्षक नं<span style="color:red">*</span></label>
        <input type="number" class="form-control" placeholder=""  name="topic_no" required="required" value="">
      </div>

      <div class="form-group">
        <label>मुख्य शिर्षक <span style="color:red">*</span></label>
        <input type="text" class="form-control" placeholder=""  name="topic_name" required="required" value="">
      </div>
    </div>

  </div>
  <div class="modal-footer">
    <button class="btn btn-primary btn-xs save_btn" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" name="Submit" type="submit" value="Submit">सम्पादन गर्नुहोस्</button>
    <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" data-dismiss="modal">रद्द गर्नुहोस्</button>
  </div>
</form>

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click', '.btnAddTopic', function(){
       //add new row
      $('.btnAddTopic').click(function() {
       //e.preventDefault();
        var trOneNew = $('.nagadi_rasid_frm').length+1;
        var new_row = 
        '<tr>'+
        '<input type="text" name="topic_name[]" value="" class="form-control" required>'+
        '</td>'+
        '<td><button type="button" class="btn btn-danger btn-sm remove-row-topic" data-toggle="tooltip" title="हटाउनुहोस्"><span class="fa fa-times" tabindex="-1"></span></button></td>'+
        '<tr>';
        $("#add_new_subtopic").append(new_row);
        $('.main_topics-').select2();
      });
      $("body").on("click",".remove-row-topic", function(e){
        e.preventDefault();
        
        if (confirm('के तपाइँ  यसलाई हटाउन निश्चित हुनुहुन्छ ?')) {
         var amt = $(this).closest("tr").find('.topic_rate').val();
         var t_amt = $('#t_total').val();
         var new_amt = t_amt-amt;
         $("#t_total").val(new_amt);
         $(this).parent().parent().remove();
        }
      });
    });
  });
</script>