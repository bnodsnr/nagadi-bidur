
<style type="text/css">
  .select2-container--default .select2-selection--single {
    height: 36px;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
  line-height: 37px;
}
</style>
<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>PersonalProfile">
           प्रोफाइलको सुचीमा जानुहोस</a></li>
           <li class="breadcrumb-item"><a href="javascript:;"><i class="fa fa-circle" style="color:blue"></i>
           पारिवारिक थप्नुहोस </a></li>
      </ol>
    </nav>
    <!-- page start-->
    <div class="row">
      <div class="col-sm-12">
        <form action ="<?php echo base_url()?>PersonalProfile/updateFamilyDetails" method="post" class="save_post">
          <input type = "hidden" name="form_type" value = "2">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
          <input type="hidden" name="file_no" value="<?php echo $file_no?>">
          <div class="row">
            <div class="col-md-12">
              <section class="card">
                <header class="card-header" style="background: #1b5693;color:#FFF">सम्पतिधनीको पारिबारिक विवरण : <?php echo $this->mylibrary->convertedcit($file_no)?> </header>
                <div class="card-body">
                  <div class="row">
                    <table class="table table-bordered" id="add_new_fields">
                      <thead>
                        <tr>
                          <th align="text-center">परिवार सदस्यहरुको नाम</th>
                          <th align="text-center">नाता</th>
                          <th align="text-center"> जन्म मिति </th>
                          <th align="text-center">नागरिकता नं</th>
                          <th align="text-center"> जन्म दर्ता नं</th>
                          <th align="text-center"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(!empty($family_detials)) : 
                            foreach ($family_detials as $key => $fd) : ?>
                              <input type="hidden" value="<?php echo $fd['id']?>" name="member_id[]">
                            <tr class="productPurchaseFields" id="partsPurchaseFields_1" data-id="1">
                              <td><input type="text" name="family_member_name[]" class="form-control " id="family_name_1" value="<?php echo $fd['member_name']?>" required></td>
                              <td>
                                <select name="family_member_relation[]" class="form-control dd_select" id="relation_1" required>
                                 <?php if(!empty($rel)) : 
                                   foreach ($rel as $key => $re) : ?>
                                    <option value="<?php echo $re['name']?>" <?php if($re['name'] == $fd['member_relation']){ echo 'selected';}?>><?php echo $this->mylibrary->convertedcit($re['name'])?></option>
                                  <?php endforeach;endif;?>   
                                </select>
                              </td>
                              <td>
                                <div class="form-group row">
                                  <div class="col-sm-10">
                                    <div class="col-sm-10">
                                      <input type="text" placeholder="" data-mask="9999/99/99" class="form-control" name="family_member_dob[]" value="<?php echo $fd['member_age']?>">
                                      <span class="help-inline">yyyy/mm/dd</span>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <div class="form-group row">
                                  <div class="col-sm-10">
                                    <input type="text" placeholder="" class="form-control" name="citizenship_no[]" value="<?php echo $fd['citizenship_no']?>">
                                  </div>
                                </div>
                              </td>
                              <td>
                                <div class="form-group row">
                                  <div class="col-sm-10">
                                    <input type="text" placeholder="" class="form-control" name="birth_darta[]" value="<?php echo $fd['birth_darta']?>" >
                                  </div>
                                </div>
                              </td>
                              <td>
                               <!--  <a href="<?php echo base_url()?>PersonalProfile/deleteFamailyMember/<?php echo $fd['id']?>" type="button" class="btn btn-flat btn-danger"><i class="fa fa-trash-o"></i> हटाउनुहोस</button> -->

                                <button type="button" class="btn btn-sm btn-danger btn-delete" data-id = "<?php echo $fd['id']?>" data-url ="<?php echo base_url()?>PersonalProfile/removeFamaily"><i class="fa fa-trash-o"></i>  हटाउनुहोस</button>
                              </td>
                            </tr>
                        <?php endforeach;endif;?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </section>
            </div>
            <hr>
            <div class="col-md-12 text-center">
              <button class="btn btn-primary btn-xs save_btn" data-toggle="tooltip" title=" सेभ  गर्नुहोस्" name="Submit" type="submit" value="Save"> सेभ गर्नुहोस्</button>
              <a href="<?php echo base_url()?>PersonalProfile" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्">रद्द गर्नुहोस्</a>
            </div>
        </form>
      </div>
    </div>
  </section>
