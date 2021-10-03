<style type="text/css">
  .card-header{
    background: #1b5693;
  }
</style>
<section id="main-content">
  <section class="wrapper site-min-height">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url()?>BusinessRegister">व्यावसायको दर्ता अभिलेख</a></li>
          <li class="breadcrumb-item"><a href="javascript:;">नयाँ थप्नुहोस्</a></li>
      </ol>
    </nav>

    <form class="form" method="post" action="<?php echo base_url()?>BusinessRegister/Save" enctype ="multipart/form-data">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
      <div class="row">
        <div class="col-sm-12">
           <?php $ERR_VALIDATION = $this->session->flashdata("ERR_VALIDATION");
              if(!empty($ERR_VALIDATION)) { ?>
              <div class="alert alert-danger">
                  <button class="close" data-close="alert"></button>
                  <span> <?php echo $ERR_VALIDATION;?> </span>
              </div>
            <?php } ?>
          <?php $success_message = $this->session->flashdata("MSG_EMP");
              if(!empty($success_message)) { ?>
              <div class="alert alert-success">
                  <button class="close" data-close="alert"></button>
                  <span> <?php echo $success_message;?> </span>
              </div>
            <?php } ?>

             <?php $ERR_UPLOAD = $this->session->flashdata("ERR_UPLOAD");
              if(!empty($ERR_UPLOAD)) { ?>
              <div class="alert alert-success">
                  <button class="close" data-close="alert"></button>
                  <span> <?php echo $ERR_UPLOAD;?> </span>
              </div>
            <?php } ?>
          <section class="card">
            <header class="card-header text-light ">
              उद्योग / व्यावसायको दर्ता अभिलेख थप्नुहोस
            </header>
            <div class="card-body">
              <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>आर्थिक वर्ष <span style="color:red">*</span></label>
                      <div class="">
                        <select class="form-control" name="fiscal_year"  >
                          <option value="">छान्नुहोस्</option>
                          <?php $fy = current_fiscal_year();?>
                          <?php  foreach($fiscal_year as  $data): ?>
                            <option value="<?php echo $data['year']?>" <?php if($data['year'] == $fy['year']){echo 'selected';} ?>><?php echo $data['year']?> </option>
                          <?php  endforeach; ?>       
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>दर्ता मिती<span style="color: red"> **:</span></label>
                      <div class="input-group">
                        <input type="text" id="nepaliDateD" name="register_date" class="form-control nepali-calendar" value=""/>
                        <div class="input-group-prepend">
                          <button type="button" class="input-group-text btn btn-danger" title=""><i class="fa fa-calendar"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>प्रमाणपत्र नं<span style="color: red"> **:</span></label>
                      <input type="text" class="form-control certificate_no" placeholder=""  name="certificate_no" value="">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                     <label> प्रोप्राइटरको नाम र थर<span style="color: red"> **:</span></label>
                     <input type="text" class="form-control owner_name" placeholder=""  name="owner_name" value="">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>प्रोप्राइटरको लिंग<span style="color: red"> **:</span></label>
                      <select name="owner_gender" class="form-control dd_select">
                        <option value="">छान्नुहोस् </option>
                        <option value="पुरुष">पुरुष</option>
                        <option value="महिला">महिला</option>
                        <option value="अन्य">अन्य</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>सम्पर्क नं<span style="color: red"> **:</span></label>
                      <input type="text" class="form-control owner_number" placeholder=""  name="owner_number" value="">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>नागरिता नं<span style="color: red"> **:</span></label>
                      <input type="text" class="form-control owner_number" placeholder=""  name="czn_no" value="">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>नागरिता जारी मिती<span style="color: red"> **:</span></label>
                      <div class="input-group">
                        <input type="text" id="czn_date" name="czn_date" class="form-control nepali-calendar czn_date" value=""/>
                        <div class="input-group-prepend">
                          <button type="button" class="input-group-text btn btn-danger" title=""><i class="fa fa-calendar"></i></button>
                        </div>
                      </div>
                      <!-- <input type="text" class="form-control owner_number" placeholder=""  name="czn_date" value=""> -->
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>नागरिता जारी जिल्ला<span style="color: red"> **:</span></label>
                      <select class="form-control select_option" name="czn_dis"  >
                        <option value="">छान्नुहोस्</option>
                        <?php  foreach($dis as  $district): ?>
                          <option value="<?php echo $district['name']?>" ><?php echo $district['name']?> </option>
                        <?php  endforeach; ?>       
                      </select>
                    <!--   <input type="text" class="form-control owner_number" placeholder=""  name="czn_dis" value=""> -->
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                        <label>प्रोप्राइटरको फोटो<span style="color: red"> **:</span></label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="userfile" class="form-control">
                            <!-- <input type="file" class="custom-file-input" id="inputGroupFile01"
                            aria-describedby="inputGroupFileAddon01" name="userfile">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label> -->
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>सडकको नाम<span style="color: red"> **:</span></label>
                      <input type="text" class="form-control owner_road_name" placeholder=""  name="owner_road_name" value="">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>घर नम्बर<span style="color: red"> **:</span></label>
                      <input type="text" class="form-control owner_house_no" placeholder=""  name="owner_house_no" value="">
                    </div>
                  </div>
              </div>
            </div>
          </section>
        </div>
        <div class="col-sm-6">
          <section class="card">
            <header class="card-header text-light ">
              स्थायी ठेगाना
            </header>
            <div class="card-body">
              <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>नगरपालिका / गाउँपालिकाको नाम<span style="color: red"> **</span></label>
                      <input type="text" class="form-control owner_per_napa" placeholder="बिदुर नगरपालिका"  name="owner_per_napa" value="<?php echo GNAME?>">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>वार्ड नं<span style="color: red"> **:</span></label>
                      <select name="owner_per_ward" class="form-control owner_per_ward dd_select " id="owner_per_ward">
                        <option value="">छान्नुहोस्</option>
                        <?php if(!empty($ward)) :
                          foreach ($ward as $key => $w) : ?>
                            <option value="<?php echo $w['name']?>" ><?php echo 'वडा नं-'.$this->mylibrary->convertedcit($w['name'])?></option>
                          <?php endforeach;endif;?>
                        </select>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                       <label>टोल/गाउँ<span style="color: red"> **:</span></label>
                            <input type="text" class="form-control owner_per_tol" placeholder=""  name="owner_per_tol" value="">
                    </div>
                  </div>
              </div>
            </div>
          </section>
        </div>
        <div class="col-sm-6">
          <section class="card">
            <header class="card-header text-light ">
              हालको ठेगाना 
            </header>
            <div class="card-body">
              <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>नगरपालिका / गाउँपालिकाको नाम<span style="color: red"> **: </span></label>
                      <input type="text" class="form-control owner_present_na" placeholder="बिदुर नगरपालिका"  name="owner_present_na" value="<?php echo GNAME?>">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>वार्ड नं<span style="color: red"> **:</span></label>
                      <select name="owner_present_ward" class="form-control owner_present_ward dd_select " id="owner_present_ward">
                        <option value="">छान्नुहोस्</option>
                        <?php if(!empty($ward)) :
                          foreach ($ward as $key => $w) : ?>
                            <option value="<?php echo $w['name']?>" ><?php echo 'वडा नं-'.$this->mylibrary->convertedcit($w['name'])?></option>
                          <?php endforeach;endif;?>
                        </select>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                       <label>टोल/गाउँ<span style="color: red"> **:</span></label>
                            <input type="text" class="form-control owner_present_tol" placeholder=""  name="owner_present_tol" value="">
                    </div>
                  </div>
              </div>
            </div>
          </section>
        </div>
        <div class="col-sm-12">
         
          <section class="card">
            <header class="card-header text-light ">
              व्यवसायको विवरण
            </header>
            <div class="card-body">
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                        <label>पुँजी रू<span style="color: red"> **:</span></label>
                        <input type="text" class="form-control firm_capital" placeholder=""  name="firm_capital" value="">
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>फर्मको उदेश्य<span style="color: red"> **:</span></label>
                      <input type="text" class="form-control firm_aim" placeholder=""  name="firm_aim" value="">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                     <label> फर्ममा संलग्न जनशक्ती (जना)<span style="color: red"> **:</span></label>
                     <input type="text" class="form-control firm_employee_no" placeholder=""  name="firm_employee_no" value="">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>फर्मको शाखा<span style="color: red"> **:</span></label>
                      <input type="text" class="form-control firm_branch" placeholder=""  name="firm_branch" value="">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                        <label>फर्मको नाम<span style="color: red"> **:</span></label>
                        <input type="text" class="form-control firm_name_nepali" placeholder=""  name="firm_name_nepali" value="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>फर्मको नाम ( अंग्रेजीमा ) <span style="color: red"> **:</span></label>
                      <input type="text" class="form-control firm_name_en" placeholder=""  name="firm_name_en" value="">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>उद्योग / व्यवसायको किसिम (आम्दानी रशिद अनुसार) :<span style="color: red"> **:</span></label>
                      <input type="text" class="form-control firm_income_bill" placeholder=""  name="firm_income_bill" value="">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>श्रेणी<span style="color: red"> **:</span></label>
                      <input type="text" class="form-control firm_level" placeholder=""  name="firm_level" value="">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>ठेगाना <span style="color: red"> **:</span></label>
                      <input type="text" class="form-control firm_address" placeholder=""  name="firm_address" value="">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>वडा नं <span style="color: red"> **:</span></label>
                     <!--  <input type="text" class="form-control firm_ward" placeholder=""  name="firm_ward" value=""> -->
                     <!--  <input type="text" class="form-control firm_ward" placeholder=""  name="firm_ward" value=""> -->
                      <select name="firm_ward" class="form-control firm_ward dd_select " id="firm_ward">
                        <option value="">छान्नुहोस्</option>
                        <?php if(!empty($ward)) :
                          foreach ($ward as $key => $w) : ?>
                            <option value="<?php echo $w['name']?>" ><?php echo 'वडा नं-'.$this->mylibrary->convertedcit($w['name'])?></option>
                          <?php endforeach;endif;?>
                        </select>
                     <!--  <input type="text" class="form-control firm_ward" placeholder=""  name="firm_ward" value=""> -->
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>टोल/गाउँ <span style="color: red"> **:</span></label>
                      <input type="text" class="form-control firm_tol" placeholder=""  name="firm_tol" value="">
                    </div>
                  </div>
              </div>
            </div>
          </section>
        </div>
        <div class="col-sm-12">
          <section class="card">
            <header class="card-header text-light ">
              फर्म संचालन हुने घर वा जग्गाको स्वामित्व रहेको व्यक्तिको नाम र ठेगाना :
            </header>
            <div class="card-body">
              <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>नाम<span style="color: red"> **</span></label>
                      <input type="text" class="form-control firm_operator_name"  name="firm_operator_name" value="">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>ठेगाना <span style="color: red"> **:</span></label>
                     <input type="text" class="form-control firm_operator_address" placeholder="बिदुर नगरपालिका"  name="firm_operator_address" value="<?php echo GNAME?>">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                       <label>भाडामा लिएको भएमा मासिक भाडा रकम<span style="color: red"> **:</span></label>
                            <input type="text" class="form-control firm_land_rent" placeholder=""  name="firm_land_rent" value="">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                       <label>सडकको नाम<span style="color: red"> **:</span></label>
                            <input type="text" class="form-control firm_road_name" placeholder=""  name="firm_road_name" value="">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                       <label>घर नम्बर<span style="color: red"> **:</span></label>
                            <input type="text" class="form-control firm_house_number" placeholder=""  name="firm_house_number" value="">
                    </div>
                  </div>
                  
              </div>
            </div>
          </section>
        </div>
        <div class="col-sm-12">
          <section class="card">
            <header class="card-header text-light ">
             करदाताको कारोबारको विवरण (फर्ममा हुने कारोबारहरु)
            </header>
            <div class="card-body">
              <div class="row">
                  <table class="table" id="add_new_fields">
                    <thead>
                      <tr>
                        <th>कारोबारको नाम</th>
                        <th>ठेगाना</th>
                        <th>सुरू मिती</th>
                        <th>प्रमाणित गर्ने</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="dynamic-fields">
                        <td>
                          <input type="text" name="trans_name[]" class="form-control">
                        </td>
                        <td>
                          <input type="text" name="trans_address[]" class="form-control">
                        </td>
                        <td>
                          <!-- <input type="text" name="trans_date[]" class="form-control"> -->
                          <div class="input-group">
                            <input type="text" id="trans_date" name="trans_date[]" class="form-control nepali-calendar" value=""/>
                            <div class="input-group-prepend">
                              <button type="button" class="input-group-text btn btn-danger" title=""><i class="fa fa-calendar"></i></button>
                            </div>
                          </div>
                        </td>
                        <td>
                          <input type="text" name="trans_verify[]" class="form-control">
                        </td>
                        <td><button type="button" class="btn btn-sm btn-primary btnAddNew">नयाँ थप्नुहोस्</button></td>
                      </tr>
                    </tbody>
                  </table>
              </div>
              <div class="col-md-12 text-center">
                <hr>
                <button class="btn btn-primary btn-xs btn-save btn_save_nagadi" data-toggle="tooltip" title="" name="Submit" type="submit" value="Submit" id="btn_save_details" data-original-title=" सेभ  गर्नुहोस्"> सेभ गर्नुहोस्</button>
                <a href="<?php echo base_url()?>BusinessRegister" class="btn btn-danger btn-xs" data-toggle="tooltip" title="" data-original-title="सम्पादन गर्नुहोस्">रद्द गर्नुहोस्</a>
              </div>
            </div>
          </section>
        </div>
      </div>
  </form>
  </section>
