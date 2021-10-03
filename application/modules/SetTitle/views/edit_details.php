<!--main content start-->
<section id="main-content">
  <section class="wrapper">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>SetTitle">शिर्षकहरुको सूची
</a></li>
        <li class="breadcrumb-item">विवरण सम्पादन गर्नुहोस्</li>
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
           सह शिर्षकहरुको विवरण सम्पादन गर्नुहोस्
          </header>
          <div class="card-body">
            <form role="form" action="<?php echo base_url()?>SetTitle/updateTopic" method="post">
                 <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>आर्थिक वर्ष<span style="color:red">*</span></label>
                    <div class="">
                      <input type ="hidden" name = "id" value="<?php echo $row['id']?>"> 
                      <select class="form-control" name="fiscal_year" id = "set_fiscal_year">
                        <option value="">आर्थिक वर्ष चयन गर्नुहोस्</option>
                        <?php
                        if(!empty($fiscal_year)) : 
                          foreach ($fiscal_year as $key => $value) : ?>
                            <option value="<?php echo $value['year']?>" <?php if($value['year'] == $row['fiscal_year']) {echo 'selected';} ?> ><?php echo $value['year']?></option>
                          <?php endforeach;endif?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>मुख्य शिर्षक <span style="color:red">*</span></label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <button type="button" data-toggle="modal" href="#editModel" class="input-group-text btn btn-warning" title="" data-url="<?php echo base_url()?>SetTitle/addMainTopic"><i class="fa fa-plus"></i></button>
                        </div>
                        <select class="form-control" name="parent_title" id = "parent_title" required="required">
                          <option value="">मुख्य शिर्षक छनौट गर्नुहोस्</option>
                          <?php
                          $selected = '';
                          if(!empty($row['id'])) {
                            $selected = $row['structure_id'];
                          }
                          if(!empty($main_topic)) : 
                            foreach ($main_topic as $key => $type) : ?>
                              <option value="<?php echo $type['id']?>" 
                                <?php 
                                if(!empty($row['id'])) {
                                  if($row['parent_id'] == $type['id']) {
                                    echo 'selected';
                                  }
                                } ?>
                                >
                                <?php echo $type['topic_name']?></option>
                              <?php endforeach;endif?>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label>शिर्षकको नाम <span style="color:red">*</span></label>
                          <input type="text" class="form-control " placeholder="" name="topic_name" required="required" value="<?php if(!empty($row['id'])){ echo $row['topic_title'];} ?>">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>शिर्षक नं <span style="color:red">*</span></label>
                          <input type="text" class="form-control " placeholder="" name="topic_number" required="required" value="<?php if(!empty($row['id'])){ echo $row['topic_no'];} ?>">
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <label>दर रेट </label>
                          <input type="text" class="form-control " placeholder="" name="rate" required="required" value="<?php if(!empty($row['id'])){ echo $row['rate'];} ?>">
                        </div>
                      </div>

                      <div class="col-md-1">
                        <div class="form-group">
                          <label>प्रतिशत मा हो(%) ? <span style="color:red">*</span></label>
                          <input type="checkbox"  name="is_percent" value="1" <?php if($row['is_percent'] == 1){ echo 'checked';}?>>
                        </div>
                      </div>

                      <div class="col-md-12 text-center">
                        <hr>
                        <button class="btn btn-primary btn-xs" data-toggle="tooltip" title=" सेभ  गर्नुहोस्" name="Submit" type="submit" value="Submit"> सेभ गर्नुहोस्</button>
                        <a href="<?php echo base_url()?>SetTitle" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्">रद्द गर्नुहोस्</a>
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
    
