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
                    </header>
                    <form class="form" method="post" action="<?php echo base_url()?>SampatiKarRasid/saveBaAmount">
                        <table class="table" id='add_new_fields'>
                            <thead>
                                <tr>
                                    <th>आर्थिक वर्ष</th>
                                    <th>क्षेत्रफल (व. फु )</th>
                                    <th>एकिकृत कर लाग्ने मुल्य</th>
                                    <th>एकिकृत सम्पतिकर</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            
                                            <select class="form-control fiscal_year_frm" name="fiscal_year[]"
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
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" name="total_area[]" class="form-control" id="total_area" readonly="readonly" value="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" name="total_t_tax[]" class="form-control" id="total_t_tax" readonly="readonly" value="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" name="bhumi_kar[]" class="form-control bhumi_kar" readonly="readonly">
                                        </div>
                                    </td>
                                    <td><button type="button" class="btn btn-success btnAddNew">Add New</button></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-md-12 text-center">
                            <hr>
                            <button class="btn btn-primary btn-xs save_button" data-toggle="tooltip"
                                title=" सेभ  गर्नुहोस्" name="Submit" type="submit" value="Save"> सेभ
                                गर्नुहोस्</button>
                            <a href="<?php echo base_url()?>Profile" class="btn btn-danger btn-xs"
                                data-toggle="tooltip" title="सम्पादन गर्नुहोस्">रद्द गर्नुहोस्</a>
                         </div>
                    </form>
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
      $('.btnAddNew').click(function(e) {
        e.preventDefault();
        var trOneNew = $('.partsPurchaseFields').length+1;
        var sn = $(this).closest('.sn_1').val();
        var new_row =
            '<tr class ="partsPurchaseFields" id="partsPurchaseFields_'+trOneNew+'" data-id="'+trOneNew+'">'+
           '<td><select class="form-control fiscal_year_frm" name="fiscal_year[]" data-placeholder="छान्नुहोस्" id="main_topic'+trOneNew+'" data-id="'+trOneNew+'"><option value="">छान्नुहोस्</option><?php if(!empty($fyear)) {
                foreach ($fyear as $key => $fy) { ?><option value="<?php echo $fy['year']?>"><?php echo $fy['year']; } }?></option></select></td>'+
            '<td><input class="form-control"  type="text" name="total_t_tax[]" id="" readonly="readonly" value="<?php //echo $total_kar_amount?>"  required></td>'+
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

        $(document).on('change', '.fiscal_year_frm', function(){
            obj = $(this);
            var fiscal_year = obj.val();
            var file_no = "<?php echo $this->uri->segment(3)?>";
            $.ajax({
                url:"<?php echo base_url()?>SampatiKarRasid/getBakayutaDescription",
                data:{fiscal_year:fiscal_year,file_no:file_no},
                type:"POST",
                success:function(resp){
                    console.log(resp)
                }
            });
        });
    }); //end of dom
 </script>
