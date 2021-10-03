<form action="<?php echo base_url()?>SampatiBhumiKar/UpdateSampatiBhumiKar" method="post" class="save_post">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
    <table class="table" id="add_new_fields" >
      <thead style="">
        <tr>
          <th>आर्थिक वर्ष</th>
          <th>देखि</th>
          <th>सम्म</th>
          <th>सम्पतिकर</th>
          <th>भूमिकर</th>
        </tr>
      </thead>
      <tbody>
        <tr class="sampati_kar_add" id="sampati_kar_add_1" data-id="1">
        <input type="hidden" name="id" value="<?php echo $editData['id']?>" >
         <td style="width: 155px;">
            <select class="form-control" name="fiscal_year">
              <option value="">आर्थिक वर्ष चयन गर्नुहोस्</option>
              <?php
              if(!empty($fiscal_year)) : 
                foreach ($fiscal_year as $key => $value) :?>
                  <option value="<?php echo $value['year']?>" <?php if($value['year'] == $editData['fiscal_year']){ echo 'selected';} ?>><?php echo $value['year']?></option>
                <?php endforeach;endif?>
              </select>
          </td>
          <td>
            <input type="text" name="from" class="form-control"  placeholder="*देखि" required="required" value="<?php echo $editData['from_rate']?>" >
            <span class="err_message"></span>
          </td>
          <td>
            <input type="text" name="to" class="form-control"  placeholder="*सम्म" required="required" value="<?php echo $editData['to_rate']?>">
            <span class="err_message"></span>
          </td>
          <td>
            <input type="text" name="sampati_kar" class="form-control" required= "required" placeholder="*सम्पतिकर" required="required" value="<?php echo $editData['sampati_kar']?>">
            <span class="err_message"></span>
          </td>
          <td>
            <input type="text" name="bhunmi_kar" class="form-control"  placeholder="*भूमिकर" required="required" value="<?php echo $editData['bhumi_kar']?>">
            <span class="err_message"></span>
          </td>
        </tr>
     </tbody>
   </table>
   <div class="modal-footer">
    <button class="btn btn-primary btn-xs save_btn" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" name="Submit" type="submit" value="Submit">सम्पादन गर्नुहोस्</button>
    <!-- <button class="btn btn-primary btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्"><i class="fa fa-save"></i></button> -->
    <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" data-dismiss="modal">रद्द गर्नुहोस्</button>
  </div>
</form>