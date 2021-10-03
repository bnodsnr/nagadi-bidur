  <!--main content start-->
 <section id="main-content">
    <section class="wrapper site-min-height">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i>
                        गृहपृष्ठ</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url()?>Profile">
                        घर जग्गाको व्यक्तिगत अभिलेख</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url()?>SampatiKarRasid/addNewRasid/<?php echo $this->uri->segment(3)?>">
                        रसिदमा जानुहोस</a></li>
            </ol>
        </nav>
        <!-- page start-->
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="table-responsive" id="details">
                            <table class ="table table-bordered">
                                <thead>
                                    <tr>
                                      <th rowspan="2">आर्थिक वर्ष</th>
                                      <th colspan="6">जग्गाको विवरण</th>
                                      <th colspan="5">भौतिक संरचनाको विवरण</th>
                                     
                                      <th colspan="2">भूमिकर मूल्यांकन</th>
                                     <!--  <th rowspan="2">सम्पतीकर</th>
                                      <th rowspan="2">भूमिकर</th> -->
                                    </tr>
                                    <tr>
                                      <th>साबिक गा.पा/न.पा</th>
                                      <th>वडा</th>
                                      <th>हालको वडा</th>
                                      <th>नक्सा नं</th>
                                      <th>कित्ता नं</th>
                                      <th>क्षेत्रफल(व फु )</th>

                                      <th>बनावटको किसिम</th>
                                      <th>प्रयोग</th>
                                      <th>प्रकार </th>
                                      <th>क्षेत्रफल(व फु )</th>
                                      <th>जम्मा सम्पतीकर मूल्यांकन </th>

                                      <th>क्षेत्रफल(व फु )</th>
                                      <th>जग्गाको कयम मुल्य </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                      <td><?php echo $this->mylibrary->convertedcit($landdetails['fiscal_year'])?></td>
                                      <td><?php echo $this->mylibrary->convertedcit($landdetails['old_gapa_napa']) ?></td>
                                      <td><?php echo $this->mylibrary->convertedcit($landdetails['old_ward']) ?></td>
                                      <td><?php echo $this->mylibrary->convertedcit($landdetails['present_ward']) ?></td>
                                      <td><?php echo $this->mylibrary->convertedcit($landdetails['nn_number']) ?></td>
                                      <td><?php echo $this->mylibrary->convertedcit($landdetails['k_number']) ?></td>
                                      <td><?php echo $this->mylibrary->convertedcit($landdetails['total_square_feet'])?></td>
                                      <?php 
                                        $sanrachana_details = $this->SampatiKarRasidModel->getBSanrachanaDetailsByKNo($landdetails['k_number'],$landdetails['fiscal_year']);
                                        pp($sanrachana_details);
                                      ?>
                                      <?php if(empty($sanrachana_details)) { ?>
                                          <td colspan="5"><div class="alert alert-danger">भौतिक संरचनाको विवरण बनेको छैन </div></td>
                                          <td><?php echo $this->mylibrary->convertedcit($landdetails['total_square_feet'])?></td>
                                          <td><?php echo $this->mylibrary->convertedcit($landdetails['t_rate'])?></td>
                                      <?php } else { ?>
                                      <?php foreach ($sanrachana_details as $key => $s) { ?>
                                          <td><?php echo $s['st']?></td>
                                          <td><?php echo $s['sanrachana_usages']?></td>
                                          <td><?php echo $s['architect_type']?></td>
                                          <td><?php echo $this->mylibrary->convertedcit($s['sanrachana_ground_housing_area_sqft'])?></td>
                                          <td><?php echo $this->mylibrary->convertedcit($s['net_tax_amount'])?></td>
                                          <td><?php echo $this->mylibrary->convertedcit($s['r_bhumi_area'])?></td>
                                          <td><?php echo $this->mylibrary->convertedcit($s['r_bhumi_kar'])?></td>
                                      <?php } ?>
                                    <?php } ?>
                                    </tr>
                              
                                </tbody>
                            </table>
                        </div>

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
 <script type="text/javascript">
    $(document).ready(function() {
        $('.dd_select').select2();
        $('.nepaliDate5').nepaliDatePicker();
        $('#date_1').nepaliDatePicker();
      
        $('.btnAddNew').click(function(e) {
                e.preventDefault();
                var trOneNew = $('.partsPurchaseFields').length+1;
                var sn = $(this).closest('.sn_1').val();
                var new_row =
                    '<tr class ="partsPurchaseFields" id="partsPurchaseFields_'+trOneNew+'" data-id="'+trOneNew+'">'+
                   '<td><select class="form-control fiscal_year_frm" name="fiscal_year[]" data-placeholder="छान्नुहोस्" id="main_topic'+trOneNew+'" data-id="'+trOneNew+'"><option landdetails="">छान्नुहोस्</option><?php if(!empty($fiscal_year)) {
                        foreach ($fiscal_year as $key => $fy) { ?><option value="<?php echo $fy['year']?>"><?php echo $fy['year']; } }?></option></select></td>'+
                    '<td><input class="form-control"  type="text" name="total_t_tax[]" id="total_t_tax" readonly="readonly" value="<?php //echo $total_kar_amount?>"  required></td>'+
                    '<td><input class="form-control bhumi_kar"  type="text" name="bhumi_kar[]" id="karrate" readonly="readonly"  required></td>'+
                    '<td><button type="button" class="btn btn-danger btn-sm remove-row" data-toggle="tooltip" title="हटाउनुहोस्"><span class="fa fa-times" tabindex="-1"></span></button></td>'+
                    '<tr>'
                $("#add_new_fields").append(new_row);
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

        $(document).on('click', '#veiwDetails', function(){
          $('#details').toggle();
        });

        $(document).on('change', '.fiscal_year_frm', function(){
          obj = $(this);
          var fiscal_year = obj.val();
          var file_no = "<?php echo $this->uri->segment(3)?>";
          $.ajax({
            url:"<?php echo base_url()?>SampatiKarRasid/getBakayutaDescription",
            data:{fiscal_year:fiscal_year,file_no:file_no},
            type:"POST",
            success:function(resp){
                console.log(resp);
                obj.closest("tr").find('#total_t_tax').val(resp.data);
                obj.closest("tr").find('.bhumi_kar').val(resp.kar_amount.sampati_kar);
            }
          });
        });
    }); //end of dom
 </script>
