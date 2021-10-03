<!--main content start-->
<section id="main-content">
  <section class="wrapper">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>JaggaKoRate">जग्गाको न्युनतम मुल्य</a></li>
        <li class="breadcrumb-item"><a href="javascript:;"> नयाँ थप्नुहोस् </a></li>
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
           जग्गाको न्युनतम मुल्य
         </header>
         <div class="card-body">
          <form role="form" action="<?php echo base_url()?>JaggakoRate/SaveJaagakoMinRate" method="post">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>आर्थिक वर्ष<span style="color:red">*</span></label>
                  <div class="">
                 
                    <input type ="hidden" name = "id" value="<?php if(!empty($row)){ echo $row['id'];}?>"> 

                    <select class="form-control set_fiscal_year_frm" name="fiscal_year" id = "set_fiscal_year_frm">
                      <option value="">आर्थिक वर्ष चयन गर्नुहोस्</option>
                      <?php
                      if(!empty($fiscal_year)) : 
                        foreach ($fiscal_year as $key => $value) : ?>
                          <option value="<?php echo $value['year']?>" <?php if($value['year'] ==get_current_fiscal_year()){ echo 'selected';} ?>><?php echo $value['year']?></option>
                        <?php endforeach;endif?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>वार्ड<span style="color:red">*</span></label>
                    <select name="ward_no" class="form-control selected_ward">
                      <option value="">चयन गर्नुहोस्</option>
                      <?php if(!empty($ward)) :
                        foreach($ward as $ward) : ?>
                          <option value="<?php echo $ward['ward']?>"
                            <?php if(!empty($row['ward'])) {
                              if(!empty($row['ward'] == $ward['ward'])){
                                echo 'selected';
                              }
                            } ?>
                            ><?php echo 'वार्ड-' . $this->mylibrary->convertedcit($ward['ward'])?></option>
                      <?php endforeach;endif;?>
                    </select>
                   <!--  <input type="number" class="form-control" placeholder=""  name="ward_no" required="required" value="<?php //if(!empty($row['id'])){ echo $row['ward'];} ?>"> -->
                  </div>
                </div>
                <div class="col-md-6">
                    <div class ='notification'></div>
                  <div class="form-group">
                    <label>सडकको नाम<span style="color:red">*</span></label>
                    <div class="input-group">
                     
                            <select name="road" class="from-control dd_select road_details"
                          id="road_details" required>
                          <?php if(!empty($row)) {
                              if(!empty($roads)) {
                                  foreach($roads as $roadm) {?>
                                      <option value="<?php echo $roadm['id']?>"<?php if($roadm['id']==$row['road_name']){echo 'seleced';} ?>
                                      ><?php echo $roadm['road_name']?></option>
                                <?php   }
                              }
                          } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>जग्गाको क्षेत्रगत किसिम<span style="color:red">*</span> <a href="<?php echo base_url()?>LandAreaType" target="_blank">[ <i class="fa fa-eye"></i> सूचीहरू ]</a></label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <button type="button" data-toggle="modal" href="#addModel" class="input-group-text btn btn-warning" title="जग्गाको क्षेत्रगत किसिम थप्नुहोस्" data-url="<?php echo base_url()?>LandAreaType/add"><i class="fa fa-plus"></i></button>

                          </div>
                          <select class="form-control" name="land_type" id = "set_fiscal_year" required="required">
                            <option value="">जग्गाको क्षेत्रगत किसिम गर्नुहोस्</option>
                            <?php
                            $selected = '';
                            if(!empty($row['id'])) {
                              $selected = $row['land_area_type'];
                            }
                            if(!empty($settingsLandAreaType)) : 
                              foreach ($settingsLandAreaType as $key => $type) : ?>
                                <option value="<?php echo $type['id']?>" 
                                  <?php 
                                  if(!empty($row['id'])) {
                                    if($row['land_area_type'] == $type['id']) {
                                      echo 'selected';
                                    }
                                  } ?>
                                  >
                                <?php echo $type['land_area_type']?></option>
                                <?php endforeach;endif?>
                            </select>
                          </div>
                        </div>
                      </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>न्युनतम मुल्य<span style="color:red">*</span></label>
                            <input type="number" class="form-control" placeholder=""  name="min_amount" required="required" value="<?php if(!empty($row['id'])){ echo $row['minimal_cost'];} ?>">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>अधिक्कतम मुल्य<span style="color:red">*</span></label>
                            <input type="number" class="form-control" placeholder=""  name="max_amount" required="required" value="<?php if(!empty($row['id'])){ echo $row['maximum_cost'];} ?>">
                          </div>
                        </div>
                        <div class="col-md-12 text-center">
                          <hr>
                          <button class="btn btn-primary btn-xs" data-toggle="tooltip" title=" सेभ  गर्नुहोस्" name="Submit" type="submit" value="Submit"> सेभ गर्नुहोस्</button>
                          <a href="<?php echo base_url()?>JaggakoRate" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्">रद्द गर्नुहोस्</a>
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
<script type="text/javascript" src="<?php echo base_url()?>assets/assets/select2/js/select2.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.dd_select').select2();
      $(document).on('change', '.selected_ward', function() {
          var obj = $(this);
         
          var ward = obj.val();
          $.ajax({
            method: "POST",
            url: base_url + "JaggakoRate/getRoads",
            data: {
             
              ward: ward,
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
            },
            success: function(resp) {
              if (resp.status == 'success') {
                if (resp.data == null) {
                  $('.notification').html(
                    '<div class="alert alert-danger">सडकको नाम भेटिएन</div>'
                  )
                } else {
                 
                  $(".road_details").html(resp.data);
                  $('.notification').empty();
                }
              }
            }
          });
      });
    })
  </script>
  