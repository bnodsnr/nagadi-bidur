<form action="<?php echo base_url()?>WardAddress/update" method="post" class="save_post">
    <table class="table" id="add_new_fields" >
      <thead style="">
        <tr>
          <th>वार्ड नं.</th>
          <th>वार्ड ठेगाना</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><div class="">
          <input type ="hidden" name = "id" value="<?php echo $editData['id']?>"> 
          <select class="form-control" name="ward" id = "set_fiscal_year">
            <?php
            if(!empty($ward)) : 
              foreach ($ward as $key => $wa) : ?>
                <option value="<?php echo $wa['name']?>" <?php if($wa['name'] == $editData['ward']){echo 'selected';}?>><?php echo $wa['name']?></option>
              <?php endforeach;endif?>
            </select>
          </div>
        </div>
      </td>
          <td><input type="text" name="updateWard" id="ward_update" class="form-control" value="<?php echo $editData['address']?>"> </td>
        </tr>
     </tbody>
   </table>
   <div class="modal-footer">
    <button class="btn btn-primary btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" name="Submit" type="submit" value="Submit">सम्पादन गर्नुहोस्</button>
    <!-- <button class="btn btn-primary btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्"><i class="fa fa-save"></i></button> -->
    <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" data-dismiss="modal">रद्द गर्नुहोस्</button>
  </div>
</form>