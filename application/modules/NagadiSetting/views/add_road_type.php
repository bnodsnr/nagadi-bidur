  <form action="<?php echo base_url()?>Road/saveRoadType" method="post" class="save_post">
    <table class="table" id="add_new_fields" >
      <thead style="">
        <tr>
          <th>आर्थिक वर्ष</th>
          <th>रोडको किसिम</th>
          <!-- <th>रोडको दर</th> -->
          
        </tr>
      </thead>
      <tbody>
        <tr class="sampati_kar_add" id="sampati_kar_add_1" data-id="1">
         <td style="width: 155px;">
            <select class="form-control" name="fiscal_year" id = "set_fiscal_year">
              <option value="">आर्थिक वर्ष चयन गर्नुहोस्</option>
              <?php
              if(!empty($fiscal_year)) : 
                foreach ($fiscal_year as $key => $value) :?>
                  <option value="<?php echo $value['year']?>"><?php echo $value['year']?></option>
                <?php endforeach;endif?>
              </select>
          </td>
          <td>
            <input type="text" name="road_type" class="form-control"  placeholder="*रोडको किसिम" required="required" value="" >
            <span class="err_message"></span>
          </td>
          <!-- <td>
            <input type="text" name="to" class="form-control"  placeholder="*रोडको दर" required="required" value="">
            <span class="err_message"></span>
          </td> -->
        </tr>
     </tbody>
   </table>
 <div class="modal-footer">
  <button class="btn btn-primary btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" name="Submit" type="submit" value="Submit">सम्पादन गर्नुहोस्</button>
  <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" data-dismiss="modal">रद्द गर्नुहोस्</button>
</div>
</form>

<script type="text/javascript">
      $(document).off('submit', '#add_new_kar_rate').on('submit', '#add_new_kar_rate', function(e)
      {
        e.preventDefault();
        var obj = $(this),
        url = obj.attr('action'),
        form_data = new FormData(obj[0]);
        $.ajax({
          url : url,
          dataType: 'json',
          contentType: false,
          processData: false,
          data : form_data,
          type : "POST",
          beforeSend: function () {
            $('.spin-loader').show();
          },
          complete: function () {
            $('.spin-loader').hide();
          },
          success: function(resp) {
            if(resp.status == 'success') {
              $('.error_message').html(resp.data);
              location.reload();
            } 
            if (resp.status = 'error') {
              if(resp.messase == 'form_error') {
                $.each(resp.data, function(index, element) {
                  $('.error_message').html('<div class="revenue-head"><ul><li>'+resp.data+'</li></ul></div>');
                  });
              }
              if(resp.messase == 'du_error') {
                $('.error_message').html(resp.data);
              }
            }
          }, 
          error: function() {
            alert('Internal Server Error!');
          }
        });
      }); 

      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
      });
    </script>

