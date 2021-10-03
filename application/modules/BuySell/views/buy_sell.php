 <!--main content start-->
 <style type="text/css">
   table, tr, td {
      border: none;
    }
 </style>
 <section id="main-content">

  <section class="wrapper site-min-height">

    <nav aria-label="breadcrumb">

      <ol class="breadcrumb">

        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a>

        </li>

        <li class="breadcrumb-item"><a href="javascript:;">व्यक्तिगत अभिलेख</a></li>

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
            <h3>जग्गा दिनेको क्र.स नम्बर *(हटाउन / घटाउन पर्नेको )</h3>
          </header>

          <div class="card-body">
            <div class="row">
              <div class="col-sm-12">
                <select class="form-control dd_select" id="file_no" name="file_no" required>
                  <option value="">जग्गा दिनेको क्र.स नम्बर छान्नुहोस्</option>
                  <?php 
                  if(!empty($profile)) :
                    foreach ($profile as $key => $p) : ?><option value="<?php echo  $p['file_no']?>"> <?php echo $p['land_owner_name_np']?> (<?php echo  $p['file_no']?>)</option><?php endforeach; endif;?>
                  </select>
                <hr>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="buysellfrm">
                  
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

    <!-- page end-->

  </section>

</section>

<script type="text/javascript" src="<?php echo base_url()?>assets/assets/select2/js/select2.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() { 


    $('.btnAddNew').click(function(e) {
      e.preventDefault();
      var new_row = 
             '<tr class="productPurchaseFields" id="add_new_fields" data-id="1">'+
                '<td align="center"><select class="form-control dd_select" name ="buyer_file_no[]"><option value="">क्र.स नम्बर </option><?php  if(!empty($profile)) : foreach ($profile as $key => $p) : ?><option value="<?php echo  $p['file_no']?>"> <?php echo $p['land_owner_name_np']?> (<?php echo  $p['file_no']?>)</option><?php endforeach; endif;?></td>'+
                 '<td><input type="text" name="new_kitta_no[]" class="form-control"></td>'+
                 
                  '<td style="width: 100px;">'+
                        '<input type="text" class="form-control new_ropani" placeholder="रोपनी" name="new_ropani[]">'+
                  '</td>'+
                  '<td style="width: 100px;">'+
                      '<input type="text" class="form-control new_aana" placeholder="आना" name="new_aana[]">'+
                  '</td>'+
                  '<td style="width: 100px;">'+
                    '<input type="text" class="form-control new_paisa" placeholder="पैसा" name ="new_paisa[]" >'+
                  '</td>'+
                  '<td style="width: 100px;">'+
                     '<input type="text" class="form-control new_dam" placeholder="दाम" name="new_dam[]">'+
                 '</td>'+
                  '<td style="width: 150px;">'+
                     '<input type="text" class="form-control new_sq_feet" placeholder = "sq. feet" name="new_sq_feet[]">'+
                  '</td>'+
                  '<td style="width: 150px;">'+
                     '<input type="text" class="form-control new_sq_meter" placeholder="sq. meter" name="new_sq_meter[]">'+
                  '</td>'+

                  '<td>'+
                      '<input type="text" placeholder="" class="form-control new_total_land_rate" name="new_total_land_rate[]">'+
                   '</td>'+
                '<td><button type="button" class="btn btn-danger delete_row" data-toggle="tooltip" title="हटाउनुहोस्"><span class="fa fa-trash-o" tabindex="-1"></span> हटाउनुहोस</button></td>'+
              '<tr>'
            $("#add_new_fields").append(new_row);
            $('.dd_select').select2();
        });

    
    $("body").on("click",".delete_row", function(e){
      e.preventDefault();
      if (confirm('के तपाइँ  यसलाई हटाउन निश्चित हुनुहुन्छ ?')) {
        var amt = $(this).closest("tr").find('.topic_rate').val();
        var t_amt = $('#t_total').val();
        var new_amt = t_amt-amt;
        $("#t_total").val(new_amt);
        $(this).parent().parent().remove();
      }
    });
    //$("#add_more_kitta").hide();
    $("#all_area").click(function() {
      if($(this).is(":checked")) {
        $("#add_more_kitta").hide(300);
        var total_sqmeter  = $('#total_sqmeter').val();
        var total_land_area  = $('#total_land_area').val();
        var min_land_rate   = $('#min_land_rate').val();
        var t_rate  = $('#t_rate').val();
        var j_ropani        = $('#j_ropani').val();
        var j_aana          = $('#j_aana').val();
        var j_paisa         = $('#j_paisa').val();
        var j_dam           = $('#j_dam').val();
        $('.new_ropani').val(j_ropani);
        $('.new_aana').val(j_aana);
        $('.new_paisa').val(j_paisa);
        $('.new_dam').val(j_dam);
        $('.new_sq_feet').val(total_land_area);
        $('.new_sq_meter').val(total_sqmeter);
        $('.new_total_land_rate').val(t_rate);
        $('.new_ropani').attr('readonly',true);
        $('.new_aana').attr('readonly',true);
        $('.new_paisa').attr('readonly',true);
        $('.new_dam').attr('readonly',true);
        $('.new_sq_feet').attr('readonly',true);
        $('.new_sq_meter').attr('readonly',true);
        $('.new_total_land_rate').attr('readonly',true);
      } else {
        $('.new_ropani').val('');
        $('.new_aana').val('');
        $('.new_paisa').val('');
        $('.new_dam').val('');
        $('.new_sq_feet').val('');
        $('.new_sq_meter').val('');
        $('.new_total_land_rate').val('');
        $("#add_more_kitta").show(200);
        $('.new_ropani').removeAttr('readonly');
        $('.new_aana').removeAttr('readonly');
        $('.new_paisa').removeAttr('readonly');
        $('.new_dam').removeAttr('readonly');
        $('.new_sq_feet').removeAttr('readonly');
        $('.new_sq_meter').removeAttr('readonly');
        $('.new_total_land_rate').removeAttr('readonly');
      }
    });

    $("#same_kitta").click(function() {
      if($(this).is(":checked")) {
        $("#add_more_kitta").hide(300);
      } else {
        $("#add_more_kitta").show(300);;
      }
    });


    $('.dd_select').select2();
    $(document).on('change','#file_no', function(){
      obj = $(this);
      var file_no = obj.val();
      $.ajax({
        url:base_url+"BuySell/getLandOwnerDetails",
        type:"POST",
        data:{file_no:file_no},
        success:function(resp){
          if(resp.status == 'success') {
            $('.buysellfrm').html(resp.data);
          }
        }
      });
    });

    

  //
  $(document).on('input','.total_sqft', function(){
    obj = $(this);
    var new_area = obj.val();
    var total_area = $('#total_land_area').val();
    $('#r_area').val(new_area);
    var kubul_rate = $('#new_k_amount').val();
    r = 0;
    var total_value = new_area;
    var one_ropani = 5476;
    var one_aana = 342.25;
    var one_paisa = 85.56;
    var one_dam = 21.39;
    //-----------------------------------------
    var r = total_value - one_ropani;
    var ropani = total_value / one_ropani;
    var a = Math.trunc(ropani);
    var b = a * one_ropani;
    var c = total_value - b;
    var aana = c / one_aana;
    //--------------------------------------------
    var total_aana = Math.trunc(aana);
    var rem_sqft_after_aana = total_aana * one_aana;
    var d = c - rem_sqft_after_aana;
    var t_paisa = d / one_paisa;
    //----------------------------------------
    var t_paisa_p = Math.trunc(t_paisa);
    var rem_t_paisa = t_paisa_p * one_paisa;
    var e = d - rem_t_paisa;
    var t_dam = e / one_dam;

    var tt_ropani = a;
    var tt_aana = total_aana;
    var tt_paisa = Math.trunc(t_paisa);
    var tt_dam = t_dam.toFixed(0);
    //console.log(tt_ropani+'-'+tt_aana+'-'+tt_paisa+'-'+tt_dam);
    var ropani_amount = tt_ropani * kubul_rate;
    var aana_rate = tt_aana / 16;
    var paisa_rate = tt_paisa / 64;
    var dam_rate = tt_dam / 256;


    var aana_amount = aana_rate * kubul_rate;
    var paisa_amount = paisa_rate * kubul_rate;
    var dam_amount = dam_rate * kubul_rate
    var total_amount = ropani_amount + aana_amount + paisa_amount + dam_amount;
    $('#n_t_amount').val(total_amount);
    $('#r_t_amount').val(total_amount);


    $('#n_ropani').val(tt_ropani);
    $('#n_aana').val(tt_aana);
    $('#n_paisa').val(tt_paisa);

    // if($('#n_dam').val == 4 ) {
    //   var dam = paisa + 1;;
    // }
    $('#n_dam').val(tt_dam);

  });

  $(document).on('input','.new_ropani, .new_aana , .new_paisa ,.new_dam', function() {
    obj =$(this);
    var one_ropani  = "5476"; //one ropani = 5476 sq feet
    var one_aana    = "342.25"; //one aana = 342.25
    var one_paisa   = "85.56"; // one paisa = 85.25
    var one_dam     = "21.39";
    var total_sq    = obj.closest("tr").find('.total_sqft').val()||0;
    var ropani      = obj.closest("tr").find('.new_ropani').val()||0;
    var aana        = obj.closest("tr").find('.new_aana').val()||0;
    var paisa       = obj.closest("tr").find('.new_paisa').val()||0;
    var dam         = obj.closest("tr").find('.new_dam').val()||0;
    if (aana > 15) {
      alert('आना १५ भन्दा बढि हुन सक्दैन');
      aana = 0;
      obj.closest("tr").find('.new_aana').val(0);
    }
    if (paisa > 3.9) {
      alert('पैसा ३.९ भन्दा बढि हुन सक्दैन');
      obj.closest("tr").find('.new_paisa').val(0);
      paisa = 0;
    }
    if (dam > 3.9) {
      alert('दाम ३.९  भन्दा बढि हुन सक्दैन');
      obj.closest("tr").find('.new_dam').val(0);
      dam = 0;
    }

    var total_ropani_sqft = ropani  * one_ropani;
    var total_aana_sqft   = aana    * one_aana;
    var total_paisa_sqft  = paisa   * one_paisa;
    var total_dam_sqft    = dam     * one_dam;
    var total_cal_sqlfeet = total_ropani_sqft + total_aana_sqft + total_paisa_sqft + total_dam_sqft;
    obj.closest("tr").find('.new_sq_feet').val(total_cal_sqlfeet.toFixed(2));
    var total_sqft        = obj.closest("tr").find('.new_sq_feet').val();
    var ropani_amount     = ropani * kubul_rate;
    var aana_rate         = aana / 16; //aana into ropani
    var paisa_rate        = paisa / 64; //paisa into ropani
    var dam_rate          = dam / 256; //dam into ropani.
    var kubul_rate = $('#t_kubul_amount').val()||0;
    var ropani_amount = ropani * kubul_rate;
    var aana_amount = aana_rate * kubul_rate;
    var paisa_amount = paisa_rate * kubul_rate;
    var dam_amount = dam_rate * kubul_rate
    var total_amount = ropani_amount + aana_amount + paisa_amount + dam_amount;
    obj.closest("tr").find('.new_total_land_rate').val(total_amount.toFixed(2));
  });

    // $(document).on('input', '#n_ropani, #n_aana, #n_paisa, #n_dam', function() {
    //   obj = $(this);
    //   var kubul_rate = $('#t_kubul_amount').val();
    //   var one_ropani = "5476";

    //   var one_aana = "342.25";

    //   var one_paisa = "85.56";

    //   var one_dam = "21.39";

    // //var total_sq = $('.total_sqft').val();

    // var ropani = $('.ropani').val();

    // var aana = $('.aana').val();

    // var paisa = $('.paisa').val();

    // var dam = $('.dam').val();
    // if (aana > 15) {

    //   alert('आना १५ भन्दा बढि हुन सक्दैन');

    //   $('.aana').val(0);

    //   aana = 0;

    // }

    // if (paisa > 3.9) {

    //   alert('पैसा ३.९ भन्दा बढि हुन सक्दैन');

    //   $('.paisa').val(0);

    //   paisa = 0;

    // }

    // if (dam > 3.9) {

    //   alert('दाम ३.९  भन्दा बढि हुन सक्दैन');

    //   $('.dam').val(0);

    //   dam = 0;

    // }

    // var total_ropani_sqft = ropani * one_ropani;

    // var total_aana_sqft = aana * one_aana;

    // var total_paisa_sqft = paisa * one_paisa;

    // var total_dam_sqft = dam * one_dam;

    // // $('.r_sqft').html('<span class="label label-success">' + total_ropani_sqft +

    // //   ' sqft </span>');

    // // $('.a_sqft').html('<span class="label label-success">' + total_aana_sqft + ' sqft </span>');

    // // $('.p_sqft').html('<span class="label label-success">' + total_paisa_sqft + ' sqft </span>');

    // // $('.d_sqft').html('<span class="label label-success">' + total_dam_sqft + ' sqft </span>');

    // var total_cal_sqlfeet = total_ropani_sqft + total_aana_sqft + total_paisa_sqft + total_dam_sqft

    // $('.total_sqft').val(total_cal_sqlfeet.toFixed(2));
    // var total_sqft = $('.total_sqft').val();


    //   // var tt_ropani = a;
    //   // var tt_aana = total_aana;
    //   // var tt_paisa = Math.trunc(t_paisa);
    //   // var tt_dam = t_dam.toFixed(0);

    //   var ropani_amount = ropani * kubul_rate;
    //   var aana_rate = aana / 16;
    //   var paisa_rate = paisa / 64;
    //   var dam_rate = dam / 256;


    //   var aana_amount = aana_rate * kubul_rate;
    //   var paisa_amount = paisa_rate * kubul_rate;
    //   var dam_amount = dam_rate * kubul_rate
    //   var total_amount = ropani_amount + aana_amount + paisa_amount + dam_amount;
    //   $('#n_t_amount').val(total_amount);
    //   $('#r_t_amount').val(total_amount);


    //   // var aana_amount = aana_rate * kubul_rate;
    //   // var paisa_amount = paisa_rate * kubul_rate;
    //   // var dam_amount = dam_rate * kubul_rate
    //   // var total_amount = ropani_amount + aana_amount + paisa_amount + dam_amount;
    //   // $('#n_t_amount').val(total_amount);
    //   // $('#r_t_amount').val(total_amount);
    // // var meter_to_sqft = total_sqft * 10.76391204;
    // // $('.meter_sqft').val(meter_to_sqft.toFixed(2));

    //     //var total_value = meter_to_sqft;



    //     //-------------------------------------------------//

    //     // var kubul_rate = $('.kubul_rate').val();

    //     // var ropani = $('.ropani').val();

    //     // var aana = $('.aana').val();

    //     // var paisa = $('.paisa').val();

    //     // var dam = $('.dam').val();

    //     // var ropani_amount = ropani * kubul_rate;

    //     // var aana_rate = aana / 16;

    //     // var paisa_rate = paisa / 64;

    //     // var dam_rate = dam / 256;

    //     // var aana_amount = aana_rate * kubul_rate;

    //     // var paisa_amount = paisa_rate * kubul_rate;

    //     // var dam_amount = dam_rate * kubul_rate

    //     // var total_amount = ropani_amount + aana_amount + paisa_amount + dam_amount;

    //     // $('.tax_amount').val(total_amount.toFixed(2)); 



    //   });



    // // $(document).on('input', '.total_sqft', function() {

    // //   obj = $(this);

    // //   r = 0;

    // //   var total_value = obj.val();

    // //   var one_ropani = 5476;

    // //   var one_aana = 342.25;

    // //   var one_paisa = 85.56;

    // //   var one_dam = 21.39;

    // // //-----------------------------------------

    // // var r = total_value - one_ropani;

    // // var ropani = total_value / one_ropani;

    // // var a = Math.trunc(ropani);

    // // var b = a * one_ropani;

    // // var c = total_value - b;

    // // var aana = c / one_aana;

    // // //--------------------------------------------

    // // var total_aana = Math.trunc(aana);

    // // var rem_sqft_after_aana = total_aana * one_aana;

    // // var d = c - rem_sqft_after_aana;

    // // var t_paisa = d / one_paisa;

    // // //----------------------------------------

    // // var t_paisa_p = Math.trunc(t_paisa);

    // // var rem_t_paisa = t_paisa_p * one_paisa;

    // // var e = d - rem_t_paisa;

    // // var t_dam = e / one_dam;



    // // $('.ropani').val(a);

    // // //--------------------------

    // // $('.aana').val(total_aana);

    // // $('.paisa').val(Math.trunc(t_paisa));

    // // $('.dam').val(t_dam.toFixed(0));





    // //     // -------------------------calculate total rate

    // //     //---------------------------------------------

    // //     var kubul_rate = $('.kubul_rate').val();

    // //     var ropani = $('.ropani').val();

    // //     var aana = $('.aana').val();

    // //     var paisa = $('.paisa').val();

    // //     var dam = $('.dam').val();

    // //     var ropani_amount = ropani * kubul_rate;

    // //     var aana_rate = aana / 16;

    // //     var paisa_rate = paisa / 64;

    // //     var dam_rate = dam / 256;

    // //     var aana_amount = aana_rate * kubul_rate;

    // //     var paisa_amount = paisa_rate * kubul_rate;

    // //     var dam_amount = dam_rate * kubul_rate

    // //     var total_amount = ropani_amount + aana_amount + paisa_amount + dam_amount;

    // //     $('.tax_amount').val(total_amount.toFixed(2)); 



    // //     // var aana_amount = aana_rate * kubul_rate;

    // //     // var paisa_amount = paisa_rate * kubul_rate;

    // //     // var dam_amount = dam_rate * kubul_rate

    // //     // var total_amount = ropani_amount + aana_amount + paisa_amount + dam_amount;

    // //     // $('.tax_amount').val(total_amount.toFixed(2)); 





    // //   });



    // $(document).on('input', '.meter_sqft', function() {

    //   obj = $(this);

    //   r = 0;

    //   var meter_square = obj.val();

    //     // alert(meter_square);

    //     var meter_to_sqft = meter_square * 10.76391204;

    //     $('.total_sqft').val(meter_to_sqft.toFixed(2));

    //     var total_value = meter_to_sqft;

    //     var one_ropani = 5476;



    //     var one_aana = 342.25;

    //     var one_paisa = 85.56;

    //     var one_dam = 21.39;

    //     //-----------------------------------------

    //     var r = total_value - one_ropani;

    //     var ropani = total_value / one_ropani;

    //     var a = Math.trunc(ropani);

    //     var b = a * one_ropani;

    //     var c = total_value - b;

    //     var aana = c / one_aana;

    //     //--------------------------------------------

    //  // $('.dam').val(t_dam.toFixed(0));
    // // });

  });//END OF DOM
</script>
