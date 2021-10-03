<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">प्रयोगकर्ताहरूको सूची</a></li>
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

          <section class="card" style="margin-bottom: -25px;">
            <header class="card-header">
             प्रयोगकर्ताहरूको सम्पादन गर्नुहोस्
          </header>
          <div class="card-body">
            <?php echo form_open('Users/Add', array('name'=>'AddUser', 'id'=>'AddUser', 'method'=>'post', 'class'=>'form-horizontal'));?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>प्रयोगकर्ताको भूमिका/पहुँच तह<span style="color:red">*</span></label>
                   <select class="form-control Kartmandus" data-placeholder="Choose a Category" tabindex="1" name="role">
                    <option value="">--select--</option>
                    <?php
                    if(!empty($group)) {
                      foreach ($group as $grp) { ?>
                       <option value="<?php echo $grp->groupid?>"><?php echo $grp->group_name?></option>
                     <?php  }
                   } 
                   ?>
                 </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>प्रयोगकर्ता कर्मचारीको नाम</label>
                  <?php echo form_input(array('name'=>'name', 'id'=>'Name', 'class'=>'form-control ', 'required'=>'required'));?>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>प्रयोगकर्ता संकेत नं.</label>
                  <?php echo form_input(array('name'=>'symbol_no', 'id'=>'Name', 'class'=>'form-control ', 'required'=>'required'));?>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>प्रयोगकर्ता पद.</label>
                  <?php echo form_input(array('name'=>'designation', 'id'=>'Name', 'class'=>'form-control ', 'required'=>'required'));?>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>शाखा.</label>
                  <?php echo form_input(array('name'=>'branch', 'id'=>'Name', 'class'=>'form-control ', 'required'=>'required'));?>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>कार्यलयमा हाजिर मिति.</label>
                  <div class="iconic-input right">
                    <i class="fa  fa-calendar" style="color:#1b5693"></i>
                    <input type="text" class="form-control pop_calender" name="office_join_date"  value="<?php echo !empty($today_date_nep) ? $today_date_nep:'';?>">
                  </div>
                </div>
              </div>

              <!-- <div class="col-md-6">
                <div class="form-group">
                  <label>प्रयोजन.</label>
                  <?php echo form_input(array('name'=>'for_use', 'id'=>'Name', 'class'=>'form-control ', 'required'=>'required'));?>
                </div>
              </div> -->

              <!-- <div class="col-md-6">
                <div class="form-group">
                  <label>सफ्टवेयर/प्रणालीको नाम.</label>
                  <?php echo form_input(array('name'=>'software_name', 'id'=>'Name', 'class'=>'form-control ', 'required'=>'required'));?>
                </div>
              </div> -->

             <!--  <div class="col-md-6">
                <div class="form-group">
                  <label>सफ्टवेयर विवरण.</label>
                  <?php echo form_input(array('name'=>'software_description', 'id'=>'Name', 'class'=>'form-control ', 'required'=>'required'));?>
                </div>
              </div> -->

             <!--   -->

              <!-- <div class="col-md-6">
                <div class="form-group">
                  <label>सफ्टवेयर विवरण.</label>
                  <?php echo form_input(array('name'=>'name', 'id'=>'Name', 'class'=>'form-control ', 'required'=>'required'));?>
                </div>
              </div> -->

              <div class="col-md-6">
                <div class="form-group">
                  <label>प्रदेश<span style="color:red">*</span></label>
                  <input type="text" name="pradesh" class="form-control" value="<?php echo STATENAME ?>" readonly>
                  <input type="hidden" name="provience_id" value="<?php echo STATE?>">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>जिल्ला<span style="color:red">*</span></label>
                  <input type="text" name="pradesh" class="form-control" value="<?php echo DISTRICT ?>" readonly>
                  <input type="hidden" name="district_id" value="<?php echo DID?>">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>गा.पा / न. पा<span style="color:red">*</span></label>
                   <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="gapa_napa">
                    <option value="">गा.पा / न. पा</option>
                    <?php
                    if(!empty($gapana)) {
                      foreach ($gapana as $g) { ?>
                       <option value="<?php echo $g['id']?>"><?php echo $g['name']?></option>
                     <?php  }
                   } 
                   ?>
                 </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>वडा<span style="color:red">*</span></label>
                   <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="ward">
                    <option value="">वडा</option>
                    <?php
                    if(!empty($ward)) {
                      foreach ($ward as $w) { ?>
                       <option value="<?php echo $w['name']?>"><?php echo $w['name']?></option>
                     <?php  }
                   } 
                   ?>
                 </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>ईमेल.</label>
                  <?php echo form_input(array('name'=>'email', 'id'=>'Name', 'class'=>'form-control ', 'required'=>'required'));?>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>फोन नम्बर.</label>
                  <?php echo form_input(array('name'=>'phone', 'id'=>'Name', 'class'=>'form-control ', 'required'=>'required'));?>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>प्रयोगकर्ता आईडी.</label>
                  <?php echo form_input(array('name'=>'username', 'id'=>'Name', 'class'=>'form-control ', 'required'=>'required'));?>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>पासवर्ड.</label>
                  <input type="password" name="password" id = "password" class="form-control password" required="required">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>पासवर्ड निश्चित गर्नुहोस्.</label>
                  <input type="password" name="confirm_password" id = "con_password" class="form-control cpassword" required="required">
                </div>
              </div> 
              <div class="col-md-12 text-center">
                <div class="error_message"></div>
                <hr>
                <button class="btn btn-primary btn-xs save_button" data-toggle="tooltip" title=" सेभ  गर्नुहोस्" name="Save" type="submit" value="Save"> सेभ गर्नुहोस्</button>
                <a href="<?php echo base_url()?>Setting/SadakKoKisim" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्">रद्द गर्नुहोस्</a>
              </div>

            </div>
            <?php echo form_close();?>
          </section>
          </div>
        </div>
        <!-- page end-->
      </section>
    </section>
<script type="text/javascript">
    $(document).ready(function(){
      $('.pop_calender').nepaliDatePicker({
          npdMonth: true,
          npdYear: true,
          npdYearCount: 10
      });
    });
</script>