</section>
<script type="text/javascript" src="<?php echo base_url()?>assets/assets/select2/js/select2.min.js"></script>
<script >
  $(document).ready(function(){
    $('.select_option').select2();
     $('.btnAddNew').click(function(e) {
        e.preventDefault();
        var trOneNew = $('#add_new_fields tr').length;
        var new_row =  '<tr class="nagadi_rasid_frm">'+
                          '<td><input type="text" name="trans_name[]" class="form-control"></td>'+
                          '<td><input type="text" name="trans_address[]" class="form-control"></td>'+
                          '<td><div class="input-group"><input type="text" id="trans_date_'+trOneNew+'" name="trans_date[]" class="form-control nepali-calendar" value=""/><div class="input-group-prepend"><button type="button" class="input-group-text btn btn-danger" title=""><i class="fa fa-calendar"></i></button></div></div></td>'+
                          '<td><input type="text" name="trans_verify[]" class="form-control"></td>'+
                          '<td><button type="button" class="btn btn-sm btn-danger remove-row">हटाउनुहोस्</button></td>'+
                        '</tr>';
        $("#add_new_fields").append(new_row);
         $('.nepali-calendar').nepaliDatePicker();
      });

      $("body").on("click",".remove-row", function(e){
        e.preventDefault();
        var id = $(this).data('id');
        if (confirm('के तपाइँ  यसलाई हटाउन निश्चित हुनुहुन्छ ?')) {
          $(this).parent().parent().remove();
        }
      });
});
</script>

<script type="text/javascript">
  $(document).ready(function(){
    var date = "<?php echo convertDate(date('Y-m-d'))?>";
    // $('#nepaliDateD').nepaliDatePicker({});
    // $('#czn_date').nepaliDatePicker({});
    $('.nepali-calendar').nepaliDatePicker();
    // $('#nepaliDateE').nepaliDatePicker({});
    // $('#nepaliDateF').nepaliDatePicker({});

    $(document).on('click', '.btn-search', function(){
      var obj = $(this);
      var date = $('#nepaliDateD').val();
      var date = $('#nepaliDateE').val();
      var date = $('#nepaliDateF').val();
      var fy = $('#fy').val();
      var ward = $('#ward').val();
      $.ajax({
        url:"<?php echo base_url()?>AllReport/searchReport",
        method:"POST",
        data:{date:date,fy:fy,ward:ward},
        // contentType: false,
        // processData: false,
        beforeSend: function () {
          obj.html('<i class="fa fa-spinner fa-spin"></i> खोज्नुहोस');
        },
        success:function(resp){
          if(resp.status == 'success') {
           // console.log(resp);
            $('.adv-table').empty().html(resp.data);
            obj.html('खोज्नुहोस');
          }
        }
      }); 
    });
    
  })
</script>