</section>
<script type="text/javascript" src="<?php echo base_url()?>assets/assets/select2/js/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/nepali_datepicker/nepali.datepicker.v2.2.min.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>assets/assets/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.dd_select').select2();
    $('.nepaliDate5').nepaliDatePicker();
    $('#date_1').nepaliDatePicker();
    //add multiple fields
    $('.btnAddNew').click(function(e) {
      $('.nepaliDate5').nepaliDatePicker();
      e.preventDefault();
      var trOneNew = $('.partsPurchaseFields').length+1;
      var sn = $(this).closest('.sn_1').val();
      var new_row = 
          '<tr class ="partsPurchaseFields" id="partsPurchaseFields_'+trOneNew+'" data-id="'+trOneNew+'">'+
          '<td>'+
          '<input type="text" name="family_member_name[]" value="" class="form-control topic_fixed_rate">'+
          '</td>'+
         '<td>'+
          '<select class="form-control dd_select" name="family_member_relation[]" data-placeholder="छान्नुहोस्" id="main_topic'+trOneNew+'" data-id="'+trOneNew+'"><option value="">छान्नुहोस्</option><?php if(!empty($rel)) {
                          foreach ($rel as $key => $re) { ?><option value="<?php echo $re['name']?>"><?php echo $re['name']; } }?></option></select>'+
         
          '</td>'+
          '<td>'+
             '<input type="text" placeholder="" data-mask="9999/99/99" class="form-control" name="family_member_dob[]"><span class="help-inline">yyyy/mm/dd</span>'+
          '</td>'+
          '<td>'+
          '<div class="form-group row">'+
          '<div class="col-sm-10">'+
          '<input type="text" placeholder=""  class="form-control" name="citizenship_no[]">'+
          '</div>'+
          '</div>'+
          '</td>'+
          '<td>'+
          '<div class="form-group row">'+
          '<div class="col-sm-10">'+
          '<input type="text" placeholder="" class="form-control" name="birth_darta[]">'+
          '</div>'+
          '</div>'+
          '</td>'+
          '<td><button type="button" class="btn btn-danger remove-row" data-toggle="tooltip" title="हटाउनुहोस्"><span class="fa fa-trash-o" tabindex="-1"></span> हटाउनुहोस</button></td>'+
        '<tr>'
      $("#add_new_fields").append(new_row);
      $('.dd_select').select2();
      $('#date_'+trOneNew).nepaliDatePicker();
    });
    $("body").on("click",".remove-row", function(e){
      e.preventDefault();
      if (confirm('के तपाइँ  यसलाई हटाउन निश्चित हुनुहुन्छ ?')) {
        var amt = $(this).closest("tr").find('.topic_rate').val();
        var t_amt = $('#t_total').val();
        var new_amt = t_amt-amt;
        $("#t_total").val(new_amt);
        $(this).parent().parent().remove();
      }
    });

    //on change get distrist 
    $(document).on('change', '.npl_state', function() {
      obj = $(this);
      var state = obj.val();
      var name = $('#land_owner_name_en').val();
      var ganapa = $('.lo_gapanapa').val();
      var ward = $('.address_ward').val();
      $.ajax({
        url:base_url+'PersonalProfile/getDistrictByState',
        method:"POST",
        data:{state:state, name:name,gapana:ward,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
        success : function(resp){
          if(resp.status == 'success') {
            $('.npl_districts').html(resp.option);
          }
        }
      });
    });

    //onchange generate file no
    $(document).on('change','#address_ward', function() {
      obj = $(this);
      var address_ward = obj.val();
      var name = $('#land_owner_name_en').val();
      var ganapa = $('.lo_gapanapa').val();
      if(name == '') {
        alert('जग्गाधनिको नाम (अंग्रेजी)');
        return;
      }
      //alert(ganapa);
      $.ajax({
        url:base_url+'PersonalProfile/generateCode',
        method:"POST",
        data:{address_ward:address_ward,name:name,ganapa:ganapa,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
        success : function(resp){
          $("#lo_owner_symbol").val(resp);
        }
      });
    });

    $(document).on('input','#land_owner_name_en', function() {
      obj = $(this);
      var name = obj.val();
      if(name == '') {
        alert('जग्गाधनिको नाम (अंग्रेजी)');
        return
      }
      var address_ward = $('#address_ward').val();
      var ganapa = $('.lo_gapanapa').val();
      $.ajax({
        url:base_url+'PersonalProfile/generateCode',
        method:"POST",
        data:{address_ward:address_ward,name:name,ganapa:ganapa,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
        success : function(resp){
          $("#lo_owner_symbol").val(resp);
        }
      });
    });

    $(document).on('change','.lo_gapanapa',function(){
      var ganapa = $(this).val();
      var address_ward = $('#address_ward').val();
      var name = $('#land_owner_name_en').val();
      if(name == '') {
        alert('जग्गाधनिको नाम (अंग्रेजी)');
        return
      }
      $.ajax({
        url:base_url+'PersonalProfile/generateCode',
        method:"POST",
        data:{address_ward:address_ward,name:name,ganapa:ganapa,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
        success : function(resp){
          $("#lo_owner_symbol").val(resp);
        }
      });
    });

    $(document).on('change', '.npl_districts', function() {
      obj = $(this);
      var district = obj.val();
      $.ajax({
        url:base_url+'PersonalProfile/getGapanapaByDistricts',
        method:"POST",
        data:{district:district,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
        success : function(resp){
          if(resp.status == 'success') {
            $('.npl_gapana').html(resp.option);
            $('#lo_owner_symbol').val('');
          }
        }
      });
    });

    // --------------------------------------------//
    $(document).on('change', '.bi_state', function() {
      obj = $(this);
      var state = obj.val();
      $.ajax({
        url:base_url+'PersonalProfile/getDistrictByState',
        method:"POST",
        data:{state:state,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
        success : function(resp){
          if(resp.status == 'success') {
            $('.bi_districts').html(resp.option);
          }
        }
      });
    });

    $(document).on('change', '.bi_districts', function() {
      obj = $(this);
      var district = obj.val();
      $.ajax({
        url:base_url+'PersonalProfile/getGapanapaByDistricts',
        method:"POST",
        data:{district:district,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
        success : function(resp){
          if(resp.status == 'success') {
            console.log(resp.option);
            $('.bi_gapana').html(resp.option);
          }
        }
      });
    });



    $(document).on('input', '.per_tol', function(){
      var per_tol = $(this).val();
      $('.tem_tol').val(per_tol);
    });

    //per_house_no
    $(document).on('input', '.per_house_no', function(){
      var per_house_no = $(this).val();
      $('.tem_house_no').val(per_house_no);
    });

    $(document).on('click','#suchak_details', function(){
      var name = $('#land_owner_name_np').val();
      var ward = $('.p_address_ward').val();
     
      $('.form_filler_name').val(name);

      $("#app_relation option").each(function () {
        if ($(this).html() == "आफै") {
            $(this).attr("selected", "selected");
            return;
        }
      });

      $("#app_ward_no option").each(function () {
        if ($(this).html() == 3) {
            $(this).attr("selected", "selected");
            return;
        }
      });

      
     //  var s = $("#app_relation").prop("selectedIndex", 1).val();
     //  $('#app_relation').val(s);
     // // $('#app_relation  option[value="'+s+'"]').attr("selected");
     //  $('#app_relation').prop('selected','selected');
      // var s = $("#app_relation option:second").val();
      //alert(s);
    });

    $(document).on('input', '#land_owner_name_np', function(){
        var name = $(this).val();
        $('#family_name_1').val(name);
    });

    $(document).on('input','#citizenship_no', function(){
      var num = $(this).val();
      $.ajax({
        url:base_url+'PersonalProfile/convertNum',
        method:"POST",
        data:{num:num,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
        success : function(resp){
          $('#citizenship_no').val(resp);
        }
      });
    });

    $(document).on('input','#lo_pan_no', function(){
      var num = $(this).val();
      $.ajax({
        url:base_url+'PersonalProfile/convertNum',
        method:"POST",
        data:{num:num,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
        success : function(resp){
          $('#lo_pan_no').val(resp);
        }
      });
    });

    $(document).on('input','.contact_number', function(){
      var num = $(this).val();
      $.ajax({
        url:base_url+'PersonalProfile/convertNum',
        method:"POST",
        data:{num:num,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
        success : function(resp){
          $('.contact_number').val(resp);
        }
      });
    });
    //per_house_no
    $(document).on('input','.per_house_no', function(){
      var num = $(this).val();
      $.ajax({
        url:base_url+'PersonalProfile/convertNum',
        method:"POST",
        data:{num:num,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
        success : function(resp){
          $('.per_house_no').val(resp);
        }
      });
    });

     $(document).on('click','.btn-delete', function(e){
      //e.preventDefault();
      var id = $(this).data('id'); //Fetch id from modal trigger button
      var url = $(this).data('url');
      //alert(url);
      if (confirm("Are you sure want to delete?") == true) {
              $.ajax({
                type : 'POST',
                url : url, //Here you will fetch records 
                data: {id:id,'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'}, //Pass $id
                success : function(resp){
                //   return;
                  if(resp.status == 'success') {
                    toastr.options = {
                      "closeButton": true,
                      "debug": true,
                      "progressBar": true,
                      "positionClass": "toast-top-right",
                      "showDuration": "200",
                      "hideDuration": "1000",
                      "timeOut": "3000",
                      "extendedTimeOut": "1000",
                      "showEasing": "swing",
                      "hideEasing": "linear",
                      "showMethod": "fadeIn",
                      "hideMethod": "fadeOut"
                    };
                    toastr.success(resp.data);
                    setTimeout(function(){ 
                      location.reload();
                    }, 2000);
                  } else {
                    toastr.options = {
                      "closeButton": true,
                      "debug": true,
                      "progressBar": true,
                      "positionClass": "toast-top-right",
                      "showDuration": "300",
                      "hideDuration": "1000",
                      "timeOut": "5000",
                      "extendedTimeOut": "1000",
                      "showEasing": "swing",
                      "hideEasing": "linear",
                      "showMethod": "fadeIn",
                      "hideMethod": "fadeOut"
                    };
                    toastr.success(resp.data);
                    setTimeout(function(){ 
                      location.reload();
                    }, 2000);
                  }
                 }
              });
      } else {
        return false;
      }
    });
    
  });//end of dom 13-16-0387
</script>
