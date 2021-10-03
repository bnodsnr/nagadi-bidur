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
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>Setting"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>Setting/SadakKoKisim">रोड को किसिम</a></li>
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
          <form role="form" action="<?php echo base_url()?>Setting/SaveJaagakoMinRate" method="post">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>आर्थिक वर्ष<span style="color:red">*</span></label>
                  <div class="">
                    <input type ="hidden" name = "id" value="<?php if(!empty($row['id'])){ echo $row['id'];}?>"> 

                    <select class="form-control set_fiscal_year_frm" name="fiscal_year" id = "set_fiscal_year_frm">
                      <option value="">आर्थिक वर्ष चयन गर्नुहोस्</option>
                      <?php
                      if(!empty($fiscal_year)) : 
                        foreach ($fiscal_year as $key => $value) : ?>
                          <option value="<?php echo $value['year']?>" <?php if($value['year'] ==$this->session->userdata('add_fiscal_year')){ echo 'selected';} ?>><?php echo $value['year']?></option>
                        <?php endforeach;endif?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>वार्ड<span style="color:red">*</span></label>
                    <input type="number" class="form-control" placeholder=""  name="ward_no" required="required" value="<?php if(!empty($row['id'])){ echo $row['ward'];} ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>सडकको नाम<span style="color:red">*</span></label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <!-- <button type="button" data-toggle="modal" href="#editModel" class="input-group-text btn btn-warning" title="रोडको किसिम थप्नुहोस्" data-url="<?php echo base_url()?>Setting/addAreaWiseLandType"><i class="fa fa-plus"></i></button> -->
                      </div>
                      <select class="form-control" name="road" id = "set_fiscal_year" required="required">
                        <option value="">सडकको नाम चयन गर्नुहोस्</option>
                        <?php
                        $selected = '';
                        if(!empty($row['id'])) {
                          $selected = $row['road_type'];
                        }
                        if(!empty($road)) : 
                          foreach ($road as $key => $road) : ?>
                            <option value="<?php echo $road['id']?>" 
                              <?php 
                              if(!empty($row['id'])) {
                                if($row['road_type'] == $road['id']) {
                                  echo 'selected';
                                }
                              } ?>
                              >

                              <?php echo $road['road_name']?></option>
                            <?php endforeach;endif?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>जग्गाको क्षेत्रगत किसिम<span style="color:red">*</span></label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <button type="button" data-toggle="modal" href="#editModel" class="input-group-text btn btn-warning" title="रोडको किसिम थप्नुहोस्" data-url="<?php echo base_url()?>Setting/addAreaWiseLandType"><i class="fa fa-plus"></i></button>
                          </div>
                          <select class="form-control" name="land_type" id = "set_fiscal_year" required="required">
                            <option value="">जग्गाको क्षेत्रगत किसिम गर्नुहोस्</option>
                            <?php
                            $selected = '';
                            if(!empty($row['id'])) {
                              $selected = $row['road_type'];
                            }
                            if(!empty($settings_land_area_type)) : 
                              foreach ($settings_land_area_type as $key => $type) : ?>
                                <option value="<?php echo $type['id']?>" 
                                  <?php 
                                  if(!empty($row['id'])) {
                                    if($row['road_type'] == $road['id']) {
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
                            <input type="number" class="form-control" placeholder=""  name="min_amount" required="required" value="<?php if(!empty($row['id'])){ echo $row['ward'];} ?>">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>अधिक्कतम मुल्य<span style="color:red">*</span></label>
                            <input type="number" class="form-control" placeholder=""  name="max_amount" required="required" value="<?php if(!empty($row['id'])){ echo $row['ward'];} ?>">
                          </div>
                        </div>
                        <div class="col-md-12 text-center">
                          <hr>
                          <button class="btn btn-primary btn-xs" data-toggle="tooltip" title=" सेभ  गर्नुहोस्" name="Submit" type="submit" value="Submit"> सेभ गर्नुहोस्</button>
                          <a href="<?php echo base_url()?>Setting/SadakKoKisim" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्">रद्द गर्नुहोस्</a>
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
  <script type="text/javascript">
    $(document).off('submit', '#add_new_kar_rate').on('submit', '#add_new_kar_rate', function(e){
      e.preventDefault();
      var obj = $(this),
      url = obj.attr('action'),
      form_data = new FormData(obj[0]);
      $.ajax({
        url : url,
        dataType: 'json',
        contentType: false,
        processData: false,
        data : form_data,
        type : "POST",
        beforeSend: function () {
          $('.spin-loader').show();
        },
        complete: function () {
          $('.spin-loader').hide();
        },
        success: function(resp) {
          if(resp.status == 'success') {
            $('.error_message').html(resp.data);
            location.reload();
          } 
          if (resp.status = 'error') {
            if(resp.messase == 'form_error') {
              $.each(resp.data, function(index, element) {
                $('.error_message').html('<div class="revenue-head"><ul><li>'+resp.data+'</li></ul></div>');
              });
            }
            if(resp.messase == 'du_error') {
              $('.error_message').html(resp.data);

            }
          }
        }, 
        error: function() {
          alert('Internal Server Error!');
        }
      });
    }); 
    $('#dynamic-table').dataTable({});
    
    
    </script>
