<!--main content start-->
<section id="main-content">
    <section class="wrapper">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>Dashboard"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>SampatiKar"> सम्पत्ति कर</a></li>
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
                सम्पत्ति कर
              </header>
              <div class="card-body">
                <div class="valid_errors"></div>
                <form role="form" action="<?php echo base_url()?>SampatiKar/Save" method="post" class="form save_post">
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>आर्थिक वर्ष<span style="color:red">*</span></label>
                        <div class="">
                          <input type ="hidden" name = "id" value="<?php if(!empty($row['id'])){ echo $row['id'];}?>">
                          <select class="form-control" name="fiscal_year"required="required">
                            <?php
                            if(!empty($fiscal_year)) : 
                              foreach ($fiscal_year as $key => $value) : ?>
                                <option value="<?php echo $value['year']?>" 

                                  <?php 
                                    if(empty($row)) {
                                      if($value['year'] ==get_current_fiscal_year()){ echo 'selected';} 
                                    } else {
                                      if($value['year'] == $row['fiscal_year']) {echo 'selected';}
                                    }
                                    ?>

                                ><?php echo $value['year']?></option>
                              <?php endforeach;endif?>
                            </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                          <label>संरचनाको बनौटको किसिम<span style="color:red">*</span> </label>
                          <select class="form-control" name="sampati_type" required="required">
                            <option value=""> चयन गर्नुहोस्</option>
                            <?php if(!empty($sanrachana_ko_kisim)) :
                              foreach($sanrachana_ko_kisim as $key => $val) :?>
                                <option value="<?php echo $val['id']?>" 
                              <?php if(!empty($row)) {
                                if($row['type'] == $val['id']) {echo 'selected';}
                              } ?>
                              > <?php echo $val['structure_type']?></option>
                            <?php endforeach;endif;?>
                          </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>एकाइ<span style="color:red">*</span> </label>
                          <select class="form-control" name="unit" required="required">
                            <option value=""> चयन गर्नुहोस्</option>
                              <option value="1"  <?php if(!empty($row)) {
                                if($row['unit'] == 1) {echo 'selected';}
                              } ?>> पहिलो तला  </option>
                              <option value="2"  <?php if(!empty($row)) {
                                if($row['unit'] == 2) {echo 'selected';}
                              } ?>> दोस्रो तला </option>
                              <option value="3"  <?php if(!empty($row)) {
                                if($row['unit'] == 3) {echo 'selected';}
                              } ?>> तेस्रो तला</option>
                              <option value="4"  <?php if(!empty($row)) {
                                if($row['unit'] == 4) {echo 'selected';}
                              } ?>> तेस्रो तला भन्दा माथि </option>
                          </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>दर रु<span style="color:red">*</span> </label>
                          <input type="text" name="amount" class="form-control" value="<?php if(!empty($row['id'])){ echo $row['amount'];} ?>">
                        </div>
                    </div>

                    <div class="col-md-12 text-center">
                      <hr>
                       <button class="btn btn-primary btn-xs save_btn" data-toggle="tooltip" title=" सेभ  गर्नुहोस्" name="Submit" type="submit" value="Submit"> सेभ गर्नुहोस्</button>
                        <a href="<?php echo base_url()?>SampatiKar" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्">रद्द गर्नुहोस्</a>
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
