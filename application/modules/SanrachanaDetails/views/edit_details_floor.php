    <!--main content start-->
    <section id="main-content">
        <section class="wrapper site-min-height">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i>
                            गृहपृष्ठ</a>
                    </li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>PersonalProfile">
                            जग्गाधनी प्रोफाइल</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>SanrachanaDetails/veiwDetails/<?php echo $lo_details['file_no'] ?>">
                            भोतिक संरचनाको विवरण </a></li>
                    <li class="breadcrumb-item"><a href="javascript:;">
                            विवरण सम्पादन गर्नुहोस् </a></li>

                </ol>
            </nav>
            <!-- page start-->
            <div class="row">
                <div class="col-sm-12">
                    <form action="<?php echo base_url() ?>SanrachanaDetails/updateFloorDetails" method="post" class="save_post">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <input type="hidden" name="is_feature" value="<?php echo !empty($has_bill) ? 1 :'' ?>">
                        <section class="card">
                            <header class="card-header" style="background: #1b5693;color:#FFF">
                                भोतिक संरचनाको विवरण : जग्गाधनी - <?php echo $lo_details['land_owner_name_np'] ?> /
                                जग्गाधनिको क्र.स नम्बर :<?php echo $lo_details['file_no'] ?>
                                <?php if (!empty($has_bill)) { ?>
                                    <a href="<?php echo base_url() ?>SampatiKarRasid/viewRasid/<?php echo $lo_details['file_no'] ?>" class="btn btn-success" target="_blank"><i class="fa fa-check"></i> चालु आ. व. को रसिद हेर्नुहोस</a>
                                <?php } ?>
                            </header>


                            <div class="card-body">
                                <div class="notification"></div>
                                <div class="valid_errors"></div>
                                <div class="row">
                                    <input type="hidden" value="<?php echo $row['id']?>" name ="id">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="ls_file_no" value="<?php echo $lo_details['file_no'] ?>" id="file_no">
                                            <label>संरचना रहेको कि.नं<span style="color:red">*</span></label>
                                            <select name="k_no" class="from-control dd_select" id="k_no">
                                                <option value="">छान्नुहोस्</option>
                                                <?php 
                                                  if(!empty($landDescription)) :
                                                  foreach ($landDescription as $key => $ld) : ?>
                                                      <option id="<?php echo  $ld['k_number'] .'_'.$ld['road_name'] .'_'. $ld['nn_number']?>" value="<?php echo  $ld['k_number'] ?>" <?php if($row['k_no'] == $ld['k_number']) {echo 'selected';}?>><?php echo  $ld['k_number'] . ' (' . $ld['setting_road_name'] . ')'?>
                                                      </option>
                                                <?php endforeach; endif;?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>संरचना रहेको जग्गाको क्षेत्रफल<span style="color:red">*</span></label>
                                            <input type="text" name="toal_land_area" value="<?php echo $row['toal_land_area']?>" class=" form-control" id="land_area_ropani" readonly="readonly">
                                            <span class="info"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label> क्षेत्रफल(वर्गफुट)<span style="color:red">*</span></label>
                                            <input type="text" name="total_land_area_sqft" value="<?php echo $row['total_land_area_sqft']?>" class=" form-control" id="land_area_sqft" readonly="readonly">

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label> जग्गाको कबुल गरेको मूल्य(प्रति रोपनी)<span style="color:red">*</span></label>
                                            <input type="text" name="total_land_min_amount" value="<?php echo $row['total_land_min_amount']?>" class=" form-control total_land_amount" readonly="readonly">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label> जग्गाको कर लाग्ने मुल्य <span style="color:red">*</span></label>
                                            <input type="text" name="total_land_tax_amount" value="<?php echo $row['total_land_min_amount']?>" class=" form-control total_land_tax_amount" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">

                                        <div class="row r_bhumi_fields">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> यो कित्ता मा रहेको पहिलो संरचनाको क्षेत्रफल <span style="color:red">*</span></label>
                                                    <input type="text" name="" value="" class=" form-control total_building_area_in_kitta" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> चर्चेकाे बाहेक भूमिकर जग्गाको क्षेत्रफल <span style="color:red">*</span></label>
                                                    <input type="text" name="remaining_area" value="" class=" form-control remaining_area" readonly>
                                                    <input type="hidden" name="sanrachana_id" id="sanrachana_details_id">
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>संरचना रहेको न.नं<span style="color:red">*</span></label>
                                            <input type="text" name="sanrachana_n_no" class="form-control" id="n_no" value="<?php echo $row['sanrachana_n_no']?>" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>संरचनाको प्रकार<span style="color:red">*</span></label>
                                            <select name="sanrachana_prakar" class="from-control dd_select land_sa_type" id="land_sa_type">
                                                <?php 
                                                if(!empty($architecttype)) :
                                                foreach ($architecttype as $key => $at) : ?>
                                                <option value="<?php echo  $at['id']?>" <?php echo 'selected';?>><?php echo $at['architect_type']?></option>
                                            <?php endforeach; endif;?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>संरचनाको बनौटको किसिम<span style="color:red">*</span></label>
                                            <select name="sanrachana_banot_kisim" class="from-control dd_select land_area_type" id="land_area_type">
                                                <option value="">छान्नुहोस्</option>
                                                <?php
                                                if (!empty($architectstructure)) :
                                                    foreach ($architectstructure as $key => $as) :
                                                ?> <option value="<?php echo  $as['id']?>" <?php if($as['id'] == $selected_ghartype['id']){ echo 'selected';}?>><?php echo $as['structure_type']?>
                                            </option>
                                                <?php endforeach;
                                                endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>संरचनाको प्रयोगको किसिम<span style="color:red">*</span></label>
                                            <select name="sanrachana_usages" class="from-control dd_select " id="land_usage">
                                              <option value="निजी" <?php if($row['sanrachana_usages']=='निजी'){echo 'selected';}?>>निजी</option>
                                              <option value="भाडा" <?php if($row['sanrachana_usages']=='भाडा'){echo 'selected';}?>>भाडा</option>
                                              <option value="अन्य" <?php if($row['sanrachana_usages']=='अन्य'){echo 'selected';}?>>अन्य</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label> संरचनाको तोकिएको न्यु.मु.(प्र व.फु.)<span style="color:red">*</span></label>
                                            <input type="text" name="sanrachana_min_amount" value="<?php echo $row['sanrachana_min_amount']?>" class=" form-control structure_min_amount" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label> संरचनाको कवोल मुल्य(प्र व.फु.) <span style="color:red">*</span></label>
                                            <input type="text" name="sanrachana_kubul_amount" value="<?php echo $row['sanrachana_kubul_amount']?>" class=" form-control min_fixed_rate">
                                            <div class="k_alert" style="color: red"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <hr>
                                        <table class="table print_table " id="add_new_fields">
                                            <tbody>
                                              <?php if(!empty($floor_details)) :
                                              $i= 1 ;
                                              foreach($floor_details as $key => $floor) : ?>
                                                <tr>
                                                    <!-- <td>
                                                        <div class="form-group">
                                                            <label>संरचनाको लम्बाई<span style="color:red">*</span></label>
                                                            <input type="text" name="sanrachana_ground_lenth" value="" class="form-control decimal_field length" id="length_1">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label>संरचनाको चौडाई<span style="color:red">*</span></label>
                                                            <input type="text" name="sanrachana_ground_width" value="" class=" form-control decimal_field width" id="width_1">
                                                        </div>
                                                    </td> -->

                                                    <td>
                                                        <!-- <div class="form-group">
                                                            <label>तल्ला छान्नुहोस्<span style="color:red">*</span></label>
                                                            <select name="sanrachana_floor[]" class="form-control floor" id="">
                                                                <option value="1">पहिलो</option>
                                                                <option value="2" disabled>दोस्रो</option>
                                                                <option value="3" disabled>तेस्रो</option>
                                                                <option value="4" disabled>चौथो</option>
                                                                <option value="5" disabled>पाँचौं</option>
                                                                <option value="6" disabled>छैठौं</option>
                                                                <option value="7" disabled>सातौं</option>
                                                                <option value="8" disabled>आठौं</option>
                                                                <option value="9" disabled>नवौं</option>
                                                                <option value="10" disabled>दशौं</option>
                                                            </select>
                                                        </div> -->
                                                        <input type="hidden" name="child_id[]" value="<?php echo $floor['id']?>">
                                                        <input type="hidden" name="sanrachana_id[]" value="<?php echo $floor['sanrachana_id']?>">
                                                        <label>तल्ला<span style="color:red">*</span></label>
                                                        <input type="text" name = "sanrachana_floor[]" class="form-control floor" value = "<?php echo $floor['floor']?>" id="floor_<?php echo $floor['floor']?>" readonly>
                                                    </td>

                                                    <td>
                                                        <div class="form-group">
                                                            <label>क्षेत्रफल वर्गफुट<span style="color:red">*</span></label>
                                                            <input type="text" name="sanrachana_ground_area_sqft_by_floor[]" value="<?php echo $floor['area']?>" class=" form-control area_sqft" id="area_sqft_<?php echo $floor['floor']?>">
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="form-group">
                                                            <label>खुद मूल्य<span style="color:red">*</span></label>
                                                            <input type="text" name="sanrachana_khud_amount_by_floor[]" value="<?php echo $floor['amount']?>" class=" form-control khud_rate" id="khud_<?php echo $floor['floor']?>" readonly>
                                                        </div>
                                                    </td>
                                                    
                                                    <td>
                                                        <button type ="button" class="btn btn-primary btn-shadow btnAddNew mt-4" data-toggle="tooltip" title=" नयाँ थप्नुहोस्" tabindex="-1"><i class="fa fa-plus-circle"> </i> </button>
                                                        <button type="button" class="btn btn-danger btn-shadow mt-4 remove-row" data-id = "<?php echo $floor['floor']?>" style="margin-left:2px;"><i class="fa fa-minus-circle"></i> </button>
                                                    </td>
                                                </tr>
                                              <?php endforeach;endif;?>
                                            </tbody>
                                        </table>
                                        <hr>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="alert alert-info">चर्चेकाे जग्गाको क्षेत्रफल = (पहिलो तल्ला*२) + (थप तल्ल्लाको क्षेत्रफ़ल) </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>संरचनाको जम्मा तल्ला <span style="color:red">*</span></label>
                                            <input type="text" name="sanrachan_total_floor" value="<?php echo $row['sanrachana_floor']?>" class=" form-control sanrachan_total_floor" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>संरचनाको खुद कायम मुल्य <span style="color:red">*</span></label>
                                            <input type="text" name="sanrachana_khud_amount" value="<?php echo $row['sanrachana_khud_amount']?>" class=" form-control sanrachan_khud_amount" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>चर्चेकाे जग्गाको क्षेत्रफल<span style="color:red">*</span></label>
                                            <input type="text" name="charcheko_area" value="<?php echo $row['sanrachana_ground_housing_area_sqft']?>" class="form-control charcheko_area" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>चर्चेकाे जग्गाको कर लाग्ने मुल्य<span style="color:red">*</span></label>
                                            <input type="text" name="sanrachana_land_tax_amount" value="<?php echo $row['sanrachana_land_tax_amount']?>" class="form-control sanrachna_ck_land" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>बनेको साल<span style="color:red">*</span></label>
                                            <select name="contructed_year" class="from-control dd_select year" id="constructed_year">
                                                <option value="">छान्नुहोस्</option>
                                                <?php 
                                                    if(!empty($year)) :
                                                        foreach ($year as $key => $year) : 
                                                    ?>
                                                    <option value="<?php echo  $year['name']?>" <?php if($row['contructed_year'] == $year['name']){echo 'selected';}?>><?php echo $year['name']?>
                                                    </option>
                                                <?php endforeach; endif;?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label> संरचनाको ह्रासकट्टी प्रतिशत <span style="color:red">*</span></label>
                                            <input type="text" name="sanrachana_dep_rate" value="<?php echo $row['sanrachana_dep_rate']?>" class=" form-control dep_rate" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label> सम्पति मूल्याङ्कन जम्मा मुल्य <span style="color:red">*</span></label>
                                            <input type="text" name="net_tax_amount" value="<?php echo $row['sanrachana_min_amount']?>" class=" form-control net_total_amount" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> चर्चेकाे बाहेक भूमिकर जग्गाको क्षेत्रफल <span style="color:red">*</span></label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" name="bhumi_kar_area" value="<?php echo $row['r_bhumi_area']?>" class=" form-control bhumi_kar_area" readonly>
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
                                            <label> चर्चेकाे बाहेक जग्गाको भूमिकर मूल्याङ्कन <span style="color:red">*</span></label>
                                            <input type="text" name="bhumi_kar_amount" value="<?php echo $row['r_bhumi_kar']?>" class=" form-control bhumi_kar_amount" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-center">
                                        <hr>
                                        <button class="btn btn-primary btn-xs save_btn" data-toggle="tooltip" title=" सेभ  गर्नुहोस्" name="Submit" type="submit" value="Save"> सेभ
                                            गर्नुहोस्</button>
                                        <a href="<?php echo base_url() ?>SanrachanaDetails/veiwDetails/<?php echo $lo_details['file_no'] ?>" class="btn btn-danger btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्">रद्द गर्नुहोस्</a>
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
    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>assets/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/assets/data-tables/DT_bootstrap.js"></script>

    <script type="text/javascript" src="<?php echo base_url() ?>assets/assets/select2/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.r_bhumi_fields').hide();
            $('.dd_select').select2();
            $(document).on('click', '.btnAddNew' ,function(e){
                e.preventDefault();
                // var trOneNew = $('#add_new_fields').length + 1;
                var trOneNew     = $('.print_table >tbody >tr').length + 1;
                var tr           = $(this).closest('tr');
                var new_row     =  '<tr class="nagadi_rasid_frm">'+
                // '<td><div class="form-group"><input type="text" name="sanrachana_ground_lenth" value="" class=" form-control decimal_field length" id="length_'+trOneNew+'"></div></td>'+

                // '<td><div class="form-group"><input type="text" name="sanrachana_ground_width" value="" class=" form-control decimal_field width" id="width_'+trOneNew+'"></div></td>'+

                '<td><input type="text" name = "sanrachana_floor_new[]" class="form-control floor" value = "" id="floor_'+trOneNew+'" readonly></td>'+

                // '<td><div class="form-group"><select name="sanrachana_floor[]" class="form-control dd_select floor" id=""><option value="2">दोस्रो</option><option value="3">तेस्रो</option><option value="4">चौथो</option><option value="5">पाँचौं</option><option value="6">छैठौं</option><option value="7">सातौं</option><option value="8">आठौं</option><option value="9">नवौं</option><option value="10">दशौं</option></select></div></td>'+

                '<td><div class="form-group"><input type="text" name="sanrachana_ground_area_sqft_by_floor_new[]" value="" class=" form-control area_sqft" id="area_sqft_'+trOneNew+'"></div></td>'+

                '<td><div class="form-group"><input type="text" name="sanrachana_khud_amount_by_floor_new[]" value="" class=" form-control khud_rate" id="khud_'+trOneNew+'" readonly></div></td>'+

                '<td><button type ="button" class="btn btn-primary btn-shadow btnAddNew" data-toggle="tooltip" title=" नयाँ थप्नुहोस्" tabindex="-1"><i class="fa fa-plus-circle"> </i></button><button class="btn btn-danger btn-shadow remove-row" data-id = "'+trOneNew+'" style="margin-left:2px;"><i class="fa fa-minus-circle"></i></button></td></tr>';
              
                $("#add_new_fields").append(new_row);
                $('.sanrachan_total_floor').val(trOneNew);
                $('#floor_'+trOneNew).val(trOneNew);
                
            });

            $("body").on("click",".remove-row", function(e){
                e.preventDefault();
                if (confirm('के तपाइँ  यसलाई हटाउन निश्चित हुनुहुन्छ ?')) {
                    var sanrachana_floor = $('.sanrachan_total_floor').val();
                    $('.sanrachan_total_floor').val(parseInt(sanrachana_floor) -1);

                    //calculaion

                    var area_sqft   = $(this).val();
                    var total_area = 0;
                    var total_khud_amount   = 0;
                    var floor               = $(this).closest("tr").find(".floor").val() || 0; //तल्ला
                    //console.log(floor);
                    var kamount             = $(".min_fixed_rate").val() || 0;// कबुल मूल्य
                    var length              = $(this).closest("tr").find(".length").val() || 0;//लम्बाई
                    var width               = $(this).closest("tr").find(".width").val() || 0;//चौदेई
                    var land_min_amount     = $('.total_land_amount').val() || 0;
                    var land_area_sqft      = $('#land_area_sqft').val() || 0;
                    var ground_level_area   = $('#area_sqft_1').val() || 0;
                    var ground_level_amount   = $('#khud_1').val() || 0;
                    $(this).closest("tr").find(".area_sqft").val(area_sqft) || 0;
                    var khud_amount = area_sqft * kamount;
                    $(this).closest("tr").find('.khud_rate').val(khud_amount);
                    $(".area_sqft").each(function(){
                        total_area +=  +$(this).val()
                    });
                    $(".khud_rate").each(function(){
                        total_khud_amount +=  +$(this).val()
                    });
                    //double charchek area
                    var double_chercheko_area = total_area + parseFloat(ground_level_area);
                    $('.charcheko_area').val(double_chercheko_area);
                    $('.sanrachan_khud_amount').val(total_khud_amount);
                    //चर्चेकाे जग्गाको कर लाग्ने मुल्य
                    var charchekoarea = double_chercheko_area / 5476;
                    var total_charcheko_land_amount = charchekoarea * land_min_amount;
                    $('.sanrachna_ck_land').val(total_charcheko_land_amount.toFixed(2));
                    var net_total_amount = parseFloat(total_charcheko_land_amount) + parseFloat(total_khud_amount);
                    $('.net_total_amount').val(net_total_amount.toFixed(2));

                    //चर्चेकाे बाहेक भूमिकर जग्गाको क्षेत्रफल
                    var rem_land_area = parseFloat(land_area_sqft) - parseFloat(double_chercheko_area);
                    $('.bhumi_kar_area').val(rem_land_area);

                    var total_land_tax_amount = rem_land_area / 5476 * land_min_amount;
                    $('.bhumi_kar_amount').val(total_land_tax_amount.toFixed(2));
                    $(this).parent().parent().remove();
                }
            });

            $(document).on('change', '#k_no', function() {
                var obj = $(this);
                var k_no = obj.children(":selected").attr("id")
                k_no = k_no.split('_');
                var file_no = $('#file_no').val();

                $.ajax({
                    method: "POST",
                    url: base_url + "SanrachanaDetails/getLandDescriptionByKNo",
                    data: {
                        k_no: k_no[0],
                        road_name: k_no[1],
                        nn_number: k_no[2],
                        file_no: file_no,
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    success: function(resp) {
                        if (resp.status == 'success') {
                            console.log(resp.sanrachana_details);
                            if (resp.data == null) {
                                $(".total_land_amount").val('');
                            } else {

                                $(".total_land_amount").val(resp.data.k_land_rate);
                                $(".total_land_tax_amount").val(resp.data.t_rate);
                                if (resp.sanrachana_details != null) {
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
                                if (resp.data.a_ropani == '') {
                                    a_ropani = 0;
                                } else {
                                    a_ropani = resp.data.a_ropani;
                                }

                                if (resp.data.a_ana == '') {
                                    a_ana = 0;
                                } else {
                                    a_ana = resp.data.a_ana;
                                }

                                if (resp.data.a_paisa == '') {
                                    a_paisa = 0;
                                } else {
                                    a_paisa = resp.data.a_paisa;
                                }

                                if (resp.data.a_dam == '') {
                                    a_dam = 0;
                                } else {
                                    a_dam = resp.data.a_dam;
                                }

                                var ropani_value = a_ropani + '-' + a_ana +
                                    '-' + a_paisa + '-' + a_dam;
                                $('#land_area_ropani').val(ropani_value);
                                $('#n_no').val(resp.data.nn_number);
                            }
                        }
                    }
                });
            });

            $(document).on('change', '.land_area_type, .land_sa_type', function() {
                var obj = $(this);
                var land_area_type      = $('.land_area_type').val();
                var structure_type      = $('.land_sa_type').val();
                var land_min_amount     = $('.total_land_amount').val() || 0;
                var land_area_sqft      = $('#land_area_sqft').val() || 0;
                var charcheko_area      = $('.charcheko_area').val() || 0;
                var sanrachna_ck_land   = $('.sanrachna_ck_land').val() || 0;
                $.ajax({
                    method: "POST",
                    url: base_url + "SanrachanaDetails/getMinStructureAmount",
                    data: {
                        land_area_type: land_area_type,
                        structure_type: structure_type,
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    success: function(resp) {
                        if (resp.status == 'success') {
                            if (resp.data == null) {
                                $('.structure_min_amount').val(0);
                                $('.structure_max_amount').val(0);
                                $('.min_fixed_rate').val(0);
                                var min_fixed_rate = $('.min_fixed_rate').val();
                                var area_sqft_g = $('#area_sqft_g').val();
                                var total_sanrachana_area = area_sqft_g * min_fixed_rate;
                                $('.khud_rate').val(total_sanrachana_area);
                                $('.sanrachna_ck_land').val(0);
                            } else {
                                var rowCount = $('.print_table >tbody >tr').length;
                                $('.structure_min_amount').val(resp.data.minimum_amount);
                                $('.min_fixed_rate').val(resp.data.minimum_amount);
                                var total_samount = 0;
                                $('tr').each(function (index) {
                                    var i           = index + 1;
                                    var length      = $(this).children('td').find('#length_'+i).val() || 0;
                                    var width       = $(this).children('td').find('#width_'+i).val() || 0;
                                    var area_sqft       = $(this).children('td').find('#area_sqft_'+i).val() || 0;
                                    //area_sqft       = length * width;
                                    //$(this).children('td').find('#area_sqft_'+i).val(length * width);
                                    var total_amount = area_sqft * resp.data.minimum_amount;
                                    $(this).children('td').find('#khud_'+i).val(total_amount);
                                    total_samount += +total_amount;
                                });
                                $('.sanrachan_khud_amount').val(total_samount);
                                var net_total_amount = parseFloat(sanrachna_ck_land )+ parseFloat(total_samount);
                                $('.net_total_amount').val(net_total_amount);
                            }
                        }
                    }
                });
            });

            $(document).on('input', '.length, .width', function() {
                var total_area = 0;
                var total_khud_amount = 0;
                var floor       = $(this).closest("tr").find(".floor").val() || 0; //तल्ला
                var kamount     = $(".min_fixed_rate").val() || 0;// कबुल मूल्य
                var length      = $(this).closest("tr").find(".length").val() || 0;//लम्बाई
                var width       = $(this).closest("tr").find(".width").val() || 0;//चौदेई
                var land_min_amount = $('.total_land_amount').val() || 0;
                var land_area_sqft  =$('#land_area_sqft').val() || 0;
                var area_sqft   = length * width;
                $(this).closest("tr").find(".area_sqft").val(area_sqft) || 0;
                var khud_amount = area_sqft * kamount;
                $(this).closest("tr").find('.khud_rate').val(khud_amount);
                $(".area_sqft").each(function(){
                    total_area +=  +$(this).val()
                });
                $(".khud_rate").each(function(){
                    total_khud_amount +=  +$(this).val()
                });
                $('.charcheko_area').val(total_area);
                $('.sanrachan_khud_amount').val(total_khud_amount);
                //चर्चेकाे जग्गाको कर लाग्ने मुल्य
                var charchekoarea = total_area / 5476;
                var total_charcheko_land_amount = charchekoarea * land_min_amount;
                $('.sanrachna_ck_land').val(total_charcheko_land_amount.toFixed(2));
                var net_total_amount = parseFloat(total_charcheko_land_amount) + parseFloat(total_khud_amount);
                $('.net_total_amount').val(net_total_amount.toFixed(2));

                //चर्चेकाे बाहेक भूमिकर जग्गाको क्षेत्रफल
                var rem_land_area = parseFloat(land_area_sqft) - parseFloat(total_area);
                $('.bhumi_kar_area').val(rem_land_area);

                var total_land_tax_amount = rem_land_area / 5476 * land_min_amount;
                $('.bhumi_kar_amount').val(total_land_tax_amount.toFixed(2));
            });

            $(document).on('input', '.area_sqft', function() {
                var area_sqft   = $(this).val();
                var total_area = 0;
                var total_khud_amount   = 0;
                var floor               = $(this).closest("tr").find(".floor").val() || 0; //तल्ला
                var kamount             = $(".min_fixed_rate").val() || 0;// कबुल मूल्य
                var length              = $(this).closest("tr").find(".length").val() || 0;//लम्बाई
                var width               = $(this).closest("tr").find(".width").val() || 0;//चौदेई
                var land_min_amount     = $('.total_land_amount').val() || 0;
                var land_area_sqft      = $('#land_area_sqft').val() || 0;
                var ground_level_area   = $('#area_sqft_1').val() || 0;
                var ground_level_amount   = $('#khud_1').val() || 0;
                $(this).closest("tr").find(".area_sqft").val(area_sqft) || 0;
                var khud_amount = area_sqft * kamount;
                $(this).closest("tr").find('.khud_rate').val(khud_amount);
                $(".area_sqft").each(function(){
                    total_area +=  +$(this).val()
                });
                $(".khud_rate").each(function(){
                    total_khud_amount +=  +$(this).val()
                });
                //double charchek area
                var double_chercheko_area = total_area + parseFloat(ground_level_area);
                $('.charcheko_area').val(double_chercheko_area);
                $('.sanrachan_khud_amount').val(total_khud_amount);
                //चर्चेकाे जग्गाको कर लाग्ने मुल्य
                var charchekoarea = total_area / 5476;
                var total_charcheko_land_amount = charchekoarea * land_min_amount;
                $('.sanrachna_ck_land').val(total_charcheko_land_amount.toFixed(2));
                var net_total_amount = parseFloat(total_charcheko_land_amount) + parseFloat(total_khud_amount);
                $('.net_total_amount').val(net_total_amount.toFixed(2));

                //चर्चेकाे बाहेक भूमिकर जग्गाको क्षेत्रफल
                var rem_land_area = parseFloat(land_area_sqft) - parseFloat(total_area);
                $('.bhumi_kar_area').val(rem_land_area);

                var total_land_tax_amount = rem_land_area / 5476 * land_min_amount;
                $('.bhumi_kar_amount').val(total_land_tax_amount.toFixed(2));
            });

            $(document).on('change', '#constructed_year', function() {
                obj = $(this);
                var year = obj.val();
                var land_strucutre_type = $('.land_area_type').val();
                var samount             = $('.sanrachan_khud_amount').val() || 0;
                var net_total_amount    = $('.net_total_amount').val() || 0;
                
                $.ajax({
                    method: "POST",
                    url: base_url + "SanrachanaDetails/getDepRate",
                    data: {
                        year: year,
                        land_strucutre_type: land_strucutre_type,
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    success: function(resp) {
                        if (resp.status == 'success') {
                            if (resp.data == null) {
                                $('.dep_rate').val(0);
                            } else {
                                $('.dep_rate').val(resp.data.rate);
                                var rp = resp.data.rate / 100;
                                
                                var dep_amount = samount * rp;
                                var khud_amount = net_total_amount - dep_amount;
                                $('.net_total_amount').val(khud_amount);
                            }
                        }
                    }
                });
            });
        });
    </script>