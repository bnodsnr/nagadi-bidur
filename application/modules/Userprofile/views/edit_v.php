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
             प्रयोगकर्ताहरूको थप्नुहोस
            <!--  <span class="tools">
              <a class="btn btn-info btn-success pull-right" href="<?php echo base_url()?>Users/Add"style="color:#FFF"> नयाँ थप्नुहोस् </a>
            </span> -->
          </header>
          <div class="card-body">
            <?php echo form_open('Users/updateUsers', array('name'=>'updateUsers', 'id'=>'AddUser', 'method'=>'post', 'class'=>'form-horizontal'));?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input type="hidden" name="userid" value="<?php echo !empty($query->userid) ? $query->userid :'';?>">
                  <label>प्रयोगकर्ताको भूमिका/पहुँच तह<span style="color:red">*</span></label>
                 <!--  <?php echo form_dropdown('role', $group,'',array('id'=>'UserRole', 'class'=>'form-control ', 'required'=>'required'));?> -->
                 <select class="form-control" name="role">
                  <?php 
                  if(!empty($group)):
                  foreach ($group as $key => $value) : ?>
                    <option value="<?php echo $value->groupid?>" <?php if($query->user_group == $value->groupid){ echo 'selected';}?>><?php echo $value->group_name?></option>
                  <?php endforeach;endif;?>
                 </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>प्रयोगकर्ता कर्मचारीको नाम</label>
                  <?php $name = !empty($query->name) ? $query->name:''; ?>
                  <?php echo form_input(array('name'=>'name', 'id'=>'Name', 'class'=>'form-control ', 'required'=>'required', 'value'=>$name));?>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>प्रयोगकर्ता संकेत नं.</label>
                   <?php $symbol_no = !empty($query->symbol_no) ? $query->symbol_no:''; ?>
                  <?php echo form_input(array('name'=>'symbol_no', 'id'=>'Name', 'class'=>'form-control ', 'required'=>'required','value'=>$symbol_no));?>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>प्रयोगकर्ता पद.</label>
                  <?php $designation = !empty($query->designation) ? $query->designation:''; ?>
                  <?php echo form_input(array('name'=>'designation', 'id'=>'Name', 'class'=>'form-control ', 'required'=>'required','value'=>$designation));?>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>शाखा.</label>
                  <?php $branch_name = !empty($query->branch_name) ? $query->branch_name:''; ?>
                  <?php echo form_input(array('name'=>'branch', 'id'=>'Name', 'class'=>'form-control ', 'required'=>'required','value'=>$branch_name));?>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>कार्यलयमा हाजिर मिति.</label>
                  <!-- <?php echo form_input(array('name'=>'office_join_date', 'id'=>'Name', 'class'=>'form-control nepali-calendar', 'required'=>'required','autocomplete'=>"off", 'value'=>$today_date_nep));?> -->
                  <?php $office_join_date = !empty($query->office_join_date) ? $query->office_join_date:''; ?>
                  <div class="iconic-input right">
                    <i class="fa  fa-calendar" style="color:#1b5693"></i>
                    <input type="text" class="form-control nepali-calendar" name="office_join_date"  value="<?php echo !empty($office_join_date) ? $office_join_date:$today_date_nep;?>">
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
                  <label>गा.पा / न. पा<span style="color:red">*</span></label>
                   <select class="form-control Kartmandus" data-placeholder="Choose a Category" tabindex="1" name="gapa_napa">
                    <option value="">गा.पा / न. पा</option>
                    <?php
                    if(!empty($gapana)) {
                      foreach ($gapana as $g) { ?>
                       <option value="<?php echo $g['id']?>" <?php if($query->gapa_napa == $g['id']){ echo 'selected';}?>><?php echo $g['name']?></option>
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
                       <option value="<?php echo $w['name']?>" <?php if($query->ward == $w['name']){echo 'selected';} ?>><?php echo $w['name']?></option>
                     <?php  }
                   } 
                   ?>
                 </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>ईमेल.</label>
                  <?php $email = !empty($query->email) ? $query->email:''; ?>
                  <?php echo form_input(array('name'=>'email', 'id'=>'Name', 'class'=>'form-control ', 'required'=>'required','value'=>$email));?>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>फोन नम्बर.</label>
                  <?php $phone = !empty($query->phone) ? $query->phone:''; ?>
                  <?php echo form_input(array('name'=>'phone', 'id'=>'Name', 'class'=>'form-control ', 'required'=>'required','value'=>$phone));?>
                </div>
              </div>

              <!-- <div class="col-md-6">
                <div class="form-group">
                  <label>प्रयोगकर्ता आईडी.</label>
                  <?php $user_name = !empty($query->user_name) ? $query->user_name:''; ?>
                  <?php echo form_input(array('name'=>'username', 'id'=>'Name', 'class'=>'form-control ', 'required'=>'required','value'=>$user_name));?>
                </div>
              </div> -->

             <!--  <div class="col-md-6">
                <div class="form-group">
                  <label>पासवर्ड.</label>
                  <?php echo form_input(array('name'=>'password', 'id'=>'Name', 'class'=>'form-control password ', 'required'=>'required'));?>
                </div>
              </div> -->

              <!-- <div class="col-md-6">
                <div class="form-group">
                  <label>पासवर्ड निश्चित गर्नुहोस्.</label>
                  <?php echo form_input(array('name'=>'name', 'id'=>'Name', 'class'=>'form-control cpassword', 'required'=>'required'));?>
                </div>
              </div>  -->
              <div class="col-md-12 text-center">
                <div class="error_message"></div>
                <hr>
                <button class="btn btn-primary btn-xs save_button" data-toggle="tooltip" title=" सेभ  गर्नुहोस्" name="Submit" type="submit" value="Submit"> सेभ गर्नुहोस्</button>
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
    <script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/assets/data-tables/DT_bootstrap.js"></script>
   <script type="text/javascript" src="<?php echo base_url()?>assets/nepali_datepicker/nepali.datepicker.v2.2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        // $('.nepali-calendar').nepaliDatePicker();

      $('.nepali-calendar').nepaliDatePicker({
          npdMonth: true,
          npdYear: true,
          npdYearCount: 10 // Options | Number of years to show
    });
    });
</script>