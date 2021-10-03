 <form action ="<?php echo base_url()?>BuySell/save" method="post">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
  <input type="hidden" value="<?php echo $file_no?>" name = "seller_file_no">
  <div class="row"><div class="col-sm-12"><div class="alert alert-warning"><h3>जग्गा दिनेको (हटाउन / घटाउन पर्नेको )</h3></div></div></div>

  <div class="row">
    <div class="col-sm-12">
      <table class="print_table table " id="">
        <tbody>
          <tr class="productPurchaseFields" id="" data-id="1" style="border:none">
            
            <td style="width: 150px;"><label>कित्ता नं<span style="color:red">*</span></label>
              <select name="jk_no" class="from-control dd_select" id="kitta_no" required><option value="">--select--</option><?php if(!empty($land_details)):foreach($land_details as $land):?><option value="<?php echo $land['k_number']?>"><?php echo $land['k_number']?></option><?php endforeach;endif;?>
              </select>
            </td>
            <td style="width: 100px;">
              <label>रोपनी</label>
              <input type="text" name="j_ropani" class="form-control" id="j_ropani" readonly="">
            </td>
            <td style="width: 100px;">
              <label>आना</label>
              <input type="text" name="j_aana" class="form-control" id="j_aana" readonly="">
            </td>
            <td style="width: 100px;">
              <label>पैसा</label>
              <input type="text" name="j_paisa" class="form-control" id="j_paisa" readonly="">
            </td>
            <td style="width: 100px;">
              <label>दाम</label>
              <input type="text" name="j_dam" class="form-control" id="j_dam" readonly="">
            </td>
            <td style="width: 150px;">
             <label> वर्ग फु  </label>

             <input type="text" name="total_land" class="form-control" id="total_land_area" readonly="">
           </td>
           <td style="width: 150px;">
            <label> वर्ग मि  </label>
            <input type="text" class="form-control total_sqmeter" placeholder="sq. meter" name="total_sqmeter" id="total_sqmeter">
          </td >
          <td style="width: 200px;">
            <label>न्युनतम मुल्य(प्र रो.) </label>
            <input type="text" name="min_amount" class="form-control" id="min_land_rate" readonly="true">
          </td>
          <td style="width: 200px;">
           <label>कबुल मुल्य(प्र रो.)</label>
           <input type="text" name="kubul_amount" class="form-control" id="t_kubul_amount" readonly="true">
         </td>
         <td style="width: 200px;">
          <label>मू. रकम</label>
          <input type="text" name="tax_amount" class="form-control" id="t_rate" readonly="true">
        </td>
      </tr>
      <input type="hidden" name="land_new_kitta" class="form-control" id="land_new_kitta" readonly="true"></td>
    </tbody>
  </table>
  </div>
</div>

<div class="row"><div class="col-sm-12"><div class="alert alert-warning"><h3>जग्गा लिनेको क्र.स नम्बर ( बढाउन / थप्न पर्नेको)</h3></div></div></div>

<div class="row">
  <div class="col-sm-12">
    <h3 style="color:000"><b>जग्गाको सबै क्षेत्रफ़ल  भएमा </b><input type="checkbox" id = "all_area" value = "1" name="all_area"></h3>
    <h3 style="color:000"><b>जग्गाको कित्ता नं हालकै रहने र जग्गाको क्षेत्रफ़ल् मात्र घटाउने भएमा </b><input type="checkbox" value="1" id="same_kitta" name="same_kitta"></h3>
    <table class=" print_table table table-bordered" id="add_new_fields">
      <thead>
        <tr>
          <th align="center">जग्गा लिनेको क्र.स नम्बर ( बढाउन / थप्न पर्नेको) </th>
          <th align="center"> कायम कित्ता कट नं.</th>
          <th> रोपनी  </th>
          <th> आना  </th>
          <th> पैसा  </th>
          <th> दाम  </th>
          <th> वर्ग फु  </th>
          <th> वर्ग मि  </th>
          <th align="center">मूल्याङ्कन रकम</th>
          <th>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr class="productPurchaseFields" id="add_new_fields" data-id="1">
          <td align="center" style="width: 200px;">
            <select class="form-control dd_select" name="buyer_file_no[]">
              <option value="">नाम / क्र.स नम्बर</option>
              <?php 
              if(!empty($profile)) :
                foreach ($profile as $key => $p) : ?>
                 <option value="<?php echo  $p['file_no']?>"> <?php echo $p['land_owner_name_np']?> (<?php echo  $p['file_no']?>)</option>
               <?php endforeach; endif;?>
             </select>
           </td>
           <td style="width: 150px;"><input type="text" class="form-control" name="new_ktta_cut[]"></td>
           <td style="width: 100px;">
            <input type="text" class="form-control new_ropani" placeholder="रोपनी" name="new_ropani[]">
          </td>
          <td style="width: 100px;">
           <input type="text" class="form-control new_aana" placeholder="आना" name="new_aana[]">
         </td>
         <td style="width: 100px;">
           <input type="text" class="form-control new_paisa" placeholder="पैसा" name ="new_paisa[]" >
         </td>
         <td style="width: 100px;">
           <input type="text" class="form-control new_dam" placeholder="दाम" name="new_dam[]">
         </td>
         <td style="width: 150px;">
           <input type="text" class="form-control new_sq_feet" placeholder = "sq. feet" name="new_sq_feet[]">
         </td>
         <td style="width: 150px;">
           <input type="text" class="form-control new_sq_meter" placeholder="sq. meter" name="new_sq_meter[]">
         </td>
         <td>
          <input type="text" placeholder="" class="form-control new_total_land_rate" name="new_total_land_rate[]">
        </td>
        <td>
          <button type="button" class="btn btn-flat btn-danger"><i class="fa fa-trash-o"></i></button>
        </td>
      </tr>
      <tfoot>
        <tr>
          <td colspan="10"><button  type="button" class="btn btn-warning btn-block btnAddNew" id="add_more_kitta"><i class="fa fa-plus-circle"></i> नया थप्नुहोस </button></td>
        </tr>
      </tfoot>
    </tbody>
  </table>
