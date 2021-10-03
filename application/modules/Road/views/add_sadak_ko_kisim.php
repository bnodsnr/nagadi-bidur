<!--main content start-->
<section id="main-content">
    <section class="wrapper">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>Dashboard"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>Road">रोड को किसिम</a></li>
            <li class="breadcrumb-item"><a href=""> नयाँ थप्नुहोस् </a></li>
        </ol>

      </nav>
        <!-- page start-->
        <div class="row">
          <div class="col-sm-12">
            <?php $success_message = $this->session->flashdata("MSG_SUCCESS");
                if(!empty($success_message)) { ?>
                <div class="alert alert-success">
                    <button class="close" data-close="alert"></button>
                    <span> <?php echo $success_message;?> </span>
                </div>
              <?php } ?>
            <section class="card">
              <header class="card-header" style="background: #1b5693;color:#FFF">
               रोड को किसिम नयाँ थप्नुहोस् 
              </header>
              <div class="card-body">
                <div class="valid_errors"></div>
                <form role="form" action="<?php echo base_url()?>Road/Save" method="post" class="form save_post">
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>आर्थिक वर्ष<span style="color:red">*</span></label>
                        <div class="">
                          <input type ="hidden" name = "id" value="<?php if(!empty($row['id'])){ echo $row['id'];}?>"> 

                          <select class="form-control" name="fiscal_year"required="required">
                            <?php
                            if(!empty($fiscal_year)) : 
                              foreach ($fiscal_year as $key => $value) : ?>
                                <option value="<?php echo $value['year']?>" <?php if($value['year'] ==get_current_fiscal_year()){ echo 'selected';} ?>><?php echo $value['year']?></option>
                              <?php endforeach;endif?>
                            </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>जग्गाको क्षेत्रगत किसिम<span style="color:red">*</span> <a href="<?php echo base_url()?>LandAreaType" target="_blank">[ <i class="fa fa-eye"></i> सूचीहरू ]</a></label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                  <button type="button" data-toggle="modal" href="#editModel" class="input-group-text btn btn-warning" title="रोडको किसिम थप्नुहोस्" data-url="<?php echo base_url()?>RoadType/add"><i class="fa fa-plus"></i></button>
                              </div>
                              <select class="form-control land_area_type" name="land_area_type" required="required">
                                <option value=""> चयन गर्नुहोस्</option>
                                <?php
                                $selected = '';
                                if(!empty($row['id'])) {
                                  $selected = $row['land_area_type'];
                                }
                                if(!empty($land_area_type)) : 
                                  foreach ($land_area_type as $key => $lyt) : ?>
                                    <option value="<?php echo $lyt['id']?>" 
                                    <?php 
                                    if(!empty($row['id'])) {
                                      if($row['land_area_type'] == $lyt['id']) {
                                        echo 'selected';
                                      }
                                    } ?>
                                     >
                                      <?php echo $lyt['land_area_type']?></option>
                                  <?php endforeach;endif?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>जग्गाको वर्गिकरण<span style="color:red">*</span> <a href="<?php echo base_url()?>RoadType" target="_blank">[ <i class="fa fa-eye"></i> सूचीहरू ]</a></label>
                            <!-- <div class="input-group">
                              <div class="input-group-prepend">
                                  <button type="button" data-toggle="modal" href="#editModel" class="input-group-text btn btn-warning" title="रोडको किसिम थप्नुहोस्" data-url="<?php echo base_url()?>RoadType/add"><i class="fa fa-plus"></i></button>
                              </div> -->
                             
                              <input tpye = "text" name="land_category_name" value="" class="form-control land_category_name" readonly="readonly">
                              <input type = "hidden" name="road_type" value="" class="form-control land_category_id" readonly="readonly">
                             <!--  <select class="form-control land_category" name="road_type" required="required">
                                <option value=""> चयन गर्नुहोस्</option>
                                <?php
                                //$selected = '';
                               // if(!empty($row['id'])) {
                                  //$selected = $row['road_type'];
                               // }
                                //if(!empty($land_category)) : 
                                 // foreach ($land_category as $key => $land_cat) : ?>
                                    <option value="<?php //echo $land_cat['id']?>" 
                                    <?php 
                                    //if(!empty($row['id'])) {
                                      //if($row['road_type'] == $land_cat['id']) {
                                       // echo 'selected';
                                      //}
                                   // }// ?>
                                     >

                                      <?php //echo $land_cat['category']?></option>
                                  <?php //endforeach;endif?>
                                </select> -->
                            <!-- </div> -->
                        </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>टोल</label>
                        <input type="text" class="form-control" placeholder="" name="tol" value="<?php if(!empty($row['id'])){ echo $row['tole'];} ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>वार्ड<span style="color:red">*</span></label>
                        <input type="number" class="form-control" placeholder=""  name="ward_no" required="required" value="<?php if(!empty($row['id'])){ echo $row['ward'];} ?>">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>रोडको नाम<span style="color:red">*</span></label>
                        <input type="text" class="form-control " placeholder="" name="road_name" required="required" value="<?php if(!empty($row['id'])){ echo $row['road_name'];} ?>">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>न्युनतम मुल्य<span style="color:red">*</span></label>
                        <input type="text" class="form-control" placeholder=""  name="min_rate"  value="<?php echo !empty($row['id'])?$row['min_rate']:0?>">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>अधिक्कतम मुल्य<span style="color:red">*</span></label>
                        <input type="text" class="form-control " placeholder="" name="max_rate"  value="<?php echo !empty($row['id'])?$row['max_rate']:0?>">
                      </div>
                    </div>

                    <div class="col-md-12 text-center">
                      <hr>
                       <button class="btn btn-primary btn-xs save_btn" data-toggle="tooltip" title=" सेभ  गर्नुहोस्" name="Submit" type="submit" value="Submit"> सेभ गर्नुहोस्</button>
                        <a href="<?php echo base_url()?>Road" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्">रद्द गर्नुहोस्</a>
                    </div>
                  </div>
                </form>
              </div>
              </div>
            </section>
          </div>
        </div>
        <!-- page end-->
    </section>
</section>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('change', '.land_area_type', function(){
      var obj = $(this);
      var land_area_type = obj.val();
       $.ajax({
        method: "POST",
        url: base_url + "Road/getLandCategory",
        data: {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          land_area_type: land_area_type
        },
        success: function(resp) {
          console.log(resp);
          if (resp.status == 'success') {
            $('.land_category_name').val(resp.data.lc);
            $('.land_category_id').val(resp.data.categoryid);
           
          }
        }
      });
    })
  });
</script>


