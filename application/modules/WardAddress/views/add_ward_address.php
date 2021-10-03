
<form role="form" action="<?php echo base_url()?>WardAddress/editDetailsView" method="post" class="save_post">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>वार्ड नं <span style="color:red">*</span></label>
        <div class="">
          <input type ="hidden" name = "id" value=""> 
          <select class="form-control" name="ward" id = "set_fiscal_year">
            <?php
            if(!empty($ward)) : 
              foreach ($ward as $key => $wa) : ?>
                <option value="<?php echo $wa['name']?>" <?php if($wa['name'] ==$this->session->userdata('add_ward_address')){ echo 'selected';} ?>><?php echo $wa['name']?></option>
              <?php endforeach;endif?>
            </select>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>ठेगाना<span style="color:red">*</span></label>
          <input type="text" class="form-control" placeholder="" name="address" required="required" value="<?php if(!empty($row['id'])){ echo $row['tole'];} ?>">
        </div>
      </div>

          <div class="col-md-12 text-center">
            <hr>
            <button class="btn btn-primary btn-xs" data-toggle="tooltip" title=" सेभ  गर्नुहोस्" name="Submit" type="submit" value="save"> सेभ गर्नुहोस्</button>
            <a href="<?php echo base_url()?>WardAddress" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्">रद्द गर्नुहोस्</a> 
          </div>
        </div>
      </form>