</div>
</div>
                 <!--  <div class="row">
                    <div class="col-sm-12">
                       <div class="row"><div class="col-sm-12"><div class="alert alert-warning"><h3>जग्गा दिनेको जग्गाको कायम क्षेत्रफ़ल्</h3></div></div></div>
                    </div>
                  </div> -->
                  <div class="row">
                    <div class="col-md-12">
                      <h4>कैफियत</h4>
                      <textarea class="form-control" name = "remarks"></textarea>
                      <hr>
                    </div>
                  </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <h3 style="color:000"><b>प्रोफाइल बाट जग्गाको विवरण हटाउनुहोस(हटाउने परेमा मात्र <i class="fa fa-times"></i> )</b></h3>
                        <table class="table table-bordered table-striped" id="">
                          <thead style="background-color: #e5e5e5; color:#000">
                            <tr>
                              <th>#</th>
                              <th align="center">कित्ता नं.</th>
                              <th align="center"> रोपनी  </th>
                              <th align="center"> आना  </th>
                              <th align="center"> पैसा  </th>
                              <th align="center"> दाम  </th>
                              <th align="center"> वर्ग फु  </th>
                              <th align="center"> वर्ग मि  </th>
                              <th align="center">मूल्याङ्कन रकम</th>
                              <th>हटाउनहोस्</th>
                            </tr>
                          </thead>
                           <tbody>
                            <?php $i=1; if(!empty($land_details)) :
                              foreach($land_details as $ld) : ?>
                                <tr style="color:#000;background-color: <?php if($ld['buy_sell_status'] == 2){echo 'red';}?>">
                                  <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
                                  <td><?php echo $this->mylibrary->convertedcit($ld['k_number'])?></td>
                                  <td style="width: 100px;"><?php echo $this->mylibrary->convertedcit($ld['a_ropani'])?></td>
                                  <td style="width: 100px;"><?php echo $this->mylibrary->convertedcit($ld['a_aana'])?></td>
                                  <td style="width: 150px;"><?php echo $this->mylibrary->convertedcit($ld['a_paisa'])?></td>
                                  <td style="width: 150px;"><?php echo $this->mylibrary->convertedcit($ld['a_dam'])?></td>
                                  <td style="width: 100px;"><?php echo $this->mylibrary->convertedcit($ld['total_square_feet'])?></td>
                                  <td style="width: 100px;"><?php echo '-'?></td>
                                  <td style="width: 200px;"><?php echo $this->mylibrary->convertedcit($ld['t_rate'])?></td>
                                  <td><button type="button" data-url ='<?php echo base_url()?>BuySell/removeKitta' class='btn-danger btn-sm btn-delete' data-id = "<?php echo $ld['id']?>"><i class='fa fa-trash-o'></i></button></td>
                                </tr>
                           <?php endforeach; endif;?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="col-md-12 text-center">

                      <hr>

                      <button class="btn btn-secondary btn-block save_btn" data-toggle="tooltip"

                      title=" सेभ  गर्नुहोस्" name="Submit" type="submit" value="Save"> सेभ

                    गर्नुहोस्</button>

                  </div>
                </div>
              </form>

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','.btn-delete', function(e){
      //e.preventDefault();
      var id = $(this).data('id'); //Fetch id from modal trigger button

      var url = $(this).data('url');
      if (confirm("Are you sure want to delete?") == true) {
        $(this).closest('tr').css('backgroundColor', 'red');
        $.ajax({
          type : 'POST',
                url : url, //Here you will fetch records 
                data: {id:id,'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'}, //Pass $id
                success : function(resp){
                  console.log(resp);
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
            var total_sqmeter = resp.data.total_square_feet / 10.76391204;
            $('#total_sqmeter').val(total_sqmeter);
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
    // $(document).on('change','#file_no', function(){
    //   obj = $(this);
    //   var file_no = obj.val();
    //   $.ajax({
    //     url:base_url+"BuySell/getLandOwnerDetails",
    //     type:"POST",
    //     data:{file_no:file_no},
    //     success:function(resp){
    //       if(resp.status == 'success') {
    //         $('.buysellfrm').html(resp.data);
    //       }
    //     }
    //   });
    // });

    

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


  });
</script>

