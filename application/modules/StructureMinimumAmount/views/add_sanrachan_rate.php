<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>StructureMinimumAmount">संरचनाको न्युनतम मूल्य</a></li>
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
          संरचनाको न्युनतम मूल्य नयाँ थप्नुहोस् 
         </header>
         <div class="card-body">
          <form role="form" action="<?php echo base_url()?>StructureMinimumAmount/SaveSanrachanaRate" method="post">
            <div class="row">
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

              <div class="col-md-6">
                <div class="form-group">
                    <label>आर्थिक वर्ष<span style="color:red">*</span></label>
                    <input type ="hidden" name = "id" value="<?php if(!empty($row['id'])){ echo $row['id'];}?>"> 
                    <!-- <select class="form-control set_fiscal_year_frm" name="fiscal_year" id = "set_fiscal_year_frm">
                      <option value="">आर्थिक वर्ष चयन गर्नुहोस्</option>
                      <?php
                        if(!empty($fiscal_year)) : 
                          foreach ($fiscal_year as $key => $value) : ?>
                          <option value="<?php echo $value['year']?>" <?php if($value['year'] ==get_current_fiscal_year()){ echo 'selected';} ?>><?php echo $value['year']?></option>
                      <?php endforeach;endif?>
                    </select> -->

                    <input type="text" class="form-control" name="fiscal_year" value="<?php echo current_fiscal_year()?>" readonly>
                </div>
              </div>


               <div class="col-md-6">
                <div class="form-group">
                  <label>संरचनाको बनौटको किसिम<span style="color:red">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <button type="button" data-toggle="modal" href="#editModel" class="input-group-text btn btn-warning" title="संरचनाको बनौटको किसिम थप्नुहोस्" data-url="<?php echo base_url()?>SanrachanaBanaot/add"><i class="fa fa-plus"></i>
                      </button>
                    </div>
                    <select class="form-control" name="sanrachana_banaotko_kisim" id = "sanrachana_banaotko_kisim" required="required">
                        <option value="">संरचनाको बनौटको किसिम</option>
                        <?php
                        $selected = '';
                        if(!empty($row['id'])) {
                          $selected = $row['structure_type_id'];
                        }
                        if(!empty($settings_architect_structure)) : 
                          foreach ($settings_architect_structure as $key => $type) : ?>
                            <option value="<?php echo $type['id']?>" 
                              <?php 
                              if(!empty($row['id'])) {
                                if($row['structure_type_id'] == $type['id']) {
                                  echo 'selected';
                                }
                              } ?>
                              >
                              <?php echo $type['structure_type']?></option>
                            <?php endforeach;endif?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>संरचनाको प्रकार<span style="color:red">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <button type="button" data-toggle="modal" href="#editModel" class="input-group-text btn btn-warning" title="संरचनाको प्रकार  थप्नुहोस्" data-url="<?php echo base_url()?>SanrachanaType/add"><i class="fa fa-plus"></i>
                      </button>
                    </div>
                    <select class="form-control" name="sanrachanako_prakar" id = "set_fiscal_year" required="required">
                       <!--  <option value="">संरचनाको प्रकार किसिम गर्नुहोस्</option> -->
                        <?php
                        $selected = '';
                        if(!empty($row['id'])) {
                          $selected = $row['structure_id'];
                        }
                        if(!empty($settings_architect_type)) : 
                          foreach ($settings_architect_type as $key => $type) : ?>
                            <option value="<?php echo $type['id']?>" 
                              <?php 
                              if(!empty($row['id'])) {
                                if($row['structure_id'] == $type['id']) {
                                  echo 'selected';
                                }
                              } ?>
                              >
                              <?php echo $type['architect_type']?></option>
                            <?php endforeach;endif?>
                    </select>
                  </div>
                </div>
              </div>

             
              <div class="col-md-6">
                <div class="form-group">
                  <label>न्युनतम मुल्य<span style="color:red">*</span></label>
                  <input type="number" class="form-control" placeholder=""  name="min_amount" required="required" value="<?php if(!empty($row['id'])){ echo $row['minimum_amount'];} ?>">
                </div>
              </div>

              <div class="col-md-12 text-center">
                <hr>
                <button class="btn btn-primary btn-xs" data-toggle="tooltip" title=" सेभ  गर्नुहोस्" name="Submit" type="submit" value="Submit"> सेभ गर्नुहोस्</button>
                <a href="<?php echo base_url()?>StructureMinimumAmount" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्">रद्द गर्नुहोस्</a>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>
  </section>
