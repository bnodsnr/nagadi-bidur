<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">जग्गा किन बेच </a></li>
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
          <header class="card-header">
           जग्गा किन बेच 
           <span class="tools">
            <?php if($this->authlibrary->HasModulePermission('BUY-SELL', "ADD")) { ?>
              <a href = "<?php echo base_url()?>BuySell/addNew" class=" btn btn-primary btn-sm pull-right" title=""><i class="fa fa-plus"></i> नयाँ थप्नुहोस् </a>
            <?php } ?>
          </span>
        </header>
        <div class="card-body">
          <form action ="<?php echo base_url()?>BuySell/save" method="post">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <div class="row">

              <div class="col-md-4">
                <div class="form-group">
                  <label>रजिस्ट्रेसन नं<span style="color:red">*</span></label>
                  <input type="text" name="reg_no" value="" class="form-control" required="required">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>जग्गा दिनेको क्र.स नम्बर *(हटाउन / घटाउन पर्नेको )  <span style="color:red">*</span></label>
                  <select name="seller_file_no" class="from-control dd_select"
                  id="file_no" required>
                  <option value="">छान्नुहोस्</option>
                  <?php 
                  if(!empty($profile)) :
                    foreach ($profile as $key => $p) : ?>
                     <option value="<?php echo  $p['file_no']?>"> <?php echo $p['land_owner_name_np']?> (<?php echo  $p['file_no']?>)</option>
                   <?php endforeach; endif;?>
                 </select>
               </div>
             </div>
             <div class="col-md-4">
              <div class="form-group">
                <label>जग्गाको कित्ता नं<span style="color:red">*</span></label>
                <select name="jk_no" class="from-control dd_select"
                id="kitta_no" required>
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>जग्गा क्षेत्रफल<span style="color:red">*</span></label>
              <div class="row">
                <div class="col-md-3">
                  <input type="text" name="total_land" class="form-control" id="total_land_area" readonly=""><span>वर्ग फुट</span>
                </div>
                <div class="col-md-3">
                  <input type="text" name="j_ropani" class="form-control" id="j_ropani" readonly="">
                  <span>रोपनी</span>
                </div>
                <div class="col-md-3">
                  <input type="text" name="j_aana" class="form-control" id="j_aana" readonly="">
                  <span>आना</span>
                </div>
                <div class="col-md-3">
                  <input type="text" name="j_paisa" class="form-control" id="j_paisa" readonly="">
                  <span>पैसा</span>
                </div>
                <div class="col-md-3">
                  <input type="text" name="j_dam" class="form-control" id="j_dam" readonly="">
                  <span>दाम</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>तोकिएको न्युनतम मुल्य(प्रति रोपनी) <span style="color:red">*</span></label>
              <input type="text" name="minRate" class="form-control" id="min_land_rate" readonly="">
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>कबुल गरेको मुल्य(प्रति रोपनी) <span style="color:red">*</span></label>
              <input type="text" name="lkAmount" class="form-control" id="t_kubul_amount">
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>मूल्याङ्कन रकम <span style="color:red">*</span></label>
              <input type="text" name="tax_amount" class="form-control" id="t_rate">
            </div>
          </div>


          <div class="col-md-4">
            <div class="form-group">
              <label>जग्गा लिनेको क्र.स नम्बर ( बढाउन / थप्न पर्नेको) </label>
              <select name="buyer_file_no" class="from-control dd_select"
              id="b_file_no">
              <option value="">छान्नुहोस्</option>
              <?php 
              if(!empty($profile)) :
                foreach ($profile as $key => $p) : ?>
                 <option value="<?php echo  $p['file_no']?>"><?php echo  $p['file_no']?></option>
               <?php endforeach; endif;?>
             </select>
           </div>
         </div>

         <div class="col-md-4">
          <div class="form-group">
            <label>दिनेको कित्ता काट नं<span style="color:red">*</span></label>
            <input type="text" name="new_s_kitta_no" class="form-control">
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
            <label> लिनेको कित्ता काट नं<span style="color:red">*</span></label>
            <input type="text" name="new_b_kitta_no" class="form-control">
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
            <label>कबुल गरेको मुल्य(प्रति रो.)<span style="color:red">*</span></label>
            <input type="text" name="new_k_amount" class="form-control" id="new_k_amount">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>क्षेत्रफल<span style="color:red">*</span></label>

            <div class="row">

              <div class="col-md-3">
                <div class="form-group">
                  <input type="text" name="total_meter_square" value=""
                  class=" form-control meter_sqft" >
                  <span>sq. meter</span>
                </div>
              </div>

              <div class="col-md-3">
               <input type="text" name="n_land_area" class="form-control total_sqft" id="total_sqft">
               <span>sq. feet</span>
             </div>

             <div class="col-md-2">
              <input type="text" name="n_ropani" class="form-control ropani" id="n_ropani">
              <span>रोपनी</span>
            </div>
            <div class="col-md-2">
              <input type="text" name="n_aana" class="form-control aana " id="n_aana" >
              <span>आना</span>
            </div>
            <div class="col-md-2">
              <input type="text" name="n_paisa" class="form-control paisa " id="n_paisa" >
              <span>पैसा</span>
            </div>
            <div class="col-md-2">
              <input type="text" name="n_dam" class="form-control dam" id="n_dam">
              <span>दाम</span>
            </div>
          </div>
        </div>
      </div>

   <!--    <div class="col-md-4">
        <div class="form-group">
          <label>जग्गा दिनेको श्रेस्ताम घट जग्गा तथा  संरचना<span style="color:red">*</span></label>
          <input type="text" name="r_area" class="form-control" id="r_area">
        </div>
      </div> -->

      <div class="col-md-4">
        <div class="form-group">
          <label>जग्गा दिनेको घटने मूल्याङ्कन रकम<span style="color:red">*</span></label>
          <input type="text" name="r_t_amount" class="form-control" id="r_t_amount">
        </div>
      </div>

                   <!--  <div class="col-md-4">
                      <div class="form-group">
                        <label>जग्गा लिनेको श्रेस्ताम घट जग्गा तथा  संरचना<span style="color:red">*</span></label>
                        <input type="text" name="new_kitta_no" class="form-control">
                      </div>
                    </div> -->


                    <div class="col-md-4">
                      <div class="form-group">
                        <label>जग्गा लिनेको मूल्याङ्कन रकम<span style="color:red">*</span></label>
                        <input type="text" name="new_tax_amount" class="form-control" id="n_t_amount">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>कैफियत<span style="color:red">*</span></label>
                        <textarea class="form-control" name="remarks"></textarea>
                        <!--  <input type="text" name="new_kitta_no" class="form-control"> -->
                      </div>
                    </div>
                    <hr>
                    <div class="col-md-12 text-center">
                      <button class="btn btn-primary btn-xs save_button" data-toggle="tooltip" title=" सेभ  गर्नुहोस्" name="Submit" type="submit" value="Save"> सेभ गर्नुहोस्</button>
                      <a href="<?php echo base_url()?>Setting/SadakKoKisim" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्">रद्द गर्नुहोस्</a>
                    </div>
                  </form>
                </div>
              </section>
            </div>
          </div>
          <!-- page end-->
        </section>
      </section>
      <script type="text/javascript" src="<?php echo base_url()?>assets/assets/select2/js/select2.min.js"></script>
      <script type="text/javascript">
        $(document).ready(function(){
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
                  $('#kitta_no').html(resp.data);
                }
              }
            });
          });

          $(document).on('change', '#kitta_no',function(){
            obj = $(this);
            var kitta_no = obj.val();
            var file_no = $('#file_no').val();
            $.ajax({
              url:base_url+"BuySell/getLandDetails",
              type:"POST",
              data:{kitta_no:kitta_no,file_no:file_no},
              success:function(resp){
                if(resp.status == 'success') {
                    
                  $('#total_land_area').val(resp.data.total_square_feet);
                  $('#min_land_rate').val(resp.data.min_land_rate);
                  $('#t_kubul_amount').val(resp.data.k_land_rate);
                  $('#new_k_amount').val(resp.data.k_land_rate);
                  if(resp.data.a_ropani != ' ') {
                    $('#j_ropani').val(resp.data.a_ropani);
                  } else {
                    $('#j_ropani').val(0);
                  }
                  if(resp.data.a_ana !='') {
                   $('#j_aana').val(resp.data.a_ana);
                 } else {
                  $('#j_aana').val(0);
                }

                if(resp.data.a_paisa !='') {
                  $('#j_paisa').val(resp.data.a_paisa);
                } else {
                  $('#j_paisa').val(0);
                }

                if(resp.data.a_dam !='') {
                 $('#j_dam').val(resp.data.a_dam);
               } else {
                $('#j_dam').val(0);
              }

              $('#t_rate').val(resp.data.t_rate);
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
    $(document).on('checked', '#all_land', function(){
      console.log('hello');
    });

    $('#all_land').click(function(){
      if($(this).prop("checked") == true){
        console.log("Checkbox is checked.");
      }
      else if($(this).prop("checked") == false){
        console.log("Checkbox is unchecked.");
      }
    });


    $(document).on('input', '#n_ropani, #n_aana, #n_paisa, #n_dam', function() {
      obj = $(this);
      var kubul_rate = $('#t_kubul_amount').val();
      var one_ropani = "5476";

    var one_aana = "342.25";

    var one_paisa = "85.56";

    var one_dam = "21.39";

    //var total_sq = $('.total_sqft').val();

    var ropani = $('.ropani').val();

    var aana = $('.aana').val();

    var paisa = $('.paisa').val();

    var dam = $('.dam').val();
    if (aana > 15) {

      alert('आना १५ भन्दा बढि हुन सक्दैन');

      $('.aana').val(0);

      aana = 0;

    }

    if (paisa > 3.9) {

      alert('पैसा ३.९ भन्दा बढि हुन सक्दैन');

      $('.paisa').val(0);

      paisa = 0;

    }

    if (dam > 3.9) {

      alert('दाम ३.९  भन्दा बढि हुन सक्दैन');

      $('.dam').val(0);

      dam = 0;

    }

    var total_ropani_sqft = ropani * one_ropani;

    var total_aana_sqft = aana * one_aana;

    var total_paisa_sqft = paisa * one_paisa;

    var total_dam_sqft = dam * one_dam;

    // $('.r_sqft').html('<span class="label label-success">' + total_ropani_sqft +

    //   ' sqft </span>');

    // $('.a_sqft').html('<span class="label label-success">' + total_aana_sqft + ' sqft </span>');

    // $('.p_sqft').html('<span class="label label-success">' + total_paisa_sqft + ' sqft </span>');

    // $('.d_sqft').html('<span class="label label-success">' + total_dam_sqft + ' sqft </span>');

    var total_cal_sqlfeet = total_ropani_sqft + total_aana_sqft + total_paisa_sqft + total_dam_sqft

     $('.total_sqft').val(total_cal_sqlfeet.toFixed(2));
     var total_sqft = $('.total_sqft').val();


      // var tt_ropani = a;
      // var tt_aana = total_aana;
      // var tt_paisa = Math.trunc(t_paisa);
      // var tt_dam = t_dam.toFixed(0);

      var ropani_amount = ropani * kubul_rate;
      var aana_rate = aana / 16;
      var paisa_rate = paisa / 64;
      var dam_rate = dam / 256;


      var aana_amount = aana_rate * kubul_rate;
      var paisa_amount = paisa_rate * kubul_rate;
      var dam_amount = dam_rate * kubul_rate
      var total_amount = ropani_amount + aana_amount + paisa_amount + dam_amount;
      $('#n_t_amount').val(total_amount);
      $('#r_t_amount').val(total_amount);


      // var aana_amount = aana_rate * kubul_rate;
      // var paisa_amount = paisa_rate * kubul_rate;
      // var dam_amount = dam_rate * kubul_rate
      // var total_amount = ropani_amount + aana_amount + paisa_amount + dam_amount;
      // $('#n_t_amount').val(total_amount);
      // $('#r_t_amount').val(total_amount);
    // var meter_to_sqft = total_sqft * 10.76391204;
    // $('.meter_sqft').val(meter_to_sqft.toFixed(2));

        //var total_value = meter_to_sqft;



        //-------------------------------------------------//

        // var kubul_rate = $('.kubul_rate').val();

        // var ropani = $('.ropani').val();

        // var aana = $('.aana').val();

        // var paisa = $('.paisa').val();

        // var dam = $('.dam').val();

        // var ropani_amount = ropani * kubul_rate;

        // var aana_rate = aana / 16;

        // var paisa_rate = paisa / 64;

        // var dam_rate = dam / 256;

        // var aana_amount = aana_rate * kubul_rate;

        // var paisa_amount = paisa_rate * kubul_rate;

        // var dam_amount = dam_rate * kubul_rate

        // var total_amount = ropani_amount + aana_amount + paisa_amount + dam_amount;

        // $('.tax_amount').val(total_amount.toFixed(2)); 



      });



    // $(document).on('input', '.total_sqft', function() {

    //   obj = $(this);

    //   r = 0;

    //   var total_value = obj.val();

    //   var one_ropani = 5476;

    //   var one_aana = 342.25;

    //   var one_paisa = 85.56;

    //   var one_dam = 21.39;

    // //-----------------------------------------

    // var r = total_value - one_ropani;

    // var ropani = total_value / one_ropani;

    // var a = Math.trunc(ropani);

    // var b = a * one_ropani;

    // var c = total_value - b;

    // var aana = c / one_aana;

    // //--------------------------------------------

    // var total_aana = Math.trunc(aana);

    // var rem_sqft_after_aana = total_aana * one_aana;

    // var d = c - rem_sqft_after_aana;

    // var t_paisa = d / one_paisa;

    // //----------------------------------------

    // var t_paisa_p = Math.trunc(t_paisa);

    // var rem_t_paisa = t_paisa_p * one_paisa;

    // var e = d - rem_t_paisa;

    // var t_dam = e / one_dam;



    // $('.ropani').val(a);

    // //--------------------------

    // $('.aana').val(total_aana);

    // $('.paisa').val(Math.trunc(t_paisa));

    // $('.dam').val(t_dam.toFixed(0));





    //     // -------------------------calculate total rate

    //     //---------------------------------------------

    //     var kubul_rate = $('.kubul_rate').val();

    //     var ropani = $('.ropani').val();

    //     var aana = $('.aana').val();

    //     var paisa = $('.paisa').val();

    //     var dam = $('.dam').val();

    //     var ropani_amount = ropani * kubul_rate;

    //     var aana_rate = aana / 16;

    //     var paisa_rate = paisa / 64;

    //     var dam_rate = dam / 256;

    //     var aana_amount = aana_rate * kubul_rate;

    //     var paisa_amount = paisa_rate * kubul_rate;

    //     var dam_amount = dam_rate * kubul_rate

    //     var total_amount = ropani_amount + aana_amount + paisa_amount + dam_amount;

    //     $('.tax_amount').val(total_amount.toFixed(2)); 



    //     // var aana_amount = aana_rate * kubul_rate;

    //     // var paisa_amount = paisa_rate * kubul_rate;

    //     // var dam_amount = dam_rate * kubul_rate

    //     // var total_amount = ropani_amount + aana_amount + paisa_amount + dam_amount;

    //     // $('.tax_amount').val(total_amount.toFixed(2)); 





    //   });



    $(document).on('input', '.meter_sqft', function() {

      obj = $(this);

      r = 0;

      var meter_square = obj.val();

        // alert(meter_square);

        var meter_to_sqft = meter_square * 10.76391204;

        $('.total_sqft').val(meter_to_sqft.toFixed(2));

        var total_value = meter_to_sqft;

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



        $('.ropani').val(a);

        //--------------------------

        $('.aana').val(total_aana);

        $('.paisa').val(Math.trunc(t_paisa));

        $('.dam').val(t_dam.toFixed(0));





        // -------------------------calculate total rate

        //---------------------------------------------

        var kubul_rate = $('.kubul_rate').val();

        var ropani = $('.ropani').val();

        var aana = $('.aana').val();

        var paisa = $('.paisa').val();

        var dam = $('.dam').val();

        var ropani_amount = ropani * kubul_rate;

        var aana_rate = aana / 16;

        var paisa_rate = paisa / 64;

        var dam_rate = dam / 256;

        var aana_amount = aana_rate * kubul_rate;

        var paisa_amount = paisa_rate * kubul_rate;

        var dam_amount = dam_rate * kubul_rate

        var total_amount = ropani_amount + aana_amount + paisa_amount + dam_amount;

        $('.tax_amount').val(total_amount.toFixed(2)); 



      });

    // $(document).on('input', '.meter_sqft', function() {
    //     obj = $(this);
    //     r = 0;
    //     var meter_square = obj.val();
    //     alert(meter_square);
    //     var meter_to_sqft = meter_square * 10.76391204;
    //     $('.total_sqft').val(meter_to_sqft)
    //     // var total_value = meter_to_sqft;
    //     // var one_biga = "72900";
    //     // var one_kattha = "3645";
    //     // var one_dhur = "182.25";
    //     // // -----------------------------------------
    //     // var r = total_value - one_biga;
    //     // var biga = total_value / one_biga;
    //     // var a = Math.trunc(biga);
    //     // var b = a * one_biga;
    //     // var c = total_value - b;
    //     // var khatta = c / one_kattha;
    //     // // --------------------------------------------
    //     // var total_kattha = Math.trunc(khatta);
    //     // var rem_sqft_after_kattha = total_kattha * one_kattha;
    //     // var d = c - rem_sqft_after_kattha;
    //     // var t_dhur = d / one_dhur;
    //     // // ----------------------------------------
    //     // var t_dhur_p = Math.trunc(t_dhur);
    //     // var rem_t_dhur = t_dhur_p * one_dhur;
    //     // var e = d - rem_t_dhur;
    //     // var t_dam = e / one_dhur;

    //     // $('.biga').val(a);
    //     // // --------------------------
    //     // $('.kattha').val(total_kattha);
    //     // $('.dhur').val(t_dhur.toFixed(2));
    //    // $('.dam').val(t_dam.toFixed(0));
    // });

  });//END OF DOM
</script>

