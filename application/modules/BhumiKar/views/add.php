<!--main content start-->
<section id="main-content">
    <section class="wrapper">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>Dashboard"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>BhumiKar"> भूमिकर</a></li>
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
                भूमिकर
              </header>
              <div class="card-body">
                <div class="valid_errors"></div>
                <form role="form" action="<?php echo base_url()?>BhumiKar/Save" method="post" class="form save_post">
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
                              <select class="form-control" name="land_area_type" required="required">
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
                        <label>जग्गाको वर्गिकरण<span style="color:red">*</span> <a href="<?php echo base_url()?>LandCategory" target="_blank">[ <i class="fa fa-eye"></i> सूचीहरू ]</a></label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                  <button type="button" data-toggle="modal" href="#editModel" class="input-group-text btn btn-warning" title="रोडको किसिम थप्नुहोस्" data-url="<?php echo base_url()?>LandCategory/add"><i class="fa fa-plus"></i></button>
                              </div>
                              <select class="form-control" name="land_category" required="required">
                                <option value=""> चयन गर्नुहोस्</option>
                                <?php
                                $selected = '';
                                if(!empty($row['id'])) {
                                  $selected = $row['category'];
                                }
                                if(!empty($roads)) : 
                                  foreach ($roads as $key => $lc) : ?>
                                    <option value="<?php echo $lc['id']?>" 
                                    <?php 
                                    if(!empty($row['id'])) {
                                      if($row['roads'] == $lc['id']) {
                                        echo 'selected';
                                      }
                                    } ?>
                                     >
                                      <?php echo $lc['road_name']?></option>
                                  <?php endforeach;endif?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php if(MODULE == 2) { ?>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>वार्ड<span style="color:red">*</span></label>
                        <input type="number" class="form-control" placeholder=""  name="ward_no" required="required" value="<?php if(!empty($row['id'])){ echo $row['ward'];} ?>">
                      </div>
                    </div>

                    <?php } ?>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>प्रति <?php if(CALC ==1){ echo 'रोपनी';}else{ echo 'कट्ठा';}?> दर रु<span style="color:red">*</span></label>
                        <input type="text" class="form-control " placeholder="" name="rate" required="required" value="<?php if(!empty($row['id'])){ echo $row['rate'];} ?>">
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
