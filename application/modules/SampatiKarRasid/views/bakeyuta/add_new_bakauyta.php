  <!--bootstrap switcher-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/assets/bootstrap-switch/static/stylesheets/bootstrap-switch.css" />

    <!-- switchery-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/assets/switchery/switchery.css" />

  <!--main content start-->
 <section id="main-content">
    <section class="wrapper site-min-height">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i>
                        गृहपृष्ठ</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i>गृहपृष्ठ</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i>गृहपृष्ठ</a></li>
            </ol>
        </nav>
        <!-- page start-->
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-primary">
                    <header class="card-header" style="background: #1b5693;color:#FFF">
                      बक्यौता जग्गाको विवरण  
                      <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input use_current" value= "1" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">हालको जग्गाको विवरण</label>
                      </div>
                    </header>
                    <form method="post" action="<?php echo base_url()?>SampatiKarRasid/saveBLandDetails">
                      <div class="card-body">
                        <!-- <table>
                          <tr>
                            <td> -->
                              <div class="row">
                                <div class="col-md-2">
                                  <div class="form-group">
                                    <label>आर्थिक वर्ष<span style="color:red">*</span></label>
                                     <select class="form-control fiscal_year" name="fiscal_year"
                                                                id="set_fiscal_year_frm">
                                        <option value="">आर्थिक वर्ष देखि</option>
                                        <?php
                                            if(!empty($fiscal_year)) : 
                                                foreach ($fiscal_year as $key => $value) : ?>
                                        <option value="<?php echo $value['year']?>">
                                            <?php echo $value['year']?></option>
                                        <?php endforeach;endif?>
                                    </select>
                                  </div>
                                </div>

                                <div class="col-md-3">
                                  <div class="form-group">
                                    <input type="hidden" name="ld_file_no"
                                      value="<?php echo $lo_details['file_no']?>">
                                    <label>साबिक गा.पा/न.पा<span style="color:red">*</span></label>
                                    <select name="old_gapa_napa" class="from-control dd_select oldaddress"
                                      id="oldwardaddress" required>
                                      <option value="">छान्नुहोस्</option>
                                      <?php 
                                        if(!empty($oldwardaddress)) :
                                        foreach ($oldwardaddress as $key => $oa) : ?>
                                       <option value="<?= $oa['old_name']?>"><?= $oa['old_name']?></option>
                                      <?php endforeach; endif;?>
                                    </select>
                                  </div>
                                </div>

                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label>साबिक वडा नं<span style="color:red">*</span></label>
                                    <select name="old_ward" class="from-control dd_select oldward" id="old_ward"
                                      required>
                                      <option value="">छान्नुहोस्</option>
                                      <?php 
                                        if(!empty($wardadrress)) :
                                            foreach ($wardadrress as $key => $ow) : 
                                        ?>
                                      <option value="<?php echo  $ow['old_ward']?>">
                                        <?php echo $ow['old_ward']?>
                                      </option>
                                      <?php endforeach; endif;?>
                                    </select>
                                  </div>
                                </div>

                                <div class="col-md-2">
                                  <div class="form-group">
                                    <label>हाल गा.पा/न.पा<span style="color:red">*</span></label>
                                    <input type="text" name="present_gapa_napa" value=""
                                      class=" form-control present_name" readonly="readonly">
                                  </div>
                                </div>

                                <div class="col-md-2">
                                  <div class="form-group">
                                    <label>हाल वडा नं<span style="color:red">*</span></label>
                                    <input type="text" name="present_ward" value=""
                                      class=" form-control present_ward" readonly="readonly">
                                  </div>
                                </div>

                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label>सडकको नाम<span style="color:red">*</span></label>
                                    <select name="road_name" class="from-control dd_select road_details"
                                      id="road_details" required>
                                      
                                    </select>
                                  </div>
                                </div>

                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label>जग्गाको क्षेत्रगत किसिम<span style="color:red">*</span></label>
                                    <select name="land_area_type" class="from-control dd_select land_area_type"
                                      id="land_area_type" required>
                                      <?php 
                                            if(!empty($areatype)) :
                                                foreach ($areatype as $key => $at) : 
                                            ?>
                                          <option value="<?php echo  $at['id']?>" <?php if($at['id'] == 4){ echo 'selected';}?>>
                                            <?php echo $at['land_area_type']?>
                                          </option>
                                      <?php endforeach; endif;?>
                                    </select>
                                  </div>
                                </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>नक्सा  नं<span style="color:red">*</span></label>
                                      <input type="text" name="nn_number" value=""
                                        class=" form-control nn_number">
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>कित्ता  नं<span style="color:red">*</span></label>
                                      <input type="text" name="k_number" value="" class=" form-control k_number">
                                    </div>
                                  </div>
                                  <div class="col-md-12"><hr></div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label>रोपनी<span style="color:red">*</span></label>
                                      <input type="text" name="a_ropani" value="" class=" form-control ropani">
                                      <div class="r_sqft"></div>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label>आना<span style="color:red">*</span></label>
                                      <input type="text" name="a_ana" value="" class=" form-control aana">
                                      <div class="a_sqft"></div>
                                      <span style="color:red">(कृपया १ देखि १५ मात्र प्रविष्ट गर्नुहोस्)</span>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label>पैसा<span style="color:red">*</span></label>
                                      <input type="text" name="a_paisa" value="" class=" form-control paisa">
                                      <div class="p_sqft"></div>
                                      <span style="color:red">(कृपया १ देखि ३ मात्र प्रविष्ट गर्नुहोस्)</span>

                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label>दाम<span style="color:red">*</span></label>
                                      <input type="text" name="a_dam" value="" class=" form-control dam">
                                      <div class="d_sqft"></div>
                                      <span style="color:red">(कृपया १ देखि ३ मात्र प्रविष्ट गर्नुहोस्)</span>
                                    </div>
                                  </div>

                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label>क्षेत्रफल (sqft)<span style="color:red">*</span></label>
                                      <input type="text" name="total_square_feet" value=""
                                        class=" form-control total_sqft">
                                    </div>
                                  </div>

                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label>क्षेत्रफल ईकाई<span style="color:red">*</span></label>
                                      <select name="a_unit" class=" dd_select jaggaunit" id="jaggaunit"
                                        style="width: 100px;" required>
                                        <option value="">छान्नुहोस्</option>
                                        <?php 
                                                  if(!empty($jaggaunit)) :
                                                      foreach ($jaggaunit as $key => $ju) :
                                                      ?>
                                        <option value="<?php echo $ju['id']?>" <?php if($key==0) {echo 'selected';}?>><?php echo $ju['name']?>
                                        </option> <?php endforeach; endif;?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-12"><hr></div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>तोकिएको न्युनतम मुल्य(प्रति रोपनी)<span
                                          style="color:red">*</span></label>
                                      <input type="text" name="min_land_rate" value=""
                                        class=" form-control min_rate" readonly="readonly">
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>तोकिएको अधिक्तम मुल्य(प्रति रोपनी)<span
                                          style="color:red">*</span></label>
                                      <input type="text" name="max_land_rate" value=""
                                        class=" form-control max_rate" readonly="readonly">
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>कबुल गरेको मुल्य(प्रति रोपनी)<span style="color:red">*</span></label>
                                      <input type="text" name="k_land_rate" value=""
                                        class=" form-control kubul_rate">
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>कर लाग्ने मुल्य<span style="color:red">*</span></label>
                                      <input type="text" name="t_rate" value="" class=" form-control tax_amount">
                                    </div>
                                  </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <button type="button" class="btn btn-success">भोतिक संरचनाको विवरण</button>
                                </div>
                                  <div class="sanrachana_row">
                                    
                                  </div>
                                  <div class="col-md-12 text-center">
                                    <hr>
                                    <button class="btn btn-primary btn-xs save_button" data-toggle="tooltip"
                                      title=" सेभ  गर्नुहोस्" name="Submit" type="submit" value="Save"> सेभ
                                      गर्नुहोस्</button>
                                    <a href="<?php echo base_url()?>Profile"
                                      class="btn btn-danger btn-xs" data-toggle="tooltip"
                                      title="सम्पादन गर्नुहोस्">रद्द गर्नुहोस्</a>
                                  </div>
                                </div>
                              </div>
                            <!-- </td>
                          </tr>
                        </table> -->
                      </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
 </section>
 <script type="text/javascript" src="<?php echo base_url()?>assets/assets/select2/js/select2.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url()?>assets/nepali_datepicker/nepali.datepicker.v2.2.min.js">
 </script>
  <script src="<?php echo base_url()?>assets/assets/switchery/switchery.js"></script>
    <!--bootstrap-switch-->
  <script src="<?php echo base_url()?>assets/assets/bootstrap-switch/static/js/bootstrap-switch.js"></script>
 <script type="text/javascript">
    $(document).ready(function() {
        $('.dd_select').select2();
        $('.nepaliDate5').nepaliDatePicker();
        $('#date_1').nepaliDatePicker();
        
        // $('.btnAddNew').click(function(e) {
        //         e.preventDefault();
        //         var trOneNew = $('.partsPurchaseFields').length+1;
        //         var sn = $(this).closest('.sn_1').val();
        //         var new_row =
        //             '<tr class ="partsPurchaseFields" id="partsPurchaseFields_'+trOneNew+'" data-id="'+trOneNew+'">'+
        //            '<td><select class="form-control fiscal_year_frm" name="fiscal_year[]" data-placeholder="छान्नुहोस्" id="main_topic'+trOneNew+'" data-id="'+trOneNew+'"><option value="">छान्नुहोस्</option><?php //if(!empty($fyear)) {
        //                 foreach ($fyear as $key => $fy) { ?><option value="<?php //echo $fy['year']?>"><?php //echo $fy['year']; } }?></option></select></td>'+
        //             '<td><input class="form-control"  type="text" name="total_t_tax[]" id="" readonly="readonly" value="<?php //echo $total_kar_amount?>"  required></td>'+
        //             '<td><input class="form-control bhumi_kar"  type="text" name="bhumi_kar[]" id="karrate" readonly="readonly"  required></td>'+
        //             '<td><button type="button" class="btn btn-danger btn-sm remove-row" data-toggle="tooltip" title="हटाउनुहोस्"><span class="fa fa-times" tabindex="-1"></span></button></td>'+
        //             '<tr>'
        //         $("#add_new_fields").append(new_row);
        // });
        // $("body").on("click",".remove-row", function(e){
        //     e.preventDefault();
        //     if (confirm('के तपाइँ  यसलाई हटाउन निश्चित हुनुहुन्छ ?')) {
        //         var amt = $(this).closest("tr").find('.topic_rate').val();
        //         var t_amt = $('#t_total').val();
        //         var new_amt = t_amt-amt;
        //         $("#t_total").val(new_amt);
        //         $(this).parent().parent().remove();
        //     }
        // });

        // $(document).on('change','.fiscal_year_frm', function() {
        //     obj = $(this);
        //     var fiscal_year = obj.val();
        //     var total_t_tax = $('#total_t_tax').val();
        //    $.ajax({
        //         method: "POST",
        //         url: base_url + "SampatiKarRasid/getBRateByFiscalYear",
        //         data: {
        //             fiscal_year: fiscal_year,
        //             total_t_tax: total_t_tax
        //         },
        //         success: function(resp) {
        //             obj.closest('tr').find('.bhumi_kar').val(resp);
        //          }
        //    });
        // });


        $(document).on('change', '.oldaddress ,.oldward', function() {
          var obj = $(this);
          var gapana = $('.oldaddress').val();
          var ward = $('.oldward').val();
          var fiscal_year = $('.fiscal_year').val();
          $.ajax({
            method: "POST",
            url: base_url + "SampatiKarRasid/getNewAddress",
            data: {
              gapana: gapana,
              ward: ward,
              fiscal_year:fiscal_year
            },
            success: function(resp) {
              if (resp.status == 'success') {
                if (resp.data == null) {
                  $(".present_name").val('');
                  $(".present_ward").val('');
                  $('.notification').html(
                    '<div class="alert alert-danger">हालको विवरण राखिएको छैन</div>'
                  )
                } else {
                  $(".present_name").val(resp.data.present_name);
                  $(".present_ward").val(resp.data.present_ward);
                  $(".road_details").html(resp.road_option);
                  $('.notification').empty();
                }
              }
            }
          });
        });


        $(document).on('change', '.road_details, .land_area_type', function() {
          var obj = $(this);
          var land_area_type = $('.land_area_type').val();
          var road_name = $('.road_details').val();
          var fiscal_year = $('.fiscal_year').val();
          $.ajax({
            method: "POST",
            url: base_url + "SampatiKarRasid/getLandAreaCost",
            data: {
              land_area_type: land_area_type,
              road_name: road_name,
              fiscal_year:fiscal_year
            },
            success: function(resp) {
              if (resp.status == 'success') {
                if (resp.data == null) {
                  $('.min_rate').val(0.00);
                  $('.max_rate').val(0.00);
                              $('.kubul_rate').val(0.00);
                              $('.tax_amount').val(0.00);
                } else {
                  $('.min_rate').val(resp.data.minimal_cost);
                  $('.max_rate').val(resp.data.maximum_cost);
                  $('.kubul_rate').val(resp.data.minimal_cost);
                  //-------------------------------------------------//
                  var kubul_rate = resp.data.minimal_cost;
                  console.log(kubul_rate);
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
                  $('.tax_amount').val(total_amount);
                }

              }
            }
          });
        });

        $(document).on('input', '.ropani, .aana, .paisa, .dam', function() {
          obj = $(this);
          // var ropani = obj.val();
          //----------------------calculation-------------//
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
          if (paisa > 3) {
            alert('पैसा ३ भन्दा बढि हुन सक्दैन');
            $('.paisa').val(0);
            paisa = 0;
          }
          if (dam > 3) {
            alert('दाम ३ भन्दा बढि हुन सक्दैन');
            $('.dam').val(0);
            dam = 0;
          }
          var total_ropani_sqft = ropani * one_ropani;
          var total_aana_sqft = aana * one_aana;
          var total_paisa_sqft = paisa * one_paisa;
          var total_dam_sqft = dam * one_dam;
          $('.r_sqft').html('<span class="label label-success">' + total_ropani_sqft +
            ' sqft </span>');
          $('.a_sqft').html('<span class="label label-success">' + total_aana_sqft + ' sqft </span>');
          $('.p_sqft').html('<span class="label label-success">' + total_paisa_sqft + ' sqft </span>');
          $('.d_sqft').html('<span class="label label-success">' + total_dam_sqft + ' sqft </span>');
          var total_cal_sqlfeet = total_ropani_sqft + total_aana_sqft + total_paisa_sqft + total_dam_sqft
          $('.total_sqft').val(total_cal_sqlfeet.toFixed(2));

              //-------------------------------------------------//
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

        $(document).on('input', '.total_sqft', function() {
          obj = $(this);
          r = 0;
          var total_value = obj.val();
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
        });

        $(document).on('input', '.kubul_rate', function() {
          var obj = $(this);
          var kubul_rate = obj.val();
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
          $('.tax_amount').val(total_amount);
        });

        $(document).on('change','.fiscal_year', function(){

        });

        $(document).on('click','.use_current', function(){
            if($('.use_current').is(':checked')){
              obj = $(this);
              var current_check = obj.val();
              var file_no = "<?php echo $this->uri->segment(3)?>";
             // console.log(file_no);
              $.ajax({
                type:"POST",
                url:"<?php echo base_url()?>SampatiKarRasid/GetCurrentLandDetails",
                data:{current_value:current_check,file_no:file_no},
                success:function(resp){
                  console.log(resp);
                }
              });
              // var current_value = obj.val(1);
              // if(current_value == 1) {
               
              // }
            }
        });


    }); //end of dom
 </script>
