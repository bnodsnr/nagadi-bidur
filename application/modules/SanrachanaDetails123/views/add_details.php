    <!--main content start-->
    <section id="main-content">
        <section class="wrapper site-min-height">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                   <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i>
                   गृहपृष्ठ</a>
               </li>
               <li class="breadcrumb-item"><a href="<?php echo base_url()?>PersonalProfile">
               जग्गाधनी प्रोफाइल</a></li>
               <li class="breadcrumb-item"><a
                href="<?php echo base_url()?>SanrachanaDetails/veiwDetails/<?php echo $lo_details['file_no']?>">
            भोतिक संरचनाको विवरण </a></li>
            <li class="breadcrumb-item"><a href="javascript:;">
            विवरण सम्पादन गर्नुहोस्  </a></li>

        </ol>
    </nav>
    <!-- page start-->
    <div class="row">
        <div class="col-sm-12">
            <form action="<?php echo base_url()?>SanrachanaDetails/Save" method="post" class="save_post">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <section class="card">
                    <header class="card-header" style="background: #1b5693;color:#FFF">
                        भोतिक संरचनाको विवरण : जग्गाधनी - <?php echo $lo_details['land_owner_name_np']?> /
                        जग्गाधनिको क्र.स नम्बर :<?php echo $lo_details['file_no']?>
                    </header>
                    <div class="card-body">
                        <div class="notification"></div>
                        <div class="valid_errors"></div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="hidden" name="ls_file_no" value="<?php echo $lo_details['file_no']?>" id="file_no">
                                    <label>संरचना रहेको कि.नं<span style="color:red">*</span></label>
                                    <select name="k_no" class="from-control dd_select" id="k_no">
                                        <option value="">छान्नुहोस्</option>
                                        <?php 
                                        if(!empty($landDescription)) :
                                            foreach ($landDescription as $key => $ld) : ?>
                                                <option value="<?php echo  $ld['k_number']?>"><?php echo  $ld['k_number']?>
                                            </option>
                                        <?php endforeach; endif;?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>संरचना रहेको जग्गाको क्षेत्रफल<span
                                        style="color:red">*</span></label>
                                        <input type="text" name="toal_land_area" value="" class=" form-control"
                                        id="land_area_ropani" readonly="readonly">
                                        <span class="info"></span>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label> क्षेत्रफल(वर्गफुट)<span style="color:red">*</span></label>
                                        <input type="text" name="total_land_area_sqft" value="" class=" form-control"
                                        id="land_area_sqft" readonly="readonly">
                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label> जग्गाको कबुल गरेको मूल्य(प्रति रोपनी)<span
                                            style="color:red">*</span></label>
                                            <input type="text" name="total_land_min_amount" value=""
                                            class=" form-control total_land_amount" readonly="readonly">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label> जग्गाको कर लाग्ने मुल्य <span style="color:red">*</span></label>
                                            <input type="text" name="total_land_tax_amount" value=""
                                            class=" form-control total_land_tax_amount" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">

                                        <div class="row r_bhumi_fields">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> यो कित्ता मा रहेको पहिलो संरचनाको  क्षेत्रफल <span style="color:red">*</span></label>
                                                    <input type="text" name="" value=""
                                                    class=" form-control total_building_area_in_kitta" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> चर्चेकाे बाहेक भूमिकर जग्गाको क्षेत्रफल <span style="color:red">*</span></label>
                                                    <input type="text" name="remaining_area" value=""
                                                    class=" form-control remaining_area" readonly>
                                                    <input type="hidden" name="sanrachana_id" id="sanrachana_details_id">
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>संरचना रहेको न.नं<span style="color:red">*</span></label>
                                            <input type="text" name="sanrachana_n_no" class="form-control" id="n_no"
                                            readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>संरचनाको प्रकार<span style="color:red">*</span></label>
                                            <select name="sanrachana_prakar" class="from-control dd_select land_sa_type"
                                            id="land_sa_type">
                                            <?php
                                            if(!empty($architecttype)) :
                                                foreach ($architecttype as $key => $at) : 
                                                    ?>
                                                    <option value="<?php echo  $at['id']?>" selected="selected"><?php echo $at['architect_type']?>
                                                </option>
                                            <?php endforeach; endif;?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>संरचनाको बनौटको किसिम<span style="color:red">*</span></label>
                                        <select name="sanrachana_banot_kisim"
                                        class="from-control dd_select land_area_type" id="land_area_type">
                                        <option value="">छान्नुहोस्</option>
                                        <?php 
                                        if(!empty($architectstructure)) :
                                            foreach ($architectstructure as $key => $as) : 
                                                ?>
                                                <option value="<?php echo  $as['id']?>"><?php echo $as['structure_type']?>
                                            </option>
                                        <?php endforeach; endif;?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>संरचनाको प्रयोगको किसिम<span style="color:red">*</span></label>
                                    <select name="sanrachana_usages" class="from-control dd_select " id="land_usage"
                                    >
                                    <option value="">छान्नुहोस्</option>
                                    <option value="निजी">निजी</option>
                                    <option value="भाडा">भाडा</option>
                                    <option value="अन्य">अना</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>संरचनाको तला<span style="color:red">*</span></label><br>
                                <select name="sanrachana_floor" class="form-control dd_select floor" id="">
                                    <option value="">छान्नुहोस्</option>
                                    <option value="1">1</option>
                                    <option value="1.5">1.5</option>
                                    <option value="2">2</option>
                                    <option value="2.5">2.5</option>
                                    <option value="3">3</option>
                                    <option value="3.5">3.5</option>
                                    <option value="4">4</option>
                                    <option value="4.5">4.5</option>
                                    <option value="5">5</option>
                                    <option value="5.5">5.5</option>
                                    <option value="6">6</option>
                                    <option value="6.5">6.5</option>
                                    <option value="7">7</option>
                                    <option value="7.5">7.5</option>
                                    <option value="8">8</option>
                                    <option value="8.5">8.5</option>
                                    <option value="9">9</option>
                                    <option value="9.5">9.5</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>प्लिन्थलेभलको संरचनाको लम्बाई<span style="color:red">*</span></label>
                                <input type="text" name="sanrachana_ground_lenth" value="" class=" form-control decimal_field"
                                id="length">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>प्लिन्थलेभलको संरचनाको चौडाई<span style="color:red">*</span></label>
                                <input type="text" name="sanrachana_ground_width" value="" class=" form-control decimal_field"
                                id="width">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>प्लिन्थलेभलको क्षेत्रफल वर्गफुट<span style="color:red">*</span></label>
                                <input type="text" name="sanrachana_ground_area_sqft" value=""
                                class=" form-control" id="area_sqft">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>संरचनाको क्षेत्रफल जम्मा वर्गफुट<span style="color:red">*</span></label>
                                <input type="text" name="sanrachana_ground_housing_area_sqft" value=""
                                class=" form-control" id="area_sqft_g" readonly="readonly">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <hr>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>बनेको साल<span style="color:red">*</span></label>
                                <select name="contructed_year" class="from-control dd_select year"
                                id="constructed_year">
                                <option value="">छान्नुहोस्</option>
                                <?php 
                                if(!empty($year)) :
                                    foreach ($year as $key => $year) : 
                                        ?>
                                        <option value="<?php echo  $year['name']?>"><?php echo $year['name']?>
                                    </option>
                                <?php endforeach; endif;?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label> संरचनाको ह्रासकट्टी प्रतिशत <span style="color:red">*</span></label>
                            <input type="text" name="sanrachana_dep_rate" value=""
                            class=" form-control dep_rate" readonly>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label> संरचनाको तोकिएको न्युनतम मुल्य (प्रति व.फु. )<span style="color:red">*</span></label>
                            <input type="text" name="sanrachana_min_amount" value=""
                            class=" form-control structure_min_amount" readonly="readonly">
                        </div>
                    </div>
                                <!-- <div class="col-md-3">
                                    <div class="form-group">
                                        <label> संरचनाको तोकिएको अधिक्तम मुल्य(प्रति वर्ग फुट) <span style="color:red">*</span></label>
                                        <input type="text" name="structure_max_amount" value=""
                                            class=" form-control structure_max_amount" readonly="readonly">
                                    </div>
                                </div> -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label> संरचनाको कवोल गरेको कुल मुल्य <span style="color:red">*</span></label>
                                        <input type="text" name="sanrachana_kubul_amount" value=""
                                        class=" form-control min_fixed_rate">
                                        <div class="k_alert" style="color: red"></div>
                                    </div>
                                    
                                </div>

                                <div class="col-md-12">
                                    <hr>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>संरचनाको खुद कायम मुल्य <span style="color:red">*</span></label>
                                        <input type="text" name="sanrachana_khud_amount" value=""
                                        class=" form-control khud_rate" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>प्लिन्थलेभलको क्षेत्रफल(रोपनी )<span style="color:red">*</span></label>
                                        <input type="text" name="sanrachana_ground_area_ropani" value=""
                                        class=" form-control" id="area_sqft_ropani" readonly="readonly">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>चर्चेकाे जग्गाको क्षेत्रफल<span style="color:red">*</span></label>
                                        <input type="text" name="charcheko_area" value=""
                                        class="form-control charcheko_area" readonly>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>संरचनाले चर्चेकाे जग्गाको कर लाग्ने मुल्य<span
                                            style="color:red">*</span></label>
                                            <input type="text" name="sanrachana_land_tax_amount" value=""
                                            class="form-control sanrachna_ck_land" readonly>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label> सम्पति मूल्याङ्कन जम्मा मुल्य <span style="color:red">*</span></label>
                                            <input type="text" name="net_tax_amount" value=""
                                            class=" form-control net_total_amount" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label> चर्चेकाे बाहेक भूमिकर  जग्गाको क्षेत्रफल <span
                                                style="color:red">*</span></label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="text" name="bhumi_kar_area" value=""
                                                        class=" form-control bhumi_kar_area" readonly>
                                                        <span>(वर्गफुट)</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control bhumi_kar_area_kattha" id="bhumi_kar_area_kattha" readonly="readonly">
                                                        <span>(रोपनी )</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label> चर्चेकाे बाहेक जग्गाको भूमिकर मूल्याङ्कन <span
                                                    style="color:red">*</span></label>
                                                    <input type="text" name="bhumi_kar_amount" value=""
                                                    class=" form-control bhumi_kar_amount" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <hr>
                                                <button class="btn btn-primary btn-xs save_btn" data-toggle="tooltip"
                                                title=" सेभ  गर्नुहोस्" name="Submit" type="submit" value="Save"> सेभ
                                            गर्नुहोस्</button>
                                            <a href="<?php echo base_url()?>SanrachanaDetails/veiwDetails/<?php echo $lo_details['file_no']?>" class="btn btn-danger btn-xs"
                                                data-toggle="tooltip" title="सम्पादन गर्नुहोस्">रद्द गर्नुहोस्</a>
                                            </div>
                                        </div>
                                        <!--row-->
                                    </div>
                                    <!--cardbody-->
                                </section>
                            </form>
                        </div>
                    </div>
                </section>
            </section>
            <script type="text/javascript" language="javascript"
            src="<?php echo base_url()?>assets/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
            <script type="text/javascript" src="<?php echo base_url()?>assets/assets/data-tables/DT_bootstrap.js"></script>

            <script type="text/javascript" src="<?php echo base_url()?>assets/assets/select2/js/select2.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('.r_bhumi_fields').hide();
                    $('.dd_select').select2();
                    $(document).on('change', '#k_no', function() {
                      var obj = $(this);
                      var k_no = obj.val();
                      if(k_no == '' ) {
                          alert('कृपया कित्ता नं छान्नुहोस्');
                          location.reload();
                      }
                      var file_no = $('#file_no').val();
                      
                      $.ajax({
                       method: "POST",
                       url: base_url + "SanrachanaDetails/getLandDescriptionByKNo",
                       data: {
                           k_no: k_no, file_no:file_no,
                           '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
                       },
                       success: function(resp) {
                        if (resp.status == 'success') {
                            console.log(resp.sanrachana_details);
                            if (resp.data == null) {
                              $(".total_land_amount").val('');
                            } else {
                                $(".total_land_amount").val(resp.data.k_land_rate);
                                $(".total_land_tax_amount").val(resp.data.t_rate);
                                   // $('#land_area_sqft').val(resp.data.total_square_feet);
                                   if(resp.sanrachana_details != null) {
                                    $('.r_bhumi_fields').show();
                                    $('.total_building_area_in_kitta').val(resp.sanrachana_details.sanrachana_ground_housing_area_sqft);
                                    $('.remaining_area').val(resp.data.total_square_feet);
                                    $('#land_area_sqft').val(resp.sanrachana_details.r_bhumi_area);
                                    $('#sanrachana_details_id').val(resp.sanrachana_details.id);
                                } else {
                                    $('#land_area_sqft').val(resp.data.total_square_feet);
                                     $('.total_building_area_in_kitta').val('');
                                    $('.remaining_area').val('');
                                    $('#sanrachana_details_id').val('');
                                    $('.r_bhumi_fields').hide();
                                }
                                if(resp.data.a_ropani == ''){
                                  a_ropani = 0;
                              } else{
                                  a_ropani = resp.data.a_ropani;
                              }

                              if(resp.data.a_ana == ''){
                                  a_ana = 0;
                              } else{
                                  a_ana = resp.data.a_ana;
                              }

                              if(resp.data.a_paisa == ''){
                                  a_paisa = 0;
                              } else{
                                  a_paisa = resp.data.a_paisa;
                              }

                              if(resp.data.a_dam == ''){
                                  a_dam = 0;
                              } else{
                                  a_dam = resp.data.a_dam;
                              }

                              var ropani_value = a_ropani + '-' + a_ana +
                              '-' + a_paisa + '-' + a_dam;
                              $('#land_area_ropani').val(ropani_value);
                              $('#n_no').val(resp.data.nn_number);
                            }
                        } else {
                            if(resp.status == 'validation_error') {
                                alert(resp.data);
                                location.reload();
                            }
                        }
                    }
                });
            });

                    $(document).on('change', '.land_area_type, .land_sa_type', function() {
                      var obj = $(this);
                      var land_area_type = $('.land_area_type').val();
                      var structure_type = $('.land_sa_type').val();
                      $.ajax({
                       method: "POST",
                       url: base_url + "SanrachanaDetails/getMinStructureAmount",
                       data: {
                        land_area_type: land_area_type,
                        structure_type: structure_type,
                        '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    success: function(resp) {
                        if (resp.status == 'success') {
                         if (resp.data == null) {
                        //alert('संरचनाको तोकिएको न्युनतम मुल्य राखिएको छैन');
                        $('.structure_min_amount').val(0);
                        $('.structure_max_amount').val(0);
                        $('.min_fixed_rate').val(0);
                        var min_fixed_rate = $('.min_fixed_rate').val();
                        var area_sqft_g = $('#area_sqft_g').val();
                        var total_sanrachana_area = area_sqft_g * min_fixed_rate;
                        $('.khud_rate').val(total_sanrachana_area);
                        $('.sanrachna_ck_land').val(0);
                    } else {
                        $('.structure_min_amount').val(resp.data.minimum_amount);
                        $('.structure_max_amount').val(0)
                        $('.min_fixed_rate').val(resp.data.minimum_amount);
                        var floor = $('.floor').val();
                        var area_sqft = $('#area_sqft').val();
                        var total_area = floor * area_sqft;
                        $('#area_sqft_g').val(total_area);
                        var area_sqft_g = $('#area_sqft_g').val();
                        //alert(area_sqft_g);
                        var min_fixed_rate = $('.min_fixed_rate').val();
                        var total_sanrachana_area = area_sqft_g * min_fixed_rate;
                        $('.khud_rate').val(total_sanrachana_area);

                        //sanrahana charcheko land calculation
                //      var ropani = area_sqft / 5476;
                //      var total_cherckeko_land_tax = ropani * min_fixed_rate * $(
                //          '.total_land_amount').val();
                //      $('.sanrachna_ck_land').val(total_cherckeko_land_tax);

                        //calculate sampati kar amount
                        var totalGharKoTax =  $('.khud_rate').val();
                        var toatalCharchekeTax = $('.sanrachna_ck_land').val();
                        var toatl_samptati_kar_amount = parseFloat(totalGharKoTax) + parseFloat(toatalCharchekeTax);
                        $('.net_total_amount').val(toatl_samptati_kar_amount.toFixed(2));
                    }
                }
            }
        });
                  });

                    $(document).on('input', '#length, #width', function() {
                      var l = $('#length').val();
                      var w = $('#width').val();
                      var f = $('.floor').val();
                      var total = l * w;
                      var min_fixed_rate = $('.min_fixed_rate').val();
                      $('#area_sqft').val(total);
                      total_value = $('#area_sqft').val();
                      var ropani_convetor = total_value / 5476;

                      var total_sanrachana_area = total * f;
                      $('#area_sqft_g').val(total_sanrachana_area);

                      var total_sanrachana_rate = total_sanrachana_area * min_fixed_rate;
                      $('.khud_rate').val(total_sanrachana_rate);
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
                        var ropani_value = a + '-' + total_aana + '-' + Math.trunc(t_paisa) + '-' + t_dam.toFixed(0);
                        $('#area_sqft_ropani').val(ropani_convetor);

                        //calculate bhumi kar details


                        //-----------------------------------------------//
                        var total_land_area = $('#land_area_sqft').val();
                        var charcheko_area = $('.charcheko_area').val();
                        var total_sanrachana_cover_area = total * 2;
                        var total_sanrachana_diff = total_land_area - charcheko_area;
                        
                        var total_land_area = $('#land_area_sqft').val();
                        var total_jagga_less = total_value * 2;
                        var total_sanrachana_cover_area = total_value * 2;
                        var total_sanrachana_diff = total_land_area - total_jagga_less;
                        
                        var totalGharKoTax =  $('.khud_rate').val();
                        if ( total_land_area > total_sanrachana_cover_area) {
                            var total_charckeko_area = total_value * 2;
                            var ropani_value = total_charckeko_area / 5476;
                            var total_cherckeko_land_tax = ropani_value * $('.total_land_amount').val();
                            $('.sanrachna_ck_land').val(total_cherckeko_land_tax.toFixed(2));
                            $('.charcheko_area').val(total_charckeko_area);
                            var bhumi_kar_convertor = total_sanrachana_diff / 5476;
                            var total_bhu_kar = bhumi_kar_convertor * $('.total_land_amount').val();
                            $('.bhumi_kar_area').val(total_sanrachana_diff);
                            $('.bhumi_kar_amount').val(total_bhu_kar.toFixed());
                             var total_with = parseFloat(totalGharKoTax) + parseFloat(total_cherckeko_land_tax);
                            $('.net_total_amount').val(total_with.toFixed());
                
                        } else {
                            var ropani_value = total_land_area / 5476;
                            var total_cherckeko_land_tax = ropani_value * $('.total_land_amount').val();
                            $('.sanrachna_ck_land').val(total_cherckeko_land_tax.toFixed(2));
                            $('.charcheko_area').val(total_land_area);
                            $('.bhumi_kar_amount').val(0);
                            $('.bhumi_kar_area').val(0);
                            var total_with = totalGharKoTax + total_cherckeko_land_tax;
                            $('.net_total_amount').val(total_with.toFixed());
                        }
                    
                    // if (charcheko_area < total_land_area) {
                    //     var total_charckeko_area = charcheko_area;
                    //     var ropani_value = total_charckeko_area / 5476;
                    //     var total_cherckeko_land_tax = ropani_value * $('.total_land_amount').val();
                    //     $('.sanrachna_ck_land').val(total_cherckeko_land_tax.toFixed(2));
                    //     $('.charcheko_area').val(total_charckeko_area);
                    //     var bhumi_kar_convertor = total_sanrachana_diff / 5476;
                    //     var total_bhu_kar = bhumi_kar_convertor * $('.total_land_amount').val();
                    //     $('.bhumi_kar_area').val(total_sanrachana_diff);
                    //     $('.bhumi_kar_amount').val(total_bhu_kar.toFixed(2));
                        
                    // } else {
                    //     var ropani_value = total_land_area / 5476;
                    //     var total_cherckeko_land_tax = ropani_value * $('.total_land_amount').val();
                    //     $('.sanrachna_ck_land').val(total_cherckeko_land_tax.toFixed(2));
                    //     $('.charcheko_area').val(total_land_area);
                    //     $('.bhumi_kar_amount').val(0);
                    //     $('.bhumi_kar_area').val(0);
                    // }

                    //calculate sampati kar amount
                    
                });

                $(document).on('change', '#constructed_year', function() {
                      obj = $(this);
                      var year = obj.val();
                      var land_strucutre_type = $('.land_area_type').val();
                      $.ajax({
                       method: "POST",
                       url: base_url + "SanrachanaDetails/getDepRate",
                       data: {
                        year: year,
                        land_strucutre_type: land_strucutre_type,
                        '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    success: function(resp) {
                        console.log(resp.data);
                        if (resp.status == 'success') {
                         if (resp.data == null) {
                          $('.dep_rate').val(0);
                      } else {
                          $('.dep_rate').val(resp.data.rate);
                          var rp = resp.data.rate / 100;
                          var min_fixed_rate = $('.min_fixed_rate').val();
                          var khud_rate = min_fixed_rate * rp;
                          var area_sqft_g = $('#area_sqft_g').val();
                          var floor = $('.floor').val();
                          var total = min_fixed_rate * area_sqft_g;
                          var total_khud_rate = total - khud_rate;
                          $('.khud_rate').val(total_khud_rate);
                      }
                  }
              }
          });
                  });
        
        
        $(document).on('input', '#area_sqft', function() {
            obj = $(this);
            r = 0;
            var total_value = obj.val();
            var land_min_amount = $('.total_land_amount').val();
            var l = $('#length').val('');
            var w = $('#width').val('');
            //-------------------------------------
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
            var ropani_value = a + '-' + total_aana + '-' + Math.trunc(t_paisa) + '-' + t_dam.toFixed(0);
    
            var double = total_value * 2;
            var talla = $('.floor').val();
            var total_sar_area = talla * total_value;
            $('#area_sqft_g').val(total_sar_area);
    
            $('.sanrachna_ck_land').val(total_land_tax);
            var sanrachana_kubul_amount = $('.min_fixed_rate').val();
            var total_khud_rate = total_sar_area * sanrachana_kubul_amount;
            $('.khud_rate').val(total_khud_rate);
            var net_total = total_land_tax + total_khud_rate;
            $('.net_total_amount').val(net_total.toFixed(2));
            //console.log(double);
    
    
            
            $('#area_sqft_ropani').val(ropani.toFixed(2));
            var total_sar_area = talla * total_value;
            $('#area_sqft_g').val(total_sar_area);
            //get sanracha land amount
            var floor = $('.floor').val();
            var ropani_calculation = total_value / 5476;
    
            var total_land = ropani_calculation * 2;
            var total_land_tax = total_land * land_min_amount;
            //$('.sanrachna_ck_land').val(total_land_tax);
            var sanrachana_kubul_amount = $('.min_fixed_rate').val();
            var total_khud_rate = total_sar_area * sanrachana_kubul_amount;
            $('.khud_rate').val(total_khud_rate);
            //var net_total = total_land_tax + total_khud_rate;
            
    
            var total_land_area = $('#land_area_sqft').val();
            var total_jagga_less = total_value * 2;
            var total_sanrachana_cover_area = total_value * 2;
            var total_sanrachana_diff = total_land_area - total_jagga_less;
            if ( total_land_area > total_sanrachana_cover_area) {
                var total_charckeko_area = total_value * 2;
                var ropani_value = total_charckeko_area / 5476;
                var total_cherckeko_land_tax = ropani_value * $('.total_land_amount').val();
                $('.sanrachna_ck_land').val(total_cherckeko_land_tax.toFixed(2));
                $('.charcheko_area').val(total_charckeko_area);
                var bhumi_kar_convertor = total_sanrachana_diff / 5476;
                var total_bhu_kar = bhumi_kar_convertor * $('.total_land_amount').val();
                $('.bhumi_kar_area').val(total_sanrachana_diff);
                $('.bhumi_kar_amount').val(total_bhu_kar.toFixed());
                 var total_with = total_khud_rate + total_cherckeko_land_tax;
                $('.net_total_amount').val(total_with.toFixed());
               // $('.net_total_amount').val(total_khud_rate + total_cherckeko_land_tax);
    
            } else {
                var ropani_value = total_land_area / 5476;
                var total_cherckeko_land_tax = ropani_value * $('.total_land_amount').val();
                $('.sanrachna_ck_land').val(total_cherckeko_land_tax.toFixed(2));
                $('.charcheko_area').val(total_land_area);
                $('.bhumi_kar_amount').val(0);
                $('.bhumi_kar_area').val(0);
                var total_with = total_khud_rate + total_cherckeko_land_tax;
                $('.net_total_amount').val(total_with.toFixed());
            }
        });
    

    // $(document).on('input', '#area_sqft', function() {
    //                   obj = $(this);
    //                   r = 0;
    //                   var total_value = obj.val();
    //                   var land_min_amount = $('.total_land_amount').val();

    //                   var l = $('#length').val('');
    //                   var w = $('#width').val('');
    //     //-------------------------------------
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
    //     var total_aana = Math.trunc(aana);
    //     var rem_sqft_after_aana = total_aana * one_aana;
    //     var d = c - rem_sqft_after_aana;
    //     var t_paisa = d / one_paisa;
    //     //----------------------------------------
    //     var t_paisa_p = Math.trunc(t_paisa);
    //     var rem_t_paisa = t_paisa_p * one_paisa;
    //     var e = d - rem_t_paisa;
    //     var t_dam = e / one_dam;
    //     var ropani_value = a + '-' + total_aana + '-' + Math.trunc(t_paisa) + '-' + t_dam.toFixed(0);
    //     $('#area_sqft_ropani').val(ropani.toFixed(2));
    //     var talla = $('.floor').val();
    //     var total_sar_area = talla * total_value;
    //     $('#area_sqft_g').val(total_sar_area);
    //     //get sanracha land amount
    //     var floor = $('.floor').val();
    //     var ropani_calculation = total_value / 5476;
    //     var total_land = ropani_calculation * 2;
    //     var total_land_tax = total_land * land_min_amount;
    //     //$('.sanrachna_ck_land').val(total_land_tax);
    //     var sanrachana_kubul_amount = $('.min_fixed_rate').val();
    //     var total_khud_rate = total_sar_area * sanrachana_kubul_amount;
    //     $('.khud_rate').val(total_khud_rate);
    //     var net_total = total_land_tax + total_khud_rate;
    //     $('.net_total_amount').val(net_total.toFixed(2));

    //     var total_land_area = $('#land_area_sqft').val();
    //     var total_jagga_less = total_value*2;
    //     //var total_land_area = $('#land_area_sqft').val();
    //     //var charcheko_area = $('.charcheko_area').val();
        
    //     var total_sanrachana_cover_area = total_value * 2;
    //     var total_sanrachana_diff = total_land_area - total_jagga_less;

    //     if (total_sanrachana_cover_area <= total_land_area) {
    //         var total_charckeko_area = total_value * 2;
    //         var ropani_value = total_charckeko_area / 5476;
    //         var total_cherckeko_land_tax = ropani_value * $('.total_land_amount').val();
    //         $('.sanrachna_ck_land').val(total_cherckeko_land_tax.toFixed(2));
    //         $('.charcheko_area').val(total_charckeko_area);
    //         var bhumi_kar_convertor = total_sanrachana_diff / 5476;
    //         var total_bhu_kar = bhumi_kar_convertor * $('.total_land_amount').val();
    //         $('.bhumi_kar_area').val(total_sanrachana_diff);
    //         $('.bhumi_kar_amount').val(total_bhu_kar.toFixed(2));

    //     } else {
    //         var ropani_value = total_land_area / 5476;
    //         var total_cherckeko_land_tax = ropani_value * $('.total_land_amount').val();
    //         $('.sanrachna_ck_land').val(total_cherckeko_land_tax.toFixed(2));
    //         $('.charcheko_area').val(total_land_area);
    //         $('.bhumi_kar_amount').val(0);
    //         $('.bhumi_kar_area').val(0);
    //     }

    // });

                    $(document).on('change', '.floor', function() {
                      var floor = $(this).val();
                      var unit = $('#area_sqft').val();
                      var total = floor * unit;
                      $('#area_sqft_g').val(total);
                      var sanrachana_kubul_amount = $('.min_fixed_rate').val();
                      var total_khud = total * sanrachana_kubul_amount;
                      $('.khud_rate').val(total_khud);

        //calculate sampati kar amount
        var totalGharKoTax =  $('.khud_rate').val();
        var toatalCharchekeTax = $('.sanrachna_ck_land').val();
        var toatl_samptati_kar_amount = parseFloat(totalGharKoTax) + parseFloat(toatalCharchekeTax);
        $('.net_total_amount').val(toatl_samptati_kar_amount.toFixed(2));

    });

                    $(document).on('input', '.min_fixed_rate', function() {
                      obj = $(this);
                      var min_land_rate = obj.val();
                      var structure_min_amount = $('.structure_min_amount').val();
                      if(min_land_rate < $(structure_min_amount)) {
                       var kubul_rate = structure_min_amount;
                   } else {
                       var kubul_rate = min_land_rate;
                   }
                   var total_value = $('#area_sqft').val();
                   if (min_land_rate < structure_min_amount) {
                       $('.k_alert').text('तोकिएको मुल्य भन्दा काम हल्ना मिल्दैन');
                       $('.save_button').attr('disabled', 'disabled');
                       var area_sqft_g = $('#area_sqft_g').val();
                       var total_land_tax_g = kubul_rate * area_sqft_g;
                       $('.khud_rate').val(total_land_tax_g);
                       var ropani = total_value / 5476;
                       var total_cherckeko_land_tax = ropani * structure_min_amount * $(
                        '.total_land_amount').val();
                       $('.sanrachna_ck_land').val(total_cherckeko_land_tax)

            //calculate sampati kar amount
            var totalGharKoTax =  $('.khud_rate').val();
            var toatalCharchekeTax = $('.sanrachna_ck_land').val();
            var toatl_samptati_kar_amount = parseFloat(totalGharKoTax) + parseFloat(toatalCharchekeTax);
            $('.net_total_amount').val(toatl_samptati_kar_amount.toFixed(2));


        } else {
            $('.k_alert').text('');
            $('.save_button').prop("disabled", false); 
            var area_sqft_g = $('#area_sqft_g').val();
            var total_land_tax_g = kubul_rate * area_sqft_g;
            $('.khud_rate').val(total_land_tax_g);
            var ropani = area_sqft_g / 5476;
            var total_cherckeko_land_tax = ropani * min_land_rate * $(
                '.total_land_amount').val();
            $('.sanrachna_ck_land').val(total_cherckeko_land_tax);

            //calculate sampati kar amount
            var totalGharKoTax =  $('.khud_rate').val();
            var toatalCharchekeTax = $('.sanrachna_ck_land').val();
            var toatl_samptati_kar_amount = parseFloat(totalGharKoTax) + parseFloat(toatalCharchekeTax);
            $('.net_total_amount').val(toatl_samptati_kar_amount.toFixed(2));
        }

    });

                });
            </script>
