 <!--dynamic table-->
    <link href="<?php echo base_url()?>assets/assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
    <link href="<?php echo base_url()?>assets/assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/assets/data-tables/DT_bootstrap.css" />

    <style>
      ::-webkit-input-placeholder { /* Edge */
        color: red;
      }

      :-ms-input-placeholder { /* Internet Explorer */
        color: red;
      }

      ::placeholder {
        color: red;
      }
      .error li {
        color:red;
      }
    </style>
<!--main content start-->
      <section id="main-content">
          <section class="wrapper">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
                  <li class="breadcrumb-item"><a href="<?php echo base_url()?>DeteriorationStructure">संरचनाको आयु र किसिम अनुसारको दर</a></li>
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
                    संरचनाको आयु र किसिम अनुसारको दर
                    </header>
                    <div class="card-body">
                      <form role="form" action="<?php echo base_url()?>DeteriorationStructure/SaveAgeTax" method="post">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>आर्थिक वर्ष<span style="color:red">*</span></label>
                              <div class="">
                                <input type ="hidden" name = "id" value="<?php if(!empty($row['id'])){ echo $row['id'];}?>"> 
                                <select class="form-control" name="fiscal_year" id = "set_fiscal_year">
                                  <option value="">आर्थिक वर्ष चयन गर्नुहोस्</option>
                                  <?php
                                  if(!empty($fiscal_year)) : 
                                    foreach ($fiscal_year as $key => $value) : ?>
                                      <option value="<?php echo $value['year']?>" <?php if($value['year'] ==$row['fiscal_year']){ echo 'selected';} ?>><?php echo $value['year']?></option>
                                    <?php endforeach;endif?>
                                  </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>संरचनाको किसिम<span style="color:red">*</span></label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" data-toggle="modal" href="#editModel" class="input-group-text btn btn-warning" title="" data-url="<?php echo base_url()?>StructureMinimumAmount/addSanrachanaStructureType"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <select class="form-control" name="structure_type" id = "structure_type" required="required">
                                      <option value="">संरचनाको किसिम चयन गर्नुहोस्</option>
                                      <?php
                                      $selected = '';
                                      if(!empty($row['id'])) {
                                        $selected = $row['structure_id'];
                                      }
                                      if(!empty($settings_architect_structure)) : 
                                        foreach ($settings_architect_structure as $key => $type) : ?>
                                          <option value="<?php echo $type['id']?>" 
                                          <?php 
                                          if(!empty($row['id'])) {
                                            if($row['structure_id'] == $type['id']) {
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
                              <label>संरचनाको आयु<span style="color:red">*</span></label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" data-toggle="modal" href="#editModel" class="input-group-text btn btn-warning" title="रोडको किसिम थप्नुहोस्" data-url="<?php echo base_url()?>DeteriorationStructure/strucureAge"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <select class="form-control" name="structure_age" id = "structure_age" required="required">
                                      <option value="">संरचनाको आयु चयन गर्नुहोस्</option>
                                      <?php
                                      $selected = '';
                                      if(!empty($row['id'])) {
                                        $selected = $row['road_type'];
                                      }
                                      if(!empty($settings_architect_age)) : 
                                        foreach ($settings_architect_age as $key => $age) : ?>
                                          <option value="<?php echo $age['id']?>" 
                                          <?php 
                                          if(!empty($row['id'])) {
                                            if($row['age_range_id'] == $age['id']) {
                                              echo 'selected';
                                            }
                                          } ?>
                                           >

                                            <?php echo $age['from_range'].'-'.$age['to_range']?></option>
                                        <?php endforeach;endif?>
                                      </select>
                                   
                                  </div>
                              </div>
                          </div>
                        
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>संरचनाको आयु र किसिम अनुसारको दर(%)<span style="color:red">*</span></label>
                              <input type="text" class="form-control " placeholder="" name="tax_percent" required="required" value="<?php if(!empty($row['id'])){ echo $row['rate'];} ?>">
                            </div>
                          </div>

                          <div class="col-md-12 text-center">
                            <hr>
                             <button class="btn btn-primary btn-xs" data-toggle="tooltip" title=" सेभ  गर्नुहोस्" name="Submit" type="submit" value="Submit"> सेभ गर्नुहोस्</button>
                              <a href="<?php echo base_url()?>DeteriorationStructure" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्">रद्द गर्नुहोस्</a>
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
    <script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/assets/data-tables/DT_bootstrap.js"></script>
    
   