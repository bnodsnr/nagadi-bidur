<form action="<?php echo base_url()?>SampatiBhumiKar/SaveSampatiBhumiKar" method="post" id="add_new_kar_rate" class="form save_post">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
    <div class="error">
    </div>
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
        
         <td style="width: 155px;">
            <!-- <select class="form-control" name="fiscal_year" id = "" required="required">
              <option value="">आर्थिक वर्ष चयन गर्नुहोस्</option>
              <?php
              if(!empty($fiscal_year)) : 
                foreach ($fiscal_year as $key => $value) :?>
                  <option value="<?php echo $value['year']?>" <?php if($value['year'] == get_current_fiscal_year()){echo 'selected';}?>><?php echo $value['year']?></option>
                <?php endforeach;endif?>
              </select> -->
              <input type="text" class="form-control" name="fiscal_year" value="<?php echo current_fiscal_year()?>" readonly>
          </td>
          <td>
            <input type="text" name="from" class="form-control"  placeholder="*देखि" required="required" value="<?php !empty($row['from_rate'])?$row['from_rate']:''?>" >
            <span class="err_message"></span>
          </td>
          <td>
            <input type="text" name="to" class="form-control"  placeholder="*सम्म" required="required" value="<?php !empty($row['from_rate'])?$row['from_rate']:''?>">
            <span class="err_message"></span>
          </td>
          <td>
            <input type="text" name="sampati_kar" class="form-control" required= "required" placeholder="*सम्पतिकर" required="required" value="<?php !empty($row['from_rate'])?$row['from_rate']:''?>">
            <span class="err_message"></span>
          </td>
          <td>
            <input type="text" name="bhunmi_kar" class="form-control"  placeholder="*भूमिकर" required="required" value="<?php !empty($row['from_rate'])?$row['from_rate']:''?>">
            <span class="err_message"></span>
          </td>
        </tr>
     </tbody>
   </table>
   <div class="modal-footer">
    <button class="btn btn-primary btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" name="Submit" type="submit" value="Submit">सम्पादन गर्नुहोस्</button>
  
    <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="" data-dismiss="modal">रद्द गर्नुहोस्</button>
  </div>
</form>